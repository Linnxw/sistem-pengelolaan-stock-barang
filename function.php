<?php
$conn = mysqli_connect('0.0.0.0','root','root','stokbarang');

function register($data){
  global $conn;
  $email = $data["email"];
  $password = $data["password"];
  $password2 = $data["password2"];
  $query_email = mysqli_query($conn,"SELECT * FROM login WHERE email = '$email'");
  $cek_email = mysqli_num_rows($query_email);
  if($cek_email > 0){
    return "Email telah digunakan";
  }
 if($password !== $password2){
   return "Password dan Confirm password tidak cocok";
 }
 $hash_password = password_hash($password,PASSWORD_DEFAULT);
 $query_register = "INSERT INTO login (email,password) VALUES('$email','$hash_password')";
 mysqli_query($conn,$query_register);
 if(mysqli_affected_rows($conn) > 0){
   return 200;
 }else{
   return "SERVER ERROR";
 }
}

function login($data){
  global $conn;
  $email = $data["email"];
  $password = $data["password"];
  
  $query_email = mysqli_query($conn,"SELECT * FROM login WHERE email = '$email'");
  $cek_email = mysqli_num_rows($query_email);
  $user = mysqli_fetch_assoc($query_email);
  if($cek_email < 1){
    return "Email tidak terdaftar";
  }
  $cek_password= password_verify($password,$user["password"]);
  if(!$cek_password){
     return "Password salah"; 
  }
  return 200;
}
function tambahstok(){
  global $conn;
  if(isset($_POST["tambahstok"])){
  $namabarang=$_POST["namabarang"];
  $deskripsi=$_POST["deskripsi"];
  $stok=$_POST["stok"];
  
  $addstok = mysqli_query($conn,"INSERT INTO stock (namabarang,deskripsi,stock) VALUES('$namabarang','$deskripsi','$stok')");
  if($addstok){
    return 200;
  }else{
    return 500;
  }
}
}
function tambahmasuk($data){
  global $conn;
  
  $idbarang = $data["barang"];
  $penerima = $data["penerima"];
  $qty = $data["qty"];
  
  $addmasuk = mysqli_query($conn,"INSERT INTO masuk (idbarang,keterangan,qty) VALUES($idbarang,'$penerima',$qty)");
  $updatestok = mysqli_query($conn,"UPDATE stock SET stock = stock + $qty WHERE idbarang = $idbarang");
  if($addmasuk && $updatestok){
    header("Location:masuk.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
}
function tambahkeluar($data){
  global $conn;
  
  $idbarang = $data["barang"];
  $penerima = $data["penerima"];
  $qty = $data["qty"];
  
  $addkeluar = mysqli_query($conn,"INSERT INTO keluar (idbarang,penerima,qty) VALUES($idbarang,'$penerima',$qty)");
  $updatestok = mysqli_query($conn,"UPDATE stock SET stock = stock - $qty WHERE idbarang = $idbarang");
  if($addkeluar && $updatestok){
    header("Location:keluar.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
}
if(isset($_POST["editstok"])){
  $idb = $_POST["idbarang"];
  $namabarang = $_POST["namabarang"];
  $deskripsi = $_POST["deskripsi"];
  $updatestok = mysqli_query($conn,"UPDATE stock SET namabarang = '$namabarang',deskripsi = '$deskripsi' WHERE idbarang = $idb");
  if($updatestok){
    header("Location:index.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
}
if(isset($_POST["deletestok"])){
  $idb = $_POST["idbarang"];
  $deletestok = mysqli_query($conn,"DELETE FROM stock WHERE idbarang = $idb");
  
  if($deletestok){
    header("Location:index.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
}


// EDIT BARANG MASUK
if(isset($_POST["editmasuk"])){
  $idm = $_POST["idmasuk"];
  $idb = $_POST["idbarang"];
  $qty = $_POST["qty"];
  $keterangan = $_POST["keterangan"];
  $stok_masuk_sekarang = mysqli_query($conn,"SELECT * FROM masuk WHERE idmasuk = $idm");
  $stok_barang_sekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang = $idb");
  
  $fetch_stok_masuk_sekarang = mysqli_fetch_assoc($stok_masuk_sekarang);
  $fetch_stok_barang_sekarang = mysqli_fetch_assoc($stok_barang_sekarang);
  
  $stokbarangsekarang = $fetch_stok_barang_sekarang["stock"];
  $stokmasuksekarang = $fetch_stok_masuk_sekarang["qty"];
  
  if($qty > $stokmasuksekarang){
    $selisih = $qty - $stokmasuksekarang;
    $tambahstokbarang = $stokbarangsekarang + $selisih;
    $updatestok = mysqli_query($conn,"UPDATE stock SET stock = $tambahstokbarang WHERE idbarang = $idb");
    $updatemasuk = mysqli_query($conn,"UPDATE masuk SET qty = $qty, keterangan = '$keterangan' WHERE idmasuk = $idm");
 if($updatestok && $updatemasuk){
    header("Location:masuk.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
  }else{
    $selisih = $stokmasuksekarang - $qty;
    $kurangistokbarang = $stokbarangsekarang - $selisih;
    $updatestok = mysqli_query($conn,"UPDATE stock SET stock = $kurangistokbarang WHERE idbarang = $idb");
    $updatemasuk = mysqli_query($conn,"UPDATE masuk SET qty = $qty, keterangan = '$keterangan' WHERE idmasuk = $idm");
 if($updatestok && $updatemasuk){
    header("Location:masuk.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
  }
}

// HAPUS BARANG MASUK
if(isset($_POST["deletemasuk"])){
  $idm = $_POST["idmasuk"];
  $idb = $_POST["idbarang"];
  $qty = $_POST["qty"];
  $updatestok = mysqli_query($conn,"UPDATE stock SET stock = stock - $qty WHERE idbarang = $idb");
  $deletemasuk = mysqli_query($conn,"DELETE FROM masuk WHERE idmasuk = $idm");
  if($updatestok && $deletemasuk){
    header("Location:masuk.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
}

if(isset($_POST["editkeluar"])){
  $idk = $_POST["idkeluar"];
  $idb = $_POST["idbarang"];
  $qty = $_POST["qty"];
  $penerima = $_POST["penerima"];
  $stok_keluar_sekarang = mysqli_query($conn,"SELECT * FROM keluar WHERE idkeluar = $idk");
  $stok_barang_sekarang = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang = $idb");
  
  $fetch_stok_keluar_sekarang = mysqli_fetch_assoc($stok_keluar_sekarang);
  $fetch_stok_barang_sekarang = mysqli_fetch_assoc($stok_barang_sekarang);
  
  $stokbarangsekarang = $fetch_stok_barang_sekarang["stock"];
  $stokkeluarsekarang = $fetch_stok_keluar_sekarang["qty"];
  
  if($qty > $stokkeluarsekarang){
    $selisih = $qty - $stokkeluarsekarang;
    $kurangistokbarang = $stokbarangsekarang - $selisih;
    $updatestok = mysqli_query($conn,"UPDATE stock SET stock = $kurangistokbarang WHERE idbarang = $idb");
    $updatekeluar = mysqli_query($conn,"UPDATE keluar SET qty = $qty, penerima = '$penerima' WHERE idkeluar = $idk");
 if($updatestok && $updatekeluar){
    header("Location:keluar.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
  }else{
    $selisih = $stokkeluarsekarang - $qty;
    $tambahstokbarang = $stokbarangsekarang + $selisih;
    $updatestok = mysqli_query($conn,"UPDATE stock SET stock = $tambahstokbarang WHERE idbarang = $idb");
    $updatekeluar = mysqli_query($conn,"UPDATE keluar SET qty = $qty, penerima = '$penerima' WHERE idkeluar = $idk");
 if($updatestok && $updatekeluar){
    header("Location:keluar.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
  }
}

// HAPUS BARANG MASUK
if(isset($_POST["deletekeluar"])){
  $idk = $_POST["idkeluar"];
  $idb = $_POST["idbarang"];
  $qty = $_POST["qty"];
  $updatestok = mysqli_query($conn,"UPDATE stock SET stock = stock + $qty WHERE idbarang = $idb");
  $deletekeluar = mysqli_query($conn,"DELETE FROM keluar WHERE idkeluar = $idk");
  if($updatestok && $deletekeluar){
    header("Location:keluar.php");
  }else{
    var_dump(mysqli_error($conn));
    exit;
  }
}
?>
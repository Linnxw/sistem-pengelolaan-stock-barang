<?php 
require "function.php";
require "cek.php";
if(isset($_POST["tambahmasuk"])){
  tambahmasuk($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang masuk</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav justify-content-between navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="masuk.php">Linnxw</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
   
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stock barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang keluar 
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.php">Login</a>
                                            <a class="nav-link" href="register.php">Register</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                                                        <a class="nav-link" href="logout.php">
                                Logout 
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=$_SESSION["user"];?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Barang Masuk</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header gap-2 d-flex">
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Tambah Masuk
</button>
<a href="export-masuk.php" class ="btn btn-info">Export data</a>
                            </div>
                            <div class="card-body">  
                            <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama barang</th>
                                            <th>Keterangan</th>
                                            <th>Qty</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                     <tbody>
               <?php 
                 $stock = mysqli_query($conn,"SELECT * FROM stock s,masuk m WHERE s.idbarang = m.idbarang");
 
                 while($data = mysqli_fetch_assoc($stock)):
                       ?>
                       <?php 
                       $idb = $data["idbarang"];
                       $idm = $data["idmasuk"]
                       ?>
                      <tr>
                        <td><?=$data["tanggal"]?></td>
                        <td><?=$data["namabarang"]?></td>
                       <td><?=$data["keterangan"]?></td>
                      <td><?=$data["qty"]?></td>                                            <td>
   <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idm?>">
  Edit
</button>
   <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idm?>">
  Delete
</button>
                      </td>
                      </tr>

                      
        <!-----modal edit---->
    <div class="modal fade" id="edit<?=$idm?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit barang masuk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="d-flex gap-3 flex-column">
         <div class="form-floating mb-3">
           <input
           class="form-control"
           id="keterangan" 
           type="teks" 
           placeholder="Keterangan"
           name="keterangan" value='<?=$data["keterangan"]?>'
           required/>
           <label for="keterangan">Keterangan</label>
          </div>
         <div class="form-floating mb-3">
           <input
           class="form-control"
           id="qty" 
           type="teks" 
           placeholder="Qty"
           name="qty"
           value='<?=$data["qty"]?>'
           required
           />
           <label for="qty">Qty</label>
          </div>
          <input type="hidden" name="idbarang" value='<?=$idb?>'/>
          <input type="hidden" name="idmasuk" value='<?=$idm?>'/>
          <button type="submit" class="btn btn-primary" name="editmasuk">Edit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
            <!---- modal delete ----->
    <div class="modal fade" id="delete<?=$idm?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Hapus barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p>Apakah kamu yakin ingin menghapus <?=$data["namabarang"]?></p>
      </div>
      <div class="modal-footer">
        <form action="" method="post">
        <input type="hidden" name="idbarang" value='<?=$idb?>'>
        <input type="hidden" name="idmasuk" value='<?=$idm?>'>
        <input type="hidden" name="qty" value='<?=$data["qty"]?>'>
         <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="deletemasuk">Ya,saya yakin</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
                 <?php endwhile ?>
                     </tbody>


                                </table>

                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Barang masuk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="d-flex gap-3 flex-column">
         <select name="barang" class="form-control">
           <?php
           $query = mysqli_query($conn,"SELECT * FROM stock");
           while($barang = mysqli_fetch_assoc($query)):
           ?>
           <option value='<?=$barang["idbarang"]?>'><?=$barang["namabarang"]?></option>
           <?php endwhile ?>
         </select>
         <div class="form-floating mb-3">
           <input
           class="form-control"
           id="penerima" 
           type="teks" 
           placeholder="Penerima"
           name="penerima"/>
           <label for="penerima">Penerima</label>
          </div>
         <div class="form-floating mb-3">
           <input
           class="form-control"
           id="qty" 
           type="number" 
           placeholder="Qty"
           name="qty"/>
           <label for="qty">Qty</label>
          </div>
          <button type="submit" class="btn btn-primary" name="tambahmasuk">Tambah</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</html>

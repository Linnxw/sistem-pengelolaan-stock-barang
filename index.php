<?php 
require "cek.php";
require "function.php";
 $tambah = tambahstok();
 if($tambah === 200){
   header("Location:index.php");
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
        <title>Stock Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav justify-content-between navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Linnxw</a>
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
                            <li class="breadcrumb-item active">Stock Barang</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header gap-2 d-flex">
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Tambah barang
</button>
<a href="export.php" class ="btn btn-info">Export data</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama barang</th>
                                            <th>deskripsi</th>
                                            <th>Stock</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                     <tbody>
               <?php 
                 $stock = mysqli_query($conn,"SELECT * FROM stock");
                 
                 $no= 1;
                 while($data = mysqli_fetch_assoc($stock)):
                       ?>
                       <?php
                       $idb = $data["idbarang"];
                       ?>
                      <tr>
                        <td><?=$no?></td>
                        <td><?=$data["namabarang"]?></td>
                       <td><?=$data["deskripsi"]?></td>
                      <td><?=$data["stock"]?></td>
                                            <td>
   <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idb?>">
  Edit
</button>
   <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idb?>">
  Delete
</button>
                      </td>
                      </tr>

                      
        <!-----modal edit---->
    <div class="modal fade" id="edit<?=$idb?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="d-flex gap-3 flex-column">
         <div class="form-floating mb-3">
           <input
           class="form-control"
           id="nama" 
           type="teks" 
           placeholder="Nama barang"
           name="namabarang" value='<?=$data["namabarang"]?>'
           required/>
           <label for="nama">Nama barang</label>
          </div>
         <div class="form-floating mb-3">
           <input
           class="form-control"
           id="deskripsi" 
           type="teks" 
           placeholder="Deskripsi"
           name="deskripsi"
           value='<?=$data["deskripsi"]?>'
           required
           />
           <label for="deskripsi">Deskripsi</label>
          </div>
          <input type="hidden" name="idbarang" value='<?=$data["idbarang"]?>'/>
          <button type="submit" class="btn btn-primary" name="editstok">Edit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
            <!---- modal delete ----->
    <div class="modal fade" id="delete<?=$idb?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
         <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="deletestok">Ya,saya yakin</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
                      <?php $no++?>
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
        <h5 class="modal-title" id="staticBackdropLabel">Tambah barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" class="d-flex gap-3 flex-column">
         <div class="form-floating mb-3">
           <input
           class="form-control"
           id="nama" 
           type="teks" 
           placeholder="Nama barang"
           name="namabarang"/>
           <label for="nama">Nama barang</label>
          </div>
         <div class="form-floating mb-3">
           <input
           class="form-control"
           id="deskripsi" 
           type="teks" 
           placeholder="Deskripsi"
           name="deskripsi"/>
           <label for="deskripsi">Deskripsi</label>
          </div>
         <div class="form-floating mb-3">
           <input
           class="form-control"
           id="stok" 
           type="number" 
           placeholder="Stok"
           name="stok"/>
           <label for="stok">Stok</label>
          </div>
          <button type="submit" class="btn btn-primary" name="tambahstok">Tambah</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</html>

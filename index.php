<?php
include('mylib/myDb.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Data Warga</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
<?php
$Db = new MyDb();
$data_warga = $Db->show();
//print_r($data_warga);
if(isset($_POST['daftar'])){
    //echo "Tombol Daftar Telah Di klik";
    $noktp=$_POST['no_ktp'];
    $nama = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat_lengkap'];
    $nohp = $_POST['no_hp'];
    $querysimpan = $Db->add_data($noktp,$nama,$alamat,$nohp);
    
    if($querysimpan==TRUE){
        $pesansimpan="Data Tersimpan Ke Database";
        echo "<meta http-equiv ='refresh' content='1.5;url=index.php'>";
    }else{
        $pesansimpan="Data Gagal Simpan Ke Database";
        echo "<meta http-equiv ='refresh' content='1.5;url=index.php'>";
    }
}

if (isset($_POST["simpan_update"])) {
    $id = $_POST["id"];
    $no_ktp = $_POST["no_ktp"];
    $nama_lengkap = $_POST["nama_lengkap"];
    $alamat_lengkap = $_POST["alamat_lengkap"];
    $no_hp = $_POST["no_hp"];    
    $queryupdate = $Db->update_data($id,$no_ktp,$nama_lengkap,$alamat_lengkap,$no_hp);
    
    if ($queryupdate) {
        $pesanupdate = true;
        echo "<meta http-equiv ='refresh' content='1.5;url=index.php'>";
    } else {
        $pesangagalupdate = false;
        echo "<meta http-equiv ='refresh' content='1.5;url=index.php'>";
    } 
}

if(isset($_GET['hapus'])){
    //echo "Data dengan ID :".$_GET['hapus']."  Akan di hapus";
    $idwarga=$_GET['hapus'];
    $queryhapus = $Db->delete($idwarga);
    if($queryhapus==TRUE){
        $pesanhapus= "Data Berhasil di hapus";
        echo "<meta http-equiv ='refresh' content='1.5;url=index.php'>";
    }else{
        $pesanhapus ="Data Gagal Hapus";
    }
}
?>
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
          <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
          >
          <hr class="sidebar-divider">
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Form</span>
                </a>
                <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                        
                        <a class="collapse-item active" href="form-daftar.php">Tambah Data Warga</a>                        
                    </div>
                </div>
            </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Warga</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <form class="form-inline">
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
              </button>
            </form>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <h3 class="text-dark font-weight-bold">Data Warga</h3>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->
                  <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">Alerts Center</h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 12, 2019</div>
                      <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 7, 2019</div>
                      $290.29 has been deposited into your account!
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 2, 2019</div>
                      Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                  </a>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
              </li>

              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Counter - Messages -->
                  <span class="badge badge-danger badge-counter">7</span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">Message Center</h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="..." />
                      <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                      <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                      <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="..." />
                      <div class="status-indicator"></div>
                    </div>
                    <div>
                      <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                      <div class="small text-gray-500">Jae Chun · 1d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="..." />
                      <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                      <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                      <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="..." />
                      <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                      <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                      <div class="small text-gray-500">Chicken the Dog · 2w</div>
                    </div>
                  </a>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
              </li>

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">Arfi Zinedine Zidane</span>
                  <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800 text-center font-weight-bold">Biodata Pribadi Warga</h1>

            

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
              <a href="form-daftar.php" class='btn btn-primary font-weight-bold'>Tambah Data Warga</a>
              </div>
              <div class="card-body">
              <?php if(isset($pesanupdate)) : ?>
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                <use xlink:href="#check-circle-fill" />
                                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </symbol>
                            </svg>
                            <div class="fw-bold">
                                Data Berhasil Di Update
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(isset($pesangagalupdate)) : ?>

<div class="alert alert-warning d-flex align-items-center alert-dismissible fade show"
    role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
        <use xlink:href="#exclamation-triangle-fill" />
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <div class="fw-bold">
        Anda Tidak Melakukan Update Data
    </div>    
</div>
<?php endif; ?>

                <div class="table-responsive">
            <?php  
            if(isset($_POST['daftar'])){
            ?>
            <div class="alert alert-success"><?php echo $pesansimpan?></div>
            <?php
                } 
            ?>
            
            <?php  
            if(isset($_GET['hapus'])){
            ?>
            <div class="alert alert-danger"><?php echo $pesanhapus?></div>
            <?php
                } 
            ?>
                  <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No KTP</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                     <tfoot>
                      <th>No</th>
                      <th>No KTP</th>
                      <th>Nama Lengkap</th>
                      <th>Alamat</th>
                      <th>No HP</th>
                      <th>Action</th>
                      </tfoot>

                      <tbody>
                     <?php
                $i=0;
                foreach($data_warga as $data){ 
                    $i++;
                    ?>                    
                      <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $data['no_ktp']; ?></td>
                      <td><?php echo $data['nama_lengkap']; ?></td>
                      <td><?php echo $data['alamat_lengkap']; ?></td>
                      <td><?php echo $data['no_hp']; ?></td>
                      <td class="text-center"><a class="btn btn-warning text-light font-weight-bold" href="detail-warga.php?id=<?php echo $data['id']; ?>">Detail</a> 
                      <a class="btn btn-success font-weight-bold" href="edit-data-warga.php?id=<?php echo $data['id']; ?>">Edit</a>
                      <!-- <a class="btn btn-danger" href="index.php?hapus=<?php echo $data['id']; ?>">Hapus</a> -->
                      <a class="btn btn-danger font-weight-bold" href="index.php?hapus=<?=$data['id']; ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')">Hapus</a>
                      </td>
                      </tr>
                      </tbody>
                      <?php } ?>
                     
                    
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Data Warga</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
  </body>
</html>

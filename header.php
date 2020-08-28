<?php
ob_start();
session_start();
include 'ayarlar.php';

if ($_SESSION["kullanici"] == "") {
  header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $baslik; ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="panel.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fab fa-korvue"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KARSAL ÖRME </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="panel.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Ana Sayfa</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">



      <!-- Heading -->
      <div class="sidebar-heading">
        ÖRGÜ
      </div>
      <li class="nav-item">
        <a class="nav-link" href="makinebakimlistesi.php">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Makine Bakım Durumu</span></a>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="makineignelistesi.php">
          <i class="fas fa-fw fa-cogs"></i>
          <span>İğne Değişim Durumu</span></a>
      </li>
	  
	  
      <li class="nav-item">
        <a class="nav-link" href="makineandon.php">
          <i class="fab fa-microsoft"></i>
          <span>Örgü Durum Ekranı</span></a>
      </li>
	  
	  <li class="nav-item">
        <a class="nav-link" href="orgudurumtablosu.php">
          <i class="fab fa-microsoft"></i>
          <span>Aktif Örgü Raporu</span></a>
      </li>


      <!-- Nav Item - Pages Collapse Menu -->


      <!-- Nav Item - Utilities Collapse Menu -->
	  
	   <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Boyahane
      </div>
	  
	  <li class="nav-item">
        <a class="nav-link" href="boyahanetablosu.php">
          <i class="fab fa-microsoft"></i>
          <span>Boyahane Durum Tablosu</span></a>
      </li>
	  
	   <li class="nav-item">
        <a class="nav-link" href="boyahanedurumekrani.php">
          <i class="fab fa-microsoft"></i>
          <span>Boyahane Durum Ekranı</span></a>
      </li>
	  
	  
	  
	  
	  
	  
	  
	  
	  


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Raporlar
      </div>

      <!-- Nav Item - Pages Collapse Menu -->


      <!-- Nav Item - Charts -->

<?php 

if($_SESSION["yetki"] == "1"){
	


?>
      <!-- Nav Item - Tables -->
	   <li class="nav-item">
        <a class="nav-link" href="tarihegoreuretimler.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tarihe Göre Günlük Üretim</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="kumasstokraporu.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Kumaş Stok Raporu</span></a>
      </li>
	  <?php
	
	}

	  ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

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
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>-->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS)
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>-->
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>




            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION["kullanici"]; ?></span>
                <img class="img-profile rounded-circle" src="img/user.jpg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  ÇIKIŞ
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

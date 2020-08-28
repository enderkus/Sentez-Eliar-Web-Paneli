<?php

ob_start();
session_start();
include "db.php";

if($_SESSION["id"] != "") {
	header("Location:panel.php");
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

  <title>Karsal Web Yönetim Paneli</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-dark">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">HOŞ GELDİNİZ</h1>
                    <?php
					

                    if ($_POST) {
                      $kullanici = $_POST['kullanici'];
                      $sifre = $_POST['sifre'];
					  

                     $kullanicisay = $database->count("Meta_User",[
					  "UserCode" => $kullanici,
					  "Ud_WebSifre" => $sifre,
					  ]);
					  
					  if($kullanicisay == "1") {
						  $kullanicigetir = $database->select("Meta_User","*",[
						  "UserCode" => $kullanici,
						  "Ud_WebSifre" => $sifre,
						  ]);
						  
						  
						
						  
						  
						  $_SESSION["id"] = $kullanicigetir[0]["RecId"];
						  $_SESSION["kullanici"] = $kullanicigetir[0]["UserName"];
						  $_SESSION["yetki"] = $kullanicigetir[0]["Ud_WebYetki"];
						  
							header("Location:panel.php");
						  
						  
					  } else {
						  echo '<p class="alert alert-danger">HATALI BİR ŞİFRE GİRİŞİ YAPTINIZ !</p>';
					  }


                    }



                     ?>
                  </div>
                  <form class="user" action="<?php $PHP_SELF; ?>" method="post">
                    
					
					
					<div class="form-group">
					
					<select class="form-control" name="kullanici" style="border-radius:10rem;">
					
					<?php
					
					$kullanicigetir = $database->select("Meta_User","*");
					
					
					foreach($kullanicigetir as $kg){
					
					
					?>
					
					<option value="<?= $kg["UserCode"]; ?>" style="padding-top:1rem; padding-bottom:1rem;"><?= $kg["UserCode"]; ?>-<?= $kg["UserName"]; ?></option>
					
					
					<?php } ?>
					
					</select>
					
					</div>
					
					
                    <div class="form-group">
                      <input type="password" name="sifre" class="form-control form-control-user" placeholder="Şifre">
                    </div>

                    <button type="submit" name="button" class="btn btn-dark btn-user btn-block">GİRİŞ</button>



                  </form>
                  <hr>


                </div>
              </div>
            </div>
          </div>
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

</body>

</html>

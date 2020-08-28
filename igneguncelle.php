<?php
ob_start();
date_default_timezone_set('Europe/Istanbul');
require 'db.php';

$makinakodu = $_GET['makinakodu'];

$tarih = date('m-d-Y');



if ($makinakodu == "") {
  echo "Geçersiz Makina Kodu Girildi";
} else {
  $guncelle = $database->update("Erp_Resource",[
    "UD_IgnePlatinDegisim" => $tarih,
  ],[
    "ResourceCode" => $makinakodu,
  ]);
  header("Location:makineignelistesi.php");
}




 ?>

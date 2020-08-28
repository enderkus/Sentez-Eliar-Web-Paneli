<?php
include 'header.php';
include 'db.php';
?>



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">ÖRGÜ MAKİNE İĞNE DEĞİŞİM TARİHİ LİSTESİ</h1>


    <table class="table table-striped table-bordered table-light">


    <thead class="thead-dark">
<tr>
<th scope="col">MAKİNE KODU</th>
<th scope="col">SON İĞNE DEĞİŞİM TARİHİ</th>
<th scope="col" class="text-center">İŞLEM</th>
</tr>
</thead>
<tbody>

<?php


$ignebakimgetir = $database->select("Erp_Resource","*",[
"ResourceCode[~]" => "OR",
"ORDER" => ["ResourceCode" => "ASC"],
]);



foreach($ignebakimgetir as $ibg){
	$tarih = $ibg['UD_IgnePlatinDegisim'];
	$yenitarih = date("d-m-Y", strtotime($tarih));
	echo '<tr class="text-dark">
	<td>'.$ibg['ResourceCode'].'</td>
	<td>'.$yenitarih.'</td>
	<td ><a href="igneguncelle.php?makinakodu='.$ibg['ResourceCode'].'" class="btn btn-success float-right">İğne Değişim Tarihi Güncelle</a></td>
	</tr>';
}






?>




</tbody>
</table>
    <!-- Listeleme Alanı Bitiyor -->


</div>
<!-- /.container-fluid -->



<?php include 'footer.php'; ?>

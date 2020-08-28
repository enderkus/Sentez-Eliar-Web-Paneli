<?php
include 'header.php';
include 'db.php';
?>



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">ÖRGÜ MAKİNE BAKIM LİSTESİ</h1>


    <table class="table table-striped table-bordered table-light">


    <thead class="thead-dark">
<tr>
<th scope="col">MAKİNE KODU</th>
<th scope="col">SON BAKIM TARİHİ</th>
<th scope="col">BAKIM PERİYODU (KG)</th>
<th scope="col">ANLIK TARTIM</th>
<th scope="col" class="text-center">İŞLEM</th>
</tr>
</thead>
<tbody>

<?php



$sorgu = $database->query("SELECT     dbo.Erp_Resource.ResourceCode, dbo.Erp_Resource.UD_BakimTarih, dbo.Erp_Resource.UD_BakimMiktar, SUM(dbo.Erp_InventorySerialCard.NetQuantity) AS Expr1,
                    dbo.Erp_Resource.Explanation
FROM         dbo.Erp_Resource INNER JOIN
                    dbo.Erp_InventorySerialCard ON dbo.Erp_Resource.RecId = dbo.Erp_InventorySerialCard.ResourceId AND
                    dbo.Erp_Resource.UD_BakimTarih < dbo.Erp_InventorySerialCard.InsertedAt
WHERE     (dbo.Erp_Resource.ResourceCode LIKE 'OR%')
GROUP BY dbo.Erp_Resource.ResourceCode, dbo.Erp_Resource.UD_BakimMiktar, dbo.Erp_Resource.UD_BakimTarih, dbo.Erp_Resource.Explanation")->fetchAll();


foreach ($sorgu as $bilgi ) {
$tarih = $bilgi['UD_BakimTarih'];
$yenitarih = date("d-m-Y", strtotime($tarih));
$anliktartim = $bilgi['Expr1'];
$bakimlimit =  $bilgi['UD_BakimMiktar'];
$hesapla = $bakimlimit - $anliktartim;
$limitbindelik = number_format($bakimlimit, 0, ',', '.');
$anlikbindelik = number_format($anliktartim, 0, ',', '.');


if ($anliktartim > $bakimlimit) {
echo '
<tr class="bg-danger text-light">
<td>'.$bilgi['ResourceCode'].'</td>
<td>'.$yenitarih.'</td>
<td>'.$limitbindelik.' KG</td>
<td >'.$anlikbindelik.' KG</td>
<td ><a href="makinaguncelle.php?makinakodu='.$bilgi['ResourceCode'].'" class="btn btn-success float-right">Bakım Tarihi Güncelle</a></td>
</tr>
';
} elseif ($hesapla < 1000) {
echo '
<tr class="bg-warning text-dark">
<td>'.$bilgi['ResourceCode'].'</td>
<td>'.$yenitarih.'</td>
<td>'.$limitbindelik.' KG</td>
<td >'.$anlikbindelik.' KG</td>
<td><a href="makinaguncelle.php?makinakodu='.$bilgi['ResourceCode'].'" class="btn btn-success float-right">Bakım Tarihi Güncelle</a></td>
</tr>
';
} else {
echo '
<tr class="text-dark">
<td>'.$bilgi['ResourceCode'].'</td>
<td>'.$yenitarih.'</td>
<td>'.$limitbindelik.' KG</td>
<td>'.$anlikbindelik.' KG</td>
<td><a href="#" class="btn btn-dark float-right disabled">Bakım Tarihi Güncelle</a></td>
</tr>
';
}



}




?>




</tbody>
</table>
    <!-- Listeleme Alanı Bitiyor -->


</div>
<!-- /.container-fluid -->



<?php include 'footer.php'; ?>

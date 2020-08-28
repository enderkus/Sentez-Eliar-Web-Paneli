<?php

include 'header.php';
include 'db.php';

 ?>

<link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">

 <div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">GÜNCEL KUMAŞ STOK RAPORU</h1>
   <table class="table table-striped table-responsive table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Fiş Türü</th>
      <th scope="col">Stok Kodu</th>
      <th scope="col">Stok Adı</th>
      <th scope="col">Parti No</th>
      <th scope="col">M.Sipariş No</th>
      <th scope="col">Açıklama</th>
      <th scope="col">Renk Kodu</th>
      <th scope="col">Paket Adedi</th>
      <th scope="col">Net</th>
      <th scope="col">Brüt</th>
      <th scope="col">Kullanılan</th>
      <th scope="col">Kalan</th>
      <th scope="col">Raf</th>
    </tr>
  </thead>
  <tbody>

    <?php

    $raporsorgusu = $database->query("select
iri.RecId,
Case iri.ReceiptType
    When 1 Then 'Mal Alım Fişi'
    When 3 Then 'Toptan Satış İade İrsaliyesi'
    When 6 Then 'Fason (Verilen) Giriş Fişi'
    When 10 Then 'Üretim Fişi'
    When 11 Then 'Fason (Alınan) Giriş'
    When 12 Then 'Fason (Alınan) İade Fişi'
    When 16 Then 'Sayım Fişi'
    When 17 Then 'Depo Transfer Fişi'
    When 29 Then 'Üretimden İade Fişi'
    else ''
  End As 'Fiş Türü',
ir.ReceiptDate as [Fiş Tarihi],
ir.ReceiptType as [Fiş Tipi],
ir.ReceiptNo as [Fiş No],
iri.ItemOrderNo as [Satır],
ir.ReceiptType as [Fiş Tipi],
cura.CurrentAccountName as  [Cari Adı],
inv.InventoryCode as [Stok Kodu],
inv.InventoryName as [Stok Adı],
iri.PartyNo as [Parti No],
iri.CustomerOrderNo [M.Sipariş No],
iri.Explanation as [Açıklama],
lab.LabRecipeName as [Renk Kodu],
lab.LabRecipeName as [Renk Adı],
iri.ud_Olculer as [Ölçüler],
iri.UD_IplikRengi as [İplik Rengi],
iri.PackageQuantity as [Paket Adedi],
isnull(iri.NetQuantity,0) as [Net],
isnull(iri.GrossQuantity,0) as  [Brüt],
iri.UsedQuantity  as [Kullanılan],
(iri.NetQuantity - isnull(iri.UsedQuantity,0)) as [Kalan],
whl.Explanation as [Raf]
from Erp_InventoryReceiptItem as iri
left join Erp_InventoryReceipt as ir on ir.RecId = iri.InventoryReceiptId
left join Erp_Inventory as inv on inv.RecId = iri.InventoryId
left join Erp_CurrentAccount as cura on cura.RecId = ir.CurrentAccountId
left join Erp_LabRecipe as lab on lab.RecId = iri.LabRecipeId
left join Erp_WarehouseLocation as whl on whl.RecId = iri.InWarehouseLocationId
where (iri.IsClosed = 0 or iri.IsClosed is null) and inv.InventoryCode like 'KM%'  and  (iri.InWarehouseId = 8 OR iri.InWarehouseId = 16)
and (iri.NetQuantity - isnull(iri.UsedQuantity,0))>0




order by ir.ReceiptDate , ir.RecId , iri.ItemOrderNo")->fetchAll();
    $i=1;
    foreach ($raporsorgusu as $rs) {
      echo '<tr>
        <th scope="row">'.$i.'</th>
        <td>'.$rs['Fiş Türü'].'</td>
        <td>'.$rs['Stok Kodu'].'</td>
        <td>'.$rs['Stok Adı'].'</td>
        <td>'.$rs['Parti No'].'</td>
        <td>'.$rs['M.Sipariş No'].'</td>
        <td>'.$rs['Açıklama'].'</td>
        <td>'.$rs['Renk Kodu'].'</td>
        <td>'.number_format($rs['Paket Adedi'],0).'</td>
        <td>'.number_format($rs['Net'],2,',','.').'</td>
        <td>'.number_format($rs['Brüt'],2,',','.').'</td>
        <td>'.number_format($rs['Kullanılan'],2,',','.').'</td>
        <td>'.number_format($rs['Kalan'],2,',','.').'</td>
        <td>'.$rs['Raf'].'</td>
      </tr>';
      $i++;
    }

    ?>



  </tbody>
   <tfoot>
            <tr>
      <th scope="col">#</th>
      <th scope="col">Fiş Türü</th>
      <th scope="col">Stok Kodu</th>
      <th scope="col">Stok Adı</th>
      <th scope="col">Parti No</th>
      <th scope="col">M.Sipariş No</th>
      <th scope="col">Açıklama</th>
      <th scope="col">Renk Kodu</th>
      <th scope="col">Paket Adedi</th>
      <th scope="col">Net</th>
      <th scope="col">Brüt</th>
      <th scope="col">Kullanılan</th>
      <th scope="col">Kalan</th>
      <th scope="col">Raf</th>
    </tr>
        </tfoot>
</table>

</div>

 <?php
 include 'footer.php';
  ?>

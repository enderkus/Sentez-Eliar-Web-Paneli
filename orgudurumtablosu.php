<?php

include 'header.php';
include 'db.php';

 ?>

<link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">

 <div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">ÖRGÜ DURUM TABLOSU(FİLTRE ÖZELLİKLİ)</h1>
   <table class="table table-striped table-responsive table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Makine Kodu</th>
	  <th scope="col">Makine Adı</th>
      <th scope="col">Müşteri Adı</th>
      <th scope="col">Kumaş Adı</th>
      <th scope="col">Kilo</th>
      <th scope="col">İş Emri No</th>
	  <th scope="col">Satır No</th>
    </tr>
  </thead>
  <tbody>

    <?php

    
	 $datas = $database->query("SELECT TOP 100 PERCENT   wop.WorkOrderItemId, wop.InOut, wop.ResourceId, dbo.Erp_Resource.ResourceCode AS MakinaKodu, dbo.Erp_Resource.Explanation AS MakinaAdi, woi.WorkOrderId,
                      wop.ProcessId, dbo.Erp_Inventory.InventoryCode, dbo.Erp_Inventory.InventoryName, wo.WorkOrderNo, woi.ItemOrderNo, woi.Quantity, woi.FabricGram AS Gramaj,
                      woi.FabricWidth AS En, woi.PartyNo, dbo.TotalTatilan.NetTartilan, dbo.TotalTatilan.Sakat, dbo.TotalTatilan.NetTartilan - dbo.TotalTatilan.Sakat AS Tartim,
                      dbo.Erp_Resource.InUse, woi.FabricDenier AS Denye, woi.ud_MayTup AS MayTup, woi.UD_Renk1 AS Renk, ca.CurrentAccountCode AS MusterıKodu,
                      ca.CurrentAccountName AS MusteriAdi, dbo.makinaa.UD_BakimTarih, dbo.makinaa.UD_BakimMiktar, dbo.makinaa.Expr1 AS BakSonUretim
FROM         dbo.Erp_WorkOrderProduction AS wop INNER JOIN
                      dbo.Erp_Resource ON wop.ResourceId = dbo.Erp_Resource.RecId INNER JOIN
                      dbo.Erp_WorkOrderItem AS woi INNER JOIN
                      dbo.Erp_Inventory ON woi.InventoryId = dbo.Erp_Inventory.RecId ON wop.WorkOrderItemId = woi.RecId INNER JOIN
                      dbo.Erp_WorkOrder AS wo ON woi.WorkOrderId = wo.RecId INNER JOIN
                      dbo.makinaa ON dbo.Erp_Resource.ResourceCode = dbo.makinaa.ResourceCode LEFT OUTER JOIN
                      dbo.Erp_CurrentAccount AS ca ON woi.CurrentAccountId = ca.RecId LEFT OUTER JOIN
                      dbo.TotalTatilan ON woi.RecId = dbo.TotalTatilan.WorkOrderReceiptItemId

WHERE     (wop.InOut = 1) AND (wop.ProcessId = 1) AND (dbo.Erp_Resource.InUse = 1) AND (dbo.Erp_Resource.ResourceCode LIKE N'OR%') ORDER BY MakinaKodu ASC
")->fetchAll();
	
	
	
	
    $i=1;
    foreach ($datas as $ds) {
      echo '<tr>
        <th scope="row">'.$i.'</th>
        <td>'.$ds['MakinaKodu'].'</td>
		<td>'.$ds['MakinaAdi'].'</td>
        <td>'.$ds['MusteriAdi'].'</td>
        <td>'.$ds['InventoryName'].'</td>
        <td>'.number_format($ds['Quantity'],2,',','.').'</td>
        <td>'.$ds['WorkOrderNo'].'</td>
        <td>'.$ds['ItemOrderNo'].'</td>

      </tr>';
      $i++;
    }

    ?>



  </tbody>
   <tfoot>
            <tr>
      <th scope="col">#</th>
  
      <th scope="col">Makine Kodu</th>
	  <th scope="col">Makine Adı</th>
      <th scope="col">Müşteri Adı</th>
      <th scope="col">Kumaş Adı</th>
      <th scope="col">Kilo</th>
      <th scope="col">İş Emri No</th>
	  <th scope="col">Satır No</th>
    </tr>
        </tfoot>
</table>

</div>

 <?php
 include 'footer.php';
  ?>

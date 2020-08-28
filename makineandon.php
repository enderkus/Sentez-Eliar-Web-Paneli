<?php
include 'header.php';
include 'db.php';
function kisalt($kelime, $str = 10)
	{
		if (strlen($kelime) > $str)
		{
			if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8").'..';
			else $kelime = substr($kelime, 0, $str).'..';
		}
		return $kelime;
	}
 ?>


 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">ÖRGÜ DURUM EKRANI</h1>

<div class="row">


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



                  foreach ($datas as $d) {
                    $yazi = mb_strtolower($d['MakinaKodu']);
                     if($d['BakSonUretim'] >= $d['UD_BakimMiktar']) {
						echo "<div class='col-xl-3  p-3' >";
					} else {
					echo "<div class='col-xl-3 p-3'>";
					}



                    $siparis = round($d['Quantity']);
                    $tartilan = round($d['Tartim']);
					$kalan = $siparis - $tartilan;
                    $yuzde = $tartilan / $siparis;
                    $yuzde2 = $yuzde * 100;
                    $makinakodu = $d['MakinaKodu'];
                    $trimli = ltrim($makinakodu, "OR0");



                    ?>

        <div class="bg-white rounded-lg p-5 shadow border-bottom-success">
          <h2 class="h6 font-weight-bold text-center mb-4"><?= $d['WorkOrderNo']; ?>-<?= $d['ItemOrderNo']; ?></h2>
          <hr>
          <p class="font-weight-bold text-center" data-toggle="tooltip" data-placement="top" title="<?= $d['InventoryName']; ?>"><?= kisalt($d['InventoryName'],25); ?></p>
          <p class="font-weight-bold text-center"><?= $d['MusteriAdi']; ?></p>

          <!-- Progress bar 1 -->
          <div class="progress mx-auto" data-value='<?= $yuzde2; ?>'>
            <span class="progress-left">
                          <span class="progress-bar border-success"></span>
            </span>
            <span class="progress-right">
                          <span class="progress-bar border-success"></span>
            </span>
            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
              <div class="h2 font-weight-bold"><?= $trimli; ?></div>
            </div>
          </div>
          <!-- END -->

          <!-- Demo info -->
          <div class="row text-center mt-4">
            <div class="col-6 border-right">
              <div class="h4 font-weight-bold mb-0"><?= $kalan; ?> KG</div><span class="small text-gray">KALAN MİKTAR</span>
            </div>
            <div class="col-6">
              <div class="h4 font-weight-bold mb-0"><?= $siparis; ?> KG</div><span class="small text-gray">SİPARİŞ MİKTARI</span>
            </div>
          </div>
          <!-- END -->
        </div>


				 <!--<p style="font-size:0.8em; text-align:center; margin-bottom:0px; padding-bottom:0px; font-weight:bold;">KALAN / S.MİKTARI</p>-->

                  <?php


                  echo "</div>";

                  }

                  ?>
 </div>
 </div>
 <!-- /.container-fluid -->


 <?php

include 'footer.php';

  ?>
   <script  src="js/custom.js"></script>

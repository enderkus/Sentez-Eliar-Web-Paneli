<?php

include 'header.php';
include 'db.php';

?>

<link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">

 <div class="container-fluid">
<div class="row">
   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">TARİHE GÖRE ÜRETİM BİLGİSİ EKRANI</h1>

	<div class="col-md-12 mb-4">
		<div class="card">
		
		<div class="card-header">RAPOR GÖRMEK İSTEDİĞİNİZ GÜNÜ SEÇİN</div>
		<div class="card-body">
		<form method="post" action="tarihegoreuretimler.php" >
		<div class="form-group">
		<input type="date" name="tarih" class="form-control" style="padding-top:15px; padding-bottom:15px;" required />
		</div>
		
	
		
		</div>
		
		<div class="card-footer">
		<input type="submit" class="btn btn-success btn-block" value="RAPOR GETİR" />
		</div>
	
		</form>
		</div>
	</div>
	
	
	<?php
	
	if($_POST) {
	
	
	 $tarih = $_POST["tarih"];
	 $tarihsifir = date("Y-m-d",strtotime($tarih))." 00:00:00.000";
     
	 $gunekle =  strtotime("+1 day");
     $bugunsekiz = date("Y-m-d",strtotime($tarih))." 08:0:0.000";
     $yarinsekiz = date("Y-m-d",strtotime("+1 day", strtotime($tarih)))." 08:0:0.000";
	
	
	?>
	 <div class=" col-1-5 mb-4">
              <div class="itemc">


              <div class="card border-left-primary shadow h-100 py-2 mb-4">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">ÖRGÜ ÜRETİM BİLGİLERİ</div>
                     <?= $tarih; ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $orgumakinesay; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fab fa-battle-net fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>


                            <div class="card border-left-primary shadow h-100 py-2">
                              <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">ÖRGÜ GÜNLÜK ÜRETİM</div>


                                    <?php




                                    $orgugunlukuretim = $database->query("SELECT SUM(NetQuantity) FROM Erp_InventorySerialCard WHERE InsertedAt BETWEEN '".$bugunsekiz."' AND '".$yarinsekiz."' AND InsertedBy IN (21,22)")->fetchAll();
									//print_r($orgugunlukuretim);
									
									
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($orgugunlukuretim[0][0], 0, ',', '.') . " KG"; ?></div>
                                  </div>
                                  <div class="col-auto">
                                    <i class="fab fa-battle-net fa-2x text-gray-300"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
            </div>




            <!-- Earnings (Monthly) Card Example -->
            <div class=" col-1-5 mb-4">
              <div class="mb-4">


              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">BOYAHANE ÜRETİM BİLGİLERİ</div>
                      <?= $tarih; ?>

                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $boyahanecalisan; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tint fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="itemc">


              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">BOYAHANE GÜNLÜK ÜRETİM MİKTARI</div>
                      <?php

                    



                      $boyahanegunluktoplam = $database->sum("Erp_WorkOrderProduction","Quantity",

                         [
                           "ProductionTime[<>]"=>[$bugunsekiz,$yarinsekiz],
                           "ResourceId[<>]"=>["172","199"],
						   "ProcessId" => "35",
                         ]
                      );
					  
					  $boyahanegunluktoplam2 = $database->sum("Erp_WorkOrderProduction","Quantity",

                         [
                           "ProductionTime[<>]"=>[$bugunsekiz,$yarinsekiz],
                           "ResourceId[<>]"=>["172","199"],
						   "ProcessId" => "37",
                         ]
                      );
					  
					  $boyahanegunluktoplam3 = $database->sum("Erp_WorkOrderProduction","Quantity",

                         [
                           "ProductionTime[<>]"=>[$bugunsekiz,$yarinsekiz],
                           "ResourceId[<>]"=>["172","199"],
						   "ProcessId" => "56",
                         ]
                      );
					  
					  $boyahanegunluktoplam4 = $database->sum("Erp_WorkOrderProduction","Quantity",

                         [
                           "ProductionTime[<>]"=>[$bugunsekiz,$yarinsekiz],
                           "ResourceId[<>]"=>["172","199"],
						   "ProcessId" => "57",
                         ]
                      );
					  
					  $boyahanegunluktoplam5 = $database->sum("Erp_WorkOrderProduction","Quantity",

                         [
                           "ProductionTime[<>]"=>[$bugunsekiz,$yarinsekiz],
                           "ResourceId[<>]"=>["172","199"],
						   "ProcessId" => "34",
                         ]
                      );


                      ?>

                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($boyahanegunluktoplam + $boyahanegunluktoplam2 + $boyahanegunluktoplam3 + $boyahanegunluktoplam4 + $boyahanegunluktoplam5, 0, ',', '.') . " KG"; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tint fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-1-5 mb-4">
              <div class="itemc mb-4">


              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">GÜNLÜK İPLİK DEPO GİRİŞ</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                            <?php



                            $iplikdepogiris = $database->query("SELECT     TOP (100) PERCENT ir.RecId, iri.ReceiptType, 
                      CASE iri.ReceiptType WHEN 1 THEN 'Mal Alım Fişi' WHEN 3 THEN 'Toptan Satış İade İrsaliyesi' WHEN 6 THEN 'Fason (Verilen) Giriş Fişi' WHEN 10 THEN 'Üretim Fişi'
                       WHEN 11 THEN 'Fason (Alınan) Giriş' WHEN 12 THEN 'Fason (Alınan) İade Fişi' WHEN 16 THEN 'Sayım Fişi' WHEN 17 THEN 'Depo Transfer Fişi' WHEN 29 THEN 'Üretimden İade Fişi'
                       ELSE '' END AS [Fiş Türü], ISNULL(ir.UD_FisTuru, '') AS [Fiş Alt Türü], ISNULL(wh.WarehouseCode, '') AS [Çıkış Depo Kodu], ISNULL(wh.WarehouseName, '') 
                      AS [Çıkış Depo Adı], ISNULL(whi.WarehouseCode, '') AS [Giriş Depo Kodu], ISNULL(whi.WarehouseName, '') AS [Giriş Depo Adı], ir.ReceiptNo AS [Fiş No], 
                      ISNULL(ca.CurrentAccountCode, '') AS [Cari Kodu], ISNULL(ca.CurrentAccountName, '') AS [Cari Adı], ir.ReceiptDate AS [Fiş Tarihi], inv.InventoryCode AS [Stok Kodu], 
                      inv.InventoryName AS [Stok Adı], ISNULL(iri.UD_IplikRengi, '') AS [İplik Rengi], ISNULL(lab.LabRecipeCode, '') AS [Renk Kodu], ISNULL(lab.LabRecipeName, '') 
                      AS [Renk Adi], ISNULL(labw.LabRecipeCode, '') AS [Sipariş Renk Kodu], ISNULL(labw.LabRecipeName, '') AS [Sipariş Renk Adi], ISNULL(iri.UD_PlanlananMakina, '') 
                      AS [Planlanan Makina], ISNULL(iri.CustomerOrderNo, '') AS [Müşteri Parti No], ISNULL(iri.PartyNo, '') AS [Parti No], ISNULL(iri.Explanation, '') AS Açıklama, 
                      ISNULL(iri.WorkOrderReceiptItemId, 0) AS [Üretim Emri Satır No], ISNULL(wo.WorkOrderNo, '') AS [Üretim Emri], CASE WHEN wo.RecId > 0 THEN
                          (SELECT     cc.CurrentAccountName
                            FROM          Erp_CurrentAccount AS cc
                            WHERE      cc.RecId = wo.CurrentAccountId) ELSE '' END AS Müşteri, ISNULL(iri.FabricPus, '') AS Pus, ISNULL(iri.FabricFein, '') AS Fayn, ISNULL(iri.FabricDenier, '') 
                      AS [İplik Denye], ISNULL(iri.FabricFilament, '') AS Flament, ISNULL(iri.UD_PamukOrani, '') AS [Pamuk Orani], ISNULL(iri.UD_PolyesterOrani, '') AS [Polyester Orani], 
                      ISNULL(woi.ud_Olculer, '') AS Ölçüler, ISNULL(iri.UD_CizgiRengi, '') AS [Çizgi Rengi], ISNULL(iri.UD_Tedarikci, '') AS Tedarikçi, ISNULL(cu.CurrentAccountName, '') 
                      AS Expr1, ISNULL(iri.UD_IplikLot, '') AS [İplik Lot], ISNULL(iri.UD_PaketBirimi, '') AS [Paket Birimi], ISNULL(iri.PackageQuantity, 0) AS [Paket Adedi], 
                      ISNULL(iri.NetQuantity, 0) AS Net, ISNULL(iri.GrossQuantity, 0) AS Brüt, ISNULL(iri.UsedQuantity, 0) AS Kullanilan, CAST(ISNULL(iri.NetQuantity, 0) 
                      - ISNULL(iri.UsedQuantity, 0) AS float) AS Kalan, ISNULL(whl.LocationCode, '') AS Raf,
                          (SELECT     TOP (1) WorkOrderNo
                            FROM          dbo.Erp_WorkOrder AS wo4
                            WHERE      (RecId IN
                                                       (SELECT     WorkOrderId
                                                         FROM          dbo.Erp_WorkOrderItem AS woi4
                                                         WHERE      (RecId IN
                                                                                    (SELECT     WorkOrderReceiptItemId
                                                                                      FROM          dbo.Erp_WorkOrderItemReceipt AS wor4
                                                                                      WHERE      (InventoryReceiptItemId = iri.RecId)))))) AS [Tahsis Edilen]
FROM         dbo.Erp_InventoryReceiptItem AS iri WITH (NoLock) LEFT OUTER JOIN
                      dbo.Erp_InventoryReceipt AS ir WITH (NoLock) ON iri.InventoryReceiptId = ir.RecId LEFT OUTER JOIN
                      dbo.Erp_Inventory AS inv WITH (NoLock) ON inv.RecId = iri.InventoryId LEFT OUTER JOIN
                      dbo.Erp_InventoryReceiptItemVariant AS iriv WITH (NoLock) ON iri.RecId = iriv.InventoryReceiptItemId LEFT OUTER JOIN
                      dbo.Erp_InventoryVariant AS iv WITH (NoLock) ON iv.RecId = iriv.InventoryVariantId LEFT OUTER JOIN
                      dbo.Erp_Warehouse AS wh WITH (NoLock) ON ir.OutWarehouseId = wh.RecId LEFT OUTER JOIN
                      dbo.Erp_Warehouse AS whi WITH (NoLock) ON ir.InWarehouseId = whi.RecId LEFT OUTER JOIN
                      dbo.Erp_WorkOrderItem AS woi WITH (NoLock) ON woi.RecId = iri.WorkOrderReceiptItemId LEFT OUTER JOIN
                      dbo.Erp_WarehouseLocation AS whl ON whl.RecId = iri.InWarehouseLocationId LEFT OUTER JOIN
                      dbo.Erp_WorkOrder AS wo WITH (NoLock) ON wo.RecId = woi.WorkOrderId LEFT OUTER JOIN
                      dbo.Erp_CurrentAccount AS cu WITH (NoLock) ON cu.RecId = ir.CustomerId LEFT OUTER JOIN
                      dbo.Erp_CurrentAccount AS ca WITH (NoLock) ON ca.RecId = ir.CurrentAccountId LEFT OUTER JOIN
                      dbo.Erp_LabRecipe AS lab WITH (NoLock) ON lab.RecId = iri.LabRecipeId LEFT OUTER JOIN
                      dbo.Erp_LabRecipe AS labw WITH (NoLock) ON labw.RecId = woi.LabRecipeId
WHERE     (ir.ReceiptDate BETWEEN '".$tarihsifir."' AND '".$tarihsifir."') AND (ir.InWarehouseId IS NOT NULL) AND 
                      (whi.WarehouseName = 'İplik Depo') AND ir.ReceiptType = 1
ORDER BY [Fiş Tarihi], ir.RecId, iri.ItemOrderNo");

							  foreach ($iplikdepogiris as $idgiris) {
									@$toplamdegeridg += $idgiris["Net"];
								}
							

                            echo @number_format($toplamdegeridg,0,',','.'). " KG";




                             ?>



                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>



              <!-- Alt Eleman -->


              <div class="itemc mb-4">


              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">GÜNLÜK İPLİK DEPO ÇIKIŞ</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                            <?php



                             $iplikdepocikis = $database->query("Select ir.RecId, iri.ReceiptType,iri.ItemOrderNo as Satır,
  Case iri.ReceiptType When 17 Then 'Depo Transfer Fişi'
    When 16 Then 'Sayım Fişi' When 134 Then 'Fason Çıkış İrsaliyesi'
    When 1 Then 'Satınalma İrsaliyesi' When 11 Then 'Fason Giriş İrsaliyesi'
    When 10 Then 'Üretim Fişi' When 120 Then 'Toptan Satış İrsaliyesi'
	When 129 Then 'Üretime Çıkış Fişi'
  End As 'Fiş Türü',
isnull(wh.WarehouseCode,'') as [Çıkış Depo Kodu],
isnull(wh.WarehouseName,'') as [Çıkış Depo Adı],
isnull(whi.WarehouseCode,'') as [Giriş Depo Kodu],
isnull(whi.WarehouseName,'') as [Giriş Depo Adı],
  ir.ReceiptNo As [Fiş No],
  isnull(ca.CurrentAccountCode, '') As [Cari Kodu],
  isnull(ca.CurrentAccountName, '') As [Cari Adı],
  isnull(cu.CurrentAccountName, '') As [Müşteri],
  ir.ReceiptDate As [Fiş Tarihi],
  inv.InventoryCode [Stok Kodu],
  inv.InventoryName [Stok Adı],
  isnull(iri.UD_IplikRengi, '') As [İplik Rengi],
  isnull(iri.UD_CizgiRengi, '') As [Cizgi Rengi],
  ISNULL(lab.LabRecipeCode,'') as[Renk Kodu],
  ISNULL(lab.LabRecipeName,'') as[Renk Adi],
  isnull(iri.UD_HamRenk, '') As [Ham Renk],
  isnull(iri.ud_Olculer, '') As [Ölçüler],
  isnull(iri.UD_PlanlananMakina, '') As [Planlanan Makina],
  isnull(iri.CustomerOrderNo, '') As [Müşteri Parti No],
  isnull(iri.PartyNo, '') As [Parti No],
  isnull(iri.Explanation, '') As Açıklama,
  isnull(iri.WorkOrderReceiptItemId, 0) As [Üretim Emri Satır No],
  isnull(woi.ItemOrderNo, '') As [Üretim Emri Satır Sıra No],
  isnull(wo.WorkOrderNo, '') As [Üretim Emri],
  isnull(mnf.Explanation, '') As [Üretim Tipi],
    Case wo.RepairType When 1 Then 'Hayır' When 2 Then 'İç Tamir' When 3 Then 'Dış Tamir'
    Else '' End As [Tamir Tipi],
  isnull(iri.FabricPus,'') as [Pus],
  isnull(iri.FabricFein,'') as [Fayn],
  isnull(iri.FabricDenier, '') As [İplik Denye],
  isnull(iri.FabricFilament, '') As Flament,

  isnull(iri.UD_PamukOrani, '') As [Pamuk Orani],
  isnull(iri.UD_PolyesterOrani, '') As [Polyester Orani],
  ISNULL(qControl.ProductWidth,0) as [Gelen En],
  ISNULL(qControl.ProductGram,0) as [Gelen Grm],
  isnull(iri.UD_Tedarikci, '') As Tedarikçi,
  isnull(cu.CurrentAccountName, '') As Müşteri,
  isnull(iri.UD_IplikLot, '') As [İplik Lot],
  isnull(iri.UD_PaketBirimi, '') As [Paket Birimi],
  isnull(iri.PackageQuantity, 0) As [Paket Adedi],
  isnull(iri.NetQuantity, 0) As Net,
  isnull(iri.GrossQuantity, 0) As Brüt,
    Case  when iri.GrossQuantity>0 then (((iri.GrossQuantity - iri.NetQuantity)/iri.GrossQuantity)*100)
  else 0
  end  as Fire

From Erp_InventoryReceiptItem iri With(NoLock)
  Left Join Erp_InventoryReceipt ir With(NoLock) On iri.InventoryReceiptId =
    ir.RecId
  Left Join Erp_Inventory inv With(NoLock) On inv.RecId = iri.InventoryId
  Left Outer Join Erp_InventoryReceiptItemVariant iriv With(NoLock)
    On iri.RecId = iriv.InventoryReceiptItemId
  Left Outer Join Erp_InventoryVariant iv With(NoLock) On iv.RecId =
    iriv.InventoryVariantId
  Left Outer Join Erp_Warehouse wh With(NoLock) On ir.OutWarehouseId = wh.RecId
  Left Outer Join Erp_Warehouse whi With(NoLock) On ir.InWarehouseId = whi.RecId
  Left Outer Join Erp_WorkOrderItem woi With(NoLock) On woi.RecId =
    iri.WorkOrderReceiptItemId
  Left Outer Join Erp_WorkOrder wo With(NoLock) On wo.RecId = woi.WorkOrderId
  Left Outer Join Erp_CurrentAccount As cu With(NoLock) On cu.RecId =
    ir.CustomerId
  Left Outer Join Erp_CurrentAccount As ca With(NoLock) On ca.RecId =
    ir.CurrentAccountId
  Left Outer Join Erp_LabRecipe  as lab With(NoLock) on lab.RecId = iri.LabRecipeId
  left outer join Erp_ManufacturingType as mnf on mnf.RecId = wo.ManufacturingTypeId

OUTER APPLY (
    Select top 1 *
    From Erp_CurrentAccount As wcu
    WHERE wcu.RecId= ir.CustomerId
    ) cus
	outer apply(select top 1* from   Erp_QualityControl as qlty where qlty.WorkOrderItemId = woi.RecId) qControl

	where ir.ReceiptDate between '".$tarihsifir."'  and '".$tarihsifir."'   and ir.OutWarehouseId = 13 and ir.InWarehouseId = 14





   Order By ir.ReceiptNo, iri.ItemOrderNo");


          foreach ($iplikdepocikis as $idp) {
            @$toplamdeger += $idp["Net"];
          }

          echo number_format($toplamdeger, 0, ',', '.'). " KG";


                             ?>



                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>

              <!-- Alt Eleman Bitti -->
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-1-5 mb-4">
              <div class="itemc mb-4">


              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">HAM DEPO GÜNLÜK GİRİŞ</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php

                        $hamdepogunlukgiris = $database->query("SELECT SUM(Quantity) as toplam FROM Erp_InventoryReceiptItem where (ReceiptType=10 or ReceiptType=11 or ReceiptType=1 or ReceiptType=12) and InWarehouseId=16 and ReceiptDate= '".$tarihsifir."'")->fetchAll();
                        echo number_format($hamdepogunlukgiris[0]["toplam"],0,',','.'). " KG";
                        ?>


                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hand-point-right fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>


              <div class="itemc">


              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">HAM DEPO GÜNLÜK ÇIKIŞ</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php



                       $hamdepogunlukcikis = $database->query("select ((SELECT isnull(SUM(Quantity),0) as toplam FROM Erp_InventoryReceiptItem where (ReceiptType=134 or ReceiptType=120) and OutWarehouseId=16 and ReceiptDate='".$tarihsifir."') + (SELECT sum(Quantity) as toplam FROM [SentezLive].[dbo].[Erp_WorkOrderProduction] where ProcessId=2 and StartProductionDate='".$tarihsifir."')) as toplam")->fetchAll();

                       echo number_format($hamdepogunlukcikis[0]["toplam"],0,',','.'). " KG";


                       ?>

</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hand-point-left fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>




            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-1-5 mb-4 ">

              <div class="itemc mb-4">


              <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">MAMUL KUMAŞ GÜNLÜK GİRİŞ</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php

                        $mamuldepogunlukgiris = $database->query("select(
(SELECT isnull(SUM(Quantity),0) as toplam FROM [SentezLive].[dbo].[Erp_InventoryReceiptItem] where ReceiptType=11  and InWarehouseId=19 and ReceiptDate='".$tarihsifir."')
+
(SELECT sum(Quantity) as toplam FROM [SentezLive].[dbo].[Erp_WorkOrderProduction] where ProcessId=27 and StartProductionDate='".$tarihsifir."')) as toplam")->fetchAll();
                        echo number_format($mamuldepogunlukgiris[0]["toplam"],0,',','.'). " KG";

                         ?>

                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chevron-right fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>



              <div class="itemc mb-4">


              <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">MAMUL KUMAŞ GÜNLÜK ÇIKIŞ</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php

                        $mamuldepogunlukcikis = $database->query("SELECT SUM(Quantity) as toplam FROM Erp_InventoryReceiptItem where ReceiptType=120 and OutWarehouseId=19 and ReceiptDate='".$tarihsifir."'")->fetchAll();
                        echo number_format($mamuldepogunlukcikis[0]["toplam"],0,',','.'). " KG";

                         ?>

                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chevron-left fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
              </div>


<?php

	}
	?>




            </div>




</div>
</div>



<?php 

include 'footer.php';

?>


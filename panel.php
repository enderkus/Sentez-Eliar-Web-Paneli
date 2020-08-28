<?php
include 'header.php';
include 'db.php';
?>



        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ANA SAYFA</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class=" col-1-5 mb-4">
              <div class="itemc">


              <div class="card border-left-primary shadow h-100 py-2 mb-4">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">AKTİF ÖRGÜ MAKİNELERİ</div>
                      <?php

                      $orgumakinesay = $database->count("OrguRun");


                      ?>
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

                                    $gunekle =  strtotime("+1 day");
                                    $bugunsekiz = date("Y-m-d")." 08:0:0.000";
                                    $yarinsekiz = date("Y-m-d",$gunekle)." 08:0:0.000";



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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">BOYAHANE AKTİF MAKİNELER</div>
                      <?php

                      $boyahanecalisan = $database2->count("BADATA",[
                        "ENDTIME" => NULL,
                        "CANCELTIME" => NULL,
                      ]);

                      ?>

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

                      $gunekle =  strtotime("+1 day");
                      $bugunsekiz = date("Y-m-d")." 08:0:0.000";
                      $yarinsekiz = date("Y-m-d",$gunekle)." 08:0:0.000";



                      $boyahanegunluktoplam = $database->sum("Erp_WorkOrderProduction","Quantity",

                         [
                           "ProductionTime[<>]"=>[$bugunsekiz,$yarinsekiz],
                           "ResourceId[<>]"=>["172","199"]

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



                            $iplikdepogiris = $database->sum("IplikGunlukGiris","Net",[
							"ReceiptType" => "1",
							])." KG";
                            echo @number_format($iplikdepogiris,0,',','.'). " KG";




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

	where ir.ReceiptDate between CONVERT(DATE, GETDATE())  and CONVERT(DATE, GETDATE())   and ir.OutWarehouseId = 13 and ir.InWarehouseId = 14





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

                        $hamdepogunlukgiris = $database->query("SELECT SUM(Quantity) as toplam FROM Erp_InventoryReceiptItem where (ReceiptType=10 or ReceiptType=11 or ReceiptType=1 or ReceiptType=12) and InWarehouseId=16 and ReceiptDate=CONVERT(DATE, GETDATE())")->fetchAll();
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



                       $hamdepogunlukcikis = $database->query("select ((SELECT isnull(SUM(Quantity),0) as toplam FROM Erp_InventoryReceiptItem where (ReceiptType=134 or ReceiptType=120) and OutWarehouseId=16 and ReceiptDate=CONVERT(DATE, GETDATE())) + (SELECT sum(Quantity) as toplam FROM [SentezLive].[dbo].[Erp_WorkOrderProduction] where ProcessId=2 and StartProductionDate=CONVERT(DATE, GETDATE()))) as toplam")->fetchAll();

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
(SELECT isnull(SUM(Quantity),0) as toplam FROM [SentezLive].[dbo].[Erp_InventoryReceiptItem] where ReceiptType=11  and InWarehouseId=19 and ReceiptDate=CONVERT(DATE, GETDATE()))
+
(SELECT sum(Quantity) as toplam FROM [SentezLive].[dbo].[Erp_WorkOrderProduction] where ProcessId=27 and StartProductionDate=CONVERT(DATE, GETDATE()))) as toplam")->fetchAll();
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

                        $mamuldepogunlukcikis = $database->query("SELECT SUM(Quantity) as toplam FROM Erp_InventoryReceiptItem where ReceiptType=120 and OutWarehouseId=19 and ReceiptDate=CONVERT(DATE, GETDATE())")->fetchAll();
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




            </div>








          </div>

          <!-- Content Row -->




          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">ÖRGÜ ÜRETİM CETVELİ</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>

              <!-- Boyahane Cetveli -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">BOYAHANE ÜRETİM CETVELİ</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="boyahanechart"></canvas>
                  </div>
                </div>
              </div>
              <!-- Boyahane Cetveli Bitti -->



            </div>

            <!-- Pie Chart -->

          </div>

      

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



<?php include 'footer.php'; ?>

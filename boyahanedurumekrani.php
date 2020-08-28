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
   <h1 class="h3 mb-4 text-gray-800">BOYAHANE DURUM EKRANI</h1>

<div class="row">


                  
    <?php

    
	 $calisanmakineler = $database2->query("SELECT * FROM TFMACHINESTATUS WHERE RUNNING_JOBORDERSTARTTIME IS NOT NULL")->fetchAll();
	 
	 foreach($calisanmakineler as $cm) {
		 $makineid = $cm["MACHINEID"];
		 $makinekodu = $database2->query("SELECT MACHINECODE FROM BFMACHINES WHERE MACHINEID = '".$makineid."'")->fetchAll();
		 $isemribilgileri = $database->select("Erp_WorkOrder","*",[
		 "WorkOrderNo" => str_replace(' ','',$cm["RUNNING_JOBORDER"]),
		 ]);
		 
		 $musteriadi = $database->select("Erp_CurrentAccount","CurrentAccountName",[
		 "RecId" => str_replace(' ','',$isemribilgileri[0]["CurrentAccountId"]),
		 ]);
		 
	
		
		 

		 
		
	
	
	


    ?>


<div class='col-xl-3  p-3' >


        <div class="bg-white rounded-lg p-5 shadow border-bottom-success">
          <h2 class="h6 font-weight-bold text-center mb-4"><?= $cm["RUNNING_JOBORDER"]; ?></h2>
          <hr>
          <p class="font-weight-bold text-center" data-toggle="tooltip" data-placement="top" title="<?= $makinekodu[0]["MACHINECODE"] ?>"><?= str_replace(' ','',$makinekodu[0]["MACHINECODE"]); ?>(<?= $makineid; ?>)</p>
          <p class="font-weight-bold text-center">Müşteri : <?= $musteriadi[0]; ?></p>
		  <p class="font-weight-bold text-center">M.Sipariş No : <?= $isemribilgileri[0]["CustomerOrderNo"]; ?></p>

          <!-- Progress bar 1 -->
          <div class="progress mx-auto" data-value='<?= $cm["runningCompletionRatio"]; ?>'>
            <span class="progress-left">
                          <span class="progress-bar border-success"></span>
            </span>
            <span class="progress-right">
                          <span class="progress-bar border-success"></span>
            </span>
            <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
              <div class="h2 font-weight-bold"><?= $cm["runningCompletionRatio"]; ?></div>
            </div>
          </div>
          <!-- END -->

          <!-- Demo info -->
          <div class="row text-center mt-4">
			<p class="bold">BAŞLANGIÇ : <?= $cm["RUNNING_JOBORDERSTARTTIME"]; ?></p>
			
			<p class="bold">PROGRAM : <?= $cm["RUNNING_PROGRAMNAME"]; ?></p>
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

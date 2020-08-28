<?php

include 'header.php';
include 'db.php';

 ?>

<link rel="stylesheet" href="vendor/datatables/dataTables.bootstrap4.min.css">

 <div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">BOYAHANE DURUM TABLOSU</h1>
   <table class="table table-striped table-responsive table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Makine Numarası</th>
      <th scope="col">İş Emri</th>
	  <th scope="col">Başlangıç Tarih / Saat</th>
      <th scope="col">Mevcut İşlem</th>
	  <th scope="col">İlerleme</th>
      <th scope="col">Müşteri</th>
	  <th scope="col">Müşteri Sipariş Numarası</th>
    </tr>
  </thead>
  <tbody>

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
		 
	
		
		 

		 
		 
		 echo '<tr>
        
        <td>'.str_replace(' ','',$makinekodu[0]["MACHINECODE"]).'-('.$makineid.')</td>
		<td>'.$cm["RUNNING_JOBORDER"].'</td>
		<td>'.$cm["RUNNING_JOBORDERSTARTTIME"].'</td>
		<td>'.$cm["RUNNING_PROGRAMNAME"].'</td>
		<td>%'.$cm["runningCompletionRatio"].'</td>
		<td>'.$musteriadi[0].'</td>
		<td>'.$isemribilgileri[0]["CustomerOrderNo"].'</td>
		</tr>';
	 }
	
	
	


    ?>



  </tbody>
   <tfoot>
            <tr>
      <th scope="col">Makine Numarası</th>
      <th scope="col">İş Emri</th>
	  <th scope="col">Başlangıç Tarih / Saat</th>
      <th scope="col">Mevcut İşlem</th>
	  <th scope="col">İlerleme</th>
      <th scope="col">Müşteri</th>
	  <th scope="col">Müşteri Sipariş Numarası</th>
    </tr>
        </tfoot>
</table>

</div>

 <?php
 include 'footer.php';
  ?>

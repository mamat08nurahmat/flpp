<!--========================= Content Wrapper ==============================-->
<!----
<div class="container">
    <h1 class="text-info" style="text-align: center">Upload</h1><br>
</div>

<?php
//$tabel_detail;
?>

-->	
<table class="table table-bordered table-striped">

    <thead>
	
	<tr style="background-color: grey;" >
	<td>NO</td>
	<td>Nama Pemohon</td>
	<td>No KTP Pemohon</td>
	<td>Tanggal Akad</td>
	<td>Nilai KPR</td>
	<td>Tenor</td>
	<td>Batch</td>
	<td>AKSI</td>
	</tr>
		
	</thead>
	
    <tbody>
    <?php
    $no=1;
    if(isset($data_generate)){
        foreach($data_generate as $row){
    ?>	
	<tr class="gradeX">
	<td><?php echo $no; ?></td>
	<td><?php echo $row->NAMA_PEMOHON; ?></td>
	<td><?php echo $row->NO_KTP_PEMOHON; ?></td>
	<td><?php echo $row->TGL_AKAD; ?></td>
	<td><?php echo currency_format($row->NILAI_KPR); ?></td>
	<td><?php echo $row->TENOR; ?></td>
	<td><?php echo $row->batch_id; ?></td>
	<td>
                    <a class="btn btn-mini" href="<?php echo site_url('laporan/get_detail_id/'.$row->NO_KTP_PEMOHON);?>"
                       target="new_blank"> <i class="icon-file"></i> Detail</a>
	||
                    <a class="btn btn-mini" href="<?php echo site_url('excel_export/get_detail_id/'.$row->NO_KTP_PEMOHON);?>"
                       target="_self"> <i class="icon-file"></i> Export</a>	
	</td>
	
   </tr>
  <?php
$no++;  
    }
   }
    ?>		
	</tbody>
<!--
-->

	
<!---
        <div class="navbar hidden-print">
            <div class="">
                <div class="container">
                    <ul class="nav">
                        <li class="">
                            <a href=""></i> </a>
                        </li>
                        <li class="">
                            <img src="<?php echo base_url();?>asset/img/tapcash.jpg" alt="..." class="img-circle profile_img"   >
                        </li>
                        <li class="">
                            <a href=""></i> </a>
                        </li>
                        <li class="">
                           <h2>Hi, <?php echo $this->session->userdata("NAME"); ?></h2>
                           <h3>You're login</h3>
                        </li>
                        <li class="">
                            <a href=""></i> </a>
                        </li>
                    </ul>
                </div>
            </div>
--->
        </div>
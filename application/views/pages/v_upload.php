<!--========================= Content Wrapper ==============================-->

<center>

<form action="<?php echo base_url(); ?>index.php/upload/import" method="post" name="upload_excel" enctype="multipart/form-data">
<table>
<tr>
	<td>Batch : <input type="text" name="batch_id" value="<?=$batch_id;?>" ></td>	
	<td colspan='8'></td>

</tr>
</table>
<input type="file" name="file" id="file">
<button type="submit" id="submit" name="import" class="btn btn-primary button-loading">Import</button>
</form>
<a href="<?php echo base_url(); ?>upload_csv.csv"> Sample csv file </a>
</center>


<table class="table table-bordered table-striped">

    <thead>
	
	<tr style="background-color: grey;" >
	<td>NO</td>
	<td>Nama Pemohon</td>
	<td>No KTP Pemohon</td>
	<td>Nilai KPR</td>
	<td>Tenor</td>
	<td>Batch</td>
<!--
	<td>Harga Rumah</td>
	<td>Bach Upload</td>
-->	
	</tr>
		
	</thead>
	
    <tbody>
    <?php
    $no=1;
    if(isset($dt_upload)){
        foreach($dt_upload as $row){
    ?>	
	<tr class="gradeX">
	<td><?php echo $no; ?></td>
	<td><?php echo $row->NAMA_PEMOHON; ?></td>
	<td><?php echo $row->NO_KTP_PEMOHON; ?></td>
	<td><?php echo currency_format($row->NILAI_KPR); ?></td>
	<td><?php echo $row->TENOR; ?></td>
	<td><?php echo $row->batch_id; ?></td>
   </tr>
  <?php
$no++;  
    }
   }
    ?>		
	</tbody>
	
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
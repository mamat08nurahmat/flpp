<!--========================= Content Wrapper ==============================-->

<?php
/*
*/

//print_r($no_ktp);
/*
*/
$linksz = array(
//''.base_url("index.php/report/get_generate_id/6303055011870017").'', 
//''.base_url("index.php/report/get_generate_id/6303055011870017").'', 
//''.base_url("index.php/report/get_generate_id/6303055011870017").'', 
//''.base_url("index.php/report/get_generate_id/6303055011870017").'', 
''.base_url().'' ,
''.base_url().'' 

);
//print_r($linksz);die();
$links = $data_link;



$open = '';
foreach ($links as $link) {
$open .= "window.open('{$link}','_blank'); ";
 
//$open .="document.write('Generate...');";	
//$open .= "window.open('http://www.google.com','_blank'); ";
//$open .="setTimeout('window.location = 'http://www.google.com';,5000');";	

}

echo "<a href=\"#\" onclick=\"{$open}\" id='target'>
<button  class='btn btn-info'><i class='icon icon-white icon-search'></i> GENERATE</button>

</a>";
/*
*/

?>	


<table class="table table-bordered table-striped">

    <thead>
	
	<tr style="background-color: grey;" >
	<td>NO</td>
	<td>Nama Pemohon</td>
	<td>No KTP Pemohon</td>
	<td>Tanggal Akad</td>
	<td>Nilai KPR</td>
	<td>Tenor</td>
<!--
	<td>AKSI</td>
-->	
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
	<td><?php echo $row->NILAI_KPR; ?></td>
	<td><?php echo $row->TENOR; ?></td>
<!---
	<td>
                    <a class="btn btn-mini" href="<?php echo site_url('laporan/get_detail_id/'.$row->NO_KTP_PEMOHON);?>"
                       target="new_blank"> <i class="icon-file"></i> Detail</a>
	</td>
-->	
	
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
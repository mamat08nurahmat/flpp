<!--========================= Content Wrapper ==============================-->
<div class="container">
    <h1 class="text-info" style="text-align: center">Upload CSV</h1><br>
</div>
        <div class="navbar hidden-print">
            <div class="">
                <div class="container">
<!---
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
-->				

<table>
  <tr>
<!---
    <th>No</th>
-->  
	
    <th>No</th>
    <th>Nama Pemohon</th>
    <th>No KTP Pemohon</th>
    <th>Nilai KPR</th>
    <th>Tenor</th>
    <th>Harga Rumah</th>
    <th>Batch Upload</th>
<!--
    <th>Date</th>
-->	
	
  </tr>
<?php
if(isset($view_data) && is_array($view_data) && count($view_data)): 
$i=1;
foreach ($view_data as $key => $data) { 
?>
  <tr>
<!--
    <td><?php echo $data['no_id'] ?></td>
-->  
	
    <td><?php echo $i ?></td>
    <td><?php echo strtoupper($data['NAMA_PEMOHON']) ?></td>
    <td><?php echo $data['NO_KTP_PEMOHON'] ?></td>
    <td><?php echo $data['NILAI_KPR'] ?></td>
    <td><?php echo $data['TENOR'] ?></td>
    <td><?php echo $data['HARGA_RUMAH'] ?></td>
    <td><?php echo $data['batch_id'] ?></td>
<!---
    <td><?php echo $data['created_date'] ?></td>
-->	
	
  </tr>
  <?php $i++; } endif; ?>
</table>



                </div>
            </div>
        </div>
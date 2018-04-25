<title>Import bulk data insert in database using php codeigniter </title>
<style>
table {
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#fff;
}
table#t01 th {
    background-color: black;
    color: white;
}
</style>
<?php if($this->session->flashdata('message')){?>
          <div align="center" class="alert alert-success">      
            <?php echo $this->session->flashdata('message')?>
          </div>
        <?php } ?>

<br><br>

<div align="center">
<form action="<?php echo base_url(); ?>index.php/uploadcsv/import" method="post" name="upload_excel" enctype="multipart/form-data">
<input type="file" name="file" id="file">
<button type="submit" id="submit" name="import" class="btn btn-primary button-loading">Import</button>
</form>
<br>
<br>
<a href="<?php echo base_url(); ?>sample.csv"> Sample csv file </a>
<br><br>

<div style="width:80%; margin:0 auto;" align="center">
<?php
$data_output;
?>
<!---
<table id="t01">
  <tr>
	
    <th>No</th>
    <th>Nama Pemohon</th>
    <th>Pekerjaan</th>
    <th>Nilai KPR</th>
    <th>Tenor</th>
    <th>Harga Rumah</th>
	
  </tr>
<?php
if(isset($view_data) && is_array($view_data) && count($view_data)): 
$i=1;
foreach ($view_data as $key => $data) { 
?>
  <tr>
	
    <td><?php echo $i ?></td>
    <td><?php echo $data['NAMA_PEMOHON'] ?></td>
    <td><?php echo $data['PEKERJAAN_PEMOHON'] ?></td>
    <td><?php echo $data['NILAI_KPR'] ?></td>
    <td><?php echo $data['TENOR'] ?></td>
    <td><?php echo $data['HARGA_RUMAH'] ?></td>

	
  </tr>
  <?php $i++; } endif; ?>
</table>
-->  
</div>

</div>
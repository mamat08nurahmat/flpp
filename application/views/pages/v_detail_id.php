NAMA PEMOHON : <?=$nama_pemohon;?><br>
TENOR : <?=$tenor;?><br>
NILAI FLPP :<?=currency_format($nilai_flpp);?>

<!----
                    <a href="<?php //echo site_url('excel_export/download_detail/'.$data_detail_id);?>"
                       target="new_blank"> Export</a>
-->

<table class="table table-bordered table-striped">

    <thead style="background-color: grey;"  >

	<tr>
	<td>NO</td>
	<td>TAHUN</td>
	<td>BULAN</td>
	<td>OUTSTANDING</td>
	<td>ANGSURAN POKOK</td>
	<td>ANGSURAN BUNGA</td>
	<td>ANGSURAN TOTAL</td>
	</tr>


	</thead>

    <tbody>
    <?php
    $no=1;
    if(isset($data_detail_id)){
$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember','Desember');

//-------------
//tr looping
$no=1;
$sum_outstanding=0;
$sum_pokok=0;
$sum_bunga=0;
$sum_total=0;

//print_r($data_detail_id);die();
foreach($data_detail_id as  $name => $value ){

$outstanding = $value['outstanding'];
$angsuran_pokok = $value['angsuran_pokok'];
$angsuran_bunga = $value['angsuran_bunga'];
$angsuran_total = $value['angsuran_total'];

$sum_outstanding += $value['outstanding'];
$sum_pokok += $value['angsuran_pokok'];
$sum_bunga += $value['angsuran_bunga'];
$sum_total += $value['angsuran_total'];

$sum_outstanding1 = $sum_outstanding;
$sum_pokok1 = $sum_pokok;
$sum_bunga1 = $sum_bunga;
$sum_total1 = $sum_total;


    ?>
	<tr class="gradeX">
	<td align="center"><?php echo $no; ?></td>
	<td align="right"><?php echo $value['tahun']; ?></td>
	<td align="right"><?php echo $nama_bln[$value['bulan']]; ?></td>
	<td align="right"><?php echo currency_format($outstanding); ?></td>
	<td align="right"><?php echo currency_format($angsuran_pokok); ?></td>
	<td align="right"><?php echo currency_format($angsuran_bunga); ?></td>
	<td align="right"><?php echo currency_format($angsuran_total); ?></td>
   </tr>
  <?php
$no++;
    }
?>

	<tr>
	<td colspan="3">TOTAL</td>

	<td align="right"><?php echo currency_format($sum_outstanding1); ?></td>
	<td align="right"><?php echo currency_format($sum_pokok1); ?></td>
	<td align="right"><?php echo currency_format($sum_bunga1); ?></td>
	<td align="right"><?php echo currency_format($sum_total1); ?></td>

   </tr>

<?php
   }
    ?>


<!---
	<tr>
	<td colspan="4">TOTAL</td>


	<td><?php echo round($row->angsuran_pokok,0); ?></td>
	<td><?php echo round($row->estimasi_angsuran,0); ?></td>
	<td><?php echo round($row->angsuran_sisa,0); ?></td>

   </tr>
-->

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

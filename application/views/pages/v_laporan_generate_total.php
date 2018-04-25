<!--
<form method="post" action="<?= site_url('excel_export/cari_total')?>" >
-->
<form method="post" action="<?= site_url('laporan/excel')?>" >

<h3>BATCH</h3>
<input name="batch_id" type="text" readonly value="<?php echo $batch_id ; ?>" >
<br>
<button type="subbmit"><i class="icon-file"></i> Export</button>
</form>
<table class="table table-bordered table-striped">

    <thead style="background-color: grey;"  >
	<tr>
	<td>NO</td>
	<td colspan="2">BULAN</td>
	<td>OUTSTANDING POKOK</td>
	<td>ANGSURAN POKOK</td>
	<td>ESTIMASI ANGSURAN TARIF</td>
	<td>SISA POKOK</td>
	</tr>

	<tr>
	<td>1</td>
	<td colspan="2">2</td>
	<td>3</td>
	<td>4</td>
	<td>5</td>
	<td>6=3-4</td>
	</tr>

	</thead>

    <tbody>
    <?php
    $no=1;
    if(isset($data_generate)){
$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember','januari');
//print_r($data_generate[0]['total_dana']);
//-------------
//tr looping
$no=1;
$sum_angsuran_pokok1=0;
$sum_estimasi_angsuran_tarif1=0;

//print_r($data_generate);die();
foreach($data_generate as  $row ){
//print_r($row['bulan']);

	$outstanding_pokok ="Rp. ".number_format(round($row['sum_outstanding'],9),0,',','.');
	$angsuran_pokok ="Rp. ".number_format(round($row['total_dana'],9),0,',','.');
	$estimasi_angsuran_tarif ="Rp. ".number_format(round($row['sum_angsuran_bunga'],9),0,',','.');
	$sisa_pokok ="Rp. ".number_format(round($row['sum_outstanding']-$row['total_dana'],9),0,',','.');

$sum_angsuran_pokok1 +=round($row['total_dana'],9);

$sum_estimasi_angsuran_tarif1 +=round($row['sum_angsuran_bunga'],9);


	$sum_angsuran_pokok ="Rp. ".number_format($sum_angsuran_pokok1,0,',','.');
	$sum_estimasi_angsuran_tarif ="Rp. ".number_format($sum_estimasi_angsuran_tarif1,0,',','.');

//$angsuran_sisa = $row['sum_outstanding'] - $row['total_dana'];
//print_r($angsuran_sisa);
/*
*/

    ?>

<!--
	<tr class="gradeX">
	<td><?php echo $no; ?></td>
	<td><?php echo $row['tahun']; ?></td>
	<td><?php echo $nama_bln[$row['bulan']]; ?></td>
	<td><?php echo currency_format(round($row['sum_outstanding'],0)); ?></td>
	<td><?php echo currency_format(round($row['total_dana'],0)); ?></td>
	<td><?php echo currency_format(round($row['sum_angsuran_bunga'],0)); ?></td>
	<td><?php echo currency_format(round($angsuran_sisa,0)); ?></td>
   </tr>
-->
	<tr class="gradeX">
	<td><?php echo $no; ?></td>
	<td><?php echo $row['tahun']; ?></td>
	<td><?php echo $nama_bln[$row['bulan']]; ?></td>
	<td><?php echo $outstanding_pokok; ?></td>
	<td><?php echo $angsuran_pokok; ?></td>
	<td><?php echo $estimasi_angsuran_tarif; ?></td>
	<td><?php echo $sisa_pokok; ?></td>
   </tr>

  <?php
$no++;
    }
   }
    ?>


	<tr>
	<td colspan="4">TOTAL</td>

<!--
	<td><?php// echo currency_format(round($sum_angsuran_pokok,0)); ?></td>
	<td><?php// echo currency_format(round($sum_estimasi_angsuran_tarif,0)); ?></td>
-->
	<td><?php echo $sum_angsuran_pokok; ?></td>
	<td><?php echo $sum_estimasi_angsuran_tarif; ?></td>

	<td></td>

   </tr>
<!---
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

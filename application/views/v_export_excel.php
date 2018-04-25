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

	$outstanding_pokok =round($row['sum_outstanding'],9);
	$angsuran_pokok =round($row['total_dana'],9);
	$estimasi_angsuran_tarif =round($row['sum_angsuran_bunga'],9);
	$sisa_pokok =round($row['sum_outstanding']-$row['total_dana'],9);

$sum_angsuran_pokok1 +=round($row['total_dana'],9);

$sum_estimasi_angsuran_tarif1 +=round($row['sum_angsuran_bunga'],9);


	$sum_angsuran_pokok =$sum_angsuran_pokok1;
	$sum_estimasi_angsuran_tarif =$sum_estimasi_angsuran_tarif1;

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
	<td><?php echo round($row['sum_outstanding'],0); ?></td>
	<td><?php echo round($row['total_dana'],0); ?></td>
	<td><?php echo round($row['sum_angsuran_bunga'],0); ?></td>
	<td><?php echo round($angsuran_sisa,0); ?></td>
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
	
</table>	
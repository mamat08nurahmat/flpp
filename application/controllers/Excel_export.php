<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_export extends CI_Controller {


    function __construct(){
        parent::__construct();
/*
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','Maaf, Anda tidak diperbolehkan masuk tanpa login !');
            redirect('');
        };
*/
        $this->load->model('model_app');
   $this->load->helper('currency_format_helper');

    }



	function index()
	{
		$this->load->model("excel_export_model");

		        $this->load->model('model_app');


		$data["isi_data"] = $this->excel_export_model->fetch_data();
		$this->load->view("excel_export_view", $data);
	}

//=====

function get_detail_id($no_ktp_pemohon){
//print_r($no_ktp_pemohon);die();

     $id['no_ktp_pemohon']=$no_ktp_pemohon;
//       $id['batch_id']='001';
/*

        $data=array(
            'detail_data'=>$this->model_app->getSelectedData('upload_verivikasi',$id)->result(),
        );
*/
            $detail_data = $this->model_app->getSelectedData('upload_verivikasi',$id)->result();
//print_r($detail_data[0]);die();
$nama_pemohon= $detail_data[0]->NAMA_PEMOHON;
$tenor= $detail_data[0]->TENOR;
$nilai_flpp= $detail_data[0]->NILAI_FLPP;

            $detail_data = $this->model_app->getSelectedData('upload_verivikasi',$id)->result();
//============
//$tenor =10;
$tenor =$detail_data[0]->TENOR; //tenor

$nama_pemohon =$detail_data[0]->NAMA_PEMOHON; //nama_pemohon
$nilai_kpr =$detail_data[0]->NILAI_KPR; //nama_pemohon
$tgl_akad =$detail_data[0]->TGL_AKAD; //tgl_akad

$bunga2 =$detail_data[0]->SUKU_BUNGA_KPR; //bunga
//$bunga = $bunga2 /100;
$bunga = $bunga2 ;
/*
print_r("NAMA_PEMOHON :");
print_r($nama_pemohon);
print_r("<br>");
print_r("TANGGAL AKAD : ");
print_r($tgl_akad);
*/
/*
die();
*/

$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember','Januari');
//memecah tanggal dari sistem jadi $tanggal,$bulan,$tahun…
$orderdate = explode('/', $tgl_akad);
$month_1   = $orderdate[0]; //bulan
$day  = $orderdate[1];      //tanggal
$year_1 = $orderdate[2];    //tahun

//menghilangkan 0 depan angka
if ($month_1< 10) {
$month_1=str_replace("0",'',$month_1);
}else{
$month_1=$month_1;
}

$tahun = $year_1;
//$bulan = $nama_bln[$month_1];
$bulan = $month_1+1;
/*
print_r($tahun);
print_r("-");
print_r($nama_bln[$bulan]);
*/
/*
die();
*/
//----------------------------------
//$nilai_kpr = 128000000;

//$tenor =120 ;
$outstanding1 = $nilai_kpr;

		$angsuran_pokok1 = $nilai_kpr*(($bunga/12)/(1-pow((($bunga/12)+1),-$tenor)))-($bunga*($nilai_kpr/12)) ; //=====5


		$angsuran_bunga1=$nilai_kpr*$bunga/12; //===6

		$angsuran_total1 = $angsuran_pokok1+$angsuran_bunga1; //=====7

//--------------------------------------------------
 $array[] = array(
  "no" => 1,
  "tahun" => $tahun,
//  "bulan" =>$nama_bln[$bulan],
  "bulan" =>$bulan,
  "outstanding" =>$outstanding1,
  "angsuran_pokok" =>$angsuran_pokok1,
  "angsuran_bunga" =>$angsuran_bunga1,
  "angsuran_total" =>$angsuran_total1,

  );
$no=2;
for ($x = 1; $x < $tenor; $x++)
{
//   array_push($array, $x);
//    array_push($array[] = array("number" => $x, "data" => "XXXX", "status" => "A"));
//$array[] = array("number" => $x, "data" => "XXXX", "status" => "A");
$bulan = $bulan+1;
if ($bulan > 12){
$bulan=1;
$tahun=$tahun+1;
}else{
$bulan=$bulan;
}

//$z=$x-2;
$y=$x-1;

$outstanding=$array[$y]['outstanding']-$array[$y]['angsuran_pokok'];
$angsuran_bunga=$outstanding*$bunga/12;
$angsuran_pokok=$angsuran_total1-$angsuran_bunga;

//$angsuran_total=$angsuran_pokok;
//---
//echo $x;
//echo '<br>';
//---
  $array[] = array(
  "no" => $no,
  "tahun" => $tahun,
//  "bulan" =>$nama_bln[$bulan],
   "bulan" =>$bulan,
  "outstanding" =>$outstanding,
  "angsuran_pokok" =>$angsuran_pokok,
  "angsuran_bunga" =>$angsuran_bunga,
  "angsuran_total" =>$angsuran_total1,

  );

$no++;
//$no;

}

//print_r($array);
//==============
		$this->load->model("excel_export_model");
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);


		$object->getActiveSheet()->mergeCells('A2:E2');
		$object->getActiveSheet()->mergeCells('A3:E3');
		$object->getActiveSheet()->mergeCells('A4:E4');
		$object->getActiveSheet()->mergeCells('A5:E5');

		$object->getActiveSheet()->getCell('A2')->setValue('NAMA_PEMOHON : '.$nama_pemohon.' ');
		$object->getActiveSheet()->getCell('A3')->setValue('TGL_AKAD : '.$tgl_akad.' ');
		$object->getActiveSheet()->getCell('A4')->setValue('NILAI_KPR : '.$nilai_kpr.' ');
		$object->getActiveSheet()->getCell('A5')->setValue('TENOR : '.$tenor.' ');


//		$table_columns = array("kd_penjualan", "tgl_penjualan", "kd_titik", "kd_user");
//		$table_columns = array("kd_penjualan", "tgl_penjualan", "nama", "nama_produk","qty");
//Full texts 	kd_penjualan 	kd_store 	total_harga 	tanggal_penjualan 	kd_user
		$table_columns = array(
		"NO",
		"TAHUN",
		"BULAN",
		"OUTSTANDING",
		"ANGSURAN POKOK",
		"ANGSURAN BUNGA",
		"ANGSURAN TOTAL",
/*
		"qty",
		"admin_pic",
		"agency"
*/
		);
//print_r($table_columns);die();

//kd store = kd_titik???
		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 8, $field);
			$column++;
		}

//		$data_penjualan = $this->excel_export_model->fetch_data_admin1();
/*
$data_export  = array(
		array(
		"no"=>1,
		"tahun"=>2017,
		"bulan"=>9,
		),
		array(
		"no"=>1,
		"tahun"=>2017,
		"bulan"=>9,
		)
)
		;
*/

//print_r($data_export);die();
$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
//		$excel_row = 2;
		$excel_row = 9;

		foreach($array as $key=>$row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['no']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['tahun']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $nama_bln[$row['bulan']]);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, round($row['outstanding'],0));
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, round($row['angsuran_pokok'],0));
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, round($row['angsuran_bunga'],0));
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, round($row['angsuran_total'],0));
/*
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->qty);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->nama);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->nama_agency);
*/
//			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->qty);


			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Detail_'.$no_ktp_pemohon.'.xls"');
		$object_writer->save('php://output');


//===================
//print_r($array);die();
/*
//-----
        $data=array(
            'title'=>'Laporan',
//            'active_dashboard'=>'active',
//            'data_upload'=>$this->model_app->getAllData('upload_verivikasi'),
              'nama_pemohon'=>$nama_pemohon,
              'tenor'=>$tenor,
              'nilai_flpp'=>$nilai_flpp,
              'data_detail_id'=>$array,
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_detail_id');
        $this->load->view('element/v_footer');

*/

}




//==========
    function cari_total(){
$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');

$tgl= date('d');
$m = date('m');
$y = date('Y');
/*
print_r($tgl);
print_r('<br>');
print_r($nama_bln[$m]);
print_r('<br>');
print_r($y);
*/
//print_r(''.$tgl.'-' .$nama_bln[$m].'-' .$y);

//die();

$batch_id = $this->input->post('batch_id');
$id['batch_id']= $batch_id;

//$data_generate = $this->model_app->getSelectedData("upload_verivikasi",$id)->result();
//!!!!!!!!!!!!BY BATCH
$data_generate=$this->db->query("
SELECT
batch_id,
bulan,
tahun,
sum(outstanding) as outstanding ,
sum(angsuran_pokok) as angsuran_pokok,
sum(angsuran_bunga) as angsuran_bunga,
sum(angsuran_total) as angsuran_total
FROM total
WHERE batch_id='048'
group by batch_id,tahun,bulan
order by batch_id,tahun

")->result();



//print_r($data_generate);die();

foreach($data_generate as $value){

$temp_array_total[] = array(
//$angsuran_total = $value->angsuran_total;
//$total_dana = 0,9 * $angsuran_total;
//$no_ktp_pemohon
//  "no" => $no,
  "tahun" => $value->tahun,
  "bulan" => $value->bulan,
  "sum_outstanding" => $value->outstanding,
  "sum_angsuran_pokok" => $value->angsuran_pokok,
  "sum_angsuran_bunga" => $value->angsuran_bunga,
  "total_dana" => bunga() * $value->angsuran_pokok ,
//  "angsuran_sisa" => $value->angsuran_sisa,
  "batch_id" =>$value->batch_id,

  //  "no_ktp_pemohon" => $value['outstanding'],

//  "sum_outstanding1" => $angsuran_total,
  //"sum_pokok1" => $sum_pokok1,
  //"sum_bunga1" => $sum_bunga1,
  //"sum_total1" => $sum_total1,

  );

}

//print_r($temp_array_total);die();
//==============
		$this->load->model("excel_export_model");
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

$styleArray3 = array(
/*
*/
    'font'  => array(
//        'bold'  => true,
//        'color' => array('rgb' => 'FF0000'),
        'color' => array('rgb' => '000000'),
          'size'  => 10,
        'name'  => 'Arial'
    )
//---

//----
	);

$styleArray4 = array(
/*
    'font'  => array(
//        'bold'  => true,
//        'color' => array('rgb' => 'FF0000'),
        'color' => array('rgb' => '000000'),
          'size'  => 10,
        'name'  => 'Arial'
    )
*/
//---
  'font' => array(
        'bold' => true,
        'color' => array('rgb' => '000000'),
          'size'  => 10,
        'name'  => 'Arial'
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),

    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'right' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
/*
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation' => 90,
        'startcolor' => array(
            'argb' => 'FFA0A0A0',
        ),
        'endcolor' => array(
            'argb' => 'FFFFFFFF',
        ),
    ),
*/
//----
	);
//=====
$styleArray5 = array(
/*
    'font'  => array(
//        'bold'  => true,
//        'color' => array('rgb' => 'FF0000'),
        'color' => array('rgb' => '000000'),
          'size'  => 10,
        'name'  => 'Arial'
    )
*/
//---
  'font' => array(
   //     'bold' => true,
        'color' => array('rgb' => '000000'),
          'size'  => 9,
        'name'  => 'Arial'
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
    ),

    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'right' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    ),
/*
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation' => 90,
        'startcolor' => array(
            'argb' => 'FFA0A0A0',
        ),
        'endcolor' => array(
            'argb' => 'FFFFFFFF',
        ),
    ),
*/
//----
	);



//		$table_columns = array("kd_penjualan", "tgl_penjualan", "kd_titik", "kd_user");
//		$table_columns = array("kd_penjualan", "tgl_penjualan", "nama", "nama_produk","qty");
//Full texts 	kd_penjualan 	kd_store 	total_harga 	tanggal_penjualan 	kd_user
//merge
//			$object->getActiveSheet()->mergeCells('A1:E1');
//			$object->getActiveSheet()->setCellValue('A1','ZZZZZZZZZZZZZZZZ');

/*
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 2,'Rekap Jadwal Angsuran Pembayaran Dana FLPP ');
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 2,'Rekap Jadwal Angsuran Pembayaran Dana FLPP ');
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 3,'Pencairan Tanggal ');
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 4,'1. No & Tanggal Surat Pemohon :');
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 5,'2. No Rekening :90275982305   :');
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 6,'3. Jumlah Dana Program FLPP   :');
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 7,'4. Tarif (bunga/imbah hasil)  :');
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 8,'5. Jangka Waktu 			  :');
*/
		$object->getActiveSheet()->mergeCells('A2:G2');
		$object->getActiveSheet()->mergeCells('A3:G3');
		$object->getActiveSheet()->mergeCells('A4:G4');
		$object->getActiveSheet()->mergeCells('A5:G5');
		$object->getActiveSheet()->mergeCells('A6:G6');
		$object->getActiveSheet()->mergeCells('A7:G7');
		$object->getActiveSheet()->mergeCells('A8:G8');


//-----------------
		$object->getActiveSheet()->getCell('A2')->setValue('Rekap Jadwal Angsuran Pembayaran Dana FLPP ');
		$object->getActiveSheet()->getCell('A3')->setValue('Pencairan Tanggal'.$tgl.'-'.$m.'-'.$y);
		$object->getActiveSheet()->getCell('A4')->setValue('1. No & Tanggal Surat Pemohon :');
		$object->getActiveSheet()->getCell('A5')->setValue('2. No Rekening :90275982305   :');
		$object->getActiveSheet()->getCell('A6')->setValue('3. Jumlah Dana Program FLPP   :');
		$object->getActiveSheet()->getCell('A7')->setValue('4. Tarif (bunga/imbah hasil)  :');
		$object->getActiveSheet()->getCell('A8')->setValue('5. Jangka Waktu 			  :');



		$object->getActiveSheet()->getStyle('A2')->applyFromArray($styleArray3);
		$object->getActiveSheet()->getStyle('A3')->applyFromArray($styleArray3);
		$object->getActiveSheet()->getStyle('A4')->applyFromArray($styleArray3);
		$object->getActiveSheet()->getStyle('A5')->applyFromArray($styleArray3);
		$object->getActiveSheet()->getStyle('A6')->applyFromArray($styleArray3);
		$object->getActiveSheet()->getStyle('A7')->applyFromArray($styleArray3);
		$object->getActiveSheet()->getStyle('A8')->applyFromArray($styleArray3);

		$object->getActiveSheet()->mergeCells('B10:C10');


		$object->getActiveSheet()->getCell('A10')->setValue('NO');
		$object->getActiveSheet()->getCell('B10')->setValue('BULAN');
		$object->getActiveSheet()->getCell('D10')->setValue('OUTSTANDING POKOK');
		$object->getActiveSheet()->getCell('E10')->setValue('ANGSURAN POKOK');
		$object->getActiveSheet()->getCell('F10')->setValue('ESTIMASI ANGSURAN TARIF');
		$object->getActiveSheet()->getCell('G10')->setValue('SISA POKOK');

		$object->getActiveSheet()->getStyle('A10')->applyFromArray($styleArray4);
		$object->getActiveSheet()->getStyle('B10')->applyFromArray($styleArray4);
		$object->getActiveSheet()->getStyle('D10')->applyFromArray($styleArray4);
		$object->getActiveSheet()->getStyle('E10')->applyFromArray($styleArray4);
		$object->getActiveSheet()->getStyle('F10')->applyFromArray($styleArray4);
		$object->getActiveSheet()->getStyle('G10')->applyFromArray($styleArray4);


//$object->getActiveSheet()->getStyle('M4')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
//=====

//$object->getActiveSheet()->getStyle('A10:G10')->applyFromArray($styleArray5);
//$object->getActiveSheet()->getStyle('A10:G10')->applyFromArray($styleArray5);

/*
*/

for($i=12; $i<=252; $i++){
$object->getActiveSheet()->getStyle('A'.$i.'')->applyFromArray($styleArray5);
$object->getActiveSheet()->getStyle('B'.$i.'')->applyFromArray($styleArray5);
$object->getActiveSheet()->getStyle('C'.$i.'')->applyFromArray($styleArray5);
$object->getActiveSheet()->getStyle('D'.$i.'')->applyFromArray($styleArray5);
$object->getActiveSheet()->getStyle('E'.$i.'')->applyFromArray($styleArray5);
$object->getActiveSheet()->getStyle('F'.$i.'')->applyFromArray($styleArray5);
$object->getActiveSheet()->getStyle('G'.$i.'')->applyFromArray($styleArray5);


}
//====
			$object->getActiveSheet()->mergeCells('B11:C11');

		$table_columns = array(
/*
		"NO",
		"TAHUN",
		"BULAN",
		"OUTSTANDING POKOK",
		"ANGSURAN POKOK",
		"ESTIMASI ANGSURAN TARIF",
		"SISA POKOK",
*/
		"1",
		"2",
		"",
		"3",
		"4",
		"5",
		"6=3-4",



		);

$object->getActiveSheet()->getStyle('A11')->applyFromArray($styleArray4);
$object->getActiveSheet()->getStyle('B11')->applyFromArray($styleArray4);
$object->getActiveSheet()->getStyle('C11')->applyFromArray($styleArray4);
$object->getActiveSheet()->getStyle('D11')->applyFromArray($styleArray4);
$object->getActiveSheet()->getStyle('E11')->applyFromArray($styleArray4);
$object->getActiveSheet()->getStyle('F11')->applyFromArray($styleArray4);
$object->getActiveSheet()->getStyle('G11')->applyFromArray($styleArray4);

//print_r($table_columns);die();
/*
  $styleArray5 = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
  );

		$object->getActiveSheet()->getStyle('A10')->applyFromArray($styleArray3);
*/



//$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);
//kd store = kd_titik???
		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 11, $field);
			$column++;
		}

//		$data_penjualan = $this->excel_export_model->fetch_data_admin1();
/*
$data_export  = array(
		array(
		"no"=>1,
		"tahun"=>2017,
		"bulan"=>9,
		),
		array(
		"no"=>1,
		"tahun"=>2017,
		"bulan"=>9,
		)
)
		;
*/
//---

//----
//print_r($data_export);die();
$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
$excel_row = 12;
$no=1;
$sum_angsuran_pokok1=0;
$sum_estimasi_angsuran_tarif1=0;
		foreach($temp_array_total as $key=>$row)
		{
/*
	$outstanding_pokok ="Rp. ".number_format(round($row['sum_outstanding'],9),9,',','.');
	$angsuran_pokok ="Rp. ".number_format(round($row['total_dana'],9),9,',','.');
	$estimasi_angsuran_tarif ="Rp. ".number_format(round($row['sum_angsuran_bunga'],9),9,',','.');
	$sisa_pokok ="Rp. ".number_format(round($row['sum_outstanding']-$row['total_dana'],9),9,',','.');


$sum_angsuran_pokok1+=round($row['total_dana'],9);
$sum_estimasi_angsuran_tarif1+=round($row['sum_angsuran_bunga'],9);

$sum_angsuran_pokok="Rp. ".number_format($sum_angsuran_pokok1,9,',','.');
$sum_estimasi_angsuran_tarif="Rp. ".number_format($sum_estimasi_angsuran_tarif1,9,',','.');
*/


	$outstanding_pokok =round($row['sum_outstanding'],9);
	$angsuran_pokok =round($row['total_dana'],9);
	$estimasi_angsuran_tarif =round($row['sum_angsuran_bunga'],9);
	$sisa_pokok =round($row['sum_outstanding']-$row['total_dana'],9);

$sum_angsuran_pokok1+=round($angsuran_pokok,9);
$sum_estimasi_angsuran_tarif1+=round($estimasi_angsuran_tarif,9);



//$sum_angsuran_pokok1+=round($row['total_dana'],9);
//$sum_estimasi_angsuran_tarif1+=round($row['sum_angsuran_bunga'],9);

$sum_angsuran_pokok=round($sum_angsuran_pokok1,9);
$sum_estimasi_angsuran_tarif=round($sum_estimasi_angsuran_tarif1,9);



//$sum_angsuran_pokok1+="Rp. ".number_format(round($row['total_dana'],0),0,',','.');
//$sum_estimasi_angsuran_tarif1+="Rp. ".number_format(round($row['sum_angsuran_bunga'],0),0,',','.');


			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['tahun']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $nama_bln[$row['bulan']]);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $outstanding_pokok);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $angsuran_pokok);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $estimasi_angsuran_tarif);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $sisa_pokok);
/*
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->qty);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->nama);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->nama_agency);
*/
//			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->qty);


			$excel_row++;
			$no++;
		}
//	$sum_angsuran_pokok ="Rp. ".number_format($sum_angsuran_pokok1,0,',','.');
//	$sum_estimasi_angsuran_tarif ="Rp. ".number_format($sum_estimasi_angsuran_tarif1,0,',','.');

//  $object->getActiveSheet()->getStyle('A10')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
/*
    		$object->getActiveSheet()->setCellValueByColumnAndRow(3, 252,'TOTAL');
    		$object->getActiveSheet()->setCellValueByColumnAndRow(4, 252,$sum_angsuran_pokok);
    		$object->getActiveSheet()->setCellValueByColumnAndRow(5, 252,$sum_estimasi_angsuran_tarif);
*/
    		$object->getActiveSheet()->setCellValueByColumnAndRow(3, 255,'TOTAL');
    		$object->getActiveSheet()->setCellValueByColumnAndRow(4, 255,$sum_angsuran_pokok);
    		$object->getActiveSheet()->setCellValueByColumnAndRow(5, 255,$sum_estimasi_angsuran_tarif);


		$object->getActiveSheet()->getCell('A268')->setValue('1. Jangka waktu = jangka waktu KPR paling lama yang diberikan kepada debitur/nasabah.');
		$object->getActiveSheet()->getCell('A269')->setValue('2. Outstanding Pokok = Outstanding Pokok pada awal bulan.');
		$object->getActiveSheet()->getCell('A270')->setValue('3. Jumlah angsuran pokok = dana FLPP dari kewajiban angsuran pokok yang harus dibayar debitur/nasabah.');
		$object->getActiveSheet()->getCell('A2671')->setValue('4. Angsuran Tarif(bunga/imbal hasil) = formula tarif disesuaikan dengan formula bunga KPR Sejahtera yang dibebankan Bank Pelaksana pada debitur/nasabah.');
		$object->getActiveSheet()->getCell('A267')->setValue('5. Sisa Pokok = Outstanding pokok awal bulan - angsuran pokok bulan berjalan = outstanding pokok pada akhir bulan.');

$styleArray1 = array(
    'font'  => array(
//        'bold'  => true,
//        'color' => array('rgb' => 'FF0000'),
        'color' => array('rgb' => '000000'),
          'size'  => 9,
        'name'  => 'Arial'
    ));

		$object->getActiveSheet()->getStyle('A268')->applyFromArray($styleArray1);
		$object->getActiveSheet()->getStyle('A269')->applyFromArray($styleArray1);
		$object->getActiveSheet()->getStyle('A270')->applyFromArray($styleArray1);
		$object->getActiveSheet()->getStyle('A271')->applyFromArray($styleArray1);
		$object->getActiveSheet()->getStyle('A272')->applyFromArray($styleArray1);




$styleArray2 = array(
    'font'  => array(
        'bold'  => true,
//        'color' => array('rgb' => 'FF0000'),
        'color' => array('rgb' => '000000'),
          'size'  => 12,
        'name'  => 'Arial'
    ));

$object->getActiveSheet()->getCell('A263')->setValue('Jakarta,');
$object->getActiveSheet()->getStyle('A264')->applyFromArray($styleArray2);

$object->getActiveSheet()->getCell('A265')->setValue('PT BANK NEGARA INDONESIA (PERSERO) Tbk');
$object->getActiveSheet()->getStyle('A265')->applyFromArray($styleArray2);

$object->getActiveSheet()->getCell('A266')->setValue('DIVISI PENJUALAN KONSUMER');
$object->getActiveSheet()->getStyle('A266')->applyFromArray($styleArray2);
/*
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 258,'Jakarta');
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 259,'PT BANK NEGARA INDONESIA (PERSERO) Tbk');
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, 260,'DIVISI PENJUALAN KONSUMER');
*/


		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Total_Batch_'.$batch_id.'.xls"');
		$object_writer->save('php://output');


//===================






//------------------------------
/*
        $data=array(
            'title'=>'Laporan',
//            'active_dashboard'=>'active',
//            'data_upload'=>$this->model_app->getAllData('upload_verivikasi'),

              'data_generate'=>$temp_array_total,
//              'data_generate'=>$data_generate,
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_laporan_generate_total');
        $this->load->view('element/v_footer');
*/


    }



//==========
//-------------------
//	function download_detail($array)
	function download_detail()
	{
//print_r($array);die();
//print_r("ZZZZZZZZZZZZZZZ");die();
		$this->load->model("excel_export_model");
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

//		$table_columns = array("kd_penjualan", "tgl_penjualan", "kd_titik", "kd_user");
//		$table_columns = array("kd_penjualan", "tgl_penjualan", "nama", "nama_produk","qty");
//Full texts 	kd_penjualan 	kd_store 	total_harga 	tanggal_penjualan 	kd_user
		$table_columns = array(
		"no",
		"tahun",
		"bulan",
/*
		"qty",
		"admin_pic",
		"agency"
*/
		);
//print_r($table_columns);die();

//kd store = kd_titik???
		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

//		$data_penjualan = $this->excel_export_model->fetch_data_admin1();

$data_export  = array(
		array(
		"no"=>1,
		"tahun"=>2017,
		"bulan"=>9,
		),
		array(
		"no"=>1,
		"tahun"=>2017,
		"bulan"=>9,
		)
)
		;

//print_r($data_export);die();

		$excel_row = 2;

		foreach($data_export as $key=>$row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['no']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['tahun']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['bulan']);
/*
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->qty);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->nama);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->nama_agency);
*/
//			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->qty);


			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Penjualan.xls"');
		$object_writer->save('php://output');
	}



//---------------
	function laporan_admin1()
	{
		$this->load->model("excel_export_model");
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

//		$table_columns = array("kd_penjualan", "tgl_penjualan", "kd_titik", "kd_user");
//		$table_columns = array("kd_penjualan", "tgl_penjualan", "nama", "nama_produk","qty");
//Full texts 	kd_penjualan 	kd_store 	total_harga 	tanggal_penjualan 	kd_user
		$table_columns = array("kd_penjualan", "tgl_penjualan", "ruas_tol","qty", "admin_pic", "agency");
//kd store = kd_titik???
		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$data_penjualan = $this->excel_export_model->fetch_data_admin1();

		$excel_row = 2;

		foreach($data_penjualan as $row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_penjualan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->tanggal_penjualan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->nm_titik);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->qty);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->nama);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->nama_agency);
//			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->qty);


			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Penjualan.xls"');
		$object_writer->save('php://output');
	}


	function laporan_admin2()
	{
		$this->load->model("excel_export_model");
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

//		$table_columns = array("kd_penjualan", "tgl_penjualan", "kd_titik", "kd_user");
//		$table_columns = array("kd_penjualan", "tgl_penjualan", "nama", "nama_produk","qty");
//Full texts 	kd_penjualan 	kd_store 	total_harga 	tanggal_penjualan 	kd_user
		$table_columns = array("kd_penjualan", "tgl_penjualan", "nama_titik", "nama_admin", "agency","qty");
//kd store = kd_titik???
		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$data_penjualan = $this->excel_export_model->fetch_data_admin1();

		$excel_row = 2;

		foreach($data_penjualan as $row)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kd_penjualan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->tanggal_penjualan);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->nm_titik);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->nama);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->nama_agency);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->qty);
//			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->qty);


			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Penjualan.xls"');
		$object_writer->save('php://output');

}

}

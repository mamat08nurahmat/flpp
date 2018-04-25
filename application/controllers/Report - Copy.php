<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

function __construct(){
        parent::__construct();
/*
        if($this->session->userdata('login_status') != TRUE ){
            $this->session->set_flashdata('notif','Maaf, Anda tidak diperbolehkan masuk tanpa login !');
            redirect('');
        };
*/		
  //$this->load->helper('currency_format_helper');		
        $this->load->model('model_app');
     //   $this->load->helper('currency_format_helper');
    }



    function index(){
        $data=array(
            'title'=>'Master Data',
//            'active_master'=>'active',

			
            'data_verivikasi'=>$this->model_app->getAllData('upload_verivikasi'),

        );
		//print_r($data['data_titik']);die();
//        $this->load->view('element/v_header',$data);
//print_r($data['data_verivikasi'][0]->batch_id);die();
//        $this->load->view('pages/v_report');
        $this->load->view('pages/v_report_detail');

//        $this->load->view('element/v_footer');
    }


    function detail(){
        $data=array(
            'title'=>'Master Data',
//            'active_master'=>'active',

			
            'data_verivikasi'=>$this->model_app->getAllData('upload_verivikasi'),

        );

        $this->load->view('pages/v_report_detail');

    }


    function total(){
        $data=array(
            'title'=>'Master Data',
//            'active_master'=>'active',

			
            'data_verivikasi'=>$this->model_app->getAllData('upload_verivikasi'),

        );

        $this->load->view('pages/v_report_total');

    }
	
	
function get_total(){

$batch_id = $this->input->post('batch_id');
$id['batch_id']= $batch_id;	
//$id['batch_id']= $batch_id;	
	
$data_generate = $this->model_app->getSelectedData("upload_verivikasi",$id)->result();	

//print_r($data_generate);die();

$output= "";	
$output.= "<table border='1'>";
//tr1
$output.= "<tr>";

$output.= "<td align='center' >";
$output.= "NO";
$output.= "</td>";

$output.= "<td colspan='2' align='center' >";
$output.= "BULAN";
$output.= "</td>";

$output.= "<td align='center' >";
$output.= "OUTSTANDING POKOK";
$output.= "</td>";

$output.= "<td align='center' >";
$output.= "ANGSURAN POKOK";
$output.= "</td>";

$output.= "<td align='center' >";
$output.= "ESTIMASI ANGSURAN TARIF";
$output.= "</td>";

$output.= "<td align='center' >";
$output.= "SISA POKOK";
$output.= "</td>";

$output.= "</tr>";

//tr2
$output.= "<tr>";

$output.= "<td align='center' >";
$output.= "1";
$output.= "</td>";

$output.= "<td colspan='2' align='center' >";
$output.= "2";
$output.= "</td>";

$output.= "<td align='center' >";
$output.= "3";
$output.= "</td>";

$output.= "<td align='center' >";
$output.= "4";
$output.= "</td>";

$output.= "<td align='center' >";
$output.= "5";
$output.= "</td>";

$output.= "<td align='center' >";
$output.= "6=3-4";
$output.= "</td>";

/*
$output.= "<td>";
$output.= "AKSI";
$output.= "</td>";
*/

$output.= "</tr>";

//$tgl_akad =$detail_data[0]->TGL_AKAD; //tgl_akad 
//

$tgl_akad ="7/7/2017"; //tgl_akad 
//------------------

$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
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
//--------------------------------------------------	
/*
 $array_total[] = array(
  "no" => 1,
  "tahun" => $tahun,
  "bulan" =>$nama_bln[$bulan], 
  "outstanding" =>$outstanding1, 
  "angsuran_pokok" =>$angsuran_pokok1, 
  "angsuran_bunga" =>$angsuran_bunga1, 
  "angsuran_total" =>$angsuran_total1, 
  
  );
  
*/
//$no=2;
$tenor=240;
for ($x = 1; $x <= $tenor; $x++)
{
$bulan = $bulan+1;

if ($bulan > 12){
$bulan=1;
$tahun=$tahun+1;
}else{
$bulan=$bulan;
}

//total perbulan
$outstanding_pokok = 12345;
$angsuran_pokok=6789;
$estimasi_angsuran=11111;
$sisa_pokok=9999;
/*
$y=$x-1;

$outstanding=$array[$y]['outstanding']-$array[$y]['angsuran_pokok'];
$angsuran_bunga=$outstanding*$bunga/12;
$angsuran_pokok=$angsuran_total1-$angsuran_bunga;
*/

//$angsuran_total=$angsuran_pokok;
//---
//echo $x;
//echo '<br>';
//---
  $array_total[] = array(
  "no" => $x,
  "tahun" => $tahun,
  "bulan" =>$nama_bln[$bulan], 
  "outstanding_pokok" =>$outstanding_pokok, 
  "angsuran_pokok" =>$angsuran_pokok, 
  "estimasi_angsuran" =>$estimasi_angsuran, 
  "sisa_pokok" =>$sisa_pokok, 
/*
*/  
  
  );

//$no;  

}
//--------

//tr looping
$no=1;
/*
$sum_outstanding=0;
$sum_pokok=0;
$sum_bunga=0;
$sum_total=0;

*/
foreach($array_total as $name => $value ){


$output.= "<tr>";

$output.= "<td align='center' >";
$output.= "".$no."";
$output.= "</td>";

$output.= "<td align='center' >";
$output .="".$value['tahun']."";
//$output.= "".$no."";
$output.= "</td>";

$output.= "<td align='center' >";
//$output.= "".$no."";
$output .="".$value['bulan']."";
$output.= "</td>";

$output.= "<td align='center' >";
$output .="".$value['outstanding_pokok']."";
$output.= "</td>";

$output.= "<td align='center' >";
$output .="".$value['angsuran_pokok']."";
$output.= "</td>";

$output.= "<td align='center' >";
$output .="".$value['estimasi_angsuran']."";
$output.= "</td>";

$output.= "<td>";
$output .="".$value['sisa_pokok']."";
$output.= "</td>";

$output.= "</tr>";
	
	$no++;	
}


$output.= "</table>";

echo $output;

	
}

	
//function get_generate($month,$year,$batch_id){
//function get_generate($month,$year){
function get_generate(){

$month= $this->input->post('month');
$year= $this->input->post('year');

$id['month']= $month;	
$id['year']= $year;	
//$id['batch_id']= $batch_id;	
	
$data_generate = $this->model_app->getSelectedData("upload_verivikasi",$id)->result();	
//print_r($data_generate);die();

$output= "";	
$output.= "<table border='1'>";

$output.= "<tr>";
/*
*/
$output.= "<td>";
$output.= "NO";
$output.= "</td>";

$output.= "<td>";
$output.= "NAMA";
$output.= "</td>";

$output.= "<td>";
$output.= "TANGGAL AKAD";
$output.= "</td>";

$output.= "<td>";
$output.= "NILAI KPR";
$output.= "</td>";

$output.= "<td>";
$output.= "TENOR";
$output.= "</td>";

$output.= "<td>";
$output.= "NILAI FLPP";
$output.= "</td>";


$output.= "<td>";
$output.= "AKSI";
$output.= "</td>";


$output.= "</tr>";
$no=1;
//-----looping
 foreach($data_generate as $items ){
	//$nama_pemohon = $items->NAMA_PEMOHON; 

//print_r($nama_pemohon);die(); 
/*
*/
	 


//looping

$output.= "<tr>";

$output.= "<td>";
$output.= $no;
$output.= "</td>";
/*
*/

$output.= "<td>";
$output.= $items->NAMA_PEMOHON;
$output.= "</td>";

$output.= "<td>";
$output.= $items->TGL_AKAD;
$output.= "</td>";

$output.= "<td>";
$output.= $items->NILAI_KPR;
$output.= "</td>";

$output.= "<td>";
$output.= $items->TENOR;
$output.= "</td>";

$output.= "<td>";
$output.= $items->NILAI_FLPP;
$output.= "</td>";

$output.= "<td>";
//$output.= "<button>Generate</button>";
//$output.= "<a href='report/get_detail/".$items->NO_KTP_PEMOHON."/' >Detail<a/>";
$output.= "<a href='".site_url("report/get_detail/".$items->NO_KTP_PEMOHON."/")."' target='_blank' >Detail<a/>";

$output.= "</td>";

$output.= "</tr>";

//$i++; \
$no++;	 
 }


$output.= "</table>";

//
echo $output;
/*
        $data=array(
            'title'=>'Master Data',
//            'active_master'=>'active',

			
            'data_output'=>$output,

        );

 $this->load->view('v_tes',$data);
*/
	
}


function get_detail($no_ktp_pemohon){
//print_r($no_ktp_pemohon);die();
	
     $id['no_ktp_pemohon']=$no_ktp_pemohon;
//       $id['batch_id']='001';
/*

        $data=array(
            'detail_data'=>$this->model_app->getSelectedData('upload_verivikasi',$id)->result(),
        );
*/	   
            $detail_data = $this->model_app->getSelectedData('upload_verivikasi',$id)->result();
//============
//$tenor =10;
$tenor =$detail_data[0]->TENOR; //tenor

$nama_pemohon =$detail_data[0]->NAMA_PEMOHON; //nama_pemohon
$nilai_kpr =$detail_data[0]->NILAI_KPR; //nama_pemohon
$tgl_akad =$detail_data[0]->TGL_AKAD; //tgl_akad 

$bunga2 =$detail_data[0]->SUKU_BUNGA_KPR; //bunga
$bunga = $bunga2 /100;

print_r("NAMA_PEMOHON :");
print_r($nama_pemohon);
print_r("<br>");
print_r("TANGGAL AKAD : ");
print_r($tgl_akad);
/*
die();
*/

$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
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
//$angsuran_pokok = 311410;
//$angsuran_bunga = 533333;
//$angsuran_total = $angsuran_pokok + $angsuran_bunga;


//---------------------
//		$bunga_rp = $nilai_kpr/$bunga;

//		$bunga_perbulan=$bunga/12;
//		$angsuran_pokok = $nilai_kpr/$tenor; //=====5
//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-(($bunga/12)+1)^-$tenor))-($bunga*($nilai_kpr/12)) ; //=====5


//$pangkat = (-$tenor*log((($bunga/12)+1)));
//print_r($pangkat);die();

//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-(($bunga/12)+1)^-$tenor))-($bunga*($nilai_kpr/12)) ; //=====5
		$angsuran_pokok1 = $nilai_kpr*(($bunga/12)/(1-pow((($bunga/12)+1),-$tenor)))-($bunga*($nilai_kpr/12)) ; //=====5

//print_r($angsuran_pokok);die();		
//			$angsuran_pokok = 311410 ; //=====5
//print_r($angsuran_pokok);die();
		
		$angsuran_bunga1=$nilai_kpr*$bunga/12; //===6
		//$angsuran_bunga=533333 ; //===6

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
//$no=2;
for ($x = 1; $x < $tenor; $x++)
{
//   array_push($array, $x);
//    array_push($array[] = array("number" => $x, "data" => "XXXX", "status" => "A"));
//$array[] = array("number" => $x, "data" => "XXXX", "status" => "A");
$bulan = $bulan+1;
//$no++;
if ($bulan > 12){
$bulan=1;
$tahun=$tahun+1;
}else{
$bulan=$bulan;
}

//$z=$x-2;
$y=$x-1;
/*
$outstanding=$array[$z]['outstanding']-$array[$z]['angsuran_pokok'];
$angsuran_bunga=$array[$x]['outstanding']*$bunga/12;
$angsuran_pokok=$array[$x]['angsuran_total']-$array[$x]['angsuran_bunga'];
*/
$outstanding=$array[$y]['outstanding']-$array[$y]['angsuran_pokok'];
$angsuran_bunga=$outstanding*$bunga/12;
$angsuran_pokok=$angsuran_total1-$angsuran_bunga;

//$angsuran_total=$angsuran_pokok;
//---
//echo $x;
//echo '<br>';
//---
  $array[] = array(
  "no" => $x,
  "tahun" => $tahun,
//  "bulan" =>$nama_bln[$bulan], 
   "bulan" =>$bulan, 
  "outstanding" =>$outstanding, 
  "angsuran_pokok" =>$angsuran_pokok, 
  "angsuran_bunga" =>$angsuran_bunga, 
  "angsuran_total" =>$angsuran_total1, 
  
  );

//$no;  

}

//print_r($array);

$output ="";
$output .="<table border='1' >";

$output .="
<tr>
<td>NO</td>
<td>Tahun</td>
<td>Bulan</td>
<td>Outstanding</td>
<td>Angsuran Pokok</td>
<td>Angsuran Bunga</td>
<td>Angsuran Total</td>
</tr>
";

$no=1;
$sum_outstanding=0;
$sum_pokok=0;
$sum_bunga=0;
$sum_total=0;
foreach ($array as $name => $value) {
$output .="<tr>";
	
//    echo $name." ".$value['outstanding']."</br>";
//$round_total = round($value['angsuran_total'],0);	
$outstanding = number_format(round($value['outstanding'],0),0,',','.');
$angsuran_pokok = number_format(round($value['angsuran_pokok'],0),0,',','.');
$angsuran_bunga = number_format(round($value['angsuran_bunga'],0),0,',','.');
$angsuran_total = number_format(round($value['angsuran_total'],0),0,',','.');

$sum_outstanding += $value['outstanding'];
$sum_pokok += $value['angsuran_pokok'];
$sum_bunga += $value['angsuran_bunga'];
$sum_total += $value['angsuran_total'];
/*
$sum_outstanding += round($value['outstanding'],0);
$sum_pokok += round($value['angsuran_pokok'],0,PHP_ROUND_HALF_ODD);
$sum_bunga += number_format(round($value['angsuran_bunga'],0),0,',','.');
$sum_total += number_format(round($value['angsuran_total'],0),0,',','.');
*/
$sum_outstanding1 = number_format(round($sum_outstanding,0),0,',','.');
$sum_pokok1 = number_format(round($sum_pokok,0),0,',','.');
$sum_bunga1 = number_format(round($sum_bunga,0),0,',','.');
$sum_total1 = number_format(round($sum_total,0),0,',','.');

$output .="<td align='center' >";
$output .="".$no."";
$output .="</td>";

$output .="<td align='center' >";
$output .="".$value['tahun']."";
$output .="</td>";

$output .="<td align='center' >";
$output .="".$nama_bln[$value['bulan']]."";
$output .="</td>";

$output .="<td align='right' >";
//$output .="".round($value['outstanding'],0)."";
$output .="".$outstanding."";
$output .="</td>";

$output .="<td align='right' >";
//$output .="".round($value['angsuran_pokok'],0)."";
$output .="".$angsuran_pokok."";
$output .="</td>";

$output .="<td align='right' >";
//$output .="".round($value['angsuran_bunga'])."";
$output .="".$angsuran_bunga."";
$output .="</td>";

$output .="<td align='right' >";
$output .="".$angsuran_total."";
//$output .="".round($value['angsuran_total'],0)."";
$output .="</td>";

$output .="</tr>";
	
	
 $temp_array_detail[] = array(
//$no_ktp_pemohon 
//  "no" => $no,
  "tahun" => $value['tahun'],
  "bulan" => $value['bulan'],
  "outstanding" => $outstanding,
  "angsuran_pokok" => $angsuran_pokok,
  "angsuran_bunga" => $angsuran_bunga,
  "angsuran_total" => $angsuran_total,
//  "sum_outstanding1" => $angsuran_total,
  //"sum_pokok1" => $sum_pokok1,
  //"sum_bunga1" => $sum_bunga1,
  //"sum_total1" => $sum_total1,

  );	 

	
	
$no++;	
// $sum+= $value['angsuran_total'];
//$sum_tot=$sum;
}
//------
$output .="<td colspan='3' align='center' >";
$output .="TOTAL";
$output .="</td>";
/*
$output .="<td>";
$output .="";
$output .="</td>";

$output .="<td>";
$output .="";
$output .="</td>";
*/

$output .="<td align='right' >";
//$output .="".number_format(round($sum_outstanding,0),0,',','.')."";
$output .="".'Rp '."".$sum_outstanding1;
$output .="</td>";

$output .="<td align='right' >";
//$output .="".number_format(round($sum_pokok,0),0,',','.')."";
$output .="".'Rp '."".$sum_pokok1."";
$output .="</td>";

$output .="<td align='right' >";
//$output .="".number_format(round($sum_bunga,0),0,',','.')."";
$output .="".'Rp '."".$sum_bunga1."";
$output .="</td>";

$output .="<td align='right' >";
//$output .="".number_format(round($sum_total,0),0,',','.')."";
$output .="".'Rp '."".$sum_total1."";
$output .="</td>";

$output .="</tr>";
//-----

$output .="</table>";


echo $output;
//
//print_r($temp_array_detail);die();
//$input_data = implode("-",$temp_array_detail);
$cek = $this->db->insert_batch('total', $temp_array_detail);  


if($cek){
print_r('OK');	
	
}else{
	
print_r('GAGAL');	
	
}
//print_r($input_data);
/*
foreach($temp_array_detaila as $key=>$name){
	
	$input_data[] = array(
	
	);
	
	
}
*/


/*
*/
/*
        $data=array(
		
foreach($temp_array_detail as $name => $value) {
	
            'tahun'=>$value['tahun'],
            'bulan'=>$value['bulan'],
            'outstanding'=>$value['outstanding'],
            'angsuran_pokok'=>$value['angsuran_pokok'],
            'angsuran_bunga'=>$value['angsuran_bunga'],
            'angsuran_total'=>$value['angsuran_total'],
	
}		
            'kd_produk'=>$this->input->post('kd_produk'),
            'nm_produk'=>$this->input->post('nm_produk'),
            'stok'=>$this->input->post('stok'),
//            'harga'=>$this->input->post('harga'),
        );
*/
		
		
//        $this->model_app->insertData('produk_master',$data);




//--------------------
/*
$output = "";

$output .= "<table border='1' >";

//------------------

$output .= "<tr>";

$output .= "<td>";
$output .= "No";
$output .= "</td>";

$output .= "<td>";
$output .= "Tahun";
$output .= "</td>";

$output .= "<td>";
$output .= "Bulan";
$output .= "</td>";


$output .= "<td>";
$output .= "Outstanding";
$output .= "</td>";

$output .= "<td>";
$output .= "Angsuran Pokok";
$output .= "</td>";

$output .= "<td>";
$output .= "Angsuran Bunga";
$output .= "</td>";

$output .= "<td>";
$output .= "Angsuran Total";
$output .= "</td>";

$output .= "</tr>";
//---------------------
$outstanding1=$nilai_kpr;		
$angsuran_pokok1=$angsuran_pokok;		
$angsuran_bunga1=$angsuran_bunga;		
$angsuran_total1=$angsuran_pokok1+$angsuran_bunga1;		
*/


//-----------------
/*
$x =[
"no" => "1",
"tahun" => "$tahun",
"bulan"=>"$nama_bln[$bulan]",
"outstanding1"=>"$outstanding1",
"angsuran_pokok1"=>"$angsuran_pokok1",
"angsuran_bunga1"=>"$angsuran_bunga1",
"angsuran_total1"=>"$angsuran_total1"
];
$angka =[1,2,3,4,5];
echo $angka;
//print_r($angka);

$output .= "<tr>";
$output .= "<td>";
$output .= "1";
$output .= "</td>";

$output .= "<td>";
$output .= "".$tahun."";
//$output .= "2017";
$output .= "</td>";

$output .= "<td>";
$output .= "".$nama_bln[$bulan]."";
//$output .= "11";
$output .= "</td>";


$output .= "<td>";
$output .= "".round($outstanding1,0)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".round($angsuran_pokok1,0)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".round($angsuran_bunga1,0)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".round($angsuran_total,0)."";
$output .= "</td>";


$output .= "</tr>";
*/
/*
$no=2;
$outstanding=$outstanding1-$angsuran_pokok1;
for($i=0;$i<=$tenor;$i++){

//print_r($i);	
//$angsur=$angsur – floor($hasil);
$bulan=$bulan+1;
//$bulan++;
$outstanding3=$outstanding1-$angsuran_pokok1;
//???
$angsuran_bunga=$outstanding*$bunga/12;
$angsuran_pokok=($angsuran_total+$angsuran_pokok)-$angsuran_bunga1;
$angsuran_total=$angsuran_total;

if ($bulan > 12){
$bulan=1;
$tahun=$tahun+1;
}else{
$bulan=$bulan;
}

$output .= "<tr>";

$output .= "<td>";
$output .= "".$no."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$tahun."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$nama_bln[$bulan]."";
$output .= "</td>";


$output .= "<td>";
$output .= "".floor($outstanding3)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".floor($angsuran_pokok)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".floor($angsuran_bunga)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".floor($angsuran_total)."";
$output .= "</td>";


$output .= "</tr>";


$no++;
}

$output .= "</table>";


echo 	$output;
*/



//--------------

/*
*/	
//-----
}



function get_detail_total(){
//print_r($no_ktp_pemohon);die();
	
//     $id['no_ktp_pemohon']=$no_ktp_pemohon;
//       $id['batch_id']='001';
/*

        $data=array(
            'detail_data'=>$this->model_app->getSelectedData('upload_verivikasi',$id)->result(),
        );
*/	   
$month= $this->input->post('month');
$year= $this->input->post('year');

$id['month']= '9';	
$id['year']= '2017';	
/*
$month= '9';
$year= '2017';
$detail_data = $this->db->query("SELECT tenor,sum(nilai_kpr) as sum_nilai_kpr FROM upload_verivikasi WHERE month='$month' AND year='$year' ")->result();
*/

/*
            $detail_data = $this->model_app->getSelectedData('upload_verivikasi',$id)->result();
$temp_array = array();			
foreach($detail_data as array_1 ){
	$temp_array[] = array_1
	
}
*/
			
print_r($detail_data);die();			
//============
//$tenor =10;
$tenor =$detail_data[0]->TENOR; //tenor

$nama_pemohon =$detail_data[0]->NAMA_PEMOHON; //nama_pemohon
$nilai_kpr =$detail_data[0]->NILAI_KPR; //nama_pemohon
//sum 

$tgl_akad =$detail_data[0]->TGL_AKAD; //tgl_akad 

$bunga2 =$detail_data[0]->SUKU_BUNGA_KPR; //bunga
$bunga = $bunga2 /100;

print_r("NAMA_PEMOHON :");
print_r($nama_pemohon);
print_r("<br>");
print_r("TANGGAL AKAD : ");
print_r($tgl_akad);
/*
die();
*/

$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
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
//$angsuran_pokok = 311410;
//$angsuran_bunga = 533333;
//$angsuran_total = $angsuran_pokok + $angsuran_bunga;


//---------------------
//		$bunga_rp = $nilai_kpr/$bunga;

//		$bunga_perbulan=$bunga/12;
//		$angsuran_pokok = $nilai_kpr/$tenor; //=====5
//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-(($bunga/12)+1)^-$tenor))-($bunga*($nilai_kpr/12)) ; //=====5


//$pangkat = (-$tenor*log((($bunga/12)+1)));
//print_r($pangkat);die();

//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-(($bunga/12)+1)^-$tenor))-($bunga*($nilai_kpr/12)) ; //=====5
		$angsuran_pokok1 = $nilai_kpr*(($bunga/12)/(1-pow((($bunga/12)+1),-$tenor)))-($bunga*($nilai_kpr/12)) ; //=====5

//print_r($angsuran_pokok);die();		
//			$angsuran_pokok = 311410 ; //=====5
//print_r($angsuran_pokok);die();
		
		$angsuran_bunga1=$nilai_kpr*$bunga/12; //===6
		//$angsuran_bunga=533333 ; //===6

		$angsuran_total1 = $angsuran_pokok1+$angsuran_bunga1; //=====7		
//--------------------------------------------------	
 $array[] = array(
  "no" => 1,
  "tahun" => $tahun,
  "bulan" =>$nama_bln[$bulan], 
  "outstanding" =>$outstanding1, 
  "angsuran_pokok" =>$angsuran_pokok1, 
  "angsuran_bunga" =>$angsuran_bunga1, 
  "angsuran_total" =>$angsuran_total1, 
  
  );
//$no=2;
for ($x = 1; $x < $tenor; $x++)
{
//   array_push($array, $x);
//    array_push($array[] = array("number" => $x, "data" => "XXXX", "status" => "A"));
//$array[] = array("number" => $x, "data" => "XXXX", "status" => "A");
$bulan = $bulan+1;
//$no++;
if ($bulan > 12){
$bulan=1;
$tahun=$tahun+1;
}else{
$bulan=$bulan;
}

//$z=$x-2;
$y=$x-1;
/*
$outstanding=$array[$z]['outstanding']-$array[$z]['angsuran_pokok'];
$angsuran_bunga=$array[$x]['outstanding']*$bunga/12;
$angsuran_pokok=$array[$x]['angsuran_total']-$array[$x]['angsuran_bunga'];
*/
$outstanding=$array[$y]['outstanding']-$array[$y]['angsuran_pokok'];
$angsuran_bunga=$outstanding*$bunga/12;
$angsuran_pokok=$angsuran_total1-$angsuran_bunga;

//$angsuran_total=$angsuran_pokok;
//---
//echo $x;
//echo '<br>';
//---
  $array[] = array(
  "no" => $x,
  "tahun" => $tahun,
  "bulan" =>$nama_bln[$bulan], 
  "outstanding" =>$outstanding, 
  "angsuran_pokok" =>$angsuran_pokok, 
  "angsuran_bunga" =>$angsuran_bunga, 
  "angsuran_total" =>$angsuran_total1, 
  
  );

//$no;  

}

//print_r($array);

$output ="";
$output .="<table border='1' >";

$output .="
<tr>
<td>NO</td>
<td>Tahun</td>
<td>Bulan</td>
<td>Outstanding</td>
<td>Angsuran Pokok</td>
<td>Angsuran Bunga</td>
<td>Angsuran Total</td>
</tr>
";

$no=1;
$sum_outstanding=0;
$sum_pokok=0;
$sum_bunga=0;
$sum_total=0;
foreach ($array as $name => $value) {
$output .="<tr>";
	
//    echo $name." ".$value['outstanding']."</br>";
//$round_total = round($value['angsuran_total'],0);	
$outstanding = number_format(round($value['outstanding'],0),0,',','.');
$angsuran_pokok = number_format(round($value['angsuran_pokok'],0),0,',','.');
$angsuran_bunga = number_format(round($value['angsuran_bunga'],0),0,',','.');
$angsuran_total = number_format(round($value['angsuran_total'],0),0,',','.');

$sum_outstanding += $value['outstanding'];
$sum_pokok += $value['angsuran_pokok'];
$sum_bunga += $value['angsuran_bunga'];
$sum_total += $value['angsuran_total'];
/*
$sum_outstanding += round($value['outstanding'],0);
$sum_pokok += round($value['angsuran_pokok'],0,PHP_ROUND_HALF_ODD);
$sum_bunga += number_format(round($value['angsuran_bunga'],0),0,',','.');
$sum_total += number_format(round($value['angsuran_total'],0),0,',','.');
*/


$output .="<td align='center' >";
$output .="".$no."";
$output .="</td>";

$output .="<td align='center' >";
$output .="".$value['tahun']."";
$output .="</td>";

$output .="<td align='center' >";
$output .="".$value['bulan']."";
$output .="</td>";

$output .="<td align='right' >";
//$output .="".round($value['outstanding'],0)."";
$output .="".$outstanding."";
$output .="</td>";

$output .="<td align='right' >";
//$output .="".round($value['angsuran_pokok'],0)."";
$output .="".$angsuran_pokok."";
$output .="</td>";

$output .="<td align='right' >";
//$output .="".round($value['angsuran_bunga'])."";
$output .="".$angsuran_bunga."";
$output .="</td>";

$output .="<td align='right' >";
$output .="".$angsuran_total."";
//$output .="".round($value['angsuran_total'],0)."";
$output .="</td>";

$output .="</tr>";
	
$no++;	
// $sum+= $value['angsuran_total'];
//$sum_tot=$sum;
}
//------
$output .="<td colspan='3' align='center' >";
$output .="TOTAL";
$output .="</td>";
/*
$output .="<td>";
$output .="";
$output .="</td>";

$output .="<td>";
$output .="";
$output .="</td>";
*/

$output .="<td align='right' >";
$output .="".number_format(round($sum_outstanding,0),0,',','.')."";
$output .="</td>";

$output .="<td align='right' >";
$output .="".number_format(round($sum_pokok,0),0,',','.')."";
$output .="</td>";

$output .="<td align='right' >";
$output .="".number_format(round($sum_bunga,0),0,',','.')."";
$output .="</td>";

$output .="<td align='right' >";
$output .="".number_format(round($sum_total,0),0,',','.')."";
$output .="</td>";

$output .="</tr>";
//-----

$output .="</table>";


echo $output;





//--------------------
/*
$output = "";

$output .= "<table border='1' >";

//------------------

$output .= "<tr>";

$output .= "<td>";
$output .= "No";
$output .= "</td>";

$output .= "<td>";
$output .= "Tahun";
$output .= "</td>";

$output .= "<td>";
$output .= "Bulan";
$output .= "</td>";


$output .= "<td>";
$output .= "Outstanding";
$output .= "</td>";

$output .= "<td>";
$output .= "Angsuran Pokok";
$output .= "</td>";

$output .= "<td>";
$output .= "Angsuran Bunga";
$output .= "</td>";

$output .= "<td>";
$output .= "Angsuran Total";
$output .= "</td>";

$output .= "</tr>";
//---------------------
$outstanding1=$nilai_kpr;		
$angsuran_pokok1=$angsuran_pokok;		
$angsuran_bunga1=$angsuran_bunga;		
$angsuran_total1=$angsuran_pokok1+$angsuran_bunga1;		
*/


//-----------------
/*
$x =[
"no" => "1",
"tahun" => "$tahun",
"bulan"=>"$nama_bln[$bulan]",
"outstanding1"=>"$outstanding1",
"angsuran_pokok1"=>"$angsuran_pokok1",
"angsuran_bunga1"=>"$angsuran_bunga1",
"angsuran_total1"=>"$angsuran_total1"
];
$angka =[1,2,3,4,5];
echo $angka;
//print_r($angka);

$output .= "<tr>";
$output .= "<td>";
$output .= "1";
$output .= "</td>";

$output .= "<td>";
$output .= "".$tahun."";
//$output .= "2017";
$output .= "</td>";

$output .= "<td>";
$output .= "".$nama_bln[$bulan]."";
//$output .= "11";
$output .= "</td>";


$output .= "<td>";
$output .= "".round($outstanding1,0)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".round($angsuran_pokok1,0)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".round($angsuran_bunga1,0)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".round($angsuran_total,0)."";
$output .= "</td>";


$output .= "</tr>";
*/
/*
$no=2;
$outstanding=$outstanding1-$angsuran_pokok1;
for($i=0;$i<=$tenor;$i++){

//print_r($i);	
//$angsur=$angsur – floor($hasil);
$bulan=$bulan+1;
//$bulan++;
$outstanding3=$outstanding1-$angsuran_pokok1;
//???
$angsuran_bunga=$outstanding*$bunga/12;
$angsuran_pokok=($angsuran_total+$angsuran_pokok)-$angsuran_bunga1;
$angsuran_total=$angsuran_total;

if ($bulan > 12){
$bulan=1;
$tahun=$tahun+1;
}else{
$bulan=$bulan;
}

$output .= "<tr>";

$output .= "<td>";
$output .= "".$no."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$tahun."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$nama_bln[$bulan]."";
$output .= "</td>";


$output .= "<td>";
$output .= "".floor($outstanding3)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".floor($angsuran_pokok)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".floor($angsuran_bunga)."";
$output .= "</td>";

$output .= "<td>";
$output .= "".floor($angsuran_total)."";
$output .= "</td>";


$output .= "</tr>";


$no++;
}

$output .= "</table>";


echo 	$output;
*/



//--------------

/*
*/	
//-----
}



function array_1(){
	
	
$this->load->helper('array');	
$outstanding1=1280000;		
$angsuran_pokok1=300000;		
$angsuran_bunga1=300000;		
$angsuran_total1=500000;		

//-----------------

$tgl_akad="07/07/2017";
$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
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

///------
/*
$x =[
"no" => "1",
"tahun" => "$tahun",
"bulan"=>"$nama_bln[$bulan]",
"outstanding1"=>"$outstanding1",
"angsuran_pokok1"=>"$angsuran_pokok1",
"angsuran_bunga1"=>"$angsuran_bunga1",
"angsuran_total1"=>"$angsuran_total1"
];
*/
/*
$array_temp = array(
"no" => 1,
"tahun" => $tahun,
"bulan"=>$nama_bln[$bulan],
"outstanding1"=>$outstanding1,
"angsuran_pokok1"=>$angsuran_pokok1,
"angsuran_bunga1"=>$angsuran_bunga1,
"angsuran_total1"=>$angsuran_total1
);
*/
$array_1 = array(
array(
 1,
 $tahun,
$nama_bln[$bulan],
$outstanding1,
$angsuran_pokok1,
$angsuran_bunga1,
$angsuran_total1),

array(
 2,
 $tahun,
$nama_bln[$bulan],
$outstanding1,
$angsuran_pokok1,
$angsuran_bunga1,
$angsuran_total1),

);

print_r($array_1);	
$tenor=120;
//------------------

$no=2;
for($i=0;$i<=$tenor;$i++){
//print_r($i);	
//$angsur=$angsur – floor($hasil);
$bulan=$bulan+1;
//$bulan++;
/*
$outstanding3=$outstanding1-$angsuran_pokok1;
//???
$angsuran_bunga=$outstanding*$bunga/12;
$angsuran_pokok=($angsuran_total+$angsuran_pokok)-$angsuran_bunga1;
$angsuran_total=$angsuran_total;
*/

if ($bulan > 12){
$bulan=1;
$tahun=$tahun+1;
}else{
$bulan=$bulan;
}




$no++;
}



//echo element('outstanding1', $array); // returns "red"
//echo $array[0]; // returns "red"
//print_r($array_1[2]);	
}

//+++++++
function array_push1(){
$this->load->helper('array');	
$outstanding1=1280000;		
$angsuran_pokok1=300000;		
$angsuran_bunga1=300000;		
$angsuran_total1=$angsuran_pokok1+$angsuran_bunga1;		

//-----------------

$tgl_akad="07/07/2017";
$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
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
	
//--------------	
/*
$array[] = array();
for ($x = 0; $x <= 1; $x++)
{
//    $array[] = $x;
  $array[] = array("number" => $x, "data" => "ZZZ", "status" => "Z");
}
*/	
//  $array[] = array("number" => 1, "data" => "ZZZ", "status" => "Z");
  $array[] = array(
  "no" => 1,
  "tahun" => $tahun,
  "bulan" =>$nama_bln[$bulan], 
  "outstanding" =>$outstanding1, 
  "angsuran_pokok" =>$angsuran_pokok1, 
  "angsuran_bunga" =>$angsuran_bunga1, 
  "angsuran_total" =>$angsuran_total1, 
  
  );

//print_r($array);
//print_r($array[0]['outstanding']);die();

//$array[] = array();
$no=2;
for ($x = 2; $x <= 10; $x++)
{
//   array_push($array, $x);
//    array_push($array[] = array("number" => $x, "data" => "XXXX", "status" => "A"));
//$array[] = array("number" => $x, "data" => "XXXX", "status" => "A");
$bulan = $bulan+1;
$no++;
if ($bulan > 12){
$bulan=1;
$tahun=$tahun+1;
}else{
$bulan=$bulan;
}
$z=$x-2;
$outstanding=$array[$z]['outstanding']-$array[$z]['angsuran_pokok'];
$angsuran_bunga=$angsuran_bunga1;
$angsuran_pokok=$array[$z]['angsuran_total']-$array[$z]['angsuran_bunga'];
$angsuran_total=$angsuran_pokok;
//---
//echo $x;
//echo '<br>';
//---
  $array[] = array(
  "no" => $x,
  "tahun" => $tahun,
  "bulan" =>$nama_bln[$bulan], 
  "outstanding" =>$outstanding, 
  "angsuran_pokok" =>$angsuran_pokok1, 
  "angsuran_bunga" =>$angsuran_bunga1, 
  "angsuran_total" =>$angsuran_total1, 
  
  );

$no;  

}

//print_r($array);
$output ="";
$output .="<table border='1' >";
foreach ($array as $name => $value) {
	
$output .="<tr>";
	
//    echo $name." ".$value['outstanding']."</br>";
	
$output .="<td>";
$output .="".$value['tahun']."";
$output .="</td>";

$output .="<td>";
$output .="".$value['bulan']."";
$output .="</td>";

$output .="<td>";
$output .="".$value['outstanding']."";
$output .="</td>";

$output .="<td>";
$output .="".$value['angsuran_pokok']."";
$output .="</td>";

$output .="<td>";
$output .="".$value['angsuran_bunga']."";
$output .="</td>";

$output .="<td>";
$output .="".$value['angsuran_total']."";
$output .="</td>";

$output .="</tr>";
	
}


$output .="</table>";


echo $output;

/*
*/	
/*
echo "<table border =\"1\" style='border-collapse: collapse'>";
	for ($row=1; $row <= 10; $row++) { 
		echo "<tr> \n";
		for ($col=1; $col <= 10; $col++) { 
		   $p = $col * $row;
		   echo "<td>$p</td> \n";
		   	}
	  	    echo "</tr>";
		}
		echo "</table>";	
*/	
	
	
/*

$size = 10;
$p = 0;
$myarray = array();
while($p < $size) {
  $myarray[] = array("number" => $p, "data" => "XXXX", "status" => "A");
  $p++;
}

print_r($myarray);	
*/
	
}


function get_detail_xxxxx($no_ktp_pemohon){
//print_r($no_ktp_pemohon);die();
	
     $id['no_ktp_pemohon']=$no_ktp_pemohon;
//       $id['batch_id']='001';
/*
        $data=array(
            'detail_data'=>$this->model_app->getSelectedData('upload_verivikasi',$id)->result(),
        );
*/	   
            $detail_data = $this->model_app->getSelectedData('upload_verivikasi',$id)->result();
//============
//$tenor =$detail_data[0]->TENOR;
$tenor =10;

$nama_pemohon =$detail_data[0]->NAMA_PEMOHON;
$tgl_akad2 =$detail_data[0]->TGL_AKAD;

$tgl_akad = strtotime($tgl_akad2);
$tgl_akad2 =date("Y-F-d", strtotime($tgl_akad2));
/*
print_r($tenor);
print_r('<br>');
print_r($tgl_akad);

die();			
*/


//=============
			
//$tgl_akad = strtotime('2011-01-01');
//======================

$start =  strtotime("-1 month", $tgl_akad);

//$end = date('Y-F', strtotime($start .+$tenor.' month'));
//$end = strtotime($start .+' month');

//$time = strtotime("2010.12.11");
$tenor1 = $tenor+1;
//array start 1 bukan 0

/////$end = date("Y-m-d", strtotime("+4 month", $start));
$end =  strtotime("+".$tenor1." month", $start);


//$end = strtotime('2011-06-01');
//echo $end_date = date('Y-F', strtotime($star_date .+$tenor.' month')); //added +1 month along with the $date

while($start < $end)
{
    $start = strtotime("+1 month", $start);
//	    $start = strtotime( $start);
	
    $year[] =  date('Y', $start) ;
	$month[] =   date('F', $start) ;
	
//$output.= "	 <td>".$year."</td>";
}
//------
for ($outstanding=0; $outstanding <= $tenor; $outstanding++) { 

	
    $out[] =   $outstanding;
	
//$output.= "	 <td>".$year."</td>";
}

print_r($out);

//print_r($month);

//$out = array("","123","123","123","123","123","123","123","123","123","123",);			
//print_r($detail_data);die();

$output= "";	
$output.= "TANGGAL AKAD :".$tgl_akad2."";	
$output.= "<br>";	
$output.= "NAMA PEMOHON :".$nama_pemohon."";	
$output.= "<br>";	
$output.= "TENOR :".$tenor."";	

$output.= "<table border='1' >";
$output.= "

  <tr>
    <th colspan='3' >Bulan</th>
    <th>Outstanding</th>
    <th>Pokok</th>
    <th>Bunga</th>
    <th>Total</th>
  </tr>
";

			
//foreach($detail_data as $items ){
	
//}	


for ($row=1; $row <= $tenor; $row++) { 
//$tenor = $row;



$output.= "
  <tr>
    <td>".$row."</td>";
//--------------------------------------
/*
$start = strtotime('2011-01-01');
$end = strtotime('2011-06-01');
while($start < $end)
{
    $start = strtotime("+1 month", $start);
	
    $year =  date('Y', $start) ;
	$month =  date('F', $start) ;

	
$output.= "	
    <td>".$year."</td>";
}
*/
	
//--------------------------------------
$output.= "	
<td>".$year[$row]."</td>
<td>".$month[$row]."</td>
	
    <td>".$out[$row]."</td>
    <td>555 77 854</td>
    <td>555 77 854</td>
    <td>555 77 855</td>
  </tr>
";


}

$output.= "</table>";



	
//	print_r($detail_data);die();
//temp
/*
$output="";
$output.="
	
<table style'width:100%'>
  <tr>
    <th colspan='3' >Bulan</th>
    <th>Outstanding</th>
    <th>Pokok</th>
    <th>Bunga</th>
    <th>Total</th>
  </tr>
  <tr>
    <td>555 77 854</td>
    <td>555 77 854</td>
    <td>555 77 855</td>
    <td>555 77 854</td>
    <td>555 77 854</td>
    <td>555 77 854</td>
    <td>555 77 855</td>
  </tr>
</table>
	
";
*/	
	
	
echo $output;	
	
}

function tes(){
	
	


		$nilai_kpr = 128000000;

		$tenor = 240;

		$bunga=5;

//		$bunga_rp = $nilai_kpr/$bunga;

//		$bunga_perbulan=$bunga/12;
//		$angsuran_pokok = $nilai_kpr/$tenor; //=====5
//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-(($bunga/12)+1)^-$tenor))-($bunga*($nilai_kpr/12)) ; //=====5


//$pangkat = (-$tenor*log((($bunga/12)+1)));
//print_r($pangkat);die();

//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-(($bunga/12)+1)^-$tenor))-($bunga*($nilai_kpr/12)) ; //=====5
//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-pow((($bunga/12)+1),-$tenor)))-($bunga*($nilai_kpr/12)) ; //=====5
			$angsuran_pokok = 311410 ; //=====5
//print_r($angsuran_pokok);die();
		
//		$angsuran_bunga=$nilai_kpr*$bunga_perbulan; //===6
		$angsuran_bunga=533333 ; //===6

		$jumlah = $angsuran_pokok+$angsuran_bunga; //=====7
		
//--------------------------------------------------	
	
///-------------------------
$tgl_akad = strtotime('2017/07/07');
//======================

//    $start = strtotime("+1 month", $tgl_akad);
	    $start =  $tgl_akad;
	


//bulan + jumlah tenor
$end =  strtotime("+".$tenor." month", $start);

//print_r(date('Y-F', $start ));
//print_r(date('Y-F', $end ));die();


while($start < $end)
{
	
//satu bulan setelahnya bulan akad
    $start = strtotime("+1 month", $start);
//	    $start = strtotime( $start);
	
    $year[] =  date('Y', $start) ;
	$month[] =   date('F', $start) ;

}
/*
*/
/*
print_r($year);
print_r('<br>');
print_r($month);
die();
*/

//-------------------	
	
		

		$output = "";

/*
		$output .= "<pre>";

		$output .="Jumlah Pinjaman          = "."<b>".$nilai_kpr."</b>"."<br>";

		$output .="Lama Pinjaman            = "."<b>".$lama_pinjaman." Bulan"."</b>"."<br>";

		$output .="Bunga per tahun          = "."<b>".$bunga.' %'."</b>"."<br>";

		$output .= "Bunga per bulan          = "."<b>".$bunga_perbulan.' %'."</b>".'<br>';

		$output .="<br>";

		$output .= "Angsuran Pokok Per Bulan = "."<b>".$angsuran_pokok."</b>"."<br>";

		$output .= "Angsuran Bunga Per Bulan = "."<b>".$angsuran_bunga."</b>"."<br>";

		$output .= "                           _____________________ ( + )<br>";

		$output .= "Total Angsuran Per Bulan = "."<b>".$jumlah."</b>";

		$output .= "</pre>";
*/





$output .="	<table border='1'>";

$output .="	

		<tr>

			<th>Angsuran ke -</th>
			
			
			<th>Tahun</th>
			
			<th>Bulan</th>
			
			<th>Outstanding</th>

			<th>Angsuran Pokok</th>

			<th>Angsuran Bunga</th>

			<th>Total Angsuran</th>


		</tr>
";
/*
$output .="	

		<tr>

			<td>0</td>

			<td>0</td>

			<td>0</td>

			<td>0</td>

			<td><b>".$nilai_kpr."</b></td>

		</tr>
";
*/

//-------------------------------------------------
$row=$nilai_kpr;

$no=1;
	

while ( $row > 1) { 

$row=$row-$angsuran_pokok; 
//$row=$angsuran_pokok-$angsuran_bunga; 
//$row=$nilai_kpr; 
$output .="


		<tr>

			<td>".$no."</td>
			
			
			<td></td>
			<td></td>

			<td>".$row."</td>
			
			<td>".$angsuran_pokok."</td>

			<td>".$angsuran_bunga."</td>

			<td>".$jumlah."</td>


		</tr>
";

$no++;
		}
/*
		$tot_ang_pokok=$angsuran_pokok*$tenor;

		$tot_ang_bunga=$angsuran_bunga*$tenor;

		$tot_jumlah=$jumlah*$tenor;



$output .="	

		<tr>

			<td></td>

			<td><b>".$tot_ang_pokok."</b></td>

			<td><b>".$tot_ang_bunga."</b></td>

			<td><b>".$tot_jumlah."</b></td>

			<td></td>

		</tr>
";
*/

$output .="	

	</table>
";

echo $output;
	
	
}



function tes2(){
	
	


		$nilai_kpr = 128000000;

		$tenor = 240;

		$bunga=5;

//		$bunga_rp = $nilai_kpr/$bunga;

//		$bunga_perbulan=$bunga/12;
//		$angsuran_pokok = $nilai_kpr/$tenor; //=====5
//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-(($bunga/12)+1)^-$tenor))-($bunga*($nilai_kpr/12)) ; //=====5


//$pangkat = (-$tenor*log((($bunga/12)+1)));
//print_r($pangkat);die();

//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-(($bunga/12)+1)^-$tenor))-($bunga*($nilai_kpr/12)) ; //=====5
//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-pow((($bunga/12)+1),-$tenor)))-($bunga*($nilai_kpr/12)) ; //=====5
			$angsuran_pokok = 311410 ; //=====5
//print_r($angsuran_pokok);die();
		
//		$angsuran_bunga=$nilai_kpr*$bunga_perbulan; //===6
		$angsuran_bunga=533333 ; //===6

		$jumlah = $angsuran_pokok+$angsuran_bunga; //=====7
		
//--------------------------------------------------	
	
///-------------------------
$tgl_akad = strtotime('2017/07/07');
//======================

//    $start = strtotime("+1 month", $tgl_akad);
	    $start =  $tgl_akad;
	


//bulan + jumlah tenor
$end =  strtotime("+".$tenor." month", $start);

//print_r(date('Y-F', $start ));
//print_r(date('Y-F', $end ));die();

for ($x=$start; $x <= $end; $x++) { 

/*
while($start < $end)
{
	
//satu bulan setelahnya bulan akad
    $start = strtotime("+1 month", $start);
	
//	    $start = strtotime( $start);
	
    $year[] =  date('Y', $start) ;
	$month[] =   date('F', $start) ;
*/
print_r($x);
print_r('<br>');

}

//die();
/*
*/
/*
print_r($year);
print_r('<br>');
print_r($month);
die();
*/

//-------------------	
	
		

		$output = "";

/*
		$output .= "<pre>";

		$output .="Jumlah Pinjaman          = "."<b>".$nilai_kpr."</b>"."<br>";

		$output .="Lama Pinjaman            = "."<b>".$lama_pinjaman." Bulan"."</b>"."<br>";

		$output .="Bunga per tahun          = "."<b>".$bunga.' %'."</b>"."<br>";

		$output .= "Bunga per bulan          = "."<b>".$bunga_perbulan.' %'."</b>".'<br>';

		$output .="<br>";

		$output .= "Angsuran Pokok Per Bulan = "."<b>".$angsuran_pokok."</b>"."<br>";

		$output .= "Angsuran Bunga Per Bulan = "."<b>".$angsuran_bunga."</b>"."<br>";

		$output .= "                           _____________________ ( + )<br>";

		$output .= "Total Angsuran Per Bulan = "."<b>".$jumlah."</b>";

		$output .= "</pre>";
*/





$output .="	<table border='1'>";

$output .="	

		<tr>

			<th>Angsuran ke -</th>
			
			
			<th>Tahun</th>
			
			<th>Bulan</th>
			
			<th>Outstanding</th>

			<th>Angsuran Pokok</th>

			<th>Angsuran Bunga</th>

			<th>Total Angsuran</th>


		</tr>
";
/*
$output .="	

		<tr>

			<td>0</td>

			<td>0</td>

			<td>0</td>

			<td>0</td>

			<td><b>".$nilai_kpr."</b></td>

		</tr>
";
*/

//-------------------------------------------------
//$row=$nilai_kpr;

print_r($year);
print_r('<br>');
print_r($month);

$no=1;
for ($row=1; $row <= $tenor; $row++) { 
//while ( $row > 1) { 

//$row=$row-$angsuran_pokok; 
//$row=$angsuran_pokok-$angsuran_bunga; 
//$row=$nilai_kpr; 
$output .="


		<tr>

			<td>".$no."</td>
			
			
			<td>".$year[$row]."</td>
			<td>".$month[$row]."</td>

			<td>".$nilai_kpr."</td>
			
			<td>".$angsuran_pokok."</td>

			<td>".$angsuran_bunga."</td>

			<td>".$jumlah."</td>


		</tr>
";

$no++;
		}
/*
		$tot_ang_pokok=$angsuran_pokok*$tenor;

		$tot_ang_bunga=$angsuran_bunga*$tenor;

		$tot_jumlah=$jumlah*$tenor;



$output .="	

		<tr>

			<td></td>

			<td><b>".$tot_ang_pokok."</b></td>

			<td><b>".$tot_ang_bunga."</b></td>

			<td><b>".$tot_jumlah."</b></td>

			<td></td>

		</tr>
";
*/

$output .="	

	</table>
";

echo $output;
	
	
}



function tes_for_date(){

//print_r("xxxxxxxxxxxxxxxxxxxxxxx");die();

//--------------------------------------------------	
/*
	
$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
//$nip=$_POST[nip];

$tgl_akad = '2017/07/09';
//y-m-d

//memecah tanggal dari sistem jadi $tanggal,$bulan,$tahun…
$orderdate = explode('/', $tgl_akad);
$year_1 = $orderdate[0];
$month_1   = $orderdate[1];
$day  = $orderdate[2];


if ($month_1< 10) {
$month_1=str_replace("0",'',$month_1);
}else{
$month_1=$month_1;
}
//print_r($month_1);die();
*/
//----------------------------------
/*

$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
 $nama='joko';
$nip='12345';
$tgl='2017-12-30';

//memecah tanggal dari sistem jadi $tanggal,$bulan,$tahun…

list($awal,$tengah,$akhir)=explode('-',$tgl,3);
 $tanggal=$akhir;
//echo “-“;
if ($tengah < 10) {
$bulan=str_replace("0",'',$tengah);
}else{
$bulan=$tengah;
}

//$bulan=$tengah;
echo $nama_bln[$bulan];
echo "-";
echo $tahun=$awal;

$pokok=1000000;
$jangka=120;


//rumus hitung pokok yang harus di bayar tiap bulan
$pokok_b=($pokok / $jangka);


//pembulatan pokok angsuran

$sisa = $pokok_b % 100;
if ($sisa > 0){
//$bulat= 100–$sisa;
$hasil=$pokok_b + $bulat;
}
else{
$hasil=$pokok_b;
}


//rumus hitung bunga atau jasa flat 2 % per bulan
$jasa=($pokok*0.02);


//pembulatan Jasa angsuran
$sisa_j = $jasa % 100;
if ($sisa_j > 0){
echo $bulat_j= 100 – $sisa_j;
$hasil_j=$jasa+ $bulat_j;
}
else{
$hasil_j=$jasa;
}

//total yang harus dibayar tiap bula (pokok+jasa)
$total=($hasil+$hasil_j);


$angsur=$pokok;
*/

$bulan =10 ;
$tahun =2017;
$nilai_kpr = 128000000;

$tenor =120 ;
//$outstanding = $nilai_kpr;
$angsuran_pokok = 311410;
$angsuran_bunga = 533333;
$angsuran_total = $angsuran_pokok + $angsuran_bunga;



$output = "";

$output .= "<table border='1' >";

//------------------
//tr statis
$output .= "<tr>";

$output .= "<td>";
$output .= "No";
$output .= "</td>";

$output .= "<td>";
$output .= "Tahun";
$output .= "</td>";

$output .= "<td>";
$output .= "Bulan";
$output .= "</td>";


$output .= "<td>";
$output .= "Outstanding";
$output .= "</td>";

$output .= "<td>";
$output .= "Angsuran Pokok";
$output .= "</td>";

$output .= "<td>";
$output .= "Angsuran Bunga";
$output .= "</td>";

$output .= "<td>";
$output .= "Angsuran Total";
$output .= "</td>";

$output .= "</tr>";
//---------------------
$outstanding1=$nilai_kpr;		
$angsuran_pokok1=$angsuran_pokok;		
$angsuran_bunga1=$angsuran_bunga;		
$angsuran_total1=$angsuran_pokok1+$angsuran_bunga1;		

//-----------------
$output .= "<tr>";

$output .= "<td>";
$output .= "1";
$output .= "</td>";

$output .= "<td>";
//$output .= "".$tahun."";
$output .= "2017";
$output .= "</td>";

$output .= "<td>";
//$output .= "".$bulan."";
$output .= "11";
$output .= "</td>";


$output .= "<td>";
$output .= "".$outstanding1."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$angsuran_pokok1."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$angsuran_bunga1."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$angsuran_total1."";
$output .= "</td>";


$output .= "</tr>";


//--------------


$no=2;
for($i=2;$i<=$tenor;$i++){

//print_r($i);	
//$angsur=$angsur – floor($hasil);
$bulan=$bulan+1;
//$bulan++;
$outstanding=$outstanding1-$angsuran_pokok1;
$angsuran_pokok=$angsuran_bunga1-$angsuran_pokok1;
$angsuran_bunga=$angsuran_bunga1;
$angsuran_total=$angsuran_bunga1+$angsuran_bunga1;
/*
*/
/*
$outstanding=$i;
//$outstanding_array[]=$i;
$angsuran_pokok=$i;
$angsuran_bunga=$i;
*/

//print_r($outstanding_array);
/*
if($i==1){
$outstanding1=$nilai_kpr;		
$angsuran_pokok1=$angsuran_pokok;		
$angsuran_bunga1=$angsuran_bunga;		
$angsuran_total1=$angsuran_pokok1+$angsuran_bunga1;		


}else{
//ambil nilai array diatasnya????
//print_r($outstanding1);
	
$outstanding1=$nilai_kpr-$angsuran_pokok;		
$angsuran_pokok1=$angsuran_pokok-$angsuran_bunga1;		
$angsuran_bunga1=$angsuran_bunga;		
	
	
	
}
*/

//$outstanding_array[]=$outstanding1;
//print_r($outstanding_array);


/*
else{
//$outstanding1=$outstanding1-$angsuran_pokok1;			
$outstanding1=$outstanding1;			
}
*/

/*
if($angsuran_pokok1==1){
$angsuran_pokok1=$angsuran_pokok;		
}
else{
$angsuran_pokok1=99999999999;			
}

if($angsuran_bunga1==1){
$angsuran_bunga1=$angsuran_bunga;		
}
else{
$angsuran_bunga1=99999999999;			
}
*/


//print_r($outstanding);

if ($bulan > 12){
$bulan=1;
$tahun=$tahun+1;
}else{
$bulan=$bulan;
}

$output .= "<tr>";

$output .= "<td>";
$output .= "".$no."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$tahun."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$bulan."";
$output .= "</td>";


$output .= "<td>";
$output .= "".$outstanding."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$angsuran_pokok."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$angsuran_bunga."";
$output .= "</td>";

$output .= "<td>";
$output .= "".$angsuran_total."";
$output .= "</td>";


$output .= "</tr>";
/*
//print_r($i);
print_r($no);
print_r('<br>');	
print_r($tahun);
print_r('<br>');	
print_r($bulan);
print_r('<br>');	
*/




/*
echo"
<tr>
<td>".$i ;."</td>
<td>".floor($hasil);."/td>
<td>".floor($hasil_j);."/td>
<td>".floor($total );."/td>
<td>".$angsur ;."/td>
<td>".$tanggal-;."".$nama_bln[$bulan]-;."".$tahun ;."</td>
<td></td>
</tr>
";
*/	
$no++;
}

$output .= "</table>";


echo 	$output;
}




function add_month(){
	
$star_date = "2013-09-11"; //existing date

$tenor = 3;

echo $star_date ;
echo '<br>' ;

//echo $end_date = date('Y-m-d', strtotime($star_date .+$tenor.' month')); //added +1 month along with the $date
echo $end_date = date('Y-F', strtotime($star_date .+$tenor.' month')); //added +1 month along with the $date

	
}

function month(){
/*
$start = '2013-08-25';
$end = '2013-08-29';
$datediff = strtotime($end) - strtotime($start);
$datediff = floor($datediff/(60*60*24));
for($i = 0; $i < $datediff + 1; $i++){
    echo date("Y-m-d", strtotime($start . ' + ' . $i . 'day')) . "<br>";
}
*/	



$start = strtotime('2011-01-01');
$end = strtotime('2011-06-01');
while($start < $end)
{
    $start = strtotime("+1 month", $start);
	
    $year =  date('Y', $start) ;
	$month =  date('F', $start) ;
print_r($year);
print_r('-');
print_r($month);	
print_r('<br>');
	
}


	
	
}

	
	
	function get_batch(){
		
//print_r($data['data_verivikasi']);die();
$output= "";	
$output.= "<table>";

$output.= "<tr>";
/*
$output.= "<td>";
$output.= "NO";
$output.= "</td>";
*/

$output.= "<td>";
$output.= "NAMA";
$output.= "</td>";

$output.= "<td>";
$output.= "TANGGAL";
$output.= "</td>";

$output.= "<td>";
$output.= "NILAI KPR";
$output.= "</td>";

$output.= "<td>";
$output.= "TENOR";
$output.= "</td>";

$output.= "<td>";
$output.= "NILAI FLPP";
$output.= "</td>";


$output.= "<td>";
$output.= "AKSI";
$output.= "</td>";


$output.= "</tr>";

 $data_verivikasi = $this->model_app->getAllData('upload_verivikasi');
 
//print_r($data_verivikasi);die(); 
//$i=1; $no=1; 
 foreach($data_verivikasi as $items ){
	//$nama_pemohon = $items->NAMA_PEMOHON; 

//print_r($nama_pemohon);die(); 
/*
*/
	 


//looping

$output.= "<tr>";
/*
$output.= "<td>";
$output.= $no;
$output.= "</td>";
*/


$output.= "<td>";
$output.= $items->NAMA_PEMOHON;
$output.= "</td>";

$output.= "<td>";
$output.= $items->TGL_AKAD;
$output.= "</td>";

$output.= "<td>";
$output.= $items->NILAI_KPR;
$output.= "</td>";

$output.= "<td>";
$output.= $items->TENOR;
$output.= "</td>";

$output.= "<td>";
$output.= $items->NILAI_FLPP;
$output.= "</td>";

$output.= "<td>";
//$output.= "<button>Generate</button>";
$output.= "<a href='report/get_detail/".$items->NO_KTP_PEMOHON."/' >Generate<a/>";

$output.= "</td>";

$output.= "</tr>";

//$i++; $no++;	 
 }


$output.= "</table>";

echo $output;
	
	}

    function insert_db(){
$data = array(
   array(
      'title' => 'My title' ,
      'name' => 'My Name' ,
      'date' => 'My date'
   ),
   array(
      'title' => 'Another title' ,
      'name' => 'Another Name' ,
      'date' => 'Another date'
   )
);
print_r($data);die();

//$this->db->insert_batch('mytable', $data);  
    }

/*
*/


	
	
	
}

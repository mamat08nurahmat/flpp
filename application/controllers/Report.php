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

//detail by month & year
function detail(){
        $data=array(
            'title'=>'Master Data',
//            'active_master'=>'active',

			
            'data_verivikasi'=>$this->model_app->getAllData('upload_verivikasi'),

        );

        $this->load->view('pages/v_report_detail');

    }

function get_detail(){

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
$output.= "<a href='".site_url("report/get_detail_id/".$items->NO_KTP_PEMOHON."/")."' target='_blank' >Detail<a/>";

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
$pangkat = pow((($bunga/12)+1),-$tenor);


//		$angsuran_pokok = $nilai_kpr*(($bunga/12)/(1-(($bunga/12)+1)^-$tenor))-($bunga*($nilai_kpr/12)) ; //=====5
		$angsuran_pokok1 = $nilai_kpr*(($bunga/12)/(1-pow((($bunga/12)+1),-$tenor)))-($bunga*($nilai_kpr/12)) ; //=====5

//print_r($angsuran_pokok1);die();		
//			$angsuran_pokok1 = 311410 ; //=====5
		
		$angsuran_bunga1=$nilai_kpr*$bunga/12; //===6
		//$angsuran_bunga=533333 ; //===6

		 //=====7		
$angsuran_total1= $angsuran_pokok1+$angsuran_bunga1;
/*
print_r('<br>');
print_r($pangkat);
print_r('<br>');
print_r($angsuran_pokok1);
print_r('<br>');
print_r($angsuran_bunga1);
print_r('<br>');
print_r($angsuran_total1);die();
*/		
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

print_r($array);

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
$output .="".$angsuran_total1."";
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
/*
$cek = $this->db->insert_batch('total', $temp_array_detail);  


if($cek){
print_r('OK');	
	
}else{
	
print_r('GAGAL');	
	
}
*/
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
	
//$data_generate = $this->model_app->getSelectedData("upload_verivikasi",$id)->result();	

$data_generate=$this->db->query("
SELECT 
batch_id,
bulan,
tahun,
sum(outstanding) as outstanding ,
sum(angsuran_pokok) as angsuran_pokok,
sum(angsuran_bunga) as estimasi_angsuran,
sum(angsuran_total) as angsuran_total  ,
(outstanding-angsuran_pokok) as angsuran_sisa  
FROM total
WHERE batch_id='$batch_id'
group by batch_id,tahun,bulan
order by batch_id,tahun

")->result();

//print_r($data_generate);die();

/*
SELECT 
batch_id,
bulan,
tahun,
round(sum(outstanding),2),
sum(angsuran_pokok),
sum(angsuran_bunga),
sum(angsuran_total)  
FROM total
group by batch_id,tahun,bulan
order by batch_id,tahun
*/
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


$output.= "</tr>";

$nama_bln=array(1=>'January','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');

//-------------
//tr looping
$no=1;
$sum_angsuran_pokok=0;
$sum_estimasi_angsuran=0;
foreach($data_generate as  $value ){


$sum_angsuran_pokok +=$value->angsuran_pokok;
$sum_estimasi_angsuran +=$value->estimasi_angsuran;

$output.= "<tr>";

$output.= "<td align='center' >";
$output.= $no;
$output.= "</td>";

$output.= "<td align='center' >";
$output .=$value->tahun;
//$output.= "".$no."";
$output.= "</td>";

$output.= "<td align='center' >";
//$output.= "".$no."";
$output .=$nama_bln[$value->bulan];
$output.= "</td>";

$output.= "<td align='center' >";
$output .=round($value->outstanding,0);
$output.= "</td>";

$output.= "<td align='center' >";
$output .=round($value->angsuran_pokok,0);
$output.= "</td>";

$output.= "<td align='center' >";
$output .=round($value->estimasi_angsuran,0);
$output.= "</td>";

$output.= "<td>";
$output .=round($value->angsuran_sisa,0);
$output.= "</td>";

$output.= "</tr>";
	
	$no++;	
}

//----------------
$output.= "<tr>";

$output.= "<td align='center' colspan='4' >";
$output.= "TOTAL";
$output.= "</td>";
/*
$output.= "<td align='center' >";
$output .=$value->tahun;
//$output.= "".$no."";
$output.= "</td>";

$output.= "<td align='center' >";
//$output.= "".$no."";
$output .=$nama_bln[$value->bulan];
$output.= "</td>";

$output.= "<td align='center' >";
$output .=$value->outstanding;
$output.= "</td>";
*/

$output.= "<td align='center' >";
$output .=$value->angsuran_pokok;
$output.= "</td>";

$output.= "<td align='center' >";
$output .=$value->estimasi_angsuran;
$output.= "</td>";
/*
*/
$output.= "<td>";
//$output .=$value->angsuran_sisa;
$output .="";
$output.= "</td>";

$output.= "</tr>";


//---------------------

/*
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

  
  );

//$no;  

}
//--------

//tr looping
$no=1;

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
*/

$output.= "</table>";

echo $output;

	
}


function generate(){
	
/*
*/	
        $data=array(
            'title'=>'Master Data',
//            'active_master'=>'active',

			
            'data_verivikasi'=>$this->model_app->getAllData('upload_verivikasi'),

        );

        $this->load->view('pages/v_generate2');


    }
	
	
function get_generate_batch(){
	

$batch_id= $this->input->post('batch_id');

$id['batch_id']= $batch_id;	
	
$data_generate = $this->model_app->getSelectedData("upload_verivikasi",$id)->result();	


/*

 foreach($data_generate as $key=>$items ){
	 
$no_ktp_pemohon[]=array($items['NO_KTP_PEMOHON']);
	 
 }


print_r($no_ktp_pemohon);die();

*/
$output= "";	
$output.= "<table border='1'>";

$output.= "<tr>";

$output.= "<td>";
$output.= "NO";
$output.= "</td>";

$output.= "<td>";
$output.= "NAMA";
$output.= "</td>";

$output.= "<td>";
$output.= "NO KTP";
$output.= "</td>";


/*
$output.= "<td>";
$output.= "NILAI KPR";
$output.= "</td>";

$output.= "<td>";
$output.= "TENOR";
$output.= "</td>";

$output.= "<td>";
$output.= "NILAI FLPP";
$output.= "</td>";
*/

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
$output.= $items->NO_KTP_PEMOHON;
$output.= "</td>";
/*
$output.= "<td>";
$output.= $items->NILAI_KPR;
$output.= "</td>";

$output.= "<td>";
$output.= $items->TENOR;
$output.= "</td>";

$output.= "<td>";
$output.= $items->NILAI_FLPP;
$output.= "</td>";
*/

$output.= "<td>";
//$output.= "<button>Generate</button>";
//$output.= "<a href='report/get_detail/".$items->NO_KTP_PEMOHON."/' >Detail<a/>";
$output.= "<a href='".site_url("report/get_generate_id/".$items->NO_KTP_PEMOHON."/")."' target='new_blank' >GENERATE TOTAL<a/>";

$output.= "</td>";

$output.= "</tr>";

//$i++; \
$no++;	 
 }


$output.= "</table>";

//
echo $output;

	
	
}	

function page(){
echo "XXXXXXXXXXXXX" ;	
	
}

function redirect(){
	
//$list_last = $image->total;
$r=0;
for ($i = 1; $i <= 10; $i++)
  {
$r++;  
$r = redirect('/report/page', 'refresh');
//  if ($_GET['pid'] != $i) echo "<a href='http://www.noahd.net/demo-upwall/residential/rooftop-garden/15/?pid=".$i."'> ".$i." </a>";
//  else echo $i;
  }	
	
}
	


function get_generate_id($no_ktp_pemohon){
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
$batch_id =$detail_data[0]->batch_id; //tenor
//print_r($batch_id);die();
$no_ktp_pemohon =$detail_data[0]->NO_KTP_PEMOHON; //tenor


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
  "no_ktp_pemohon" =>$no_ktp_pemohon, 
  "batch_id" =>$batch_id, 
  
  );
//$no=2;
for ($x = 1; $x < $tenor; $x++)
{

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

$outstanding=$array[$y]['outstanding']-$array[$y]['angsuran_pokok'];
$angsuran_bunga=$outstanding*$bunga/12;
$angsuran_pokok=$angsuran_total1-$angsuran_bunga;

  $array[] = array(
  "no" => $x,
  "tahun" => $tahun,
//  "bulan" =>$nama_bln[$bulan], 
   "bulan" =>$bulan, 
  "outstanding" =>$outstanding, 
  "angsuran_pokok" =>$angsuran_pokok, 
  "angsuran_bunga" =>$angsuran_bunga, 
  "angsuran_total" =>$angsuran_total1,
  "no_ktp_pemohon" =>$no_ktp_pemohon, 
  "batch_id" =>$batch_id, 
  
  
  );

//$no;  

}



//$no=1;
$sum_outstanding=0;
$sum_pokok=0;
$sum_bunga=0;
$sum_total=0;
foreach ($array as $name => $value) {
	
//    echo $name." ".$value['outstanding']."</br>";
//$round_total = round($value['angsuran_total'],0);
/*
$outstanding = number_format(round($value['outstanding'],0),0,',','.');
$angsuran_pokok = number_format(round($value['angsuran_pokok'],0),0,',','.');
$angsuran_bunga = number_format(round($value['angsuran_bunga'],0),0,',','.');
$angsuran_total = number_format(round($value['angsuran_total'],0),0,',','.');
*/	

$outstanding = $value['outstanding'];
$angsuran_pokok = $value['angsuran_pokok'];
$angsuran_bunga = $value['angsuran_bunga'];
$angsuran_total = $value['angsuran_total'];

$sum_outstanding += $value['outstanding'];
$sum_pokok += $value['angsuran_pokok'];
$sum_bunga += $value['angsuran_bunga'];
$sum_total += $value['angsuran_total'];


$sum_outstanding1 = number_format(round($sum_outstanding,0),0,',','.');
$sum_pokok1 = number_format(round($sum_pokok,0),0,',','.');
$sum_bunga1 = number_format(round($sum_bunga,0),0,',','.');
$sum_total1 = number_format(round($sum_total,0),0,',','.');
	
	
 $temp_array_detail[] = array(
//$no_ktp_pemohon 
//  "no" => $no,
  "tahun" => $value['tahun'],
  "bulan" => $value['bulan'],
  "outstanding" => $outstanding,
  "angsuran_pokok" => $angsuran_pokok,
  "angsuran_bunga" => $angsuran_bunga,
  "angsuran_total" => $angsuran_total,
  "no_ktp_pemohon" =>$no_ktp_pemohon, 
  "batch_id" =>$batch_id, 
  
//  "sum_outstanding1" => $angsuran_total,
  //"sum_pokok1" => $sum_pokok1,
  //"sum_bunga1" => $sum_bunga1,
  //"sum_total1" => $sum_total1,

  );	 

	
	
//$no++;	
// $sum+= $value['angsuran_total'];
//$sum_tot=$sum;
}
//------
/*
$output .="<td colspan='3' align='center' >";
$output .="TOTAL";
$output .="</td>";

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
*/


//print_r($temp_array_detail);die();

//$input_data = implode("-",$temp_array_detail);

$cek = $this->db->insert_batch('total', $temp_array_detail);  


if($cek){
print_r($no_ktp_pemohon);	
print_r('<br>'.'OK');	
	
}else{
	
print_r('GAGAL');	
	
}
/*
*/
}



	
	
	
}

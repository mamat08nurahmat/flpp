<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadcsv extends CI_Controller {

public function __construct()
{
    parent::__construct();
    $this->load->helper('url');                    
    $this->load->model('model_app','welcome');
}

public function index()
{
	$this->data['view_data']= $this->welcome->view_data();
  $this->load->view('excelimport', $this->data, FALSE);
}

	//////////////////Import subscriber emails ////////////////////////////////
public function importbulkemail(){
	$this->load->view('excelimport');
}

function batch(){
	
$batch =	$this->data['view_data']= $this->welcome->getBatchID();	
print_r($batch);die();

}

function today(){
//$today = date("Ymd");	
	$month = date("m");	
	$year = date("Y");
	
	print_r($month);
	print_r($year);die();
}

public function import()
        {
  if(isset($_POST["import"]))
    {
//dummy
$batch_id =	$this->data['view_data']= $this->welcome->getBatchID();	
	$month = date("m");	
	$year = date("Y");

		
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
          {
            $file = fopen($filename, "r");
             while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
             {
                    $data = array(
              //          'no_id' => $importdata[0],
'NAMA_PEMOHON' =>$importdata[0],	
'PEKERJAAN_PEMOHON' =>$importdata[1],	
'JENIS_KELAMIN' =>$importdata[2],
'NO_KTP_PEMOHON' =>$importdata[3],	
'NPWP_PEMOHON' =>$importdata[4],	
'GAJI_POKOK' =>$importdata[5], 	 
'NAMA_PASANGAN' =>$importdata[6],
'NO_KTP_PASANGAN' =>$importdata[7],
'NO_REKENING_PEMOHON' =>$importdata[8],	
'TGL_AKAD' =>$importdata[9],	
'HARGA_RUMAH' =>$importdata[10],	
'NILAI_KPR' =>$importdata[11],	
'SUKU_BUNGA_KPR' =>$importdata[12],	
'TENOR' =>$importdata[13],	
'ANGSURAN_KPR' =>$importdata[14],	
'NILAI_FLPP' =>$importdata[15],	
'NAMA_PENGEMBANG' =>$importdata[16],	
'NAMA_PERUMAHAN' =>$importdata[17],	
'ALAMAT_AGUNAN' =>$importdata[18],	
'KOTA_AGUNAN' =>$importdata[19],	
'KODE_POS_AGUNAN' =>$importdata[20],	
'LUAS_TANAH' =>$importdata[21],
'LUAS_BANGUNAN' =>$importdata[22],			  
			  
/*
                        'nama' =>$importdata[0],
                        'tanggal_akad' => $importdata[1],
                        'nilai_kpr' =>$importdata[2],
                        'tenor' => $importdata[3],
                        'nilai_flpp' =>$importdata[4],
*/			  
						
                        'batch_id' =>$batch_id,
                        'month' =>$month,
                        'year' =>$year,
                        //'created_date' => date('Y-m-d'),
                        );
	//		$this->session->set_flashdata('message', "$data['name']");
	
	///echo $data['name'] ;
	
				
             $insert = $this->welcome->insertCSV($data);
             }                    
            fclose($file);
			echo "<script>alert('Hello');</script>";
				//print_r($data['name']);die();	
			//echo $data['name'];
			//echo $data['email'];
			//die();
			$this->session->set_flashdata('message', 'Data are imported successfully..');
				redirect('uploadcsv/index');
          }else{
			$this->session->set_flashdata('message', 'Something went wrong..');
			redirect('uploadcsv/index');
		}
    }
}


/////////////////////////////////Import subscriber emails ////////////////////////////////

}

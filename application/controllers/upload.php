<?php
class Upload extends CI_Controller{
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

    function index(){
//$batch_id =	 $this->model_app->getBatchID();
//print_r($batch_id);die();
        $data=array(
            'title'=>'Upload',
//            'active_dashboard'=>'active',
//            'dt_upload'=>$this->model_app->getAllData('upload_verivikasi'),
              'dt_upload'=>$this->db->query("SELECT * FROM upload_verivikasi ORDER BY batch_id DESC LIMIT 50 ")->result(),
			  'batch_id' => $this->model_app->getBatchID(),

        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_upload');
        $this->load->view('element/v_footer');
    }


public function import()
        {
  if(isset($_POST["import"]))
    {
//dummy
//$batch_id =	$this->data['view_data']= $this->model_app->getBatchID();
//$batch_id =	$_POST[''];
$batch_id = $this->input->post('batch_id');
	$month = date("m");
	$year = date("Y");


        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
          {
            $file = fopen($filename, "r");

//pemisah csv dengan ";"
             while (($importdata = fgetcsv($file, 10000,  ";" )) !== FALSE)
             {
                    $data = array(
              //          'no_id' => $importdata[0],
'NAMA_PEMOHON' =>$importdata[0],
'PEKERJAAN_PEMOHON' =>$importdata[1],
'JENIS_KELAMIN' =>$importdata[2],
'NO_KTP_PEMOHON' =>trim($importdata[3]),
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


             $insert = $this->model_app->insertCSV($data);
             }
            fclose($file);
			echo "<script>alert('Hello');</script>";
				//print_r($data['name']);die();
			//echo $data['name'];
			//echo $data['email'];
			//die();
			$this->session->set_flashdata('message', 'Data are imported successfully..');
				redirect('upload/index');
          }else{
			$this->session->set_flashdata('message', 'Something went wrong..');
			redirect('upload/index');
		}
    }
}




}

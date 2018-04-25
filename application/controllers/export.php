<?php
class Export extends CI_Controller{
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
print_r("XXXXXXXXXXXXXXXXXX");die();
/*
//$batch_id =	 $this->model_app->getBatchID();
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
*/
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

//==========================

//   public function export($table, $subject = 'file')
     public function export($table,$bulan,$tahun,$batch_id, $subject = 'file')
    {
        $this->load->library('excel');

//        $result = $this->db->get($table);
        $this->db->where('bulan',$bulan);
        $this->db->where('tahun',$tahun);
        $this->db->where('batch_id',$batch_id);
        $result = $this->db->get($table);

        $this->excel->setActiveSheetIndex(0);

        $fields = $result->list_fields();



        $alphabet = 'ABCDEFGHIJKLMOPQRSTUVWXYZ';
        $alphabet_arr = str_split($alphabet);
        $column = [];

        foreach ($alphabet_arr as $alpha) {
            $column[] =  $alpha;
        }

        foreach ($alphabet_arr as $alpha) {
            foreach ($alphabet_arr as $alpha2) {
                $column[] =  $alpha.$alpha2;
            }
        }
        foreach ($alphabet_arr as $alpha) {
            foreach ($alphabet_arr as $alpha2) {
                foreach ($alphabet_arr as $alpha3) {
                    $column[] =  $alpha.$alpha2.$alpha3;
                }
            }
        }

        foreach($column as $col)
        {
            $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(20);
        }

        $col_total = $column[count($fields)-1];

        //styling
        $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.'1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => 'DA3232')
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                )
            )
        );

        $phpColor = new PHPExcel_Style_Color();
        $phpColor->setRGB('FFFFFF');

        $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.'1')->getFont()->setColor($phpColor);

        $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(40);

        $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.'1')
        ->getAlignment()->setWrapText(true);

        $col = 0;
        foreach ($fields as $field)
        {

            $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords(str_replace('_', ' ', $field)));
            $col++;
        }

        $row = 2;
        foreach($result->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }

            $row++;
        }

        //set border
        $styleArray = array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
              )
          );
        $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.''.$row)->applyFromArray($styleArray);

        $this->excel->getActiveSheet()->setTitle(ucwords($subject));

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.ucwords($subject).'-'.date('Y-m-d').'.xls');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }


//----

public function griya_all($table, $subject = 'file')
{
   $this->load->library('excel');

//        $result = $this->db->get($table);
   // $this->db->where('bulan',$bulan);
   // $this->db->where('tahun',$tahun);
   // $this->db->where('batch_id',$batch_id);
   $result = $this->db->get($table);

   $this->excel->setActiveSheetIndex(0);

   $fields = $result->list_fields();



   $alphabet = 'ABCDEFGHIJKLMOPQRSTUVWXYZ';
   $alphabet_arr = str_split($alphabet);
   $column = [];

   foreach ($alphabet_arr as $alpha) {
       $column[] =  $alpha;
   }

   foreach ($alphabet_arr as $alpha) {
       foreach ($alphabet_arr as $alpha2) {
           $column[] =  $alpha.$alpha2;
       }
   }
   foreach ($alphabet_arr as $alpha) {
       foreach ($alphabet_arr as $alpha2) {
           foreach ($alphabet_arr as $alpha3) {
               $column[] =  $alpha.$alpha2.$alpha3;
           }
       }
   }

   foreach($column as $col)
   {
       $this->excel->getActiveSheet()->getColumnDimension($col)->setWidth(20);
   }

   $col_total = $column[count($fields)-1];

   //styling
   $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.'1')->applyFromArray(
       array(
           'fill' => array(
               'type' => PHPExcel_Style_Fill::FILL_SOLID,
               'color' => array('rgb' => 'DA3232')
           ),
           'alignment' => array(
               'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
               'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
           )
       )
   );

   $phpColor = new PHPExcel_Style_Color();
   $phpColor->setRGB('FFFFFF');

   $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.'1')->getFont()->setColor($phpColor);

   $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(40);

   $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.'1')
   ->getAlignment()->setWrapText(true);

   $col = 0;
   foreach ($fields as $field)
   {

       $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucwords(str_replace('_', ' ', $field)));
       $col++;
   }

   $row = 2;
   foreach($result->result() as $data)
   {
       $col = 0;
       foreach ($fields as $field)
       {
           $this->excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
           $col++;
       }

       $row++;
   }

   //set border
   $styleArray = array(
         'borders' => array(
             'allborders' => array(
                 'style' => PHPExcel_Style_Border::BORDER_THIN
             )
         )
     );
   $this->excel->getActiveSheet()->getStyle('A1:'.$col_total.''.$row)->applyFromArray($styleArray);

   $this->excel->getActiveSheet()->setTitle(ucwords($subject));

   header('Content-Type: application/vnd.ms-excel');
   header('Content-Disposition: attachment;filename='.ucwords($subject).'-'.date('Y-m-d').'.xls');
   header('Cache-Control: max-age=0');
   header('Cache-Control: max-age=1');

   header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
   header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
   header ('Cache-Control: cache, must-revalidate');
   header ('Pragma: public');

   $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
   $objWriter->save('php://output');
}
//---


}

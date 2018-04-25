<?php

class Generate extends CI_Controller{

function __construct(){
parent::__construct();

}


public function index(){


  $temp_array_detail[] = array(

   "tahun" => $value['tahun'],
   "bulan" => $value['bulan'],
   "outstanding" => $outstanding,
   "angsuran_pokok" => $angsuran_pokok,
   "angsuran_bunga" => $angsuran_bunga,
   "angsuran_total" => $angsuran_total,
   "no_ktp_pemohon" =>$no_ktp_pemohon,
   "batch_id" =>$batch_id,



   );



print_r($temp_array_detail);

}


}

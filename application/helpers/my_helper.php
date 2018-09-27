<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('currency_format'))
{
    function currency_format($number)
    {
        return 'Rp. '.number_format($number,0,',','.');
    }
}


if ( ! function_exists('bunga'))
{
    function bunga()
    {
//        return 'Rp. '.number_format($number,0,',','.');
//return 'bunga/100';
$ci =& get_instance();
  $query = $ci->db->query("
select Bunga from Parameter where StartDate <= SYSDATE() AND EndDate >= SYSDATE()
");
$bunga = $query->row();

  return ($bunga->Bunga/100) ;

  }
}


if ( ! function_exists('helper_nama_bulan'))
{
    function helper_nama_bulan($no)
    {
//        return 'Rp. '.number_format($number,0,',','.');

$nama_bulan = array(

  '01'=>'Januari',
  '02'=>'Februari',
  '03'=>'Maret',
  '04'=>'April',
  '05'=>'Mei',
  '06'=>'Juni',
  '07'=>'Juli',
  '08'=>'Agustus',
  '09'=>'September',
  '10'=>'Oktober',
  '11'=>'November',
  '12'=>'Desember'

);

  return  $nama_bulan[$no];

  }
}





if ( ! function_exists('helper_IPMT'))
{
    function helper_IPMT(){
$ci =& get_instance();
// $query = $ci->db->query("Select IPMT(.05/12,1,2*12,235407.36,0,0) AS IPMT_result");
$query = $ci->db->query("Select IPMT(.05/12,1,2*12,235407.36,0,0) AS IPMT_result");
$res = $query->row();

  return ($res->IPMT_result) ;

  }
}




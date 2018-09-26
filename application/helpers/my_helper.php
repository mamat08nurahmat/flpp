<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


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




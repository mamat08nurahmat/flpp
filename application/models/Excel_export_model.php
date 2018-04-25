<?php
class Excel_export_model extends CI_Model
{
	function fetch_data_admin1()
	{
/*
		$this->db->order_by("kd_penjualan", "DESC");
		$query = $this->db->get("penjualan_header");
		
		return $query->result();
*/		
		
        return $this->db->query("
		
SELECT
a.kd_penjualan,
a.tanggal_penjualan,
b.nm_titik,
c.nama,	
c.induk as nama_agency,
(select sum(qty) as jum from penjualan_detail where kd_penjualan=a.kd_penjualan) as qty

FROM penjualan_header a
JOIN titik b ON a.kd_store = b.kd_titik
JOIN users c ON a.kd_user= c.kd_user

ORDER BY a.kd_penjualan DESC


                ")->result();
    }

	
//	function fetch_data_admin2($kd_user)
	function fetch_data_admin2()
	{
/*
		$this->db->order_by("kd_penjualan", "DESC");
		$query = $this->db->get("penjualan_header");
		
		return $query->result();
*/		
		
        return $this->db->query("
		
SELECT
a.kd_penjualan,
a.tanggal_penjualan,
b.nm_titik,
c.nama,	
(select sum(qty) as jum from penjualan_detail where kd_penjualan=a.kd_penjualan) as qty

FROM penjualan_header a
JOIN titik b ON a.kd_store = b.kd_titik
JOIN users c ON a.kd_user= c.kd_user


ORDER BY a.kd_penjualan DESC


                ")->result();
    }	
	
/*
SELECT 

a.kd_penjualan,
a.tanggal_penjualan,
d.nama,
c.nm_produk,
b.qty

FROM penjualan_header a

JOIN penjualan_detail b ON a.kd_penjualan = b.kd_penjualan
JOIN produk c ON b.kd_produk = c.kd_produk
JOIN users d ON a.kd_user = d.kd_user
	
*/	
//WHERE d.kd_user='$kd_user' AND a.tanggal_penjualan between '$tgl_awal' and '$tgl_akhir'
		
		
	
	
}

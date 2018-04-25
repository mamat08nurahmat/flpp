<?php
class Model_app extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertCSV($data)
            {
                $this->db->insert('upload_verivikasi', $data);
                return TRUE;
            }



	public function view_data(){
        $query=$this->db->query("SELECT im.*
                                 FROM upload_verivikasi im 
                                 ORDER BY im.NAMA_PEMOHON ASC");
        return $query->result_array();
    }

	
    public function getAllData($table)
    {
        return $this->db->get($table)->result();
    }
    public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }
    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }
    function deleteData($table,$data)
    {
        $this->db->delete($table,$data);
    }
    function insertData($table,$data)
    {
        $this->db->insert($table,$data);
    }
	
	
    public function getBatchID()
    {
        $q = $this->db->query("select MAX(RIGHT(batch_id,3)) as kd_max from upload_verivikasi");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else
        {
            $kd = "001";
        }
//        return "BATCH-".$kd;
        return $kd;
    }
	

    function login($kd_user, $password) {
        //create query to connect user login database
        $this->db->select('*');
        $this->db->from('users');
//        $this->db->where('email', $email);
        $this->db->where('kd_user', $kd_user);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        //get query and processing
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    }

	
	
	
}
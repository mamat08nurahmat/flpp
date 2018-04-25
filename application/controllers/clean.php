<?php
class Clean extends CI_Controller{
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
        $data=array(
            'title'=>'Clean',
//            'active_dashboard'=>'active',
//            'data_upload'=>$this->model_app->getAllData('upload_verivikasi'),
              'data_upload'=>$this->db->query("SELECT distinct batch_id FROM upload_verivikasi")->result(),
     //         'data_total'=>$this->db->query("SELECT distinct batch_id FROM total")->result(),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_clean');
        $this->load->view('element/v_footer');
    }

    function hapus_batch(){
		
 //       $id['batch_id'] = $this->uri->segment(3);
          $id['batch_id'] = $this->input->post('batch_id');
        $this->model_app->deleteData('upload_verivikasi',$id);
        $this->model_app->deleteData('total',$id);
		
//print_r("<script>alert('OK');
//</script>");		
	
        redirect("clean");
    }
	
	
}
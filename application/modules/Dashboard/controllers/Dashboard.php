<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index($type='',$team='',$data=array())
	{
		// echo json_encode($this->session->userdata());
		$this->load->view('v_dashboard',$data);
	}

	function detailPesan(){
		$id = $this->input->get('id');
		if($id){
			$results = $this->db->query("SELECT * FROM estimate WHERE id = '".$this->db->escape_str($id)."' ")->result();
			if(count($results)>0){
				$respon = array('status' => 'success', 'message' => strip_tags($results[0]->pesan), 'nama' => $results[0]->nama);
			}else{
				$respon = array('status' => 'failed', 'message' => 'Gagal');
			}
		}else{
			$respon = array('status' => 'failed', 'message' => 'Gagal');
		}
		echo json_encode($respon);
	}

	function logout(){
		// $this->session->sess_destroy();
        session_destroy();

        session_start();
        redirect('Login');
	}
}

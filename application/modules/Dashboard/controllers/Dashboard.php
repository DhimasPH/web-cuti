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

	function saveLeave(){
		$data = $this->input->post('data_leave');
		
		$datas = json_decode($data);

		if($data){
			$tmp = array();

			foreach($datas as $arg)
			{
				$tmp[$arg->requester_add][] = $arg;
			}

			$lastArr = array();

			foreach($tmp as $requester_add => $detail)
			{
				$lastArr[] = array(
					'requester_add' => $requester_add,
					'detail' => $detail
				);
			}

			for ($i=0; $i <count($lastArr) ; $i++) { 
				$details = $lastArr[$i]->detail;
				$dataParent = array(
					'username' => $datas[$i]->requester_add,
					'create_by' => $this->session->userdata('username'),
					'create_date' => date('Y-m-d')
				);
				
			}
		}else{
			$message = array('status'=> 'failed' , 'message' => 'Gagal menyimpan data');
			echo json_encode($message);
		}
	}

	function logout(){
		// $this->session->sess_destroy();
        session_destroy();

        session_start();
        redirect('Login');
	}
}

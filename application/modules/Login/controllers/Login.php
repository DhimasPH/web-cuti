<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

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

	public function index()
	{
		$this->load->view('v_login');
	}

	function check(){
		$param = $this->input->post(NULL,true);
		$message = array();
		if(isset($param)){
			$sql="SELECT a.* , b.name as priviledge_name FROM users a INNER JOIN tbl_priviledge b ON a.priviledge = b.id WHERE a.username = '".$this->db->escape_str($param['username'])."' ";
			$results = $this->db->query($sql)->result();
			if(count($results)>0){
				if($results[0]->password == sha1($param['password'])){
					$sesdata = array(
						'username' => $param['username'],
						'name' => $results[0]->name,
						'priviledge' => $results[0]->priviledge,
						'priviledge_name' => $results[0]->priviledge_name,
						'logged_in' => true,
						'date_log' => date('Y-m-d H:i:s')
					);
					$this->session->set_userdata($sesdata);
					redirect('Dashboard');
				}else{
					$message['alert'] = 'danger';
					$message['message'] = 'Password salah :( ';	
				}
			}else{
				$message['alert'] = 'danger';
				$message['message'] = 'Akun tidak ditemukan :( ';	
			}
			$message['username'] = $param['username'];
		}else{
			$message['alert'] = 'danger';
			$message['message'] = 'Error :( ';
		}
		$this->session->set_flashdata($message);
		
		redirect('Login');
	}

	function logout(){
		// $this->session->sess_destroy();
        session_destroy();

        session_start();
        redirect('Login');
	}
}

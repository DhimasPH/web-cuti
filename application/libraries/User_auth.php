<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_auth {

	function __construct()
	{
		$CI =& get_instance();
		$sess_username = $CI->session->userdata('username');
		$uri2 = explode('/',$CI->uri->uri_string(2));
		// echo $CI->uri->uri_string(2);DIE();
		if(!$sess_username){
			if($uri2[0]!='Login'){
				redirect('Login');		
			}
		}else{
			if($uri2[0]=='Login'){
				redirect('Dashboard');		
			}
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
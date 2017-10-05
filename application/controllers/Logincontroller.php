<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logincontroller extends CI_Controller {

	function __construct() {
		 parent::__construct();
		  $this->load->helper('url');
		  $this->load->library('session');
 }

	public function index()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');

			if($user_role==1){
				redirect('adminlogin/dashboard');
			}else if($user_role==2){
				echo "user organiser";
			}else if($user_role==3){
				print_r($datas);
				// echo $user_role;
			}else{
				$this->load->view('Login');
			}



	}

}

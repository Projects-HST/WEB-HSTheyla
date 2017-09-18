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
		$user_id=$this->session->userdata('id');
			if($user_id){
				redirect('adminlogin/dashboard');
			}else{
				$this->load->view('login');
			}


		
	}

}

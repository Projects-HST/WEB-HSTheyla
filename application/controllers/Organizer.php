<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organizer extends CI_Controller 
{
	function __construct() 
	   {
		  parent::__construct();
		 
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('organizermodel');
		  
		  
       }

//-------------------------City Add / Update---------------------------------

     public function index()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

		if($user_role==2)
		{
		  $this->load->view('organizer/dashboard');
	 	}else{
	 			redirect('/');
	 		 }
	 }

   
     public function createevents()
	 {
	 	$datas = $this->session->userdata();
	    $user_id = $this->session->userdata('id');
	    $user_role = $this->session->userdata('user_role');

		if($user_role==2)
		{
		  $this->load->view('organizer/create_events');
	 	}else{
	 			redirect('/');
	 		 }
	 }
	
     public function inserteevents()
	 {
	 	$datas = $this->session->userdata();
	    $user_id = $this->session->userdata('id');
	    $user_role = $this->session->userdata('user_role');
		
		if($user_role==2)
		{
			$category =$this->input->post("cboCategory");
			$datas = $this->organizermodel->create_events($category,$user_id,$user_role);
			//exit;
	 	} else {
		}
	 }
	 
	 public function updateevents()
	 {
	 	$datas = $this->session->userdata();
	    $user_id = $this->session->userdata('id');
	    $user_role = $this->session->userdata('user_role');

		if($user_role==2)
		{
		  $this->load->view('organizer/update_events');
	 	}else{
	 			redirect('/');
	 		 }
	 }


	 public function listevents()
	 {
	 	$datas = $this->session->userdata();
	    $user_id = $this->session->userdata('id');
	    $user_role = $this->session->userdata('user_role');

		if($user_role==2)
		{
		  $this->load->view('organizer/list_events');
	 	}else{
	 			redirect('/');
	 		 }
	 }

}
?>

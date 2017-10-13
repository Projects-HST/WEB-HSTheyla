<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Organizerbooking extends CI_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('organizerbookingmodel');
   }

//----------------------------------------------------------------------

   public function view_booking()
   {
   	$datas=$this->session->userdata();
	   $user_id=$this->session->userdata('id');
	   $user_role=$this->session->userdata('user_role');

	   //echo $user_id; echo $user_role; exit;
      $datas['view'] = $this->organizerbookingmodel->get_all_booking_details($user_id);
      //print_r($datas['view']);exit;
	   if($user_role==2)
		{
		  $this->load->view('organizer/header');
		  $this->load->view('organizer/booking/view_booking',$datas);
		  $this->load->view('organizer/footer');

	 	}else{
	 			redirect('/');
	 		 }
   }

     
	}
?>
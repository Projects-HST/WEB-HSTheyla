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
		$this->load->model('organizermodel');
   }	

//----------------------------------------------------------------------

   public function view_booking()
   {
   	$datas=$this->session->userdata();
	   $user_id=$this->session->userdata('id');
	   $user_role=$this->session->userdata('user_role');

	   //echo $user_id; echo $user_role; exit;
      $datas['view'] = $this->organizerbookingmodel->get_all_booking_details($user_id);
      //echo'<pre>';print_r($datas['view']);exit;
	   if($user_role==2)
		{
		  $this->load->view('organizer/header');
		  $this->load->view('organizer/booking/view_booking',$datas);
		  $this->load->view('organizer/footer');

	 	}else{
	 			redirect('/');
	 		 }
   }

   //-------------------------------Reviews--------------------------------

   public function reviews()
   {
   	$datas = $this->session->userdata();
	    $user_id = $this->session->userdata('id');
	    $user_role = $this->session->userdata('user_role');

		$datas['result'] = $this->organizermodel->list_events($user_id);
		
		if($user_role==2)
		{
		  $this->load->view('organizer/header');	
		  $this->load->view('organizer/reviews/view_events',$datas);
		  $this->load->view('organizer/footer');
		  
	 	}else{
	 			redirect('/');
	 	}
   }

   public function view_reviews($id)
   {
   	$datas=$this->session->userdata();
	   $user_id=$this->session->userdata('id');
	   $user_role=$this->session->userdata('user_role');

      $datas['views'] = $this->organizerbookingmodel->view_all_reviews($id);
      //echo'<pre>';print_r($datas['views']);exit();
		if($user_role==2)
		{
		  $this->load->view('organizer/header');	
		  $this->load->view('organizer/reviews/events_reviews',$datas);
		  $this->load->view('organizer/footer');
	 	}else{
	 			redirect('/');
	 		 }
   }

     //-------------------------------Followers--------------------------------

   public function view_followers()
   {
   	$datas = $this->session->userdata();
	   $user_id = $this->session->userdata('id');
	   $user_role = $this->session->userdata('user_role');

		$datas['fdetails'] = $this->organizerbookingmodel->view_followers_details($user_id);
		//echo '<pre>';print_r($datas['fdetails']);exit;
		
		if($user_role==2)
		{
		  $this->load->view('organizer/header');	
		  $this->load->view('organizer/followers/view_followers_details',$datas);
		  $this->load->view('organizer/footer');
		  
	 	}else{
	 			redirect('/');
	 	}
   }

     
	}
?>
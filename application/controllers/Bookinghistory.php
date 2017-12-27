<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookinghistory extends CI_Controller 
{

	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('bookinghistorymodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

    //-------------------------Booking History Add / Update---------------------------------
     
	public  function home()
	{
     
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['view'] = $this->bookinghistorymodel->view_booking_history_details();
        //echo'<pre>'; print_r($datas['view']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('booking_history/view_booking_history',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }

	}

	public function view_attendees($order_id)
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['view_attendees'] = $this->bookinghistorymodel->view_attendees_details($order_id);
        //echo'<pre>'; print_r($datas['view_attendees']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('booking_history/view_attendees_list',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }

	}

	public function process_details()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['view'] = $this->bookinghistorymodel->view_booking_process_details();
        //echo'<pre>'; print_r($datas['view']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('booking_history/view_process_history',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	}

	public function status_details()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['status'] = $this->bookinghistorymodel->view_booking_status_details();
       // echo'<pre>'; print_r($datas['status']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('booking_history/view_status_details',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	}
	
	public function view_payment_details($booking_id)
	{
	   // echo $booking_id; exit;
	    $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['all'] = $this->bookinghistorymodel->view_payment_alldetails($booking_id);
       //echo'<pre>'; print_r($datas['all']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('booking_history/view_all_details',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }  
	}

}
?>
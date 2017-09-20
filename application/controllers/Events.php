<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller 
{


	function __construct() 
	   {
		  parent::__construct();
		 // $this->load->model('eventsmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

//-------------------------City Add / Update---------------------------------

     public function home()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    //$datas['countyr_list'] = $this->citymodel->getall_country_list();
	    //$datas['result'] = $this->citymodel->getall_city_details();
        //print_r($datas['result']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('events/add_events');
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

   


}
?>

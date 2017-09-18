<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countrymasters extends CI_Controller 
{


	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('Countrymastersmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

    public function home()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $datas['result'] = $this->Countrymastersmodel->getall_details();
         //print_r($datas['result']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('country/add',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

    public function add_country()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	     $cname=$this->input->post("countryname");
	     $estatus=$this->input->post("eventsts");
	     //echo $cname; echo $estatus;  echo $user_role; exit;
	     $datas=$this->Countrymastersmodel->insert_country_details($cname,$estatus,$user_id,$user_role);
         $sta=$datas['status'];
	     //print_r($sta);exit;
	     if($sta=="success"){
	       $this->session->set_flashdata('msg','Added Successfully');
		   redirect('Countrymasters/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('Countrymasters/home');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Faild To Add');
		     redirect('Countrymasters/home');
	     }

    }



}
?>

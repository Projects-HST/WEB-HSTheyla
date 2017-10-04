<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guestuser extends CI_Controller 
{
	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('guestusermodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

//------------------------- Guest user View ---------------------------------

    public function home()
	{
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['list'] = $this->guestusermodel->getall_guestusers_list();
	    //$datas['users_role'] = $this->guestusermodelusersmodel->getall_users_role_list();
	    //echo'<pre>';print_r($datas['list'] );exit;

		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('guestusers/view',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	}

	 public function delete($users_id)
    {    //echo $users_id; exit;
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    
	    if($user_role==1)
		{
	     $datas= $this->guestusermodel->delete($users_id);
         $sta=$datas['status'];
		 if($sta=="success"){
		 $this->session->set_flashdata('msg','Deleted Successfully');
	     redirect('guestuser/home');
		 }else{
		     $this->session->set_flashdata('msg','Faild To Delete');
			 redirect('guestuser/home');
		     }
	 	}else{
	 			redirect('/');
	 		 }
    }

    public function view_all_details($users_id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    
	    if($user_role==1)
		{
	     $datas['details']= $this->guestusermodel->view_all_users_details($users_id);
	     //echo'<pre>';print_r($datas['details']);exit;
         $this->load->view('header');
		 $this->load->view('guestusers/view_details',$datas);
		 $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
    }

}?>

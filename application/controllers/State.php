<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends CI_Controller
{


	function __construct()
	   {
		  parent::__construct();
		  $this->load->model('statemodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

//-------------------------State Add / Update---------------------------------

     public function home()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $datas['countyr_list'] = $this->statemodel->getall_country_list();
	    $datas['result'] = $this->statemodel->getall_state_details();
        //print_r($datas['result']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('state/add',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

    public function add_state()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	     $countryid=$this->input->post("countryid");
	     $statename=$this->input->post("statename");
	     $eventsts=$this->input->post("eventsts");

	     $datas=$this->statemodel->insert_state_details($countryid,$statename,$eventsts,$user_id,$user_role);
         $sta=$datas['status'];
	     //print_r($sta);exit;
	     if($sta=="success"){
	       $this->session->set_flashdata('msg','State added successfully');
		   redirect('state/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','State already exists!');
		     redirect('state/home');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
		     redirect('state/home');
	     }

    }


    public function edit_state($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['countyr_list'] = $this->statemodel->getall_country_list();
	    $datas['edit']=$this->statemodel->eidt_state_details($id);
	    //echo'<pre>'; print_r($datas['edit']);exit;
        if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('state/edit',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }


    }

    public function update_state()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $countryid=$this->input->post("countryid");
        $statename=$this->input->post("statename");
        $stateid=$this->input->post("stateid");
	    $estatus=$this->input->post("eventsts");

	    $datas=$this->statemodel->update_state_details($countryid,$statename,$stateid,$estatus,$user_id,$user_role);
        $sta=$datas['status'];
	     //print_r($sta);exit;
	     if($sta=="success"){
	       $this->session->set_flashdata('msg','Changes made are saved');
		   redirect('state/home');
	     }else if($sta=="Already Exist"){
	     	 $this->session->set_flashdata('msg','State already exists');
		     redirect('state/home');
	     }else{
	     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
		     redirect('state/home');
	     }
    }






}
?>

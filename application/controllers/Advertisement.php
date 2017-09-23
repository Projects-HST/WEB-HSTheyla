<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement extends CI_Controller 
{


	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('advertisementmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

    //------------------------- Advertisement Add / Update---------------------------------
     
    public function home()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['all_plan'] = $this->advertisementmodel->view_advertisement_plan_details();
       
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('advertisement/add_plan',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
    }

    public function add_plans()
    {
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
         
        $planname=$this->input->post('planname');
        $planrate=$this->input->post('plan_rate');

        $datas = $this->advertisementmodel->add_advertisement_plan_details($user_id,$planname,$planrate);
        
        $sta=$datas['status'];
      
        if($sta=="success"){
	       $this->session->set_flashdata('msg','Added Successfully');
		   redirect('advertisement/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('advertisement/home');
	     }else{
	     	 $this->session->set_flashdata('msg','Faild To Add');
		     redirect('advertisement/home');
	     }

    }

    public function edit_plans($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['edit'] = $this->advertisementmodel->edit_advertisement_plan_details($id);
        if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('advertisement/edit_plan',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
    }

    public function update_plans()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
         
        $planid=$this->input->post('planid'); 
        $planname=$this->input->post('planname');
        $planrate=$this->input->post('plan_rate');

        $datas = $this->advertisementmodel->update_advertisement_plan_details($planid,$planname,$planrate,$user_id);
        
        $sta=$datas['status'];
      
        if($sta=="success"){
	       $this->session->set_flashdata('msg','Updated Successfully');
		   redirect('advertisement/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('advertisement/home');
	     }else{
	     	 $this->session->set_flashdata('msg','Faild To Update');
		     redirect('advertisement/home');
	     }
    }

    public function delete_plans($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas = $this->advertisementmodel->delete_advertisement_plan_details($id);
        
        $sta=$datas['status'];
      
        if($sta=="success"){
	       $this->session->set_flashdata('msg','Deleted Successfully');
		   redirect('advertisement/home');
	     }else{
	     	 $this->session->set_flashdata('msg','Faild To Delete');
		     redirect('advertisement/home');
	     }
    }

    public function view_adv_plan()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	   
	    $datas['result'] = $this->advertisementmodel->getall_events_details();

	    if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('advertisement/view_adv_list',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
    }

    public function  add_advertisement_details($id,$category_id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	   
	    $datas['result'] = $this->advertisementmodel->getall_adv_history_details();
	    $datas['plans'] = $this->advertisementmodel->getall_adv_plans();
	     $datas['event_id'] =$id;
	     $datas['category_id'] =$category_id;

	    if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('advertisement/adv_details',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }

    }

    public  function add_adv_history()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $event_id=$this->input->post('event_id');
	    $category_id=$this->input->post('category_id');
	    $start_date=$this->input->post('start_date');
	    $end_date=$this->input->post('end_date');
	    $start_time=$this->input->post('start_time');
	    $end_time=$this->input->post('end_time');
	    $adv_plan=$this->input->post('adv_plan');
	    $status=$this->input->post('status');

    }


}?>
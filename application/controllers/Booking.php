<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller 
{


	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('bookingmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

    //-------------------------Booking Add / Update---------------------------------
     
	public  function home($id)
	{
     
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['view_plan'] = $this->bookingmodel->view_plan_details($id);
        $datas['eventid']=$id;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('booking/add',$datas);
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
	    $seats=$this->input->post('seats');
	    $amount=$this->input->post('amount');
	    $eventid=$this->input->post('event_id');

	    $datas = $this->bookingmodel->add_events_details($eventid,$planname,$seats,$amount,$user_id);
        $sta=$datas['status'];
        //print_r($sta);exit;
        if($sta=="success"){
	       $this->session->set_flashdata('msg','Added Successfully');
		   redirect('booking/home/'.$eventid.'');
	     }else if($sta=="AE"){
	     	 $this->session->set_flashdata('msg','Already Exist');
		     redirect('booking/home/'.$eventid.'');
	     }else{
	     	 $this->session->set_flashdata('msg','Faild To Add');
		     redirect('booking/home/'.$eventid.'');
	     }
	}

	public function edit_plan($id)
	{    
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
        $datas['edit']=$this->bookingmodel->edit_events_plans($id);
        //print_r($datas['edit']);exit;
        if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('booking/edit',$datas);
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

	    $planname=$this->input->post('planname');
	    $seats=$this->input->post('seats');
	    $amount=$this->input->post('amount');
	    $eventid=$this->input->post('event_id');
	    $planid=$this->input->post('plan_id');

	    $datas = $this->bookingmodel->update_events_details($eventid,$planid,$planname,$seats,$amount,$user_id);
        $sta=$datas['status'];
        //print_r($sta);exit;
        if($sta=="success"){
	       $this->session->set_flashdata('msg','updated Successfully');
		   redirect('booking/home/'.$eventid.'');
	     }else{
	     	 $this->session->set_flashdata('msg','Faild To update');
		     redirect('booking/home/'.$eventid.'');
	     }
	}
    


}
?>
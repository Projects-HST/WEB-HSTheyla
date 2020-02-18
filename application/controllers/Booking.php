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
        $id=base64_decode($id);

        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['view_plan'] = $this->bookingmodel->view_plan_details($id);
        $datas['eventid']=$id;
		if($user_role == 1 || $user_role == 4)
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

	    $amount=$this->input->post('amount');
	    $eventid=$this->input->post('event_id');

	    $datas = $this->bookingmodel->add_events_details($eventid,$planname,$amount,$user_id);
	    $eventid=base64_encode($eventid);
        $sta=$datas['status'];
        //print_r($sta);exit;
        if($sta=="success"){
	       $this->session->set_flashdata('msg','Ticket plan created successfully');
		   redirect('booking/home/'.$eventid.'');
	     }else if($sta=="AE"){
	     	 $this->session->set_flashdata('msg','Ticket plan already exists!');
		     redirect('booking/home/'.$eventid.'');
	     }else{
	     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
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
        if($user_role == 1 || $user_role == 4)
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

	    $amount=$this->input->post('amount');
	    $eventid=$this->input->post('event_id');
	    $planid=$this->input->post('plan_id');

	    $datas = $this->bookingmodel->update_events_details($eventid,$planid,$planname,$amount,$user_id);
        $sta=$datas['status'];
        $eventid=base64_encode($eventid);
        //print_r($sta);exit;
        if($sta=="success"){
	       $this->session->set_flashdata('msg','Changes made are saved');
		   redirect('booking/home/'.$eventid.'');
	     }else{
	     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
		     redirect('booking/home/'.$eventid.'');
	     }
	}

	public function delete_plan($plaid,$eveid)
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        if($user_role == 1 || $user_role == 4){
	    $datas = $this->bookingmodel->delete_plan_details($plaid);
        $sta=$datas['status'];
        $eveid=base64_encode($eveid);
        //print_r($sta);exit;
        if($sta=="success"){
	       $this->session->set_flashdata('msg','Ticket plan deleted successfully');
		   redirect('booking/home/'.$eveid.'');
	     }else{
	     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
		     redirect('booking/home/'.$eveid.'');
	     }
	   }else{
           redirect('/');
		 }
	}

    //-------------------------show_time----------------------------------

    public function add_show_time($plaid,$eveid)
    {
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['plan_time'] = $this->bookingmodel->view_plan_time_details($plaid,$eveid);
        $datas['dates'] = $this->bookingmodel->view_events_dates($eveid);
        //$datas['seats'] = $this->bookingmodel->booking_seats_details($plaid,$eveid);
        $datas['planid']=$plaid;
        $datas['eventid']=$eveid;
        //echo '<pre>';print_r($datas['plan_time'] );exit;
		if($user_role == 1 || $user_role == 4)
		{
		  $this->load->view('header');
		  $this->load->view('booking/add_plan_time',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
    }

    public function add_show_times_details()
    {
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $plan_id=$this->input->post('plan_id');
	    $eventid=$this->input->post('event_id');
	    $showtime=$this->input->post('showtime');
	    $seats=$this->input->post('seats');

	    //$showdate=$this->input->post('showdate');
	    $sdate=$this->input->post('showdate');
		$dateTime = new DateTime($sdate);
		$show_date=date_format($dateTime,'Y-m-d');

	    $datas = $this->bookingmodel->add_shows_times_details($plan_id,$eventid,$showtime,$show_date,$seats,$user_id);
        $sta=$datas['status'];
        //print_r($sta);exit;
        if($sta=="success"){
	       $this->session->set_flashdata('msg','Show timing created successfully');
		   redirect('booking/add_show_time/'.$plan_id.'/'.$eventid.'');
	     }else if($sta=="AE"){
	     	 $this->session->set_flashdata('msg','Show timing already exists!');
		    redirect('booking/add_show_time/'.$plan_id.'/'.$eventid.'');
	     }else{
	     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
		    redirect('booking/add_show_time/'.$plan_id.'/'.$eventid.'');
	     }
    }

    public function edit_plan_time($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
        $datas['edit']=$this->bookingmodel->edit_plans_time($id);
        //echo '<pre>'; print_r($datas['edit']);exit;
        if($user_role == 1 || $user_role == 4)
		{
		  $this->load->view('header');
		  $this->load->view('booking/edit_plan_time',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }

    }

    public function update_show_times_details()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $time_id=$this->input->post('time_id');
	    $plan_id=$this->input->post('plan_id');
	    $eventid=$this->input->post('event_id');
	    $showtime=$this->input->post('showtime');
	    $seats=$this->input->post('seats');

	    $show_date=$this->input->post('showdate');
		//$dateTime = new DateTime($sdate);
		//$show_date=date_format($dateTime,'Y-m-d');

	    $datas = $this->bookingmodel->update_shows_times_details($time_id,$plan_id,$eventid,$show_date,$showtime,$seats,$user_id);
        $sta=$datas['status'];
        //print_r($sta);exit;
        if($sta=="success"){
	       $this->session->set_flashdata('msg','Changes made are saved');
		   redirect('booking/add_show_time/'.$plan_id.'/'.$eventid.'');
	     }else{
	     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
		    redirect('booking/add_show_time/'.$plan_id.'/'.$eventid.'');
	     }
    }


}
?>

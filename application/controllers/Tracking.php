<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tracking extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('trackingmodel');
        $this->load->helper('url');
        $this->load->library('session');
    }

 public function organiser_events($id)
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
    if($user_role==1){
      $data['org_tracks'] = $this->trackingmodel->get_all_organiser_event($id);
  		$this->load->view('header');
  		$this->load->view('tracking/get_all_organiser_event', $data);
  		$this->load->view('footer');
    }else{
      redirect('/');
    }

	}



  public function organiser_event_tracking(){
    $datas=$this->session->userdata();
    $user_id=$this->session->userdata('id');
    $user_role=$this->session->userdata('user_role');
    if($user_role==1){
      $data['org_event_tracks'] = $this->trackingmodel->get_count_organiser_event();
      $this->load->view('header');
      $this->load->view('tracking/organiser_event_tracking', $data);
      $this->load->view('footer');
    }else{
      redirect('/');
    }
  }



    public function admin_event_tracking(){
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('id');
      $user_role=$this->session->userdata('user_role');
      if($user_role==1){
        $data['org_event_tracks'] = $this->trackingmodel->admin_event_tracking();
        $this->load->view('header');
        $this->load->view('tracking/organiser_event_tracking', $data);
        $this->load->view('footer');
      }else{
        redirect('/');
      }
    }

    public function admin_track_date(){
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('id');
      $user_role=$this->session->userdata('user_role');
      if($user_role==1){
        $data['event_track'] = $this->trackingmodel->admin_track_by_date();
        $this->load->view('header');
        $this->load->view('tracking/track_by_date', $data);
        $this->load->view('footer');
      }else{
        redirect('/');
      }
    }


    public function organiser_track_date(){
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('id');
      $user_role=$this->session->userdata('user_role');
      if($user_role==1){
        $data['event_track'] = $this->trackingmodel->organiser_track_date();
        $this->load->view('header');
        $this->load->view('tracking/track_by_date', $data);
        $this->load->view('footer');
      }else{
        redirect('/');
      }
    }


    public function get_all_event_by_date_id($id,$date_id){
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('id');
      $user_role=$this->session->userdata('user_role');
      if($user_role==1){
        $data['org_tracks'] = $this->trackingmodel->get_all_event_by_date_id($id,$date_id);
    		$this->load->view('header');
    		$this->load->view('tracking/get_all_organiser_event', $data);
    		$this->load->view('footer');
      }else{
        redirect('/');
      }
    }

}

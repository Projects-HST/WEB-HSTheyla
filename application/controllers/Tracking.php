<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tracking extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('trackingmodel');
        $this->load->model('mailmodel');
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



    public function refund_request(){
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('id');
      $user_role=$this->session->userdata('user_role');
      if($user_role==1){
        $data['tracks'] = $this->trackingmodel->refund_request();
        $this->load->view('header');
        $this->load->view('tracking/get_all_refund_request', $data);
        $this->load->view('footer');
      }else{
        redirect('/');
      }
    }


    public function change_refund_status(){
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('id');
      $user_role=$this->session->userdata('user_role');
      if($user_role==1){
        $ref_id=$this->uri->segment(3);
        $data['refund_track'] = $this->trackingmodel->get_refund_request_id($ref_id);
        $this->load->view('header');
        $this->load->view('tracking/change_refund_status', $data);
        $this->load->view('footer');
      }else{
        redirect('/');
      }
    }


    public function update_refund_status(){
      $datas=$this->session->userdata();
      $user_id=$this->session->userdata('id');
      $user_role=$this->session->userdata('user_role');
      if($user_role==1){
        $refund_id=$this->input->post('refund_id');
        $req_status=$this->input->post('req_status');
        $notes=$req_status;
        $email=base64_decode($this->input->post('email_id'));
        $data=$this->mailmodel->send_mail($email,$notes);
        $data['refund_track'] = $this->trackingmodel->update_refund_status($refund_id,$req_status);
        }else{
        redirect('/');
      }
    }
}

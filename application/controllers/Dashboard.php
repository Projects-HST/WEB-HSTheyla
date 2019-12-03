<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('dashboardmodel');
        $this->load->model('loginmodel');
        $this->load->helper('url');
        $this->load->library('session');
    }

 public function index()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		$data['user_points'] = $this->leaderboardmodel->get_points($user_id);
		//$data['city_list'] = $this->eventlistmodel->getall_city_list();
		//$data['category_list'] = $this->eventlistmodel->getall_category_list();
		//$data['event_resu'] = $this->eventlistmodel->get_events();
		//$data['adv_event_result'] = $this->eventlistmodel->getadv_events();
		$this->load->view('front_header');
		$this->load->view('leaderboard', $data);
		$this->load->view('front_footer');
	}



  public function get_all_organiser_request(){
    $datas=$this->session->userdata();
    $user_id=$this->session->userdata('id');
    $user_role=$this->session->userdata('user_role');
    if($user_role==1 || $user_role==4){
      $data['get_all_request'] = $this->loginmodel->get_all_organiser_request();
	  //print_r ($data['get_all_request']);
      $this->load->view('header');
      $this->load->view('others/get_all_request', $data);
      $this->load->view('footer');
    }else{
      redirect('/');
    }
  }

  public function update_req_status($id){
    $datas=$this->session->userdata();
    $user_id=$this->session->userdata('id');
    $user_role=$this->session->userdata('user_role');
    if($user_role==1 || $user_role==4){
      $data['get_org_request'] = $this->loginmodel->get_organiser_request($id);
      $this->load->view('header');
      $this->load->view('others/update_req_status', $data);
      $this->load->view('footer');
    }else{
      redirect('/');
    }
  }

  public function change_req_status(){
    $datas=$this->session->userdata();
    $user_id=$this->session->userdata('id');
    $user_role=$this->session->userdata('user_role');
    if($user_role==1 || $user_role==4){
      $req_status=$this->input->post('req_status');
      $rq_id=$this->input->post('req_id');
      $org_id=$this->input->post('org_id');
      $data = $this->loginmodel->change_req_status($req_status,$rq_id,$org_id);
    }else{
      redirect('/');
    }
  }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboardmodel');
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
 
}


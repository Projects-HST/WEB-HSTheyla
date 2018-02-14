<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Eventslist extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('eventslistmodel');
        $this->load->helper('url');
        $this->load->library('session');
    }
	
 public function index()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		$data['country_list'] = $this->eventslistmodel->getall_country_list();
		$data['city_list'] = $this->eventslistmodel->getall_city_list(); 
		$data['category_list'] = $this->eventslistmodel->getall_category_list(); 
		$data['event_result'] = $this->eventslistmodel->getall_events();
		$this->load->view('front_header');
		$this->load->view('events', $data);
		$this->load->view('front_footer');
		//echo json_encode($data['result']);
	}
 
    public function get_city_name()
    {
        $country_id  = $this->input->post('country_id');
        $data['res'] = $this->eventslistmodel->getcityname($country_id);
        echo json_encode($data['res']);
    }
	
	public function get_search_events()
    {
      	$country_id  = $this->input->post('country_id');
		$city_id  = $this->input->post('city_id');
		$category_id  = $this->input->post('cat_id');
        $data['event_result'] = $this->eventslistmodel->getsearch_events($country_id,$city_id,$category_id);
        echo json_encode($data['event_result']);
    }
	
}


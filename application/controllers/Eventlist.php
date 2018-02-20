<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Eventlist extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('eventlistmodel');
        $this->load->helper('url');
        $this->load->library('session');
    }
	
 public function index()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		$data['country_list'] = $this->eventlistmodel->getall_country_list();
		$data['city_list'] = $this->eventlistmodel->getall_city_list(); 
		$data['category_list'] = $this->eventlistmodel->getall_category_list();
		$data['event_resu'] = $this->eventlistmodel->get_events();
		$data['adv_event_result'] = $this->eventlistmodel->getadv_events();
		$this->load->view('front_header');
		$this->load->view('events', $data);
		$this->load->view('front_footer');
		//echo json_encode($data['result']);
	}
 
     public function get_all_events()
    {
        $limit  = $this->input->post('limit');
		$offset  = $this->input->post('offset');
        $data['event_result'] = $this->eventlistmodel->getall_events($limit, $offset);
        echo json_encode($data['event_result']);
    }
 
    public function get_city_name()
    {
        $country_id  = $this->input->post('country_id');
        $data['res'] = $this->eventlistmodel->getcityname($country_id);
        echo json_encode($data['res']);
    }
	
	public function get_search_events()
    {
      	$country_id  = $this->input->post('country_id');
		$city_id  = $this->input->post('city_id');
		$category_id  = $this->input->post('cat_id');
        $data['event_result'] = $this->eventlistmodel->getsearch_events($country_id,$city_id,$category_id);
        echo json_encode($data['event_result']);
    }
	
	public function search_term_events()
    {
      	$srch_term  = $this->input->post('srch_term');
        $data['event_term_result'] = $this->eventlistmodel->getsearch_term_events($srch_term);
        echo json_encode($data['event_term_result']);
    }
	
	public function eventdetails($enc_event_id,$event_name)
    {
		$dec_event_id = base64_decode($enc_event_id);
		$event_id = ($dec_event_id/564738);
		$data['event_gallery'] = $this->eventlistmodel->getevent_gallery($event_id);
		$data['event_details'] = $this->eventlistmodel->getevent_details($event_id);
		$this->load->view('front_header');
		$this->load->view('eventdetails', $data);
		$this->load->view('front_footer');
        //echo json_encode($data['event_term_result']);
    }
	
	public function eventwishlist()
    {
      	$user_id  = $this->input->post('user_id');
		$event_id  = $this->input->post('event_id');
        $data['wishlist_result'] = $this->eventlistmodel->update_wishlist($user_id,$event_id);
        echo json_encode($data['wishlist_result']);
    }
	
	public function eventsharing()
    {
      	$user_id  = $this->input->post('user_id');
		$event_id  = $this->input->post('event_id');
		$type  = $this->input->post('type');
        $data['result'] = $this->eventlistmodel->update_sharing($user_id,$event_id,$type);
        echo json_encode($data['result']);
    }
}


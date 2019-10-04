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
        $this->load->helper('cookie');
    }

 public function index()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		//$data['country_list'] = $this->eventlistmodel->getall_country_list();
		$data['city_list'] = $this->eventlistmodel->getall_city_list();
		$data['category_list'] = $this->eventlistmodel->getall_category_list();
		$data['event_resu'] = $this->eventlistmodel->get_events();
		$data['banner_event_result'] = $this->eventlistmodel->getadv_events();
		//$data['country_values'] = get_cookie('country_values');
		$data['city_values'] = get_cookie('city_values');
		$data['search_values'] = get_cookie('search_values');
		//print_r($data);
		$this->load->view('front_header');
		$this->load->view('event_list', $data);
		$this->load->view('front_footer');
	}

     public function get_all_events()
    {
        $limit  = $this->input->post('limit');
		$offset  = $this->input->post('offset');
        $data['event_result'] = $this->eventlistmodel->getall_events($limit,$offset);
        echo json_encode($data['event_result']);
    }

	public function get_country_events()
    {
		$limit  = $this->input->post('limit');
		$offset  = $this->input->post('offset');
      	$country_id  = $this->input->post('country_id');
        $data['event_result'] = $this->eventlistmodel->get_country_events($country_id,$limit,$offset);
        echo json_encode($data['event_result']);
    }
	public function get_city_events()
    {
		$limit  = $this->input->post('limit');
		$offset  = $this->input->post('offset');
      	$country_id  = $this->input->post('country_id');
		$city_id  = $this->input->post('city_id');
        $category_id  = $this->input->post('cat_id');
		set_cookie('city_values',$city_id,'3600');
		delete_cookie("search_values");
        $data['event_result'] = $this->eventlistmodel->get_city_events($country_id,$city_id,$category_id,$limit,$offset);
        echo json_encode($data['event_result']);
    }

	public function get_category_events()
    {
		$limit  = $this->input->post('limit');
		$offset  = $this->input->post('offset');
      	$country_id  = $this->input->post('country_id');
		$city_id  = $this->input->post('city_id');
		$category_id  = $this->input->post('cat_id');
        $data['event_result'] = $this->eventlistmodel->getcategory_events($country_id,$city_id,$category_id,$limit,$offset);
        echo json_encode($data['event_result']);
    }

	public function get_type_events()
    {
		$limit  = $this->input->post('limit');
		$offset  = $this->input->post('offset');
      	$country_id  = $this->input->post('country_id');
		$city_id  = $this->input->post('city_id');
		$category_id  = $this->input->post('cat_id');
		$type_id = $this->input->post('type_id');
        $data['event_result'] = $this->eventlistmodel->gettype_events($country_id,$city_id,$category_id,$type_id,$limit,$offset);
        echo json_encode($data['event_result']);
    }

	public function search_term_events()
    {
    $srch_term  = $this->input->post('srch_term');
		set_cookie('search_values',$srch_term,'3600');
		delete_cookie("city_values");
    $data['event_result'] = $this->eventlistmodel->getsearch_term_events($srch_term);
    echo json_encode($data['event_result']);
    }

	public function get_city_name()
    {
        $country_id  = $this->input->post('country_id');
        $data['res'] = $this->eventlistmodel->getcityname($country_id);
        echo json_encode($data['res']);
    }

	public function eventdetails($enc_event_id,$event_name)
    {
  		$dec_event_id = base64_decode($enc_event_id);
  		$event_id = ($dec_event_id/564738);

    	$data['event_gallery'] = $this->eventlistmodel->getevent_gallery($event_id);
  		$data['event_details'] = $this->eventlistmodel->getevent_details($event_id);
		$data['event_reviews_users'] = $this->eventlistmodel->getevent_reviews_user($event_id);
  		$data['event_reviews'] = $this->eventlistmodel->getevent_reviews($event_id);
		$data['booking_dates'] = $this->eventlistmodel->booking_plandates($event_id);
		$data['booking_planamount'] = $this->eventlistmodel->booking_planamount($event_id);
    	$event_desc = $data['event_details'];

		foreach($event_desc as $row_des){
			$event_title=$row_des->event_name;
			$data['meta_title']= $event_title;
			$desc=$row_des->description;
			$event_country=$row_des->event_country;
			$event_city=$row_des->event_city;
			//set_cookie('country_values',$event_country,'3600');
			//set_cookie('city_values',$event_city,'3600');
			$data['meta_description']=$desc;
		}
		$this->load->view('front_header', $data);
		$this->load->view('eventdetails', $data);
		$this->load->view('front_footer');
    }

    public function category()
      {

        $cat_id=$this->uri->segment(3);
        $cat_name=$this->uri->segment(4);
        $datas=$this->session->userdata();
    		$user_id=$this->session->userdata('id');
    		$user_role=$this->session->userdata('user_role');
        $data['res_cat']=$this->eventlistmodel->category_details($cat_id);

        $data['cat_event']=$this->eventlistmodel->category_events($cat_id);
        // echo "<pre>";
        // print_r($data['cat_event']);
        // exit;
        $this->load->view('front_header',$data);
        $this->load->view('category_based_events',$data);
    	  $this->load->view('front_footer');
      }

      public function event_reviews()
        {

          $event_id=$this->uri->segment(3);
          $datas=$this->session->userdata();
      		$user_id=$this->session->userdata('id');
      		$user_role=$this->session->userdata('user_role');
          $data['res_event_review']=$this->eventlistmodel->get_all_reviews_for_event($event_id);
          $this->load->view('front_header',$data);
          $this->load->view('reviews_for_event',$data);
      	  $this->load->view('front_footer');
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

	public function booking($event_id)
    {
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$dec_event_id = base64_decode($event_id);
		$event_id = ($dec_event_id/564738);
		if ($user_id!=''){
			$data['event_gallery'] = $this->eventlistmodel->getevent_gallery($event_id);
			$data['event_details'] = $this->eventlistmodel->getevent_details($event_id);
			$data['booking_dates'] = $this->eventlistmodel->booking_plandates($event_id);
			$this->load->view('front_header');
			$this->load->view('booking_new', $data);
			$this->load->view('front_footer');
		} else {
			$event_session_id = array("session_event_id" => $event_id);
			$event_id_session = $this->session->set_userdata($event_session_id);
			redirect('/signin/');
		}
    }

	public function plantiming()
    {
		$event_id  = $this->input->post('event_id');
		$plan_date  = $this->input->post('plan_date');
		$data['plan_timings'] = $this->eventlistmodel->booking_plantimes($event_id,$plan_date);
        echo json_encode($data['plan_timings']);
    }

	public function plandetails()
    {
		$event_id  = $this->input->post('event_id');
		$plan_date  = $this->input->post('show_date');
		$plan_time  = $this->input->post('show_time');
        $data['plan_details'] = $this->eventlistmodel->booking_plans($event_id,$plan_date,$plan_time);
        echo json_encode($data['plan_details']);
    }

	public function seatdetails()
    {
		$event_id  = $this->input->post('event_id');
		$plan_date  = $this->input->post('show_date');
		$plan_time  = $this->input->post('show_time');
		$show_plan  = $this->input->post('show_plan');
        $data['plan_seats'] = $this->eventlistmodel->booking_seats($event_id,$plan_date,$plan_time,$show_plan);
        echo json_encode($data['plan_seats']);
    }





	public function event_booking()
    {
		$number = '1234567890';
		$randomNumber = '';
		for ($i = 0; $i < 7; $i++) {
			$randomNumber .= $number[rand(0, 7 - 1)];
		}
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		if($user_id!=''){
			$order_id = $randomNumber."-".$user_id;
			$event_id  = $this->input->post('event_id');
			$plan_id  = $this->input->post('plan_id');
			$plan_time_id  = $this->input->post('plantime_id');
			$number_of_seats  = $this->input->post('no_seats');
			$total_amount  = $this->input->post('total_amount');
			$booking_date = $this->input->post('booking_date');
			$datas['booking_process'] = $this->eventlistmodel->booking_process($order_id,$event_id,$plan_id,$plan_time_id,$user_id,$number_of_seats,$total_amount,$booking_date);

			$this->load->view('front_header');
			$this->load->view('booking_process_new', $datas);
			$this->load->view('front_footer');
		}else{
			redirect('signin');
		}
    }


	public function payment_gateway()
    {
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');

		if($user_id!=''){
			$order_id  = $this->input->post('order_id');
			$payment_type  = $this->input->post('payment_type');
			$data['booking_result'] = $this->eventlistmodel->payment_review($order_id);
			if ($payment_type =='paytm'){
			    $this->load->view('payment_paytm_gateway', $data);
			}
		}else{
			redirect('/signin/');
		}
    }


	public function addreview()
    {
		$event_id  = $this->input->post('event_id');
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$rating  = $this->input->post('rating');
		$message  = $this->input->post('message');
		$data['reviews'] = $this->eventlistmodel->add_review($event_id,$user_id,$rating,$message);
		echo "OK";
    }

	public function updatereview()
    {
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');

		$event_id  = $this->input->post('event_id');
		$review_id  = $this->input->post('review_id');
		$rating  = $this->input->post('rating');
		$message  = $this->input->post('message');

		$data['reviews'] = $this->eventlistmodel->update_review($event_id,$review_id,$user_id,$rating,$message);
		echo "OK";
    }

	public function clear_all()
    {
		delete_cookie("search_values");
		delete_cookie("city_values");

		echo "Success";
    }

    public function webflow()
    {
      $this->load->view('front_header');
      $this->load->view('webflow');
      $this->load->view('front_footer');
    }



	public function appflow()
    {
      $this->load->view('front_header');
      $this->load->view('appflow');
      $this->load->view('front_footer');
    }

    /*  public function get_ip_country()
    {
		$ip=$_SERVER['REMOTE_ADDR'];
		$access_key = 'ed4a0ff6cd906632c411e531777136e5';
		// Initialize CURL:
		$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Store the data:
		$json = curl_exec($ch);
		curl_close($ch);
		// Decode JSON response:
		$api_result = json_decode($json, true);
		$country=$api_result['country_name'];
		$data['res']=$this->eventlistmodel->get_ip_country($country);
		echo $data['res'];
    } */
}

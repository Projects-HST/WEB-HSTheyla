<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organizer extends CI_Controller 
{
	function __construct() 
	   {
		  parent::__construct();
		 
		  $this->load->helper('url');
		  $this->load->library('session');
		  $this->load->model('organizermodel');
       }
	   
//----------------------------------------------------------

     public function index()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

		if($user_role==2)
		{
		  $this->load->view('organizer/dashboard');
	 	}else{
	 			redirect('/');
	 		 }
	 }

//----------------------------------------------------------

    function get_times( $default = '10:00', $interval = '+15 minutes' ) 
	{
		$output = '';
		$current = strtotime( '00:00:00' );
		$end = strtotime( '23:59:00' );
		while( $current <= $end ) {
			$time = date( 'H:i:s', $current );
			$sel = ( $time == $default ) ? ' selected' : '';
			$output .= "<option value=\"{$time}\">" . date( 'h.i A', $current ) .'</option>';
			$current = strtotime( $interval, $current );
		}
		return $output;
    }
	

//----------------------------------------------------------
	 
    public function get_city_name()
     {
	   	 $country_id = $this->input->post('country_id');
		 $data['res']= $this->organizermodel->get_city($country_id);
		 echo json_encode( $data['res']);
     }
//----------------------------------------------------------
   
     public function createevents()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $datas['country_list'] = $this->organizermodel->get_country();
	    $datas['category_list'] = $this->organizermodel->get_category();

		if($user_role==2)
		{
		  $this->load->view('organizer/header');	
		  $this->load->view('organizer/events/create_events',$datas);
		  $this->load->view('organizer/footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

//----------------------------------------------------------

     public function inserteevents()
	 {
	 	$datas = $this->session->userdata();
	    $user_id = $this->session->userdata('id');
	    $user_role = $this->session->userdata('user_role');
		
	    $event_name = $this->db->escape_str($this->input->post('event_name'));
        $category = $this->input->post('category');
        $country = $this->input->post('country');
        $city = $this->input->post('city');
        $venue = $this->input->post('venue');
        $address = $this->db->escape_str($this->input->post('address'));
        $description = $this->db->escape_str($this->input->post('description'));
        $eventcost = $this->input->post('eventcost');
        $sdate = $this->input->post('start_date');
		$dateTime = new DateTime($sdate);
		$start_date = date_format($dateTime,'Y-m-d');
        $edate = $this->input->post('end_date');
        $dateTime = new DateTime($edate);
		$end_date = date_format($dateTime,'Y-m-d');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');
        $txtLatitude = $this->input->post('txtLatitude');
        $txtLongitude = $this->input->post('txtLongitude');
        $pcontact_cell = $this->input->post('pcontact_cell');
        $scontact_cell = $this->input->post('scontact_cell');
        $contact_person = $this->input->post('contact_person');
        $email = $this->input->post('email');
        
     //       $event_pic = $_FILES['eventbanner']['name']; 
  //       $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
  //       $file_name      = time() . rand(1, 5) . rand(6, 10);
  //       $event_banner   = $file_name. '.' .$temp;
		// //$event_banner = trim($event_pic);
		// $uploaddir = 'assets/events/banners/';
		// $profilepic = $uploaddir.$event_banner;
		// move_uploaded_file($_FILES['eventbanner']['tmp_name'],$profilepic);


		$event_pic      = $_FILES['eventbanner']['name'];
        $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
        $file_name      = time() . rand(1, 5) . rand(6, 10);
        $event_banner   = $file_name. '.' .$temp;
        $uploaddir      = 'assets/events/banner/';
        $profilepic     = $uploaddir . $event_banner;
        move_uploaded_file($_FILES['eventbanner']['tmp_name'], $profilepic);

        $eadv_status = $this->input->post('eadv_status');
		//$booking_sts = $this->input->post('booking_sts');
		$hotspot_sts = $this->input->post('hotspot_sts');
        $colour_scheme = $this->input->post('colour_scheme');
		//$event_status = $this->input->post('event_status');

        $datas = $this->organizermodel->create_events($event_name,$category,$country,$city,$venue,$address,$description,$eventcost,$start_date,$end_date,$start_time,$end_time,$txtLatitude,$txtLongitude,$pcontact_cell,$scontact_cell,$contact_person,$email,$event_banner,$colour_scheme,$eadv_status,$hotspot_sts,$user_id,$user_role);
        
		$sta = $datas['status'];


	    if($sta=="success"){
			$this->session->set_flashdata('msg','Added Successfully');
			redirect('/organizer/viewevents');
	     }else if($sta=="Already Exist"){
			$this->session->set_flashdata('msg','Already Exist');
			redirect('/organizer/events/viewevents');
	     }
	     else{
			$this->session->set_flashdata('msg','Faild To Add');
			redirect('/organizer/events/viewevents');
	     }
	 }

//----------------------------------------------------------
	 
	 public function viewevents()
	 {
	 	$datas = $this->session->userdata();
	    $user_id = $this->session->userdata('id');
	    $user_role = $this->session->userdata('user_role');

		$datas['result'] = $this->organizermodel->list_events($user_id);

		//echo'<pre>'; print_r($datas['result']);exit;
		if($user_role==2)
		{
		  $this->load->view('organizer/header');	
		  $this->load->view('organizer/events/view_events',$datas);
		  $this->load->view('organizer/footer');
		  
	 	}else{
	 			redirect('/');
	 	}
	 }
//----------------------------------------------------------
	 
	 public function updateevents($id)
	 {
		$id = base64_decode($id);
	 	$datas = $this->session->userdata();
	    $user_id = $this->session->userdata('id');
	    $user_role = $this->session->userdata('user_role');
		
		$datas['country_list'] = $this->organizermodel->get_country();
	    $datas['category_list'] = $this->organizermodel->get_category();
	    $datas['city_list'] = $this->organizermodel->get_city_list();
	    $datas['edit'] = $this->organizermodel->events_details($id);

		if($user_role==2)
		{
		  $this->load->view('organizer/header');
		  $this->load->view('organizer/events/update_events',$datas);
		  $this->load->view('organizer/footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

//----------------------------------------------------------

     public function updateeventsdetails()
     {
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $event_name=$this->db->escape_str($this->input->post('event_name'));
        $category=$this->input->post('category');
        $country=$this->input->post('country');

        $city=$this->input->post('city');
        $oldcityid=$this->input->post('oldcityid');

        $venue=$this->input->post('venue');
        $address=$this->db->escape_str($this->input->post('address'));
        $description=$this->db->escape_str($this->input->post('description'));
        $eventcost=$this->input->post('eventcost');

        $sdate=$this->input->post('start_date');
		$dateTime = new DateTime($sdate);
		$start_date=date_format($dateTime,'Y-m-d');

        $edate=$this->input->post('end_date');
        $dateTime = new DateTime($edate);
		$end_date=date_format($dateTime,'Y-m-d');


        $start_time=$this->input->post('start_time');
        $end_time=$this->input->post('end_time');

        //echo $start_time; echo'<br>'; echo $end_time; exit;

        $txtLatitude=$this->input->post('txtLatitude');
        $txtLongitude=$this->input->post('txtLongitude');
        $pcontact_cell=$this->input->post('pcontact_cell');
        $scontact_cell=$this->input->post('scontact_cell');
        $contact_person=$this->input->post('contact_person');
        $email=$this->input->post('email');
        
        $currentcpic=$this->input->post('currentcpic');
        $eventid=$this->input->post('eventid');

  //       $event_pic = $_FILES['eventbanner']['name']; 
  //       $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
  //       $file_name      = time() . rand(1, 5) . rand(6, 10);
  //       $event_banner   = $file_name. '.' .$temp;
		// $uploaddir='assets/events/banner/';
		// $profilepic=$uploaddir.$event_banner;
		// move_uploaded_file($_FILES['eventbanner']['tmp_name'],$profilepic);

		$event_pic      = $_FILES['eventbanner']['name'];
	
        $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
        $file_name      = time() . rand(1, 5) . rand(6, 10);
        $event_banner   = $file_name. '.' .$temp;
        $uploaddir      = 'assets/events/banner/';
        $profilepic     = $uploaddir . $event_banner;
        move_uploaded_file($_FILES['eventbanner']['tmp_name'], $profilepic);

        $eadv_status=$this->input->post('eadv_status');
		$booking_sts=$this->input->post('booking_sts');
		$hotspot_sts=$this->input->post('hotspot_sts');
		
        $colour_scheme=$this->input->post('colour_scheme');
		$event_status=$this->input->post('event_status');
		
        //echo $currentcpic; echo $event_banner;
          
         if(empty($event_pic)){
            $event_banner=$currentcpic;
         }else{
         	$event_banner=$event_banner;
         }

         if(empty($city)){
           $city=$oldcityid;
         }else{
         	$city=$city;
         }
          //echo'<br>'; echo $event_banner; exit;
        $datas=$this->organizermodel->update_events_details($eventid,$event_name,$category,$country,$city,$venue,$address,$description,$eventcost,$start_date,$end_date,$start_time,$end_time,$txtLatitude,$txtLongitude,$pcontact_cell,$scontact_cell,$contact_person,$email,$event_banner,$colour_scheme,$event_status,$eadv_status,$booking_sts,$hotspot_sts,$user_id,$user_role);
        $sta=$datas['status'];
	   // print_r($sta);exit;
	    if($sta=="success"){
	       $this->session->set_flashdata('msg','Update Successfully');
		   redirect('organizer/viewevents');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('organizer/viewevents');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Faild To Update');
		     redirect('organizer/viewevents');
	     }
     }
}


?>

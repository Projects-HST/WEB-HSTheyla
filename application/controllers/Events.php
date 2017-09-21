<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller 
{


	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('eventsmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

//-------------------------Events Add / Update---------------------------------
     
	 
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


     public function home()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $datas['country_list'] = $this->eventsmodel->getall_country_list();
	    $datas['category_list'] = $this->eventsmodel->getall_category_list();
	  
       // echo '<pre>'; print_r($datas['country_list']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('events/add_events',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

	 public function add_events()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');


	    $event_name=$this->db->escape_str($this->input->post('event_name'));
        $category=$this->input->post('category');
        $country=$this->input->post('country');
        $city=$this->input->post('city');
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
        
         //echo $city; exit;
        $event_pic=$_FILES['eventbanner']['name']; 
		$event_banner=trim($event_pic);
		$uploaddir='assets/events/banner/';
		$profilepic=$uploaddir.$event_banner;
		move_uploaded_file($_FILES['eventbanner']['tmp_name'],$profilepic);

        $eadv_status=$this->input->post('eadv_status');
		$booking_sts=$this->input->post('booking_sts');
		$hotspot_sts=$this->input->post('hotspot_sts');
		
        $colour_scheme=$this->input->post('colour_scheme');
		$event_status=$this->input->post('event_status');


        $datas=$this->eventsmodel->insert_events_details($event_name,$category,$country,$city,$venue,$address,$description,$eventcost,$start_date,$end_date,$start_time,$end_time,$txtLatitude,$txtLongitude,$pcontact_cell,$scontact_cell,$contact_person,$email,$event_banner,$colour_scheme,$event_status,$eadv_status,$booking_sts,$hotspot_sts,$user_id,$user_role);
        $sta=$datas['status'];
	   // print_r($sta);exit;
	    if($sta=="success"){
	       $this->session->set_flashdata('msg','Added Successfully');
		   redirect('events/view_events');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('events/view_events');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Faild To Add');
		     redirect('events/view_events');
	     }

	 }

   
    public function get_city_name()
     {
	   	 $country_id = $this->input->post('country_id');
		 //echo $classid;exit;
		 $data['res']=$this->eventsmodel->getcityname($country_id);
		 echo json_encode( $data['res']);
     }


     public function view_events()
     {

     	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	   
	    $datas['result'] = $this->eventsmodel->getall_events_details();
        //echo '<pre>'; print_r($datas['result']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('events/view_events',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }

     }

     public function edit_events($id)
     {
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    
	    $datas['country_list'] = $this->eventsmodel->getall_country_list();
	    $datas['category_list'] = $this->eventsmodel->getall_category_list();
	    $datas['city_list'] = $this->eventsmodel->getall_city_list();
	    $datas['edit'] = $this->eventsmodel->edit_events_details($id);
         //echo '<pre>'; print_r($datas['edit']); exit;
        if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('events/edit_events',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
     }


     public function update_events()
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

        $event_pic=$_FILES['eventbanner']['name']; 
		$event_banner=trim($event_pic);
		$uploaddir='assets/events/banner/';
		$profilepic=$uploaddir.$event_banner;
		move_uploaded_file($_FILES['eventbanner']['tmp_name'],$profilepic);

        $eadv_status=$this->input->post('eadv_status');
		$booking_sts=$this->input->post('booking_sts');
		$hotspot_sts=$this->input->post('hotspot_sts');
		
        $colour_scheme=$this->input->post('colour_scheme');
		$event_status=$this->input->post('event_status');
          
         if(empty($event_banner)){
            $event_banner=$currentcpic;
         }else{
         	$event_banner=$event_banner;
         }

         if(empty($city)){
           $city=$oldcityid;
         }else{
         	$city=$city;
         }

        $datas=$this->eventsmodel->update_events_details($eventid,$event_name,$category,$country,$city,$venue,$address,$description,$eventcost,$start_date,$end_date,$start_time,$end_time,$txtLatitude,$txtLongitude,$pcontact_cell,$scontact_cell,$contact_person,$email,$event_banner,$colour_scheme,$event_status,$eadv_status,$booking_sts,$hotspot_sts,$user_id,$user_role);
        $sta=$datas['status'];
	   // print_r($sta);exit;
	    if($sta=="success"){
	       $this->session->set_flashdata('msg','Update Successfully');
		   redirect('events/view_events');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('events/view_events');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Faild To Update');
		     redirect('events/view_events');
	     }


     }

}
?>

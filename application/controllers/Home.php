<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('loginmodel');
	//	$this->load->model('facebook');
		$this->load->model('eventlistmodel');
		$this->load->model('organizermodel');
		$this->load->model('organizerbookingmodel');
		$this->load->helper('url');
		$this->load->library('session');

	}

	public function index()
	{

		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		if($user_role==1){
			redirect('adminlogin/dashboard');
		}else if($user_role==2){
			$this->load->view('index', $datas);
		}else if($user_role==3){
				$this->load->view('index', $datas);
		}else{
			$this->load->view('index', $datas);
		}

	}

	public function signin()
	{

		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		if($user_role==1){
			redirect('adminlogin/dashboard');
		}else if($user_role==2){
			redirect('leaderboard');
		}else if($user_role==3){
			redirect('leaderboard');
		}else{
			$this->load->view('front_header');
			$this->load->view('signin', $datas);
			$this->load->view('front_footer');
		}



	}
	public function signup()
	{

		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		if($user_role==1){
			redirect('adminlogin/dashboard');
		}else if($user_role==2){
			redirect('leaderboard');
		}else if($user_role==3){
			redirect('leaderboard');
		}else{
			$this->load->view('front_header');
			$this->load->view('signup', $datas);
			$this->load->view('front_footer');
		}


	}
	public function events()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		$this->load->view('front_header');
		$this->load->view('events', $datas);
		$this->load->view('front_footer');
	}

	public function eventdetails()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');

		if($user_role==3 || $user_role==2){
			$this->load->view('front_header');
			$this->load->view('eventdetails', $datas);
			$this->load->view('front_footer');
		}else{
			redirect('/');
		}
	}

	 function eventdetails_new($enc_event_id,$event_name)
    {
		$dec_event_id = base64_decode($enc_event_id);
		$event_id = ($dec_event_id/564738);
		$data['event_gallery'] = $this->eventlistmodel->getevent_gallery($event_id);
		$data['event_details'] = $this->eventlistmodel->getevent_details($event_id);
		$data['event_reviews'] = $this->eventlistmodel->getevent_reviews($event_id);
		$this->load->view('front_header');
		$this->load->view('eventdetails_new', $data);
		$this->load->view('front_footer');
    }


	public function booking()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		if($user_role==3 || $user_role==2){
			$this->load->view('front_header');
			$this->load->view('booking', $datas);
			$this->load->view('front_footer');
		}else{
			redirect('/');
		}

	}
// 	public function leaderboard()
// 	{
//
// 		$datas=$this->session->userdata();
// 		$user_id=$this->session->userdata('id');
// 		$user_role=$this->session->userdata('user_role');
// 		if($user_role==3 || $user_role==2){
// 		$datas['user_points'] = $this->loginmodel->get_points($user_id);
// 		$this->load->view('front_header');
// 		$this->load->view('leaderboard', $datas);
// 		$this->load->view('front_footer');
// 	}else{
// 		redirect('/');
// 	}
// }


	public function attendees()
	{

		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		if($user_role==3 || $user_role==2){
		//$datas['user_points'] = $this->loginmodel->get_points($user_id);
		$this->load->view('front_header');
		$this->load->view('attendees');
		$this->load->view('front_footer');
	}else{
		redirect('/');
	}


	}



    public function insertevents()
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

		$event_pic      = $_FILES['eventbanner']['name'];
        $temp = pathinfo($event_pic, PATHINFO_EXTENSION);
        $file_name      = time() . rand(1, 5) . rand(6, 10);
        $event_banner   = $file_name. '.' .$temp;
        $uploaddir      = 'assets/events/banner/';
        $profilepic     = $uploaddir . $event_banner;
        move_uploaded_file($_FILES['eventbanner']['tmp_name'], $profilepic);

        $eadv_status = $this->input->post('eadv_status');
		$hotspot_sts = $this->input->post('hotspot_sts');
        $colour_scheme = $this->input->post('colour_scheme');

        $datas = $this->organizermodel->create_events($event_name,$category,$country,$city,$venue,$address,$description,$eventcost,$start_date,$end_date,$start_time,$end_time,$txtLatitude,$txtLongitude,$pcontact_cell,$scontact_cell,$contact_person,$email,$event_banner,$colour_scheme,$eadv_status,$hotspot_sts,$user_id,$user_role);

		$sta = $datas['status'];
		redirect('/viewevents');
	 }






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
        $txtLatitude=$this->input->post('txtLatitude');
        $txtLongitude=$this->input->post('txtLongitude');
        $pcontact_cell=$this->input->post('pcontact_cell');
        $scontact_cell=$this->input->post('scontact_cell');
        $contact_person=$this->input->post('contact_person');
        $email=$this->input->post('email');
        $currentcpic=$this->input->post('currentcpic');
        $eventid=$this->input->post('eventid');
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

        $datas=$this->organizermodel->update_events_details($eventid,$event_name,$category,$country,$city,$venue,$address,$description,$eventcost,$start_date,$end_date,$start_time,$end_time,$txtLatitude,$txtLongitude,$pcontact_cell,$scontact_cell,$contact_person,$email,$event_banner,$colour_scheme,$event_status,$eadv_status,$booking_sts,$hotspot_sts,$user_id,$user_role);
      	$sta=$datas['status'];
		   	redirect('/viewevents');
     }

     //-------------------------------Followers--------------------------------




	public function removewishlist($wishlist_id)
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		$datas['wishlist_remove'] = $this->loginmodel->remove_wishlist($wishlist_id);
		$datas['wishlist_details'] = $this->loginmodel->get_wishlist($user_id);
		if($user_role==3 || $user_role==2){
			$this->load->view('dash_header');
			$this->load->view('wishlist', $datas);
			$this->load->view('dash_footer');
		}else{
			redirect('/');
		}
	}

	public function eventattendees($order_id)
	 {
		$sorder_id = base64_decode($order_id);
	 	$datas = $this->session->userdata();
	    $user_id = $this->session->userdata('id');
	    $user_role = $this->session->userdata('user_role');
    	$datas['seats'] = $this->loginmodel->event_attendees($sorder_id);
		  $this->load->view('front_header');
		  $this->load->view('event_attendees',$datas);
		  $this->load->view('front_footer');
		 }



	 public function insertattendees()
     {
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

 		$order_id=$this->input->post('order_id');
		$count=$this->input->post('count');
		for ($i=1; $i<=$count; $i++)
		{
			$name=$this->input->post('name'.$i);
			$email=$this->input->post('email'.$i);
			$phone=$this->input->post('phone'.$i);
			$datas=$this->loginmodel->insert_attendees($order_id,$name,$email,$phone);
		}
		 	redirect('/home/paymentsuccess');
     }

	public function paymentsuccess()
	 {
		  $this->load->view('front_header');
		  $this->load->view('payment_success');
		  $this->load->view('front_footer');
	}

	public function paymenterror()
	 {
		  $this->load->view('front_header');
		  $this->load->view('payment_error');
		  $this->load->view('front_footer');
	}


	public function home()
	{
		$this->load->library('facebook');
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
	 	$user_role=$this->session->userdata('user_role');
		$data['country_list'] = $this->eventlistmodel->getall_country_list();
		$data['city_list'] = $this->eventlistmodel->getall_city_list();
		$data['category_list'] = $this->eventlistmodel->getall_category_list();
		$data['event_resu'] = $this->eventlistmodel->get_events();
		$data['adv_event_result'] = $this->eventlistmodel->getadv_events();
		$data['popular_events'] = $this->eventlistmodel->popular_events();
			if($user_role==1){
				redirect('adminlogin/dashboard');
			}else if($user_role==2){
				redirect('home/index');
			}else if($user_role==3){
				redirect('home/index');
			}else{
				redirect('home/index');
			}

	}


	public function gmaillogin(){
		$this->load->library('googleplus');
		$CLIENT_ID = '41690620391-rjhrim1r62fltr51nllsole87fi0geae.apps.googleusercontent.com';
		$CLIENT_SECRET = 'Ogmgt5HC2m8ZeRlQd2NRYIO4';
		$APPLICATION_NAME = "Heyla";
		$client = new Google_Client();
		$client->setApplicationName($APPLICATION_NAME);
		$client->setClientId($CLIENT_ID);
		$client->setClientSecret($CLIENT_SECRET);
		$client->setAccessType("offline");
		$client->setRedirectUri(''.base_url().'google_login');
		$client->setScopes('email');
		$objOAuthService = new Google_Service_Plus($client);
		$client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
		if(isset($_REQUEST['logout'])){
		session_unset();
		}
		if(isset($_GET['code'])){
		$client->authenticate($_GET['code']);
		$_SESSION['access_token']=$client->getAccessToken();
		}

		if(isset($_SESSION['access_token'])&&($_SESSION['access_token'])){
		$client->setAccessToken($_SESSION['access_token']);
		$oauth = new Google_Service_Oauth2($client);
		$user = $oauth->userinfo->get();
		$email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
		$firstname = $user['givenName'];
		$lastname = $user['familyName'];
		$datas['result'] = $this->loginmodel->getuserinfogoogle($email,$firstname,$lastname);
		  $user_role=$datas['result']['user_role'];

		 $status=$datas['result']['status'];
		 if($status=='Y'){
			 if($user_role==3){
					 redirect('leaderboard');
			 }else if($user_role==2){
			     redirect('leaderboard');
				//$this->load->view('profile', $datas);
			 }else{
				 redirect('/');
			 }
		 }else{
			 echo "Account Deactive";

		 }

		}
		else{
		$authUrl=$client->createAuthUrl();
			redirect($authUrl);
		}

	}

	public function facebook_login()
		{

				$firstname=$this->input->post('fbname');
			 	$email=$this->input->post('fbemail');


				$datas['result'] = $this->loginmodel->getuserfb($firstname,$email);

						$user_role=$datas['result']['user_role'];
						$status=$datas['result']['status'];


						if($status=='Y'){
							if($user_role==3){
							echo "success";
							}else if($user_role==2){
									echo "success";
							}else{
								redirect('/');
							}
						}else{
						redirect('deactive');

						}

			// $datas=$this->session->userdata();
			// $this->load->library('facebook');
			// $data['user'] = array();
			//
			// // Check if user is logged in
			// if ($this->facebook->is_authenticated())
			// {
			// 	// User logged in, get user details
			// 	$user = $this->facebook->request('get', '/me?fields=id,name,email');
			//
			//
			// 	if (!isset($user['error']))
			// 	{
			// 		$data['user'] = $user;
			// 		$firstname= $data['user']['name'];
			// 		$email=$data['user']['email'];
			//
			// 		$datas['result'] = $this->loginmodel->getuserfb($firstname,$email);
			//
			// 		$user_role=$datas['result']['user_role'];
			// 		$status=$datas['result']['status'];
			//
			//
			// 		if($status=='Y'){
			// 			if($user_role==3){
			// 				redirect('leaderboard');
			// 			}else if($user_role==2){
			// 				redirect('leaderboard');
			// 			}else{
			// 				redirect('/');
			// 			}
			// 		}else{
			// 		redirect('deactive');
			//
			// 		}
			// 	}else{
			// 		redirect('/');
			// 	}
			//
			// }else{
			// 	//echo "out";exit;
			//  redirect($this->facebook->login_url());
			// }

		}

		public function logout()
		{

			$datas=$this->session->userdata();
			$this->session->unset_userdata($datas);
			$this->session->sess_destroy();
			redirect('/');
		}



		public function mobilenumberchange(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['res']=$this->loginmodel->getuserinfo($user_id);
			if($user_role==3){
				$this->load->view('front_header');
				$this->load->view('mobilenumber', $datas);
				$this->load->view('front_footer');
			}else if($user_role==2){
				$this->load->view('front_header');
				$this->load->view('mobilenumber', $datas);
				$this->load->view('front_footer');
			}else{
				redirect('/');
			}
		}

		public function mobile(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['res']=$this->loginmodel->getuserinfo($user_id);
			if($user_role==3){
				$this->load->view('front_header');
				$this->load->view('add_mobile_number', $datas);
				$this->load->view('front_footer');
			}else if($user_role==2){
				$this->load->view('front_header');
				$this->load->view('add_mobile_number', $datas);
				$this->load->view('front_footer');
			}else{
				redirect('/');
			}
		}

		public function changeemail(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['res']=$this->loginmodel->getuserinfo($user_id);
			if($user_role==3){
				$this->load->view('front_header');
				$this->load->view('changeemail', $datas);
				$this->load->view('front_footer');

			}else if($user_role==2){
				$this->load->view('front_header');
				$this->load->view('changeemail', $datas);
				$this->load->view('front_footer');
			}else{
				redirect('/');
			}

		}






		public function organiser(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			 $user_role=$this->session->userdata('user_role');
			$datas['res']=$this->loginmodel->getuserinfo($user_id);

			if($user_id){
				if($user_role==2){
						$this->load->view('leaderboard', $datas);
				}else{
					redirect('/');
				}
			}
		}


		public function verify(){
			$this->load->view('front_header');
			$this->load->view('verify');
			$this->load->view('front_footer');

		}
		public function privacy(){

			$this->load->view('front_header');
			$this->load->view('privacy');
			$this->load->view('front_footer');
		}
		public function review(){

			$this->load->view('front_header');
			$this->load->view('review');
			$this->load->view('front_footer');
		}
		public function payment(){
			$this->load->view('front_header');
			$this->load->view('payment');
			$this->load->view('front_footer');
		}
		public function terms(){

			$this->load->view('front_header');
			$this->load->view('terms');
			$this->load->view('front_footer');
		}

		public function resetpassword(){
			$this->load->view('front_header');
			$this->load->view('resetpassword');
			$this->load->view('front_footer');

		}

		public function verified(){
			$this->load->view('front_header');
			$this->load->view('email_verification');
			$this->load->view('front_footer');

		}


		public function reset_password(){
			$email=$this->input->post('email');
			$data=$this->loginmodel->reset_password($email);
		}
		public function mail(){
			$name=$this->db->escape_str($this->input->post('name'));
			$email=$this->db->escape_str($this->input->post('email'));
			$subject=$this->db->escape_str($this->input->post('subject'));
			$msg=$this->db->escape_str($this->input->post('message'));
			$data=$this->loginmodel->mail_contact_form($name,$email,$subject,$msg);
		}
		public function become_organiser(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			 if($user_id){
				 $name=$this->db->escape_str($this->input->post('name'));
				 $email=$this->db->escape_str($this->input->post('email'));
				 $message=$this->db->escape_str($this->input->post('message'));
				 if(empty($name)){

				 }else{
					 $data=$this->loginmodel->save_request_orgainser($name,$email,$message,$user_id);
					 $to="hello@heylaapp.com";
					 $subject="Organiser Enquiry form";
					 $htmlContent = '
						<html>
						<head>
						<title>Become Organiser Form</title>
							 </head>
							 <body>
								 <div class="mail-content">
									 <p>Name - '.$name.'</p>
									 <p>Email or Phone - '.$email.'</p>
									 <p>Message - '.$message.'</p>

								 </div>
							 </body>
						</html>';
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// Additional headers
				$headers .= 'From: heylapp<info@heylapp.com>' . "\r\n";
				$sent= mail($to,$subject,$htmlContent,$headers);
				 }
			 }else{

			 }



		}

		public function emailverfiy(){
  	  $email = $this->uri->segment(3);
			$data['res']=$this->loginmodel->email_verify($email);
			if($data['res']['msg']=='verify'){
					$this->load->view('email_verification',$data);
				}else{
				$this->load->view('email_verification',$data);
			}

		}

		public function reset(){
			  $email_token = $this->uri->segment(3);
				$datas['res']=$email_token;
				$this->load->view('front_header');
			  $this->load->view('reset',$datas);
				$this->load->view('front_footer');

		}

		public function update_password(){
			$email_token=$this->input->post('email_token');
			$new_password=$this->input->post('new_password');
			$retype_password=$this->input->post('retype_password');
			$data=$this->loginmodel->update_password($email_token,$new_password,$retype_password);
		}

		public function checkemail(){
			$email=$this->input->post('email');
			$data=$this->loginmodel->check_email($email);

		}
		public function checkmobile(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$mobile=$this->input->post('mobile');
			$data=$this->loginmodel->check_mobile_number($mobile,$user_id);

		}

		public function check_username(){
			$user_name=$this->input->post('user_name');
			$user_id=$this->uri->segment(3);
			$data=$this->loginmodel->check_username($user_name,$user_id);

		}
		public function check_mobile(){
			$mobile_no=$this->input->post('mobile_no');
			$user_id=$this->uri->segment(3);
			$data=$this->loginmodel->check_mobile($mobile_no,$user_id);

		}



		public function existemail(){
			$email=$this->input->post('email');
			$data=$this->loginmodel->exist_email($email);

		}
		public function existmobile(){
			$mobile=$this->input->post('mobile');
			$data=$this->loginmodel->exist_mobile($mobile);

		}
		public function existusername(){
			$username=$this->input->post('name');
			$data=$this->loginmodel->exist_username($username);

		}
		public function checkotp(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$mobileotp=$this->input->post('mobileotp');
			$data=$this->loginmodel->check_otp($mobileotp,$user_id);
		}
		public function save_mobile_number(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
				$mobile=$this->input->post('mobile');
				$data=$this->loginmodel->save_mobile_number($mobile,$user_id);
		}

		public function save_email_id(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
				$email=$this->input->post('email');
				$data=$this->loginmodel->save_email_id($email,$user_id);
		}

		public function change_pic(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			 $user_role=$this->session->userdata('user_role');
			$profilepic = $_FILES['profilepic']['name'];
			$temp = pathinfo($profilepic, PATHINFO_EXTENSION);
			$userFileName = round(microtime(true)) . '.' . $temp;
			$uploaddir = 'assets/users/profile/';
			$profilepic = $uploaddir.$userFileName;
			move_uploaded_file($_FILES['profilepic']['tmp_name'], $profilepic);

			$data['res']=$this->loginmodel->changeprofileimage($user_id,$userFileName);
		}

		public function create_profile(){
			$name=$this->input->post('name');
			$mobile=$this->input->post('mobile');
			$email=$this->input->post('email');
			$password=$this->input->post('new_password');
			$datas['res']=$this->loginmodel->create_profile($name,$mobile,$email,$password);

		}


		public function save_profile(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			 $user_role=$this->session->userdata('user_role');
			if($user_id){
				$first_name=$this->input->post('first_name');
				$user_name=$this->input->post('user_name');
				$address=$this->input->post('address');
				$gender=$this->input->post('gender');
				$newsletter_status=$this->input->post('newsletter_status');
				$occupation=$this->input->post('occupation');
				$datas['res']=$this->loginmodel->save_profile_info($first_name,$user_name,$address,$gender,$newsletter_status,$occupation,$user_id);
			}else{
				redirect('/');
			}
		}

		public function sendOTP(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$mobile=$this->input->post('mobile');
			if($user_role=='3'){
				$datas['res']=$this->loginmodel->sendOTPmobilechange($mobile,$user_id);
			}
		}


		public function profile_update()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			if($user_role==3 || $user_role==2){
				$datas['res']=$this->loginmodel->getuserinfo($user_id);
				$this->load->view('dash_header');
				$this->load->view('profile_update', $datas);
				$this->load->view('dash_footer');
			}else{
				redirect('/');
			}

		}

		public function leaderboard(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			if($user_role==3 || $user_role==2){
			$datas['user_points'] = $this->loginmodel->get_points($user_id);
			$this->load->view('dash_header');
			$this->load->view('leaderboard',$datas);
			$this->load->view('dash_footer');
			}else{
				redirect('/');
			}
		}

		public function change_profile_picture(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['res']=$this->loginmodel->getuserinfo($user_id);
			if($user_role==3 || $user_role==2){
				$this->load->view('dash_header');
				$this->load->view('profile_picture', $datas);
				$this->load->view('dash_footer');
			}else{
				redirect('/');
			}

		}


		public function wishlist()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['wishlist_details'] = $this->loginmodel->get_wishlist($user_id);
			if($user_role==3 || $user_role==2){
			$this->load->view('dash_header');
			$this->load->view('wishlist', $datas);
			$this->load->view('dash_footer');
			}else{
				redirect('/');
			}
		}
		public function createevent(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			if($user_role==2){
				$datas['res']=$this->loginmodel->getuserinfo($user_id);
				$datas['country_list'] = $this->organizermodel->get_country();
				$datas['category_list'] = $this->organizermodel->get_category();
				$this->load->view('dash_header');
				$this->load->view('create_event', $datas);
				$this->load->view('dash_footer');
			}else{
					redirect('/');
				 }

		}




		public function viewevents()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');

			$datas['res']=$this->loginmodel->getuserinfo($user_id);
			$datas['result'] = $this->organizermodel->list_events($user_id);
			$this->load->view('dash_header');
			$this->load->view('view_event', $datas);
			$this->load->view('dash_footer');
		}




		public function updateevents($id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			if($user_role==2){
			$id = base64_decode($id);
			$datas['country_list'] = $this->organizermodel->get_country();
			$datas['category_list'] = $this->organizermodel->get_category();
			$datas['city_list'] = $this->organizermodel->get_city_list();
			$datas['edit'] = $this->organizermodel->events_details($id);

			$this->load->view('dash_header');
			$this->load->view('update_event', $datas);
			$this->load->view('dash_footer');
			}else{
					redirect('/');
				 }

		}



		public function bookedevents()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['res']=$this->loginmodel->getuserinfo($user_id);
			$datas['view'] = $this->organizerbookingmodel->get_all_booking_details($user_id);
				if($user_role==3 || $user_role==2){
			$this->load->view('dash_header');
			$this->load->view('booked_events', $datas);
			$this->load->view('dash_footer');
		}else{
			redirect('/');
		}
	}



		public function reviewevents()
		{
			 $datas = $this->session->userdata();
			 $user_id = $this->session->userdata('id');
			 $user_role = $this->session->userdata('user_role');
			 $datas['result'] = $this->organizermodel->list_events($user_id);
				if($user_role==2)
				 {
					 $this->load->view('dash_header');
					 $this->load->view('review_events',$datas);
					 $this->load->view('dash_footer');
					}else{
						 redirect('/');
					}
		}





		public function viewreviews($id)
		{
		 $datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['views'] = $this->organizerbookingmodel->view_all_reviews($id);
			 if($user_role==2)
			 {
				 $this->load->view('dash_header');
				 $this->load->view('view_reviews',$datas);
				 $this->load->view('dash_footer');
			 }else{
					 redirect('/');
					}
		}




		public function booking_history()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['booking_details'] = $this->loginmodel->get_booking($user_id);
			if($user_role==3 || $user_role==2){
			$this->load->view('dash_header');
			$this->load->view('booking_history', $datas);
			$this->load->view('dash_footer');
			}else{
				redirect('/');
			}
		}





		public function user_booking_history($order_id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['booking_details'] = $this->loginmodel->get_booking_history($order_id);
			$datas['event_attendees'] = $this->loginmodel->disp_event_attendees($order_id);
			if($user_role==3 || $user_role==2){
				$this->load->view('dash_header');
				$this->load->view('booking_history_details', $datas);
				$this->load->view('dash_footer');
			}else{
				redirect('/');
			}
		}



		public function booking_events(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			// $datas['booking_details'] = $this->loginmodel->get_booking_history($order_id);
			// $datas['event_attendees'] = $this->loginmodel->disp_event_attendees($order_id);
			if($user_role==3 || $user_role==2){
				$this->load->view('front_header');
				$this->load->view('booking_events_new', $datas);
				$this->load->view('front_footer');
			}else{
				redirect('/');
			}
		}
		public function event_list(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$data['country_list'] = $this->eventlistmodel->getall_country_list();
			$data['city_list'] = $this->eventlistmodel->getall_city_list();
			$data['category_list'] = $this->eventlistmodel->getall_category_list();
			$data['event_resu'] = $this->eventlistmodel->get_events();
			$data['adv_event_result'] = $this->eventlistmodel->getadv_events();
				$this->load->view('front_header');
				$this->load->view('event_list_new', $data);
				$this->load->view('front_footer');

		}

		public function event_booking_page(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			// $datas['booking_details'] = $this->loginmodel->get_booking_history($order_id);
			// $datas['event_attendees'] = $this->loginmodel->disp_event_attendees($order_id);
			if($user_role==3 || $user_role==2){
				$this->load->view('front_header');
				$this->load->view('event_booking_page', $datas);
				$this->load->view('front_footer');
			}else{
				redirect('/');
			}
		}



}

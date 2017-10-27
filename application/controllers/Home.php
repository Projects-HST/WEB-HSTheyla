<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('loginmodel');
		$this->load->helper('url');
		$this->load->library('session');

	}

	public function index()
	{
		$this->load->library('facebook');
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
			if($user_role==1){
				redirect('adminlogin/dashboard');
			}else if($user_role==2){
		            redirect('dashboard');
			}else if($user_role==3){
                redirect('profile');
				//$this->load->view('index');
			}else{
			     //redirect('/');
				$this->load->view('index');
			}



	}


	public function gmaillogin(){
		$this->load->library('googleplus');
		$CLIENT_ID = '56118066242-ndqa7sis300o0ce5otglegn629ktmjj5.apps.googleusercontent.com';
		$CLIENT_SECRET = 'QBjwPGP5PE6tzJt3bDekC4a1';
		$APPLICATION_NAME = "Heyla";
		$client = new Google_Client();
		$client->setApplicationName($APPLICATION_NAME);
		$client->setClientId($CLIENT_ID);
		$client->setClientSecret($CLIENT_SECRET);
		$client->setAccessType("offline");
		$client->setRedirectUri('http://heylaapp.com/heyla/google_login');
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
					 redirect('profile');
			 }else if($user_role==2){
			     redirect('dashboard');
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
			$datas=$this->session->userdata();
			$this->load->library('facebook');
			$data['user'] = array();

			// Check if user is logged in
			if ($this->facebook->is_authenticated())
			{
				// User logged in, get user details
				$user = $this->facebook->request('get', '/me?fields=id,name,email');

				if (!isset($user['error']))
				{
					$data['user'] = $user;
					$firstname= $data['user']['name'];
					$email=$data['user']['email'];

					$datas['result'] = $this->loginmodel->getuserfb($firstname,$email);
					 $user_role=$datas['result']['user_role'];
					$status=$datas['result']['status'];
					if($status=='Y'){
						if($user_role==3){
							redirect('profile');
						}else if($user_role==2){
							redirect('dashboard');
						}else{
							redirect('/');
						}
					}else{
					redirect('deactive');

					}
				}else{
					redirect('/');
				}

			}else{

				redirect($this->facebook->login_url());
				//$this->load->view('web', $data);
			}

		}

		public function logout()
		{

			$datas=$this->session->userdata();
			$this->session->unset_userdata($datas);
			$this->session->sess_destroy();
			redirect('/');
		}

		public function profile(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');

			$datas['res']=$this->loginmodel->getuserinfo($user_id);

			if($user_id){
				if($user_role==3){
					$this->load->view('profile', $datas);
				}else{
					redirect('/');
				}
			}
		}

		public function mobilenumberchange(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['res']=$this->loginmodel->getuserinfo($user_id);
			if($user_role==3){

				$this->load->view('mobilenumber', $datas);
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
						$this->load->view('organizer/dashboard', $datas);
				}else{
					redirect('/');
				}
			}
		}


		public function verify(){
			$this->load->view('verify');
		}
		public function resetpassword(){
			$this->load->view('resetpassword');
		}
		public function deactive(){
			$this->load->view('deactive');
		}
		public function verified(){
			$this->load->view('email_verification');
		}

		public function reset_password(){
			$email=$this->input->post('email');
			$data=$this->loginmodel->reset_password($email);
		}

		public function emailverfiy(){
  	 $email = $this->uri->segment(3);
  	 $has = $this->uri->segment(4);
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
			  $this->load->view('reset',$datas);

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
			$mobile=$this->input->post('mobile');
			$data=$this->loginmodel->check_mobile($mobile);

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
			if($user_role=='3'){
				$mobile=$this->input->post('mobile');
				$data=$this->loginmodel->save_mobile_number($mobile,$user_id);
			}else{
				redirect('/');
			}
		}

		public function change_pic(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			 $user_role=$this->session->userdata('user_role');
			$profilepic = $_FILES['profilepic']['name'];
			$userFileName =time().$profilepic;
			$uploaddir = 'assets/images/profile/';
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
				$name=$this->input->post('name');
				$email=$this->input->post('email');
				$address=$this->input->post('address');
				$datas['res']=$this->loginmodel->save_profile_info($user_id,$name,$email,$address);
			}else{
				redirect('/');
			}
		}

		public function sendOTP(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			if($user_role=='3'){
				$datas['res']=$this->loginmodel->sendOTPmobilechange($user_id);
			}
		}


}

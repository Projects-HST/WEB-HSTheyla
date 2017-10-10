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
			$this->load->view('profile');
			}else if($user_role==3){

				$this->load->view('index');
			}else{
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
		$client->setRedirectUri('http://localhost/heyla/profile');
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
				$this->load->view('organiser', $datas);
			 }else if($user_role==2){
				$this->load->view('profile', $datas);
			 }else{
				 redirect('/');
			 }
		 }else{
			 echo "Account Deactive";

		 }

		}
		else{
		$authUrl=$client->createAuthUrl();
		echo '<a href="'.$authUrl.'">login to google</a>';
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
							redirect('home');
						}else{
							redirect('/');
						}
					}else{
						echo "Account Deactive";

					}
				}else{
					echo "login here";
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
				if($user_role==2){
					$this->load->view('organiser', $datas);
				}else if($user_role==3){
					$this->load->view('profile', $datas);
				}else{
					redirect('/');
				}
			}
		}

		public function organiser(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			 $user_role=$this->session->userdata('user_role');
			$datas['res']=$this->loginmodel->getuserinfo($user_id);
			if($user_id){
				if($user_role==2){
						$this->load->view('organiser', $datas);
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

		public function reset_password(){
			$email=$this->input->post('email');
			$data=$this->loginmodel->reset_password($email);
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
				$mobile=$this->input->post('mobile');
				$email=$this->input->post('email');
				$address=$this->input->post('address');
				$datas['res']=$this->loginmodel->save_profile_info($user_id,$name,$mobile,$email,$address);
			}else{

			}
		}


}

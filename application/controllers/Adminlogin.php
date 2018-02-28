<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

function __construct()
{
	parent::__construct();
	$this->load->model('loginmodel');
	$this->load->helper('url');
	$this->load->library('session');

}

public function home()
{
	$username=$this->input->post('username');
	$password=md5($this->input->post('pwd'));


	$result = $this->loginmodel->login($username,$password);

	 $msg=$result['msg'];
	if($result['status']=='Deactive')
	{
		$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
		$this->session->set_flashdata('msg', 'Account Deactivated');
		redirect('signin');
	}

	if($result['status']=='notRegistered')
	{
		$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
		$this->session->set_flashdata('msg', 'Invalid Login');
		redirect('signin');
	}
	if($result['status']=='emailverfiy')
	{
		$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
		$this->session->set_flashdata('msg', 'You have to Verify your Email to login');
		redirect('signin');
	}

	$user_type=$this->session->userdata('user_role');
	$user_type1=$result['user_role'];

		if($result['status']=='Y')
		{
			switch($user_type1)
			{
				case '1':
				     $user_name=$result['user_name'];$msg=$result['msg'];$mobile_no=$result['mobile_no'];$email_id=$result['email_id'];$status=$result['status'];$id=$result['id'];$user_role=$result['user_role'];

					$datas= array("user_name"=>$user_name, "msg"=>$msg,"mobile_no"=>$mobile_no,"email_id"=>$email_id,"status"=>$status,"id"=>$id,"user_role"=>$user_role,);
					//$this->session->userdata($user_name);
					$session_data=$this->session->set_userdata($datas);

             $datas['users'] = $this->loginmodel->get_tlt_no_user();
						 $datas['events'] = $this->loginmodel->get_tlt_no_events();
						 $datas['org_events'] = $this->loginmodel->get_tlt_no_orgevents();
						 $datas['booking'] = $this->loginmodel->get_tlt_no_booking();
						 $datas['reviews'] = $this->loginmodel->get_tlt_no_reviews();

					$this->load->view('header',$datas);
					$this->load->view('home',$datas);
					$this->load->view('footer');
				break;
				case '2':
				     $user_name=$result['user_name'];$msg=$result['msg'];$mobile_no=$result['mobile_no'];$email_id=$result['email_id'];$status=$result['status'];$id=$result['id'];$user_role=$result['user_role'];

					$datas= array("user_name"=>$user_name, "msg"=>$msg,"mobile_no"=>$mobile_no,"email_id"=>$email_id,"status"=>$status,"id"=>$id,"user_role"=>$user_role,);
					//$this->session->userdata($user_name);
					$session_data=$this->session->set_userdata($datas);


					redirect('leaderboard');

				break;
				case '3':
				     $user_name=$result['user_name'];$msg=$result['msg'];$mobile_no=$result['mobile_no'];$email_id=$result['email_id'];$status=$result['status'];$id=$result['id'];$user_role=$result['user_role'];

					$datas= array("user_name"=>$user_name, "msg"=>$msg,"mobile_no"=>$mobile_no,"email_id"=>$email_id,"status"=>$status,"id"=>$id,"user_role"=>$user_role,);
					//$this->session->userdata($user_name);
					$session_data=$this->session->set_userdata($datas);


					redirect('leaderboard');

				break;
				case '4':
				  $user_name=$result['user_name'];$msg=$result['msg'];$mobile_no=$result['mobile_no'];$email_id=$result['email_id'];$status=$result['status'];$id=$result['id'];$user_role=$result['user_role'];

					$datas= array("user_name"=>$user_name, "msg"=>$msg,"mobile_no"=>$mobile_no,"email_id"=>$email_id,"status"=>$status,"id"=>$id,"user_role"=>$user_role,);
					//$this->session->userdata($user_name);
					$session_data=$this->session->set_userdata($datas);

						 $datas['users'] = $this->loginmodel->get_tlt_no_user();
						 $datas['events'] = $this->loginmodel->get_tlt_no_events();
						 $datas['org_events'] = $this->loginmodel->get_tlt_no_orgevents();
						 $datas['booking'] = $this->loginmodel->get_tlt_no_booking();
						 $datas['reviews'] = $this->loginmodel->get_tlt_no_reviews();

					$this->load->view('header',$datas);
					$this->load->view('home',$datas);
					$this->load->view('footer');
				break;
			}
		}
	elseif($msg=="Password Wrong"){
		$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
		$this->session->set_flashdata('msg', 'Password Wrong');
		redirect('signin');
	}	elseif($msg=="emailverfiy"){
			$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
			$this->session->set_flashdata('msg', 'You have to Verify your Email to login');
			redirect('signin');
		}
	else{
		$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
		$this->session->set_flashdata('msg', 'Email invalid');
		redirect('signin');
	}
}


public function logout()
{
	$datas=$this->session->userdata();
	$this->session->unset_userdata($datas);
	$this->session->sess_destroy();
	redirect('/');
}


public function dashboard()
{
	 $datas=$this->session->userdata();
	 $user_id=$this->session->userdata('id');
	 $user_role=$this->session->userdata('user_role');
	 $datas['result'] = $this->loginmodel->getuser($user_id);

	 $datas['users'] = $this->loginmodel->get_tlt_no_user();
	 $datas['events'] = $this->loginmodel->get_tlt_no_events();
	 $datas['org_events'] = $this->loginmodel->get_tlt_no_orgevents();
	 $datas['booking'] = $this->loginmodel->get_tlt_no_booking();
	  $datas['reviews'] = $this->loginmodel->get_tlt_no_reviews();
        //print_r( $datas['users']);exit;
	 if($user_role == 1 || $user_role == 4){
		$this->load->view('header',$datas);
		$this->load->view('home',$datas);
		$this->load->view('footer');
	}else{
			 redirect('/');
		}
}



	public function glogin()
	{
			$this->load->library('googleplus');
			$CLIENT_ID = '56118066242-ndqa7sis300o0ce5otglegn629ktmjj5.apps.googleusercontent.com';
			$CLIENT_SECRET = 'QBjwPGP5PE6tzJt3bDekC4a1';
			$APPLICATION_NAME = "Heyla";
			$client = new Google_Client();
			$client->setApplicationName($APPLICATION_NAME);
			$client->setClientId($CLIENT_ID);
			$client->setClientSecret($CLIENT_SECRET);
			$client->setAccessType("offline");
			$client->setRedirectUri('http://localhost/heyla/adminlogin/glogin/');
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
				 }else{
					 redirect('/');
				 }
			 }else{

				  redirect('deactive');
			 }

			}
			else{
			$authUrl=$client->createAuthUrl();
			echo '<a href="'.$authUrl.'">login to google</a>';
			}

	}




			// public function web_login()
			// 	{
			// 		$datas=$this->session->userdata();
			// 		$this->load->library('facebook');
			// 		$data['user'] = array();
			//
			// 		// Check if user is logged in
			// 		if ($this->facebook->is_authenticated())
			// 		{
			// 			// User logged in, get user details
			// 			$user = $this->facebook->request('get', '/me?fields=id,name,email');
			//
			// 			if (!isset($user['error']))
			// 			{
			// 				$data['user'] = $user;
			// 				$firstname= $data['user']['name'];
			// 				$email=$data['user']['email'];
			//
			// 				$datas['result'] = $this->loginmodel->getuserfb($firstname,$email);
			// 				$role=$datas['result']['user_role'];
			// 				$status=$datas['result']['status'];
			// 				if($status=='Y'){
			// 					if($role==3){
			// 						 redirect('adminlogin/ghome');
			// 					}else if($role==2){
			// 						redirect('adminlogin/ghome');
			// 					}else{
			// 						redirect('/');
			// 					}
			// 				}else{
			// 					echo "Account Deactive";
			//
			// 				}
			// 			}else{
			// 				echo "login here";
			// 			}
			//
			// 		}else{
			// 			$this->load->view('web', $data);
			// 		}

				// }








}

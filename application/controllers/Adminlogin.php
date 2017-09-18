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
	  //echo $username; echo $password; exit;
	  $result = $this->loginmodel->login($username,$password);
	  $msg=$result['msg'];

      //echo $msg1=$result['status'];
     // print_r($result); exit;
      
      if($result['status']=='Deactive')
       {
		 $datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
		 $this->session->set_flashdata('msg', 'Account Deactivated');
		 redirect('/');
	   }

	   if($result['status']=='notRegistered')
	    {
			$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
			$this->session->set_flashdata('msg', 'Invalid Login');
			redirect('/');
		}


		$user_type=$this->session->userdata('user_role');
		$user_type1=$result['user_role'];
					if($result['status']=='Y'){
						switch($user_type1){
							case '1':
								$user_name=$result['user_name'];$msg=$result['msg'];$mobile_no=$result['mobile_no'];$email_id=$result['email_id'];$status=$result['status'];$id=$result['id'];$user_role=$result['user_role'];$login_mode=$result['login_mode'];
								
								$datas= array("user_name"=>$user_name, "msg"=>$msg,"mobile_no"=>$mobile_no,"email_id"=>$email_id,"status"=>$status,"id"=>$id,"user_role"=>$user_role,"login_mode"=>$login_mode,);
								//$this->session->userdata($user_name);
								$session_data=$this->session->set_userdata($datas);

								$this->load->view('header',$datas);
								$this->load->view('home',$datas);
								$this->load->view('footer');
							break;
						}
	 			}
				elseif($msg=="Password Wrong"){
					$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
					$this->session->set_flashdata('msg', 'Password Wrong');
					redirect('/');
				}
				else{
					$datas['user_data']=array("status"=>$result['status'],"msg"=>$result['msg']);
					$this->session->set_flashdata('msg', ' Email invalid');
					 redirect('/');
				}



    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct()
	   {
		  parent::__construct();
		  $this->load->model('usersmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

//-------------------------User  Add / Update---------------------------------

    public function home()
	{
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['country_list'] = $this->usersmodel->getall_country_list();
	    $datas['users_role'] = $this->usersmodel->getall_users_role_list();
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('users/add',$datas);
		  $this->load->view('footer');
		}else{
				redirect('/');
		}
	}

	public function get_state_name()
	{
			$country_id = $this->input->post('country_id');
			$data['res']=$this->usersmodel->getall_state_list($country_id);
			 echo json_encode( $data['res']);
	}

    public function get_city_name()
    {
			$state_id = $this->input->post('sta_id');
			$data['res']=$this->usersmodel->getall_city_list($state_id);
			echo json_encode( $data['res']);
    }

    public function add_user_details()
    {
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
		
		if($user_role==1)
		{
			$name=$this->input->post('name');
			$username=$this->input->post('username');
			$cell=$this->input->post('mobile');
			$email=$this->input->post('email');
			$userrole=$this->input->post('userrole');
			$display_status=$this->input->post('display_status');
			$address1=$this->input->post('address1');
			$student_pic = $_FILES["user_picture"]["name"];
			
			if(empty($student_pic)){
				$user_pic1=' ';
			}else{
				$temp = pathinfo($student_pic, PATHINFO_EXTENSION);
				$user_pic1 = round(microtime(true)) . '.' . $temp;
				$uploaddir = 'assets/users/';
				$profilepic = $uploaddir.$user_pic1;
				move_uploaded_file($_FILES['user_picture']['tmp_name'], $profilepic);
				}
				
				$datas=$this->usersmodel->add_user_details($name,$username,$cell,$email,$address1,$user_pic1,$user_id,$display_status);
				$sta=$datas['status'];
		     
			 if($sta=="success"){
		       $this->session->set_flashdata('msg','Sub-admin created successfully');
			   redirect('users/view');
		     }else if($sta=="UA"){
	             $this->session->set_flashdata('msg','Username already exists!');
			     redirect('users/view');
		     }else if($sta=="ME"){
                   $this->session->set_flashdata('msg','Mobile Number OR Email ID already exists!');
			       redirect('users/view');
		     }else{
		     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
			      redirect('users/view');
		     }

	 	}else{
	 			redirect('/');
	 		 }
    }


    public function view()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['users_view'] = $this->usersmodel->getall_users_details();
	    $datas['followers'] = $this->usersmodel->getall_users_Followers_details();

		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('users/view_users',$datas);
		  $this->load->view('footer');
		}else{
				redirect('/');
		}
    }

		public function view_normal_users()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['users_view'] = $this->usersmodel->view_normal_users();
			$datas['followers'] = $this->usersmodel->getall_users_Followers_details();
			if($user_role==1)
			{
				$this->load->view('header');
				$this->load->view('users/view_normal_users',$datas);
				$this->load->view('footer');
			}else{
					redirect('/');
			}
		}

   
		public function check_password_match(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');

					 $user_id=$this->uri->segment(3);
					 $old_password=$this->input->post('old_password');
					$datas['res']=$this->usersmodel->check_password_match($old_password,$user_id);
		}


		public function update_password(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['users_view'] = $this->usersmodel->getall_users_details1($user_id);
			
			if($user_role == 1 || $user_role == 4)
			{
				$this->load->view('header');
				$this->load->view('users/update_password',$datas);
				$this->load->view('footer');
			}else{
					redirect('/');
			}
		}

		public function change_password(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			if($user_role == 1 || $user_role == 4)
			{
				$new_password=$this->input->post('new_password');
				$confrim_password=$this->input->post('confrim_password');
				$data['res']=$this->usersmodel->change_password($new_password,$confrim_password,$user_id);
				echo json_encode($data['res']);
			}else{
					redirect('/');
			}
		}
		
    public function edit($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['country_list'] = $this->usersmodel->getall_country_list();
	    $datas['users_role'] = $this->usersmodel->getall_users_role_list();
	    $datas['users_view'] = $this->usersmodel->getall_users_details1($id);
			if($user_role == 1 || $user_role == 4)
			{
			  $this->load->view('header');
			  $this->load->view('users/view_user_details',$datas);
			  $this->load->view('footer');
		 	}else{
		 			redirect('/');
		 		 }
    }
	public function edit_normal_users($id)
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('id');
		$user_role=$this->session->userdata('user_role');
		$datas['country_list'] = $this->usersmodel->getall_country_list();
		$datas['users_role'] = $this->usersmodel->getall_users_role_list();
		$datas['users_view'] = $this->usersmodel->getall_users_details1($id);

		if($user_role == 1 || $user_role == 4)
		{
			$this->load->view('header');
			$this->load->view('users/edit_normal_users',$datas);
			$this->load->view('footer');
		}else{
				redirect('/');
			 }
	}

		public function edit_admin($id){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['res'] = $this->usersmodel->getall_users_details1($id);
			// echo "<pre>";print_r($datas['users_view']);exit;
			if($user_role == 1)
			{
				$this->load->view('header');
				$this->load->view('users/edit_admin_user',$datas);
				$this->load->view('footer');
			}else{
					redirect('/');
				 }
			}


    public function update_user_details()
    {
      $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
				if($user_role == 1)
				{
					$uid=$this->input->post('user_id');
					$username=$this->input->post('username');
					$name=$this->input->post('name');
					$cell=$this->input->post('mobile');
					$email=$this->input->post('email');
					$address1=$this->input->post('address1');
					$display_status=$this->input->post('display_status');
					$old_picture=$this->input->post('old_picture');
				
					if(empty($_FILES['user_picture']['name'])){
						$user_pic = $old_picture;
					}else{
						$user_pic=$_FILES['user_picture']['name'];
						$temp = pathinfo($user_pic, PATHINFO_EXTENSION);
						$user_pic = time().'.'.$temp;
						$uploadPicdir = './assets/users/';
						$profilepic = $uploadPicdir.$user_pic;
						move_uploaded_file($_FILES['user_picture']['tmp_name'],$profilepic);

					 }

			$datas=$this->usersmodel->update_user_details($uid,$username,$name,$cell,$email,$address1,$user_pic,$user_id,$display_status);
			 $sta=$datas['status'];
		     if($sta=="success"){
		       $this->session->set_flashdata('msg','Changes made are saved');
			   redirect('users/view');
		     }else if($sta=="Already Exist"){
	             $this->session->set_flashdata('msg','Already exists!');
			     redirect('users/view');
		     }
		     else{
		     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
			      redirect('users/view');
		     }

	 	}else{
	 			redirect('/');
	 		 }
    }

		public function update_user_login_status()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			if($user_role == 1){
			$uid=$this->input->post('user_id');
			$login_status=$this->input->post('login_status');
			$datas=$this->usersmodel->update_user_login_status($uid,$login_status,$user_id);
			$sta=$datas['status'];
				if($sta=="success"){
					$this->session->set_flashdata('msg','Changes made are saved');
					redirect('users/view_normal_users');
				}else{
					$this->session->set_flashdata('msg','Something went wrong! Please try again later.');
					redirect('users/view_normal_users');
				}
			}else{
			redirect('/');
			}
		}

		public function view_followers()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['followers'] = $this->usersmodel->getall_users_Followers_details();
			if($user_role==1)
			{
			  $this->load->view('header');
			  $this->load->view('users/view_followers_list',$datas);
			  $this->load->view('footer');
			}else{
					redirect('/');
				 }
		}
	
		public function view_followers_details($usersid)
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['fdetails'] = $this->usersmodel->users_followers_details($usersid);
			//echo'<pre>';print_r($datas['fdetails']);exit;
			if($user_role == 1 || $user_role == 4)
			{
			  $this->load->view('header');
			  $this->load->view('users/view_followers_details',$datas);
			  $this->load->view('footer');
			}else{
					redirect('/');
				 }
		}

		public function mail_checker()
		{
			$email = $this->input->post('email');
		   $numrows = $this->usersmodel->getemail($email);
		}

		public function mobile_checker()
		{
			$cell = $this->input->post('mobile');
			$numrows1 = $this->usersmodel->check_mobile_num($cell);
		}

		public function username_checker()
		{
			$uname = $this->input->post('username');
			$numrows2 = $this->usersmodel->check_user_name($uname);
		}

		public function mail_checker_exist()
		{
			$id=$this->uri->segment(3);
			$email = $this->input->post('email');
			$numrows = $this->usersmodel->getemail_exist($email,$id);
		}

		public function mobile_checker_exist()
		{
			$id=$this->uri->segment(3);
			$cell = $this->input->post('mobile');
			$numrows1 = $this->usersmodel->check_mobile_num_exist($cell,$id);
		}

		public function username_checker_exist()
		{
			$id=$this->uri->segment(3);
			$uname = $this->input->post('username');
			$numrows2 = $this->usersmodel->check_user_name_exist($uname,$id);
		}


    public function profile($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['country_list'] = $this->usersmodel->getall_country_list();
	    $datas['users_role'] = $this->usersmodel->getall_users_role_list();
	    $datas['res'] = $this->usersmodel->getall_users_details1($id);
			if($user_role == 1 || $user_role == 4)
			{
			  $this->load->view('header');
			  $this->load->view('users/profile_details',$datas);
			  $this->load->view('footer');
		 	}else{
		 			redirect('/');
		 		 }
    }


 public function profile_update()
    {
      $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
				if($user_role == 1 || $user_role == 4)
				{
					$uid=$this->input->post('user_id');
					//$username=$this->input->post('username');
					$name=$this->input->post('name');
					$cell=$this->input->post('mobile');
					$email=$this->input->post('email');
					$address1=$this->input->post('address1');
					$old_picture=$this->input->post('old_picture');
				
					if(empty($_FILES['user_picture']['name'])){
						$user_pic=$old_picture;
					}else{
						$user_pic=$_FILES['user_picture']['name'];
						$temp = pathinfo($user_pic, PATHINFO_EXTENSION);
						$user_pic = time().'.'.$temp;
						$uploadPicdir = './assets/users/';
						$profilepic = $uploadPicdir.$user_pic;
						move_uploaded_file($_FILES['user_picture']['tmp_name'],$profilepic);

					 }

			$datas=$this->usersmodel->update_profile_details($uid,$name,$cell,$email,$address1,$user_pic,$user_id);
			 $sta=$datas['status'];
		     if($sta=="success"){
		       $this->session->set_flashdata('msg','Changes made are saved');
			   redirect('users/profile/'.$uid.'');
		     }else if($sta=="Already Exist"){
	             $this->session->set_flashdata('msg','Already exists!');
			     redirect('users/view');
		     }
		     else{
		     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
			      redirect('users/profile/'.$uid.'');
		     }

	 	}else{
	 			redirect('/');
	 		 }
    }

	} ?>

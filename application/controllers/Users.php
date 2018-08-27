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
	        $sdate=$this->input->post('dob');
					$dateTime = new DateTime($sdate);
					$dob=date_format($dateTime,'Y-m-d');
	        $gender=$this->input->post('gender');
	        $address1=$this->db->escape_str($this->input->post('address1'));
	        $occupation=$this->db->escape_str($this->input->post('occupation'));
	        $country=$this->input->post('country');
          $statename=$this->input->post('statename');
          $city=$this->input->post('city');
          $zip=$this->input->post('zip');
          $status=$this->input->post('status');
          $userrole=$this->input->post('userrole');
          $display_status=$this->input->post('display_status');
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
					$datas=$this->usersmodel->add_user_details($name,$username,$cell,$email,$dob,$gender,$address1,$occupation,$country,$statename,$city,$zip,$user_pic1,$status,$userrole,$user_id,$display_status);
			 $sta=$datas['status'];
		     if($sta=="success"){
		       $this->session->set_flashdata('msg','Added Successfully');
			   redirect('users/view');
		     }else if($sta=="UA"){
	             $this->session->set_flashdata('msg','Username Already Exist');
			     redirect('users/view');
		     }else if($sta=="ME"){
                   $this->session->set_flashdata('msg','Mobile OR Email Id Already Exist');
			       redirect('users/view');
		     }else{
		     	 $this->session->set_flashdata('msg','Faild To Add');
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

    public function edit($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['country_list'] = $this->usersmodel->getall_country_list();
	    $datas['users_role'] = $this->usersmodel->getall_users_role_list();
	    $datas['users_view'] = $this->usersmodel->getall_users_details1($id);
       // echo'<pre>';print_r($datas['users_view']);exit;
		if($user_role == 1 || $user_role == 4)
		{
		  $this->load->view('header');
		  $this->load->view('users/edit_users',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
    }

		public function edit_noraml_users($id)
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');
			$datas['country_list'] = $this->usersmodel->getall_country_list();
			$datas['users_role'] = $this->usersmodel->getall_users_role_list();
			$datas['users_view'] = $this->usersmodel->getall_users_details1($id);
			 // echo'<pre>';print_r($datas['users_view']);exit;
		if($user_role == 1 || $user_role == 4)
		{
			$this->load->view('header');
			$this->load->view('users/edit_noraml_users',$datas);
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
					$uid=$this->input->post('uid');
					$umid=$this->input->post('umid');
					$username=$this->input->post('username');
					$name=$this->input->post('name');
	        $cell=$this->input->post('mobile');
	        $email=$this->input->post('email');
					$sdate=$this->input->post('dob');
					$dateTime =DateTime::createFromFormat('m-d-Y', $sdate);
					$dob=$dateTime->format('Y-m-d');
	        $gender=$this->input->post('gender');
	        $address1=$this->db->escape_str($this->input->post('address1'));
	        // $address2=$this->db->escape_str($this->input->post('address2'));
	        // $address3=$this->db->escape_str($this->input->post('address3'));
	        $occupation=$this->db->escape_str($this->input->post('occupation'));
	        $country=$this->input->post('country');
          $statename=$this->input->post('statename');
          $city=$this->input->post('city');
          $zip=$this->input->post('zip');
          $status=$this->input->post('status');
          $userrole=$this->input->post('role');
					$display_status=$this->input->post('display_status');
          $old_picture=$this->input->post('old_picture');
				if(empty($_FILES['user_picture']['name'])){
					$user_pic1=$old_picture;
				}else{
					$user_pic=$_FILES['user_picture']['name'];
					$file_name = time().rand(1,5).rand(6,10);
					$user_pic1=$file_name.$user_pic;
					$uploaddir='assets/users/';
					$profilepic=$uploaddir.$user_pic1;
					move_uploaded_file($_FILES['user_picture']['tmp_name'],$profilepic);
					$user_pic1=$user_pic1;
				 }
							
		   $datas=$this->usersmodel->update_user_details($uid,$umid,$username,$name,$cell,$email,$dob,$gender,$address1,$occupation,$country,$statename,$city,$zip,$user_pic1,$status,$userrole,$user_id,$display_status);
			 $sta=$datas['status'];
		     if($sta=="success"){
		       $this->session->set_flashdata('msg','Updated Successfully');
			   redirect('users/view');
		     }else if($sta=="Already Exist"){
	             $this->session->set_flashdata('msg','Already Exist');
			     redirect('users/view');
		     }
		     else{
		     	 $this->session->set_flashdata('msg','Faild To Update');
			      redirect('users/view');
		     }

	 	}else{
	 			redirect('/');
	 		 }
    }

    public function delete()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    if($user_role == 1 || $user_role == 4)
		{
		   $id=$this->input->post('uaid');
	       $users_id=$this->input->post('userid');

	       //echo $id; echo $users_id; exit;

	     $datas= $this->usersmodel->delete($id,$users_id);
         $sta=$datas['status'];
		  if($sta=="success"){
		   //$this->session->set_flashdata('msg','Deleted Successfully');
		  //redirect('users/view');
		  	echo "success";
		   }else{
		     //$this->session->set_flashdata('msg','Faild To Delete');
			 //redirect('users/view');
		   	echo "Faild";
		     }
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


	} ?>

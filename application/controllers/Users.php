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
		 //echo $classid;exit;
		 $data['res']=$this->usersmodel->getall_state_list($country_id);
		 echo json_encode( $data['res']);
	}

    public function get_city_name()
    {
	   	 $state_id = $this->input->post('sta_id');
		 //echo $classid;exit;
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
	        $pwd=md5($this->db->escape_str($this->input->post('pwd')));
            //echo $name;exit;
	        $sdate=$this->input->post('dob');
					$dateTime = new DateTime($sdate);
					$dob=date_format($dateTime,'Y-m-d');

	        $gender=$this->input->post('gender');

	        $address1=$this->db->escape_str($this->input->post('address1'));
	        $address2=$this->db->escape_str($this->input->post('address2'));
	        $address3=$this->db->escape_str($this->input->post('address3'));
	        $occupation=$this->db->escape_str($this->input->post('occupation'));
	        $country=$this->input->post('country');
            $statename=$this->input->post('statename');
            $city=$this->input->post('city');
            $zip=$this->input->post('zip');
            $status=$this->input->post('status');
            $userrole=$this->input->post('userrole');
            $display_status=$this->input->post('display_status');

            $user_pic=$_FILES['user_picture']['name'];
            $file_name = time().rand(1,5).rand(6,10);
			$user_pic1=$file_name.$user_pic;
			$uploaddir='assets/users/';
			$profilepic=$uploaddir.$user_pic1;
			move_uploaded_file($_FILES['user_picture']['tmp_name'],$profilepic);

			$datas=$this->usersmodel->add_user_details($name,$username,$cell,$email,$pwd,$dob,$gender,$address1,$address2,$address3,$occupation,$country,$statename,$city,$zip,$user_pic1,$status,$userrole,$user_id,$display_status);
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

        //echo'<pre>';print_r($datas['followers']);exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('users/view_users',$datas);
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
        //echo'<pre>';print_r($datas['followers']);exit;
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

    public function update_user_details()
    {
      $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

		if($user_role == 1 || $user_role == 4)
		{
			$uid=$this->input->post('uid');
			$umid=$this->input->post('umid');

			$username=$this->input->post('username');

			//echo $username;
			$name=$this->input->post('name');
	        $cell=$this->input->post('mobile');

	        $email=$this->input->post('email');
	        $old_pwd=$this->input->post('old_pwd');
			 $new_pwd=$this->input->post('new_pwd');
			
			if(!empty($new_pwd)){
				  $pwd = md5($new_pwd);
			}else{
				  $pwd = $old_pwd;
			 }
			//exit;
	        //$pwd1=$this->db->escape_str($this->input->post('new_pwd'));
            //echo $new_pwd; echo'<br>'; echo $old_pwd; echo'<br>'; echo md5($new_pwd);
			
	        //if(empty($pwd1)){
			//	$pwd=$old_pwd;
			//}else{ $pwd=md5($pwd1); }
			
					$sdate=$this->input->post('dob');
					$dateTime =DateTime::createFromFormat('m-d-Y', $sdate);
					$dob=$dateTime->format('Y-m-d');
           //echo $dob; exit;
	        $gender=$this->input->post('gender');

	        $address1=$this->db->escape_str($this->input->post('address1'));
	        $address2=$this->db->escape_str($this->input->post('address2'));
	        $address3=$this->db->escape_str($this->input->post('address3'));
	        $occupation=$this->db->escape_str($this->input->post('occupation'));
	        $country=$this->input->post('country');
            $statename=$this->input->post('statename');
            $city=$this->input->post('city');
            $zip=$this->input->post('zip');
            $status=$this->input->post('status');
            $userrole=$this->input->post('role');
            $display_status=$this->input->post('display_status');

            $old_picture=$this->input->post('old_picture');

            $user_pic=$_FILES['user_picture']['name'];
            $file_name = time().rand(1,5).rand(6,10);
			$user_pic1=$file_name.$user_pic;
			$uploaddir='assets/users/';
			$profilepic=$uploaddir.$user_pic1;
			move_uploaded_file($_FILES['user_picture']['tmp_name'],$profilepic);

			if(empty($user_pic=$_FILES['user_picture']['name'])){
				$user_pic1=$old_picture;
			}else{ $user_pic1=$user_pic1; }
              //echo $user_pic1;exit;
			  
		    $datas=$this->usersmodel->update_user_details($uid,$umid,$username,$pwd,$name,$cell,$email,$pwd,$dob,$gender,$address1,$address2,$address3,$occupation,$country,$statename,$city,$zip,$user_pic1,$status,$userrole,$user_id,$display_status);
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
		if ($numrows > 0)
		{
		 echo "Email Id already Exit";
		}else{
			 echo "Email Id Available";
			 }
    }

    public function mobile_checker()
    {
      $cell = $this->input->post('cell');
	  $numrows1 = $this->usersmodel->check_mobile_num($cell);
	  if ($numrows1 > 0)
	  {
		 echo "Mobile Number already Exit";
		}else{
			 echo "Mobile Number Available";
			 }
    }

    public function username_checker()
    {
      $uname = $this->input->post('uname');
	  $numrows2 = $this->usersmodel->check_user_name($uname);
	  if ($numrows2 > 0)
	  {
		echo "UserName already Exit";
	  }else{
		echo "UserName Available";
		}
    }

  //   public function checker()
  //   {
  //     $valtext = $this->input->post('valtext');
	 //  $numrows2 = $this->usersmodel->checker_fun($valtext);
	 //  if ($numrows2 > 0)
	 //  {
		// echo "Already Exit";
	 //  }else{
		// echo "Available";
		// }
  //   }


	} ?>

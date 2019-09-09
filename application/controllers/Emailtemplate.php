<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtemplate extends CI_Controller
{
	function __construct()
	   {
		  parent::__construct();
		  $this->load->model('emailtemplatemodel');
		  $this->load->model('citymodel');
		  $this->load->model('mailmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

//------------------------- Guest user View --------------------------------- send_email

    public function home()
	{
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['view'] = $this->emailtemplatemodel->getall_email_template_details();
	    //echo'<pre>';print_r($datas['view'] );exit;

		if($user_role == 1 || $user_role == 4)
		{
		  $this->load->view('header');
		  $this->load->view('email_template/add_template',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	}

	public function add_template()
	{

		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

       if($user_role == 1 || $user_role == 4)
	   {
		    $tempname=$this->db->escape_str($this->input->post('templatename'));
		    $tempdetails=$this->db->escape_str($this->input->post('templatecontent'));
				$pic = $_FILES["notification_img"]["name"];
				if(empty($pic)){
					$img=' ';
				}else{
				$temp = pathinfo($pic, PATHINFO_EXTENSION);
				$img = round(microtime(true)) . '.' . $temp;
				$uploaddir = 'assets/notification/images/';
				$profilepic = $uploaddir.$img;
				move_uploaded_file($_FILES['notification_img']['tmp_name'], $profilepic);
			}

		    $datas = $this->emailtemplatemodel->add_templates_details($tempname,$tempdetails,$img,$user_id);
	        $sta=$datas['status'];
	        //print_r($sta);exit;
	        if($sta=="success"){
		       $this->session->set_flashdata('msg','Content created for notification');
			   redirect('emailtemplate/home');
		    }else if($sta=="AE"){
		    	 $this->session->set_flashdata('msg','Title already exists!');
			   redirect('emailtemplate/home');
		    }else{
		     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
			     redirect('emailtemplate/home');
		    }
		}else{
	 			redirect('/');
	 		 }
	}

				public function delete_template($id)
				{
					$datas=$this->session->userdata();
					$user_id=$this->session->userdata('id');
					$user_role=$this->session->userdata('user_role');
						if($user_role == 1 || $user_role == 4)
						{
						$datas = $this->emailtemplatemodel->delete_templates_details($id,$user_id);
							$sta=$datas['status'];
							if($sta=="success"){
							$this->session->set_flashdata('msg','Deleted Successfully');
							redirect('emailtemplate/home');
							}else{
							$this->session->set_flashdata('msg','Faild To Delete');
							redirect('emailtemplate/home');
							}
						}else{
						redirect('/');
						}
				}

	public function edit_template($id)
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['edit'] = $this->emailtemplatemodel->edit_email_template_details($id);
		if($user_role == 1 || $user_role == 4)
		{
		  $this->load->view('header');
		  $this->load->view('email_template/edit_template',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	}

	public function update_template()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
       if($user_role == 1 || $user_role == 4)
	   {
	   	  $id=$this->db->escape_str($this->input->post('tid'));
		    $tempname=$this->db->escape_str($this->input->post('templatename'));
		    $tempdetails=$this->db->escape_str($this->input->post('templatecontent'));
				$old_notification_img=$this->db->escape_str($this->input->post('old_notification_img'));
				$pic = $_FILES["notification_img"]["name"];
				if(empty($pic)){
					$img=$old_notification_img;
				}else{
				$temp = pathinfo($pic, PATHINFO_EXTENSION);
				$img = round(microtime(true)) . '.' . $temp;
				$uploaddir = 'assets/notification/images/';
				$profilepic = $uploaddir.$img;
				move_uploaded_file($_FILES['notification_img']['tmp_name'], $profilepic);
			}
		    $datas = $this->emailtemplatemodel->update_templates_details($id,$tempname,$tempdetails,$img,$user_id);
	        $sta=$datas['status'];
	        if($sta=="success"){
		       $this->session->set_flashdata('msg','Changes made are saved');
			   redirect('emailtemplate/home');
		    }else{
		     	 $this->session->set_flashdata('msg','Something went wrong! Please try again later.');
			     redirect('emailtemplate/home');
		    }
		}else{
	 			redirect('/');
	 		 }
	}


//-----------------------------------SEND------------------------------------


		public function select_users()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('id');
			$user_role=$this->session->userdata('user_role');

			if($user_role == 1 || $user_role == 4){
				$cityid=$this->input->post('cityid');

				if($cityid!=''){
					$datas['city_id']=$cityid;
				 $datas['view'] = $this->emailtemplatemodel->getall_search_users_details($cityid);
				}else{
					$datas['view'] = $this->emailtemplatemodel->getall_users_details();
				}

					$datas['email_tem'] = $this->emailtemplatemodel->getall_email_template();
					$datas['city_list'] = $this->emailtemplatemodel->getall_city_list();

					//print_r ($datas);
						$this->load->view('header');
						$this->load->view('email_template/send_template',$datas);
						$this->load->view('footer');
			}else{
				redirect('/');
			}
		}

		public function get_city_name()
		{
			$country_id = $this->input->post('country_id');
			$data['res']=$this->emailtemplatemodel->get_city_name($country_id);
			echo json_encode( $data['res']);
		}

					public function send_email()
					{
						$datas=$this->session->userdata();
						$user_id=$this->session->userdata('id');
						$user_role=$this->session->userdata('user_role');
							if($user_role == 1 || $user_role == 4)
							{
							$email_temp_id=$this->input->post('email_temp_id');
							$mailids=$this->input->post('usersemailid');
							$datas['res']=$this->mailmodel->send_mail_to_users($mailids,$email_temp_id);
							$sts=$datas['status'];
							if($sts=="Y"){
							$this->session->set_flashdata('msg','Send Successfully');
							redirect('emailtemplate/select_users');
							}else{
							$this->session->set_flashdata('msg','Something went wrong! Please try again later.');
							redirect('emailtemplate/select_users');
							}
								}else{
								redirect('/');
								}
					}


		public function send_newsletter()
			{
				$datas=$this->session->userdata();
			    $user_id=$this->session->userdata('id');
			    $user_role=$this->session->userdata('user_role');
		        if($user_role == 1 || $user_role == 4){
					$user_ids = $this->input->post('user_id');
		
					$email_temp_id=$this->input->post('email_temp_id');
					//$email = $this->input->post('email');
					$sms = $this->input->post('sms');
					$notify = $this->input->post('notify');

					if(empty($user_ids)){
						$this->session->set_flashdata('msg','Please select atleast one user');
						redirect('emailtemplate/select_users');
					}else{
						if ($sms !=""){
							$datas2 =$this->mailmodel->send_sms_to_users($user_ids,$email_temp_id);
						}
						if ($notify !=""){
							$datas3 =$this->mailmodel->send_nofify_to_users($user_ids,$email_temp_id);
						}
						$this->session->set_flashdata('msg','Notification sent successfully');
						redirect('emailtemplate/select_users');
					}
			    }else{
			    	redirect('/');
			    }
			}



}
?>

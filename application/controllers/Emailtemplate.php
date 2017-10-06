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

//------------------------- Guest user View ---------------------------------

    public function home()
	{
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['view'] = $this->emailtemplatemodel->getall_email_template_details();
	    //echo'<pre>';print_r($datas['view'] );exit;

		if($user_role==1)
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

       if($user_role==1)
	   {
		    $tempname=$this->db->escape_str($this->input->post('templatename'));
		    $tempdetails=$this->db->escape_str($this->input->post('templatecontent'));

		    //echo $tempdetails;exit;

		    $datas = $this->emailtemplatemodel->add_templates_details($tempname,$tempdetails,$user_id);
	        $sta=$datas['status'];
	        //print_r($sta);exit;
	        if($sta=="success"){
		       $this->session->set_flashdata('msg','Added Successfully');
			   redirect('emailtemplate/home');
		    }else if($sta=="AE"){
		    	 $this->session->set_flashdata('msg','Already Exist');
			   redirect('emailtemplate/home');
		    }else{
		     	 $this->session->set_flashdata('msg','Faild To Add');
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

       if($user_role==1)
	   {
		    $datas = $this->emailtemplatemodel->delete_templates_details($id,$user_id);
	        $sta=$datas['status'];
	        //print_r($sta);exit;
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
	    //echo'<pre>';print_r($datas['edit'] );exit;

		if($user_role==1)
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

       if($user_role==1)
	   {    
	   	    $id=$this->db->escape_str($this->input->post('tid'));
		    $tempname=$this->db->escape_str($this->input->post('templatename'));
		    $tempdetails=$this->db->escape_str($this->input->post('templatecontent'));

		    //echo $tempdetails;exit;

		    $datas = $this->emailtemplatemodel->update_templates_details($id,$tempname,$tempdetails,$user_id);
	        $sta=$datas['status'];
	        //print_r($sta);exit;
	        if($sta=="success"){
		       $this->session->set_flashdata('msg','Updated Successfully');
			   redirect('emailtemplate/home');
		    }else{
		     	 $this->session->set_flashdata('msg','Faild To Update');
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
        if($user_role==1)
		{
        $countryid=$this->input->post('countryid');
        $cityid=$this->input->post('cityid');
        $username=$this->input->post('username');
  
        if($countryid!='' || $cityid!='' || $username!='')
        {
          $datas['countyr_list'] = $this->citymodel->getall_country_list();
          $datas['city_list'] = $this->emailtemplatemodel->getall_city_list();
          $datas['search_view'] = $this->emailtemplatemodel->getall_search_users_details($countryid,$cityid,$username);
          // echo'<pre>';print_r($datas['search_view'] );exit;
        }
	    $datas['view'] = $this->emailtemplatemodel->getall_users_details();
	    $datas['email_tem'] = $this->emailtemplatemodel->getall_email_template();
	    $datas['countyr_list'] = $this->citymodel->getall_country_list();
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
		//echo $classid;exit;
		$data['res']=$this->emailtemplatemodel->get_city_name($country_id);
		echo json_encode( $data['res']);
	}

	public function send_email()
	{
		$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
        if($user_role==1)
		{
	        $email_temp_id=$this->input->post('email_temp_id');
	        $mailids=$this->input->post('usersemailid');
	       
	        $datas['res']=$this->mailmodel->send_mail_to_users($mailids,$email_temp_id);
	        $sts=$datas['status'];
	        //print_r($sts);exit;
	        if($sta=="success"){
		       $this->session->set_flashdata('msg','Send Successfully');
			   redirect('emailtemplate/select_users');
		    }else{
		     	 $this->session->set_flashdata('msg','Faild To Send');
			     redirect('emailtemplate/select_users');
		    }
	    }else{
	    	redirect('/');
	    }
	}

}
?>
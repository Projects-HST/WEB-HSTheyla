<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userrole extends CI_Controller 
{
	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('userrolemodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

//-------------------------User Role Add / Update---------------------------------

    public function home()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['result'] = $this->userrolemodel->getall_user_details();
         //print_r($datas['result']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('userrole/add',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

	 public function add_users()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $username=$this->input->post('username');
	    $ustatus=$this->input->post('usersts');

	    $datas= $this->userrolemodel->insert_users_details($user_id,$username,$ustatus);
	    $sta=$datas['status'];

	    if($sta=="success"){
	       $this->session->set_flashdata('msg','Added Successfully');
		   redirect('userrole/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('userrole/home');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Faild To Add');
		     redirect('userrole/home');
	     }
	 }

	 public function edit_users($id)
	 {
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $datas['edit']= $this->userrolemodel->edit_users_details($id);

	    if($user_role==1){
            $this->load->view('header');
		    $this->load->view('userrole/edit',$datas);
		    $this->load->view('footer');
	 	   }else{
	 			redirect('/');
	 		 }
	 }

	 public function update_userrole()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $username=$this->input->post('username');
	    $ustatus=$this->input->post('usersts');
	    $userid=$this->input->post('userid');


	    $datas= $this->userrolemodel->update_users_details($user_id,$userid,$username,$ustatus);
	    $sta=$datas['status'];

	    if($sta=="success"){
	       $this->session->set_flashdata('msg','Updated Successfully');
		   redirect('userrole/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('userrole/home');
	     }else{
	     	 $this->session->set_flashdata('msg','Faild To Update');
		     redirect('userrole/home');
	     }
	 }

	 public  function delete_users($id)
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $datas= $this->userrolemodel->delete_users_details($id);

	    $sta=$datas['status'];
        //print_r($sta); exit;
	    if($sta=="success"){
	       $this->session->set_flashdata('msg','Deleted Successfully');
		   redirect('userrole/home');
	     }else{
	     	 $this->session->set_flashdata('msg','Faild To Delete');
		     redirect('userrole/home');
	     }

	 }

}?>
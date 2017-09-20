<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller 
{


	function __construct() 
    {
	  parent::__construct();
	  $this->load->model('categorymodel');
	  $this->load->helper('url');
	  $this->load->library('session');
    }

//-------------------------Category Add / Update---------------------------------

     public function home()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
   
	    $datas['result'] = $this->categorymodel->getall_category_details();
        //print_r($datas['result']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('category/add',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

    public function add_category()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $categoryname=$this->input->post('categoryname');
	    $status=$this->input->post('eventsts');

        //echo $categoryname; echo $status;

	    $category_pic=$_FILES['categorypic']['name']; 
		$categorypic1=trim($category_pic);
		$uploaddir='assets/category/';
		$profilepic=$uploaddir.$categorypic1;
		move_uploaded_file($_FILES['categorypic']['tmp_name'],$profilepic);

        $datas = $this->categorymodel->insert_category($categoryname,$categorypic1,$status,$user_id,$user_role);
        $sta=$datas['status'];
	     //print_r($sta);exit;
	     if($sta=="success"){
	       $this->session->set_flashdata('msg','Added Successfully');
		   redirect('category/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('category/home');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Faild To Add');
		     redirect('category/home');
	     }
    }


    public function edit_category($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
        
        $datas['edit'] = $this->categorymodel->edit_category($id,$user_id,$user_role);
        if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('category/edit',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }

    }

    public function update_category()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
        
        $categoryname=$this->input->post('categoryname');
	    $status=$this->input->post('eventsts');
	    $currentpic=$this->input->post('currentcpic');
	    $category_id=$this->input->post('id');


	    $category_pic=$_FILES['categorypic']['name']; 
		$categorypic1=trim($category_pic);
		$uploaddir='assets/category/';
		$profilepic=$uploaddir.$categorypic1;
		move_uploaded_file($_FILES['categorypic']['tmp_name'],$profilepic);
        
        if(empty($categorypic1)){
         $categorypic1=$currentpic;
        }

	    $datas = $this->categorymodel->update_category_details($category_id,$categoryname,$categorypic1,$status,$user_id,$user_role);
	    $sta=$datas['status'];
	     //print_r($sta);exit;
	     if($sta=="success"){
	       $this->session->set_flashdata('msg','Updated Successfully');
		   redirect('category/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('category/home');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Faild To Update');
		     redirect('category/home');
	     }
    }
   
}
?>

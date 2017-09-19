<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller 
{


	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('citymodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

//-------------------------City Add / Update---------------------------------

     public function home()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $datas['countyr_list'] = $this->citymodel->getall_country_list();
	    $datas['result'] = $this->citymodel->getall_city_details();
        //print_r($datas['result']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('city/add',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

    public function add_city()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	     $countryid=$this->input->post("countryid");
	     $cityname=$this->input->post("cityname");
	     $estatus=$this->input->post("eventsts");

	     $datas=$this->citymodel->insert_city_details($countryid,$cityname,$estatus,$user_id,$user_role);
         $sta=$datas['status'];
	     //print_r($sta);exit;
	     if($sta=="success"){
	       $this->session->set_flashdata('msg','Added Successfully');
		   redirect('city/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('city/home');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Faild To Add');
		     redirect('city/home');
	     }

    }


    public function edit_city($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
        $datas['countyr_list'] = $this->citymodel->getall_country_list();
	    $datas['edit']=$this->citymodel->eidt_city_details($id);
	    //echo'<pre>'; print_r($datas['edit']);exit;
        if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('city/edit',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }


    }

    public function update_city()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
        
        $countryid=$this->input->post("countryid"); 
        $cityname=$this->input->post("cityname");
        $cityid=$this->input->post("cityid");
	    $estatus=$this->input->post("eventsts");

	    $datas=$this->citymodel->update_city_details($countryid,$cityname,$cityid,$estatus,$user_id,$user_role);
        $sta=$datas['status'];
	     //print_r($sta);exit;
	     if($sta=="success"){
	       $this->session->set_flashdata('msg','Update Successfully');
		   redirect('city/home');
	     }else if($sta=="Already Exist"){
	     	 $this->session->set_flashdata('msg','Already Exist');
		     redirect('city/home');
	     }else{
	     	 $this->session->set_flashdata('msg','Faild To Update');
		     redirect('city/home');
	     }
    }






}
?>

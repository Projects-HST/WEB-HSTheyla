<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country extends CI_Controller 
{
	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('countrymodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

//-------------------------Country Add / Update---------------------------------

    public function home()
	 {
	 	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    $datas['result'] = $this->countrymodel->getall_details();
         //print_r($datas['result']); exit;
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('country/add',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
	 }

    public function add_country()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	     $cname=$this->input->post("countryname");
	     $estatus=$this->input->post("eventsts");
	     //echo $cname; echo $estatus;  echo $user_role; exit;
	     $datas=$this->countrymodel->insert_country_details($cname,$estatus,$user_id,$user_role);
         $sta=$datas['status'];
	     //print_r($sta);exit;
	     if($sta=="success"){
	       $this->session->set_flashdata('msg','Added Successfully');
		   redirect('country/home');
	     }else if($sta=="Already Exist"){
             $this->session->set_flashdata('msg','Already Exist');
		     redirect('country/home');
	     }
	     else{
	     	 $this->session->set_flashdata('msg','Faild To Add');
		     redirect('country/home');
	     }

    }


    public function edit_country($id)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

	    $datas['edit']=$this->countrymodel->eidt_country_details($id);
	    //echo'<pre>'; print_r($datas['edit']);exit;
        if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('country/edit',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }

    }

    public function update_country()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
        
        $cnid=$this->input->post("cnid"); 
        $cname=$this->input->post("countryname");
	    $estatus=$this->input->post("eventsts");

	    $datas=$this->countrymodel->update_country_details($cnid,$cname,$estatus,$user_id,$user_role);
        $sta=$datas['status'];
	     //print_r($sta);exit;
	     if($sta=="success"){
	       $this->session->set_flashdata('msg','Update Successfully');
		   redirect('country/home');
	     }else{
	     	 $this->session->set_flashdata('msg','Faild To Update');
		     redirect('country/home');
	     }
    }


}
?>

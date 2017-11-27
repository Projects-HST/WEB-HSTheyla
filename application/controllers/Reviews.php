<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller 
{


	function __construct() 
	   {
		  parent::__construct();
		  $this->load->model('reviewsmodel');
		  $this->load->helper('url');
		  $this->load->library('session');
       }

    //------------------------- Reviews Add / Update---------------------------------
     
    public function home()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['views'] = $this->reviewsmodel->view_all_reviews();
       
		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('reviews/view_reviews',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
    }

    public function view_reviews()
    {
        $datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['views'] = $this->reviewsmodel->view_all_reviews();

        //echo'<pre>';print_r($datas['views']);exit();

		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('reviews/pending_reviews',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }

    }
    public function display($id,$sts,$event_id,$userid)
    { 
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    //echo $id; echo $sts; echo $event_id; exit;
       if($user_role==1)
       { 
		    $datas = $this->reviewsmodel->reviews_status($id,$sts,$user_id,$event_id,$userid);
			if($datas['status']=="success")
		     {  
		       $this->session->set_flashdata('msg','Updated Successfully');
			   redirect('reviews/view_reviews');
		     }else{
	         $this->session->set_flashdata('msg','Faild To Update');
			   redirect('reviews/view_reviews');
	         }
        }else{
       	 redirect('/');
        }

    }

     public function archive($id,$sts)
    { 
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
	    //echo $id; echo $sts; exit;
        if($user_role==1)
        { 
	      $datas = $this->reviewsmodel->reviews_status($id,$sts,$user_id);
		  if($datas['status']=="success")
	       {  
		       $this->session->set_flashdata('msg','Updated Successfully');
			   redirect('reviews/view_reviews');
	       }else{
             $this->session->set_flashdata('msg','Faild To Update');
		     redirect('reviews/view_reviews');
            }
        }else{
       	 redirect('/');
        }

    }

    public function archive_reviews()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');

        $datas['views'] = $this->reviewsmodel->view_all_archive_reviews();

        //echo'<pre>';print_r($datas['views']);exit();

		if($user_role==1)
		{
		  $this->load->view('header');
		  $this->load->view('reviews/archive_reviews',$datas);
		  $this->load->view('footer');
	 	}else{
	 			redirect('/');
	 		 }
    }


}
?>
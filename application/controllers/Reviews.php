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
			if($user_role == 1 || $user_role == 4)
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
			if($user_role == 1 || $user_role == 4)
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
       if($user_role == 1 || $user_role == 4)
       {
		    $datas = $this->reviewsmodel->reviews_status($id,$sts,$user_id,$event_id,$userid);
				if($datas['status']=="success"){
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

     public function archive($id,$sts,$event_id,$userid)
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
      if($user_role == 1 || $user_role == 4)
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

    public function archive_reviews()
    {
    	$datas=$this->session->userdata();
	    $user_id=$this->session->userdata('id');
	    $user_role=$this->session->userdata('user_role');
      $datas['views'] = $this->reviewsmodel->view_all_archive_reviews();
			if($user_role == 1 || $user_role == 4)
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

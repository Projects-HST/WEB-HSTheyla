<?php

Class Reviewsmodel extends CI_Model
{ 

   public function __construct()
   {
      parent::__construct();
   }
  
//--------------------------------Bookingmodel Query-------------------------------------

function view_all_reviews()
{        //SELECT r.*,p.photo FROM event_reviews AS r LEFT JOIN event_review_photos AS p ON r.id = p.review_id
     //$sql="SELECT r.*,e.event_name,p.photo,p.review_id FROM event_reviews AS r,events AS e,event_review_photos AS p WHERE r.event_id=e.id AND r.status='N' AND r.id=p.review_id ORDER BY r.id DESC";
	 $sql="SELECT r.*,p.photo,e.event_name FROM event_reviews AS r LEFT JOIN event_review_photos AS p ON r.id = p.review_id LEFT JOIN events AS e On r.event_id=e.id WHERE r.status='N' ORDER BY r.id DESC";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
}

function view_all_archive_reviews()
{
    $sql="SELECT r.*,p.photo,e.event_name FROM event_reviews AS r LEFT JOIN event_review_photos AS p ON r.id = p.review_id LEFT JOIN events AS e On r.event_id=e.id WHERE r.status='A' ORDER BY r.id DESC";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
}

function edit_all_reviews($id)
{
	$sql1="SELECT r.*,e.event_name FROM event_reviews AS r,events AS e WHERE r.event_id=e.id AND r.id='$id' ORDER BY r.id DESC";
	$resu1=$this->db->query($sql1);
	$res1=$resu1->result();
	return $res1;
}

function reviews_status($id,$sts,$user_id)
{
	$rsts="UPDATE event_reviews SET status='$sts' WHERE id='$id'";
	$resu1=$this->db->query($rsts);
	$data= array("status"=>"success");
	return $data;
}



}
?>
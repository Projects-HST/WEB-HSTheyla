<?php

Class Reviewsmodel extends CI_Model
{ 

   public function __construct()
   {
      parent::__construct();
   }
  
//--------------------------------Bookingmodel Query-------------------------------------


function view_all_reviews()
{    
	 $sql="SELECT r.*,p.photo,e.event_name FROM event_reviews AS r LEFT JOIN event_review_photos AS p ON r.id = p.review_id LEFT JOIN events AS e On r.event_id=e.id ORDER BY r.id DESC";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
}

function view_peding_reviews()
{
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

function reviews_status($id,$sts,$user_id,$event_id,$userid)
{
	$rsts="UPDATE event_reviews SET status='$sts' WHERE id='$id'";
	$resu1=$this->db->query($rsts);
  
    if($sts=='Y'){
    	
    	$activity_sql = "INSERT INTO user_activity (date,user_id,event_id,rule_id,activity_detail) VALUES (NOW(),'$userid','$event_id','4','Review')";
        $insert_activity = $this->db->query($activity_sql);
                
        $activity_points = "UPDATE user_points_count SET review_count = review_count+1,review_points=review_points +15, total_points =total_points+15 WHERE user_id ='$userid'";
        $insert_points = $this->db->query($activity_points);
	 }		
			
	$data= array("status"=>"success");
	return $data;
}

	public function remove_review($id)
	{
		$sql="DELETE FROM event_reviews WHERE id='$id'";
		$resu=$this->db->query($sql);
		//$res = "Removed";
		//return $res;
	}


}
?>
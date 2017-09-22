<?php

Class Bookingmodel extends CI_Model
{

   public function __construct()
   {
      parent::__construct();
   }
  
//--------------------------------Bookingmodel Query-------------------------------------

function view_plan_details($id)
{
	  $sql="SELECT * FROM booking_plan WHERE event_id='$id' ORDER BY id DESC";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
}

function add_events_details($eventid,$planname,$seats,$amount,$user_id)
{ 

  // $check_eve="SELECT * FROM booking_plan WHERE event_id='$event_name' AND plan_name='$category'";
  // $result=$this->db->query($check_eve);
  // if($result->num_rows()==0)
  // {	
    $query="INSERT INTO booking_plan(event_id,plan_name,seat_available,seat_rate,created_by,created_at) VALUES ('$eventid','$planname','$seats','$amount','$user_id',NOW())";	
     $resultset=$this->db->query($query);
     $data= array("status"=>"success");
     return $data;
   // }else{
   //    $data= array("status"=>"Already Exist");
   //     return $data;
   //        }

}

function edit_events_plans($id)
{
	 $sql="SELECT * FROM booking_plan WHERE id='$id' ";
	 $resu=$this->db->query($sql);
	 $res=$resu->result();
	 return $res;
}



function update_events_details($eventid,$planid,$planname,$seats,$amount,$user_id)
{
   $sql="UPDATE booking_plan SET event_id='$eventid',plan_name='$planname',seat_available='$seats',seat_rate='$amount',updated_by='$user_id',updated_at=NOW() WHERE  id='$planid'";
   $resultset1=$this->db->query($sql);
   $data= array("status"=>"success");
   return $data;
}



}
?>
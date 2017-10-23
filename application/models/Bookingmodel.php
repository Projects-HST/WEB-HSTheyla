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
	  $sql="SELECT b.*,e.event_name FROM booking_plan AS b,events AS e WHERE b.event_id='$id' AND b.event_id=e.id ORDER BY b.id DESC";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
}

function add_events_details($eventid,$planname,$amount,$user_id)
{ 

  $check_eve="SELECT * FROM booking_plan WHERE event_id='$eventid' AND plan_name='$planname'";
  $result=$this->db->query($check_eve);
  if($result->num_rows()==0)
   {	
    $query="INSERT INTO booking_plan(event_id,plan_name,seat_rate,created_by,created_at) VALUES ('$eventid','$planname','$amount','$user_id',NOW())";	
     $resultset=$this->db->query($query);
    
    $update="UPDATE events SET booking_status='Y',updated_by='$user_id',updated_at=NOW() WHERE id='$eventid' ";
     $update1=$this->db->query($update);
     
     $data= array("status"=>"success");
     return $data;
    }else{
       $data= array("status"=>"AE");
       return $data;
        }

}

function edit_events_plans($id)
{
	 $sql="SELECT * FROM booking_plan WHERE id='$id' ";
	 $resu=$this->db->query($sql);
	 $res=$resu->result();
	 return $res;
}



function update_events_details($eventid,$planid,$planname,$amount,$user_id)
{
   $sql="UPDATE booking_plan SET event_id='$eventid',plan_name='$planname',seat_rate='$amount',updated_by='$user_id',updated_at=NOW() WHERE  id='$planid'";
   $resultset1=$this->db->query($sql);
   $data= array("status"=>"success");
   return $data;
}
 

function view_plan_time_details($plaid,$eveid)
{
  $tim="SELECT bt.*,e.event_name,e.start_date,e.end_date,b.plan_name,b.seat_rate FROM booking_plan_timing AS bt,events AS e,booking_plan AS b WHERE bt.plan_id ='$plaid' AND bt.event_id='$eveid' AND bt.plan_id=b.id AND bt.event_id=e.id  ORDER BY bt.id DESC";
  $tim12=$this->db->query($tim);
  $tim123=$tim12->result();
  return $tim123;
} 

function view_events_dates($eveid)
{
   $date="SELECT event_name,start_date,end_date FROM events  WHERE id='$eveid'";
  $date1=$this->db->query($date);
  $date2=$date1->result();
  return $date2;
}

function add_shows_times_details($plan_id,$eventid,$showtime,$show_date,$seats,$user_id)
{
  $check_time="SELECT * FROM booking_plan_timing WHERE event_id='$eventid' AND plan_id='$plan_id' AND show_time='$showtime' AND show_date='$show_date'";
  $result=$this->db->query($check_time);
  if($result->num_rows()==0)
   {  
    $timinsert="INSERT INTO booking_plan_timing(event_id,plan_id,show_date,show_time,seat_available,created_by,created_at) VALUES ('$eventid','$plan_id','$show_date','$showtime','$seats','$user_id',NOW())";
     $timinsert1=$this->db->query($timinsert);
     $data= array("status"=>"success");
     return $data;
    }else{
       $data= array("status"=>"AE");
       return $data;
        }
}

function edit_plans_time($id)
{
  $edittime="SELECT bt.*,e.event_name,e.start_date,e.end_date FROM booking_plan_timing AS bt,events AS e WHERE bt.id='$id' AND bt.event_id=e.id ";
  $tim=$this->db->query($edittime);
  $tim1=$tim->result();
  return $tim1;
}

function update_shows_times_details($time_id,$plan_id,$eventid,$show_date,$showtime,$seats,$user_id)
{
  $updatetime="UPDATE booking_plan_timing SET show_date='$show_date',show_time='$showtime',seat_available='$seats',updated_by='$user_id',updated_at=NOW() WHERE id='$time_id' AND event_id='$eventid' AND plan_id='$plan_id'";
  $updatetime1=$this->db->query($updatetime);
  $data= array("status"=>"success");
  return $data;

}

function delete_plan_details($plaid)
{
  $plandel="DELETE FROM booking_plan WHERE id='$plaid' ";
  $plandel1=$this->db->query($plandel);

  $timedel="DELETE FROM booking_plan_timing WHERE plan_id='$plaid'";
  $timedel1=$this->db->query($timedel);

  $data= array("status"=>"success");
  return $data;
}

}
?>
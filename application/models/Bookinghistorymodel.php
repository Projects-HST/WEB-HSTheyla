<?php

Class Bookinghistorymodel extends CI_Model
{

   public function __construct()
   {
      parent::__construct();
   }


//--------------------------------Bookingmodel Query-------------------------------------

function view_booking_history_details()
{
   //$sql="SELECT h.*,p.plan_name,e.event_name FROM booking_history AS h,booking_plan AS p,events AS e WHERE h.plan_id=p.id AND h.event_id=p.event_id AND h.event_id=e.id ORDER BY h.id DESC";

   $sql="SELECT h.*,p.plan_name,e.event_name,bt.show_date,bt.show_time,bt.seat_available FROM booking_history AS h,booking_plan AS p,events AS e,booking_plan_timing AS bt WHERE h.plan_id=p.id AND h.event_id=p.event_id AND h.event_id=e.id AND h.booking_time=bt.id ORDER BY h.id DESC";
  $resu=$this->db->query($sql);
  $res=$resu->result();
  return $res;
}

function view_attendees_details($order_id)
{
	$query="SELECT * FROM booking_event_attendees WHERE order_id='$order_id'";
	$aresu=$this->db->query($query);
    $ares=$aresu->result();
    return $ares;
}

function view_booking_process_details()
{
  $sql="SELECT bp.*,p.plan_name,e.event_name,bt.show_date,bt.show_time,bt.seat_available FROM booking_process AS bp,booking_plan AS p,events AS e,booking_plan_timing AS bt WHERE bp.plan_id=p.id AND bp.event_id=p.event_id AND bp.event_id=e.id AND bp.booking_time=bt.id ORDER BY bp.id DESC";
  $resu=$this->db->query($sql);
  $res=$resu->result();
  return $res;	
}

function view_booking_status_details()
{
  $sql="SELECT * FROM booking_status ORDER BY id DESC";
  $resu=$this->db->query($sql);
  $res=$resu->result();
  return $res;
}

}
?>
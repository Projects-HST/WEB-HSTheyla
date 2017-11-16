<?php
Class Organizerbookingmodel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function get_all_booking_details($user_id)
	{
     // $view="SELECT e.id,e.event_name,e.created_by,bh.*,bp.* FROM events AS e,booking_history AS bh,booking_plan AS bp WHERE e.created_by='$user_id' AND bh.event_id=e.id AND e.event_status='Y' AND bh.plan_id=bp.id ORDER BY bh.id DESC";
     // $resu=$this->db->query($view);
     // $res=$resu->result();
     // return $res;

    $sql="SELECT h.*,p.plan_name,e.event_name,bt.show_date,bt.show_time,bt.seat_available FROM booking_history AS h,booking_plan AS p,events AS e,booking_plan_timing AS bt WHERE e.created_by='$user_id' AND h.plan_id=p.id AND h.event_id=p.event_id AND h.event_id=e.id AND h.plan_time_id=bt.id ORDER BY h.id DESC";
  $resu=$this->db->query($sql);
  $res=$resu->result();
  return $res;

	}

	//-----------------------------Reviews---------------------------------------
  
   function view_all_reviews($id)
   {
     $sql="SELECT r.*,p.photo,e.event_name FROM event_reviews AS r LEFT JOIN event_review_photos AS p ON r.id = p.review_id LEFT JOIN events AS e On r.event_id=e.id WHERE  r.event_id='$id' ORDER BY r.id DESC";
    $resu=$this->db->query($sql);
    $res=$resu->result();
    return $res;
   }

   //-----------------------------Followers---------------------------------------
  
   function view_followers_details($user_id)
   {
    $vfollowers="SELECT f.*,ud.name,um.mobile_no,um.email_id FROM user_followers AS f,user_details AS ud,user_master AS um WHERE ud.user_id IN(f.follower_id) AND f.user_id='$user_id' AND ud.user_id=um.id";
    	$vfollowers1=$this->db->query($vfollowers);
        $folres=$vfollowers1->result();
        return $folres;
   }


}
?>
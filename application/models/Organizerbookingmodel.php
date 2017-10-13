<?php
Class Organizerbookingmodel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function get_all_booking_details($user_id)
	{
     $view="SELECT e.id,e.event_name,e.created_by,bh.*,bp.* FROM events AS e,booking_history AS bh,booking_plan AS bp WHERE e.created_by='$user_id' AND bh.event_id=e.id AND e.event_status='Y' AND bh.plan_id=bp.id ORDER BY bh.id DESC";
     $resu=$this->db->query($view);
     $res=$resu->result();
     return $res;

	}
  

}
?>
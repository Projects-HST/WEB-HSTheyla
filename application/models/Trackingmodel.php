<?php
 Class Trackingmodel extends CI_Model
 {

   public function __construct()
   {
      parent::__construct();
   }


    function get_all_organiser_event($id)
    {
       $u_id=base64_decode($id)/98765;
	   $sql="SELECT cm.city_name,ev.* FROM events AS ev LEFT JOIN user_master AS um ON um.id=ev.created_by LEFT JOIN city_master AS cm ON cm.id=ev.event_city WHERE um.user_role=4 AND  ev.created_by='$u_id' ORDER BY ev.id DESC";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
    }


    function get_count_organiser_event(){
	   $sql="SELECT um.id,um.mobile_no,um.email_id,um.user_name,COUNT(ev.created_by) AS posted_event,COUNT(CASE WHEN ev.event_status = 'Y' THEN 1 END) AS approved_event,COUNT(CASE WHEN ev.event_status = 'N' THEN 1 END) AS pending_event FROM  events AS ev LEFT JOIN user_master AS um ON um.id=ev.created_by WHERE um.user_role=2 GROUP BY ev.created_by";
  	  $resu=$this->db->query($sql);
  	  $res=$resu->result();
  	  return $res;
    }

    function admin_event_tracking(){
       $sql="SELECT um.id,um.mobile_no,um.email_id,um.user_name,COUNT(ev.created_by) AS posted_event,COUNT(CASE WHEN ev.event_status = 'Y' THEN 1 END) AS approved_event,COUNT(CASE WHEN ev.event_status = 'N' THEN 1 END) AS pending_event FROM  events AS ev LEFT JOIN user_master AS um ON um.id=ev.created_by WHERE um.user_role=4 GROUP BY ev.created_by ORDER BY DATE_FORMAT(ev.created_at, '%Y-%m-%d') DESC";
       $resu=$this->db->query($sql);
       $res=$resu->result();
       return $res;
    }

    function admin_track_by_date(){
       $sql="SELECT ev.created_by,ev.created_at,COUNT(*) AS event_count,um.id,um.mobile_no,um.email_id,um.user_name FROM events AS ev
LEFT JOIN user_master AS um ON um.id=ev.created_by WHERE um.user_role=4 GROUP BY DATE_FORMAT(ev.created_at, '%Y-%m-%d'),ev.created_by  ORDER BY DATE_FORMAT(ev.created_at, '%Y-%m-%d') DESC";
       $resu=$this->db->query($sql);
       $res=$resu->result();
       return $res;
    }

    function organiser_track_date(){
       $sql="SELECT ev.created_by,ev.created_at,COUNT(*) AS event_count,um.id,um.mobile_no,um.email_id,um.user_name FROM events AS ev
LEFT JOIN user_master AS um ON um.id=ev.created_by WHERE um.user_role=2 GROUP BY DATE_FORMAT(ev.created_at, '%Y-%m-%d'),ev.created_by  ORDER BY DATE_FORMAT(ev.created_at, '%Y-%m-%d') DESC";
       $resu=$this->db->query($sql);
       $res=$resu->result();
       return $res;
    }

    function get_all_event_by_date_id($id,$date_id)
    {
     $u_id=base64_decode($id)/98765;
     $sql="SELECT cm.city_name,ev.* FROM events AS ev LEFT JOIN user_master AS um ON um.id=ev.created_by LEFT JOIN city_master AS cm ON cm.id=ev.event_city WHERE  ev.created_by='$u_id' AND DATE_FORMAT(ev.created_at, '%Y-%m-%d')='$date_id' ORDER BY ev.id DESC";
    $resu=$this->db->query($sql);
    $res=$resu->result();
    return $res;
    }


    function refund_request(){
      $sql="SELECT um.id,rr.id as refund_id,rr.order_id,um.email_id,um.mobile_no,um.user_name,rr.status,rr.created_at from refund_request as rr
      left join user_master as um on um.id=rr.user_id order by rr.id DESC";
      $resu=$this->db->query($sql);
      return $resu->result();
    }

    function get_refund_request_id($ref_id){
      $id=base64_decode($ref_id)/98765;
     $sql="SELECT um.id,rr.id as refund_id,rr.order_id,um.email_id,um.mobile_no,um.user_name,rr.status,rr.created_at from refund_request as rr
    left join user_master as um on um.id=rr.user_id Where rr.id='$id'";
      $resu=$this->db->query($sql);
      return $resu->result();
    }

    function update_refund_status($refund_id,$req_status){
      $id=base64_decode($refund_id)/98765;
      $sql="UPDATE refund_request SET status='$req_status',updated_at=NOW() WHERE id='$id'";
      $result=$this->db->query($sql);
      if($result){
         echo "success";
      }else{
         echo "failed";
      }
    }


}?>

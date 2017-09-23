<?php

Class Advertisementmodel extends CI_Model
{ 

   public function __construct()
   {
      parent::__construct();
   }
  
//--------------------------------Bookingmodel Query-------------------------------------

function view_advertisement_plan_details()
{
	  $sql="SELECT * FROM advertisement_plan ORDER BY id DESC";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
}

function add_advertisement_plan_details($user_id,$planname,$planrate)
{
	$check_plan="SELECT * FROM advertisement_plan WHERE plan_name='$planname' AND plan_rate='$planrate'";
    $result=$this->db->query($check_plan);
    if($result->num_rows()==0)
    {	
        $query="INSERT INTO advertisement_plan(plan_name,plan_rate,created_by,created_at) VALUES ('$planname','$planrate','$user_id',NOW()) ";	
         $resultset=$this->db->query($query);
	     $data= array("status"=>"success");
	     return $data;
    }else{
       $data= array("status"=>"Already Exist");
       return $data;
       }
}

function edit_advertisement_plan_details($id)
{
	  $editsql="SELECT * FROM advertisement_plan WHERE id='$id'";
	  $resu1=$this->db->query($editsql);
	  $res1=$resu1->result();
	  return $res1;
}

function update_advertisement_plan_details($planid,$planname,$planrate,$user_id)
{
	$update="UPDATE advertisement_plan SET plan_name='$planname',plan_rate='$planrate',updated_by='$user_id',updated_at=NOW() WHERE id='$planid'";
	$updateres=$this->db->query($update);
	$data= array("status"=>"success");
    return $data;
}

function delete_advertisement_plan_details($id)
{
	$del="DELETE FROM advertisement_plan WHERE id='$id'";
	$delres=$this->db->query($del);
	$data= array("status"=>"success");
    return $data;
}
function getall_events_details()
{
  $sql="SELECT ev.*,ci.city_name,ca.category_name FROM city_master AS ci,category_master AS ca,events AS ev WHERE ev.category_id=ca.id AND ev.event_city=ci.id ORDER BY ev.id DESC";
  	$resu=$this->db->query($sql);
  	$res=$resu->result();
  	return $res;
}

function getall_adv_history_details()
{
  $adv="SELECT ah.*,ca.category_name,ev.event_name FROM adv_event_history AS ah,advertisement_plan AS ap,category_master AS ca,events AS ev WHERE ah.event_id=ev.id AND ah.category_id=ca.id AND ah.adv_plan_id=ap.id";
  $adv1=$this->db->query($adv);
  $adv2=$adv1->result();
  return $adv2; 
}

function getall_adv_plans()
{
	$psql="SELECT * FROM advertisement_plan";
  	$presu=$this->db->query($psql);
  	$pres=$presu->result();
  	return $pres;
}


}?>

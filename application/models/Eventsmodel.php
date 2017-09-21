<?php

Class Eventsmodel extends CI_Model
{

public function __construct()
 {
      parent::__construct();

 }
  
//--------------------------------Eventsmodel Query-------------------------------------
    
    function getall_events_details()
    {
      $sql="SELECT ev.*,ci.city_name,ca.category_name FROM city_master AS ci,category_master AS ca,events AS ev WHERE ev.category_id=ca.id AND ev.event_city=ci.id  ORDER BY ev.category_id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }

    function getall_country_list()
    {
      $sql="SELECT id,country_name FROM country_master ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }
    
    function getall_category_list()
    {
      $sql="SELECT id,category_name FROM category_master ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }

    function insert_events_details($event_name,$category,$country,$city,$venue,$address,$description,$eventcost,$start_date,$end_date,$start_time,$end_time,$txtLatitude,$txtLongitude,$pcontact_cell,$scontact_cell,$contact_person,$email,$event_banner,$colour_scheme,$event_status,$eadv_status,$booking_sts,$hotspot_sts,$user_id,$user_role)
    {
          $check_eve="SELECT * FROM events WHERE event_name='$event_name' AND category_id='$category'";
          $result=$this->db->query($check_eve);
          if($result->num_rows()==0)
          {
            $query="INSERT INTO events(category_id,event_name,event_venue,event_address,description,start_date,end_date,start_time, end_time,event_banner,event_latitude,event_longitude,event_country,event_city,primary_contact_no, secondary_contact_no,contact_person,contact_email,event_type,adv_status,booking_status,hotspot_status, event_colour_scheme,event_status,created_by,created_at) VALUES('$category','$event_name','$venue','$address','$description','$start_date','$end_date','$start_time','$end_time','$event_banner','$txtLatitude','$txtLongitude','$country','$city','$pcontact_cell','$scontact_cell','$contact_person','$email','$eventcost','$eadv_status','N','$hotspot_sts','$colour_scheme','$event_status','$user_id',NOW())";
           $resultset=$this->db->query($query);
  		     $data= array("status"=>"success");
  		     return $data;
          }else{
              $data= array("status"=>"Already Exist");
               return $data;
            }

    }

    
    function getcityname($country_id)
    {
        $query="SELECT id,city_name FROM city_master WHERE country_id='$country_id'";
        $resultset=$this->db->query($query);
        $row=$resultset->result();
        return $row;
    }
    
    function edit_events_details($id)
    {
        $query="SELECT * FROM events WHERE id='$id'";
        $resultset=$this->db->query($query);
        $row=$resultset->result();
        return $row;
    }

}
?>

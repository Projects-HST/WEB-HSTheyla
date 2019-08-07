<?php
Class Organizermodel extends CI_Model
{

	public function __construct()
	 {
		  parent::__construct();
	 }


    function get_country()
    {
      $sql="SELECT id,country_name FROM country_master WHERE event_status = 'Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }

    function get_category()
    {
      $sql="SELECT id,category_name FROM category_master WHERE status='Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }

    function get_city_list()
    {
      $sql="SELECT id,city_name FROM city_master WHERE event_status='Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }

    function get_city($country_id)
    {
        $query="SELECT id,city_name FROM city_master WHERE country_id='$country_id' AND event_status='Y'";
        $resultset=$this->db->query($query);
        $row=$resultset->result();
        return $row;
    }

    function events_details($id)
    {

       $query="SELECT e.*,ci.city_name FROM events AS e, city_master AS ci WHERE e.id='$id' AND e.event_city=ci.id";
        $resultset=$this->db->query($query);
        $row=$resultset->result();
        return $row;
    }


//--------------------------------Create Events Organizer-------------------------------------
	function create_events($event_name,$category,$country,$city,$venue,$address,$description,$eventcost,$start_date,$end_date,$start_time,$end_time,$txtLatitude,$txtLongitude,$pcontact_cell,$scontact_cell,$contact_person,$sec_contact_person,$email,$event_banner,$colour_scheme,$eadv_status,$hotspot_sts,$user_id,$user_role)
    {
		$check_eve = "SELECT * FROM events WHERE event_name='$event_name' AND category_id='$category'";
        $result = $this->db->query($check_eve);
        	if($result->num_rows()==0)
			{
				$query="INSERT INTO events(category_id,event_name,event_venue,event_address,description,start_date,end_date,start_time, end_time,event_banner,event_latitude,event_longitude,event_country,event_city,primary_contact_no, secondary_contact_no,contact_person,sec_contact_person,contact_email,event_type,adv_status,booking_status,hotspot_status, event_colour_scheme,event_status,created_by,created_at) VALUES('$category','$event_name','$venue','$address','$description','$start_date','$end_date','$start_time','$end_time','$event_banner','$txtLatitude','$txtLongitude','$country','$city','$pcontact_cell','$scontact_cell','$contact_person','$sec_contact_person','$email','$eventcost','$eadv_status','N','$hotspot_sts','$colour_scheme','N','$user_id',NOW())";
           		$resultset = $this->db->query($query);
  		     	$data = array("status"=>"success");
  		     	return $data;
          	}else{
              $data = array("status"=>"Already Exist");
               return $data;
            }
    }
//--------------------------------End Create Events Organizer-------------------------------------

//--------------------------------List Events Organizer-------------------------------------
	function list_events($user_id)
    {
        //$user_id =1;
      	$sql = "SELECT ev.*,ci.city_name,ca.category_name FROM city_master AS ci,category_master AS ca,events AS ev WHERE ev.created_by ='$user_id' AND ev.category_id = ca.id AND ev.event_city = ci.id  ORDER BY ev.category_id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
//--------------------------------End List Events Organizer-------------------------------------

//--------------------------------Update Events Organizer-------------------------------------
	function update_events_details($eventid,$event_name,$category,$country,$city,$venue,$address,$description,$eventcost,$start_date,$end_date,$start_time,$end_time,$txtLatitude,$txtLongitude,$pcontact_cell,$scontact_cell,$contact_person,$sec_contact_person,$email,$event_banner,$colour_scheme,$event_status,$eadv_status,$booking_sts,$hotspot_sts,$user_id,$user_role)
    {
		 $sql="UPDATE events SET category_id='$category',event_name='$event_name',event_venue='$venue',event_address='$address',description='$description',start_date='$start_date',end_date='$end_date',start_time='$start_time',end_time='$end_time',event_banner='$event_banner',event_latitude='$txtLatitude',event_longitude='$txtLongitude',event_country='$country',event_city='$city',primary_contact_no='$pcontact_cell',secondary_contact_no='$scontact_cell',contact_person='$contact_person',sec_contact_person='$sec_contact_person',contact_email='$email',event_type='$eventcost',adv_status='$eadv_status',booking_status='$booking_sts',hotspot_status='$hotspot_sts',event_colour_scheme='$colour_scheme',event_status='N',updated_by='$user_id',updated_at=NOW() WHERE id='$eventid'";
      $eresultset=$this->db->query($sql);
        $data= array("status"=>"success");
        return $data;

    }
//--------------------------------End Update Events Organizer-------------------------------------


//--------------------------------Delete Events Organizer-------------------------------------
	function delete_events($categoryname,$categorypic1,$status,$user_id,$user_role)
    {


    }
//--------------------------------End Delete Events Organizer-------------------------------------



}
?>

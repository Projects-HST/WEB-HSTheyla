<?php

Class Eventslistmodel extends CI_Model
{
	public function __construct()
	 {
		  parent::__construct();
	 }
  
  	function getall_country_list()
    {
      $sql="SELECT id,country_name,event_status FROM country_master WHERE event_status='Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }
	
    function getall_city_list()
    {
      $sql="SELECT id,city_name FROM city_master WHERE event_status='Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }
	   
    function getall_category_list()
    {
      $sql="SELECT id,category_name FROM category_master  WHERE status='Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }
	
    function getcityname($country_id)
    {
        $query="SELECT id,city_name FROM city_master WHERE country_id='$country_id' AND event_status='Y'";
        $resultset=$this->db->query($query);
        $row=$resultset->result();
        return $row;
    }
  
    function getall_events_details()
    {
		$current_date = date("Y-m-d");
      	$sql="SELECT ev.*,cy.country_name,ci.city_name,ca.category_name FROM country_master AS cy,city_master AS ci,category_master AS ca,events AS ev WHERE ev.category_id=ca.id AND ev.event_country=cy.id AND ev.event_city=ci.id AND ev.end_date>= '$current_date' AND ev.event_status='Y' ORDER BY ev.id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function getall_events()
    {
		$current_date = date("Y-m-d");
      	$sql="SELECT ev.*,cy.country_name,ci.city_name,ca.category_name FROM country_master AS cy,city_master AS ci,category_master AS ca,events AS ev WHERE ev.category_id=ca.id AND ev.event_country=cy.id AND ev.event_city=ci.id AND ev.end_date>= '$current_date' AND ev.event_status='Y' ORDER BY ev.id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function getsearch_events()
    {
		$current_date = date("Y-m-d");
      	$sql="SELECT ev.*,cy.country_name,ci.city_name,ca.category_name FROM country_master AS cy,city_master AS ci,category_master AS ca,events AS ev WHERE ev.category_id=ca.id AND ev.event_country=cy.id AND ev.event_city=ci.id AND ev.end_date>= '$current_date' AND ev.event_status='Y' ORDER BY ev.id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
}
?>

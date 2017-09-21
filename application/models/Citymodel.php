<?php

Class Citymodel extends CI_Model
{

public function __construct()
 {
      parent::__construct();

 }
  
//--------------------------------City Query-------------------------------------
    
    function getall_country_list()
    {
        $sql="SELECT id,country_name,event_status FROM country_master WHERE event_status='Y' ORDER BY id ASC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }


	function getall_city_details()
	{
	  	$sql="SELECT ci.*,c.country_name,s.state_name FROM city_master AS ci,country_master AS c,state_master AS s WHERE ci.country_id=c.id AND ci.state_id=s.id ORDER BY ci.id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
	  }
	          
	function insert_city_details($countryid,$stateid,$cityname,$estatus,$user_id,$user_role)
	{

		$check_city="SELECT city_name,country_id,state_id FROM city_master WHERE city_name='$cityname' AND country_id='$countryid' AND state_id='$stateid'";
		$result=$this->db->query($check_city);
		if($result->num_rows()==0)
		 {
		    $query="INSERT INTO city_master(country_id,state_id,city_name,event_status,created_by,created_at) VALUES ('$countryid','$stateid','$cityname','$estatus','$user_id',NOW())";
		    $resultset=$this->db->query($query);
		    $data= array("status"=>"success");
		    return $data;
		  }else{
				$data= array("status"=>"Already Exist");
				return $data;
			  }
		 
	}

	function eidt_city_details($id)
	{
	    $sql="SELECT ci.*,c.country_name,c.id AS countryid,s.state_name FROM city_master AS ci,country_master AS c,state_master AS s WHERE ci.country_id=c.id AND ci.state_id=s.id AND ci.id='$id'   ";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
	}

	function update_city_details($countryid,$stateid,$cityname,$cityid,$estatus,$user_id,$user_role)
	{   
		$check_city="SELECT country_id,city_name,event_status,state_id FROM city_master WHERE country_id='$countryid' AND city_name='$cityname' AND event_status='$estatus' AND state_id='$stateid' ";
	    $result=$this->db->query($check_city);
		if($result->num_rows()==0)
		{
			$update="UPDATE city_master SET country_id='$countryid',state_id='$stateid',city_name='$cityname',event_status='$estatus',updated_by='$user_id',updated_at=NOW() WHERE id='$cityid'";
			$uresu=$this->db->query($update);
		  	//$ures=$uresu->result();
		  	$data= array("status"=>"success");
			return $data;
		 }else{
			$data= array("status"=>"Already Exist");
			return $data;
		 }
	}


	function get_state_name($country_id)
	{
	   $query="SELECT 	id,state_name FROM state_master WHERE country_id='$country_id'";
        $resultset=$this->db->query($query);
		$row=$resultset->result();
		return $row;
	}		




}
?>

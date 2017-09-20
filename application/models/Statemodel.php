<?php

Class Statemodel extends CI_Model
{

public function __construct()
 {
      parent::__construct();

 }
  
//--------------------------------State Query-------------------------------------
    
    function getall_country_list()
    {
        $sql="SELECT * FROM country_master ORDER BY id ASC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }


	function getall_state_details()
	{
	  	$sql="SELECT ci.*,c.country_name FROM state_master AS ci,country_master AS c WHERE ci.country_id=c.id ORDER BY ci.id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
	  }
	          
	function insert_state_details($countryid,$statename,$eventsts,$user_id,$user_role)
	{

		$check_state="SELECT state_name,country_id FROM state_master WHERE state_name='$statename' AND country_id='$countryid'";
		$result=$this->db->query($check_state);
		if($result->num_rows()==0)
		 {
		    $query="INSERT INTO state_master(country_id,state_name,event_status,created_by,created_at) VALUES ('$countryid','$statename','$eventsts','$user_id',NOW())";
		    $resultset=$this->db->query($query);
		    $data= array("status"=>"success");
		    return $data;
		  }else{
				$data= array("status"=>"Already Exist");
				return $data;
			  }
		 
	}

	function eidt_state_details($id)
	{
	 	$sql="SELECT ci.*,c.country_name,c.id AS countryid FROM state_master AS ci,country_master AS c WHERE ci.country_id=c.id AND ci.id='$id' ";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
	}

	function update_state_details($countryid,$statename,$stateid,$estatus,$user_id,$user_role)
	{   
		$check_state="SELECT country_id,state_name,event_status FROM state_master WHERE country_id='$countryid' AND state_name='$statename' AND event_status='$estatus'";
	    $result=$this->db->query($check_state);
		 if($result->num_rows()==0)
		 {
			$update="UPDATE state_master SET country_id='$countryid',state_name='$statename',event_status='$estatus',updated_by='$user_id',updated_at=NOW() WHERE id='$stateid'";
			$uresu=$this->db->query($update);
		  	//$ures=$uresu->result();
		  	$data= array("status"=>"success");
			return $data;
		 }else{
			$data= array("status"=>"Already Exist");
			return $data;
		 }
	}		




}
?>

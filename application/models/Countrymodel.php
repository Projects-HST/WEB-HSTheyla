<?php

Class Countrymodel extends CI_Model
{

public function __construct()
 {
      parent::__construct();

 }
  

//--------------------------------Country Query-------------------------------------

	function getall_details(){
	  	$sql="SELECT * FROM country_master ORDER BY id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
	  }
	          
	function insert_country_details($cname,$estatus,$user_id,$user_role)
	{

		$check_country="SELECT country_name FROM country_master WHERE country_name='$cname' ";
		$result=$this->db->query($check_country);
		if($result->num_rows()==0)
		 {
		    $query="INSERT INTO country_master(country_name,country_code,event_status,created_by,created_at) VALUES ('$cname','','$estatus','$user_id',NOW())";
		    $resultset=$this->db->query($query);
		    $data= array("status"=>"success");
		    return $data;
		  }else{
				$data= array("status"=>"Already Exist");
				return $data;
			  }
		 
	}

	function eidt_country_details($id)
	{
	 	$sql="SELECT * FROM country_master WHERE id='$id' ";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
	}

	function update_country_details($cnid,$cname,$estatus,$user_id,$user_role)
	{   
		// $check_country="SELECT country_name,event_status FROM country_master WHERE country_name='$cname' AND event_status='$estatus' ";
		// $result=$this->db->query($check_country);
		// if($result->num_rows()==0)
		// {
			$update="UPDATE country_master SET country_name='$cname',event_status='$estatus',updated_by='$user_id',updated_at=NOW() WHERE id='$cnid'";
			$uresu=$this->db->query($update);
		  	//$ures=$uresu->result();
		  	$data= array("status"=>"success");
			return $data;
		// }else{
		// 	$data= array("status"=>"Already Exist");
		// 	return $data;
		// }
	}

}
?>

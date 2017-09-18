<?php

Class Countrymastersmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  

  function getall_details(){
  	$sql="SELECT * FROM country_master";
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
	    $query="INSERT INTO country_master(country_name,country_code,event_status,created_by,created_at) VALUES ('$cname','','$estatus','$user_id','NOW()')";
	    $resultset=$this->db->query($query);
	    $data= array("status"=>"success");
	    return $data;
	  }else{
			$data= array("status"=>"Already Exist");
			return $data;
		  }
	 
 }



}
?>

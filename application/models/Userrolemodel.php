<?php

Class Userrolemodel extends CI_Model
{

public function __construct()
 {
      parent::__construct();

 }
  

//--------------------------------User Role Query-------------------------------------

	function getall_user_details(){
	  	$sql="SELECT * FROM  user_role_master ORDER BY id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
	  }
    
    function insert_users_details($user_id,$username,$ustatus)
    {   
    	$check_user="SELECT * FROM user_role_master WHERE user_role_name='$username'";
		$result=$this->db->query($check_user);
		if($result->num_rows()==0)
		 {
	    	$add="INSERT INTO user_role_master(user_role_name,status,created_by,created_at) VALUES ('$username','$ustatus','$user_id',NOW())";
	    	$adduser=$this->db->query($add);
	    	 $data= array("status"=>"success");
		    return $data;
	     }else{
	     	$data= array("status"=>"Already Exist");
			return $data;
	     }	

    }

    function edit_users_details($id)
    {
    	$sql="SELECT * FROM  user_role_master WHERE id='$id'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }

    function update_users_details($user_id,$userid,$username,$ustatus)
    {   
		$check_user="SELECT * FROM user_role_master WHERE user_role_name='$username' AND status='$ustatus'";
		$result=$this->db->query($check_user);
		if($result->num_rows()==0)
		 {
    	$update="UPDATE user_role_master SET user_role_name='$username',status='$ustatus',updated_by='$user_id',updated_at=NOW() WHERE id='$userid'";
    	$auuser=$this->db->query($update);
	    $data= array("status"=>"success");
	    return $data;
	    }else{
	     	$data= array("status"=>"Already Exist");
			return $data;
	     }
    }

    function delete_users_details($id)
    {
    	$del="DELETE FROM user_role_master WHERE id='$id'";
    	$deluser=$this->db->query($del);
	    $data= array("status"=>"success");
	    return $data;
    }

    function getusernames($uname)
    {
     $query = "SELECT * FROM user_role_master WHERE user_role_name='".$uname."'";
	 $resultset = $this->db->query($query);
	 return count($resultset->result());
    }


}?>
<?php
Class Organizermodel extends CI_Model
{

	public function __construct()
	 {
		  parent::__construct();
	 }
  
//--------------------------------Create Events Organizer-------------------------------------
	function create_events($Category,$user_id,$user_role)
    {
        echo $Category;
		echo $user_id;
		echo $user_role;
	
    }
//--------------------------------End Create Events Organizer-------------------------------------

//--------------------------------Update Events Organizer-------------------------------------
	function update_events($categoryname,$categorypic1,$status,$user_id,$user_role)
    {
         $check_category = "SELECT * FROM category_master WHERE category_name='$categoryname' AND status='$status'";
         $result=$this->db->query($check_category);
         if($result->num_rows()==0)
         {
           $query="INSERT INTO category_master(category_name,category_image,status,created_by,created_at) VALUES ('$categoryname','$categorypic1','$status','$user_id',NOW())";
           $resultset=$this->db->query($query);
  		     $data= array("status"=>"success");
  		     return $data;
         }else{
              $data= array("status"=>"Already Exist");
              return $data;
            }

    }
//--------------------------------End Update Events Organizer-------------------------------------

//--------------------------------Delete Events Organizer-------------------------------------
	function delete_events($categoryname,$categorypic1,$status,$user_id,$user_role)
    {
         $check_category = "SELECT * FROM category_master WHERE category_name='$categoryname' AND status='$status'";
         $result=$this->db->query($check_category);
         if($result->num_rows()==0)
         {
           $query="INSERT INTO category_master(category_name,category_image,status,created_by,created_at) VALUES ('$categoryname','$categorypic1','$status','$user_id',NOW())";
           $resultset=$this->db->query($query);
  		     $data= array("status"=>"success");
  		     return $data;
         }else{
              $data= array("status"=>"Already Exist");
              return $data;
            }

    }
//--------------------------------End Delete Events Organizer-------------------------------------

//--------------------------------List Events Organizer-------------------------------------
	function list_events($categoryname,$categorypic1,$status,$user_id,$user_role)
    {
         $check_category = "SELECT * FROM category_master WHERE category_name='$categoryname' AND status='$status'";
         $result=$this->db->query($check_category);
         if($result->num_rows()==0)
         {
           $query="INSERT INTO category_master(category_name,category_image,status,created_by,created_at) VALUES ('$categoryname','$categorypic1','$status','$user_id',NOW())";
           $resultset=$this->db->query($query);
  		     $data= array("status"=>"success");
  		     return $data;
         }else{
              $data= array("status"=>"Already Exist");
              return $data;
            }

    }
//--------------------------------End List Events Organizer-------------------------------------

}
?>

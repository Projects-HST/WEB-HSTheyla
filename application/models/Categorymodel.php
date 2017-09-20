<?php

Class Categorymodel extends CI_Model
{

public function __construct()
 {
      parent::__construct();

 }
  
//--------------------------------City Query-------------------------------------
    
    function getall_category_details()
    {
      $sql="SELECT * FROM category_master ORDER BY id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }

    function insert_category($categoryname,$categorypic1,$status,$user_id,$user_role)
    {
         $check_category="SELECT * FROM category_master WHERE category_name='$categoryname' AND status='$status'";
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

    function edit_category($id,$user_id,$user_role)
    {
       $sql="SELECT * FROM category_master WHERE id='$id'";
       $resu=$this->db->query($sql);
       $res=$resu->result();
       return $res;
    }

    function update_category_details($category_id,$categoryname,$categorypic1,$status,$user_id,$user_role)
    {

       $check_category="SELECT * FROM category_master WHERE category_name='$categoryname' AND status='$status' AND category_image='$categorypic1' ";
       $result=$this->db->query($check_category);
       if($result->num_rows()==0)
       {
         $uquery="UPDATE category_master SET category_name='$categoryname',category_image='$categorypic1',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$category_id'";
         $uresultset=$this->db->query($uquery);
         $data= array("status"=>"success");
         return $data;
        }else{
            $data= array("status"=>"Already Exist");
            return $data;
           }
    }
	
	          
	



}
?>

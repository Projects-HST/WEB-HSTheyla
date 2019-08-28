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
      $sql="SELECT * FROM category_master ORDER BY order_by ASC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }

    function insert_category($categoryname,$categorypic1,$disp_order,$status,$user_id,$user_role)
    {
         $check_category="SELECT * FROM category_master WHERE category_name='$categoryname'";
         $result=$this->db->query($check_category);
         if($result->num_rows()==0)
         {
           $query="INSERT INTO category_master(category_name,category_image,order_by,status,created_by,created_at) VALUES ('$categoryname','$categorypic1','$disp_order','$status','$user_id',NOW())";
           $resultset=$this->db->query($query);
           $lastInsertId = $this->db->insert_id();

        $uQuery = "update category_master set order_by=order_by+1 where order_by >='$disp_order' and id!='$lastInsertId'";
        $uQuery1=$this->db->query($uQuery);

  		     $data= array("status"=>"success");
  		     return $data;
         }else{
              $data= array("status"=>"Category already exists!");
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

    function update_category_details($category_id,$categorypic1,$disp_order,$old_disp_order,$status,$user_id,$user_role)
    {
      $uquery="UPDATE category_master SET category_image='$categorypic1',order_by='$disp_order',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$category_id'";
      $uresultset=$this->db->query($uquery);

      if($old_disp_order > $disp_order)
      {
        $uQuery = "update category_master set order_by=order_by+1 where order_by >= '$disp_order' and order_by <'$old_disp_order' and id!='$category_id'";
       $uQuery1=$this->db->query($uQuery);
      }else{
        $uQuery = "update category_master set order_by=order_by-1 where order_by >'$old_disp_order' and order_by<='$disp_order' and id!='$category_id' ";
        $uQuery1=$this->db->query($uQuery);
      }

      $data= array("status"=>"success");
      return $data;
    }

    function save_category_name($user_id,$categoryname,$ct_id){
      $check_category="SELECT * FROM category_master WHERE category_name='$categoryname'";
      $result=$this->db->query($check_category);
      if($result->num_rows()==0)
      {
        $query="UPDATE category_master SET category_name='$categoryname',created_by='$user_id',created_at=NOW() WHERE id='$ct_id'";
        $resultset=$this->db->query($query);
      if($resultset){
          echo "success";
      }else{
          echo "Something went wrong! Please try again later.";
      }
      }else{
          echo "Category already exists!";
         }
    }





}
?>

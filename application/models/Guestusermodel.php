<?php
Class Guestusermodel extends CI_Model
{ 

   public function __construct()
   {
      parent::__construct();
   }
  
//--------------------------------Guestusermodel Query-------------------------------------

    function getall_guestusers_list()
    {
	   $sql="SELECT gp.user_id,gp.category_id,gu.login_type,u.user_id,u.name,c.category_name FROM guest_user_preference AS gp,guest_user_master AS gu,user_details AS u,category_master AS c WHERE gp.user_id=u.user_id AND gu.login_type='4' AND gp.category_id=c.id GROUP BY u.user_id";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
    }

    function delete($users_id)
    {
      $gpdel="DELETE FROM guest_user_preference WHERE user_id='$users_id'";
      $gpdetails=$this->db->query($gpdel);
      $data= array("status"=>"success");
      return $data;
    }

    function view_all_users_details($users_id)
    {
     $sql1="SELECT gp.user_id,gp.category_id,u.user_id,u.name,c.category_name,um.mobile_no,um.email_id FROM guest_user_preference AS gp,user_details AS u,category_master AS c,user_master AS um WHERE gp.user_id='$users_id' AND gp.user_id=u.user_id AND gp.category_id=c.id AND um.id=gp.user_id AND um.id='$users_id' ";
    $resu1=$this->db->query($sql1);
    $res1=$resu1->result();
    return $res1;

    }

}
?>



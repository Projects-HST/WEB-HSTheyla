<?php
Class Emailtemplatemodel extends CI_Model
{

   public function __construct()
   {
      parent::__construct();
   }

//--------------------------------Emailtemplatemodel Query-------------------------------------

   function getall_email_template_details()
   {
   	$email="SELECT * FROM email_template ORDER BY id DESC";
   	$resu=$this->db->query($email);
    $res=$resu->result();
    return $res;
   }

   function add_templates_details($tempname,$tempdetails,$img,$user_id)
   {
   	 $check_tmp="SELECT * FROM email_template WHERE template_name='$tempname' AND template_content='$tempdetails'";
     $result=$this->db->query($check_tmp);
     if($result->num_rows()==0)
     {
	   	$insert="INSERT INTO email_template(template_name,template_content,notification_img,created_by,created_at)VALUES('$tempname','$tempdetails','$img','$user_id',NOW())";
	   	$resu1=$this->db->query($insert);
	   	$data = array("status"=>"success");
	   	return $data;
    	 }else{
    	 	$data= array("status"=>"AE");
            return $data;
    	 }
   }

   function delete_templates_details($id,$user_id)
   {
   	$del="DELETE FROM email_template WHERE id='$id' ";
   	$del1=$this->db->query($del);
	$data = array("status"=>"success");
	return $data;
   }

   function edit_email_template_details($id)
   {
   	$email="SELECT * FROM email_template WHERE id='$id'";
   	$resu=$this->db->query($email);
    $res=$resu->result();
    return $res;
   }

   function update_templates_details($id,$tempname,$tempdetails,$img,$user_id)
   {
   	$update="UPDATE email_template SET template_name='$tempname',template_content='$tempdetails',notification_img='$img',updated_by='$user_id',updated_at=NOW() WHERE id='$id'";
   	$resu1=$this->db->query($update);
    $data = array("status"=>"success");
	return $data;
   }

//-------------------------SEND----------------------------

   function get_city_name($country_id)
   {
   	  $query="SELECT id,city_name,event_status FROM city_master WHERE country_id='$country_id' AND event_status='Y'";
      $resultset=$this->db->query($query);
      $row=$resultset->result();
	  return $row;
   }

   function getall_city_list(){
      $query="SELECT id,city_name,event_status FROM city_master WHERE  event_status='Y'";
      $resultset=$this->db->query($query);
      $row=$resultset->result();
	  return $row;
   }


   function getall_users_details()
   {
   	//$sel="SELECT id,name,user_name,mobile_no,email_id FROM user_master WHERE status='Y'";
	$sel="SELECT ud.user_id,ud.name,ud.country_id,ud.city_id,um.id,um.email_id,um.mobile_no FROM user_details AS ud, user_master AS um WHERE um.id=ud.user_id and ud.newsletter_status='Y'";
   	$sel1=$this->db->query($sel);
    $sel2=$sel1->result();
    return $sel2;
   }

   function getall_search_users_details($cityid)
   {

		 $search="SELECT ud.user_id,ud.name,ud.country_id,ud.city_id,um.id,um.user_name,um.email_id,um.mobile_no,ci.city_name FROM user_details AS ud, user_master AS um,city_master AS ci WHERE um.id=ud.user_id AND  ud.city_id='$cityid'  AND ud.city_id=ci.id and um.status='Y'";
     $search1=$this->db->query($search);
     $search2=$search1->result();
		 return $search2;

   }

   function getall_email_template()
   {
   	$temp="SELECT * FROM email_template";
   	$resultset1=$this->db->query($temp);
    $row1=$resultset1->result();
	return $row1;
   }

}
?>

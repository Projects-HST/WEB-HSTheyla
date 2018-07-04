<?php

Class Usersmodel extends CI_Model
{

   public function __construct()
   {
      parent::__construct();
   }

//--------------------------------Bookingmodel Query-------------------------------------

    function getall_users_role_list()
    {
	  $sql="SELECT * FROM user_role_master WHERE status='Y' AND id='4'";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
    }

    function getall_users_details()
    {
       $query="SELECT erm.user_role_name,ud.*,um.user_name,um.mobile_no,um.email_id,um.password,um.user_role,um.status,ci.city_name,up.total_points
FROM user_details AS ud LEFT JOIN user_master AS um ON ud.user_id=um.id LEFT JOIN city_master AS ci ON ci.id=ud.city_id LEFT JOIN user_points_count AS up ON up.user_id=ud.user_id LEFT JOIN user_role_master AS erm ON um.user_role=erm.id WHERE um.user_role='4' ORDER BY ud.id  DESC";
	      $udresu=$this->db->query($query);
	       $udres=$udresu->result();
	        return $udres;
    }

    function view_normal_users()
    {
       $query="SELECT erm.user_role_name,ud.*,um.user_name,um.mobile_no,um.email_id,um.password,um.user_role,um.email_verify,um.created_at,um.mobile_verify,um.status,ci.city_name,up.total_points
FROM user_details AS ud LEFT JOIN user_master AS um ON ud.user_id=um.id LEFT JOIN city_master AS ci ON ci.id=ud.city_id LEFT JOIN user_points_count AS up ON up.user_id=ud.user_id LEFT JOIN user_role_master AS erm ON um.user_role=erm.id WHERE um.user_role='3' ORDER BY ud.id  DESC";
        $udresu=$this->db->query($query);
         $udres=$udresu->result();
          return $udres;
    }

    function getall_users_Followers_details()
    {
        $foler="SELECT u.name,ci.city_name,f.user_id,COUNT(f.follower_id) as followers FROM user_details AS u,user_followers AS f,city_master AS ci  WHERE u.user_id=f.user_id AND u.city_id=ci.id GROUP BY f.user_id";
        $fresu=$this->db->query($foler);
	    $fres=$fresu->result();
	    return $fres;
    }

    function getall_users_details1($id)
    {
    	$query="SELECT ud.*,um.user_name,um.mobile_no,um.email_id,um.password,um.user_role,um.status FROM user_details AS ud,user_master AS um WHERE um.id=ud.user_id AND ud.id='$id'";
	  $udresu=$this->db->query($query);
	  $udres=$udresu->result();
	  return $udres;
    }

    function getall_country_list()
    {
      $sql="SELECT id,country_name,event_status FROM country_master WHERE event_status='Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }

    function getall_state_list($country_id)
    {
      $sql="SELECT id,state_name,event_status FROM state_master WHERE event_status='Y' AND country_id='$country_id' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }

    function getall_city_list($state_id)
    {
      $sql="SELECT id,city_name FROM city_master WHERE event_status='Y' AND state_id='$state_id' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }

    function add_user_details($name,$username,$cell,$email,$dob,$gender,$address1,$occupation,$country,$statename,$city,$zip,$user_pic1,$status,$userrole,$user_id,$display_status)
    {
    $check_user="SELECT * FROM user_master WHERE user_name='$username'";
    $result=$this->db->query($check_user);
    if($result->num_rows()==0)
    {
      $check_user="SELECT * FROM user_master WHERE  mobile_no='$cell' OR email_id='$email'";
      $result=$this->db->query($check_user);
      if($result->num_rows()==0)
      {
        $uinsert="INSERT INTO user_master(user_name,mobile_no,email_id,user_role,status,created_by,created_at,email_verify,mobile_verify) VALUES ('$username','$cell','$email','4','$display_status','$user_id',NOW(),'Y','Y')";
    	  $uresu=$this->db->query($uinsert);
        $insert_id = $this->db->insert_id();
        $userdetails="INSERT INTO user_details(user_id,name,birthdate,gender,occupation,address_line1,country_id,state_id,city_id,zip,user_picture,newsletter_status) VALUES ('$insert_id','$name','$dob','$gender','$occupation','$address1','$country','$statename','$city','$zip','$user_pic1','$status')";
        $udetails=$this->db->query($userdetails);
        $data= array("status"=>"success");
  		  return $data;
      }else{
        $data= array("status"=>"ME");
        return $data;
      }
    }else{
       $data= array("status"=>"UA");
       return $data;
    }

    }

    function update_user_details($uid,$umid,$username,$name,$cell,$email,$dob,$gender,$address1,$occupation,$country,$statename,$city,$zip,$user_pic1,$status,$userrole,$user_id,$display_status)
    {
    	  $umupdate="UPDATE user_master SET user_name='$username',mobile_no='$cell',email_id='$email',user_role='$userrole',status='$display_status',updated_by='$user_id',updated_at=NOW() WHERE  id='$umid' ";
    	 $umdetails=$this->db->query($umupdate);
        $usupdate="UPDATE user_details SET name='$name',birthdate='$dob',gender='$gender',occupation='$occupation',address_line1='$address1',address_line2='$address2',address_line3='$address3',country_id='$country',state_id='$statename',city_id='$city',zip='$zip',user_picture='$user_pic1',newsletter_status='$status' WHERE id='$uid' AND user_id='$umid'";
        $usdetails=$this->db->query($usupdate);
        $data= array("status"=>"success");
  		  return $data;

    }

    function delete($id,$users_id)
    {
    	$umdel="DELETE FROM user_master WHERE id='$users_id'";
    	$umdetails=$this->db->query($umdel);

    	$usdel="DELETE FROM user_details WHERE id='$id'";
    	$usdetail=$this->db->query($usdel);

      $data= array("status"=>"success");
  		return $data;
    }

    function users_followers_details($usersid)
    {
    	$vfollowers="SELECT f.*,ud.name,um.mobile_no,um.email_id FROM user_followers AS f,user_details AS ud,user_master AS um WHERE ud.user_id IN(f.follower_id) AND f.user_id='$usersid' AND ud.user_id=um.id";
    	$vfollowers1=$this->db->query($vfollowers);
        $folres=$vfollowers1->result();
        return $folres;
    }

    function getemail($email)
    {
       $query = "SELECT * FROM user_master WHERE email_id='$email'";
       $res=$this->db->query($query);
       if($res->num_rows()==0){
         echo "true";
       }else{
         echo "false";
       }
    }

    function check_mobile_num($cell)
    {
      $query = "SELECT * FROM user_master WHERE mobile_no='$cell'";
      $res=$this->db->query($query);
      if($res->num_rows()==0){
        echo "true";
      }else{
        echo "false";
      }
    }

    function check_user_name($uname)
    {
      $check_username="SELECT * FROM user_master WHERE user_name='$uname'";
      $res=$this->db->query($check_username);
      if($res->num_rows()==0){
        echo "true";
      }else{
        echo "false";
      }
  }

    function check_user_name_exist($uname,$id){
      $check_username="SELECT * FROM user_master WHERE user_name='$uname' AND id!='$id'";
      $res=$this->db->query($check_username);
      if($res->num_rows()==0){
        echo "true";
      }else{
        echo "false";
      }
    }

    function getemail_exist($email,$id)
    {
       $query = "SELECT * FROM user_master WHERE email_id='$email' AND id!='$id'";
       $res=$this->db->query($query);
       if($res->num_rows()==0){
         echo "true";
       }else{
         echo "false";
       }
    }

    function check_mobile_num_exist($cell,$id)
    {
      $query = "SELECT * FROM user_master WHERE mobile_no='$cell' AND id!='$id'";
      $res=$this->db->query($query);
      if($res->num_rows()==0){
        echo "true";
      }else{
        echo "false";
      }
    }



}?>

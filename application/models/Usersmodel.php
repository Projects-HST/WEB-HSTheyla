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
	  $sql="SELECT * FROM user_role_master WHERE status='Y'";
	  $resu=$this->db->query($sql);
	  $res=$resu->result();
	  return $res;
    }

    function getall_users_details()
    {
       $query="SELECT ud.*,um.user_name,um.mobile_no,um.email_id,um.password,um.user_role,um.status,ci.city_name,up.total_points FROM user_details AS ud LEFT JOIN user_master AS um ON ud.user_id=um.id LEFT JOIN city_master AS ci ON ci.id=ud.city_id LEFT JOIN user_points_count AS up ON up.user_id=ud.user_id ORDER BY ud.id  DESC";
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

    function add_user_details($name,$username,$cell,$email,$pwd,$dob,$gender,$address1,$address2,$address3,$occupation,$country,$statename,$city,$zip,$user_pic1,$status,$userrole,$user_id,$display_status)
    {
    $pwd1=$pwd;
    $check_user="SELECT * FROM user_master WHERE user_name='$username'";
    $result=$this->db->query($check_user);
    if($result->num_rows()==0)
    {
      $check_user="SELECT * FROM user_master WHERE  mobile_no='$cell' OR email_id='$email'";
      $result=$this->db->query($check_user);
      if($result->num_rows()==0)
      {
        $uinsert="INSERT INTO user_master(user_name,mobile_no,email_id,password,user_role,status,created_by,created_at,email_verify,mobile_verify) VALUES ('$username','$cell','$email','$pwd1','$userrole','$display_status','$user_id',NOW(),'Y','Y')";
    	  $uresu=$this->db->query($uinsert);
        $insert_id = $this->db->insert_id();
        $userdetails="INSERT INTO user_details(user_id,name,birthdate,gender,occupation,address_line1,address_line2,address_line3,country_id,state_id,city_id,zip,user_picture,newsletter_status) VALUES ('$insert_id','$name','$dob','$gender','$occupation','$address1','$address2','$address3','$country','$statename','$city','$zip','$user_pic1','$status')";
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

    function update_user_details($uid,$umid,$username,$pwd,$name,$cell,$email,$pwd,$dob,$gender,$address1,$address2,$address3,$occupation,$country,$statename,$city,$zip,$user_pic1,$status,$userrole,$user_id,$display_status)
    {
      //$check_user="SELECT * FROM user_master WHERE user_name='$username' OR mobile_no='$cell' OR email_id='$email'";
      //$result=$this->db->query($check_user);
      //if($result->num_rows()==0)
      //{
    	 //$pwd1=md5($pwd);
    	 $umupdate="UPDATE user_master SET user_name='$username',mobile_no='$cell',email_id='$email',password='$pwd',user_role='$userrole',status='$display_status',updated_by='$user_id',updated_at=NOW() WHERE  id='$umid' ";
    	 $umdetails=$this->db->query($umupdate);
        $usupdate="UPDATE user_details SET name='$name',birthdate='$dob',gender='$gender',occupation='$occupation',address_line1='$address1',address_line2='$address2',address_line3='$address3',country_id='$country',state_id='$statename',city_id='$city',zip='$zip',user_picture='$user_pic1',newsletter_status='$status' WHERE id='$uid' AND user_id='$umid'";
        $usdetails=$this->db->query($usupdate);
        $data= array("status"=>"success");
  		  return $data;
      //}else{
       // $data= array("status"=>"Already Exist");
       // return $data;
      //}
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
       $query = "SELECT * FROM user_master WHERE email_id='".$email."'";
      $resultset = $this->db->query($query);
      return count($resultset->result());
    }

    function check_mobile_num($cell)
    {
      $query1 = "SELECT * FROM user_master WHERE mobile_no='".$cell."'";
      $resultset1 = $this->db->query($query1);
      return count($resultset1->result());
    }

    function check_user_name($uname)
    {
      $query1 = "SELECT * FROM user_master WHERE user_name='".$uname."'";
      $resultset1 = $this->db->query($query1);
      return count($resultset1->result());
    }

}?>

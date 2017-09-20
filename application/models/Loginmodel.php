<?php

Class Loginmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

 function login($username,$password)
  {
    $query = "SELECT * FROM user_master WHERE user_name='$username' OR mobile_no='$username' OR email_id='$username' ";
    $resultset=$this->db->query($query);
    if($resultset->num_rows()==1)
      {
          $pwdcheck="SELECT * FROM user_master WHERE password='$password' AND user_name='$username' OR mobile_no='$username' OR email_id='$username'";
          $res=$this->db->query($pwdcheck);
          if($res->num_rows()==1)
	        {
              foreach($res->result() as $rows)
               {
                 $quer="SELECT status FROM user_master WHERE id='$rows->id'";
                 $resultset=$this->db->query($quer);
                 $status=$rows->status;
                 switch($status)
                 {
                    case "Y":
                      $data = array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
                      return $data;
                      //break;
                     //print_r($data);exit;
                      break;
                    case "N":
   					$data= array("status"=>"Deactive","msg"=>"Your Account Is De-Activated");
   					return $data;
                      break;
                  }

                 $data =  array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
   	            $this->session->set_userdata($data);
   	            return $data;
               }
         }else{
            $data= array("status" => "notRegistered","msg" => "Password Wrong");
            return $data;
           }
      }else{
            $data= array("status" => "notRegistered","msg" => "invalid Username");
            return $data;
         }
   }


   function getuser($user_id){
         $query="SELECT * FROM user_master WHERE id='$user_id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
       }


  function getuserinfogoogle($email,$firstname,$lastname){
     $check_email="SELECT * FROM user_master WHERE email_id='$email'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
       $query="INSERT INTO user_master (email_id,last_login,user_role,email_verify,status,created_at) VALUES('$email',NOW(),'3','Y','Y',NOW())";
       $resultset=$this->db->query($query);
       $insert_id = $this->db->insert_id();
       $user_master_query="INSERT INTO user_details(user_id,name) VALUES('$insert_id','$firstname')";
       $result=$this->db->query($user_master_query);
       if($result){
         $quer="SELECT * FROM user_master WHERE id='$insert_id'";
         $resultset=$this->db->query($quer);
         foreach($resultset->result() as $rows){ }
         $status=$rows->status;
         switch($status)
         {
            case "Y":
              $data = array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
              $this->session->set_userdata($data);
              return $data;

              break;
            case "N":
                $data= array("status"=>"Deactive","msg"=>"Your Account Is De-Activated");
                 return $data;
              break;
          }

         $data =  array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
         $this->session->set_userdata($data);
         return $data;
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "failed");
         return $data;
       }
     }else{
       $quer="SELECT * FROM user_master WHERE email_id='$email'";
       $resultset=$this->db->query($quer);
       foreach($res->result() as $rows){}
       $status=$rows->status;
       $data= array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
       $this->session->set_userdata($data);
       return $data;
     }

   }


   function getuserinfo($user_id){
     $quer="SELECT us.*,ud.* FROM user_master AS us LEFT JOIN user_details AS ud ON us.id=ud.user_id WHERE us.id='$user_id'";
     $resultset=$this->db->query($quer);
     return $resultset->result();
   }


}

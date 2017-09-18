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
            $pwdcheck="SELECT * FROM user_master WHERE password='$password' AND user_name='$username' OR mobile_no='$username' OR email_id='$username'  ";
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
                         $data = array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"login_mode"=>$rows->login_mode,"user_role"=>$rows->user_role,"id"=>$rows->id);
                         return $data;
                         //break;
                        print_r($data);exit;
                         break;
                       case "N":
   						$data= array("status"=>"Deactive","msg"=>"Your Account Is De-Activated");
   						return $data;
                         break;
                     }

                    $data =  array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"login_mode"=>$rows->login_mode,"user_role"=>$rows->user_role,"id"=>$rows->id);
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

}


       
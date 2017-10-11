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

   function check_email($email){
     $check_email="SELECT * FROM user_master WHERE email_id='$email'";
     $res=$this->db->query($check_email);
     if($res->num_rows()>=1){
       echo "already";
     }else{
       echo "success";
     }
   }
   function check_mobile($mobile){
     $check_email="SELECT * FROM user_master WHERE mobile_no='$mobile'";
     $res=$this->db->query($check_email);
     if($res->num_rows()>=1){
       echo "already";
     }else{
       echo "success";
     }
   }

   function exist_email($email){
     $check_email="SELECT * FROM user_master WHERE email_id='$email'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
       echo "success";
     }else{
       echo "already";
     }
   }
   function exist_mobile($mobile){
     $check_email="SELECT * FROM user_master WHERE mobile_no='$mobile'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
       echo "success";
     }else{
       echo "already";
     }
   }

   function exist_username($username){
     $check_username="SELECT * FROM user_master WHERE user_name='$username'";
     $res=$this->db->query($check_username);
     if($res->num_rows()==0){
       echo "success";
     }else{
       echo "already";
     }
   }

   function changeprofileimage($user_id,$userFileName){
     $update="UPDATE user_details SET user_picture='$userFileName' WHERE user_id='$user_id'";
     $res=$this->db->query($update);
     if($res){
       echo "success";
     }else{
       echo "failed";
     }
   }
   function email_verify($email,$has){
      $check_username="SELECT * FROM user_master WHERE email_id='$email' AND password='$has'";
     $res=$this->db->query($check_username);
     if($res->num_rows()==1){
       foreach($res->result() as $rows){}
         $user_id=$rows->id;
         $update="UPDATE user_master SET email_verify='Y' WHERE id='$user_id'";
         $result=$this->db->query($update);
         if($result){
          $data=array("msg"=>"verify");
          return $data;
         }else{
           $data=array("msg"=>"Some Thing Went Wrong Please Contact Us");
             return $data;
         }
     }else{
       $data=array("msg"=>"Some Thing Went Wrong Please Contact Us");
         return $data;
     }
   }

   function create_profile($name,$mobile,$email,$password){
   	$pwd=md5($password);
     $create="INSERT INTO user_master (user_name,mobile_no,email_id,password,user_role,email_verify,mobile_verify,status) VALUES('$name','$mobile','$email','$pwd','3','N','N','Y')";
     $res=$this->db->query($create);
     $last_id=$this->db->insert_id();
     $user_details="INSERT INTO user_details (user_id,newsletter_status) VALUES('$last_id','Y')";
      $result=$this->db->query($user_details);

      if($result){
        $to=$email;
        $subject="Welcome to Heyla App";
        $htmlContent = '
          <html>
          <head>
          <title></title>
             </head>
             <body>
             <p style="margin-left:50px;">Thanking for Registering with Heyla App
             To Login Use the New Password <A href="'. base_url().'home/emailverfiy/'.$email.'/'.$pwd.'" target="_blank">Click Here to Verfiy </a> </p>
             </body>
          </html>';
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // Additional headers
      $headers .= 'From: heylapp<info@heylapp.com>' . "\r\n";
      $sent= mail($to,$subject,$htmlContent,$headers);
        echo "verify";
      }else{
        echo "failed";
      }
   }

   function save_profile_info($user_id,$name,$mobile,$email,$address){
      $update="UPDATE user_master SET mobile_no='$mobile',email_id='$email' WHERE id='$user_id'";
     $res=$this->db->query($update);
     $update_user_master="UPDATE user_details SET name='$name',address_line1='$address' WHERE user_id='$user_id'";
     $result=$this->db->query($update_user_master);
     if($result){
          echo "success";
     }else{
          echo "already";
     }
   }

   function reset_password($email){
      $check_email="SELECT * FROM user_master WHERE email_id='$email'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
        echo "Email Not Registered";

     }else{
       $result=$res->result();
       foreach($result as $rows){}
       $email=$rows->email_id;
      $length = 8;
      $genpassword = "";
      $possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $i = 0;
      while ($i < $length) {
       $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
       if (!strstr($genpassword, $char)) {
         $genpassword .= $char;
         $i++;
       }
      }
      $to=$email;
      $subject="Reset Password";
      $htmlContent = '
        <html>
        <head>
        <title>Reset Password</title>
           </head>
           <body>

           <p style="margin-left:50px;">Your Account Password has been Reset Successfully.to Login Use the New Password '.$genpassword.'</p>
           </body>
        </html>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // Additional headers
    $headers .= 'From: heylapp<info@heylapp.com>' . "\r\n";
    $sent= mail($to,$subject,$htmlContent,$headers);

      $newpassword=md5($genpassword);
      $update_pwd="UPDATE user_master SET password='$newpassword' WHERE email_id='$email'";
      $update_new_pwd=$this->db->query($update_pwd);
      if($update_new_pwd){
          echo "success";

      }else{
        echo "Something Went Wrong";
      }
     }
   }

   function getuserfb($firstname,$email){
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



}

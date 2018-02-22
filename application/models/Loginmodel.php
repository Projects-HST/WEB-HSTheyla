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
    $resultset->num_rows();
    if($resultset->num_rows()==1)
      {
         $pwdcheck="SELECT * FROM user_master WHERE password='$password' AND (user_name='$username' OR mobile_no='$username' OR email_id='$username')";
          $res=$this->db->query($pwdcheck);
          if($res->num_rows()==1)
	        {
              foreach($res->result() as $rows)
               {
                 $check_email_verify=$rows->email_verify;
                 if($check_email_verify=='N'){
                   $data= array("status"=>"emailverfiy","msg"=>"emailverfiy");
                   return $data;
                }
                 $quer="SELECT status FROM user_master WHERE id='$rows->id'";
                 $resultset=$this->db->query($quer);
                 $status=$rows->status;
                 switch($status)
                 {
                    case "Y":
                  $insert_activity="INSERT INTO  user_activity (date,user_id,activity_detail) VALUES(NOW(),'$rows->id','normal_login') ";
                  $result_activity=$this->db->query($insert_activity);
                  $update_user_points="UPDATE user_points_count SET login_count=login_count+1,login_points=login_points+1,total_points=total_points+1 WHERE user_id='$rows->id'";
                  $excu_user_points=$this->db->query($update_user_points);

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
       //----------------Total Num OF Users,Events,Booking-----------------------
         function get_tlt_no_user()
         {
           $query="SELECT COUNT(*) as users FROM user_master WHERE user_role='3'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }

         function get_tlt_no_events()
         {
           $query="SELECT COUNT(*) as events FROM events WHERE event_status='Y'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }

         function get_tlt_no_orgevents()
         {
           $query="SELECT COUNT(e.event_name) AS org FROM user_master AS um,events AS e WHERE um.user_role='2' AND um.id=e.created_by AND e.event_status='N'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }

         function get_tlt_no_booking()
         {
           $query="SELECT COUNT(*) AS booking FROM booking_history";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }

        function get_tlt_no_reviews()
        {
          $rev="SELECT COUNT(*) AS reviews FROM event_reviews WHERE status='N'";
          $rev1=$this->db->query($rev);
          return $rev1->result();
        }
     //--------------------------------------------------------------------------

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
       $user_points_query="INSERT INTO user_points_count(user_id) VALUES('$insert_id')";
       $exc_user_points=$this->db->query($user_points_query);
       if($result){
         $quer="SELECT * FROM user_master WHERE id='$insert_id'";
         $resultset=$this->db->query($quer);
         foreach($resultset->result() as $rows){ }
         $status=$rows->status;
         switch($status)
         {
            case "Y":
              $data = array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
              $insert_activity="INSERT INTO  user_activity (date,user_id,activity_detail) VALUES(NOW(),'$rows->id','google_login') ";
              $result_activity=$this->db->query($insert_activity);
              $update_user_login_count="UPDATE user_master SET login_count=login_count+1 WHERE user_id='$rows->id'";
              $excu_user_login_count=$this->db->query($update_user_login_count);
              $update_user_points="UPDATE user_points_count SET login_count=login_count+1,login_points=login_points+1,total_points=total_points+1 WHERE user_id='$rows->id'";
              $excu_user_points=$this->db->query($update_user_points);
              $this->session->set_userdata($data);
              return $data;

              break;
            case "N":
                $data= array("status"=>"Deactive","msg"=>"Your Account Is De-Activated");
                 return $data;
              break;
          }

         $data =  array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
          $insert_activity="INSERT INTO  user_activity (date,user_id,activity_detail) VALUES(NOW(),'$rows->id','google_login') ";
         $result_activity=$this->db->query($insert_activity);
         $update_user_login_count="UPDATE user_master SET login_count=login_count+1 WHERE id='$rows->id'";

         $excu_user_login_count=$this->db->query($update_user_login_count);
         $update_user_points="UPDATE user_points_count SET login_count=login_count+1,login_points=login_points+1,total_points=total_points+1 WHERE user_id='$rows->id'";
         $excu_user_points=$this->db->query($update_user_points);
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
       $insert_activity="INSERT INTO  user_activity (date,user_id,activity_detail) VALUES(NOW(),'$rows->id','normal_login') ";
       $result_activity=$this->db->query($insert_activity);
       $update_user_login_count="UPDATE user_master SET login_count=login_count+1 WHERE id='$rows->id'";
       $excu_user_login_count=$this->db->query($update_user_login_count);
       $update_user_points="UPDATE user_points_count SET login_count=login_count+1,login_points=login_points+1,total_points=total_points+1 WHERE user_id='$rows->id'";
       $excu_user_points=$this->db->query($update_user_points);
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
     if($res->num_rows()>0){
       echo "success";
     }else{
       echo "already";
     }
   }


   function exist_email($email){
      $check_email="SELECT * FROM user_master WHERE email_id='$email'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
       echo "true";
     }else{
       echo "false";
     }
   }
   function exist_mobile($mobile){
     $check_email="SELECT * FROM user_master WHERE mobile_no='$mobile'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
       echo "true";
     }else{
       echo "false";
     }
   }

   function exist_username($username){
     $check_username="SELECT * FROM user_master WHERE user_name='$username'";
     $res=$this->db->query($check_username);
     if($res->num_rows()==0){
       echo "true";
     }else{
       echo "false";
     }
   }

   function check_otp($mobileotp,$user_id){
      $check_otp="SELECT * FROM user_master WHERE mobile_otp='$mobileotp' and id='$user_id'";
     $res=$this->db->query($check_otp);
     if($res->num_rows()==0){
       echo "You have Enter Wrong OTP";
     }else{
       echo "success";
     }
   }

   function changeprofileimage($user_id,$userFileName){
     $update="UPDATE user_details SET user_picture='$userFileName' WHERE user_id='$user_id'";
     $res=$this->db->query($update);
     if($res){
       echo "";
     }else{
       echo "failed";
     }
   }

   function save_mobile_number($mobile,$user_id){
     $update="UPDATE user_master SET mobile_no='$mobile' WHERE id='$user_id'";
     $res=$this->db->query($update);
     if($res){
       echo "success";
     }else{
       echo "failed";
     }
   }

   function check_username($user_name,$user_id){
    $select="SELECT * FROM user_master Where user_name='$user_name' and id!='$user_id'";
     $result=$this->db->query($select);
     if($result->num_rows()>0){
       echo "false";
       }else{
         echo "true";
     }
   }
   function check_mobile($mobile_no,$user_id){
     $select="SELECT * FROM user_master Where mobile_no='$mobile_no' and id!='$user_id'";
      $result=$this->db->query($select);
      if($result->num_rows()>0){
        echo "false";
        }else{
          echo "true";
      }
   }

   function check_mobile_number($mobile_no,$user_id){
      $select="SELECT * FROM user_master Where mobile_no='$mobile_no' and id!='$user_id'";
      $result=$this->db->query($select);
      if($result->num_rows()>0){
        echo "Mobile Already Exist";
        }else{
          echo "success";
      }
   }

   function save_email_id($email,$user_id){
     $check_email="SELECT * FROM user_master WHERE email_id='$email'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
       $update="UPDATE user_master SET email_id='$email',email_verify='N' WHERE id='$user_id'";
       $res=$this->db->query($update);
       $encrypt_email= base64_encode($email);
      $to=$email;
      $subject="Changing of Email";
      $htmlContent = '
      <html>
      <head>
      <title></title>
         </head>
         <body style="background-color:#E4F1F7;"><div style="background-image: url('.base_url().'assets/front/images/email_1.png);height:700px;margin: auto;width: 100%;background-repeat: no-repeat;">
            <div  style="padding:50px;width:400px;"><p>Dear '.$email.'</p>
           <p style="font-size:20px;">Welcome to
            <center><img src="'.base_url().'assets/front/images/heyla_b.png" style="width:120px;"></center>
           </p>
           <p style="margin-left:50px;"> <br>
           To allow us to confirm the validity of your email address,click this verification link. <center>   <a href="'. base_url().'home/emailverfiy/'.$encrypt_email.'" target="_blank"style="background-color: #478ECC;    padding: 12px;    text-decoration: none;    color: #fff;    border-radius: 20px;">Verfiy  Here</a></center>  </p>
           <p style="font-size:20px;">Thank you and enjoy, <br>
             The Heyla Team
             </p>
           </body>
        </html>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // Additional headers
    $headers .= 'From: heylapp<info@heylapp.com>' . "\r\n";
    $sent= mail($to,$subject,$htmlContent,$headers);
    if($res){
      echo "success";
    }else{
      echo "failed";
    }
     }else{
       echo "Email Already Exist";
     }

   }
   function email_verify($email){
     $decrpty_email=base64_decode($email);
     $check_username="SELECT * FROM user_master WHERE email_id='$decrpty_email'";
     $res=$this->db->query($check_username);
     if($res->num_rows()==1){
       foreach($res->result() as $rows){}
         if($rows->email_verify=='Y'){
           $data=array("msg"=>"Email  has been Verified Already Thank You.");
             return $data;
         }else{
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
         }

     }else{
       $data=array("msg"=>"Some Thing Went Wrong Please Contact Us");
         return $data;
     }
   }

   function create_profile($name,$mobile,$email,$password){
   	$pwd=md5($password);
    if(empty($name)){
      echo "failed";
    }else{
      $check_username="SELECT * FROM user_master WHERE email_id='$email'";
     $res=$this->db->query($check_username);
     if($res->num_rows()==1)
     {
       echo "Already Registered";
     }else{
       $create="INSERT INTO user_master (user_name,mobile_no,email_id,password,user_role,email_verify,mobile_verify,status) VALUES('$name','$mobile','$email','$pwd','3','N','N','Y')";
       $res=$this->db->query($create);
       $last_id=$this->db->insert_id();
       $user_points_query="INSERT INTO user_points_count(user_id) VALUES('$last_id')";
       $exc_user_points=$this->db->query($user_points_query);
       $user_details="INSERT INTO user_details (user_id,newsletter_status) VALUES('$last_id','Y')";
        $result=$this->db->query($user_details);
        $s=$email;
    		$encrypt_email= base64_encode($s);

        if($result){
          $to=$email;
          $subject="Welcome to Heyla App";
          $htmlContent = '
          <html>
          <head>
          <title></title>
             </head>
             <body style="background-color:#E4F1F7;"><div style="background-image: url('.base_url().'assets/front/images/email_1.png);height:700px;margin: auto;width: 100%;background-repeat: no-repeat;">
                <div  style="padding:50px;width:400px;"><p>Dear '.$name.'</p>
               <p style="font-size:20px;">Welcome to
                <center><img src="'.base_url().'assets/front/images/heyla_b.png" style="width:120px;"></center>
               </p>
               <p style="margin-left:50px;"> <br>
               To allow us to confirm the validity of your email address,click this verification link. <center>   <a href="'. base_url().'home/emailverfiy/'.$encrypt_email.'" target="_blank"style="background-color: #478ECC;    padding: 12px;    text-decoration: none;    color: #fff;    border-radius: 20px;">Verfiy  Here</a></center>  </p>
               <p style="font-size:20px;">Thank you and enjoy, <br>
                 The Heyla Team
                 </p>
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

    }

   }

   function save_profile_info($first_name,$user_name,$address,$gender,$newsletter_status,$occupation,$user_id){
				  $update_user_details="UPDATE user_details SET name='$first_name',address_line1='$address',occupation='$occupation',gender='$gender',newsletter_status='$newsletter_status' WHERE user_id='$user_id'";

				 $result=$this->db->query($update_user_details);
         $update_user_master="UPDATE user_master SET user_name='$user_name' WHERE id='$user_id'";
				 $result=$this->db->query($update_user_master);
				 if($result){
					  echo "success";
				 }else{
					  echo "failed";
				 }
   }

   function sendOTPmobilechange($mobile,$user_id){
      $mob=$mobile;

       $digits = 4;
      $OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
      $update_user_otp="UPDATE user_master SET mobile_otp='$OTP' WHERE id='$user_id'";
      $result=$this->db->query($update_user_otp);
      $mobile_message = 'Verify Your Mobile Number:'. $OTP;
      $this->load->model('smsmodel');
      $response=$this->smsmodel->sendOTPtomobile($mob,$mobile_message);

   }

   function emptyOTP($user_id){
      $empty_otp="UPDATE  user_master SET mobile_otp=' ' WHERE id='$user_id'";
      $res=$this->db->query($empty_otp);
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
       $encrypt_email= base64_encode($email);
       $to=$email;
       $subject="Reset Password";
       $htmlContent = '
        <html>
        <head>
        <title>Reset Password</title>
           </head>
           <body>
           <p style="margin-left:50px;">To Reset Password.Click the below Link <br>
         <br>   <a href="'. base_url().'home/reset/'.$encrypt_email.'" target="_blank"style="background-color: #478ECC;    padding: 12px;    text-decoration: none;    color: #fff;    border-radius: 20px;">Click Here To Reset</a></br>  </p>

           </body>
        </html>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // Additional headers
    $headers .= 'From: heylapp<info@heylapp.com>' . "\r\n";
    $sent= mail($to,$subject,$htmlContent,$headers);
      if($sent){
          echo "success";

      }else{
        echo "Something Went Wrong";
      }
     }
   }

   function update_password($email_token,$new_password,$retype_password){
      $email_decrypt=base64_decode($email_token);
      $check_email="SELECT * FROM user_master WHERE email_id='$email_decrypt'";
     $res=$this->db->query($check_email);
      if($res->num_rows()==0){
        echo "Something Went Wrong";
      }else{
        $pwd=md5($new_password);
        $update_user_master="UPDATE user_master SET password='$pwd' WHERE email_id='$email_decrypt'";
        $result=$this->db->query($update_user_master);
        if($result){
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
        $user_points_query="INSERT INTO user_points_count(user_id) VALUES('$insert_id')";
        $exc_user_points=$this->db->query($user_points_query);
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
               $insert_activity="INSERT INTO  user_activity (date,user_id,activity_detail) VALUES(NOW(),'$rows->id','fb_login') ";
               $result_activity=$this->db->query($insert_activity);
               $update_user_login_count="UPDATE user_master SET login_count=login_count+1 WHERE id='$rows->id'";
               $excu_user_login_count=$this->db->query($update_user_login_count);
               $update_user_points="UPDATE user_points_count SET login_count=login_count+1,login_points=login_points+1,total_points=total_points+1 WHERE user_id='$rows->id'";
               $excu_user_points=$this->db->query($update_user_points);
               $this->session->set_userdata($data);
               return $data;

               break;
             case "N":
                 $data= array("status"=>"Deactive","msg"=>"Your Account Is De-Activated");
                  return $data;
               break;
           }

          $data =  array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
          $insert_activity="INSERT INTO  user_activity (date,user_id,activity_detail) VALUES(NOW(),'$rows->id','fb_login') ";
          $result_activity=$this->db->query($insert_activity);
          $update_user_login_count="UPDATE user_master SET login_count=login_count+1 WHERE id='$rows->id'";
          $excu_user_login_count=$this->db->query($update_user_login_count);
          $update_user_points="UPDATE user_points_count SET login_count=login_count+1,login_points=login_points+1,total_points=total_points+1 WHERE user_id='$rows->id'";
          $excu_user_points=$this->db->query($update_user_points);
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
        $insert_activity="INSERT INTO  user_activity (date,user_id,activity_detail) VALUES(NOW(),'$rows->id','fb_login') ";
        $result_activity=$this->db->query($insert_activity);
        $update_user_login_count="UPDATE user_master SET login_count=login_count+1 WHERE id='$rows->id'";
        $excu_user_login_count=$this->db->query($update_user_login_count);
        $update_user_points="UPDATE user_points_count SET login_count=login_count+1,login_points=login_points+1,total_points=total_points+1 WHERE user_id='$rows->id'";
        $excu_user_points=$this->db->query($update_user_points);
        $this->session->set_userdata($data);
        return $data;
      }

    }


    function mail_contact_form($name,$email,$subject,$msg){
      $query="INSERT INTO contact_form (name,email,subject,message,created_at,updated_by) VALUES('$name','$email','$subject','$msg',NOW(),NOW())";
      $resultset=$this->db->query($query);
      $to="hello@heylaapp.com,kamal.happysanz@gmail.com";
      $subject="Contact Form Enquiry";
      $htmlContent = '
       <html>
       <head>
       <title>Contact Form</title>
          </head>
          <body>
            <div class="mail-content">
              <p>Name - '.$name.'</p>
              <p>Email - '.$email.'</p>
              <p>Subject - '.$subject.'</p>
              <p>Message - '.$msg.'</p>
            </div>
          </body>
       </html>';
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
   // Additional headers
   $headers .= 'From: heylapp<info@heylapp.com>' . "\r\n";
   $sent= mail($to,$subject,$htmlContent,$headers);
   if($sent){
     echo "success";
   }else{
      echo "failed";
   }
    }



}

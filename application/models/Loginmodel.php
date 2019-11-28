<?php

Class Loginmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();
       $this->load->model('mailmodel');

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
                //  if($check_email_verify=='N'){
                //    $data= array("status"=>"emailverfiy","msg"=>"emailverfiy");
                //    return $data;
                // }
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
		 
         function get_tlt_no_org_user()
         {
           $query="SELECT COUNT(*) as users FROM user_master WHERE user_role='2'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
		 
         function get_tlt_no_admin_user()
         {
           $query="SELECT COUNT(*) as users FROM user_master WHERE user_role='4'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }

         function get_tlt_no_events()
         {
           $query="SELECT COUNT(*) as events FROM events";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
		 
		  function get_active_events()
         {
            $query="SELECT COUNT(*) as active_events FROM events WHERE event_status='Y'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
		 
		 function get_archive_events()
         {
           $query="SELECT COUNT(*) as archive_events FROM events WHERE event_status='N' OR end_date <= CURDATE() AND hotspot_status='N'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
	 	
		 
		 function get_no_of_hotspot_events()
         {
           $query="SELECT count(*) as hotspot_events FROM events where  hotspot_status='Y' and event_status='Y'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
		 

		function get_no_of_general_events()
         {
           $query="SELECT count(*) as general_events FROM events where hotspot_status='N' and event_status='Y'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }

         function live_events()
         {
           $query="SELECT count(*) as live_events FROM events where hotspot_status='N' and event_status='Y' and end_date>= CURDATE()";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
		 
         function get_no_of_paid_events()
         {
           $query="SELECT count(*) as count from events where event_type='Paid' and event_status='Y' and end_date>= CURDATE()";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
         
		 function get_no_of_free_events()
         {
           $query="SELECT count(*) as count from events where event_type='Free' and event_status='Y' and end_date>= CURDATE()";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
         
		 function get_no_of_ad_events()
         {
           $query="SELECT count(*) as count FROM adv_event_history where date_to >=CURRENT_DATE and status='Y'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
		 
		 function get_tlt_no_orgevents()
         {
           $query="SELECT COUNT(e.event_name) AS org FROM user_master AS um,events AS e WHERE um.user_role='2' AND um.id=e.created_by AND e.event_status='N'";
           $resultset=$this->db->query($query);
           return $resultset->result();
         }
		 
         function get_no_of_news_letter_subscriber()
         {
           $query="SELECT count(*) as count FROM user_details where newsletter_status='Y'";
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

        function get_total_category()
        {
          $rev="SELECT count(*)  as count FROM category_master WHERE status='Y'";
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
       
	   $user_master_query="INSERT INTO user_details(user_id,name,newsletter_status) VALUES('$insert_id','$firstname','Y')";
       $result=$this->db->query($user_master_query);
       
	   $user_points_query="INSERT INTO user_points_count(user_id) VALUES('$insert_id')";
       $exc_user_points=$this->db->query($user_points_query);
	   
       
         $quer="SELECT * FROM user_master WHERE id='$insert_id'";
         $resultset=$this->db->query($quer);
		 if($resultset){
         foreach($resultset->result() as $rows){ }
         /* $status=$rows->status;
         switch($status)
         {
            case "Y":
              $data = array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
              $insert_activity="INSERT INTO  user_activity (date,user_id,activity_detail) VALUES(NOW(),'$rows->id','google_login') ";
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
          } */

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
       $quer="SELECT * FROM user_master WHERE email_id='$email' AND status = 'Y'";
       $resultset=$this->db->query($quer);
	   
	   if($resultset->num_rows()>0){
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
     }else {
			    $data= array("status" => "Deactive");
		   }
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
     if($res->num_rows()==0){
       echo "true";
     }else{
       echo "false";
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
       echo "false";
     }else{
       echo "true";
     }
   }

   function changeprofileimage($user_id,$userFileName){
     $update="UPDATE user_details SET user_picture='$userFileName' WHERE user_id='$user_id'";
     $res=$this->db->query($update);
     if($res){
       $data= array("status" => "success");
       return $data;
     }else{
       $data= array("status" => "Failed to Update");
       return $data;
     }
   }

   function remove_img($user_id){
    $select="SELECT * from user_details where user_id='$user_id'";
    $get_all=$this->db->query($select);
    $result=$get_all->result();
    foreach($result as $rows){}
    $filename='./assets/users/profile/'.$rows->user_picture;
    unlink($filename);
    $get_all_gallery_img="UPDATE user_details SET user_picture='' WHERE user_id='$user_id' ";
    $get_all=$this->db->query($get_all_gallery_img);
    if ($get_all) {
      $data= array("status" => "success");
      return $data;
    } else {
      $data= array("status" => "Failed to Update");
      return $data;
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

   function check_email_exist($email,$user_id){
     $select="SELECT * FROM user_master Where email_id='$email' and id!='$user_id'";
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
      $subject="Heyla User Email ID Change";
      $htmlContent = '
      <html>
      <head>
      <title>'.$subject.'</title>
         </head>
         <body style="background-color:#E4F1F7;"><div style="background-image: url('.base_url().'assets/front/images/email_1.png);height:700px;margin: auto;width: 100%;background-repeat: no-repeat;">
            <div  style="padding:50px;width:400px;">
           <p>Hi,</p>
           <p style="font-size:17px;">Please click the below link to get your new email ID validated: </p>
           <p><a href="'. base_url().'home/emailverfiy/'.$encrypt_email.'" target="_blank">Click here</a></p>
           <p style="font-size:20px;">With love,<br>Team Heyla<br></p>
           <small>This is an auto-generated email intended for notification purpose only. Do not reply to this email.</small>
           </div>
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
       echo "Email ID already exists!";
     }

   }
   function email_verify($email){
     $decrpty_email=base64_decode($email);
     $check_username="SELECT * FROM user_master WHERE email_id='$decrpty_email'";
     $res=$this->db->query($check_username);
     if($res->num_rows()==1){
       foreach($res->result() as $rows){}
         if($rows->email_verify=='Y'){
           $data=array("msg"=>"Your email has been verified already! <a href=".base_url()."signin>click here to sign in.</a>");
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
            echo "verify";

          $digits = 4;
          $OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
          $update_user_otp="UPDATE user_master SET mobile_otp='$OTP' WHERE id='$last_id'";
          $result=$this->db->query($update_user_otp);
          $mobile_message = 'Use this OTP to verify your mobile number:'. $OTP;
          $this->load->model('smsmodel');
          $mob=$mobile;
          $response=$this->smsmodel->sendOTPtomobile($mob,$mobile_message);
        //   $to=$email;
        //   $subject=" Heyla User Registration";
        //   $htmlContent = '
        //   <html>
        //   <head>
        //   <title> '.$subject.'</title>
        //      </head>
        //      <body style="background-color:#E4F1F7;"><div style="background-image: url('.base_url().'assets/front/images/email_1.png);height:700px;margin: auto;width: 100%;background-repeat: no-repeat;">
        //         <div  style="padding:50px;width:400px;"><p>Dear  '.$name.'</p>
        //         <p style="font-size:17px;">Welcome!</p>
        //         <p style="font-size:17px;">We are glad you signed up.</p>
        //         <p style="font-size:17px;"><a href="'. base_url().'home/emailverfiy/'.$encrypt_email.'">Click here</a> to get your email ID verified.</p>
        //         <p style="font-size:17px;"> We wish you to make cheerful memories with each event! </p>
        //         <small>This is an auto-generated email intended for notification purpose only. Do not reply to this email.</small>
        //        </body>
        //     </html>';
        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // // Additional headers
        // $headers .= 'From: heylapp<info@heylapp.com>' . "\r\n";
        // $sent= mail($to,$subject,$htmlContent,$headers);

        }else{
          echo "failed";
        }
     }

    }


   }


   function mobile_verify_otp_check($mobile_otp,$mobile){
     $check_otp="SELECT * FROM user_master WHERE mobile_no='$mobile' and mobile_otp='$mobile_otp'";
     $res=$this->db->query($check_otp);
     if($res->num_rows()==1){
       foreach($res->result() as $rows){ }
       $get_user_id=$rows->id;
       $insert_activity="INSERT INTO  user_activity (date,user_id,activity_detail) VALUES(NOW(),'$get_user_id','normal_login') ";
       $result_activity=$this->db->query($insert_activity);
       $update_user_login_count="UPDATE user_master SET login_count=login_count+1,mobile_verify='Y' WHERE id='$get_user_id'";
       $excu_user_login_count=$this->db->query($update_user_login_count);
       $update_user_points="UPDATE user_points_count SET login_count=login_count+1,login_points=login_points+1,total_points=total_points+1 WHERE user_id='$get_user_id'";
       $excu_user_points=$this->db->query($update_user_points);
       $data = array("user_name" => $rows->user_name,"msg"  =>"success","mobile_no"=>$rows->mobile_no,"status"=>$rows->status,"email_id"=>$rows->email_id,"user_role"=>$rows->user_role,"id"=>$rows->id);
       $this->session->set_userdata($data);
       return $data;
     }else{
       $data= array("status" => "failed","msg" => "Something went wrong! Please try again later.");
       return $data;

     }

   }


   function password_otp_check($mobile_otp,$mobile){
      $check_otp="SELECT * FROM user_master WHERE mobile_no='$mobile' and mobile_otp='$mobile_otp'";
     $res=$this->db->query($check_otp);
     if($res->num_rows()==1){
       foreach($res->result() as $rows){ }
       $get_user_id=$rows->id;
       $update="UPDATE user_master SET password='' WHERE id='$get_user_id'";
       $excu_update=$this->db->query($update);
       if($excu_update){
         $data= array("status" => "success","msg" => "Otp Verified Successfully");
         return $data;
       }else{
         $data= array("status" => "failed","msg" => "Something went wrong! Please try again later.");
         return $data;
       }
     }else{
       $data= array("status" => "failed","msg" => "Something went wrong! Please try again later.");
       return $data;
     }
   }

   function mobile_otp_update($mobile){
     $digits = 4;
     $OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
     $update_user_otp="UPDATE user_master SET mobile_otp='$OTP' WHERE mobile_no='$mobile'";
     $result=$this->db->query($update_user_otp);
     $mobile_message = 'Use this OTP to verify your mobile number:'. $OTP;
     $this->load->model('smsmodel');
     $mob=$mobile;
     $response=$this->smsmodel->sendOTPtomobile($mob,$mobile_message);
     if($result){
       echo "OTP is sent again.";
     }else{
       echo "Something went wrong! Please try again later.";
     }
   }

   function save_profile_info($first_name,$user_name,$email_id,$address,$gender,$newsletter_status,$occupation,$user_id){
				  $update_user_details="UPDATE user_details SET name='$first_name',address_line1='$address',occupation='$occupation',gender='$gender',newsletter_status='$newsletter_status' WHERE user_id='$user_id'";

				 $result=$this->db->query($update_user_details);
         $update_user_master="UPDATE user_master SET user_name='$user_name',email_id='$email_id' WHERE id='$user_id'";
				 $result=$this->db->query($update_user_master);
				 if($result){
					  echo "success";
				 }else{
					  echo "failed";
				 }
   }


   function password_change($confirm_password,$user_id){
		$change_password = md5($confirm_password);
		$update_user_master="UPDATE user_master SET password='$change_password' WHERE id='$user_id'";
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
      $mobile_message = 'Use this OTP to verify your mobile number:'. $OTP;
      $this->load->model('smsmodel');
      $response=$this->smsmodel->sendOTPtomobile($mob,$mobile_message);

   }

   function emptyOTP($user_id){
      $empty_otp="UPDATE  user_master SET mobile_otp=' ' WHERE id='$user_id'";
      $res=$this->db->query($empty_otp);
   }

   function reset_password($mobile_number){
      $check_email="SELECT * FROM user_master WHERE mobile_no='$mobile_number'";
     $res=$this->db->query($check_email);
     if($res->num_rows()==0){
        echo "This Mobile number doesn't seem to be in our record! <br>Please check.";

     }else{
       $result=$res->result();
       foreach($result as $rows){}
       $email=$rows->email_id;
       $mobile_no=$rows->mobile_no;
       $digits = 4;
       $OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
       $update_user_otp="UPDATE user_master SET mobile_otp='$OTP' WHERE mobile_no='$mobile_number'";
       $result=$this->db->query($update_user_otp);
       $mobile_message = 'Use this OTP to verify your mobile number:'. $OTP;
       $this->load->model('smsmodel');
       $mob=$mobile_number;
       $response=$this->smsmodel->sendOTPtomobile($mob,$mobile_message);
       if($result){
         echo "OTP Resent";
       }else{
         echo "Something went wrong! Please try again later.";
       }

    //    $encrypt_email= base64_encode($email);
    //    $to=$email;
    //    $subject="Heyla - Reset Password";
    //    $htmlContent = '
    //     <html>
    //     <head>
    //     <title>Reset Password</title>
    //        </head>
    //        <body>
    //        <p>Hi,<p/>
    //        <p style="margin-left:50px;">Please click the below link to reset your password:<br>
    //      <br>   <a href="'. base_url().'home/reset/'.$encrypt_email.'" target="_blank"style="background-color: #478ECC;    padding: 8px;    text-decoration: none;    color: #fff;    border-radius: 20px;">Click Here To Reset</a></br>  </p>
    //         <p>With love,  <br>Team Heyla</p>
    //         <br><br>
    //         <small>This is an auto-generated email intended for notification purpose only. Do not reply to this email.</small>
    //        </body>
    //     </html>';
    // $headers = "MIME-Version: 1.0" . "\r\n";
    // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // // Additional headers
    // $headers .= 'From: heylapp<info@heylapp.com>' . "\r\n";
    // $sent= mail($to,$subject,$htmlContent,$headers);
    //   if($sent){
    //       echo "success";
    //
    //   }else{
    //     echo "Something went wrong! Please try again later.";
    //   }
     }
   }

   function update_password($email_token,$new_password,$retype_password){
      $email_decrypt=base64_decode($email_token)/987654;
     $check_email="SELECT * FROM user_master WHERE mobile_no='$email_decrypt'";
     $res=$this->db->query($check_email);
      if($res->num_rows()==0){
        echo "Something Went Wrong";
      }else{
        $pwd=md5($new_password);
        $update_user_master="UPDATE user_master SET password='$pwd' WHERE mobile_no='$email_decrypt'";
        $result=$this->db->query($update_user_master);
        if($result){
            echo "success";
        }else{
            echo "Something went wrong! Please try again later.";
        }
    }
   }

   function getuserfb($firstname,$email){
     if(empty($email)){
		$data= array("status"=>"error","msg"=>"Something Went Wrong");
        return $data;
     }else{
       $check_email="SELECT * FROM user_master WHERE email_id='$email'";
       $res=$this->db->query($check_email);
        if($res->num_rows()==0){
          $query="INSERT INTO user_master (email_id,last_login,user_role,email_verify,status,created_at) VALUES('$email',NOW(),'3','Y','Y',NOW())";
          $resultset=$this->db->query($query);
          $insert_id = $this->db->insert_id();
		  
          $user_points_query="INSERT INTO user_points_count(user_id) VALUES('$insert_id')";
          $exc_user_points=$this->db->query($user_points_query);
		  
          $user_master_query="INSERT INTO user_details(user_id,name,newsletter_status) VALUES('$insert_id','$firstname','Y')";
          $result=$this->db->query($user_master_query);
         
            
			$quer="SELECT * FROM user_master WHERE id='$insert_id'";
            $resultset=$this->db->query($quer);
			 if($result){
				foreach($resultset->result() as $rows){ }
            /* $status=$rows->status;
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
             } */

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
          $quer="SELECT * FROM user_master WHERE email_id='$email' AND status = 'Y'";
          $resultset=$this->db->query($quer);
		  
		   if($resultset->num_rows()>0){
		
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
		   } else {
			    $data= array("status" => "Deactive");
		   }
        }
     }


    }


    function mail_contact_form($name,$email,$subject,$msg){
      if(empty($name)){

      }else{
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

	public function get_points($user_id)
	{
		$sql="SELECT * FROM user_points_count WHERE user_id = '$user_id' LIMIT 1";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}


	public function user_points()
	{
		$sql="SELECT
				A.id,
				B.name,
				C.total_points
			FROM
				user_master A,
				user_details B,
				user_points_count C
			WHERE
				A.id = B.user_id AND A.id = C.user_id AND A.status = 'Y' AND A.user_role != 1
			ORDER BY
				C.total_points
			DESC";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}

	public function get_booking($user_id)
	{
		$sql="SELECT A.id,A.payment_gateway,A.order_id,E.category_name,B.id AS event_id,B.event_name,B.event_banner,B.description,B.event_venue,B.event_address,C.show_date,C.show_time,D.plan_name,A.number_of_seats, A.total_amount,A.created_at,B.event_colour_scheme FROM booking_history A,events B,booking_plan_timing C,booking_plan D,category_master E WHERE A.user_id  = '$user_id' AND A.event_id = B.id AND A.plan_time_id = C.id AND A.plan_id = D.id AND B.category_id = E.id";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}

	public function get_booking_history($order_id,$gateway)
	{
    if($gateway=='Paytm'){
      	 	$sql="SELECT A.id,A.order_id,E.category_name,B.id AS event_id,B.event_name,B.event_banner,B.description,B.event_venue,B.event_address,C.show_date,C.show_time,D.plan_name,A.number_of_seats, A.total_amount,A.created_at, F.* FROM booking_history A,events B,booking_plan_timing C,booking_plan D,category_master E, booking_status_paytm F  WHERE A.order_id  = '$order_id' AND F.order_id  = '$order_id' AND A.event_id = B.id AND A.plan_time_id = C.id AND A.plan_id = D.id AND B.category_id = E.id";
    }else{
      	 	$sql="SELECT A.id,A.order_id,E.category_name,B.id AS event_id,B.event_name,B.event_banner,B.description,B.event_venue,B.event_address,C.show_date,C.show_time,D.plan_name,A.number_of_seats, A.total_amount,A.created_at, F.* FROM booking_history A,events B,booking_plan_timing C,booking_plan D,category_master E, booking_status F  WHERE A.order_id  = '$order_id' AND F.order_id  = '$order_id' AND A.event_id = B.id AND A.plan_time_id = C.id AND A.plan_id = D.id AND B.category_id = E.id";
    }

		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}


	public function get_wishlist($user_id)
	{
		//$user_id = '300';
		$current_date = date("Y-m-d");
		$sql="select ev.*,uwl.id as wishlist_id,uwl.updated_at as wl_updated_at from events as ev LEFT JOIN user_wish_list as uwl on uwl.event_id = ev.id WHERE uwl.user_id = '$user_id' group by ev.id ORDER BY uwl.updated_at desc";
		$resu=$this->db->query($sql);

		$res=$resu->result();
		return $res;
	}

	public function remove_wishlist($wishlist_id)
	{
		$sql="DELETE FROM user_wish_list WHERE id='$wishlist_id'";
		$resu=$this->db->query($sql);
		//$res = "Removed";
		//return $res;
	}

	public function event_attendees($sorder_id)
	{

	 	$sql = "SELECT A.`order_id`,A.`number_of_seats`,B.user_name,B.mobile_no,B.email_id,C.name FROM `booking_history` A,user_master B,user_details C WHERE A.user_id = B.id AND A.user_id = C.user_id AND A.`order_id` = '$sorder_id'";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}

    public function disp_event_attendees($sorder_id)
	{
		$sql = "SELECT * from booking_event_attendees WHERE order_id = '$sorder_id'";
		$resu=$this->db->query($sql);
		$res=$resu->result();
		return $res;
	}

	public function check_attendees($order_id)
	{

		$sQuery = "SELECT * FROM booking_event_attendees WHERE order_id='" .$order_id. "'";
		$attendees_result = $this->db->query($sQuery);
		$ress = $attendees_result->result();

		if($attendees_result->num_rows() > 0)
		{
			$message = "Exist";
		} else {
			$message = "Nil";
		}
			return $message;
	}

	public function insert_attendees($order_id,$name,$email,$phone)
	{
		$query = "INSERT INTO booking_event_attendees (order_id,name,email_id,mobile_no) VALUES('$order_id','$name','$email','$phone')";
		$resultset = $this->db->query($query);
	}


  function save_request_orgainser($user_id){

	$message = "I want to become a Organiser  with Heyla";
	$check_email = "SELECT * FROM organiser_request WHERE user_id='$user_id'";
	//exit;
	$res=$this->db->query($check_email);
    if($res->num_rows()==0){
      $query = "INSERT INTO organiser_request (user_id,message,req_status,created_at) VALUES('$user_id','$message','Pending',NOW())";
      $resultset = $this->db->query($query);
      if($resultset){
			echo "Thanks for requesting we contact you shortly";
      }else{
			echo "failed";
      }
    }else{
      echo "You have already requested and waiting for Approval";
  }

  /*  $check_email = "SELECT * FROM organiser_request WHERE user_id='$user_id'";
   $res=$this->db->query($check_email);
    if($res->num_rows()==0){
      $query = "INSERT INTO organiser_request (user_id,name,email_or_phone,message,req_status,created_at) VALUES('$user_id','$name','$email','$message','Pending',NOW())";
      $resultset = $this->db->query($query);
      if($resultset){
			echo "Thanks for requesting we contact you shortly";
      }else{
			echo "failed";
      }
    }else{
      echo "You have already requested and waiting for Approval";
  } */
}

  function organiser_pending_request(){
    $sql = "SELECT COUNT(*) AS request_pending FROM organiser_request WHERE req_status='Pending'";
    $resu=$this->db->query($sql);
    $res=$resu->result();
    return $res;
  }


  function get_all_organiser_request(){
    $sql = "SELECT ogr.id as rq_id,ud.name AS name_req,um.email_id,um.user_name,um.id, ogr.*,ud.user_id FROM organiser_request AS ogr LEFT JOIN user_master AS um ON um.id=ogr.user_id LEFT JOIN user_details AS ud ON ud.user_id=um.id ORDER BY ogr.id DESC";
    $resu=$this->db->query($sql);
    $res=$resu->result();
    return $res;
  }

  function get_organiser_request($id){
    $rq_id=$id/9876;
    $sql = "SELECT ogr.id as rq_id,ogr.*,um.* FROM organiser_request AS ogr LEFT JOIN user_master AS um ON um.id=ogr.user_id WHERE ogr.id='$rq_id'";
    $resu=$this->db->query($sql);
    $res=$resu->result();
    return $res;
  }

  function change_req_status($req_status,$rq_id,$org_id){
    $sql = "UPDATE  organiser_request SET req_status='$req_status' WHERE id='$rq_id'";
    $resu=$this->db->query($sql);
    $get_email="SELECT * FROM user_master WHERE id='$org_id'";
    $result=$this->db->query($get_email);
    foreach($result->result() as $get_mail){}
    $email=$get_mail->email_id;
    if($req_status=="Approved"){
      $notes="Your Request has been Approved Please Logout from all devices and Login Again";
      $sql = "UPDATE  user_master SET user_role='2' WHERE id='$org_id'";
      $resu=$this->db->query($sql);
      $this->mailmodel->send_mail($email,$notes);
    }else if($req_status=="Rejected"){
      $notes="Your Request has been Rejected Please Contact us ";
      $sql = "UPDATE  user_master SET user_role='3' WHERE id='$org_id'";
      $resu=$this->db->query($sql);
      $this->mailmodel->send_mail($email,$notes);
    }else{
      $sql = "UPDATE  user_master SET user_role='3' WHERE id='$org_id'";
      $resu=$this->db->query($sql);
    }
    if($resu){
		echo "success";
    }else{
        echo "failure";
    }
  }


	public function request_refund($order_id)
	{
		$user_id= $this->session->userdata('id');
		$check_eve="SELECT * FROM refund_request WHERE order_id='$order_id'";
		$result=$this->db->query($check_eve);
		  if($result->num_rows()==0)
		   {
				$query="INSERT INTO refund_request(user_id,order_id,status,created_at) VALUES ('$user_id','$order_id','Pending',NOW())";
				$resultset=$this->db->query($query);

				$subject = "Heyla App - Refund Request";
				$email_message ='<html>
								 <body>
									<p>Order Id : '.$order_id.'</p>
									<p>User Id : '.$user_id.'</p>
								 </body>
								 </html>';
				$sender_emails = "info@heylaapp.com";
				// Set content-type header for sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// Additional headers
				$headers .= 'From: Heyla App<admin@heylaapp.com>' . "\r\n";
				mail($sender_emails,$subject,$email_message,$headers);
			}
	}

}

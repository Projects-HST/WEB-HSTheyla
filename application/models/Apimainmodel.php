<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apimainmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


//#################### Email ####################//

	public function sendMail($to,$subject,$email_message)
	{
		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: Webmaster<hello@heylaapp.com>' . "\r\n";
		mail($to,$subject,$email_message,$headers);
	}

//#################### Email End ####################//


//#################### Notification ####################//

	public function sendNotification($gcm_key,$Title,$Message,$mobiletype)
	{
		if ($mobiletype =='1'){

		    require_once 'assets/notification/Firebase.php';
            require_once 'assets/notification/Push.php'; 
            
            $device_token = explode(",", $gcm_key);
            $push = null; 
        
//        //first check if the push has an image with it
		    $push = new Push(
					$Title,
					$Message,
					'http://heylaapp.com/notification/images/events.jpg'
				);

// 			//if the push don't have an image give null in place of image
 			// $push = new Push(
 			// 		'HEYLA',
 			// 		'Hi Testing from maran',
 			// 		null
 			// 	);

    		//getting the push from push object
    		$mPushNotification = $push->getPush(); 
    
    		//creating firebase class object 
    		$firebase = new Firebase(); 

    	foreach($device_token as $token) {
    		 $firebase->send(array($token),$mPushNotification);
    	}

		} else {
            
			$device_token = explode(",", $gcm_key);
			$passphrase = 'hs123';
		    $loction ='assets/notification/heylaapp.pem';
		   
			$ctx = stream_context_create();
			stream_context_set_option($ctx, 'ssl', 'local_cert', $loction);
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
			
			// Open a connection to the APNS server
			$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
			
			if (!$fp)
				exit("Failed to connect: $err $errstr" . PHP_EOL);

			$body['aps'] = array(
				'alert' => array(
					'body' => $Message,
					'action-loc-key' => 'Heyla App',
				),
				'badge' => 2,
				'sound' => 'assets/notification/oven.caf',
				);
			
			$payload = json_encode($body);

			foreach($device_token as $token) {
			
				// Build the binary notification
    			$msg = chr(0) . pack("n", 32) . pack("H*", str_replace(" ", "", $token)) . pack("n", strlen($payload)) . $payload;
        		$result = fwrite($fp, $msg, strlen($msg));
			}
							
				fclose($fp);
		}
	}

//#################### Notification End ####################//



//#################### SMS ####################//

	public function sendSMS($Phoneno,$Message)
	{
        //Your authentication key
        $authKey = "181620ALl9WDEru59f871db";
        
        //Multiple mobiles numbers separated by comma
        $mobileNumber = "$Phoneno";
        
        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "HEYLAA";
        
        //Your message to send, Add URL encoding here.
        $message = urlencode($Message);
        
        //Define route 
        $route = "transactional";
        
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
        
        //API URL
        $url="https://control.msg91.com/api/sendhttp.php";
        
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        
        
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        
        //get response
        $output = curl_exec($ch);
        
        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }
        
        curl_close($ch);
	}

//#################### SMS End ####################//


//#################### Main Login ####################//
	public function Login($username,$password,$gcm_key,$mobile_type)
	{
	    $user_id = '';
	    $login_type = "normal_login";
	    $country_name = '';
	    $state_name = '';
	    $city_name = '';
	    
		$sql = "SELECT * FROM user_master WHERE user_name ='".$username."' AND password = md5('".$password."') AND status='Y'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		if($user_result->num_rows()>0)
		{
			foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->id;
				  $login_count = $rows->login_count+1;

			}
		} 
		
		$sql = "SELECT * FROM user_master WHERE mobile_no ='".$username."' AND password = md5('".$password."') AND mobile_verify ='Y' AND status='Y'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		if($user_result->num_rows()>0)
		{
			foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->id;
				  $login_count = $rows->login_count+1;

			}
		} 

		$sql = "SELECT * FROM user_master WHERE email_id ='".$username."' AND password = md5('".$password."') AND email_verify ='Y' AND status='Y'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		if($user_result->num_rows()>0)
		{
			foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->id;
				  $login_count = $rows->login_count+1;
			}
		} 
		

		if ( $user_id != "") {
			
		    $sql = "SELECT A.id as userid, A.user_name, A.mobile_no, A.email_id, A.email_verify, A.login_count, A.user_role, B.name, B.birthdate, B.gender, B.occupation, B.address_line1, B.address_line2, B.address_line3, B.country_id, B. state_id, B.city_id, B.zip, B.user_picture, B.newsletter_status, B.referal_code, C.user_role_name FROM user_master A, user_details B, user_role_master C WHERE A.id=B.user_id AND A.user_role = C.id AND A.id ='".$user_id."'";
		    
			$user_result = $this->db->query($sql);
			$ress = $user_result->result();
			
			if($user_result->num_rows()>0)
			{
			    
			    foreach ($user_result->result() as $rows)
    			{
    				  $user_picture = $rows->user_picture;
    				  $country_id = $rows->country_id;
    				  $state_id = $rows->state_id;
    				  $city_id = $rows->city_id;
    			}
			  
			    if ($user_picture != ''){
			        $picture_url = base_url().'assets/users/profile/'.$user_picture;
			    }else {
			         $picture_url = '';
			    }

                $country_sql = "SELECT * FROM country_master WHERE id ='".$country_id."'";
        		$country_result = $this->db->query($country_sql);
        		if($country_result->num_rows()>0)
        		{
        			foreach ($country_result->result() as $rows)
        			{
        				  $country_name = $rows->country_name;
        			}
        		} else {
        		          $country_name ='';
        		}
             
                $state_sql = "SELECT * FROM state_master WHERE id ='".$state_id."'";
        		$state_result = $this->db->query($state_sql);
        		if($state_result->num_rows()>0)
        		{
        			foreach ($state_result->result() as $rows)
        			{
        				  $state_name = $rows->state_name;
        			}
        		} else {
        		          $state_name ='';
        		}
        		
        		$city_sql = "SELECT * FROM city_master WHERE id ='".$city_id."'";
        		$city_result = $this->db->query($city_sql);
        		if($city_result->num_rows()>0)
        		{
        			foreach ($city_result->result() as $rows)
        			{
        				  $city_name = $rows->city_name;
        			}
        		} else {
        		          $city_name ='';
        		}
                		
				$userData  = array(
							"user_id" => $ress[0]->userid,
							"user_name" => $ress[0]->user_name,
							"mobile_no" => $ress[0]->mobile_no,
							"email_id" => $ress[0]->email_id,
							"full_name" => $ress[0]->name,
							"birth_date" => $ress[0]->birthdate,
							"gender" => $ress[0]->gender,
							"occupation" => $ress[0]->occupation,
							"address_line_1" => $ress[0]->address_line1,
							"address_line_2" => $ress[0]->address_line2,
							"address_line_3" => $ress[0]->address_line3,
							"country_id" => $ress[0]->country_id,
							"country_name" => $country_name,
							"state_id" => $ress[0]->state_id,
							"state_name" => $state_name,
							"city_id" => $ress[0]->city_id,
							"city_name" => $city_name,
							"zip" => $ress[0]->zip,
							"picture_url" => $picture_url,
							"newsletter_status" => $ress[0]->newsletter_status,
							"email_verify_status" => $ress[0]->email_verify,
							"user_role" => $ress[0]->user_role,
							"user_role_name" => $ress[0]->user_role_name,
							"referal_code" => $ress[0]->referal_code	
				);
			}
			
			$update_sql = "UPDATE user_master SET last_login=NOW(),login_count='$login_count' WHERE id='$user_id'";
			$update_result = $this->db->query($update_sql);
			
			$activity_sql = "INSERT INTO user_activity (date,user_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $login_type . "')";
			$insert_activity = $this->db->query($activity_sql);
			
			$gcmQuery = "SELECT * FROM push_notification_master WHERE gcm_key like '%" .$gcm_key. "%' LIMIT 1";
			$gcm_result = $this->db->query($gcmQuery);
			$gcm_ress = $gcm_result->result();
			
					if($gcm_result->num_rows()==0)
					{
						$sQuery = "INSERT INTO push_notification_master (user_id,gcm_key,mobile_type) VALUES ('". $user_id . "','". $gcm_key . "','". $mobile_type . "')";
						$update_gcm = $this->db->query($sQuery);
					}
			
					$response = array("status" => "Success", "msg" => "Login Successfully", "userData" => $userData);
					return $response;
		} else {
			
					$response = array("status" => "Error", "msg" => "Invalid login");
					return $response;
		}

	}
	
	
//#################### Main Login End ####################//


//#################### Facebook and Gmail Login ####################//
	public function Fb_gm_login($email_id,$name,$gcm_key,$mobile_type,$login_type)
	
	{

        $user_id ="";
        if ($login_type = "1") {
            $login_mode = "fb_login";
            $signup_type = "Fb_signup";
        } else {
            $login_mode = "gplus_login";
            $signup_type = "gplus_signup";
        }
        
        
		$sql = "SELECT * FROM user_master WHERE email_id ='".$email_id."' AND status='Y'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		if($user_result->num_rows()>0)
		{
			foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->id;
				  $login_count = $rows->login_count+1;
			}
			
				$update_sql = "UPDATE user_master SET last_login=NOW(),login_count='$login_count' WHERE id='$user_id'";
				$update_result = $this->db->query($update_sql);
				
				$activity_sql = "INSERT INTO user_activity (date,user_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $login_mode . "')";
    			$insert_activity = $this->db->query($activity_sql);
				
				$gcmQuery = "SELECT * FROM push_notification_master WHERE gcm_key like '%" .$gcm_key. "%' LIMIT 1";
				$gcm_result = $this->db->query($gcmQuery);
				$gcm_ress = $gcm_result->result();
				
						if($gcm_result->num_rows()==0)
						{
							$sQuery = "INSERT INTO push_notification_master (user_id,gcm_key,mobile_type) VALUES ('". $user_id . "','". $gcm_key . "','". $mobile_type . "')";
							$update_gcm = $this->db->query($sQuery);
						}
						
		} else {
				
				$sQuery = "INSERT INTO user_master (email_id,user_role,email_verify,status) VALUES ('". $email_id . "','3','Y','Y')";
				$insert_user = $this->db->query($sQuery);
				$user_id = $this->db->insert_id(); 
				
				$suserQuery = "INSERT INTO user_details (user_id,name,newsletter_status,referal_code) VALUES ('". $user_id . "','". $name . "','N','HEYLA123')";
				$insert_user_details = $this->db->query($suserQuery);
				
    			$activity_sql = "INSERT INTO user_activity (date,user_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $signup_type . "')";
    			$insert_activity = $this->db->query($activity_sql);
    			
    			$sQuery = "INSERT INTO push_notification_master (user_id,gcm_key,mobile_type) VALUES ('". $user_id . "','". $gcm_key . "','". $mobile_type . "')";
				$update_gcm = $this->db->query($sQuery);
							
    			//$login_count = '0';
		}
		
		if ( $user_id != "") {
		    
		    $sql = "SELECT A.id as userid, A.user_name, A.mobile_no, A.email_id, A.email_verify, A.login_count, A.user_role, B.name, B.birthdate, B.gender, B.occupation, B.address_line1, B.address_line2, B.address_line3, B.country_id, B. state_id, B.city_id, B.zip, B.user_picture, B.newsletter_status, B.referal_code, C.user_role_name FROM user_master A, user_details B, user_role_master C WHERE A.id=B.user_id AND A.user_role = C.id AND A.id ='".$user_id."'";
			$user_result = $this->db->query($sql);
			$ress = $user_result->result();
			
			if($user_result->num_rows()>0)
			{
			    foreach ($user_result->result() as $rows)
    			{
    				  $user_picture = $rows->user_picture;
    				  $country_id = $rows->country_id;
    				  $state_id = $rows->state_id;
    				  $city_id = $rows->city_id;
    			}
			  
			    if ($user_picture != ''){
			        $picture_url = base_url().'assets/users/profile/'.$user_picture;
			    }else {
			         $picture_url = '';
			    }

                $country_sql = "SELECT * FROM country_master WHERE id ='".$country_id."'";
        		$country_result = $this->db->query($country_sql);
        		if($country_result->num_rows()>0)
        		{
        			foreach ($country_result->result() as $rows)
        			{
        				  $country_name = $rows->country_name;
        			}
        		} else {
        		          $country_name ='';
        		}
             
                $state_sql = "SELECT * FROM state_master WHERE id ='".$state_id."'";
        		$state_result = $this->db->query($state_sql);
        		if($state_result->num_rows()>0)
        		{
        			foreach ($state_result->result() as $rows)
        			{
        				  $state_name = $rows->state_name;
        			}
        		} else {
        		          $state_name ='';
        		}
        		
        		$city_sql = "SELECT * FROM city_master WHERE id ='".$city_id."'";
        		$city_result = $this->db->query($city_sql);
        		if($city_result->num_rows()>0)
        		{
        			foreach ($city_result->result() as $rows)
        			{
        				  $city_name = $rows->city_name;
        			}
        		} else {
        		          $city_name ='';
        		}
        		
				$userData  = array(
							"user_id" => $ress[0]->userid,
							"user_name" => $ress[0]->user_name,
							"mobile_no" => $ress[0]->mobile_no,
							"email_id" => $ress[0]->email_id,
							"full_name" => $ress[0]->name,
							"birth_date" => $ress[0]->birthdate,
							"gender" => $ress[0]->gender,
							"occupation" => $ress[0]->occupation,
							"address_line_1" => $ress[0]->address_line1,
							"address_line_2" => $ress[0]->address_line2,
							"address_line_3" => $ress[0]->address_line3,
							"country_id" => $ress[0]->country_id,
							"country_name" => $country_name,
							"state_id" => $ress[0]->state_id,
							"state_name" => $state_name,
							"city_id" => $ress[0]->city_id,
							"city_name" => $city_name,
							"zip" => $ress[0]->zip,
							"picture_url" => $picture_url,
							"newsletter_status" => $ress[0]->newsletter_status,
							"email_verify_status" => $ress[0]->email_verify,
							"user_role" => $ress[0]->user_role,
							"user_role_name" => $ress[0]->user_role_name,
							"referal_code" => $ress[0]->referal_code
				);
			}
					$response = array("status" => "Success", "msg" => "Login Successfully", "userData" => $userData);
					return $response;
		} else {
			
					$response = array("status" => "Error", "msg" => "Invalid login");
					return $response;
		}
 		
	}
	
//#################### Facebook and Gmail Login End ####################//


//#################### Guest Login ####################//
	public function Guest_login($unique_id,$gcm_key,$mobile_type)
	{
	    $user_id = "";

	    $sql = "SELECT * FROM guest_user_master WHERE unique_id ='".$unique_id."'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		
		if($user_result->num_rows()>0)
		{
			foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->id;
			}
		} 

    		if ( $user_id != "") {
    
    			$sQuery = "DELETE FROM guest_user_master WHERE id  = '" .$user_id. "'";
    			$delete_user = $this->db->query($sQuery);
    			
    			$sQuery = "DELETE FROM guest_user_preference WHERE user_id  = '" .$user_id. "'";
    			$delete_preference = $this->db->query($sQuery);	
    			
    		} 
		
			$sQuery = "INSERT INTO guest_user_master (unique_id,gcm_key,login_type) VALUES ('". $unique_id . "','". $gcm_key . "','". $mobile_type . "')";
			$insert_user = $this->db->query($sQuery);
			$nuser_id = $this->db->insert_id(); 
			
			$sql = "SELECT * FROM guest_user_master WHERE id ='".$nuser_id."'";
			$user_result = $this->db->query($sql);
			$ress = $user_result->result();
			
			if($user_result->num_rows()>0)
			{
				$userData  = array(
						"user_id" => $ress[0]->id
				);
			}

			$response = array("status" => "Success", "msg" => "Guest Login Successfully", "userData" => $userData);
			return $response;

	}
	
	
//#################### Guest Login End ####################//


//#################### User Signup ####################//
	public function User_signup($email_id,$mobile_no,$password,$gcm_key,$mobile_type)
	{
	    $user_id = "";
        $login_type = "normal_signup";
        
	    $sql = "SELECT * FROM user_master WHERE email_id ='".$email_id."' OR mobile_no = '".$mobile_no."'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		
		if($user_result->num_rows() == 0)
		{
		    $digits = 4;
			$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		    $encrypt_email = base64_encode($email_id);
		    
			$sQuery = "INSERT INTO user_master (email_id,mobile_no,password,user_role,email_verify,mobile_otp,mobile_verify,status,created_at) VALUES ('". $email_id . "','". $mobile_no . "','". md5($password) . "','3','N','". $OTP . "','N','Y',now())";
			$insert_user = $this->db->query($sQuery);
			$user_id = $this->db->insert_id(); 

			$suserQuery = "INSERT INTO user_details (user_id,newsletter_status,referal_code) VALUES ('". $user_id . "','N','HEYLA123')";
			$insert_user_details = $this->db->query($suserQuery);
				
            $activity_sql = "INSERT INTO user_activity (date,user_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $login_type . "')";
			$insert_activity = $this->db->query($activity_sql);
    			
            $gcmQuery = "SELECT * FROM push_notification_master WHERE gcm_key like '%" .$gcm_key. "%' LIMIT 1";
			$gcm_result = $this->db->query($gcmQuery);
			$gcm_ress = $gcm_result->result();
			
					if($gcm_result->num_rows()==0)
					{
						$sQuery = "INSERT INTO push_notification_master (user_id,gcm_key,mobile_type) VALUES ('". $user_id . "','". $gcm_key . "','". $mobile_type . "')";
						$update_gcm = $this->db->query($sQuery);
					}
					
			
			$mobile_message = 'Verify OTP :'. $OTP;
            
            $subject = "Heyla App - Email Verification";
            $email_message = 'Thanking for Registering with Heyla App <br>To allow us to confirm the validity of your email address, <a href="'. base_url().'home/emailverfiy/'.$encrypt_email.'" target="_blank" style="background-color: #478ECC; font-size:15px; font-weight: bold; padding: 10px; text-decoration: none; color: #fff; border-radius: 5px;">Click this verification link.</a><br><br><br>';

            $this->sendSMS($mobile_no,$mobile_message);
            $this->sendMail($email_id,$subject,$email_message);
            
			$response = array("status" => "Success", "msg" => "Signup Successfully");
		} else {
		    $response = array("status" => "Error", "msg" => "User Already Register");
		}
	    return $response;
	}
	
	
//#################### User Signup End ####################//


//#################### Mobile Verification ####################//
	public function Mobile_verify($mobile_no,$OTP)
	{
	    $user_id = "";

	    $sql = "SELECT * FROM user_master WHERE mobile_no = '".$mobile_no."' AND mobile_otp = '".$OTP."'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		
		if($user_result->num_rows() != 0)
		{
            foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->id;
			}
			
			$update_sql = "UPDATE user_master SET mobile_verify = 'Y' WHERE id='$user_id'";
			$update_result = $this->db->query($update_sql);
						
			$response = array("status" => "Success", "msg" => "Verification Successfully","user_id"=>$user_id);
		} else {
		    $response = array("status" => "Error", "msg" => "Verification Code or Mobile Number Error");
		}
	    return $response;
	}
	

//#################### Mobile Verification End ####################//


//#################### Resend OTP ####################//
	public function Resend_OTP($mobile_no)
	{
	    $user_id = "";

	    $sql = "SELECT * FROM user_master WHERE mobile_no = '".$mobile_no."'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		
		if($user_result->num_rows() != 0)
		{
            foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->id;
				  $OTP = $rows->mobile_otp;
			}
			
			$mobile_message = 'Verify OTP :'. $OTP;
            $this->sendSMS($mobile_no,$mobile_message);
            
			$response = array("status" => "Success", "msg" => "OTP Send Successfully");
		} else {
		    $response = array("status" => "Error", "msg" => "OTP Send Error");
		}
	    return $response;
	}
	
	
//#################### Resend OTP End ####################//


//#################### Update Mobile ####################//
	public function Update_mobile($old_mobile_no,$new_mobile_no)
	{
	    $user_id = "";

        $mobile_sql = "SELECT * FROM user_master WHERE mobile_no = '".$new_mobile_no."'";
		$mobile_result = $this->db->query($mobile_sql);
		
		if($mobile_result->num_rows() == 0)
		{
    	    $sql = "SELECT * FROM user_master WHERE mobile_no = '".$old_mobile_no."'";
    		$user_result = $this->db->query($sql);
    		$ress = $user_result->result();
    		
    		if($user_result->num_rows() != 0)
    		{
                foreach ($user_result->result() as $rows)
    			{
    				  $user_id = $rows->id;
    			}
    			
    			$digits = 4;
    			$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    			
    			$update_sql = "UPDATE user_master SET mobile_no = '$new_mobile_no',mobile_otp='$OTP',mobile_verify='N' WHERE id='$user_id'";
    			$update_result = $this->db->query($update_sql);
    			
    		
    			$mobile_message = 'Verify OTP :'. $OTP;
                $this->sendSMS($new_mobile_no,$mobile_message);
                
    			$response = array("status" => "Success", "msg" => "Mobile Updated Successfully");
    		} else {
    		    $response = array("status" => "Error", "msg" => "Old Mobile Number Error");
    		}
		} else {
		    $response = array("status" => "Error", "msg" => "Mobile Number Already Exist");
		}
	    return $response;
	}
	
	
//#################### Update Mobile End ####################//

//#################### Update Email ####################//
	public function Update_email($old_email_id ,$new_email_id )
	{
	    $user_id = "";
		$encrypt_email = base64_encode($new_email_id);

        $mobile_sql = "SELECT * FROM user_master WHERE email_id  = '".$new_email_id."'";
		$mobile_result = $this->db->query($mobile_sql);
		
		if($mobile_result->num_rows() == 0)
		{
    	    $sql = "SELECT * FROM user_master WHERE email_id = '".$old_email_id."'";
    		$user_result = $this->db->query($sql);
    		$ress = $user_result->result();
    		
    		if($user_result->num_rows() != 0)
    		{
                foreach ($user_result->result() as $rows)
    			{
    				  $user_id = $rows->id;
    			}

    			$update_sql = "UPDATE user_master SET email_id = '$new_email_id',email_verify ='N' WHERE id='$user_id'";
    			$update_result = $this->db->query($update_sql);
    			
				 $subject = "Heyla App - Email Verification";
            	$email_message = 'Thanking for Registering with Heyla App <br>To allow us to confirm the validity of your email address, <a href="'. base_url().'home/emailverfiy/'.$encrypt_email.'" target="_blank" style="background-color: #478ECC; font-size:15px; font-weight: bold; padding: 10px; text-decoration: none; color: #fff; border-radius: 5px;">Click this verification link.</a><br><br><br>';

	            $this->sendMail($email_id,$subject,$email_message);

                
    			$response = array("status" => "Success", "msg" => "Email Updated Successfully");
    		} else {
    		    $response = array("status" => "Error", "msg" => "Old Email id Error");
    		}
		} else {
		    $response = array("status" => "Error", "msg" => "Email id Already Exist");
		}
	    return $response;
	}
	
	
//#################### Update Email End ####################//



//#################### Update Username ####################//
	public function Update_username($old_user_name,$new_user_name  )
	{
	    $user_id = "";

        $mobile_sql = "SELECT * FROM user_master WHERE user_name   = '".$new_user_name."'";
		$mobile_result = $this->db->query($mobile_sql);
		
		if($mobile_result->num_rows() == 0)
		{
    	    $sql = "SELECT * FROM user_master WHERE user_name = '".$old_user_name."'";
    		$user_result = $this->db->query($sql);
    		$ress = $user_result->result();
    		
    		if($user_result->num_rows() != 0)
    		{
                foreach ($user_result->result() as $rows)
    			{
    				  $user_id = $rows->id;
    			}

    			$update_sql = "UPDATE user_master SET user_name = '$new_user_name' WHERE id='$user_id'";
    			$update_result = $this->db->query($update_sql);
    			
    			$response = array("status" => "Success", "msg" => "Username Updated Successfully");
    		} else {
    		    $response = array("status" => "Error", "msg" => "Old Username Error");
    		}
		} else {
		    $response = array("status" => "Error", "msg" => "Username Already Exist");
		}
	    return $response;
	}
	
	
//#################### Update Username End ####################//


//#################### Profile Pic Update ####################//
	public function Update_profilepic($user_id,$userFileName)
	{
            $update_sql= "UPDATE user_details SET user_picture='$userFileName' WHERE user_id='$user_id'";
			$update_result = $this->db->query($update_sql);
			$picture_url = base_url().'assets/users/profile/'.$userFileName;
			
			$response = array("status" => "success", "msg" => "Profile Picture Updated","picture_url" =>$picture_url);
			return $response;
	}
//#################### Profile Pic Update End ####################//


//#################### Profile Update ####################//
public function Profile_update($user_id,$full_name,$user_name,$date_of_birth,$gender,$occupation,$address_line_1,$address_line_2,$address_line_3,$country_id,$state_id,$city_id,$zip_code,$news_letter)
	{
 			$sql = "SELECT * FROM user_master WHERE user_name = '".$user_name."'";
    		$user_result = $this->db->query($sql);
    		$ress = $user_result->result();
    		
    		if($user_result->num_rows() == 0)
    		{
				$update_query= "UPDATE user_master SET `user_name` ='$user_name' WHERE id='$user_id'";
				$update_query_result = $this->db->query($update_query);
				
				$update_sql= "UPDATE user_details SET `name` ='$full_name', `birthdate` ='$date_of_birth', `gender` ='$gender', `occupation` ='$occupation', `address_line1` ='$address_line_1', `address_line2` ='$address_line_2', `address_line3` ='$address_line_3', `country_id` ='$country_id', `state_id` ='$state_id', `city_id` ='$city_id', `zip` ='$zip_code', `newsletter_status` ='$news_letter' WHERE user_id='$user_id'";
				$update_result = $this->db->query($update_sql);
				
				$response = array("status" => "success", "msg" => "Profile Updated");
			} else {
				$response = array("status" => "error", "msg" => "Username Already Exist");
			}
			return $response;
	}
//#################### Profile Update End ####################//



//#################### Forgot Password ####################//
	public function Forgot_password($user_name)
	{
	        $user_id = "";
	        
			$digits = 4;
			$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

    		$sql = "SELECT * FROM user_master WHERE email_id ='".$user_name."' AND email_verify = 'Y' AND status='Y'";
    		$user_result = $this->db->query($sql);
    		$ress = $user_result->result();
    		if($user_result->num_rows()>0)
    		{
    			foreach ($user_result->result() as $rows)
    			{
    				  $user_id = $rows->id;
    				  $email_id = $rows->email_id;
    			}
                $encrypt_email = base64_encode($email_id);

        		$subject = "Heyla App - Forgot Password URL";
        		$email_message = 'Please Click the Forgot Password link. <a href="'. base_url().'home/reset/'.$encrypt_email.'" target="_blank" style="background-color: #478ECC; font-size:15px; font-weight: bold; padding: 10px; text-decoration: none; color: #fff; border-radius: 5px;">Forgot Password</a><br><br><br>';
                //$email_message = "<a href='#'> Email Verfication URL </a>";
                $this->sendMail($email_id,$subject,$email_message);
                $sType = "Email";
    		} 

    		$sql = "SELECT * FROM user_master WHERE mobile_no ='".$user_name."' AND mobile_verify ='Y' AND status='Y'";
    		$user_result = $this->db->query($sql);
    		$ress = $user_result->result();
    		if($user_result->num_rows()>0)
    		{
    			foreach ($user_result->result() as $rows)
    			{
    				  $user_id = $rows->id;
    				  $mobile_no = $rows->mobile_no;
    			}
    			
    			$update_sql = "UPDATE user_master SET mobile_otp = '$OTP', updated_by = '$user_id', updated_at =NOW() WHERE id='$user_id'";
			    $update_result = $this->db->query($update_sql);
			    
        		$mobile_message = 'Verify OTP :'. $OTP;
                $this->sendSMS($mobile_no,$mobile_message);
                $sType = "Mobile";
    		} 

	        if ( $user_id != "") {
                $response = array("status" => "success", "msg" => "Forgot Password", "type"=>$sType);
			} else {
				$response = array("status" => "error", "msg" => "User Not Found");
			}
			return $response;
	}
//#################### Forgot Password End ####################//


//#################### Forgot Password OTP Check ####################//
	public function Forgot_password_otp($mobile_no,$OTP)
	{
	    $user_id = "";

	    $sql = "SELECT * FROM user_master WHERE mobile_no = '".$mobile_no."' AND mobile_otp = '".$OTP."'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		
		if($user_result->num_rows() != 0)
		{
            foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->id;
			}
	
			$response = array("status" => "Success", "msg" => "Verification Successfully","User_id"=>$user_id);
		} else {
		    $response = array("status" => "Error", "msg" => "Verification Code or Mobile Number Error");
		}
	    return $response;
	}
	
//#################### Forgot Password OTP Check End ####################//


//#################### Reset Password ####################//
	public function Reset_password($user_id,$password)
	{
			$update_sql = "UPDATE user_master SET password = md5('$password'),updated_at=NOW() WHERE id='$user_id'";
			$update_result = $this->db->query($update_sql);

			$response = array("status" => "success", "msg" => "Password Updated");
			return $response;
	}
//#################### Reset Password End ####################//


//#################### Select Country ####################//
	public function Select_country($user_id)
	{
	        $country_query = "SELECT id,country_name from country_master";
			$country_res = $this->db->query($country_query);

			 if($country_res->num_rows()>0){
			     	$country_result= $country_res->result();
			     	$response = array("status" => "success", "msg" => "View Countries","Countries"=>$country_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Countries not found");
			}  
						
			return $response;
	}
//#################### Select Country End ####################//

//#################### Select State ####################//
	public function Select_state($country_id)
	{
	        $state_query = "SELECT id,state_name from state_master WHERE country_id ='$country_id'";
			$state_res = $this->db->query($state_query);

			 if($state_res->num_rows()>0){
			     	$state_result= $state_res->result();
			     	$response = array("status" => "success", "msg" => "View States","States"=>$state_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "States not found");
			}  
						
			return $response;
	}
//#################### Select State End ####################//


//#################### Select City ####################//
	public function Select_city($country_id,$state_id)
	{
	        $city_query = "SELECT id,city_name from city_master WHERE country_id ='$country_id' AND state_id = '$state_id'";
			$city_res = $this->db->query($city_query);

			 if($city_res->num_rows()>0){
			     	$city_result= $city_res->result();
			     	$response = array("status" => "success", "msg" => "View Cities","Cities"=>$city_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Cities not found");
			}  

			return $response;
	}
//#################### Select State End ####################//


//#################### Select City ####################//
	public function Select_allcity($user_id)
	{
	        $city_query = "SELECT id,city_name,city_latitude,city_longitude from city_master WHERE event_status = 'Y'";
			$city_res = $this->db->query($city_query);

			 if($city_res->num_rows()>0){
			     	$city_result= $city_res->result();
			     	$response = array("status" => "success", "msg" => "View Cities","Cities"=>$city_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Cities not found");
			}  

			return $response;
	}
//#################### Select State End ####################//

//#################### View Category ####################//
	public function View_preferrence($user_id)
	{
	        $category_query = "SELECT id,category_name,category_image from category_master WHERE status ='Y' ORDER BY order_by";
			$category_res = $this->db->query($category_query);

			 if($category_res->num_rows()>0){
			     	$category_result= $category_res->result();
			     	$response = array("status" => "success", "msg" => "View Categories","Categories"=>$category_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Categories not found");
			}  
						
			return $response;
	}
//#################### View Category End ####################//

//#################### Add User Category ####################//
	public function Add_preferrence($user_id,$category_ids)
	{
        $category_ids = explode(',' , $category_ids);
        foreach($category_ids as $key) {
    	    $sQuery = "INSERT INTO user_preference (user_id,category_id) VALUES ('". $user_id . "','". $key . "')";
			$ins_Query = $this->db->query($sQuery);
        }
        $response = array("status" => "success", "msg" => "Preferences Added");

		return $response;
	}
//#################### User Category End ####################//

//#################### Add User Category ####################//
	public function Update_preferrence($user_id,$category_ids)
	{
        $category_ids = explode(',' , $category_ids);
        
        $prefQuery = "SELECT * FROM user_preference WHERE user_id = '$user_id' LIMIT 1";
		$pref_result = $this->db->query($prefQuery);
		$pref_ress = $pref_result->result();
		
			if($pref_result->num_rows()>0)
			{
			    $sQuery = "DELETE FROM user_preference WHERE user_id = '" .$user_id. "'";
    			$del_Query = $this->db->query($sQuery);
    			
    			foreach($category_ids as $key) {
            	    $sQuery = "INSERT INTO user_preference (user_id,category_id) VALUES ('". $user_id . "','". $key . "')";
        			$ins_Query = $this->db->query($sQuery);
                }
			}
			
		$response = array("status" => "success", "msg" => "Preference Updated");	
		
		return $response;
	}
//#################### User Category End ####################//

//#################### View User Category ####################//
	public function User_preferrence($user_id)
	{
	        $category_query = "SELECT A.id,A.category_name,B.user_id,B.category_id from category_master A, user_preference B WHERE A.id=B.category_id AND B.user_id ='$user_id' AND status ='Y' ORDER BY order_by";
			$category_res = $this->db->query($category_query);

			 if($category_res->num_rows()>0){
			     	$category_result= $category_res->result();
			     	$response = array("status" => "success", "msg" => "View Categories","Categories"=>$category_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Categories not found");
			}  
						
			return $response;
	}
//#################### User Category End ####################//

//#################### Add Wishlist Master ####################//
	public function Add_wishlistmaster($user_id,$title)
	{
            $wishlistQuery = "SELECT * FROM user_wish_list_master WHERE user_id = '$user_id' AND title like '%" .$title. "%' LIMIT 1";
			$wishlist_result = $this->db->query($wishlistQuery);
			$wishlist_ress = $wishlist_result->result();
			
				if($wishlist_result->num_rows()==0)
				{
					$sQuery = "INSERT INTO user_wish_list_master (user_id,title) VALUES ('". $user_id . "','". $title . "')";
					$update_gcm = $this->db->query($sQuery);
					$response = array("status" => "success", "msg" => "Title Added");
				} else {
				    $response = array("status" => "error", "msg" => "Already Added");
				}
        
			return $response;
	}
//#################### Wishlist Master End ####################//

//#################### Update Wishlist Master ####################//
	public function Update_wishlistmaster($user_id,$wishlist_id,$title)
	{
	            $update_sql = "UPDATE user_wish_list_master SET title = '$title' WHERE user_id='$user_id' AND id='$wishlist_id'";
			    $update_result = $this->db->query($update_sql);

				$response = array("status" => "success", "msg" => "Title Updated");

			return $response;
	}
//#################### Update Wishlist Master End ####################//

//#################### View Wishlist ####################//
	public function View_wishlistmaster($user_id)
	{
	        $wishlist_query = "SELECT * from user_wish_list_master WHERE user_id ='$user_id'";
			$wishlist_res = $this->db->query($wishlist_query);

			 if($wishlist_res->num_rows()>0){
			     	$wishlist_result= $wishlist_res->result();
			     	$response = array("status" => "success", "msg" => "View Wishlist Master","WishlistMaster"=>$wishlist_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Wishlist Master not found");
			}  
						
			return $response;
	}
//#################### User Category End ####################//

//#################### Delete Wishlist Master ####################//
	public function Delete_wishlistmaster($user_id,$wishlist_id)
	{
	    
	        	$sQuery = "DELETE FROM user_wish_list WHERE wish_list_id   = '" .$wishlist_id. "'";
    			$delete_master = $this->db->query($sQuery);
    			
    			$sQuery = "DELETE FROM user_wish_list_master WHERE user_id = '" .$user_id. "' AND id  = '" .$wishlist_id. "'";
    			$delete_list = $this->db->query($sQuery);

				$response = array("status" => "success", "msg" => "Title Deleted");

			return $response;
	}
//#################### Delete Wishlist Master End ####################//


//#################### Add Wishlist ####################//
	public function Add_wishlist($user_id,$wishlist_master_id,$event_id)
	{
            $wishlistQuery = "SELECT * FROM user_wish_list WHERE wish_list_id  = '$wishlist_master_id' AND event_id = '$event_id'  LIMIT 1";
			$wishlist_result = $this->db->query($wishlistQuery);
			$wishlist_ress = $wishlist_result->result();
			
				if($wishlist_result->num_rows()==0)
				{
					$sQuery = "INSERT INTO user_wish_list (wish_list_id ,event_id) VALUES ('". $wishlist_master_id . "','". $event_id . "')";
					$update_gcm = $this->db->query($sQuery);
					$response = array("status" => "success", "msg" => "Wishlist Added");
				} else {
				    $response = array("status" => "error", "msg" => "Already Added");
				}

			return $response;
	}
//#################### Wishlist End ####################//


//#################### View Wishlist ####################//
	public function View_wishlist($user_id,$wishlist_master_id)
	{
	        $wishlist_query = "SELECT * FROM user_wish_list A,events B WHERE A.wish_list_id  = '$wishlist_master_id' AND A.event_id = B.id";
			$wishlist_res = $this->db->query($wishlist_query);

			 if($wishlist_res->num_rows()>0){
			     	$wishlist_result= $wishlist_res->result();
			     	$response = array("status" => "success", "msg" => "View Wishlist","Wishlist"=>$wishlist_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Wishlist not found");
			}  
						
			return $response;
	}
//#################### User Wishlist End ####################//


//#################### Delete Wishlist ####################//
	public function Delete_wishlist($user_id,$wishlist_id)
	{
            	$sQuery = "DELETE FROM user_wish_list WHERE id = '" .$wishlist_id. "'";
    			$delete_list = $this->db->query($sQuery);

				$response = array("status" => "success", "msg" => "Wishlist Deleted");

			return $response;
	}
//#################### Delete Wishlist ####################//

//#################### View Events ####################//
	public function View_events($event_type,$city,$user_id,$preferrence)
	{
	    $current_date = date("Y-m-d");
	    
        $city_query = "SELECT * FROM city_master WHERE city_name like '%" .$city. "%' LIMIT 1";
		$city_res = $this->db->query($city_query);
		 if($city_res->num_rows()>0){
		    foreach ($city_res->result() as $rows)
			{
				  $city_id  = $rows->id ;
			}
		 }
	    if ($event_type == 'General'){
	            $event_query = "SELECT * FROM events WHERE hotspot_status = 'N' AND end_date>= '$current_date' AND category_id IN ($preferrence) AND event_city = '$city_id'";
	    } 
	    if ($event_type == 'Hotspot'){
	            $event_query = "SELECT * FROM events WHERE hotspot_status = 'Y' AND end_date>= '$current_date' AND category_id IN ($preferrence) AND event_city = '$city_id'";
	    } 
	    if ($event_type == 'Popularity'){
	            $event_query = "SELECT COUNT(`event_id`) as popularity,ep.event_id,ev.* FROM event_popularity ep
	                            INNER JOIN events AS ev ON ep.event_id = ev.id 
	                            WHERE ev.hotspot_status = 'N' AND ev.end_date>= '$current_date' AND ev.category_id IN ($preferrence) AND ev.event_city = '$city_id'
                                GROUP by ep.event_id ORDER by popularity DESC";
	    } 
	    //echo $event_query;
		$event_res = $this->db->query($event_query);

			 if($event_res->num_rows()>0){
			     	$event_result= $event_res->result();
			     	$response = array("status" => "success", "msg" => "View Events","Eventdetails"=>$event_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Events not found");
			}  
						
			return $response;
	}
//#################### View Events End ###############//

//#################### View Adv Events ####################//
	public function View_adv_events($city,$user_id,$preferrence)
	{
	    $current_date = date("Y-m-d");
	    
        $city_query = "SELECT * FROM city_master WHERE city_name like '%" .$city. "%' LIMIT 1";
		$city_res = $this->db->query($city_query);
		 if($city_res->num_rows()>0){
		    foreach ($city_res->result() as $rows)
			{
				  $city_id  = $rows->id ;
			}
		 }
		    $event_query = "SELECT aeh.event_id,aeh.date_from,aeh.date_to,ev.* from adv_event_history aeh
		                    INNER JOIN events AS ev ON aeh.event_id = ev.id 
		                    WHERE aeh.date_to >= '$current_date' AND aeh.category_id IN ($preferrence) AND ev.event_city = '$city_id' AND aeh.status ='Y' 
		                    GROUP by aeh.event_id";
    	    //echo $event_query;
		    $event_res = $this->db->query($event_query);

			 if($event_res->num_rows()>0){
			     	$event_result= $event_res->result();
			     	$response = array("status" => "success", "msg" => "View Adv Events","Eventdetails"=>$event_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Adv Events not found");
			}  
						
			return $response;
	}
//#################### Adv Events End ###############//

//#################### View Event Images ####################//
	public function View_eventimages($event_id)
	{
	    $event_query = "SELECT event_image FROM event_images WHERE event_id = '$event_id'";
		$event_res = $this->db->query($event_query);

			 if($event_res->num_rows()>0){
			     	$event_result= $event_res->result();
			     	$response = array("status" => "success", "msg" => "View Event Images","Eventgallery"=>$event_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Gallery not found");
			}  
						
			return $response;
	}
//#################### View Event Images End ###############//

//#################### Booking history ####################//
	public function Booking_history($user_id)
	{
	        $booking_query = "SELECT * FROM booking_history A,events B WHERE A.user_id  = '$user_id' AND A.event_id = B.id";
			$booking_res = $this->db->query($booking_query);

			 if($booking_res->num_rows()>0){
			     	$booking_result= $booking_res->result();
			     	$response = array("status" => "success", "msg" => "View Booking History","Bookinghistory"=>$booking_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Booking not found");
			}  
						
			return $response;
	}
//#################### Booking history End ###############//

//#################### Booking details###############//
	public function Booking_details($booking_id)
	{
	        $booking_query = "SELECT * FROM booking_history A,events B WHERE A.id  = '$booking_id' AND A.event_id = B.id";
			$booking_res = $this->db->query($booking_query);
			$booking_result= $booking_res->result();

			 if($booking_res->num_rows()>0){

			    foreach ($booking_res->result() as $rows)
    			{
    				  $order_id  = $rows->order_id ;
    			}
    			
    			$attendees_query = "SELECT * FROM booking_event_attendees WHERE  order_id  ='$order_id'";
			    $attendees_res = $this->db->query($attendees_query);
			    $attendees_result= $attendees_res->result();
    			
			     	$response = array("status" => "success", "msg" => "View Booking History","Bookingdetails"=>$booking_result,"Bookingattendees"=>$attendees_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Booking not found");
			}  
						
			return $response;
	}
//#################### Booking details End ###############//

//#################### Booking Plan Dates###############//
	public function Booking_plandates($event_id)
	{
    		$date_query = "SELECT show_date FROM booking_plan_timing WHERE event_id  = '$event_id' GROUP BY show_date";
			$date_res = $this->db->query($date_query);
			$date_result= $date_res->result();
    			
    		if($date_res->num_rows()>0){
			     	$response = array("status" => "success", "msg" => "View Booking Dates","Eventdates"=>$date_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Booking Timings not found");
			}  
						
			return $response;
	}
//#################### Booking Plan Dates End ###############//

//#################### Booking Plan Times ###############//
	public function Booking_plantimes($event_id,$show_date)
	{
    		$time_query = "SELECT show_time FROM booking_plan_timing WHERE event_id  = '$event_id' AND show_date='$show_date' GROUP BY show_time";
			$time_res = $this->db->query($time_query);
			$time_result= $time_res->result();
    			
    		if($time_res->num_rows()>0){
			     	$response = array("status" => "success", "msg" => "View Booking Timings","Eventtiming"=>$time_result);
				 
			}else{
			        $response = array("status" => "error", "msg" => "Booking Timings not found");
			}  
						
			return $response;
	}
//#################### Booking Plan Times End ###############//

//#################### Booking details###############//
	public function Booking_plans($event_id,$show_date,$show_time)
	{
	        $plan_query = "SELECT B.plan_name,B.seat_rate,A.event_id,A.plan_id,A.show_date,A.show_time,A.seat_available FROM booking_plan_timing A,booking_plan B WHERE A.event_id  = '$event_id' AND show_date = '$show_date' AND show_time = '$show_time' AND A.seat_available>0 AND A.plan_id = B.id";
			$plan_res = $this->db->query($plan_query);
			$plan_result= $plan_res->result();

			 if($plan_res->num_rows()>0){
			     	$response = array("status" => "success", "msg" => "Booking Plans","Plandetails"=>$plan_result);
			}else{
			        $response = array("status" => "error", "msg" => "Plans not found");
			}  
						
			return $response;
	}
//#################### Booking details End ###############//

//#################### Event review ###############//
	public function Event_review($event_id)
	{
	        $review_query = "SELECT A.*,B.user_name FROM event_reviews A, user_master B WHERE A.event_id = '$event_id' AND A.status='Y' AND A.user_id=B.id ORDER by A.review_positive DESC";
			$review_res = $this->db->query($review_query);
			$review_result= $review_res->result();

			 if($review_res->num_rows()>0){
			     	$response = array("status" => "success", "msg" => "View Reviews","Reviewdetails"=>$review_result);
			}else{
			        $response = array("status" => "error", "msg" => "Reviews not found");
			}  
						
			return $response;
	}
//#################### Event review End ###############//

//#################### Event review photo ###############//
	public function Review_images($event_id,$review_id)
	{
	        $review_query = "SELECT photo FROM event_review_photos WHERE review_id = '$review_id'";
			$review_res = $this->db->query($review_query);
			$review_result= $review_res->result();

			 if($review_res->num_rows()>0){
			     	$response = array("status" => "success", "msg" => "View Review Images","Reviewphotos"=>$review_result);
			}else{
			        $response = array("status" => "error", "msg" => "Reviews Images not found");
			}  
						
			return $response;
	}
//#################### Event review photo End ###############//
}

?>
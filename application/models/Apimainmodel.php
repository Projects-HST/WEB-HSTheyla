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


//#################### Email ####################//

	public function sendNotification($gcm_key,$Title,$Message)
	{
	        $gcm_key = array($gcm_key);
			$data = array
			(
				'message' 	=> $Message,
				'title'		=> $Title,
				'vibrate'	=> 1,
				'sound'		=> 1
		//		'largeIcon'	=> 'http://happysanz.net/testing/assets/students/profile/236832.png'
		//		'smallIcon'	=> 'small_icon'
			);
			
			// Insert real GCM API key from the Google APIs Console   
			$apiKey = 'AAAADRDlvEI:APA91bFi-gSDCTCnCRv1kfRd8AmWu0jUkeBQ0UfILrUq1-asMkBSMlwamN6iGtEQs72no-g6Nw0lO5h4bpN0q7JCQkuTYsdPnM1yfilwxYcKerhsThCwt10cQUMKrBrQM2B3U3QaYbWQ';
			// Set POST request body
			$post = array(
						'registration_ids'  => $gcm_key,
						'data'              => $data,
						 );
			// Set CURL request headers 
			$headers = array( 
						'Authorization: key=' . $apiKey,
						'Content-Type: application/json'
							);
			// Initialize curl handle       
			$ch = curl_init();
			// Set URL to GCM push endpoint     
			curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
			// Set request method to POST       
			curl_setopt($ch, CURLOPT_POST, true);
			// Set custom request headers       
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			// Get the response back as string instead of printing it       
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Set JSON post data
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
			// Actually send the request    
			$result = curl_exec($ch);
		
		
			// Handle errors
			if (curl_errno($ch)) {
				//echo 'GCM error: ' . curl_error($ch);
			}
			// Close curl handle
			curl_close($ch);
			
			// Debug GCM response       
			//echo $result;	
	}

//#################### Notification End ####################//


//#################### SMS ####################//

	public function sendSMS($Phoneno,$Message)
	{
		$textmsg = urlencode($Message);
		$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';
		$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';
		$api_params = $api_element.'&numbers='.$Phoneno.'&message='.$textmsg;
		$smsgatewaydata = $smsGatewayUrl.$api_params;
		$url = $smsgatewaydata;
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
	}

//#################### SMS End ####################//


//#################### Main Login ####################//
	public function Login($username,$password,$gcm_key,$mobile_type,$login_type)
	{
	    $user_id = "";
	    
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
			
			$sql = "SELECT A.id as user_id, A.user_name, A.mobile_no, A.email_id, A.email_verify, A.login_count, A.user_role, B.name, B.birthdate, B.gender, B.occupation, B.address_line1, B.address_line2, B.address_line3, B.country_id, B. state_id, B.city_id, B.zip, B.user_picture, B.newsletter_status, B.referal_code, C.user_role_name FROM user_master A, user_details B, user_role_master C WHERE A.id=B.user_id AND A.user_role = C.id AND A.id ='".$user_id."'";
			$user_result = $this->db->query($sql);
			$ress = $user_result->result();
			
			if($user_result->num_rows()>0)
			{
				$userData  = array(
							"user_id" => $ress[0]->user_id,
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
							"state_id" => $ress[0]->state_id,
							"city_id" => $ress[0]->city_id,
							"zip" => $ress[0]->zip,
							"user_picture" => $ress[0]->user_picture,
							"newsletter_status" => $ress[0]->newsletter_status,				
							"email_verify_status" => $ress[0]->email_verify,
							"user_role" => $ress[0]->user_role,
							"user_role_name" => $ress[0]->user_role_name,
							"referal_code" => $ress[0]->referal_code	
				);
			}
	
			$update_sql = "UPDATE user_master SET last_login=NOW(),login_count='$login_count' WHERE id='$user_id'";
			$update_result = $this->db->query($update_sql);
			
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
		} else {
				
				$sQuery = "INSERT INTO user_master (email_id,user_role,email_verify,status) VALUES ('". $email_id . "','3','Y','Y')";
				$insert_user = $this->db->query($sQuery);
				$user_id = $this->db->insert_id(); 
				
				$suserQuery = "INSERT INTO user_details (user_id,name,newsletter_status,referal_code) VALUES ('". $user_id . "','". $name . "','Y','HEYLA123')";
				$insert_user_details = $this->db->query($suserQuery);
				
				$login_count = '0';
		}
		
		
		if ( $user_id != "") {
		    
		    $sql = "SELECT A.id as user_id, A.user_name, A.mobile_no, A.email_id, A.email_verify, A.login_count, A.user_role, B.name, B.birthdate, B.gender, B.occupation, B.address_line1, B.address_line2, B.address_line3, B.country_id, B. state_id, B.city_id, B.zip, B.user_picture, B.newsletter_status, B.referal_code, C.user_role_name FROM user_master A, user_details B, user_role_master C WHERE A.id=B.user_id AND A.user_role = C.id AND A.id ='".$user_id."'";
			$user_result = $this->db->query($sql);
			$ress = $user_result->result();
			
			if($user_result->num_rows()>0)
			{
				$userData  = array(
							"user_id" => $ress[0]->user_id,
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
							"state_id" => $ress[0]->state_id,
							"city_id" => $ress[0]->city_id,
							"zip" => $ress[0]->zip,
							"user_picture" => $ress[0]->user_picture,
							"newsletter_status" => $ress[0]->newsletter_status,				
							"email_verify_status" => $ress[0]->email_verify,
							"user_role" => $ress[0]->user_role,
							"user_role_name" => $ress[0]->user_role_name,
							"referal_code" => $ress[0]->referal_code	
				);
			}

				$update_sql = "UPDATE user_master SET last_login=NOW(),login_count='$login_count' WHERE id='$user_id'";
				$update_result = $this->db->query($update_sql);
				
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
	
//#################### Facebook and Gmail Login End ####################//


//#################### Guest Login ####################//
	public function Guest_login($unique_id,$gcm_key,$login_type)
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
		
			$sQuery = "INSERT INTO guest_user_master (unique_id,gcm_key,login_type) VALUES ('". $unique_id . "','". $gcm_key . "','". $login_type . "')";
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
	public function User_signup($email_id,$mobile_no,$password,$gcm_key,$signup_type,$mobile_type)
	{
	    $user_id = "";

	    $sql = "SELECT * FROM user_master WHERE email_id ='".$email_id."' OR mobile_no = '".$mobile_no."'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		
		if($user_result->num_rows() == 0)
		{
		    $digits = 4;
			$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		    
			$sQuery = "INSERT INTO user_master (email_id,mobile_no,password,user_role,email_verify,mobile_otp,mobile_verify,status,created_at) VALUES ('". $email_id . "','". $mobile_no . "','". md5($password) . "','3','N','". $OTP . "','N','Y',now())";
			$insert_user = $this->db->query($sQuery);
			$user_id = $this->db->insert_id(); 

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
            $email_message = "<a href='#'> Email Verfication URL </a>";
            
            //$this->sendSMS($mobile_no,$mobile_message);
            $this->sendMail($email_id,$subject,$email_message);
            
			$response = array("status" => "Success", "msg" => "Signup Successfully");
		} else {
		    $response = array("status" => "Error", "msg" => "User Already Register");
		}
	    return $response;
	}
	
	
//#################### User Signup End ####################//


//#################### Mobile Verification ####################//
	public function Mobile_verify($mobile_no,$OTP,$request_mode)
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
						
			$response = array("status" => "Success", "msg" => "Verification Successfully");
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
            //$this->sendSMS($mobile_no,$mobile_message);
            
			$response = array("status" => "Success", "msg" => "OTP Send Successfully");
		} else {
		    $response = array("status" => "Error", "msg" => "OTP Send Error");
		}
	    return $response;
	}
	
	
//#################### Resend OTP End ####################//


//#################### Resend OTP ####################//
	public function Update_mobile($old_mobile_no,$new_mobile_no)
	{
	    $user_id = "";

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
            //$this->sendSMS($mobile_no,$mobile_message);
            
			$response = array("status" => "Success", "msg" => "Mobile Updated Successfully");
		} else {
		    $response = array("status" => "Error", "msg" => "Old Mobile Number Error");
		}
	    return $response;
	}
	
	
//#################### Mobile Verification End ####################//

//#################### Profile Pic Update ####################//
	public function updateProfilepic($user_id,$userFileName)
	{
            $update_sql= "UPDATE user_details SET user_picture='$userFileName' WHERE user_id='$user_id'";
			$update_result = $this->db->query($update_sql);
			
			$response = array("status" => "success", "msg" => "Profile Picture Updated");
			return $response;
	}
//#################### Profile Pic Update End ####################//


//#################### Profile Update ####################//
	public function Profile_update($user_id,$full_name,$user_name,$date_of_birth,$gender,$occupation,$address_line_1,$address_line_2,$address_line_3,$country_id,$state_id,$city_id,$zip_code,$news_letter)
	{
	    
	        $update_query= "UPDATE user_master SET `user_name` ='$user_name' WHERE id='$user_id'";
			$update_query_result = $this->db->query($update_query);
			
            $update_sql= "UPDATE user_details SET `name` ='$full_name', `birthdate` ='$date_of_birth', `gender` ='$gender', `occupation` ='$occupation', `address_line1` ='$address_line_1', `address_line2` ='$address_line_2', `address_line3` ='$address_line_3', `country_id` ='$country_id', `state_id` ='$state_id', `city_id` ='$city_id', `zip` ='$zip_code', `newsletter_status` ='$news_letter' WHERE user_id='$user_id'";
			$update_result = $this->db->query($update_sql);
			
			$response = array("status" => "success", "msg" => "Profile Updated");
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

        		$subject = "Heyla App - Forgot Password";
                $email_message = "<a href='#'> Email Verfication URL </a>";
                $this->sendMail($email_id,$subject,$email_message);

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
                //$this->sendSMS($mobile_no,$mobile_message);
    		} 

	        if ( $user_id != "") {
                $response = array("status" => "success", "msg" => "Forgot Password");
			} else {
				$response = array("status" => "error", "msg" => "User Not Found");
			}
			return $response;
	}
//#################### Forgot Password End ####################//


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
	        $city_query = "SELECT id,city_name,city_latitude,city_longitude from city_master WHERE country_id ='$country_id' AND state_id = '$state_id'";
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
	public function Add_preferrence($user_id,$category_id)
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

//#################### Add User Category ####################//
	public function Update_preferrence($user_id,$category_id)
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
}

?>
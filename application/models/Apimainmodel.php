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
		$headers .= 'From: Heyla App<hello@heylaapp.com>' . "\r\n";
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
					'http://heylaapp.com/assets/notification/images/events.jpg'
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
        $authKey = "242202ALE69fBMks5bbee06b";

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
            'authkey'=> $authKey,
            'mobiles'=> $mobileNumber,
            'message'=> $message,
            'sender'=> $senderId,
            'route'=> $route
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

//#################### OLD Seat check ####################//

	public function seatCheck($order_id,$number_of_seats)
	{
			$start = microtime(true);
            set_time_limit(10);

            for ($i = 0; $i <= 10; ++$i) {
    	        $order_query = "SELECT * FROM booking_history WHERE order_id = '$order_id' LIMIT 1";
    			$order_res = $this->db->query($order_query);
    			//$order_result= $plan_res->result();

    			if($order_res->num_rows()==0){
    			     time_sleep_until($start + $i + 1);

        			 if ($i=='10'){
    			        $update_seats = "UPDATE booking_plan_timing SET seat_available = seat_available+$number_of_seats WHERE id ='$plan_time_id'";
    		            $seatsupdate = $this->db->query($update_seats);
    		            $response = array("status" => "error", "msg" => "Time over");
    			    }
    			}

            }
	}

//#################### OLD Seat check End ####################//

//#################### Main Login ####################//
	public function Login($username,$password,$gcm_key,$mobile_type)
	{
	    $user_id = '';
	    $login_type = "normal_login";
	    $country_name = '';
	    $state_name = '';
	    $city_name = '';

		$sql = "SELECT * FROM user_master WHERE user_name ='".$username."' AND password = md5('".$password."') AND mobile_verify ='Y' AND email_verify ='Y' AND status='Y'";
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
					  $user_role = $rows->user_role;

					 if ($user_role =='2') {
							$organiser_sql = "SELECT * FROM organiser_request WHERE user_id  ='".$user_id."'";
							$organiser_result = $this->db->query($organiser_sql);
							$organiser_ress = $organiser_result->result();
							if($organiser_result->num_rows()>0)
							{
								foreach ($organiser_result->result() as $orgs)
    							{
									$req_status = $orgs->req_status;
								}
								if ($req_status =='Pending'){
									$event_organizer = 'P';
								}
								if($req_status =='Approved'){
									$event_organizer = 'Y';
								}
								if($req_status =='Rejected'){
									$event_organizer = 'R';
								}
							}
					  } else {
						  $event_organizer = 'N';
					  }
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
							"referal_code" => $ress[0]->referal_code,
							"user_login_count" => $ress[0]->login_count,
							"event_organizer" => $event_organizer
				);
			}

			$update_sql = "UPDATE user_master SET last_login=NOW(),login_count='$login_count' WHERE id='$user_id'";
			$update_result = $this->db->query($update_sql);

			$activity_sql = "INSERT INTO user_activity (date,user_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $login_type . "')";
			$insert_activity = $this->db->query($activity_sql);


		    $pointsQuery = "SELECT * FROM user_points_count WHERE user_id = '$user_id' LIMIT 1";
			$points_result = $this->db->query($pointsQuery);
			$points_ress = $points_result->result();

				if($points_result->num_rows()==0)
				{
                    $points_sql = "INSERT INTO user_points_count (user_id) VALUES ('". $user_id . "')";
                    $insert_points = $this->db->query($points_sql);

                    $activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+1,total_points=total_points+1 WHERE user_id  ='$user_id'";
                    $insert_points = $this->db->query($activity_points);

				} else {

	    	         $activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+1,total_points=total_points+1 WHERE user_id  ='$user_id'";
	    	         $insert_points = $this->db->query($activity_points);
				}

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
            $signup_type = "fb_signup";
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

            $activity_sql = "INSERT INTO user_activity (date,user_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $login_mode . "')";
    		$insert_activity = $this->db->query($activity_sql);

		} else {

				$sQuery = "INSERT INTO user_master (email_id,user_role,email_verify,status) VALUES ('". $email_id . "','3','Y','Y')";
				$insert_user = $this->db->query($sQuery);
				$user_id = $this->db->insert_id();

				$suserQuery = "INSERT INTO user_details (user_id,name,newsletter_status,referal_code) VALUES ('". $user_id . "','". $name . "','N','HEYLA123')";
				$insert_user_details = $this->db->query($suserQuery);

				$activity_sql = "INSERT INTO user_activity (date,user_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $signup_type . "')";
    		    $insert_activity = $this->db->query($activity_sql);
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
					  $user_role = $rows->user_role;

					  if ($user_role =='2') {
						  	$organiser_sql = "SELECT * FROM organiser_request WHERE user_id  ='".$user_id."'";
							$organiser_result = $this->db->query($organiser_sql);
							$organiser_ress = $organiser_result->result();
							if($organiser_result->num_rows()>0)
							{
								foreach ($organiser_result->result() as $orgs)
    							{
									$req_status = $orgs->req_status;
								}
								if ($req_status =='Pending'){
									$event_organizer = 'P';
								}
								if($req_status =='Approved'){
									$event_organizer = 'Y';
								}
								if($req_status =='Rejected'){
									$event_organizer = 'R';
								}
							}
					  } else {
						  $event_organizer = 'N';
					  }
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
							"referal_code" => $ress[0]->referal_code,
							"user_login_count" => $ress[0]->login_count,
							"event_organizer" => $event_organizer
				);
			}

    		$pointsQuery = "SELECT * FROM user_points_count WHERE user_id = '$user_id' LIMIT 1";
    		$points_result = $this->db->query($pointsQuery);
    		$points_ress = $points_result->result();

    			if($points_result->num_rows()==0)
    			{
    				$points_sql = "INSERT INTO user_points_count (user_id) VALUES ('". $user_id . "')";
    				$insert_points = $this->db->query($points_sql);

    				$activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+1,total_points=total_points+1 WHERE user_id  ='$user_id'";
    				$insert_points = $this->db->query($activity_points);

    			} else {

    				 $activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+1,total_points=total_points+1 WHERE user_id  ='$user_id'";
    				 $insert_points = $this->db->query($activity_points);
    			}

    		$gcmQuery = "SELECT * FROM push_notification_master WHERE gcm_key like '%" .$gcm_key. "%' LIMIT 1";
    		$gcm_result = $this->db->query($gcmQuery);
    		$gcm_ress = $gcm_result->result();

    				if($gcm_result->num_rows()==0)
    				{
    					$sQuery = "INSERT INTO push_notification_master (user_id,gcm_key,mobile_type) VALUES ('". $user_id . "','". $gcm_key . "','". $mobile_type . "')";
    					$update_gcm = $this->db->query($sQuery);
    				}

    		$update_sql = "UPDATE user_master SET last_login=NOW(),login_count='$login_count' WHERE id='$user_id'";
    		$update_result = $this->db->query($update_sql);


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
        if(empty($email_id)){
           $sql = "SELECT * FROM user_master WHERE mobile_no = '".$mobile_no."'";
        }else{
           $sql = "SELECT * FROM user_master WHERE email_id ='".$email_id."' OR mobile_no = '".$mobile_no."'";
        }

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

			$points_sql = "INSERT INTO user_points_count (user_id) VALUES ('". $user_id . "')";
			$insert_points = $this->db->query($points_sql);
					
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
 			$sql = "SELECT * FROM user_master WHERE user_name = '".$user_name."' AND id != '$user_id'";
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
	        $Message = "User Not Found";

			$digits = 4;
			$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

    		$sql = "SELECT * FROM user_master WHERE email_id ='".$user_name."' AND status='Y'";
    		$user_result = $this->db->query($sql);
    		$ress = $user_result->result();
    		if($user_result->num_rows()>0)
    		{
    			foreach ($user_result->result() as $rows)
    			{
    				  $user_id = $rows->id;
    				  $email_id = $rows->email_id;
    				  $email_verify = $rows->email_verify;
    			}
                    if ($email_verify=='N') {
                        $Message = 'Please verify your email id';
                        $sType = "Email";
                        $user_id = '';
                    } else {

                    $encrypt_email = base64_encode($email_id);

            		$subject = "Heyla App - Forgot Password URL";
            		$email_message = 'Please Click the Forgot Password link. <a href="'. base_url().'home/reset/'.$encrypt_email.'" target="_blank" style="background-color: #478ECC; font-size:15px; font-weight: bold; padding: 10px; text-decoration: none; color: #fff; border-radius: 5px;">Forgot Password</a><br><br><br>';
                    $this->sendMail($email_id,$subject,$email_message);
                    $sType = "Email";
                }
    		}

    		$sql = "SELECT * FROM user_master WHERE mobile_no ='".$user_name."'AND status='Y'";
    		$user_result = $this->db->query($sql);
    		$ress = $user_result->result();
    		if($user_result->num_rows()>0)
    		{
    			foreach ($user_result->result() as $rows)
    			{
    				  $user_id = $rows->id;
    				  $mobile_no = $rows->mobile_no;
    				  $mobile_verify = $rows->mobile_verify;
    			}

    			if ($mobile_verify=='N') {
                    $Message = 'Please verify your Mobile';
                    $sType = "Mobile";
                    $user_id = '';
                } else {
        			$update_sql = "UPDATE user_master SET mobile_otp = '$OTP', updated_by = '$user_id', updated_at =NOW() WHERE id='$user_id'";
    			    $update_result = $this->db->query($update_sql);

            		$mobile_message = 'Verify OTP :'. $OTP;
                    $this->sendSMS($mobile_no,$mobile_message);
                    $sType = "Mobile";
                }
    		}

	        if ( $user_id != "") {
                $response = array("status" => "success", "msg" => "Forgot Password", "type"=>$sType);
			} else {
				$response = array("status" => "error", "msg" => $Message);
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

  public function getEventCountries($user_id)
  {
      $country_query = "SELECT id,country_name from country_master WHERE event_status='Y'";
      $country_res = $this->db->query($country_query);

       if($country_res->num_rows()>0){
            $country_result= $country_res->result();
            $response = array("status" => "success", "msg" => "View Countries","Countries"=>$country_result);

      }else{
              $response = array("status" => "error", "msg" => "Countries not found");
      }

      return $response;
  }


  public function getEventcities($country_id)
  {
      $country_query = "SELECT id,city_name,city_latitude,city_longitude from city_master WHERE event_status='Y' and country_id='$country_id'";
      $country_res = $this->db->query($country_query);

       if($country_res->num_rows()>0){
            $city_result= $country_res->result();
            $response = array("status" => "success", "msg" => "View Cities","cities"=>$city_result);

      }else{
              $response = array("status" => "error", "msg" => "Cities not found");
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


//#################### Add User Category ####################//
	public function Update_preferrence($user_id,$category_ids,$user_type)
	{
        $category_ids = explode(',' , $category_ids);

        if ($user_type =='1') {
            $prefQuery = "SELECT * FROM user_preference WHERE user_id = '$user_id' LIMIT 1";
        } else {
            $prefQuery = "SELECT * FROM guest_user_preference WHERE user_id = '$user_id' LIMIT 1";
        }
		$pref_result = $this->db->query($prefQuery);
		$pref_ress = $pref_result->result();

			if($pref_result->num_rows()>0) {
			    if ($user_type =='1') {
                     $sQuery = "DELETE FROM user_preference WHERE user_id = '" .$user_id. "'";
                } else {
                    $sQuery = "DELETE FROM guest_user_preference WHERE user_id = '" .$user_id. "'";
                }
    			$del_Query = $this->db->query($sQuery);
			}

			foreach($category_ids as $key) {

			    if ($user_type =='1') {
                     $sQuery = "INSERT INTO user_preference (user_id,category_id) VALUES ('". $user_id . "','". $key . "')";
                } else {
                    $sQuery = "INSERT INTO guest_user_preference (user_id,category_id) VALUES ('". $user_id . "','". $key . "')";
                }
    			$ins_Query = $this->db->query($sQuery);
            }
		$response = array("status" => "success", "msg" => "Preference Updated");

		return $response;
	}
//#################### User Category End ####################//

//#################### View User Category ####################//
	public function User_preferrence($user_id,$user_type)
	{
	        $category_query = "SELECT id,category_name,category_image from category_master WHERE status ='Y' ORDER BY order_by";
			$category_res = $this->db->query($category_query);
            $user_preference ='';

			 if($category_res->num_rows()>0){

			    foreach ($category_res->result() as $rows)
			    {
			        $category_id = $rows->id;

			         if ($user_type =='1') {
                        $user_query = "SELECT * from user_preference WHERE category_id ='$category_id' AND user_id ='$user_id'";
                    } else {
                        $user_query = "SELECT * from guest_user_preference WHERE category_id ='$category_id' AND user_id ='$user_id'";
                    }

			          $user_res = $this->db->query($user_query);

			            if($user_res->num_rows()>0){
			                $user_preference = 'Y';
			            } else {
			                $user_preference = 'N';
			            }

				     $preferences[] = array(
							"category_id" => $rows->id,
							"category_name" => $rows->category_name,
							"category_pic" => base_url().'assets/category/'.$rows->category_image,
							"user_preference" => $user_preference
				    );
			    }

			    	$response = array("status" => "success", "msg" => "View Categories","Categories"=>$preferences);

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
            //$wishlistQuery = "SELECT * FROM user_wish_list WHERE wish_list_id  = '$wishlist_master_id' AND event_id = '$event_id'  LIMIT 1";
            $wishlistQuery = "SELECT * FROM user_wish_list WHERE user_id  = '$user_id' AND event_id = '$event_id'  LIMIT 1";
			$wishlist_result = $this->db->query($wishlistQuery);
			$wishlist_ress = $wishlist_result->result();

				if($wishlist_result->num_rows()==0)
				{
					$sQuery = "INSERT INTO user_wish_list (user_id ,event_id) VALUES ('". $user_id . "','". $event_id . "')";
					$update_gcm = $this->db->query($sQuery);
					$response = array("status" => "success", "msg" => "Wishlist Added");
				} else {
				    $response = array("status" => "exist", "msg" => "Already Added");
				}

			return $response;
	}
//#################### Wishlist End ####################//


//#################### View Wishlist ####################//
	public function View_wishlist($user_id,$wishlist_master_id)
	{
	       // $wishlist_query = "SELECT * FROM user_wish_list A,events B WHERE A.wish_list_id  = '$wishlist_master_id' AND A.event_id = B.id";
	        $wishlist_query = "select ev.*, uwl.id AS wishlist_id,ci.city_name, cy.country_name, count(ep.event_id) as popularity
                            from events as ev
                            left join user_wish_list as uwl on uwl.event_id = ev.id
                            left join event_popularity as ep on ep.event_id = ev.id
                            LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                            LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                            WHERE uwl.user_id = '$user_id' AND ev.event_status  ='Y'
                            group by ev.id ORDER by popularity DESC";
			$wishlist_res = $this->db->query($wishlist_query);

				if($wishlist_res->num_rows()>0){
	     	        $event_result= $wishlist_res->result();
                    foreach ($wishlist_res->result() as $rows)
    			    {
    				     $eventData[]  = array(
    							"event_id" => $rows->id,
								"wishlist_id" => $rows->wishlist_id,
    							"popularity" => $rows->popularity,
    							"category_id" => $rows->category_id,
    							"event_name" => $rows->event_name,
    							"event_venue" => $rows->event_venue,
    							"event_address" => $rows->event_address,
    							"description" => $rows->description,
    							"start_date" => $rows->start_date,
    							"end_date" => $rows->end_date,
    							"start_time" => $rows->start_time,
    							"end_time" => $rows->end_time,
    							"event_banner" => base_url().'assets/events/banner/'.$rows->event_banner,
    							"event_latitude" => $rows->event_latitude,
    							"event_longitude" => $rows->event_longitude,
    							"event_country" => $rows->event_country,
    							"country_name" => $rows->country_name,
    							"event_city" => $rows->event_city,
    							"city_name" => $rows->city_name,
    							"primary_contact_no" => $rows->primary_contact_no,
    							"secondary_contact_no" => $rows->secondary_contact_no,
    							"contact_person" => $rows->contact_person,
    							"contact_email" => $rows->contact_email,
    							"event_type" => $rows->event_type,
    							"adv_status" => $rows->adv_status,
    							"booking_status" => $rows->booking_status,
    							"hotspot_status" => $rows->hotspot_status,
    							"event_colour_scheme" => $rows->event_colour_scheme,
    							"event_status" => $rows->event_status,
    							"advertisement" => ''
    				    );
    			    }
			     	$response = array("status" => "success", "msg" => "View Wishlist","Eventdetails"=>$eventData);

			}else{
			        $response = array("status" => "error", "msg" => "Wishlist not found");
			}

			return $response;
	}
//#################### User Wishlist End ####################//


//#################### Delete Wishlist ####################//
	public function Delete_wishlist($user_id,$wishlist_id)
	{
            	$sQuery = "DELETE FROM user_wish_list WHERE id = '" .$wishlist_id. "' AND user_id = '" .$user_id. "'";
    			$delete_list = $this->db->query($sQuery);

				$response = array("status" => "success", "msg" => "Wishlist Deleted");

			return $response;
	}
//#################### Delete Wishlist ####################//

//#################### Add Wishlist ####################//
	public function Wishlist_Status($user_id,$event_id)
	{
            $wishlistQuery = "SELECT * FROM user_wish_list WHERE user_id  = '$user_id' AND event_id = '$event_id'  LIMIT 1";
			$wishlist_result = $this->db->query($wishlistQuery);
			$wishlist_ress = $wishlist_result->result();

			if($wishlist_result->num_rows()>0)
			{
				  foreach ($wishlist_result->result() as $rows)
			    	{
			        	$wishlist_id = $rows->id;
					}
				$response = array("status" => "success", "msg" => "Wishlist Added","wishlist_id"=>$wishlist_id);
			} else {
				$response = array("status" => "empty", "msg" => "No Records Found");
			}

			return $response;
	}
//#################### Wishlist End ####################//


//#################### View Events ####################//
	public function View_events($event_type,$city_id,$user_id,$user_type,$day_type)
	{
	    $current_date = date("Y-m-d");
		$tomorrow_date = date("Y-m-d",strtotime("tomorrow"));

        if ($user_type ==1){
            $pre_query = "SELECT * FROM user_preference WHERE user_id = '$user_id'";
        } else {
            $pre_query = "SELECT * FROM guest_user_preference WHERE user_id = '$user_id'";
        }
		    $pre_res = $this->db->query($pre_query);

    		 if($pre_res->num_rows()>0){
    		    foreach ($pre_res->result() as $rows)
    			{
    				   $pref_ids[]  = $rows->category_id;
    			}
    			$preferrence = implode (",", $pref_ids);
    		 }

			if ($day_type =='All'){
				$day_query = "";
			}
			if ($day_type =='Today'){
				 $day_query = "'$current_date' BETWEEN ev.start_date AND ev.end_date AND";
			}
			if ($day_type =='Tomorrow'){
				 $day_query = "'$tomorrow_date' BETWEEN ev.start_date AND ev.end_date AND";
			}
			if ($day_type =='Week'){
				$start_date = (date('D') != 'Mon') ? date('Y-m-d', strtotime('last Monday')) : date('Y-m-d');
				$end_date = (date('D') != 'Sat') ? date('Y-m-d', strtotime('next Sunday')) : date('Y-m-d');
				$day_query = "ev.start_date <= STR_TO_DATE('" . $end_date . "','%Y-%m-%d') AND  ev.end_date >= STR_TO_DATE('" . $start_date . "','%Y-%m-%d') AND";
			}
			if ($day_type =='Month'){

				$start_date = date('Y-m-01', strtotime($current_date));
				$end_date = date('Y-m-t', strtotime($current_date));
				$day_query = "ev.start_date <= STR_TO_DATE('" . $end_date . "','%Y-%m-%d') AND  ev.end_date >= STR_TO_DATE('" . $start_date . "','%Y-%m-%d') AND";
			}

            $adv_event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity
                        from events as ev
                        left join event_popularity as ep on ep.event_id = ev.id
                        LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                        LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                        LEFT JOIN adv_event_history AS aeh ON aeh.event_id = ev.id
                        WHERE ev.end_date>= '$current_date' AND  ev.category_id IN ($preferrence) AND  ev.event_city = '$city_id' AND ev.event_status  ='Y' AND aeh.date_to >= '$current_date' group by ev.id, aeh.event_id";
    	    //echo $event_query;
		    $adv_event_res = $this->db->query($adv_event_query);

			if($adv_event_res->num_rows()>0){
                $adv_event_result= $adv_event_res->result();

                foreach ($adv_event_res->result() as $rows)
			    {
				     $adv_eventData[]  = array(
							"event_id" => $rows->id,
							"popularity" => $rows->popularity,
							"category_id" => $rows->category_id,
							"event_name" => $rows->event_name,
							"event_venue" => $rows->event_venue,
							"event_address" => $rows->event_address,
							"description" => $rows->description,
							"start_date" => $rows->start_date,
							"end_date" => $rows->end_date,
							"start_time" => $rows->start_time,
							"end_time" => $rows->end_time,
							"event_banner" => base_url().'assets/events/banner/'.$rows->event_banner,
							"event_latitude" => $rows->event_latitude,
							"event_longitude" => $rows->event_longitude,
							"event_country" => $rows->event_country,
							"country_name" => $rows->country_name,
							"event_city" => $rows->event_city,
							"city_name" => $rows->city_name,
							"primary_contact_no" => $rows->primary_contact_no,
							"secondary_contact_no" => $rows->secondary_contact_no,
							"contact_person" => $rows->contact_person,
							"contact_email" => $rows->contact_email,
							"event_type" => $rows->event_type,
							"adv_status" => $rows->adv_status,
							"booking_status" => $rows->booking_status,
							"hotspot_status" => $rows->hotspot_status,
							"event_colour_scheme" => $rows->event_colour_scheme,
							"event_status" => $rows->event_status,
							"advertisement" => 'y'
				    );
			    }
			} else {

			    $adv_eventData = array();
			}


	    if ($event_type == 'General'){
	         $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity
                            from events as ev
                            left join event_popularity as ep on ep.event_id = ev.id
                            LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                            LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                            WHERE ev.hotspot_status = 'N' AND $day_query ev.end_date>= '$current_date' AND  ev.category_id IN ($preferrence) AND  ev.event_city = '$city_id' AND ev.event_status  ='Y'
                            group by ev.id";
	    }
	    if ($event_type == 'Popularity'){
	         $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity
                            from events as ev
                            left join event_popularity as ep on ep.event_id = ev.id
                            LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                            LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                            WHERE ev.hotspot_status = 'N' AND $day_query ev.end_date>= '$current_date' AND  ev.category_id IN ($preferrence) AND  ev.event_city = '$city_id' AND ev.event_status  ='Y'
                            group by ev.id ORDER by popularity DESC";
	    }
		if ($event_type == 'Hotspot'){
	        $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity
                            from events as ev
                            left join event_popularity as ep on ep.event_id = ev.id
                            LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                            LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                            WHERE ev.hotspot_status = 'Y' AND  ev.category_id IN ($preferrence) AND  ev.event_city = '$city_id' AND ev.event_status  ='Y'
                            group by ev.id";
	    }
		//echo $event_query;
		$event_res = $this->db->query($event_query);

		 if($event_res->num_rows()>0){
                $event_result= $event_res->result();

                foreach ($event_res->result() as $rows)
			    {
				     $eventData[]  = array(
							"event_id" => $rows->id,
							"popularity" => $rows->popularity,
							"category_id" => $rows->category_id,
							"event_name" => $rows->event_name,
							"event_venue" => $rows->event_venue,
							"event_address" => $rows->event_address,
							"description" => $rows->description,
							"start_date" => $rows->start_date,
							"end_date" => $rows->end_date,
							"start_time" => $rows->start_time,
							"end_time" => $rows->end_time,
							"event_banner" => base_url().'assets/events/banner/'.$rows->event_banner,
							"event_latitude" => $rows->event_latitude,
							"event_longitude" => $rows->event_longitude,
							"event_country" => $rows->event_country,
							"country_name" => $rows->country_name,
							"event_city" => $rows->event_city,
							"city_name" => $rows->city_name,
							"primary_contact_no" => $rows->primary_contact_no,
							"secondary_contact_no" => $rows->secondary_contact_no,
							"contact_person" => $rows->contact_person,
							"contact_email" => $rows->contact_email,
							"event_type" => $rows->event_type,
							"adv_status" => $rows->adv_status,
							"booking_status" => $rows->booking_status,
							"hotspot_status" => $rows->hotspot_status,
							"event_colour_scheme" => $rows->event_colour_scheme,
							"event_status" => $rows->event_status,
							"advertisement" => 'N'
				    );
			    }


			     if (!empty($adv_eventData)) {
			          $output = array_merge($adv_eventData, $eventData);
		         } else {
		              $output = $eventData;
		         }

			     	$response = array("status" => "success", "msg" => "View Events","Eventdetails"=>$output);
			}else{
			        $response = array("status" => "error", "msg" => "Events not found");
			}

			return $response;
	}
//#################### View Events End ###############//


  function search_events($search_event,$city_id,$event_type){
    if($event_type=='Favourite'){
        $ev_type='N';
        $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity FROM events AS ev
                    LEFT join event_popularity AS ep on ep.event_id = ev.id
                    LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                    LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                    LEFT JOIN booking_plan AS bp ON ev.id = bp.event_id
                    WHERE ev.event_name like '%$search_event%' AND ev.event_city='$city_id' AND ev.hotspot_status  ='$ev_type'  AND  ev.end_date >= CURDATE() AND  ev.event_status ='Y' group by ev.id";
    }else if($event_type=='Hotspot'){
        $ev_type='Y';
        $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity FROM events AS ev
                    LEFT join event_popularity AS ep on ep.event_id = ev.id
                    LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                    LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                    LEFT JOIN booking_plan AS bp ON ev.id = bp.event_id
                    WHERE ev.event_name like '%$search_event%' AND ev.event_city='$city_id' AND ev.hotspot_status  ='$ev_type'   AND  ev.event_status ='Y' group by ev.id";
    }else{
      $ev_type='Y';
       $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity FROM events AS ev
                  LEFT join event_popularity AS ep on ep.event_id = ev.id
                  LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                  LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                  LEFT JOIN booking_plan AS bp ON ev.id = bp.event_id
                  WHERE ev.event_name like '%$search_event%' AND ev.event_city='$city_id' AND ev.hotspot_status  ='$ev_type'  AND  ev.end_date >= CURDATE() AND
                  ev.event_status ='Y' group by ev.id ORDER by popularity DESC LIMIT 50";
    }

	$event_res = $this->db->query($event_query);
        if($event_res->num_rows()==0){
            $response = array("status" => "error", "msg" => "Events not found");
        }else{
          $res=$event_res->result();
          foreach($res as $rows){
            $serach_events[]=array(
              "event_id" => $rows->id,
							"popularity" => $rows->popularity,
							"category_id" => $rows->category_id,
							"event_name" => $rows->event_name,
							"event_venue" => $rows->event_venue,
							"event_address" => $rows->event_address,
							"description" => $rows->description,
							"start_date" => $rows->start_date,
							"end_date" => $rows->end_date,
							"start_time" => $rows->start_time,
							"end_time" => $rows->end_time,
							"event_banner" => base_url().'assets/events/banner/'.$rows->event_banner,
							"event_latitude" => $rows->event_latitude,
							"event_longitude" => $rows->event_longitude,
							"event_country" => $rows->event_country,
							"country_name" => $rows->country_name,
							"event_city" => $rows->event_city,
							"city_name" => $rows->city_name,
							"primary_contact_no" => $rows->primary_contact_no,
							"secondary_contact_no" => $rows->secondary_contact_no,
							"contact_person" => $rows->contact_person,
							"contact_email" => $rows->contact_email,
							"event_type" => $rows->event_type,
							"adv_status" => $rows->adv_status,
							"booking_status" => $rows->booking_status,
							"hotspot_status" => $rows->hotspot_status,
							"event_colour_scheme" => $rows->event_colour_scheme,
							"event_status" => $rows->event_status,
							"advertisement" => ''
            );
          }
            $response = array("status" => "success", "msg" => "Events found","Eventdetails"=>$serach_events);
        }
        	return $response;

  }


//#################### View Event Images ####################//
	public function View_eventimages($event_id)
	{
	    $event_query = "SELECT * FROM event_images WHERE event_id = '$event_id'";
		$event_res = $this->db->query($event_query);

			 if($event_res->num_rows()>0){
			    //$event_result= $event_res->result();
                foreach ($event_res->result() as $rows)
			    {
				     $eventImages[]  = array(
							"gallery_id" => $rows->id,
							"event_id" => $rows->event_id,
							"event_banner" => base_url().'assets/events/gallery/'.$rows->event_image,
				    );
			    }
			     	$response = array("status" => "success", "msg" => "View Event Images","Eventgallery"=>$eventImages);

			}else{
			        $response = array("status" => "error", "msg" => "Gallery not found");
			}

			return $response;
	}
//#################### View Event Images End ###############//

//#################### Check Event review ###############//
	public function Check_review($event_id,$user_id)
	{
	        $review_query = "SELECT * FROM event_reviews WHERE event_id = '$event_id' AND user_id='$user_id'";
			$review_res = $this->db->query($review_query);
			$review_result= $review_res->result();

			 if($review_res->num_rows()>0){
			     	$response = array("status" => "exist", "msg" => "Already Exist","Reviewdetails"=>$review_result);
			}else{
			        $response = array("status" => "new", "msg" => "Review Not found");
			}

			return $response;
	}
//#################### Check Event review End ###############//

//#################### Add Event review ###############//
	public function Add_review($user_id,$event_id,$event_rating,$comments)
	{
	        $review_query = "INSERT INTO `event_reviews` (`user_id`, `event_id`, `event_rating`, `comments`,`status`,`created_at`) VALUES ('$user_id', '$event_id', '$event_rating', '$comments','N',NOW())";
	        $review_res = $this->db->query($review_query);
            $review_id = $this->db->insert_id();

			if($review_res) {
			    $response = array("status" => "success", "msg" => "Review Added", "review_id"=>$review_id);
			} else {
			    $response = array("status" => "error");
			}
			return $response;

	}
//#################### Event review End ###############//

//#################### Update Event review ###############//
	public function Update_review($review_id,$event_rating,$comments)
	{
	        $review_query = "UPDATE event_reviews SET event_rating='$event_rating',comments='$comments',status='N',updated_at=NOW() WHERE id='$review_id'";
			$review_res = $this->db->query($review_query);
			//$review_result= $review_res->result();

			 if($review_res) {
			    $response = array("status" => "success", "msg" => "Review Updated");
			} else {
			    $response = array("status" => "error");
			}
			return $response;
	}
//#################### Update Event review End ###############//


//#################### Event review ###############//
	public function List_eventreview($user_id,$event_id)
	{

			$ureview_query = "SELECT A.id,A.event_id,C.event_name,A.event_rating,A.comments,B.user_name FROM event_reviews A, user_master B, events C  WHERE A.event_id = '$event_id' AND A.user_id ='$user_id' AND A.status='N' AND A.user_id=B.id AND A.event_id = C.id ORDER by A.id DESC";
			$ureview_res = $this->db->query($ureview_query);
			$ureview_res->num_rows();
			if($ureview_res->num_rows()>0){
				$ureview_result = $ureview_res->result();
			} else{
				$ureview_result = array();
			}
			//print_r($ureview_result);

	        $review_query = "SELECT A.id,A.event_id,C.event_name,A.event_rating,A.comments,B.user_name FROM event_reviews A, user_master B, events C  WHERE A.event_id = '$event_id' AND A.status='Y' AND A.user_id=B.id AND A.event_id = C.id ORDER by A.id DESC";
			$review_res = $this->db->query($review_query);
			$review_result = $review_res->result();

			 //if($review_res->num_rows()>0){

            if (!empty($ureview_result)) {
                $output = array_merge($ureview_result, $review_result);
            } else {
                $output = $review_result;
            }

            if (!empty($output)) {
                $response = array("status" => "success", "msg" => "View Reviews","Reviewdetails"=>$output);
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
			//$review_result= $review_res->result();

			 if($review_res->num_rows()>0){
    		     foreach ($review_res->result() as $rows)
			        {
				     $reviewImages[]  = array(
							"gallery_id" => $rows->id,
							"event_id" => $rows->event_id,
							"event_banner" => base_url().'assets/events/gallery/'.$rows->event_image,
				    );
			    }

			     	$response = array("status" => "success", "msg" => "View Review Images","Reviewphotos"=>$reviewImages);
			}else{
			        $response = array("status" => "error", "msg" => "Reviews Images not found");
			}

			return $response;
	}
//#################### Event review photo End ###############//

//#################### Event popularity ###############//
	public function Event_popularity($event_id,$user_id)
	{
	        $popularQuery = "SELECT * FROM event_popularity WHERE event_id = '$event_id' AND  user_id = '$user_id' LIMIT 1";
			$popular_result = $this->db->query($popularQuery);
			$popular_ress = $popular_result->result();

			if($popular_result->num_rows()==0)
			{
    			$popular_sql = "INSERT INTO event_popularity (event_id,user_id,view_date) VALUES ('". $event_id . "','". $user_id . "',NOW())";
    			$insert_popular = $this->db->query($popular_sql);
			    $response = array("status" => "success", "msg" => "Popularity Added");
	        }else if($popular_result->num_rows()==1){
	            $response = array("status" => "exist", "msg" => "Already Added");
	        }  else {
	            $response = array("status" => "error", "msg" => "Already Added");
	        }
			return $response;
	}
//#################### Event popularity End ###############//


//#################### Advanced Events Search ####################//
	public function Advance_search($single_date,$from_date,$to_date,$event_type,$event_category,$selected_preference,$selected_city,$price_range)
	{
	    $current_date = date("Y-m-d");

	    $city_query ='';
	    $preference_query = '';
	    $event_type_query = '';
	    $event_category_query = '';
	    $single_date_query ='';
	    $fromto_date_query ='';
	    $event_popularity_query ='';
		$price_range_query = '';

	    if ($selected_city!='') {
            $city_query = "SELECT * FROM city_master WHERE city_name like '%" .$selected_city. "%' LIMIT 1";
    		$city_res = $this->db->query($city_query);
    		 if($city_res->num_rows()>0){
    		    foreach ($city_res->result() as $rows)
    			{
    				  $city_id  = $rows->id ;
    			}
    		 }
    		 $city_query = "ev.event_city = '$city_id' AND";
	    }

	    if ($selected_preference != ''){
            $preference_query = "ev.category_id IN ($selected_preference) AND";
        }

        if ($event_type =='Paid'){
            $event_type_query = "ev.event_type = 'Paid' AND";
        }
        if ($event_type =='Free'){
            $event_type_query = "ev.event_type = 'Free' AND";
        }
        if ($event_type =='Invite'){
            $event_type_query = "ev.event_type = 'Invite' AND";
        }

        if ($event_category == 'General'){
            $event_category_query = "ev.hotspot_status = 'N' AND";
        }
        if ($event_category == 'Hotspot'){
            $event_category_query = "ev.hotspot_status = 'Y' AND";
        }
        if ($event_category == 'Popular'){
            $event_category_query = "ev.hotspot_status = 'N' AND";
            $event_popularity_query = "ORDER by popularity DESC";
        }

         if ($single_date !=''){
             $single_date_query = "'$single_date' BETWEEN ev.start_date AND ev.end_date AND";
        }

	    if ($from_date !='' &&  $to_date !=''){
	        $fromto_date_query = "ev.start_date <= STR_TO_DATE('" . $to_date . "','%Y-%m-%d') AND  ev.end_date >= STR_TO_DATE('" . $from_date . "','%Y-%m-%d') AND";
	   }

	   if ($price_range !='') {
			$price_array = explode('-', $price_range);
			$from_price = $price_array[0];
			$to_price = $price_array[1];
			$price_range_query = "bp.seat_rate>='$from_price' AND bp.seat_rate <='$to_price' AND ";
	   }


	    if ($event_category == 'Hotspot'){
            $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity
                        FROM events AS ev
                        LEFT join event_popularity AS ep on ep.event_id = ev.id
                        LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                        LEFT JOIN country_master AS cy ON ev.event_country = cy.id
						LEFT JOIN booking_plan AS bp ON ev.id = bp.event_id
                        WHERE $city_query $preference_query $event_type_query $event_category_query $price_range_query
                        ev.event_status ='Y' group by ev.id $event_popularity_query";
        } else {
			$event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity
                        FROM events AS ev
                        LEFT join event_popularity AS ep on ep.event_id = ev.id
                        LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                        LEFT JOIN country_master AS cy ON ev.event_country = cy.id
						LEFT JOIN booking_plan AS bp ON ev.id = bp.event_id
                        WHERE $city_query $preference_query $event_type_query $event_category_query $single_date_query $fromto_date_query $price_range_query
                        ev.end_date>= '$current_date' AND ev.event_status ='Y' group by ev.id $event_popularity_query";
		}

		$event_res = $this->db->query($event_query);

		 if($event_res->num_rows()>0){
                $event_result= $event_res->result();

                foreach ($event_res->result() as $rows)
			    {
				     $eventData[]  = array(
							"event_id" => $rows->id,
							"popularity" => $rows->popularity,
							"category_id" => $rows->category_id,
							"event_name" => $rows->event_name,
							"event_venue" => $rows->event_venue,
							"event_address" => $rows->event_address,
							"description" => $rows->description,
							"start_date" => $rows->start_date,
							"end_date" => $rows->end_date,
							"start_time" => $rows->start_time,
							"end_time" => $rows->end_time,
							"event_banner" => base_url().'assets/events/banner/'.$rows->event_banner,
							"event_latitude" => $rows->event_latitude,
							"event_longitude" => $rows->event_longitude,
							"event_country" => $rows->event_country,
							"country_name" => $rows->country_name,
							"event_city" => $rows->event_city,
							"city_name" => $rows->city_name,
							"primary_contact_no" => $rows->primary_contact_no,
							"secondary_contact_no" => $rows->secondary_contact_no,
							"contact_person" => $rows->contact_person,
							"contact_email" => $rows->contact_email,
							"event_type" => $rows->event_type,
							"adv_status" => $rows->adv_status,
							"booking_status" => $rows->booking_status,
							"hotspot_status" => $rows->hotspot_status,
							"event_colour_scheme" => $rows->event_colour_scheme,
							"event_status" => $rows->event_status,
              "advertisement"=>'',

				    );
			    }
			     	$response = array("status" => "success", "msg" => "View Events","Eventdetails"=>$eventData);
			}else{
			        $response = array("status" => "error", "msg" => "Events not found");
			}

			return $response;
	}
//#################### Advanced Events Search End ###############//



//#################### Booking Plan Dates###############//
	public function Booking_plandates($event_id)
	{
    		$date_query = "SELECT show_date FROM booking_plan_timing WHERE event_id  = '$event_id' AND `show_date` >= CURDATE()  GROUP BY show_date";
			$date_res = $this->db->query($date_query);
			$date_result= $date_res->result();

    		if($date_res->num_rows()>0){
			     	$response = array("status" => "success", "msg" => "View Booking Dates","Eventdates"=>$date_result);

			}else{
			        $response = array("status" => "error", "msg" => "Booking Date not found");
			}

			return $response;
	}
//#################### Booking Plan Dates End ###############//

//#################### Booking Plan Times ###############//
	public function Booking_plantimes($event_id,$show_date)
	{
    		$time_query = "SELECT id,show_time FROM booking_plan_timing WHERE event_id  = '$event_id' AND show_date='$show_date' GROUP BY show_time";
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

//#################### Booking Plan price details###############//
	public function Booking_plans($event_id,$show_date,$show_time)
	{
			$plan_query = "SELECT B.plan_name,B.seat_rate,A.event_id,A.plan_id,A.id AS plan_time_id,A.show_date,A.show_time,A.seat_available FROM booking_plan_timing A,booking_plan B WHERE A.event_id  = '$event_id' AND A.show_date = '$show_date' AND A.show_time = '$show_time' AND A.seat_available>0 AND A.plan_id = B.id";
	        //$plan_query = "SELECT B.plan_name,B.seat_rate,A.event_id,A.plan_id,A.show_date,A.show_time,A.seat_available FROM booking_plan_timing A,booking_plan B WHERE A.event_id  = '$event_id' AND show_date = '$show_date' AND show_time = '$show_time' AND A.seat_available>0 AND A.plan_id = B.id";
			$plan_res = $this->db->query($plan_query);
			$plan_result= $plan_res->result();

			 if($plan_res->num_rows()>0){
			     	$response = array("status" => "success", "msg" => "Booking Plans","Plandetails"=>$plan_result);
			}else{
			        $response = array("status" => "error", "msg" => "Plans not found");
			}

			return $response;
	}
//#################### Booking Plan  price End ###############//


//#################### Booking Plan details###############//
	public function Booking_pricerange($user_id)
	{
		$plan_query = "SELECT MAX(seat_rate) AS price_range FROM booking_plan A, booking_plan_timing B WHERE B.plan_id = A.id AND B.show_date >= CURDATE()";
		$plan_res = $this->db->query($plan_query);
		foreach ($plan_res->result() as $rows) {
			$plan_result = $rows->price_range;
		}
		if (is_null($plan_result)){
			$response = array("status" => "error", "msg" => "Price Range not found");
		} else {
			$response = array("status" => "success", "msg" => "Price Range","Pricerange"=>$plan_result);
		}

	/*
		$plan_query = "SELECT id, CONCAT(start_price,'-',end_price) AS price_range,disp_price FROM booking_price_range WHERE status = 'y'";
		$plan_res = $this->db->query($plan_query);
		$plan_result= $plan_res->result();

		 if($plan_res->num_rows()>0){
				$response = array("status" => "success", "msg" => "Price Range","Pricerange"=>$plan_result);
		}else{
				$response = array("status" => "error", "msg" => "Price Range not found");
		}
	*/
		return $response;
	}
//#################### Booking Plan End ###############//


//#################### Booking Process Add ###############//
	public function Bookingprocess($order_id,$event_id,$plan_id,$plan_time_id,$user_id,$number_of_seats,$total_amount,$booking_date)
	{

	        $sQuery = "INSERT INTO booking_process (order_id,event_id,plan_id,plan_time_id,user_id,number_of_seats,total_amount,booking_date) VALUES ('". $order_id . "','". $event_id . "','". $plan_id . "','". $plan_time_id . "','". $user_id . "','". $number_of_seats . "','". $total_amount . "','". $booking_date . "')";
			$booking_insert = $this->db->query($sQuery);

			$update_seats = "UPDATE booking_plan_timing SET seat_available = seat_available-$number_of_seats WHERE id ='$plan_time_id'";
		    $seatsupdate = $this->db->query($update_seats);

		    $_SESSION['booking_start'] = time(); // taking now logged in time
            $_SESSION['booking_expire'] = $_SESSION['booking_start'] + (900) ; // ending a session in 180 seconds

		    $session_seats = "INSERT INTO booking_session (session_expiry,order_id,plan_time_id,number_of_seats,status) VALUES ('". $_SESSION['booking_expire'] . "','". $order_id . "','". $plan_time_id . "','". $number_of_seats . "','Start')";
		$session_insert = $this->db->query($session_seats);

        	$response = array("status" => "success", "msg" => "Bookingprocess");
			return $response;
	}
//#################### Booking Process End ###############//

//#################### Booking attendees Add ###############//
	public function Bookingattendees($order_id,$name,$email_id,$mobile_no)
	{
	        $sQuery = "INSERT INTO booking_event_attendees (order_id,name,email_id,mobile_no) VALUES ('". $order_id . "','". $name . "','". $email_id . "','". $mobile_no . "')";
			$booking_insert = $this->db->query($sQuery);

			$response = array("status" => "success", "msg" => "Attendees Added");
			return $response;
	}
//#################### Booking attendees End ###############//


//#################### Booking history ####################//
	public function Booking_history($user_id)
	{
	        $booking_query = "SELECT A.id,A.order_id,E.category_name,B.id AS event_id,B.event_name,B.event_venue,B.event_address,C.show_date,C.show_time,D.plan_name,A.number_of_seats, A.total_amount,A.created_at,B.event_colour_scheme FROM booking_history A,events B,booking_plan_timing C,booking_plan D,category_master E WHERE A.user_id  = '$user_id' AND A.event_id = B.id AND A.plan_time_id = C.id AND A.plan_id = D.id AND B.category_id = E.id";
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
	public function Booking_attendeesdetails($order_id)
	{
    			$attendees_query = "SELECT * FROM booking_event_attendees WHERE  order_id  ='$order_id'";
			    $attendees_res = $this->db->query($attendees_query);

    			if($attendees_res->num_rows()>0){
    			        $attendees_result= $attendees_res->result();
    			     	$response = array("status" => "success", "msg" => "View Booking attendees","Bookingattendees"=>$attendees_result);

    			}else{
    			        $response = array("status" => "error", "msg" => "Booking not found");
    			}

			return $response;
	}
//#################### Booking details End ###############//

//#################### User activity Add ###############//
	public function User_activity($rule_id,$user_id,$event_id,$date)
	{
	    if ($rule_id == '1') //Login//
	        {
                $activity_query = "SELECT * FROM user_login WHERE user_id = '$user_id' AND login_date ='$date' LIMIT 1";
    	        $activity_res = $this->db->query($activity_query);
            	if($activity_res->num_rows()==0){

                    $login_query = "SELECT * FROM user_login WHERE user_id = '$user_id' AND DATE(`login_date`) = DATE( DATE_SUB( NOW() , INTERVAL 1 DAY ) ) ORDER BY id DESC";
    		        $login_res = $this->db->query($login_query);
                	if($login_res->num_rows()>0){
                		    foreach ($login_res->result() as $rows)
                			{
                				   $day_count  = $rows->cons_login_days;
                			}
                			if ($day_count <5){
                			    $total_count = $day_count +1;
                			    $activity_sql = "INSERT INTO user_login (user_id,login_date,cons_login_days) VALUES ('". $user_id . "','". $date . "','". $total_count . "')";
    		    	            $insert_activity = $this->db->query($activity_sql);

    		    	            if ($total_count =='5'){
    		    	                $activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+20,total_points=total_points+20 WHERE user_id  ='$user_id'";
    		    	                $insert_points = $this->db->query($activity_points);
    		    	            }

    		    	             if ($total_count =='4'){
    		    	                $activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+4,total_points=total_points+4 WHERE user_id  ='$user_id'";
    		    	                $insert_points = $this->db->query($activity_points);
    		    	            }

    		    	             if ($total_count =='3'){
    		    	                $activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+3,total_points=total_points+3 WHERE user_id  ='$user_id'";
    		    	                $insert_points = $this->db->query($activity_points);
    		    	            }

    		    	             if ($total_count =='2'){
    		    	                $activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+2,total_points=total_points+2 WHERE user_id  ='$user_id'";
    		    	                $insert_points = $this->db->query($activity_points);
    		    	            }
                			} else {
                			    $total_count = 1;
                			    $activity_sql = "INSERT INTO user_login (user_id,login_date,cons_login_days) VALUES ('". $user_id . "','". $date . "','". $total_count . "')";
    		    	            $insert_activity = $this->db->query($activity_sql);

    		    	            $activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+1,total_points=total_points+1 WHERE user_id  ='$user_id'";
    		    	            $insert_points = $this->db->query($activity_points);
                			}
                	}else {
                                $total_count = 1;
                			    $activity_sql = "INSERT INTO user_login (user_id,login_date,cons_login_days) VALUES ('". $user_id . "','". $date . "','". $total_count . "')";
    		    	            $insert_activity = $this->db->query($activity_sql);

    		    	             $activity_points = "UPDATE user_points_count SET login_count = login_count+1,login_points = login_points+1,total_points=total_points+1 WHERE user_id  ='$user_id'";
    		    	             $insert_points = $this->db->query($activity_points);
                	}

            	    $response = array("status" => "added", "msg" => "User Activity Updated");
            	} else {
            	     $response = array("status" => "exist", "msg" => "Already Exist");
            	}

	        }
	    if ($rule_id == '2') //Sharing//
	        {
	            $activity_sql = "INSERT INTO user_activity (date,user_id,event_id,rule_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $event_id . "','". $rule_id . "','Sharing')";
		    	$insert_activity = $this->db->query($activity_sql);

		    	$activity_points = "UPDATE user_points_count SET sharing_count = sharing_count+1,sharing_points = sharing_points+5,total_points=total_points+5 WHERE user_id  ='$user_id'";
		    	$insert_points = $this->db->query($activity_points);

    			$response = array("status" => "success", "msg" => "User Activity Updated");
	        }
	   	if ($rule_id == '3') //Checkin//
	        {
    	       	$activity_sql = "INSERT INTO user_activity (date,user_id,event_id,rule_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $event_id . "','". $rule_id . "','Checkin')";
		    	$insert_activity = $this->db->query($activity_sql);

		    	$activity_points = "UPDATE user_points_count SET checkin_count = checkin_count+1,checkin_points = checkin_points+10,total_points=total_points+10 WHERE user_id  ='$user_id'";
		    	$insert_points = $this->db->query($activity_points);

    			$response = array("status" => "success", "msg" => "User Activity Updated");
	        }

			return $response;
	}
//#################### User activity End ###############//


//#################### Leaderboard details###############//
	public function Leaderboard($user_id)
	{
	        $leaderboard_query = "SELECT * FROM user_points_count WHERE user_id = '$user_id' LIMIT 1";
			$leaderboard_res = $this->db->query($leaderboard_query);
			$leaderboard_result= $leaderboard_res->result();

			 if($leaderboard_res->num_rows()>0){
			     $response = array("status" => "success", "msg" => "View Leaderboard","Leaderboard"=>$leaderboard_result);
			}else{
			     $response = array("status" => "error", "msg" => "Leaderboard not found");
			}

			return $response;
	}
//#################### Leaderboard End ###############//

//#################### Leaderboard details###############//
	public function Activity_history($user_id,$rule_id)
	{
	    if ($rule_id =='1') {

	            $point_query = "SELECT login_points FROM user_points_count WHERE user_id = '$user_id' LIMIT 1";
                $point_res = $this->db->query($point_query);
                if($point_res->num_rows()>0){
        		    foreach ($point_res->result() as $rows)
        			{
        		      $total_login_points  = $rows->login_points;
        			}
                }

                $login_query = "SELECT * FROM user_login WHERE user_id = '$user_id' AND DATE(`login_date`) = CURDATE() ORDER BY id DESC";
                $login_res = $this->db->query($login_query);
                if($login_res->num_rows()>0){
        		    foreach ($login_res->result() as $rows)
        			{
        		      $day_count  = $rows->cons_login_days;
        			}

                    if ($day_count =='5'){
                            $login_query = "SELECT * FROM user_login WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 5";
                    } else if ($day_count =='4') {
                            $login_query = "SELECT * FROM user_login WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 4";
                    } else if ($day_count =='3') {
                            $login_query = "SELECT * FROM user_login WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 3";
                    } else if ($day_count =='2') {
                            $login_query = "SELECT * FROM user_login WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 2";
                    } else if ($day_count =='1'){
                            $login_query = "SELECT * FROM user_login WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1";
                    }
	                $login_res = $this->db->query($login_query);
                    if($login_res->num_rows()>0){
            		    foreach ($login_res->result() as $rows) {
            		      $Data[]  = array(
    							"login_date" => $rows->login_date,
    							"cons_login_days" => $rows->cons_login_days,
        				    );
                        }
                    }

            	    $response = array("status" => "success", "msg" => "Login History","Totalpoints"=>$total_login_points,"Data"=>$Data);
                } else {
                    $response = array("status" => "error", "msg" => "No Records Found.");
                }

 	    } else if ($rule_id =='2'){
 	            $sQuery = "SELECT A.user_id,A.rule_id,A.date,B.id AS event_id,B.event_name,B.event_venue FROM user_activity A,events B WHERE A.user_id = '$user_id' AND A.rule_id = '$rule_id' AND A.event_id = B.id ORDER BY A.date DESC";
 	            $activity_res = $this->db->query($sQuery);
			    $activity_result= $activity_res->result();
			    $response = array("status" => "success", "msg" => "Sharing History","Data"=>$activity_result);

 	    } else if ($rule_id =='3'){
 	            $sQuery = "SELECT A.user_id,A.rule_id,A.date,B.id AS event_id,B.event_name,B.event_venue FROM user_activity A,events B WHERE A.user_id = '$user_id' AND A.rule_id = '$rule_id' AND A.event_id = B.id ORDER BY A.date DESC";
 	            $activity_res = $this->db->query($sQuery);
			    $activity_result= $activity_res->result();
			    $response = array("status" => "success", "msg" => "Checking History","Data"=>$activity_result);

 	    } else if ($rule_id =='4'){
 	            $sQuery = "SELECT A.user_id,A.rule_id,A.date,B.id AS event_id,B.event_name,B.event_venue FROM user_activity A,events B WHERE A.user_id = '$user_id' AND A.rule_id = '$rule_id' AND A.event_id = B.id ORDER BY A.date DESC";
 	            $activity_res = $this->db->query($sQuery);
			    $activity_result= $activity_res->result();
			    $response = array("status" => "success", "msg" => "Review History","Data"=>$activity_result);

 	    } else if ($rule_id =='5'){
 	            $sQuery = "SELECT A.user_id,A.rule_id,A.date,B.id AS event_id,B.event_name,B.event_venue FROM user_activity A,events B WHERE A.user_id = '$user_id' AND A.rule_id = '$rule_id' AND A.event_id = B.id ORDER BY A.date DESC";
 	            $activity_res = $this->db->query($sQuery);
			    $activity_result= $activity_res->result();
			    $response = array("status" => "success", "msg" => "Booking History","Data"=>$activity_result);
 	    } else {
 	            $response = array("status" => "error", "msg" => "Sorry! No Records found.");
 	    }

			return $response;
	}
//#################### Leaderboard End ###############//


//#################### Nearby Events ####################//
	public function Nearby_events($event_type,$user_type,$user_id,$city_id,$latitude,$longitude,$nearby_distance)
	{
	    $current_date = date("Y-m-d");

        if ($user_type ==1){
            $pre_query = "SELECT * FROM user_preference WHERE user_id = '$user_id'";
        } else {
            $pre_query = "SELECT * FROM guest_user_preference WHERE user_id = '$user_id'";
        }
		    $pre_res = $this->db->query($pre_query);

    		 if($pre_res->num_rows()>0){
    		    foreach ($pre_res->result() as $rows)
    			{
    				   $pref_ids[]  = $rows->category_id;
    			}
    			$preferrence = implode (",", $pref_ids);
    		 }


	    if ($event_type == 'Favourite'){
	        $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity,
	                        (3959 * acos( cos( radians('$latitude')) * cos(radians(event_latitude)) * cos(radians(event_longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin(radians( event_latitude) ))) AS distance
                            from events as ev
                            left join event_popularity as ep on ep.event_id = ev.id
                            LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                            LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                            WHERE ev.hotspot_status = 'N' AND ev.end_date>= '$current_date' AND  ev.category_id IN ($preferrence) AND  ev.event_status  ='Y'
                            group by ev.id HAVING distance <= '$nearby_distance'";
	    }
	    if ($event_type == 'Hotspot'){
	            $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity,
	                        (3959 * acos( cos( radians('$latitude')) * cos(radians(event_latitude)) * cos(radians(event_longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin(radians( event_latitude) ))) AS distance
                            from events as ev
                            left join event_popularity as ep on ep.event_id = ev.id
                            LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                            LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                            WHERE ev.hotspot_status = 'Y' AND  ev.category_id IN ($preferrence) AND  ev.event_status  ='Y'
                            group by ev.id HAVING distance <= '$nearby_distance'";
	    }
	    if ($event_type == 'Popular'){
	            $event_query = "select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity,
	                        (3959 * acos( cos( radians('$latitude')) * cos(radians(event_latitude)) * cos(radians(event_longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin(radians( event_latitude) ))) AS distance
                            from events as ev
                            left join event_popularity as ep on ep.event_id = ev.id
                            LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                            LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                            WHERE ev.hotspot_status = 'N' AND ev.end_date>= '$current_date' AND  ev.category_id IN ($preferrence) AND  ev.event_status  ='Y'
                            group by ev.id HAVING distance <= '$nearby_distance' ORDER by popularity DESC";
	    }
		//echo $event_query;
		$event_res = $this->db->query($event_query);

		 if($event_res->num_rows()>0){
                $event_result= $event_res->result();

                foreach ($event_res->result() as $rows)
			    {
				     $eventData[]  = array(
							"event_id" => $rows->id,
							"popularity" => $rows->popularity,
							"category_id" => $rows->category_id,
							"event_name" => $rows->event_name,
							"event_venue" => $rows->event_venue,
							"event_address" => $rows->event_address,
							"description" => $rows->description,
							"start_date" => $rows->start_date,
							"end_date" => $rows->end_date,
							"start_time" => $rows->start_time,
							"end_time" => $rows->end_time,
							"event_banner" => base_url().'assets/events/banner/'.$rows->event_banner,
							"event_latitude" => $rows->event_latitude,
							"event_longitude" => $rows->event_longitude,
							"event_country" => $rows->event_country,
							"country_name" => $rows->country_name,
							"event_city" => $rows->event_city,
							"city_name" => $rows->city_name,
							"primary_contact_no" => $rows->primary_contact_no,
							"secondary_contact_no" => $rows->secondary_contact_no,
							"contact_person" => $rows->contact_person,
							"contact_email" => $rows->contact_email,
							"event_type" => $rows->event_type,
							"adv_status" => $rows->adv_status,
							"booking_status" => $rows->booking_status,
							"hotspot_status" => $rows->hotspot_status,
							"event_colour_scheme" => $rows->event_colour_scheme,
							"event_status" => $rows->event_status,
							"advertisement" => ''
				    );
			    }

			     	$response = array("status" => "success", "msg" => "View Events","Eventdetails"=>$eventData);
			}else{
			        $response = array("status" => "error", "msg" => "Events not found");
			}

			return $response;
	}
//#################### Nearby Events End ###############//


//#################### Organizer request ###############//
	public function Organizer_request($user_id,$message)
	{
	$sql = "SELECT A.id as userid, A.user_name, A.mobile_no, A.email_id, A.email_verify, A.login_count, A.user_role, B.name, B.birthdate, B.gender, B.occupation, B.address_line1, B.address_line2, B.address_line3, B.country_id, B. state_id, B.city_id, B.zip, B.user_picture, B.newsletter_status, B.referal_code, C.user_role_name FROM user_master A, user_details B, user_role_master C WHERE A.id=B.user_id AND A.user_role = C.id AND A.id ='".$user_id."'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();
		if($user_result->num_rows()>0)
		{
			foreach ($user_result->result() as $rows)
			{
				  $email_id = $rows->email_id;
				  $mobile_no = $rows->mobile_no;
				  $name = $rows->name;
			}

			echo $activity = "INSERT INTO organiser_request (name,user_id,email_or_phone,message,req_status,created_at ) VALUES ('". $name . "','". $user_id . "','". $email_id . "','". $message . "','Pending',NOW())";
		    $insert_query = $this->db->query($activity);

			$email_id = 'hello@heylaapp.com';
			$subject = "Heyla App - Event Organizer Request";
            $email_message = 'Dear Admin<br><br>Event Organizer Reguest from,<br>Name :'.$name.'<br> Email : '.$email_id.'<br>Mobile :'.$mobile_no.'<br>';
            $this->sendMail($email_id,$subject,$email_message);

    		$response = array("status" => "success", "msg" => "Mail Send to Admin");

		}
	}
//#################### Organizer request End ###############//

      //----- User Points--------//

    function user_points($user_id){
      $select="SELECT IFNULL(ud.name,'') as name,IFNULL( um.user_name,'') as user_name,IFNULL(um.email_id,'') as email_id,upc.user_id,upc.total_points,IFNULL(ud.user_picture,'') as user_picture ,IFNULL(um.id,'') as id FROM user_points_count as upc
      left join user_details as ud on ud.user_id=upc.user_id left join user_master as um on um.id= upc.user_id order by upc.total_points desc";
      $user_result = $this->db->query($select);
      if($user_result->num_rows()==0){
        $response = array("status" => "error", "msg" => "no points found");

      }else{
        foreach ($user_result->result() as $rows)
  			{
          if(empty($rows->user_picture)){
            $picture='';
          }else{
              $picture=base_url().'assets/users/profile/'.$rows->user_picture;
          }
  				$user_poinst[]=array(
            "user_name" => $rows->user_name,
  				  "name" => $rows->name,
            "id" => $rows->id,
            "email_id" => $rows->email_id,
            "user_picture" => $picture,
  				  "total_points" => $rows->total_points,
            );

  			}
          $response = array("status" => "success", "msg" => "Points found","user_points"=>$user_poinst);

      }
      return $response;


    }

//#################### Refund request ###############//
	public function Refund_request($user_id,$order_id)
	{
	    $check_eve="SELECT * FROM refund_request WHERE order_id='$order_id'";
		$result=$this->db->query($check_eve);
		  if($result->num_rows()==0)
		   {
				$query="INSERT INTO refund_request(user_id,order_id,status,created_at) VALUES ('$user_id','$order_id','Pending',NOW())";
				$resultset=$this->db->query($query);

    			$email_id = 'info@heylaapp.com';
    			$subject = "Heyla App - Refund Request";
                $email_message = '<html>
						 <body>
							<p>Order Id : '.$order_id.'</p>
							<p>User Id : '.$user_id.'</p>
						 </body>
						 </html>';
            $this->sendMail($email_id,$subject,$email_message);

    		$response = array("status" => "success", "msg" => "Mail Send to Admin");
		} else {
		    $response = array("status" => "error", "msg" => "Already Request");
		}
		return $response;
	}
//#################### Refund request End ###############//





}

?>

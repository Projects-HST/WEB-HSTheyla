<?php
date_default_timezone_set('Asia/Kolkata');
$current_time = date("h:i A", time());

$con = @mysql_connect("localhost","root","O+E7vVgBr#{}");

if ($con) {
		mysql_select_db('heylaapp_app');
    } else {
		die("Connection failed");
}

//#################### Email ####################//

	 function sendMail($to,$subject,$email_message)
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

	 function sendNotification($gcm_key,$Title,$Message,$mobiletype)
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

	 function sendSMS($Phoneno,$Message)
	{
        //Your authentication key
        $authKey = "270429AChw544RizSP5deb6e61";
        
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

        $sQuery = "SELECT * FROM
            booking_history A,
            events B,
            user_master C,
            booking_plan_timing D,
            booking_plan E
        WHERE
        	A.event_id = B.id AND A.user_id = C.id AND A.plan_time_id = D.id AND A.plan_id = E.id AND A.booking_date = CURDATE()";
	
        $objRs = mysql_query($sQuery);
        if (mysql_num_rows($objRs)> 0)
        	{
        		while ($row = mysql_fetch_array($objRs))
        		{
		                   $show_time = trim($row['show_time']);
	                       $timestamp = strtotime($show_time) - 60*60;
	                       $sms_time = date('h:i A', $timestamp);
	                       
        	                $order_id = trim($row['order_id']) ;
                			$event_id = trim($row['event_id']) ;
                			$event_name = trim($row['event_name']) ;
                			$plan_id = trim($row['plan_id']) ;
                			$plan_name = trim($row['plan_name']) ;
                		    $plan_time_id = trim($row['plan_time_id']) ;
                		    //$show_time = trim($row['show_time']) ;
                			$user_id = trim($row['user_id']) ;
                			$user_email = trim($row['email_id']) ;
                			$user_mobile = trim($row['mobile_no']) ;
                			$number_of_seats = trim($row['number_of_seats']) ;
                			$total_amount = trim($row['total_amount']) ;
                			$booking_date = trim($row['booking_date']) ;

        	           
        	           if ($current_time ==  $sms_time) {
        	               
        	               $subject = 'Heyla App - Event Booking Reminder';
	                       $email_message ='<html>
                    			 <body>
                    			    <p>Order Id : '.$order_id.'</p>
                    				<p>Event Name : '.$event_name.'</p>
                    				<p>Plan Name : '.$plan_name.'</p>
                    				<p>No. of Seats : '.$number_of_seats.'</p>
                    				<p>Booking Date : '.$sbooking_date.' '.$show_time.'</p>
                    				<p>More detail please <a href="https://goo.gl/A6DGuZ">login</a></p>
                    			 </body>
                    			 </html>';
                    	   sendMail($user_email,$subject,$email_message);
                    	   
                    	  $mobile_message = "Hi Customer, Booking Id : ".$order_id. " Seats : ".$plan_name.", [".$number_of_seats."] for ".$event_name." on ".$sbooking_date." ".$show_time.". More detail https://goo.gl/A6DGuZ";
                    	  sendSMS($user_mobile,$mobile_message);
        	           }
        		}
        	}
        		      


?>
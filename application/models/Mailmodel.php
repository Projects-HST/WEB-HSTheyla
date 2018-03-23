<?php
Class Mailmodel extends CI_Model
{
	public function __construct()
	{
	  parent::__construct();
	}

  function send_mail_to_users($user_ids,$email_temp_id)
  {  
  	//echo $user_ids; echo $email_temp_id;exit;
  	 $tsql="SELECT id,template_name,template_content FROM email_template WHERE id='$email_temp_id'";
	 $res=$this->db->query($tsql);
	 $result1=$res->result();
	 foreach($result1 as $rows){ } 
	  $subject = $rows->template_name;
	  $cnotes = $rows->template_content;
	  $htmlContent = '<html>
					<body>
					<p style="margin-left:50px;">'.$cnotes.'</p>
					</body>
					</html>';
	 $headers = "MIME-Version: 1.0" . "\r\n";
	 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	 // Additional headers
	 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";

	  $sql="SELECT * FROM user_master WHERE id IN ($user_ids)";
	  $result=$this->db->query($sql);
	  $user_result=$result->result();
	  $count = $result->num_rows();
	  $i = 1;
	  $toemail ='';
	  if($count>0) {
		  foreach($user_result as $row){ 
			$to_email = $row->email_id;
			if ($i< $count){
				$toemail .= $to_email.",";
			} else {
				$toemail .= $to_email;
			}
				$i = $i+1;
			} 
			//echo $toemail;
			mail($to_email,$subject,$htmlContent,$headers);
		}
  }
  
  
  function send_sms_to_users($user_ids,$email_temp_id)
  {  
  	 $tsql="SELECT id,template_name,template_content FROM email_template WHERE id='$email_temp_id'";
	 $res=$this->db->query($tsql);
	 $result1=$res->result();
	 foreach($result1 as $rows){ } 
	  $subject = $rows->template_name;
	  
	  $sql="SELECT * FROM user_master WHERE id IN ($user_ids)";
	  $result=$this->db->query($sql);
	  $user_result=$result->result();
	  $count = $result->num_rows();
	  $i = 1;
	  $tomobile ='';
	  if($count>0) {
		  foreach($user_result as $row){ 
			$to_mobile = $row->mobile_no;
			if ($i< $count){
				if ($to_mobile!=""){
					$tomobile .= $to_mobile.",";
				}
			} else {
				$tomobile .= $to_mobile;
			}
				$i = $i+1;
			} 
			//echo $tomobile;
			
			//Your authentication key
        $authKey = "191431AStibz285a4f14b4";
        
        //Multiple mobiles numbers separated by comma
        $mobileNumber = "$tomobile";
        
        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "HEYLAA";
        
        //Your message to send, Add URL encoding here.
        $message = urlencode($subject);
        
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
	
  }
  
  
  
  function send_nofify_to_users($user_ids,$email_temp_id)
  {  
  	 $tsql="SELECT id,template_name,template_content FROM email_template WHERE id='$email_temp_id'";
	 $res=$this->db->query($tsql);
	 $result1=$res->result();
	 foreach($result1 as $rows){ } 
	  $subject = $rows->template_name;
	  $cnotes = $rows->template_content;
	  
	  $sql="SELECT * FROM push_notification_master WHERE user_id IN ($user_ids)";
	  $result=$this->db->query($sql);
	  $user_result=$result->result();
	  $count = $result->num_rows();
	  if($count>0) {
		  foreach($user_result as $row){ 
			//$gcm_key = $row->gcm_key;
			//$mobile_type = $row->mobile_type;
			
			$gcm_key = "dsHTx4h4O8o:APA91bH1LrWneoWTlxcM6rExh95xibv6ryWMfVIOEeA3llsTwRuxO3VXAjY9Jg5QKMa_C8nJpMq_60HHSLnYjW7y8_lbyw-TvAwcsBd3fT7eobwWfZsgCw5JVwMLH2kTFT6DDFlCYR6e";
			$mobile_type = '1';
			
			if ($mobile_type =='1'){

				require_once 'assets/notification/Firebase.php';
				require_once 'assets/notification/Push.php'; 
				
				//$device_token = explode(",", $gcm_key);
				$push = null; 
			
	//        //first check if the push has an image with it
				$push = new Push(
						$subject,
						$cnotes,
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
				$firebase->send($gcm_key,$mPushNotification);
	
			//foreach($device_token as $token) {
			//	 $firebase->send(array($token),$mPushNotification);
			//}

		} else {
            
			//$device_token = explode(",", $gcm_key);
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
					'body' => $subject,
					'action-loc-key' => 'Heyla App',
				),
				'badge' => 2,
				'sound' => 'assets/notification/oven.caf',
				);
			
			$payload = json_encode($body);

				$msg = chr(0) . pack("n", 32) . pack("H*", str_replace(" ", "", $gcm_key)) . pack("n", strlen($payload)) . $payload;
        		$result = fwrite($fp, $msg, strlen($msg));

			//foreach($device_token as $token) {
			
				// Build the binary notification
    			//$msg = chr(0) . pack("n", 32) . pack("H*", str_replace(" ", "", $token)) . pack("n", strlen($payload)) . $payload;
        		//$result = fwrite($fp, $msg, strlen($msg));
			//}
							
				fclose($fp);
		}

			
		}
	  }
  }
  
}
?>
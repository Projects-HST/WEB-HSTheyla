<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");
    session_start();

	// following files need to be included
	require_once("./lib/config_paytm.php");
	require_once("./lib/encdec_paytm.php");
    require_once("./lib/connection.php");
    $current_time = time(); 
	$ORDER_ID = "";
	$requestParamList = array();
	$responseParamList = array();

	if (isset($_GET["ORDER_ID"]) && $_GET["ORDER_ID"] != "") {

		// In Test Page, we are taking parameters from POST request. In actual implementation these can be collected from session or DB. 
	 	$ORDER_ID = $_GET["ORDER_ID"];

		// Create an array having all required parameters for status query.
		$requestParamList = array("MID" => PAYTM_MERCHANT_MID , "ORDERID" => $ORDER_ID);  
		
		$StatusCheckSum = getChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY);
		$requestParamList['CHECKSUMHASH'] = $StatusCheckSum;

		// Call the PG's getTxnStatusNew() function for verifying the transaction status.
		$responseParamList = getTxnStatusNew($requestParamList);
		//echo "<pre>";
		//print_r ($responseParamList);
		
		 $TXNID = $responseParamList["TXNID"];
		 $BANKTXNID = $responseParamList["BANKTXNID"];
		 $ORDERID = $responseParamList["ORDERID"];
		 $TXNAMOUNT = $responseParamList["TXNAMOUNT"];
		 $STATUS = $responseParamList["STATUS"];
		 $TXNTYPE = $responseParamList["TXNTYPE"];
		 $GATEWAYNAME = $responseParamList["GATEWAYNAME"];
		 $RESPCODE = $responseParamList["RESPCODE"];
		 $RESPMSG = $responseParamList["RESPMSG"];
		 $BANKNAME = $responseParamList["BANKNAME"];
		 $MID = $responseParamList["MID"];
		 $PAYMENTMODE = $responseParamList["PAYMENTMODE"];
		 $REFUNDAMT = $responseParamList["REFUNDAMT"];
		 $TXNDATE = $responseParamList["TXNDATE"];
	}
	
	
	    $string = $ORDERID;
        $result = explode("-", $string);
        $order_id=$result[0];  
        $user_id= $result[1];
    
    
        $sQuery = "SELECT * FROM user_master WHERE id='" .$user_id. "'";
        $objRs = mysql_query($sQuery);
            if (mysql_num_rows($objRs)> 0)
        	{
        		while ($row = mysql_fetch_array($objRs))
        		{
        		    $id = trim($row['id']);
        		    $user_name = trim($row['user_name']) ;
        		    $mobile_no = trim($row['mobile_no']) ;
        			$email_id = trim($row['email_id']) ;
        			$user_role = trim($row['user_role']) ;
        		}
            }
        $data =  array("user_name" => $user_name,"mobile_no"=>$mobile_no,"email_id"=>$email_id,"user_role"=>$user_role,"id"=>$id);
        $_SESSION['userdata'] = $data;

    
    $sQuery = "SELECT * FROM booking_status_paytm WHERE order_id ='" .$ORDERID. "'";
    $objRs = mysql_query($sQuery);
            if (mysql_num_rows($objRs) == 0)
        	{
        	
        	$sQuery = "INSERT INTO booking_status_paytm (order_id,user_id,track_id,bank_trans_id,amount,order_status,trans_type,gateway,resp_code,resp_msg,bank_name,mid,payment_mode,refunt_amt, trans_date) VALUES ('$ORDERID','$user_id','$TXNID','$BANKTXNID','$TXNAMOUNT','$STATUS','$TXNTYPE','$GATEWAYNAME','$RESPCODE','$RESPMSG','$BANKNAME','$MID','$PAYMENTMODE','$REFUNDAMT','$TXNDATE')";
		    $objRs  = mysql_query($sQuery) or die("Could not select Query ");
    
            $sQuery = "SELECT
                        A.*,
                        B.mobile_no,
                        B.email_id,
                        C.plan_name,
                        D.show_time
                    FROM
                        booking_process A,
                        user_master B,
                        booking_plan C,
                        booking_plan_timing D
                    WHERE
                        A.user_id = B.id AND A.plan_id = C.id AND A.plan_time_id = D.id AND A.order_id = '" .$ORDERID. "'";
            $objRs = mysql_query($sQuery);
            if (mysql_num_rows($objRs)> 0)
            	{
            		while ($row = mysql_fetch_array($objRs))
            		{
            			$order_id = trim($row['order_id']) ;
            			$event_id = trim($row['event_id']) ;
            			$plan_id = trim($row['plan_id']) ;
            			$plan_name = trim($row['plan_name']) ;
            		    $plan_time_id = trim($row['plan_time_id']) ;
            		    $show_time = trim($row['show_time']) ;
            			$user_id = trim($row['user_id']) ;
            			$user_email = trim($row['email_id']) ;
            			$user_mobile = trim($row['mobile_no']) ;
            			$number_of_seats = trim($row['number_of_seats']) ;
            			$total_amount = trim($row['total_amount']) ;
            			$booking_date = trim($row['booking_date']) ;
            			$created_at  = date('Y-m-d H:i:s');
            			
            		}
                }
         
            $sQuery = "SELECT A.id,A.event_name, A.created_by,B.id AS user_id, B.email_id,B.mobile_no FROM events A,user_master B WHERE A.created_by = B.id AND A.id   = '" .$event_id. "'";
            $objRs = mysql_query($sQuery);
                if (mysql_num_rows($objRs)> 0)
            	{
            		while ($row = mysql_fetch_array($objRs))
            		{
            		    $event_name = trim($row['event_name']) ;
            			$created_email = trim($row['email_id']) ;
            			$created_mobile = trim($row['mobile_no']) ;
            		}
                }
        

    	    if($STATUS=="TXN_SUCCESS")
    	    {
				
				$sQuery = "SELECT * FROM booking_session WHERE order_id = '" .$order_id. "' AND session_expiry <= '" .$current_time. "' AND status = 'Expiry' ";
				$objRs = mysql_query($sQuery);
                if (mysql_num_rows($objRs)== 0)
            	{
					$enc_order_id = base64_encode($order_id);
					$sbooking_date = date("d-m-Y", strtotime($booking_date));
					$transaction_date = date("d-m-Y H:i:s"); 
					$subject = "Heyla App Ticket Booking";
/*
							Hi <Name>, 
								Bravo!
								Your booking for <Event name> has been confirmed. 
								Booking ID – 9462961-116
								Event name:
								Ticket: Platinum
								Seats: <Seat Numbers>
								Admit: 1 for Clowns, Puppets and more
								Event Date and time : 28/04/2019 at 05:30 P.M.
								Transaction date and time: 25/03/2019 at 04:42:04
								Find more details on 
								<link>

								We wish you to make Cheerful Memories with each event!
								Or
								We wish you for an event that is memorable and enjoyable!

								Regards,
								Team Heyla
*/
					$email_message ='<html>
									 <body>
										<p>Order Id : '.$order_id.'</p>
										<p>Event Name : '.$event_name.'</p>
										<p>Plan Name : '.$plan_name.'</p>
										<p>No. of Seats : '.$number_of_seats.'</p>
										<p>Booking Date : '.$sbooking_date.' '.$show_time.'</p>
										<p>Transaction Date : '.$transaction_date.'</p>
										<p>More detail please <a href="https://goo.gl/A6DGuZ">login</a></p>
									 </body>
									 </html>';
					
					
					$Message = "Hi Customer, Booking Id : ".$order_id. "Seats : ".$plan_name."," .$number_of_seats." for ".$event_name." on ".$sbooking_date." ".$show_time.". Transaction Date : ".$transaction_date." More detail https://goo.gl/A6DGuZ";
				  //Your authentication key
					$authKey = "242202ALE69fBMks5bbee06b";
					
					//Multiple mobiles numbers separated by comma
					$mobileNumber = "$created_mobile,$user_mobile";
					
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
					
					
					$sender_emails = $created_email.','.$user_email;
					
					// Set content-type header for sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					// Additional headers
					$headers .= 'From: Heyla App<hello@heylaapp.com>' . "\r\n";
					mail($sender_emails,$subject,$email_message,$headers);
					
					
					$sQuery = "INSERT INTO booking_history (order_id,event_id,plan_id,plan_time_id,user_id,number_of_seats,booking_date,total_amount,payment_gateway,created_at) VALUES ('". $order_id . "','". $event_id . "','". $plan_id . "','". $plan_time_id . "','". $user_id . "','". $number_of_seats . "','". $booking_date . "','". $total_amount . "','Paytm','". $created_at . "')";
					$insert_query = mysql_query($sQuery) or die("Could not select Query ");
					
					$activity_sql = "INSERT INTO user_activity (date,user_id,event_id,rule_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $event_id . "','5','Booking')";
					$insert_activity = mysql_query($activity_sql) or die("Could not select Query ");
					
					$activity_points = "UPDATE user_points_count SET booking_count  = booking_count+1,booking_points=booking_points+20,total_points=total_points+20 WHERE user_id ='$user_id'";
					$insert_points = mysql_query($activity_points) or die("Could not select Query ");
					
					header("Location: https://heylaapp.com/home/eventattendees/".$enc_order_id."");
				} else {
					$enc_order_id = base64_encode($order_id);
					header("Location: https://heylaapp.com/home/paymentrefund/".$enc_order_id."");
				}
 
    	    }

        	if($STATUS=="TXN_FAILURE")
        	{
        	   header("Location: https://heylaapp.com/home/paymenterror/");
        	}
        	
        	if($STATUS=="PENDING")
        	{
        	   header("Location: https://heylaapp.com/home/paymenterror/");
        	}
  	
    }
?>
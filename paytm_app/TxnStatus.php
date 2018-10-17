<?php
    require_once("./lib/connection.php");
    
		$current_time = time(); 
        $TXNID = $_POST["TXNID"];
        $BANKTXNID = $_POST["BANKTXNID"];
        $ORDERID = $_POST["ORDERID"];
        $TXNAMOUNT = $_POST["TXNAMOUNT"];
        $STATUS = $_POST["STATUS"];
        $TXNTYPE = "SALE";
        $GATEWAYNAME = $_POST["GATEWAYNAME"];
        $RESPCODE = $_POST["RESPCODE"];
        $RESPMSG = $_POST["RESPMSG"];
        $BANKNAME = $_POST["BANKNAME"];
        $MID = $_POST["MID"];
        $PAYMENTMODE = $_POST["PAYMENTMODE"];
        $REFUNDAMT = "0.00";
        $TXNDATE = $_POST["TXNDATE"];
        
        $string = $ORDERID;
        $result = explode("-", $string);
        $order_id=$result[0];  
        $user_id= $result[1];
    
    
		$sQuery = "INSERT INTO booking_status_paytm (order_id,user_id,track_id,bank_trans_id,amount,order_status,trans_type,gateway,resp_code,resp_msg,bank_name,mid,payment_mode,refunt_amt, trans_date) VALUES ('$ORDERID','$user_id','$TXNID','$BANKTXNID','$TXNAMOUNT','$STATUS','$TXNTYPE','$GATEWAYNAME','$RESPCODE','$RESPMSG','$BANKNAME','$MID','$PAYMENTMODE','$REFUNDAMT','$TXNDATE')";
		$objRs  = mysql_query($sQuery) or die("Could not select Query ");
			
		
		//$sQuery = "INSERT INTO booking_status (order_id,user_id,track_id,bank_ref_no,order_status,failure_message,payment_mode,card_name,status_code,status_message,currency,amount,billing_name,billing_address, billing_city,billing_state,billing_zip,billing_country,billing_tel,billing_email,delievery_name,delievery_address,delievery_city,delievery_state,delievery_zip,delievery_country,delievery_tel,merch_param1,merch_param2,merch_param3,merch_param4,merch_param5,vault,offer_type,offer_code,discount_value, mer_amt,eci_value,retry,response_code,billing_notes,trans_date,bin_country) VALUES ('$orderid','$user_id','$track_id','$bank_ref_no','$order_status','$failure_message','$payment_mode','$card_name','$status_code','$status_message','$currency','$amount','$billing_name','$billing_address','$billing_city','$billing_state','$billing_zip','$billing_country','$billing_tel','$billing_email','$delievery_name','$delievery_address','$delievery_city','$delievery_state','$delievery_zip','$delievery_country','$delievery_tel','$merch_param1','$merch_param2','$merch_param3','$merch_param4','$merch_param5','$vault','$offer_type','$offer_code','$discount_value','$mer_amt','$eci_value','$retry','$response_code','$billing_notes','$transdate','$bin_country')";
		//$objRs  = mysql_query($sQuery) or die("Could not select Query ");
    
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
                
                $res = array();
			    $res["message"] = "Success";
			    echo json_encode($res);
			} else {
				$res = array();
				$res["message"] = "Refund";
				echo json_encode($res);
				}
    	} else {
    	    $res = array();
    	        $res["message"] = "Error";
			    echo json_encode($res);
    	}

?>
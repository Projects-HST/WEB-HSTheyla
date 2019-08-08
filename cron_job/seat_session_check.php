<?php

$con = @mysql_connect("localhost","root","O+E7vVgBr#{}");

if ($con) {
		mysql_select_db('heylaapp_app');
    } else {
		die("Connection failed");
}

        $now = time(); // checking the time now when home page starts

        $sQuery = "SELECT * FROM booking_session";
        $objRs = mysql_query($sQuery);
        if (mysql_num_rows($objRs)> 0)
        	{
        		while ($row = mysql_fetch_array($objRs))
        		{
        		    $session_id = trim($row['id']) ;
        		    $session_expiry = trim($row['session_expiry']) ;
        		    $order_id = trim($row['order_id']) ;
        		    $plan_time_id = trim($row['plan_time_id']) ;
        			$number_of_seats = trim($row['number_of_seats']) ;
        		
        			if($now > $session_expiry)
                    {
                            $check_seats = "SELECT * FROM booking_history WHERE order_id = '$order_id' LIMIT 1";
                            $objRs1 = mysql_query($check_seats);
                            if (mysql_num_rows($objRs1)== 0)
                                {
                                    $update_seats = "UPDATE booking_plan_timing SET seat_available = seat_available+$number_of_seats WHERE id ='$plan_time_id'";
                                    $objRs2 = mysql_query($update_seats);
                                    
                                    $update_session = "UPDATE booking_session SET status = 'Expiry' WHERE id = '$session_id'";
                                    $objRs3 = mysql_query($update_session);
                                    
                                   // $delete_session = "DELETE FROM booking_session WHERE id = '$session_id'";
                                    //$objRs3 = mysql_query($delete_session);
                                }
                    }
        		}
            }
?>
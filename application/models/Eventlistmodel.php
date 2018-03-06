<?php
Class Eventlistmodel extends CI_Model
{
	public function __construct()
	 {
		  parent::__construct();
	 }
  
  	function getall_country_list()
    {
      $sql="SELECT id,country_name,event_status FROM country_master WHERE event_status='Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }
	
    function getall_city_list()
    {
      $sql="SELECT id,city_name FROM city_master WHERE event_status='Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }
	   
    function getall_category_list()
    {
      $sql="SELECT id,category_name FROM category_master  WHERE status='Y' ORDER BY id ASC";
      $resu=$this->db->query($sql);
      $res=$resu->result();
      return $res;
    }
	
    function getcityname($country_id)
    {
        $query="SELECT id,city_name FROM city_master WHERE country_id='$country_id' AND event_status='Y'";
        $resultset=$this->db->query($query);
        $row=$resultset->result();
        return $row;
    }
      
	
	function getadv_events()
    {
		$current_date = date("Y-m-d");
      	$sql="select ev.*, ci.city_name, cy.country_name, count(ep.event_id) as popularity
                        from events as ev
                        left join event_popularity as ep on ep.event_id = ev.id
                        LEFT JOIN city_master AS ci ON ev.event_city = ci.id
                        LEFT JOIN country_master AS cy ON ev.event_country = cy.id
                        LEFT JOIN adv_event_history AS aeh ON aeh.event_id = ev.id
                        WHERE ev.end_date>= '$current_date' AND ev.event_status  ='Y' AND aeh.date_to >= '$current_date' group by ev.id, aeh.event_id";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function get_events()
    {
		$current_date = date("Y-m-d");
      	$sql="SELECT ev.*,cy.country_name,ci.city_name,ca.category_name FROM country_master AS cy,city_master AS ci,category_master AS ca,events AS ev WHERE ev.category_id=ca.id AND ev.event_country=cy.id AND ev.event_city=ci.id AND ev.end_date>= '$current_date' AND ev.event_status='Y' ORDER BY ev.event_name";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function getall_events($limit, $offset)
    {
		$current_date = date("Y-m-d");
		$limit = (intval($limit) != 0 ) ? $limit : 10;
		$offset = (intval($offset) != 0 ) ? $offset : 0;

		if ($this->session->userdata('id') !=''){
			$user_id = $this->session->userdata('id');
		} else {
			$user_id = 0;
		}

		$sql="SELECT e.*,cy.country_name,ci.city_name,uwl.user_id as wlstatus
				FROM events AS e
				LEFT JOIN user_wish_list AS uwl ON uwl.event_id = e.id AND uwl.user_id = '$user_id'
				LEFT JOIN country_master AS cy ON e.event_country = cy.id
				LEFT JOIN city_master AS ci ON e.event_city = ci.id
				LEFT JOIN category_master AS ca ON e.category_id = ca.id
				WHERE e.end_date >= '$current_date' AND e.event_status = 'Y' ORDER BY e.id DESC LIMIT $limit OFFSET $offset";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	
	function getsearch_events($country_id,$city_id,$category_id)
    {
		$current_date = date("Y-m-d");
		
		if ($this->session->userdata('id') !=''){
			$user_id = $this->session->userdata('id');
		} else {
			$user_id = 0;
		}
		
		 $sql="SELECT e.*,cy.country_name,ci.city_name,uwl.user_id as wlstatus FROM events AS e LEFT JOIN user_wish_list AS uwl ON uwl.event_id = e.id AND uwl.user_id = '$user_id' LEFT JOIN country_master AS cy ON e.event_country = cy.id LEFT JOIN city_master AS ci ON e.event_city = ci.id LEFT JOIN category_master AS ca ON e.category_id = ca.id WHERE e.end_date >= '$current_date' AND e.event_country='$country_id' AND e.event_city='$city_id' AND e.event_status = 'Y' AND e.category_id IN ($category_id) ORDER BY e.id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function getsearch_term_events($srch_term)
    {
		$current_date = date("Y-m-d");
		
		if ($this->session->userdata('id') !=''){
			$user_id = $this->session->userdata('id');
		} else {
			$user_id = 0;
		}
		
		 $sql="SELECT e.*,cy.country_name,ci.city_name,uwl.user_id as wlstatus FROM events AS e LEFT JOIN user_wish_list AS uwl ON uwl.event_id = e.id AND uwl.user_id = '$user_id' LEFT JOIN country_master AS cy ON e.event_country = cy.id LEFT JOIN city_master AS ci ON e.event_city = ci.id LEFT JOIN category_master AS ca ON e.category_id = ca.id WHERE e.end_date >= '$current_date' AND e.event_name like '%$srch_term%' AND e.event_status = 'Y' ORDER BY e.id DESC";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function getevent_details($event_id)
    {
		$current_date = date("Y-m-d");
      	$sql="SELECT ev.*,cy.country_name,ci.city_name,ca.category_name FROM country_master AS cy,city_master AS ci,category_master AS ca,events AS ev WHERE ev.category_id=ca.id AND ev.event_country=cy.id AND ev.event_city=ci.id AND ev.end_date>= '$current_date' AND ev.event_status='Y' AND ev.id ='$event_id' ";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function getevent_reviews($event_id)
    {
		$current_date = date("Y-m-d");
		$sql="SELECT * FROM event_reviews A, user_master B WHERE A.user_id = B.id AND A.event_id ='$event_id'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function getevent_gallery($event_id)
    {
		$sql="SELECT * FROM event_images WHERE event_id = '$event_id'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function eventwishlist($user_id,$event_id)
    {
		$sql="SELECT event_id FROM user_wish_list WHERE user_id = '$user_id'";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
	  	return $res;
    }
	
	function update_wishlist($user_id,$event_id)
    {
		$sql = "SELECT * FROM user_wish_list WHERE user_id = '$user_id' AND event_id = '$event_id'";
		$resu=$this->db->query($sql);
			if($resu->num_rows()>0)
	        {
				$sql = "DELETE FROM user_wish_list WHERE user_id='$user_id' AND event_id ='$event_id' ";
       			$result=$this->db->query($sql);
				$res = "Updated";
				//$res = "wishlist".$event_id;
			} else {
				$sql="INSERT INTO user_wish_list (user_id,event_id) VALUES('$user_id','$event_id')";
        		$result=$this->db->query($sql);
				$res = "Added";
			}
	  	return $res;
    }
	
	function update_sharing($user_id,$event_id)
    {
				$activity_sql = "INSERT INTO user_activity (date,user_id,event_id,rule_id,activity_detail) VALUES (NOW(),'". $user_id . "','". $event_id . "','2','Sharing')";
		    	$insert_activity = $this->db->query($activity_sql);
		    	
		    	$activity_points = "UPDATE user_points_count SET sharing_count = sharing_count+1,sharing_points = sharing_points+5,total_points=total_points+5 WHERE user_id  ='$user_id'";
		    	$insert_points = $this->db->query($activity_points);
				
			$res = "Added";
			return $res;
    }
	
	
	function booking_plandates($event_id)
    {
		$sql="SELECT show_date FROM booking_plan_timing WHERE event_id  ='". $event_id . "' AND `show_date` >= CURDATE()  GROUP BY show_date";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
		return $res;
    }
	
	function booking_plantimes($event_id,$plan_date)
    {
		$sql="SELECT id,show_time,show_date FROM booking_plan_timing WHERE event_id  = '$event_id' AND show_date='$plan_date' GROUP BY show_time";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
		return $res;
    }
	
	function booking_plans($event_id,$plan_date,$plan_time)
    {
		$sql="SELECT B.plan_name,B.seat_rate,A.event_id,A.plan_id,A.id AS plantime_id, A.show_date,A.show_time,A.seat_available FROM booking_plan_timing A,booking_plan B WHERE A.event_id  = '$event_id' AND show_date = '$plan_date' AND show_time = '$plan_time' AND A.seat_available>0 AND A.plan_id = B.id";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
		return $res;
    }
	
	function booking_seats($event_id,$plan_date,$plan_time,$show_plan)
    {
		$sql="SELECT B.plan_name,B.seat_rate,A.event_id,A.plan_id,A.id AS plantime_id, A.show_date,A.show_time,A.seat_available FROM booking_plan_timing A,booking_plan B WHERE A.event_id  = '$event_id' AND show_date = '$plan_date' AND show_time = '$plan_time' AND A.seat_available>0 AND B.plan_name='$show_plan' AND A.plan_id = B.id";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
		return $res;
    }
	
	function booking_process($order_id,$event_id,$plan_id,$plan_time_id,$user_id,$number_of_seats,$total_amount,$booking_date)
    {
		
		$sQuery = "INSERT INTO booking_process (order_id,event_id,plan_id,plan_time_id,user_id,number_of_seats,total_amount,booking_date) VALUES ('". $order_id . "','". $event_id . "','". $plan_id . "','". $plan_time_id . "','". $user_id . "','". $number_of_seats . "','". $total_amount . "','". $booking_date . "')";
		$booking_insert = $this->db->query($sQuery);
		
		$update_seats = "UPDATE booking_plan_timing SET seat_available = seat_available-$number_of_seats WHERE id ='$plan_time_id'";
		$seatsupdate = $this->db->query($update_seats);
		
		$_SESSION['booking_start'] = time(); // taking now logged in time
		$_SESSION['booking_expire'] = $_SESSION['booking_start'] + (300) ; // ending a session in 180 seconds
		
		$session_seats = "INSERT INTO booking_session (session_expiry,order_id,plan_time_id,number_of_seats) VALUES ('". $_SESSION['booking_expire'] . "','". $order_id . "','". $plan_time_id . "','". $number_of_seats . "')";
		$session_insert = $this->db->query($session_seats);
				
		$sql="SELECT A.id,A.order_id,E.category_name,B.id AS event_id,B.event_name,B.event_venue,B.event_address,C.show_date,C.show_time,D.plan_name,A.number_of_seats, A.total_amount FROM booking_process A,events B,booking_plan_timing C,booking_plan D,category_master E WHERE A.order_id  = '$order_id' AND A.event_id = B.id AND A.plan_time_id = C.id AND A.plan_id = D.id AND B.category_id = E.id";
	  	$resu=$this->db->query($sql);
	  	$res=$resu->result();
		return $res;
    }
	
	
	function add_review($event_id,$user_id,$rating,$message)
    {
		$sQuery = "INSERT INTO event_reviews (user_id,event_id,event_rating,comments,status,created_at) VALUES ('". $user_id . "','". $event_id . "','". $rating . "','". $message . "','N',NOW())";
		$review_insert = $this->db->query($sQuery);
    }
}
?>

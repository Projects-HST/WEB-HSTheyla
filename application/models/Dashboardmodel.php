<?php
Class Dashboardmodel extends CI_Model
{
	public function __construct()
	 {
		  parent::__construct();
	 }
  
  
	public function get_points($user_id)
	{
	        $leaderboard_query = "SELECT * FROM user_points_count WHERE user_id = '$user_id' LIMIT 1";
			$leaderboard_res = $this->db->query($leaderboard_query);
			$leaderboard_result= $leaderboard_res->result();
			return $response;
	}

}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apimain extends CI_Controller {

	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function index()
	{
		$this->load->view('welcome_message');
	}


	function __construct()
    { 
        parent::__construct();
		$this->load->model("apimainmodel");
		$this->load->helper("url");

    }

	public function checkMethod()
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			$res = array();
			$res["scode"] = 203;
			$res["message"] = "Request Method not supported";

			echo json_encode($res);
			return FALSE;
		}
		return TRUE;
	}

//-----------------------------------------------//

	public function login()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$username = '';
		$password = '';
		$gcmkey ='';
		$mobiletype ='';
		$login_type ='';
		
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$gcm_key = $this->input->post("gcm_key");
		$mobile_type = $this->input->post("mobile_type");
		$login_type = $this->input->post("login_type");

		$data['result']=$this->apimainmodel->Login($username,$password,$gcm_key,$mobile_type,$login_type);
		
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


	public function fbgmlogin()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Facebook Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$username = '';
		$name = '';
		$gcmkey ='';
		$mobiletype ='';
		$login_type ='';

		$name = $this->input->post("name");
		$email_id = $this->input->post("email_id");
		$gcm_key = $this->input->post("gcm_key");
		$mobile_type = $this->input->post("mobile_type");
		$login_type = $this->input->post("login_type");

		$data['result']=$this->apimainmodel->Fb_gm_login($username,$name,$gcm_key,$mobile_type,$login_type);
		
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


	public function guestlogin()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Guest Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$unique_id = '';
		$gcmkey ='';
		$login_type = '';

		$unique_id = $this->input->post("unique_id");
		$gcm_key = $this->input->post("gcm_key");
		$mobile_type = $this->input->post("mobile_type");

		$data['result']=$this->apimainmodel->Guest_login($unique_id,$gcm_key,$mobile_type);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

	public function signup()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Signup";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


		$email_id = '';
		$mobile_no ='';
		$password = '';
		$gcm_key ='';
		$signup_type = '';
		$mobile_type = '';
		
		$email_id = $this->input->post("email_id");
		$mobile_no = $this->input->post("mobile_no");
		$password = $this->input->post("password");
		$gcm_key = $this->input->post("gcm_key");
		$signup_type = $this->input->post("signup_type");
		$mobile_type = $this->input->post("mobile_type");

		$data['result']=$this->apimainmodel->User_signup($email_id,$mobile_no,$password,$gcm_key,$signup_type,$mobile_type);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function mobileverify()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Mobileverify";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


		$mobile_no ='';
		$OTP = '';
		$request_mode ='';

		$mobile_no = $this->input->post("mobile_no");
		$OTP = $this->input->post("OTP");
		//$request_mode = $this->input->post("request_mode");
		
		$data['result']=$this->apimainmodel->Mobile_verify($mobile_no,$OTP);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function resendOTP()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "OTP Resend";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


		$mobile_no ='';
		$mobile_no = $this->input->post("mobile_no");

		$data['result']=$this->apimainmodel->Resend_OTP($mobile_no);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function updatemobile()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Update Mobile";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


		$old_mobile_no ='';
		$new_mobile_no ='';

		$old_mobile_no = $this->input->post("old_mobile_no");
		$new_mobile_no = $this->input->post("new_mobile_no");

		$data['result']=$this->apimainmodel->Update_mobile($old_mobile_no,$new_mobile_no);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

public function profile_picupload($user_id)
	{
	    $_POST = json_decode(file_get_contents("php://input"), TRUE);

		$user_id = $user_id;
     	$user_type = $user_type;
		$profile = $_FILES["user_pic"]["name"];
		$userFileName = time().'-'.$profile;
		$uploadPicdir = 'assets/users/profile/';
		
		$profilepic = $uploadPicdir.$userFileName;
		move_uploaded_file($_FILES['user_pic']['tmp_name'], $profilepic);
		
		$data['result']=$this->apimainmodel->Update_profilepic($user_id,$userFileName);
		$response = $data['result'];
		echo json_encode($response);
		
	}
	
//-----------------------------------------------//

//-----------------------------------------------//

	public function profileupdate()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Profile Update";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
        
        $user_id = '';
        $full_name = '';
        $user_name = '';
        $date_of_birth = '';
        $gender = '';
        $occupation = '';
        $address_line_1 = '';
        $address_line_2 = '';
        $address_line_3 = '';
        $country_id = '';
        $state_id = '';
        $city_id = '';
        $zip_code = '';
        $news_letter = '';
        
        $user_id = $this->input->post("user_id");
        $full_name = $this->input->post("full_name");
        $user_name = $this->input->post("user_name");
        $date_of_birth = $this->input->post("date_of_birth");
        $gender = $this->input->post("gender");
        $occupation = $this->input->post("occupation");
        $address_line_1 = $this->input->post("address_line_1");
        $address_line_2 = $this->input->post("address_line_2");
        $address_line_3 = $this->input->post("address_line_3");
        $country_id = $this->input->post("country_id");
        $state_id = $this->input->post("state_id");
        $city_id = $this->input->post("city_id");
        $zip_code = $this->input->post("zip_code");
        $news_letter = $this->input->post("news_letter");

		$data['result']=$this->apimainmodel->Profile_update($user_id,$full_name,$user_name,$date_of_birth,$gender,$occupation,$address_line_1,$address_line_2,$address_line_3,$country_id,$state_id,$city_id,$zip_code,$news_letter);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


	public function forgotpassword()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Forgot Password";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_name = '';
	 	$user_name = $this->input->post("username");


		$data['result']=$this->apimainmodel->Forgot_password($user_name);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//


	public function fgpasswordotp()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Forgot Password OTP";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$mobile_no = '';
		$OTP = '';
	 	$mobile_no = $this->input->post("mobile_no");
	 	$OTP = $this->input->post("OTP");
	 	

		$data['result']=$this->apimainmodel->Forgot_password_otp($mobile_no,$OTP);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


	public function resetpassword()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Reset Password";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$password = '';
		
		$user_id = $this->input->post("user_id");
	 	$password = $this->input->post("password");

		$data['result']=$this->apimainmodel->Reset_password($user_id,$password);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function selectcountry()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Select Country";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->Select_country($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function selectstate()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Select State";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$country_id = '';
		$country_id = $this->input->post("country_id");

		$data['result']=$this->apimainmodel->Select_state($country_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function selectcity()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Select City";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$country_id = '';
		$state_id = '';
		$country_id = $this->input->post("country_id");
		$state_id = $this->input->post("state_id");

		$data['result']=$this->apimainmodel->Select_city($country_id,$state_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function selectallcity()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Select All City";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->Select_allcity($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function viewpreferrence()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Preferrence";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->View_preferrence($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//



//-----------------------------------------------//

	public function addpreferrence()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Add User Preferrence";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$category_ids = '';
		$user_id = $this->input->post("user_id");
		$category_ids = $this->input->post("category_ids");

		$data['result']=$this->apimainmodel->Add_preferrence($user_id,$category_ids);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function updatepreferrence()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Update User Preferrence";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$category_ids = '';
		$user_id = $this->input->post("user_id");
		$category_ids = $this->input->post("category_ids");

		$data['result']=$this->apimainmodel->Update_preferrence($user_id,$category_ids);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function userpreferrence()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View User Preferrence";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->User_preferrence($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function addwishlistmaster()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Add Wishlist Master";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$title = '';
		$user_id = $this->input->post("user_id");
		$title = $this->input->post("title");
		 
		$data['result']=$this->apimainmodel->Add_wishlistmaster($user_id,$title);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function updatewishlistmaster()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Update Wishlist Master";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$wishlist_id ='';
		$title = '';
		
		$user_id = $this->input->post("user_id");
		$wishlist_id = $this->input->post("wishlist_id");
		$title = $this->input->post("title");
		 
		$data['result']=$this->apimainmodel->Update_wishlistmaster($user_id,$wishlist_id,$title);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function viewwishlistmaster()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Wishlist Master";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->View_wishlistmaster($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function deletewishlistmaster()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Delete Wishlist Master";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$wishlist_id ='';
		
		$user_id = $this->input->post("user_id");
		$wishlist_id = $this->input->post("wishlist_id");

		 
		$data['result']=$this->apimainmodel->Delete_wishlistmaster($user_id,$wishlist_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function addwishlist()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Add Wishlist";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$wishlist_master_id ='';
		$event_id ='';
		
		$user_id = $this->input->post("user_id");
		$wishlist_master_id = $this->input->post("wishlist_master_id");
		$event_id = $this->input->post("event_id");
		
		$data['result']=$this->apimainmodel->Add_wishlist($user_id,$wishlist_master_id,$event_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function viewwishlist()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Wishlist";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$wishlist_master_id ='';
		
		$user_id = $this->input->post("user_id");
		$wishlist_master_id = $this->input->post("wishlist_master_id");
		
		$data['result']=$this->apimainmodel->View_wishlist($user_id,$wishlist_master_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function deletewishlist()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Delete Wishlist";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$wishlist_id ='';
		
		$user_id = $this->input->post("user_id");
		$wishlist_id = $this->input->post("wishlist_id");
		
		$data['result']=$this->apimainmodel->Delete_wishlist($user_id,$wishlist_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function viewevents()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Events";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_type = '';
		$city = '';
		$user_id = '';
		$preferrence ='';
		
		$event_type = $this->input->post("event_type");
		$city = $this->input->post("city");
		$user_id = $this->input->post("user_id");
		$preferrence = $this->input->post("preferrence");
		
		$data['result']=$this->apimainmodel->View_events($event_type,$city,$user_id,$preferrence);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function advevents()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Adv Events";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$city = '';
		$user_id = '';
		$preferrence ='';

		$city = $this->input->post("city");
		$user_id = $this->input->post("user_id");
		$preferrence = $this->input->post("preferrence");
		
		$data['result']=$this->apimainmodel->View_adv_events($city,$user_id,$preferrence);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function eventimages()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Event Images";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id = '';
		$event_id = $this->input->post("event_id");
	
		$data['result']=$this->apimainmodel->View_eventimages($event_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function bookinghistory()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Booking History";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$wishlist_id ='';
		
		$user_id = $this->input->post("user_id");
		
		$data['result']=$this->apimainmodel->Booking_history($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function bookingdetails()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Booking Details";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$booking_id = '';
		$booking_id = $this->input->post("booking_id");
		
		$data['result']=$this->apimainmodel->Booking_details($booking_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function bookingplandates()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Booking Plan date Details";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id = '';
		$event_id = $this->input->post("event_id");
		
		$data['result']=$this->apimainmodel->Booking_plandates($event_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function bookingplantimes()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Booking Plan time Details";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id = '';
		$show_date = '';
		$event_id = $this->input->post("event_id");
		$show_date = $this->input->post("show_date");
		
		$data['result']=$this->apimainmodel->Booking_plantimes($event_id,$show_date);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function bookingplans()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Booking Plan Details";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$show_date = '';
		$show_time = '';
		$event_id = '';
		$event_id = $this->input->post("event_id");
		$show_date = $this->input->post("show_date");
		$show_time = $this->input->post("show_time");
		
		$data['result']=$this->apimainmodel->Booking_plans($event_id,$show_date,$show_time);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function eventreview()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Event Reviews";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id = '';
		$event_id = $this->input->post("event_id");
		
		$data['result']=$this->apimainmodel->Event_review($event_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function reviewimages()
	{
		//$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Event Review Images";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		
        $event_id = '';
		$review_id = '';
		$event_id = $this->input->post("event_id");
		$review_id = $this->input->post("review_id");
		
		
		$data['result']=$this->apimainmodel->Review_images($event_id,$review_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

}

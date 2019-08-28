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
		$this->load->library('session');
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

		$data['result']=$this->apimainmodel->Login($username,$password,$gcm_key,$mobile_type);

		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


	public function socialLogin()
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

		$data['result']=$this->apimainmodel->Fb_gm_login($email_id,$name,$gcm_key,$mobile_type,$login_type);

		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


	public function guestLogin()
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

	public function signUp()
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
		$mobile_type = $this->input->post("mobile_type");

		$data['result']=$this->apimainmodel->User_signup($email_id,$mobile_no,$password,$gcm_key,$mobile_type);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function mobileVerify()
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

	public function updateMobile()
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

//-----------------------------------------------//

	public function updateEmail()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Update Email";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


		$old_email_id ='';
		$new_email_id ='';

		$old_email_id = $this->input->post("old_email_id");
		$new_email_id = $this->input->post("new_email_id");

		$data['result']=$this->apimainmodel->Update_email($old_email_id,$new_email_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function updateUsername()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Update Username";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


		$old_user_name ='';
		$new_user_name ='';

		$old_user_name = $this->input->post("old_user_name");
		$new_user_name = $this->input->post("new_user_name");

		$data['result']=$this->apimainmodel->Update_username($old_user_name,$new_user_name);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

    public function profilePictureUpload()
	{
	  	$_POST = json_decode(file_get_contents("php://input"), TRUE);

		$user_id = $this->uri->segment(3);
		$profile = $_FILES["user_pic"]["name"];
		$userFileName = time().'-'.$profile;
		$uploadPicdir = './assets/users/profile/';
		$profilepic = $uploadPicdir.$userFileName;
		move_uploaded_file($_FILES['user_pic']['tmp_name'], $profilepic);

		$data['result']=$this->apimainmodel->Update_profilepic($user_id,$userFileName);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function profileUpdate()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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
        $username = '';
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
        $username = $this->input->post("username");
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

		$data['result']=$this->apimainmodel->Profile_update($user_id,$full_name,$username,$date_of_birth,$gender,$occupation,$address_line_1,$address_line_2,$address_line_3,$country_id,$state_id,$city_id,$zip_code,$news_letter);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function profileDetails()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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
        $user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->Profile_details($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//
	public function forgotPassword()
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


	public function forgotPasswordOTP()
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


	public function resetPassword()
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

	public function selectCountry()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function selectState()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function selectCity()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function getEventCountries()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

		$data['result']=$this->apimainmodel->getEventCountries($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

	public function getEventcities()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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
		$country_id = $this->input->post("country_id");

		$data['result']=$this->apimainmodel->getEventcities($country_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

	public function selectAllCity()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function updateUsercity()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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
		$city_id = '';
		$user_id = $this->input->post("user_id");
		$city_id = $this->input->post("city_id");

		$data['result']=$this->apimainmodel->Update_usercity($user_id,$city_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function updateNotification()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Notification Update";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$status = '';
		$user_id = $this->input->post("user_id");
		$status = $this->input->post("status");

		$data['result']=$this->apimainmodel->Update_notification($user_id,$status);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function updatePreference()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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
		$user_type ='';

		$user_id = $this->input->post("user_id");
		$category_ids = $this->input->post("category_ids");
        $user_type = $this->input->post("user_type");

		$data['result']=$this->apimainmodel->Update_preferrence($user_id,$category_ids,$user_type);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function userPreference()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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
		$user_type ='';

		$user_id = $this->input->post("user_id");
        $user_type = $this->input->post("user_type");

		$data['result']=$this->apimainmodel->User_preferrence($user_id,$user_type);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function addWishListMaster()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function updateWishListMaster()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function viewWishListMaster()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function deleteWishListMaster()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function addWishList()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function viewWishList()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function deleteWishList()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function wishListStatus()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Wishlist Status";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$event_id ='';

		$user_id = $this->input->post("user_id");
		$event_id = $this->input->post("event_id");

		$data['result']=$this->apimainmodel->Wishlist_Status($user_id,$event_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function viewEvents()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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
		$user_type ='';
		$day_type ='';

		$event_type = $this->input->post("event_type");
		$city_id = $this->input->post("event_city_id");
		$user_id = $this->input->post("user_id");
		$user_type = $this->input->post("user_type");
		$day_type = $this->input->post("day_type");


		$data['result']=$this->apimainmodel->View_events($event_type,$city_id,$user_id,$user_type,$day_type);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

	public function search_events(){

		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "search events";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id = '';
		$search_event = $this->input->post("search_event");
		$city_id = $this->input->post("city_id");
		$event_type = $this->input->post("event_type");
		$user_id = $this->input->post("user_id");
		$user_type = $this->input->post("user_type");

		$data['result']=$this->apimainmodel->search_events($search_event,$city_id,$event_type,$user_id,$user_type);
		$response = $data['result'];
		echo json_encode($response);
	}


//-----------------------------------------------//

	public function eventImages()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function checkReview()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Check Reviews";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id = '';
		$user_id = '';
		$event_id = $this->input->post("event_id");
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->Check_review($event_id,$user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function addReview()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Add Review";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id = '';
		$user_id = '';
		$event_rating = '';
		$comments ='';
		$event_id = $this->input->post("event_id");
		$user_id = $this->input->post("user_id");
		$event_rating = $this->input->post("rating");
		$comments =$this->input->post("comments");

		$data['result']=$this->apimainmodel->Add_review($user_id,$event_id,$event_rating,$comments);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function updateReview()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Update Review";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
        $review_id = '';
		$event_rating = '';
		$comments ='';
		$review_id = $this->input->post("review_id");
		$event_rating = $this->input->post("rating");
		$comments =$this->input->post("comments");

		$data['result']=$this->apimainmodel->Update_review($review_id,$event_rating,$comments);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function listEventReview()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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
		$user_id = '';
		$event_id = $this->input->post("event_id");
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->List_eventreview($user_id,$event_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function reviewImages()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

//-----------------------------------------------//

	public function eventPopularity()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Add Event Popularity";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id = '';
		$user_id = '';

		$event_id = $this->input->post("event_id");
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->Event_popularity($event_id,$user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function advanceSearch()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Advanced Search";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$single_date = '';
        $from_date ='';
        $to_date = '';
        $event_type = '';
        $event_category = '';
        $selected_preference = '';
        $selected_city = '';
		$price_range = '';



        $single_date = $this->input->post("single_date");
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");
        $event_type = $this->input->post("event_type");
        $event_category = $this->input->post("event_category");
        $selected_preference = $this->input->post("selected_preference");
        $selected_city = $this->input->post("selected_city");
		$price_range = $this->input->post("price_range");



		$data['result']=$this->apimainmodel->Advance_search($single_date,$from_date,$to_date,$event_type,$event_category,$selected_preference,$selected_city,$price_range);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function datewiseEventlist()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Datewise Event List";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

        $event_type = '';
        $city_id = '';
        $user_id = '';
        $user_type = '';
		$day_type = '';


        $event_type = $this->input->post("event_type");
        $city_id = $this->input->post("city_id");
        $user_id = $this->input->post("user_id");
        $user_type = $this->input->post("user_type");
        $day_type = $this->input->post("day_type");

		$data['result']=$this->apimainmodel->Datewise_events($event_type,$city_id,$user_id,$user_type,$day_type);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function bookingPlanDates()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function bookingPlanTimes()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function bookingPlans()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function bookingPricerange()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->Booking_pricerange($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function bookingProcess()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Booking Process";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

        $order_id = '';
        $event_id = '';
        $plan_id = '';
        $plan_time_id = '';
        $user_id = '';
        $number_of_seats = '';
        $total_amount = '';
        $booking_date = '';

		$order_id = $this->input->post("order_id");
		$event_id = $this->input->post("event_id");
        $plan_id = $this->input->post("plan_id");
        $plan_time_id = $this->input->post("plan_time_id");
        $user_id = $this->input->post("user_id");
        $number_of_seats = $this->input->post("number_of_seats");
        $total_amount = $this->input->post("total_amount");
        $booking_date = $this->input->post("booking_date");

		$data['result']=$this->apimainmodel->Bookingprocess($order_id,$event_id,$plan_id,$plan_time_id,$user_id,$number_of_seats,$total_amount,$booking_date);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function bookingAttendees()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Booking Attendees";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

        $order_id = '';
        $name = '';
        $email_id  = '';
        $mobile_no = '';

		$order_id = $this->input->post("order_id");
		$name = $this->input->post("name");
        $email_id = $this->input->post("email_id");
        $mobile_no = $this->input->post("mobile_no");

		$data['result']=$this->apimainmodel->Bookingattendees($order_id,$name,$email_id,$mobile_no);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function bookingHistory()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

	public function bookingAttendeesDetails()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

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

		$order_id = '';
		$order_id = $this->input->post("order_id");

		$data['result']=$this->apimainmodel->Booking_attendeesdetails($order_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function userActivity()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "User Activity";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$rule_id = '';
		$user_id = '';
		$event_id = '';
		$date = '';

		$rule_id = $this->input->post("rule_id");
		$user_id = $this->input->post("user_id");
		$event_id = $this->input->post("event_id");
		$date = $this->input->post("date");

		$data['result']=$this->apimainmodel->User_activity($rule_id,$user_id,$event_id,$date);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function leaderBoard()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Leaderboard";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';

		$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->Leaderboard($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function activityHistory()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Activity History";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$rule_id = '';

		$user_id = $this->input->post("user_id");
	    $rule_id = $this->input->post("rule_id");

		$data['result']=$this->apimainmodel->Activity_history($user_id,$rule_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function nearBy()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Activity History";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

        $event_type ='';
        $user_type ='';
        $user_id ='';
        $city_id = '';
        $latitude ='';
        $longitude ='';
        $nearby_distance ='';

        $event_type =$this->input->post("event_type");
        $user_type =$this->input->post("user_type");
        $user_id =$this->input->post("user_id");
        $city_id =$this->input->post("city_id");
        $latitude =$this->input->post("latitude");
        $longitude =$this->input->post("longitude");
        $nearby_distance =$this->input->post("nearby_distance");


		$data['result']=$this->apimainmodel->Nearby_events($event_type,$user_type,$user_id,$city_id,$latitude,$longitude,$nearby_distance);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function organizerRequest()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Event Organizer Request";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

        $user_id ='';
        $message ='';

        $user_id = $this->input->post("user_id");
        $message = $this->input->post("message");


		$data['result']=$this->apimainmodel->Organizer_request($user_id,$message);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

	//------------------User Points-----------------------------//

	public function user_points()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Input error";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
  	$user_id = $this->input->post("user_id");
		$data['result']=$this->apimainmodel->user_points($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

	//-----------------------------------------------//

//------------------Refund Request-----------------------------//

	public function refund_request()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Input error";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$user_id = $this->input->post("user_id");
		$order_id = $this->input->post("order_id");
		$data['result']=$this->apimainmodel->Refund_request($user_id,$order_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//------------------Report Abuse-----------------------------//

	public function report_abuse()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Input error";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$review_id = $this->input->post("review_id");
		$data['result']=$this->apimainmodel->Report_Abuse($review_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//------------------User Feedback-----------------------------//

	public function user_feedback()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Input error";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		
		$name = "";
		$email = "";
		$comments = "";
		
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$comments = $this->input->post("comments");
		
		$data['result']=$this->apimainmodel->User_Feedback($name,$email,$comments);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//------------------User Notifications-----------------------------//

	public function view_notification()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "User Notifications";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		
		$user_id = "";
		
		$user_id = $this->input->post("user_id");
		
		$data['result']=$this->apimainmodel->View_notification($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//------------------User Notifications-----------------------------//

	public function new_notification()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "User Notifications";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		
		$user_id = "";
		
		$user_id = $this->input->post("user_id");
		
		$data['result']=$this->apimainmodel->New_notification($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


/*//-----------------------------------------------//
	public function notification()
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

		$gcm_key = '';
		$Title = '';
		$Message ='';
		$mobiletype ='';


		$gcm_key = $this->input->post("gcm_key");
		$Title = $this->input->post("Title");
		$Message = $this->input->post("Message");
		$mobile_type = $this->input->post("mobile_type");

		$data['result']=$this->apimainmodel->sendNotification($gcm_key,$Title,$Message,$mobile_type);

		//$response = $data['result'];
		//echo json_encode($response);
	}

//-----------------------------------------------//
//-----------------------------------------------//

	public function viewevents_test()
	{
		$event_query = "SELECT * FROM events";
		$event_res = $this->db->query($event_query);

			 if($event_res->num_rows()>0){
			     	$event_result= $event_res->result();
			     	$response = array("status" => "success", "msg" => "View Events","Eventdetails"=>$event_result);

			}else{
			        $response = array("status" => "error", "msg" => "Events not found");
			}
		echo json_encode($response);
	}

//-----------------------------------------------//*/

}

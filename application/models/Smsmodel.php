<?php

Class Smsmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

  }


  	public function sendOTPtomobile($mob,$mobile_message)
  	{
          //Your authentication key
          $authKey = "180660Az2FsJQSXGJ259f02b66";

          //Multiple mobiles numbers separated by comma
          $mobileNumber = "$mob";

          //Sender ID,While using route4 sender id should be 6 characters long.
          $senderId = "HEYLAA";

          //Your message to send, Add URL encoding here.
          $message = urlencode($mobile_message);

          //Define route
          $route = "transactional";

          //Prepare you post parameters
          $postData = array(
              'authkey' => $authKey,
              'mobiles' => $mob,
              'message' => $mobile_message,
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
?>

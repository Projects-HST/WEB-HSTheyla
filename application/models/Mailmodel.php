<?php

Class Mailmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

  }

  function send_mail_to_users($mailids,$email_temp_id)
  {  //echo $mailids; echo $email_temp_id;exit;
  	 $tsql="SELECT id,template_name,template_content FROM email_template WHERE id='$email_temp_id'";
	 $res=$this->db->query($tsql);
	 $result1=$res->result();
	 foreach($result1 as $rows)
     { } 
         $tem_name=$rows->template_name;
         $tem_content=$rows->template_content;
		 $to=$mailids;
		 $subject=$tem_name;
		 $cnotes=$tem_content;
		 $htmlContent = '
			 <html>
			 <head><title></title>
			 </head>
			 <body>
			<p style="margin-left:50px;">'.$cnotes.'</p>
			 </body>
			 </html>';
	 $headers = "MIME-Version: 1.0" . "\r\n";
	 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	 // Additional headers
	 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
	 //$sent= mail($to,$subject,$htmlContent,$headers);
	 if(mail($to,$subject,$htmlContent,$headers))
	 {
        $data= array("status"=>"Y");
        return $data;
     }

  }

}
?>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.cookie.js"></script>
 
<div class="container-fluid signinbg">
    <div class="row">
        <div class="col-md-3"></div>
		<div class="col-md-6 col-sm-12 col-md-auto signin-div">
		

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="reset_section">
		<div class="verify-text" style="margin-bottom:80px;padding-top:20px;">
		     <center>
                <img src="<?php echo base_url(); ?>assets/front/images/forgot_password.png" class="img-responsive imgsize_80 forgot_img">
              <form action="" method="post" id="activateform" class="activateform">
                <div class="form-group">
				<p class="login-heading">Account Reactivation</p>
				  <p>To reactivate your Heyla account kindly <br>submit the details.</p>
				  <input type="text" class="form-control" name="username" id="username"  placeholder="Mobile Number/Email ID" maxlength="50" />
                </div>
                <div class="form-group">
                  <input type="submit" class=" btn_no_radius btn btn-login" id="" value="Submit">
                </div>
              </form>
            </center>
		</div>
		</div>
		
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="otp_form">
          <div class="verify-text" style="margin-bottom:80px;">
            <center>
          <img src="<?php echo base_url(); ?>assets/front/images/forgot_password.png" class="img-responsive imgsize_80 forgot_img">
              <form action="" method="post" id="otp_form_validate" class="otp_form_validate">
                <div class="form-group">
                  <label for="exampleInputPassword1">Please enter the OTP</label>
                    <input type="text" class="form-control" name="mobile_otp" id="mobile_otp" placeholder="OTP" />
                      <small><a  href="#" class="pull-right btn_resend_otp" onclick="resend_otp_function()" >Resend OTP</a></small>
                </div>
                <div class="form-group">

                <input type="submit" class="btn btn-primary btn-block btn-login" placeholder="Password" value="Verfiy OTP" />
                </div>
              </form>
            </center>
          </div>
        </div>
		
		<div class="col-md-3"></div>
	</div>
	</div>
</div>

 
    <style>
    .modal {
      text-align: center;
      padding: 0!important;
    }

    .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
    }
    .modal-body{
      padding-top:30px;
      padding-bottom:30px;
      padding-left: 40px;
      padding-right: 40px;
      border: 2px solid #6D6E71;
      border-radius: 20px;
    }
    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }

    </style>

<script type="text/javascript">
$('#reset_section').show();
$('#otp_form').hide();

    $("#myModal").modal('show');

    $("#loginbtn").click(function() {
        $(this).toggleClass("menuactive");
    });
    $('ul li a').click(function() {
        $('li a').removeClass("menuactive");
        $(this).addClass("menuactive");
    });

    $("#setting").click(function() {
        $("#edit-btn").toggle();
    });

    $("#edit-btn").click(function() {
        $("#form").toggle();
        $('#per-info').hide();
    });

   $('.verify-page').height($(window).height());

   $('#activateform').validate({ // initialize the plugin
       rules: {
           username: {required: true},
       },
       messages: {
           username: "This field cannot be empty!"
       },
       submitHandler: function(form) {
         var mobile=$('#username').val();

         $.cookie("mobile_cookie", mobile);
           $.ajax({
               url: "<?php echo base_url(); ?>home/chk_username",
               type: 'POST',
               data: $('#activateform').serialize(),
               success: function(response) {
					if (response == "OTPemail") {
						swal('OTP sent to your email.');
						$('#otp_form').show();
						$('#reset_section').hide();
					} else if (response == "OTPsms") {
						swal('OTP sent to your mobile.');
						$('#otp_form').show();
						$('#reset_section').hide();
					}else if (response == "Adminrequest") {
							sweetAlert("Sucess", "We will get back to you sooner via email.", "sucess");
					 } else {
						   sweetAlert("Oops...", response, "error");
					}
               }
           });
       }
   });

   $('#otp_form_validate').validate({
       rules: {
           mobile_otp: {
               required: true
           }
       },
       messages: {
           mobile_otp: { required:"OTP cannot be empty!"}
       },
       submitHandler: function(form) {
           var user_name=$.cookie("mobile_cookie");
           var mobile_otp=$('#mobile_otp').val();
           $.ajax({
               url: "<?php echo base_url(); ?>home/username_otp_check",
               type: 'POST',
               dataType : 'json',
               data: { mobile_otp: mobile_otp,user_name : user_name},
               success: function(response) {
                 if (response.status== "success") {
                   $.removeCookie("mobile_cookie");
                     swal({
                        title: " ",
                        text: "Account Activated.",
                        type: "success"
                    }).then(function() {
                        location.href = '<?php echo base_url(); ?>home/signin';
                    });
                   } else {
                       sweetAlert("Oops...", response.msg, "error");
                   }
               }
           });
       }
   });

   
   function resend_otp_function(){
     var user_name=$.cookie("mobile_cookie");
     $.ajax({
        method: "post",
		url: "<?php echo base_url(); ?>home/username_resend_otp",
		data: {
           user_name: user_name
       },
       cache: false,
		 success: function(response){
         swal(response);
       }
     });
   }
</script>

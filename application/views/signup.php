<script src="<?php echo base_url(); ?>assets/front/js/jquery.cookie.js"></script>
<div class="container-fluid signinbg">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-sm-12 col-md-auto signin-div" id="signin-div">
            <div class="row">
                <p class="login-heading">Sign Up</p>
                  <p class="login_tag">Heyla&#8212;a window to the stages of the city-state</p>
                <div class="col-lg-6 col-sm-12">
                    <form action="" method="post" class="formsignup" id="formsignup">
                        <div class="col-xs-6 form_box">
                            <div class="left-inner-addon">
                                <i class="fas fa-user"></i>
                                <input type="text" class="form-control" name="name" placeholder="Username" maxlength="12"/>
                            </div>
                        </div>
                        <div class="col-xs-6 form_box">
                            <div class="left-inner-addon">
                                <i class="fas fa-mobile-alt"></i>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" maxlength="10"/>
                            </div>
                        </div>
                        <div class="col-xs-6 form_box">
                            <div class="left-inner-addon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" class="form-control" name="email" placeholder="Email ID (Optional)" maxlength="50" />
                            </div>
                        </div>
                        <div class="col-xs-6 form_box">
                            <div class="left-inner-addon">

                                <i class="fas fa-lock"></i>
                                <input id="password-field" type="password" class="form-control"  name="new_password"  placeholder="Password" maxlength="12" required>
                                 <span toggle="#password-field" class="fa fa-fw  fa-eye-slash field-icon toggle-password"></span>



                            </div>
                        </div>
                        <p class="legal_text">By signing up, I agree to the <a href="<?php echo base_url(); ?>terms" class="">Terms and Conditions <a/> and <a href="<?php echo base_url(); ?>privacy" class="">Privacy Policy</a></p>
                        <div class="col-xs-12">
                            <input type="submit" class="btn btn-primary btn-block btn-login" placeholder="Password" value="Sign Up" />
                        </div>
                        <p>Already registered? <a href="<?php echo base_url(); ?>signin" class="">Sign In<a/></p>

      </form>

    </div>
    <div class="col-md-1">
      <p class="or-text">OR</p>
    </div>
    <div class="col-lg-5 col-sm-12">
      <div class="socialmedia-tab">

        <!-- <a class="social-link-img" onclick="checkLoginState()" scope="public_profile,email"><img src="<?php echo base_url(); ?>assets/front/images/login-facebook.png" class="img-responsive social-img"></a> -->
        <fb:login-button size="large" class="fb_btn" scope="public_profile,email" onlogin="checkLoginState();">
			Sign in with Facebook
        </fb:login-button>
        <br>
         <a href="<?php echo base_url(); ?>google_login" class="social-link-img"><img src="<?php echo base_url(); ?>assets/front/images/login-google.png" class="img-responsive social-img"></a>
         </div>
		 
		 <?php if($this->session->flashdata('msg')): ?>
				<div class="alert alert-primary">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<?php echo $this->session->flashdata('msg'); ?>
				</div>
            <?php endif; ?>
		 
            </div>
        </div>
    </div>

    <div class="col-md-8 col-sm-12 col-md-auto otp_form" id="otp_form">
        <div class="row d-flex justify-content-center">
          <div class="col-md-5">
            <p class="login_tag">Heyla&#8212;a window to the stages of the city-state</p>
          <center>  <img src="<?php echo base_url(); ?>assets/front/images/otp_icon.png" class="img-responsive" style="width:100px;"></center>

              <form action="" method="post" class="otp_verifcation_form " id="otp_form_validate">
                <div class="col-xs-6 form_box">
                    <div class="left-inner-addon">

                        <input type="text" class="form-control" name="mobile_otp" id="mobile_otp" placeholder="OTP" />
                    </div>
                    <small><a  href="#" class="pull-right btn_resend_otp" onclick="resend_otp_function()" >Resend OTP</a></small>
                </div>
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block btn-login" placeholder="Password" value="Verfiy OTP" />
                </div>
              </form>

          </div>
        </div>

    </div>

    <div class="col-md-2">

    </div>
</div>




</div>

<style>


.error{
  color: red;
}
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
.form_box{
  margin-bottom: 10px;
}
.left-inner-addon input{
  padding-left: 30px;
}
</style>
<script>
$('#signin-div').show();
$('#otp_form').hide();
$('#formsignup').validate({ // initialize the plugin
    rules: {
        name: {
            required: true,minlength: 6, maxlength: 12,
            remote: {
                   url: "<?php echo base_url(); ?>home/existusername",
                   type: "post"
                }
        },
        email: {
            required: false,email:true,
            remote: {
                   url: "<?php echo base_url(); ?>home/existemail",
                   type: "post"
                }
        },
        mobile: {
            required: true,minlength: 10, maxlength: 10, digits: true,
            remote: {
                   url: "<?php echo base_url(); ?>home/existmobile",
                   type: "post"
                }
        },
        new_password: {
            required: true,minlength: 6, maxlength: 12
        },
    },
    messages: {
        name: { required:"Username cannot be empty!", minlength: "Minimum 6 characters please!", maxlength: "No more than 12 characters please!",remote:"Username already exists!" },
        email: { required:"Email ID cannot be empty!",remote:"Email ID already exists!" },
          mobile: { required:"Mobile number cannot be empty!",minlength: "Please check the number of digits!", maxlength: "Please check the number of digits!",remote:"Mobile number already exists!" },

        new_password: { required:"Password cannot be empty!", minlength: "Minimum 6 characters please!", maxlength: "No more than 12 characters please!", }
    },
    submitHandler: function(form) {
        //alert("hi");
        var mobile=$('#mobile').val();

        $.cookie("mobile_cookie", mobile);

        $.ajax({
            url: "<?php echo base_url(); ?>home/create_profile",
            type: 'POST',
            data: $('#formsignup').serialize(),
            success: function(response) {

                if (response == "verify") {
                   swal('OTP Sent to Mobile number');
                   $('#otp_form').show();
                   $('#signin-div').hide();
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
        var mobile=$.cookie("mobile_cookie");
        var mobile_otp=$('#mobile_otp').val();
        $.ajax({
            url: "<?php echo base_url(); ?>home/mobile_verify_otp",
            type: 'POST',
            dataType : 'json',
            data: { mobile_otp: mobile_otp,mobile : mobile},
            success: function(response) {
              if (response.status== "Y") {
                $.removeCookie("mobile_cookie");
                  swal({
                     title: " ",
                     text: "Heyla Welcomes you!",
                     type: "success"
                 }).then(function() {
                     location.href = '<?php echo base_url(); ?>';
                 });
                } else {
                    sweetAlert("Oops...", response.msg, "error");
                }
            }
        });
    }
});

function resend_otp_function(){
  var mobile=$.cookie("mobile_cookie");
  $.ajax({
      method: "post",
    url: "<?php echo base_url(); ?>home/mobile_otp_update",
    data: {
        mobile: mobile
    },
    cache: false,
    success: function(response){
      swal(response);

    }
  });
}

$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye-slash fa-eye");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});


window.fbAsyncInit = function() {
  FB.init({
    appId      : '386225678654929',
    cookie     : true,
    xfbml      : true,
    version    : '3.3'
  });

  FB.AppEvents.logPageView();

};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "https://connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));


FB.getLoginStatus(function(response) {
  statusChangeCallback(response);

});
function checkLoginState() {
FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
});
}

function statusChangeCallback(response) {
 if (response.status === 'connected') {
        FB.api('/me?fields=name,email', function (response) {
            var fbemail=response.email;
            var fbname=response.name;
            swal('Please wait');
            swal.showLoading();
             $.ajax({
                  url:'<?php echo base_url(); ?>home/facebook_login',
                  data: { 'fbname' : fbname, 'fbemail' : fbemail },
                  type: "POST",
                  crossDomain: true,
                  success: function (data) {
                  if(data=="success"){
                    setTimeout(function(){
                     window.location.reload(1);
                  }, 1000);
                }else if(data=="error"){
                    sweetAlert("Oops...", "Something went Wrong", "error");
                  }
                  else{
                    sweetAlert("Sorry!", "Your Account is Deactive. Please contact Admin", "error");
                  }

              }


            });
        });
      } else {
         // sweetAlert("Oops...", "Something went Wrong", "error");
      }
}

</script>

<script src="//connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">

$(".reveal").on('click',function() {
    var $pwd = $("#password-field");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
</script>

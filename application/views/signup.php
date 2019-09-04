<div class="container-fluid signinbg">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 col-sm-12 col-md-auto signin-div">
            <div class="row">
                <p class="login-heading">Sign Up</p>
                  <p class="login_tag">Heyla&#8212;a window to the stages of the city-state</p>
                <div class="col-lg-6 col-sm-12">
                    <form action="" method="post" class="formsignup" id="formsignup">
                        <div class="col-xs-6 form_box">
                            <div class="left-inner-addon">
                                <i class="fas fa-user"></i>
                                <input type="text" class="form-control" name="name" placeholder="Username" />
                            </div>
                        </div>
                        <div class="col-xs-6 form_box">
                            <div class="left-inner-addon">
                                <i class="fas fa-mobile-alt"></i>
                                <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" />
                            </div>
                        </div>
                        <div class="col-xs-6 form_box">
                            <div class="left-inner-addon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" class="form-control" name="email" placeholder="Email ID" />
                            </div>
                        </div>
                        <div class="col-xs-6 form_box">
                            <div class="left-inner-addon">

                                <i class="fas fa-lock"></i>
                                <input id="password-field" type="password" class="form-control"  name="new_password"  placeholder="Password" value="" required>
                                 <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
        <fb:login-button size="large" class="fb_btn" scope="public_profile,email"
                         onlogin="checkLoginState();">
        Sign in with Facebook
        </fb:login-button>
        <br>


          <a href="<?php echo base_url(); ?>google_login" class="social-link-img"><img src="<?php echo base_url(); ?>assets/front/images/login-google.png" class="img-responsive social-img"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2">

    </div>
</div>




</div>
<style>
.navbar {
  border-bottom: 1px solid #dad9d9;
}
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
            required: true,email:true,
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

        $.ajax({
            url: "<?php echo base_url(); ?>home/create_profile",
            type: 'POST',
            data: $('#formsignup').serialize(),
            success: function(response) {

                if (response == "verify") {
                    swal({
                        title: "Just one more step!",
                        text: "Please check your email to verify your registration",
                        type: "success"
                    }).then(function() {
                        location.href = '<?php echo base_url(); ?>signin';
                    });
                } else {
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }
});

$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
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
                    sweetAlert("Oops...", "Something went Wrong", "error");
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
// FB.init({
//   appId: '323814224809825',
//   channelUrl : '',
//   xfbml: true,
//   status: true,
//   cookie: true,
// });
//
// function fbAuthUser() {
//     FB.login(checkLoginStatus);
// }
//
//
// function checkLoginStatus(response) {
//     if(response && response.status == 'connected') {
// 	 FB.api('/me', {fields: 'name,email'}, function(response) {
//         var fbname=response.name;
// 		var fbemail=response.email;
//
//         swal('Please wait')
//         swal.showLoading();
//          $.ajax({
//               url:'<?php echo base_url(); ?>home/facebook_login',
//               data: { 'fbname' : fbname, 'fbemail' : fbemail },
//               type: "POST",
//               crossDomain: true,
//               success: function (data) {
//               if(data=="success"){
//                 setTimeout(function(){
//                  window.location.reload(1);
//               }, 1000);
//               }else{
//                 sweetAlert("Oops...", "Something wen Wrong", "error");
//               }
//
//           }
//
//
//         });
//     });
//     } else {
//         document.getElementById("fb").checked = false
//     }
// }

</script>

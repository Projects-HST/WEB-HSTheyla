<div class="container-fluid signinbg">
  <div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8  col-md-auto signin-div">
    <div class="row">
    <p class="login-heading">Sign In</p>
      <p class="login_tag">Heyla&#8212;a window to the stages of the city-state</p>

    <div class="col-lg-6 col-sm-12">
      <form action="<?php echo base_url(); ?>adminlogin/home" method="post" class="formsignin" id="formsignin">
        <div class="col-xs-6 form_box" >
          <div class="left-inner-addon">
            <i class="fas fa-user"></i>
            <input type="text" class="form-control" name="username" id="username"  placeholder="Username/Mobile Number/Email ID" />
          </div>
        </div>
        <div class="col-xs-6 form_box" >
          <!-- <div class="left-inner-addon">
            <i class="fas fa-lock"></i>
            <input type="password" class="form-control" id="pwd" name="pwd"  placeholder="Password"  required/>
          </div> -->
          <div class="left-inner-addon">
            <i class="fas fa-lock"></i>
            <input id="password-field" type="password" class="form-control"  name="pwd"  placeholder="Password" value="" >
             <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
           </div>
        </div>
        <p><a href="<?php echo base_url(); ?>reset" class="forgotpwdtext">Forgot Password?</a></p>
        <div class="col-xs-12" >
            <input type="submit" class="btn btn-primary btn-block btn-login" placeholder="Password" value="Sign In" />
        </div>
        <p>Don’t have an account? <a href="<?php echo base_url(); ?>signup">Sign Up</a> </p>
      </form>

    </div>
<div class="col-md-1">
  <p class="or-text">OR</p>
</div>
    <div class="col-lg-5 col-md-12 col-sm-12">
      <div class="socialmedia-tab">
        <!-- <a class="social-link-img" onclick="checkLoginState()" scope="public_profile,email"><img src="<?php echo base_url(); ?>assets/front/images/login-facebook.png" class="img-responsive social-img"></a><br> -->

        <fb:login-button size="large" class="fb_btn" scope="public_profile,email"
                         onlogin="checkLoginState();">
          Sign in with Facebook
        </fb:login-button>

    <!-- <a onclick="checkLoginState();" class="social-link-img" scope="public_profile,email"><img src="<?php echo base_url(); ?>assets/front/images/fb-login.png" class="img-responsive social-img"></a> -->
  <br>
  <a href="<?php echo base_url(); ?>google_login" class="social-link-img"><img src="<?php echo base_url(); ?>assets/front/images/login-google.png" class="img-responsive social-img"></a>
</div>

   </div>
<br>

    </div>
  </div>
  </div>

  <div class="col-md-2">

  </div>
</div>




</div>
<div class="container">
       <?php
           if($this->session->flashdata('msg') !=   ''){
           ?>

               <script>
               $(document).ready(function(){
                   $("#wrongpassword").modal();
               });
               </script>

           <?php
           }
       ?>
</div>
<div class="modal fade" id="wrongpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
              <center>


                <p class="modal-msg">
                  <?php echo $this->session->flashdata('msg'); ?>

              </p>
              </center>
            </div>

        </div>
    </div>
</div>
<style>
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

$('#formsignin').validate({ // initialize the plugin
    rules: {
        username: {
            required: true
        },
        pwd: {
            required: true
        },

    },
    messages: {
        username: { required:"This field cannot be empty!" },
        pwd: { required:"This field cannot be empty!"}
    }

});

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '386225678654929',
      cookie     : true,
      xfbml      : true,
      version    : 'V3.3'
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
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>

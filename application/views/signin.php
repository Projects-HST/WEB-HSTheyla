<div class="container-fluid signinbg">
  <div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8 col-md-auto signin-div">
    <div class="row">
    <p class="login-heading">Login</p>
      <p class="login_tag">Become a part of our community!</p>

    <div class="col-md-6">
      <form action="<?php echo base_url(); ?>adminlogin/home" method="post" class="formsignin">
        <div class="col-xs-6 form_box" >
          <div class="left-inner-addon">
            <i class="fas fa-user"></i>
            <input type="text" class="form-control user-text-box" name="username" id="username" required placeholder="Username or Mobile Number or Email" />
          </div>
        </div>
        <div class="col-xs-6 form_box" >
          <!-- <div class="left-inner-addon">
            <i class="fas fa-lock"></i>
            <input type="password" class="form-control" id="pwd" name="pwd"  placeholder="Password"  required/>
          </div> -->
          <div class="left-inner-addon">
            <i class="fas fa-lock"></i>
            <input id="password-field" type="password" class="form-control"  name="pwd"  placeholder="Password" value="" required>
             <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
           </div>
        </div>
        <p><a href="<?php echo base_url(); ?>reset" class="forgotpwdtext">Forgot Password?</a></p>
        <div class="col-xs-12" >
            <input type="submit" class="btn btn-primary btn-block btn-login" placeholder="Password" value="Login" />
        </div>
        <p>Dont have a Heyla account yet?<br><a href="<?php echo base_url(); ?>signup">Create your account now</a> </p>
      </form>

    </div>
<div class="col-md-1">
  <p class="or-text">OR</p>
</div>
    <div class="col-md-5">
      <div class="socialmedia-tab">
        <a class="social-link-img" onclick="fbAuthUser(function(response){},{perms:'email,publish_stream'})" scope="public_profile,email"><img src="<?php echo base_url(); ?>assets/front/images/login-facebook.png" class="img-responsive social-img"></a><br>
      <a href="<?php echo base_url(); ?>google_login" class="social-link-img"><img src="<?php echo base_url(); ?>assets/front/images/login-google.png" class="img-responsive social-img"></a>
    </div>
    </div>
  </div>
  </div>

  <div class="col-md-2">

  </div>
</div>
<div class="container-fluid">
<center>  <img src="<?php echo base_url(); ?>assets/front/images/login_bg.png" class="img-thumbnail"> </center>
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
<script src="//connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript">


// Initialize the Facebook JavaScript SDK
FB.init({
  appId: '323814224809825', // Your app id
  channelUrl : '', // Your channel url
  xfbml: true,
  status: true,
  cookie: true,
});

function fbAuthUser() {
    FB.login(checkLoginStatus);
}


function checkLoginStatus(response) {
    if(response && response.status == 'connected') {

//         FB.api('/me', {fields: 'name,email'}, function(response) {
//     user_email = response.email; //get user email
//     console.log(response);
//     alert(response.email);
// });

	 FB.api('/me', {fields: 'name,email'}, function(response) {
        var fbname=response.name;
		var fbemail=response.email;

        swal('Please wait')
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
        document.getElementById("fb").checked = false
    }
}

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
<style>

</style>

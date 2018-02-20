<div class="container-fluid signinbg">
  <div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6 col-md-auto signin-div">
    <div class="row">
    <p class="login-heading">
      Login to Heyla
    </p>
    <div class="col-md-6">
      <form action="<?php echo base_url(); ?>adminlogin/home" method="post" class="formsignin">
        <div class="col-xs-6" >
          <div class="left-inner-addon">
            <i class="fas fa-user"></i>
            <input type="text" class="form-control user-text-box" name="username" id="username" required placeholder="Username or Mobile Number or Email" />
          </div>
        </div>
        <div class="col-xs-6" >
          <div class="left-inner-addon">
            <i class="fas fa-lock"></i>
            <input type="password" class="form-control" id="pwd" name="pwd"  placeholder="Password"  required/>
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
        <a href="<?php echo base_url(); ?>facebook_login" class="social-link-img"><img src="<?php echo base_url(); ?>assets/front/images/login-facebook.png" class="img-responsive social-img"></a><br>
      <a href="<?php echo base_url(); ?>google_login" class="social-link-img"><img src="<?php echo base_url(); ?>assets/front/images/login-google.png" class="img-responsive social-img"></a>
    </div>
    </div>
  </div>
  </div>

  <div class="col-md-3">

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

</style>

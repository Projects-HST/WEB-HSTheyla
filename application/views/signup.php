<div class="container-fluid signinbg">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-md-auto signin-div">
            <div class="row">
                <p class="login-heading">
                    Sign up Now
                </p>
                <div class="col-md-6">
                    <form action="" method="post" class="formsignup" id="formsignup">
                        <div class="col-xs-6">
                            <div class="left-inner-addon">
                                <i class="fas fa-user"></i>
                                <input type="text" class="form-control" name="name" placeholder="Username" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="left-inner-addon">
                                <i class="fas fa-mobile-alt"></i>
                                <input type="text" class="form-control" name="mobile" placeholder="Mobile Number" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="left-inner-addon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" class="form-control" name="email" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="left-inner-addon">
                                <i class="fas fa-lock"></i>
                                <input type="password" class="form-control" name="new_password" placeholder="Password" />
                            </div>
                        </div>
                        <p>By signingup I agree <a href="<?php echo base_url(); ?>terms" class="">T&C<a/> and <a href="<?php echo base_url(); ?>privacy" class="">Privacy Policy</a></p>
                        <div class="col-xs-12">
                            <input type="submit" class="btn btn-primary btn-block btn-login" placeholder="Password" value="Sign Up" />
                        </div>
                        <p>Already Registered? <a href="<?php echo base_url(); ?>signin" class="">Login<a/></p>

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
<style>
.error{
  color: red;
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
        name: { required:"Enter the Username", minlength: "Min is 6", maxlength: "Max is 12",remote:"Username Already Exists" },
        email: { required:"Enter the Email id",remote:"Email id Already Exists" },
          mobile: { required:"Enter the Mobile number", minlength: "Min is 6", maxlength: "Max is 10",remote:"Mobile Number Already Exists" },

        new_password: { required:"Enter the Password", minlength: "Min is 6", maxlength: "Max is 12" }
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
                        title: "Success",
                        text: "You have Registered Successfully.",
                        type: "success"
                    }).then(function() {
                        location.href = '<?php echo base_url(); ?>verify';
                    });
                } else {
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }
});






</script>

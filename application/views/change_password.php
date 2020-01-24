<?php $user_id=$this->session->userdata('id');?>
<style>
.card-block{
  padding: 30px;
  margin-left: 10px;
  margin-right: 10px;
}
.footer_section{
  display: none;
}
.profile_active {
	 background-color: #696969;
}
.form-control-label{
  font-size: 18px;
  font-weight: 500;
}
.form-control{
  font-size: 16px;
}
.profile_tab{
  margin-top: 50px;
  margin-bottom:50px;
}

.upload-button {
    border: 1px solid black;
    border-radius: 20px;
    width: 150px;
    text-align: center;
    color: #fff;
    border-color: #fff;
    margin-top: 5px;
    margin-left: 5px;
    display: none;
}

.profile-pic {
    max-width: 200px;
    max-height: 200px;

    margin-top: 10px;
    margin-left: 20px;
    height: 200px;

}
.file-upload{
  padding-left:140px;
  margin-top: 10px;
}
.profile-img{
  text-align: center;
      margin-top: -200px;
}
.change_pic{
  margin-top: 200px;
}
</style>
<div class=" col-md-12 " id="content">
    <h3 class="dashboard_tab">Change Password</h3>
</div>
<div class="col-md-12 profile_tab">
<div class="col-md-9">
  <form class="form" role="form" autocomplete="off" method="post" action="" id="change_password">
        <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Old Password <span class="error">*</span></label>
          <div class="col-md-5"><input class="form-control" type="password" id="old_password" name="old_password" value="" maxlength="12"></div>
		   <div class="col-md-1"> <span toggle="#old_password" class="fa fa-fw fa-eye-slash field-icon old_password"></span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">New Password <span class="error">*</span></label>
          <div class="col-md-5"><input class="form-control" type="password" id="new_password" name="new_password" value="" maxlength="12"></div>
		   <div class="col-md-1"> <span toggle="#new_password" class="fa fa-fw fa-eye-slash field-icon new_password"></span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Confirm Password <span class="error">*</span></label>
          <div class="col-md-5"><input class="form-control" type="password" id="confirm_password" name="confirm_password" value="" maxlength="12"></div>
		   <div class="col-md-1"> <span toggle="#confirm_password" class="fa fa-fw fa-eye-slash field-icon confirm_password"></span></div>
      </div>

      <div class="form-group row">
          <label class="col-md-4 col-form-label form-control-label"></label>
          <div class="col-md-6">
		   <input class="form-control" type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>">
              <input type="submit" class="btn btn-primary" value="Change">
          </div>
      </div>
  </form>
</div>



</div>

<script>

$.validator.addMethod("password_validate", function(value, element) {
   return $('#new_password').val() == $('#confirm_password').val()
}, "* Please check confirm password");

$('#change_password').validate({ // initialize the plugin
    rules: {
		old_password: {
          required: true,  minlength : 6,maxlength:12,
		  remote: {
                       url: "<?php echo base_url(); ?>users/check_password_match/<?php echo $user_id; ?>",
                       type: "post"
                    }
        },
		new_password: {
          required: true,  minlength : 6,maxlength:12,
        },
        confirm_password: {
            required: true,
            equalTo : '[name="new_password"]',
          }
  },
  messages: {
	   old_password: {
        required:"Please enter old password!",minlength:"Password should be minimum of 6 characters",maxlength:"Password should not be more than 12 characters",
		remote: "Old Password doesn't match!"
      },
      new_password: {
        required:"Please enter new password!",minlength:"Password should be minimum of 6 characters",maxlength:"Password should not be more than 12 characters",
      },
      confirm_password: {
              required: "You should confirm your password!",
              notEqualTo: "Password should match"
      }
  },
    submitHandler: function(form) {
        //alert("hi");
        $.ajax({
            url: "<?php echo base_url(); ?>home/password_change",
            type: 'POST',
            data: $('#change_password').serialize(),

            success: function(response) {
                if (response == "success") {
                    swal({
                        title: "success",
                        text: " Password Saved.",
                        type: "success"
                    }).then(function() {
						location.href = '<?php echo base_url(); ?>leaderboard';
						});
                } else {
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }
});

$(".old_password").click(function() {
  $(this).toggleClass("fa-eye-slash fa-eye");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$(".new_password").click(function() {
  $(this).toggleClass("fa-eye-slash fa-eye");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$(".confirm_password").click(function() {
  $(this).toggleClass("fa-eye-slash fa-eye");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

</script>

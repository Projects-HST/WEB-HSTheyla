<script src="<?php echo base_url(); ?>assets/front/js/jquery.form.js"></script>
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
    border-left: 4px solid #458ecc;
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
<div class="col-md-7">
  <form class="form" role="form" autocomplete="off" method="post" action="" id="change_password">
      <div class="form-group row">
          <label class="col-md-4 col-form-label form-control-label">New Password</label>
          <div class="col-md-6"><input class="form-control" type="password" id="new_password" name="new_password" value=""></div>
      </div>
      <div class="form-group row">
          <label class="col-md-4 col-form-label form-control-label">Confirm Password</label>
          <div class="col-md-6"><input class="form-control" type="password" id="confirm_password" name="confirm_password" value=""></div>
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

<div class="col-md-5 change_pic">

</div>

</div>

<script>

$.validator.addMethod("password_validate", function(value, element) {
   return $('#new_password').val() == $('#confirm_password').val()
}, "* Please check confirm password");

$('#change_password').validate({ // initialize the plugin
    rules: {
        new_password: {
            required: true
        },
        confirm_password: {
            required: true,
			password_validate:true
        },
    },
    messages: {
        new_password: {
					   required: "Please enter new password",
                      // new_password: "Please enter new password",
                      // remote: "Username already in use!"
                   },
         confirm_password: {
                        required: "Please enter confirm password",
						//password_validate:" ",
                       // confirm_password: "Please enter confirm password",
                      //  remote: "Mobile number already in exist!"
                    },
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

</script>

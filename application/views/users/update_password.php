<div class="page-content-wrapper ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">
                    <h4>Reset Password </h4><br>
                    <?php foreach($users_view AS $res){ }
                    ?>
                    <form action="" method="post" id="form_id">
                        <div class="row">
                          <div class="col-md-12">

                            <div class="form-group row">
                              <div class="col-md-3">New Password <span class="error">*</span></div>
                              <div class="col-md-3">
                                  <input type="text" class="form-control" name="new_password" value="">
                              </div>
                           </div>
                           <div class="form-group row">
                             <div class="col-md-3">Confirm New Password <span class="error">*</span></div>
                             <div class="col-md-3">
                                 <input type="text" class="form-control" name="confrim_password" value="">
                             </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <input type="submit" class="btn btn-success"  value="Save">
                            </div>
                         </div>
                        </div>
                    </div>
                  </form>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.txt_label{

}
.txt_value{
  color: #f71010;
  font-size: 15px;
  font-weight: 600;
}
.bor{
  border: 1px solid #000;
  padding-top: 10px;
}
</style>
<script>
$(document).ready(function () {

  $('#form_id').validate({
  rules: {
      new_password: {
          required: true,  minlength : 6,maxlength:12,
        },
        confrim_password: {
            required: true,
            equalTo : '[name="new_password"]',
          }
  },
  messages: {
      new_password: {
        required:"Please enter new password!",minlength:"Password should be minimum of 6 characters",maxlength:"Password should not be more than 12 characters",
      },
      confrim_password: {
              required: "You should confirm your password!",
              notEqualTo: "Password Should Match"
      }
  },
  submitHandler: function(form) {
  $.ajax({
             url: "<?php echo base_url(); ?>users/change_password",
             type: 'POST',
             data: $('#form_id').serialize(),
             dataType: "json",
             success: function(response) {
                var stats=response.status;
                 if (stats=="success") {
                swal('Password reset successfully')
                window.setTimeout(function () {
                 location.href = "<?php echo base_url(); ?>adminlogin/dashboard";
               }, 1000);

               }else{
                   $('#res_otp').html(response.msg)
                   }
             }
         });
       }
  });
 });
</script>

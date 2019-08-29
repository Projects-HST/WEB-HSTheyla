    <section class="">
      <div class="container">
        <div class="">
<center>


  <p style="font-size:22px;margin-top:150px;">Reset Password</p>
        <div class="reset">

  <div class="" style="margin-bottom:100px;">
    <form class="form" role="form" autocomplete="off" id="update_pass" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <input type="password" class="form-control" id="new_password" name="new_password" required="" placeholder="New password">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="email_token" name="email_token" value="<?php echo $res; ?>">
        </div>

        <div class="form-group">
            <input type="password" class="form-control" id="retype_password" name="retype_password" required="" placeholder="Confirm new password">
        </div>
        <button type="submit" id="submit" class="btn btn-event btn-lg">Reset</button>
    </form>
  </div>
</div>
</center>
        </div>
      </div>
    </section>
<style>
.reset{

  align-items: center;
  margin-top: 5%;
}
.form-control{
  width: 270px;
}
/* input[type=password] {
    background: transparent;
    border: none;
    border-bottom: 1px solid #000000;
} */

</style>

<script type="text/javascript">

   $('#update_pass').validate({ // initialize the plugin
       rules: {
         new_password : {
              minlength : 6,maxlength:12,
          },
          retype_password : {

              equalTo : '[name="new_password"]',
          }
       },
       messages: {
           new_password: {           required:"Please enter new password!",minlength:"Password should be minimum of 6 characters",maxlength:"Password should not be more than 12 characters",
},
           retype_password: {
               required: "You should confirm your new password!",
               equalTo:"The passwords in both fields don't match!",
               notEqualTo: "Password Should Match"
           }


       },
       submitHandler: function(form) {
           //alert("hi");
           $.ajax({
               url: "<?php echo base_url(); ?>home/update_password",
               type: 'POST',
               data: $('#update_pass').serialize(),
               success: function(response) {

                   if (response == "success") {
                     swal({
                title: " ",
                text: " Your password has been reset",
                type: "success"
            }).then(function() {
                location.href = '<?php echo base_url(); ?>';
            });
                   } else {
                       sweetAlert("Oops...", response, "error");
                   }
               }
           });
       }
   });
</script>

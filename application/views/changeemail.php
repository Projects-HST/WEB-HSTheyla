
<style>
.reset{

  align-items: center;
  margin-top: 5%;
}
.form-control{
  width: 270px;
}

.error{
  color:red;
}

</style>

    <section class="" style="margin-bottom:100px;margin-top:100px;">
      <div class="container">
        <div class="">
<center>


  <p style="font-size:24px;">Change Email ID</p>
        <div class="reset">

  <div class="">
    <form class="form" role="form" autocomplete="off" id="update_email_id" method="post" enctype="multipart/form-data">
      <?php foreach($res as $rows){} ?>
        <div class="form-group">
            <input type="text" class="form-control" id="old_email" name="old_email" readonly required="" value="<?php echo $rows->email_id; ?>">

        </div>

        <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" required="" placeholder="Enter New Email ID " >

            <p id="emailmsg"></p>
        </div>

        <button type="submit" id="submit" class="btn btn-event btn-lg">Submit</button>
    </form>
  </div>
</div>
</center>
        </div>
      </div>
    </section>


<script type="text/javascript">
$.validator.addMethod("user_email_not_same", function(value, element) {
   return $('#old_email').val() != $('#email').val()
}, "* old mail and Email should not match");

   $('.verify-page').height($(window).height());
   $('#update_email_id').validate({ // initialize the plugin
       rules: {
         old_mail :{required:true,user_email_not_same:true},
          email : {
              email : true,
              user_email_not_same : true,
              required: true,email:true,
              remote: {
                     url: "<?php echo base_url(); ?>home/existemail",
                     type: "post"
                  }
          }

       },
       messages: {

            email: {   required: "Enter new  email ID",user_email_not_same:" ",remote:"Email already exists!"

          }


       },
       submitHandler: function(form) {
           //alert("hi");
           $.ajax({
               url: "<?php echo base_url(); ?>home/save_email_id",
               type: 'POST',
               data: $('#update_email_id').serialize(),
               success: function(response) {

                   if (response == "success") {
                     swal({
                title: "",
                text: "Please check your email to get your new email ID verified",
                type: "success"
            }).then(function() {
                location.href = '<?php echo base_url(); ?>profile';
            });
                   } else {
                       sweetAlert("Oops...", response, "error");
                   }
               }
           });
       }
   });




</script>

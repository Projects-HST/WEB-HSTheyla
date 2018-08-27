
<style>
.reset{

  align-items: center;
  margin-top: 5%;
}
.form-control{
  width: 270px;
}
input[type=text] {
    background: transparent;
    border: none;
    border-bottom: 1px solid #000000;
}
.footer{
  position: fixed;
  bottom: 0px;
  width: 100%;
}

</style>

    <section class="" style="margin-bottom:60px;">
      <div class="container">
        <div class="">
<center>


  <p style="margin-top:5%;font-size:24px;">If email has changed the verification link has sent to the new email you have entered.</p>
        <div class="reset">

  <div class="">
    <form class="form" role="form" autocomplete="off" id="update_email_id" method="post" enctype="multipart/form-data">
      <?php foreach($res as $rows){} ?>
        <div class="form-group">
            <input type="text" class="form-control" id="old_email" name="old_email" readonly required="" value="<?php echo $rows->email_id; ?>">

        </div>



        <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" required="" placeholder="Enter New Email_id " >

            <p id="emailmsg"></p>
        </div>

        <button type="submit" id="submit" class="btn btn-event btn-lg">save</button>
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

            email: {   required: "Enter New Mail",user_email_not_same:" ",remote:"Email already exist"

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
                title: "Success",
                text: " Email Has been Changed Successfully",
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

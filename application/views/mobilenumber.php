
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

    <section class="" style="margin-top:100px;margin-bottom:100px;">
      <div class="container">
        <div class="">
<center>


  <p style="font-size:22px;">Change  Mobile Number</p>
        <div class="reset">

  <div class="">
    <form class="form" role="form" autocomplete="off" id="update_mobile_number" method="post" enctype="multipart/form-data">
      <?php foreach($res as $rows){} ?>
        <div class="form-group">
            <input type="text" class="form-control" id="new_password" name="new_password" readonly required="" value="<?php echo $rows->mobile_no; ?>">

        </div>



        <div class="form-group">
            <input type="text" class="form-control" id="mobile" name="mobile" required="" placeholder="Enter New Mobile Number" maxlength="12">
              <br><span><button onclick="sendOTP()" id="sendbtn">Send  OTP</button></span>
            <p id="mobilenum"></p>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="mobileotp" name="mobileotp"  placeholder="Enter OTP" maxlength="4">
            <p id="mobilemsg"></p>
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
   $('.verify-page').height($(window).height());
   $('#update_mobile_number').validate({ // initialize the plugin
       rules: {
         mobile : {
           required: true,minlength: 8, maxlength: 12, digits: true,
           remote: {
                  url: "<?php echo base_url(); ?>home/existmobile",
                  type: "post",  complete: function(data){
                          if( data.responseText == "false" ) {
                            $('#sendbtn').hide();
                          }else {
                              $('#sendbtn').show();
                          }
                     }
               }
          },
          mobileotp : {
             required: true,
             remote: {
                    url: "<?php echo base_url(); ?>home/checkotp",
                    type: "post"
                 }
           },

       },
       messages: {
         mobile: { required:"This field cannot be empty!", digits:"Only numbers",remote:"Mobile number already exists!" },
         mobileotp: {   required: "Enter OTP",remote:"Invalid OTP"}
       },
       submitHandler: function(form) {
           //alert("hi");
           $.ajax({
               url: "<?php echo base_url(); ?>home/save_mobile_number",
               type: 'POST',
               data: $('#update_mobile_number').serialize(),
               success: function(response) {

                   if (response == "success") {
                     swal({
                title: "",
                text: " Mobile number changed successfully",
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

   $('#sendbtn').hide();
   function sendOTP(){

     var mobile=$('#mobile').val();

     $.ajax({
         method: "post",
       url: "<?php echo base_url(); ?>home/sendOTP",
       data: {
           mobile: mobile
       },
       cache: false,
       success: function(response){
        //  $('#sendbtn').prop('disabled', true);

       }
     });
   }
   // function checkOTP(){
   //   var mobileotp = $('#mobileotp').val();
   //
   //   $.ajax({
   //       method: "post",
   //       data: {
   //           mobileotp: mobileotp
   //       },
   //       url: 'home/checkotp',
   //       success: function(data) {
   //           console.log(data);
   //           if ((data) == "success") {
   //               $("#submit").removeAttr("disabled");
   //                   $('#mobilemsg').html(' ');
   //
   //               // $('#mobilemsg').html('Username Available');
   //           } else {
   //               $('#submit').prop('disabled', true);
   //               $('#mobilemsg').html(data);
   //
   //           }
   //       }
   //   });
   // }
   function check_mobile() {
       var mobile = $('#mobile').val();

       $.ajax({
           method: "post",
           data: {
               mobile: mobile
           },
           url: 'home/checkmobile',
           success: function(data) {
               // console.log(data);

               if ((data) == "success") {
                   $("#submit").removeAttr("disabled");
                    $('#mobilenum').html(' ');
                     $("#sendbtn").removeAttr("disabled");
                       $('#sendbtn').show();
               } else {
                   $('#submit').prop('disabled', true);
                    $('#mobilenum').html(data);
                      $('#sendbtn').hide();
               }
           }
       });
   }


</script>

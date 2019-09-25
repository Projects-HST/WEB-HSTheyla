<script src="<?php echo base_url(); ?>assets/front/js/jquery.cookie.js"></script>

    <section class="">
      <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="reset_section">
          <div class="verify-text" style="    margin-bottom: 100px;">
            <center>
                <img src="<?php echo base_url(); ?>assets/front/images/forgot_password.png" class="img-responsive imgsize_80 forgot_img">
              <form action="" method="post" id="resetform" class="resetform">
                <div class="form-group">
                  <label for="exampleInputPassword1">Please enter your registered mobile number to reset your password</label>
                  <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="">
                </div>
                <div class="form-group">

                  <input type="submit" class=" btn_no_radius btn btn-login" id="" value="Submit">
                </div>
              </form>
            </center>
          </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="otp_form">
          <div class="verify-text" style="    margin-bottom: 100px;">
            <center>
          <img src="<?php echo base_url(); ?>assets/front/images/forgot_password.png" class="img-responsive imgsize_80 forgot_img">
              <form action="" method="post" id="otp_form_validate" class="otp_form_validate">
                <div class="form-group">
                  <label for="exampleInputPassword1">Please enter the OTP</label>
                    <input type="text" class="form-control" name="mobile_otp" id="mobile_otp" placeholder="OTP" />
                      <small><a  href="#" class="pull-right btn_resend_otp" onclick="resend_otp_function()" >Resend OTP</a></small>
                </div>
                <div class="form-group">

                <input type="submit" class="btn btn-primary btn-block btn-login" placeholder="Password" value="Verfiy OTP" />
                </div>
              </form>
            </center>
          </div>
        </div>


      </div>
    </section>

    <style>

    .modal {
      text-align: center;
      padding: 0!important;
    }

    .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
    }
    .modal-body{
      padding-top:30px;
      padding-bottom:30px;
      padding-left: 40px;
      padding-right: 40px;
      border: 2px solid #6D6E71;
      border-radius: 20px;
    }
    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }

    </style>

<script type="text/javascript">
$('#reset_section').show();
$('#otp_form').hide();

    $("#myModal").modal('show');

    $("#loginbtn").click(function() {
        $(this).toggleClass("menuactive");
    });
    $('ul li a').click(function() {
        $('li a').removeClass("menuactive");
        $(this).addClass("menuactive");
    });

    $("#setting").click(function() {
        $("#edit-btn").toggle();
    });

    $("#edit-btn").click(function() {
        $("#form").toggle();
        $('#per-info').hide();
    });

   $('.verify-page').height($(window).height());

   $('#resetform').validate({ // initialize the plugin
       rules: {
           mobile_number: {required: true},
       },
       messages: {
           mobile_number: "Mobile number is required!"
       },
       submitHandler: function(form) {
         var mobile=$('#mobile_number').val();

         $.cookie("mobile_cookie", mobile);
           $.ajax({
               url: "<?php echo base_url(); ?>home/reset_password",
               type: 'POST',
               data: $('#resetform').serialize(),
               success: function(response) {

                   if (response == "OTP Resent") {
            swal('OTP Sent to Mobile number');
            $('#otp_form').show();
            $('#reset_section').hide();
                   } else {
                       sweetAlert("Oops...", response, "error");
                   }
               }
           });
       }
   });

   $('#otp_form_validate').validate({
       rules: {
           mobile_otp: {
               required: true
           }
       },
       messages: {
           mobile_otp: { required:"OTP cannot be empty!"}
       },
       submitHandler: function(form) {
           var mobile=$.cookie("mobile_cookie");
           var ency_mobile=btoa(mobile*987654);

           var mobile_otp=$('#mobile_otp').val();
           $.ajax({
               url: "<?php echo base_url(); ?>home/password_otp_check",
               type: 'POST',
               dataType : 'json',
               data: { mobile_otp: mobile_otp,mobile : mobile},
               success: function(response) {

                 if (response.status== "success") {
                   $.removeCookie("mobile_cookie");
                     swal({
                        title: " ",
                        text: "Thank you Mobile number verified!.",
                        type: "success"
                    }).then(function() {
                        location.href = '<?php echo base_url(); ?>home/reset/'+ency_mobile+'';
                    });
                   } else {
                       sweetAlert("Oops...", response.msg, "error");
                   }
               }
           });
       }
   });

   function resend_otp_function(){
     var mobile=$.cookie("mobile_cookie");
     $.ajax({
         method: "post",
       url: "<?php echo base_url(); ?>home/mobile_otp_update",
       data: {
           mobile: mobile
       },
       cache: false,
       success: function(response){
         swal(response);

       }
     });
   }
</script>

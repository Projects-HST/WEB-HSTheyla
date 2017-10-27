<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#478ECC" />

    <title>HEYLA</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.form.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
</head>
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

</style>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark   menupage">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Home
                <span class="sr-only"></span>
              </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#create">Create Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#contact">Contact</a>
                    </li>
                    <?php
                       $user_id=$this->session->userdata('user_role');
                       if(empty($user_id)){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Login / Sign in</a>
                        </li>
                        <?php }else{ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>logout">Logout</a>
                            </li>
                            <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
    <section class="">
      <div class="container">
        <div class="">
<center>


  <p style="margin-top:5%;font-size:22px;">Change the Mobile Number</p>
        <div class="reset">

  <div class="">
    <form class="form" role="form" autocomplete="off" id="update_mobile_number" method="post" enctype="multipart/form-data">
      <?php foreach($res as $rows){} ?>
        <div class="form-group">
            <input type="text" class="form-control" id="new_password" name="new_password" readonly required="" value="<?php echo $rows->mobile_no; ?>">

        </div>



        <div class="form-group">
            <input type="text" class="form-control" id="mobile" name="mobile" required="" placeholder="Enter New Mobile Number " onkeyup="check_mobile()">
              <span><button onclick="sendOTP()" id="sendbtn">Send  OTP</button></span>
            <p id="mobilenum"></p>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="mobileotp" name="mobileotp"  placeholder="Enter OTP" onkeyup="checkOTP()">
            <p id="mobilemsg"></p>
        </div>
        <button type="submit" id="submit" class="btn btn-event btn-lg">save</button>
    </form>
  </div>
</div>
</center>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer-bg fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="fnt-footer">Powerded By Happysanz Tech</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline fnt-footer ">
                        <li class="list-inline-item"><a href="">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="">Payment Policy</a></li>
                        <li class="list-inline-item"><a href="">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->
    </footer>

</body>
<script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
<script type="text/javascript">
   $('.verify-page').height($(window).height());
   $('#update_mobile_number').validate({ // initialize the plugin
       rules: {
         mobile : {
            required: true,  maxlength : 10
          },
          mobileotp : {
             required: true
           },

       },
       messages: {
           mobile: {   required: "Enter  Mobile Number", maxlength: "Max is 10"},
            mobileotp: {   required: "Enter  OTP"}


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
                title: "Success",
                text: " Mobile Number Has been Changed Successfully",
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
           $('#sendbtn').prop('disabled', true);

       }
     });
   }
   function checkOTP(){
     var mobileotp = $('#mobileotp').val();

     $.ajax({
         method: "post",
         data: {
             mobileotp: mobileotp
         },
         url: 'home/checkotp',
         success: function(data) {
             console.log(data);
             if ((data) == "success") {
                 $("#submit").removeAttr("disabled");
                     $('#mobilemsg').html(' ');
                 // $('#mobilemsg').html('Username Available');
             } else {
                 $('#submit').prop('disabled', true);
                 $('#mobilemsg').html(data);
             }
         }
     });
   }
   function check_mobile() {
       var mobile = $('#mobile').val();

       $.ajax({
           method: "post",
           data: {
               mobile: mobile
           },
           url: 'home/checkmobile',
           success: function(data) {
               console.log(data);
               if ((data) == "success") {
                   $("#submit").removeAttr("disabled");
                    $('#mobilenum').html(' ');
               } else {
                   $('#submit').prop('disabled', true);
                    $('#mobilenum').html(data);
               }
           }
       });
   }
</script>

</html>

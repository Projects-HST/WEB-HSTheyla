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
                      <a class="nav-link" href="<?php echo base_url(); ?>home">Home
                        <span class="sr-only"></span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo base_url(); ?>home#about">About</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo base_url(); ?>home#services">Services</a>
                  </li>
                   <?php
                      $user_role=$this->session->userdata('user_role');

                   if($user_role=='2'){ ?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo  base_url(); ?>dashboard">Create Event</a>
                  </li>
                  <?php }else{ ?>
                  <li class="nav-item">
                      <a class="nav-link" href="home#create">Create Event</a>
                  </li>
                  <?php } ?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo base_url(); ?>home#contact">Contact</a>
                  </li>

            <?php
               if(empty($user_role)){ ?>

            <?php
               }else{ ?>
                 <?php  if($user_role=='3' || $user_role=='2'){ ?>
               <li class="nav-item">
                   <a class="nav-link" href="<?php echo base_url(); ?>profile">Profile</a>
               </li>
             <?php  } ?>
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


  <p style="margin-top:5%;font-size:22px;">If email has changed the verification link has sent to the new email you have entered.</p>
        <div class="reset">

  <div class="">
    <form class="form" role="form" autocomplete="off" id="update_email_id" method="post" enctype="multipart/form-data">
      <?php foreach($res as $rows){} ?>
        <div class="form-group">
            <input type="text" class="form-control" id="old_email" name="old_email" readonly required="" value="<?php echo $rows->email_id; ?>">

        </div>



        <div class="form-group">
            <input type="text" class="form-control" id="email" name="email" required="" placeholder="Enter New Email_id " onkeyup="check_email()">

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

    <!-- Footer -->
    <footer class="footer-bg fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="fnt-footer">Crafted With Happiness</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline fnt-footer ">
                      <li class="list-inline-item"><a href="<?php echo base_url(); ?>privacy">Privacy Policy</a></li>
                      <li class="list-inline-item"><a href="<?php echo base_url(); ?>payment">Payment Policy</a></li>
                      <li class="list-inline-item"><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
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
$.validator.addMethod("user_email_not_same", function(value, element) {
   return $('#old_email').val() != $('#email').val()
}, "* old mail and Email should not match");

   $('.verify-page').height($(window).height());
   $('#update_email_id').validate({ // initialize the plugin
       rules: {
         old_mail :{required:true,user_email_not_same:true},
          email : {
              email : true,
              user_email_not_same : true
          }

       },
       messages: {

            email: {   required: "Enter New Mail",user_email_not_same:" ",

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



   function check_email() {
       var email = $('#email').val();

       $.ajax({
           method: "post",
           data: {
               email: email
           },
           url: 'home/existemail',
           success: function(data) {

               if ((data) == "success") {
                   $("#submit").removeAttr("disabled");
                    $('#emailmsg').html(' ');
                    //  $("#sendbtn").removeAttr("disabled");
                       $('#sendbtn').show();
               } else {
                   $('#submit').prop('disabled', true);
                    $('#emailmsg').html(data);
                      $('#sendbtn').hide();
               }
           }
       });
   }
</script>

</html>

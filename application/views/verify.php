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

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92904528-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-92904528-2');
    </script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.form.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
</head>
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
  padding-left: 20px;
  padding-right: 20px;
  border: 2px solid #6D6E71;
  border-radius: 20px;
}
.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

</style>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark   menupage">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
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
              // $user_role=$this->session->userdata('user_role');
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
    <section class="verify-page profile">
      <div class="container">
        <div class="row">
          <div class="verify-text">

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-body">
                        <center>
                          <img src="<?php echo base_url(); ?>assets/front/images/email.png" class="img-fluid">
                          <p class="verify-text1">Thanking for Registering.</p>
                          <p class="verify-text1">

              Check Your Inbox for  the verification email We’ve sent you a message to your registered email ID. Click on the verification link to confirm your email ID.
                          </p>
                        </center>
                      </div>

                  </div>
              </div>
          </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer-bg fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                      <p class="fnt-footer"><a href="http://happysanz.com/" target="_blank">Crafted With Happiness</a></p>
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
    $("#myModal").modal('show');
    $('#myModall').modal({
                         backdrop: 'static',
                         keyboard: true,
                         show: true
                 });
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

</script>
</html>

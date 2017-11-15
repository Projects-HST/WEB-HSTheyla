<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <meta name="theme-color" content="#478ECC" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

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

.email-verify{
  font-size: 33px;
  text-align: center;
  padding-top: 15%;
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
                        <a class="nav-link" href="<?php echo base_url(); ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Create Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Contact</a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav>
    <section class="verify-page ">
      <div class="container">
        <div class="">
          <div class="verified">


            <p class="email-verify">
              <?php
                if($res['msg']=="verify"){ ?>
                  Thank Your  Email Has been Verified Successfully .Click here to<a href="<?php echo base_url(); ?>"> Login</a>
              <?php  }else{
                  echo $res['msg'];
                }
               ?>

        </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer-bg fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="fnt-footer">Powered By Happysanz Tech</p>
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

</script>

</html>

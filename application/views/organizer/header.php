<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#999999" />
    <title>HEYLA</title>
    
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet">
    <!--script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script-->
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <!--script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script-->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
<!--link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"-->
<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
<!--link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css"-->

<link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

<!--Datatables-->
<link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Datepicker-->
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
 
 <!--  Forms Validations Plugin -->
  <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark  fixed-top menupage">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home
                <span class="sr-only"></span>
              </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Create Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
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

    <section class="organiser-home">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <p class="organiser-title">Let's create your very own event page to draw millions to experience events like never before.</p>
        </div>
        </div>
      </div>
    </section>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#478ECC" />
    <title>HEYLA </title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>assets/front/css/main.css" rel="stylesheet"> -->
    <!-- <link href="<?php echo base_url(); ?>assets/css/button.css" rel="stylesheet" type="text/css"> -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">


    <link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <!-- <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet"> -->
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92904528-2"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
    <!--  Forms Validations Plugin -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
</head>
<style>


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
                <ul class="navbar-nav ml-auto topmenu">
                    <li class="nav-item ">
                        <a class="nav-link" href="#">Home
                <span class="sr-only"></span>
              </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo  base_url(); ?>eventlist/">List Events</a>
                    </li>
                     <?php
                     $user_role=$this->session->userdata('user_role');
                     if($user_role=='2'){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo  base_url(); ?>dashboard">Create Event</a>
                    </li>
                    <?php }else{ ?>

                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    <?php
                    	// $user_role=$this->session->userdata('user_role');
                       if(empty($user_role)){ ?>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>signin" >Sign In </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>signup" >Sign Up</a>
                          </li>
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

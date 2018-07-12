<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="theme-color" content="#478ECC" />
    <title><?php if(isset($meta_title)){echo $meta_title;}else{echo "Heyla";}?> </title>
    <meta name="description" content="<?php if(isset($meta_description)){echo $meta_description;}else{echo "Heyla";}?>"/>
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>assets/front/css/main.css" rel="stylesheet"> -->
    <!-- <link href="<?php echo base_url(); ?>assets/css/button.css" rel="stylesheet" type="text/css"> -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900" rel="stylesheet">
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
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#478ECC;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto topmenu">
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo base_url(); ?>home">Home<span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo  base_url(); ?>eventlist/" id="list_events">List Events</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#create">Become Organiser</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#contact">Contact</a>
                    </li>

                    <?php
                   	$user_role = $this->session->userdata('user_role');
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
                                <a class="nav-link logout-btn" onclick="logout()">Logout</a>
                            </li>
                     <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

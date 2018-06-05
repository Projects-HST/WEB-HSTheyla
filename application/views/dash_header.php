<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Heyla</title>
<meta content="" name="description" />
<meta content="" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<head>
<link href="<?php echo base_url(); ?>assets/front/css/bootstrap3.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/dashboard.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/bootstrap3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a  href="">
                <img src="<?php echo base_url(); ?>assets/front/images/logo.png" alt="heylaapp" style="width:165px;">
            </a>

        </div>
        <div class="navbar-collapse collapse">
        <ul class="nav navbar-right top-nav">

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
              <a class="nav-link" href="<?php echo  base_url(); ?>eventlist/">List Events</a>
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

        <div class="collapse navbar-collapse navbar-ex1-collapse">
                  <ul class="nav navbar-nav side-nav" id="style-2">
              <li class=" hidden-xs">
                <a  href="">
                    <img src="<?php echo base_url(); ?>assets/front/images/logo.png" alt="heylaapp" style="width:165px;">
                </a>
              </li>

              <li class="hidden-sm hidden-xs">
                <a  href="" >
                    <img src="<?php echo base_url(); ?>assets/users/profile/1519106717.jpg" alt="LOGO" class="img-circle" style="width:150px;">
                </a>
              </li>
              <li class="name_tab">
                  <p class="user_name"> Name </p>
              </li>
                <li class="side-menu">
                      <a href="<?php echo base_url(); ?>leaderboard">Dashboard</a>
                </li>
                <li class="side-menu">
                    <a href="<?php echo base_url(); ?>profile">Profile</a>
                </li>
                <li class="side-menu">
                    <a href="<?php echo base_url(); ?>profile_picture">Display Picture</a>
                </li>
                <?php $user_role = $this->session->userdata('user_role');
                if($user_role=='2'){ ?>
                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>createevent">Create event</a>
                  </li>
                  <li class="side-menu">
                        <a href="<?php echo base_url(); ?>viewevents">View events</a>
                  </li>
                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>bookedevents">Booked Events</a>
                  </li>
                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>reviewevents">Reviews</a>
                  </li>

                <?php  } ?>
                <li class="side-menu">
                      <a href="<?php echo base_url(); ?>wishlist">Wishlist</a>
                </li>
                <li class="side-menu">
                    <a href="<?php echo base_url(); ?>booking_history">Booking history</a>
                </li>


            </ul>
        </div>


    </nav>

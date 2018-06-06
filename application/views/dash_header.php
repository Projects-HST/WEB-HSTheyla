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
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<style>
.navbar-fixed-top {
    top: 0;
    border-width: 0 0 1px;
    height: 70px;
}

.navbar-default .navbar-nav #user-profile {
    height: 50px;
    padding-top: 15px;
    padding-left: 58px;
}

.navbar-default .navbar-nav #user-profile img {
    height: 45px;
    width: 45px;
    position: absolute;
    top: 2px;
    left: 8px;
    padding: 1px;
}

#wrapper {
    padding-top: 50px;
    padding-left: 0;
    -webkit-transition: all .5s ease;
    -moz-transition: all .5s ease;
    -o-transition: all .5s ease;
    transition: all .5s ease;
}

@media (min-width: 992px) {
    #wrapper {
        padding-left: 225px;
    }
}

@media (min-width: 992px) {
    #wrapper #sidebar-wrapper {
        width: 225px;
    }
}

#sidebar-wrapper {
    border-right: 1px solid #e7e7e7;
}

#sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: 225px;
    width: 0;
    height: 100%;
    margin-left: -225px;
    overflow-y: auto;
    background: #f8f8f8;
    -webkit-transition: all .5s ease;
    -moz-transition: all .5s ease;
    -o-transition: all .5s ease;
    transition: all .5s ease;
}

#sidebar-wrapper .sidebar-nav {
    position: absolute;
    top: 0;
    width: 225px;
    font-size: 14px;
    margin: 0;
    padding: 0;
    list-style: none;
}

#sidebar-wrapper .sidebar-nav li {
    text-indent: 0;
    line-height: 45px;
}

#sidebar-wrapper .sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #428bca;
}

.sidebar-nav li:first-child a {
    background: #92bce0 !important;
    color: #fff !important;
}

#sidebar-wrapper .sidebar-nav li a .sidebar-icon {
    width: auto;
    height: auto;
    font-size: 14px;
    padding: 0 2px;
    display: inline-block;
    text-indent: 7px;
    margin-right: 10px;
    color: #fff;
    float: left;
}

#sidebar-wrapper .sidebar-nav li a .caret {
  position: absolute;
  right: 23px;
  top: auto;
  margin-top: 20px;
}

#sidebar-wrapper .sidebar-nav li ul.panel-collapse {
    list-style: none;
    -moz-padding-start: 0;
    -webkit-padding-start: 0;
    -khtml-padding-start: 0;
    -o-padding-start: 0;
    padding-start: 0;
    padding: 0;
}

#sidebar-wrapper .sidebar-nav li ul.panel-collapse li i {
    margin-right: 10px;
}

#sidebar-wrapper .sidebar-nav li ul.panel-collapse li {
    text-indent: 15px;
}

@media (max-width: 992px) {
    #wrapper #sidebar-wrapper {
        width: 45px;
    }
    #wrapper #sidebar-wrapper #sidebar #sidemenu li ul {
        position: fixed;
        left: 45px;
        margin-top: -45px;
        z-index: 1000;
        width: 200px;
        height: 0;
    }
}



.sidebar-nav li:nth-child(n) a {
    background-color: #418ecc !important;
    color: #fff !important;
}


.navbar-default{
  background-color: #fff;
}
</style>
<div id="navbar-wrapper">
      <header>
          <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
              <div class="container-fluid">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">
                          <img src="<?php echo base_url(); ?>assets/front/images/heyla_b.png" alt="heylaapp" style="width:100px;">
                      </a>
                  </div>
                  <div id="navbar-collapse" class="collapse navbar-collapse">
                      <ul class="nav navbar-nav navbar-right">

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

                                 <li class="dropdown">
                                     <a id="user-profile" href="#" class="dropdown-toggle" data-toggle="dropdown">
                                       <img src="<?php echo base_url(); ?>assets/users/profile/1519106717.jpg" class="img-responsive img-thumbnail img-circle"> </a>
                                     <ul class="dropdown-menu dropdown-block" role="menu">
                                         <li><a href="<?php echo base_url(); ?>profile">Profile</a></li>

                                         <li>
                                            <a class="nav-link logout-btn" onclick="logout()">Logout</a>
                                          </li>
                                     </ul>
                                 </li>
                           <?php  } ?>

                           <?php } ?>


                      </ul>
                  </div>
              </div>
          </nav>
      </header>
  </div>
  <div id="wrapper">
      <div id="sidebar-wrapper">
          <aside id="sidebar">
              <ul id="sidemenu" class="sidebar-nav">
                  <li>
                      <a href="<?php echo base_url(); ?>leaderboard">
                          <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                          <span class="sidebar-title">Dashboard</span>
                      </a>
                  </li>

                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>profile">
                        <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                        <span class="sidebar-title">Pofile</span>
                      </a>
                  </li>
                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>profile_picture">
                        <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                        <span class="sidebar-title">Display Picture</span>
                      </a>
                  </li>
                  <?php $user_role = $this->session->userdata('user_role');
                  if($user_role=='2'){ ?>
                    <li class="side-menu">
                        <a href="<?php echo base_url(); ?>createevent">
                          <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                          <span class="sidebar-title">Create Event</span>
                        </a>
                    </li>
                    <li class="side-menu">
                          <a href="<?php echo base_url(); ?>viewevents">
                            <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                            <span class="sidebar-title">View Events</span>
                          </a>
                    </li>
                    <li class="side-menu">
                        <a href="<?php echo base_url(); ?>bookedevents">
                          <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                          <span class="sidebar-title">Booked events</span>
                        </a>
                    </li>
                    <li class="side-menu">
                        <a href="<?php echo base_url(); ?>reviewevents">
                          <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                          <span class="sidebar-title">Reviews</span>
                        </a>
                    </li>

                  <?php  } ?>
                  <li class="side-menu">
                        <a href="<?php echo base_url(); ?>wishlist">
                          <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                          <span class="sidebar-title">Wishlist</span>
                        </a>
                  </li>
                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>booking_history">
                        <span class="sidebar-icon"><i class="fa fa-dashboard"></i></span>
                        <span class="sidebar-title">Booking History</span>
                      </a>
                  </li>
              </ul>
          </aside>
      </div>

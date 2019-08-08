<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Admin Dashboard</title>
<meta content="" name="description" />
<meta content="" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">

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

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <!--<a href="index.html" class="logo">Admiry</a>-->
            <a href="<?php echo base_url(); ?>adminlogin/dashboard" class="logo"><img src="<?php echo base_url(); ?>assets/images/heyla.png" height="" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <!--div class="user-details">
            <!-div class="text-center">
                <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="" class="rounded-circle">
            </div-->
            <!--div class="user-info">
                <h4 class="font-16">Admin</h4>
                <!-span class="text-muted user-status"><i class="fa fa-dot-circle-o text-success"></i> Online</span->
            </div->
        </div-->

        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?php echo base_url();?>adminlogin/dashboard" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <?php $user_role=$this->session->userdata('user_role');
                if($user_role==4){

                }else{ ?>
                  <li class="has_sub" id="master">
                      <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-apps"></i> <span> Masters </span> </a>
                      <ul class="list-unstyled">
                          <li id="country"><a href="<?php echo base_url();?>country/home">Country</a></li>
                          <li id="state"><a href="<?php echo base_url();?>state/home">State</a></li>
                          <li id="city"><a href="<?php echo base_url();?>city/home">City</a></li>
                          <li id="category"><a href="<?php echo base_url();?>category/home">Category</a></li>
                          <!-- <li id="userrole"><a href="<?php echo base_url();?>userrole/home">User Role</a></li> -->
                      </ul>
                  </li>
              <?php   } ?>


                <li class="has_sub" id="events">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-star" aria-hidden="true"></i>
                    <span>Events</span> </a>
                    <ul class="list-unstyled">
                        <li id="adevents"><a href="<?php echo base_url();?>events/home">Add Events</a></li>
                        <li id="vieweve"><a href="<?php echo base_url();?>events/view_events">View Events</a></li>
                        <li id="orgeve"><a href="<?php echo base_url();?>events/organizer_events">Organizer Events</a></li>
                    </ul>
                </li>

                <li class="has_sub" id="advertisement">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-calendar-clock"></i> <span> Advertisements </span> </a>
                    <ul class="list-unstyled">
                        <li id="plan"><a href="<?php echo base_url();?>advertisement/home"> Add Plan</a></li>
                        <li id="list"><a href="<?php echo base_url();?>advertisement/view_adv_plan">Add Banner Adv. </a></li>
                        <li id="history"><a href="<?php echo base_url();?>advertisement/view_adv_history">Banner Adv. History</a></li>
                        <!-- <li id="popup"><a href="#">Add Popup Adv. </a></li>
                        <li id="offers"><a href="#">Add Offers </a></li> -->
                    </ul>
                </li>

                <li class="has_sub" id="event_revies">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-write"></i><span> Event Reviews   </span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url();?>reviews/view_reviews">Unread </a></li>
                        <li><a href="<?php echo base_url();?>reviews/archive_reviews">Archived </a></li>
                    </ul>
                </li>

                <li class="has_sub" id="booking">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><span> Booking </span></a>
                    <ul class="list-unstyled">
                        <li id="org_request"><a href="<?php echo base_url();?>tracking/refund_request">Refund Tracking</a></li>
                        <li><a href="<?php echo base_url();?>bookinghistory/process_details">Process</a></li>
                        <li id="booking_status"><a href="<?php echo base_url();?>bookinghistory/status_details">Status</a></li>
                        <li id="booking_history"><a href="<?php echo base_url();?>bookinghistory/home">History</a></li>
                    </ul>
                </li>
                <?php $user_role=$this->session->userdata('user_role');
                if($user_role==4){

                }else{ ?>
                <li class="has_sub" id="users">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users" aria-hidden="true"></i>
                <span> User Management</span></a>
                    <ul class="list-unstyled">
                        <li id="createuser"><a href="<?php echo base_url();?>users/home">New User</a></li>
                        <li id="adminuser"><a href="<?php echo base_url();?>users/view">View Admin User</a></li>
                          <li id="normaluser"><a href="<?php echo base_url();?>users/view_normal_users">View Normal User</a></li>
                        <!-- <li id="followers"><a href="<?php echo base_url();?>users/view_followers">View User Followers</a></li> -->
                        <!--li id="guestuser"><a href="<?php echo base_url();?>guestuser/home">Guest User</a></li-->

                    </ul>
                </li>

                <li class="has_sub" id="track">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users" aria-hidden="true"></i>
                <span> Tracking</span></a>
                    <ul class="list-unstyled">

                        <li id="org_request"><a href="<?php echo base_url();?>dashboard/get_all_organiser_request">Organizer Request</a></li>
                        <li id="org_track"><a href="<?php echo base_url();?>tracking/organiser_event_tracking">Organizer Event Tracking</a></li>
                        <li id="event_track"><a href="<?php echo base_url();?>tracking/admin_event_tracking">Admin's Event Tracking</a></li>
                        <li id="event_track"><a href="<?php echo base_url();?>tracking/organiser_track_date">Organizer Event By Date</a></li>
                        <li id="event_track"><a href="<?php echo base_url();?>tracking/admin_track_date">Admin's Event By Date</a></li>


                    </ul>
                </li>

              <?php  } ?>

                <li class="has_sub" id="email">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-envelope" aria-hidden="true"></i>
<span> Newsletter </span></a>
                    <ul class="list-unstyled">
                        <li id="newsletter"><a href="<?php echo base_url();?>emailtemplate/home"> Newsletter Template</a></li>
                        <li id="sendemail"><a href="<?php echo base_url();?>emailtemplate/select_users"> Send Newsletter </a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->

<!-- Start right Content here -->
<div class="content-page">
<!-- Start content -->
<div class="content">

  <!-- Top Bar Start -->
  <div class="topbar">
<nav class="navbar-custom">
  <ul class="list-inline float-right mb-0">
          <?php
                    $id=$this->session->userdata('id');
                    //echo $id;
                    ?>

              <li class="list-inline-item dropdown notification-list">
                
                <a class="nav-link  arrow-none waves-effect nav-user" data-toggle="tooltip" data-placement="bottom"  title="Change Password" href="<?php echo base_url(); ?>users/update_password/">
                   Change Password
                </a>
                <?php $user_role=$this->session->userdata('user_role');
                if($user_role==4){

                }else{ ?>

                  <a class="nav-link  arrow-none waves-effect nav-user" data-toggle="tooltip" data-placement="bottom" title="Edit Profile" href="<?php echo base_url(); ?>users/edit/<?php echo $id;?>">
                     Profile
                  </a>

              <?php  }
                 ?>

                  <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" href="<?php echo base_url(); ?>adminlogin/logout">
                     Logout
                  </a>
                  <!--div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                      <!-a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                      <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                      <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a!->
                      <a class="dropdown-item" href="<?php echo base_url(); ?>adminlogin/logout"><i class="fa fa-cogs "></i>Logout</a>
                  </div-->
              </li>
          </ul>

          <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
              <button type="button" class="button-menu-mobile open-left waves-effect">
                <i class="ion-navicon"></i>
              </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
                <h3 class="page-title"> Welcome To Admin</h3>
            </li>
          </ul>

          <div class="clearfix"></div>
      </nav>
  </div>
  <!-- Top Bar End -->

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

<!-- Datatables-->
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
            <a href="#" class="logo"><img src="<?php echo base_url(); ?>assets/images/logo.png" height="" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="text-center">
                <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="" class="rounded-circle">
            </div>
            <div class="user-info">
                <h4 class="font-16">Admin</h4>
                <!--span class="text-muted user-status"><i class="fa fa-dot-circle-o text-success"></i> Online</span-->
            </div>
        </div>

        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="<?php echo base_url();?>adminlogin/dashboard" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> Masters </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url();?>country/home">Country</a></li>
                        <li><a href="<?php echo base_url();?>state/home">State</a></li>
                        <li><a href="<?php echo base_url();?>city/home">City</a></li>
                        <li><a href="<?php echo base_url();?>category/home">Category</a></li>
                        <li><a href="<?php echo base_url();?>userrole/home">User Role</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cube-outline"></i> <span>Events</span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url();?>events/home">Add Events</a></li>
                        <li><a href="<?php echo base_url();?>events/view_events">View Events</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-album"></i> <span> Advertisement Events</span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url();?>advertisement/home "> Plans</a></li>
                        <li><a href="<?php echo base_url();?>advertisement/view_adv_plan">List of Advertisement Events</a></li>
                        <li><a href="<?php echo base_url();?>advertisement/view_adv_history ">History of Advertisement Events</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-outline"></i><span> Reviews   </span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url();?>reviews/view_reviews">Event Pending Reviews</a></li>
                        <li><a href="<?php echo base_url();?>reviews/archive_reviews">Archive Reviews</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-line"></i><span> Booking </span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url();?>bookinghistory/home">History</a></li>
                        <li><a href="<?php echo base_url();?>bookinghistory/process_details">Process</a></li>
                        <li><a href="<?php echo base_url();?>bookinghistory/status_details">Status</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted-type"></i><span> User Management</span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url();?>users/home">User Creation</a></li>
                        <li><a href="<?php echo base_url();?>users/view">View Users Details</a></li>
                        <li><a href="<?php echo base_url();?>users/view_followers">View Users Followers Details</a></li>
                        <li><a href="<?php echo base_url();?>guestuser/home">Guest user Details</a></li>

                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-maps"></i><span> Newsletter </span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url();?>emailtemplate/home"> Newsletter Template</a></li>
                        <li><a href="<?php echo base_url();?>emailtemplate/select_users"> Send Newsletter </a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
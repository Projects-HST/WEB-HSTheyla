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
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>

<!--script src="<?php echo base_url(); ?>assets/js/jquery.validate.min"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></scrip-t-->


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
                        <li><a href="<?php echo base_url();?>advertisement/home ">History of Advertisement Events</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-outline"></i><span> Events </span></a>
                    <ul class="list-unstyled">
                        <li><a href="#">Form Elements</a></li>
                        <li><a href="#">Form Validation</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-line"></i><span> Users </span></a>
                    <ul class="list-unstyled">
                        <li><a href="#">Morris Chart</a></li>
                        <li><a href="#">Chartist Chart</a></li>
                        <li><a href="#">Chartjs Chart</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted-type"></i><span> NewsLetter </span></a>
                    <ul class="list-unstyled">
                        <li><a href="#">NewsLetter Templates</a></li>
                        <li><a href="#">Send NewsLetter</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-maps"></i><span> Notification </span></a>
                    <ul class="list-unstyled">
                        <li><a href="#"> Google Map</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="waves-effect"><i class="mdi mdi-calendar-check"></i><span> Booking Status </span></a>
                </li>

                
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
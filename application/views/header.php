<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Admin Dashboard</title>
<meta content="Admin Dashboard" name="description" />
<meta content="ThemeDesign" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
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
                    <a href="" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> Masters </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url();?>Countrymasters/home">Country</a></li>
                        <li><a href="#">Cards</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cube-outline"></i> <span>City</span> </a>
                    <ul class="list-unstyled">
                        <li><a href="#">Animation</a></li>
                        <li><a href="#">Highlight</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-album"></i> <span> Category </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="#">Material Design</a></li>
                        <li><a href="#">Ion Icons</a></li>
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
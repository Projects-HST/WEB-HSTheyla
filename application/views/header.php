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

<!-- <link rel="shortcut icon" href="assets/images/favicon.ico">
Morris Chart CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">

<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
</head>


<body class="fixed-left">

<!-- Loader
<div id="preloader"><div id="status"><div class="spinner"></div></div></div> --> 

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
            <a href="" class="logo"><img src="assets/images/logo.png" height="42" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div class="user-details">
            <div class="text-center">
                <img src="assets/images/users/avatar-1.jpg" alt="" class="rounded-circle">
            </div>
            <div class="user-info">
                <h4 class="font-16">Anderson Barden</h4>
                <span class="text-muted user-status"><i class="fa fa-dot-circle-o text-success"></i> Online</span>
            </div>
        </div>

        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="index.html" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard <span class="badge badge-primary pull-right">8</span></span>
                    </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> User Interface </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="">Buttons</a></li>
                        <li><a href="">Cards</a></li>
                        <li><a href="">Tabs &amp; Accordions</a></li>
                        <li><a href="">Modals</a></li>
                        <li><a href="">Images</a></li>
                        <li><a href="">Alerts</a></li>
                        <li><a href="">Progress Bars</a></li>
                        <li><a href="">Dropdowns</a></li>
                        <li><a href="">Lightbox</a></li>
                        <li><a href="">Navs</a></li>
                        <li><a href="">Pagination</a></li>
                        <li><a href="">Popover & Tooltips</a></li>
                        <li><a href="">Badge</a></li>
                        <li><a href="">Carousel</a></li>
                        <li><a href="">Video</a></li>
                        <li><a href="">Typography</a></li>
                        <li><a href="">Sweet-Alert</a></li>
                        <li><a href="">Grid</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-cube-outline"></i> <span> Advanced UI </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="">Animation</a></li>
                        <li><a href="">Highlight</a></li>
                        <li><a href="">Rating</a></li>
                        <li><a href="">Nestable</a></li>
                        <li><a href="">Alertify</a></li>
                        <li><a href="">Range Slider</a></li>
                        <li><a href="">Session Timeout</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-album"></i> <span> Icons </span> </a>
                    <ul class="list-unstyled">
                        <li><a href="">Material Design</a></li>
                        <li><a href="">Ion Icons</a></li>
                        <li><a href="">Font Awesome</a></li>
                        <li><a href="">Themify Icons</a></li>
                        <li><a href="">Dripicons</a></li>
                        <li><a href="">Typicons Icons</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-clipboard-outline"></i><span> Forms </span></a>
                    <ul class="list-unstyled">
                        <li><a href="">Form Elements</a></li>
                        <li><a href="">Form Validation</a></li>
                        <li><a href="">Form Advanced</a></li>
                        <li><a href="">ad</a></li>
                        <li><a href="">Form Mask</a></li>
                        <li><a href="">Summernote</a></li>
                        <li><a href="">Form Xeditable</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-line"></i><span> Charts </span></a>
                    <ul class="list-unstyled">
                        <li><a href="">Morris Chart</a></li>
                        <li><a href="">Chartist Chart</a></li>
                        <li><a href="">Chartjs Chart</a></li>
                        <li><a href="">Flot Chart</a></li>
                        <li><a href="">C3 Chart</a></li>
                        <li><a href="">Jquery Knob Chart</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted-type"></i><span> Tables </span></a>
                    <ul class="list-unstyled">
                        <li><a href="">Basic Tables</a></li>
                        <li><a href="">Data Table</a></li>
                        <li><a href="">Responsive Table</a></li>
                        <li><a href="">Editable Table</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-maps"></i><span> Maps </span></a>
                    <ul class="list-unstyled">
                        <li><a href=""> Google Map</a></li>
                        <li><a href=""> Vector Map</a></li>
                    </ul>
                </li>

                <li>
                    <a href="" class="waves-effect"><i class="mdi mdi-calendar-check"></i><span> Calendar </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-pages"></i><span> Pages </span></a>
                    <ul class="list-unstyled">
                        <li><a href="">Timeline</a></li>
                        <li><a href="">Invoice</a></li>
                        <li><a href="">Directory</a></li>
                        <li><a href="">Login</a></li>
                        <li><a href="">Register</a></li>
                        <li><a href="">Recover Password</a></li>
                        <li><a href="">Lock Screen</a></li>
                        <li><a href="">Blank Page</a></li>
                        <li><a href="">Error 404</a></li>
                        <li><a href="">Error 500</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
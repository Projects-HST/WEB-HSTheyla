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
    <link href="<?php echo base_url(); ?>assets/frontcss/carousel.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
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


<div class="container" style="margin-top:30px;margin-bottom:50px;max-width:100%;">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="<?php echo base_url(); ?>home" class="list-group-item">Dashboard</a>
            <a href="<?php echo base_url(); ?>organizer/createevents/" class="list-group-item">Create Events</a>
            <a href="<?php echo base_url(); ?>organizer/viewevents/" class="list-group-item active">View Events</a>
            <a href="organizer/bookings/" class="list-group-item">Bookings</a>
            <a href="organizer/messageboard/" class="list-group-item">Messages</a>
            <a href="organizer/reviews/" class="list-group-item">Reviews</a>
            <a href="organizer/followers/" class="list-group-item">Followers</a>
          </div>
        </div><!--/span-->
        
        <div class="col-12 col-md-9">
      <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
      
        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-block">

                    <h4 class="mt-0 header-title"></h4>

                     <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>


                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified" role="tablist" style="width:60%;margin-left:3%;">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">Advertisement</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">Hotspot </a>
                        </li>
                         <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab">Normal Events</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                            <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Category</th>
                            <th>Event City</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $rows){ 
                           $adv_sts=$rows->adv_status;
                          if($adv_sts=='Y'){ ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                            <td><a href="<?php echo base_url();?>organizer/updateevents/<?php echo $rows->id;?>"><i class="fa fa-pencil-square-o"></a></td>
                        </tr>
                       <?php } } ?>
                        </tbody>
                    </table>
                        </div>

                        <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                      <table class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Category</th>
                            <th>Event City</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $rows){ 
                           $hotspot_sts=$rows->hotspot_status;
                          if($hotspot_sts=='Y'){ ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                            <td><a href="<?php echo base_url();?>organizer/updateevents/<?php echo $rows->id;?>"><i class="fa fa-pencil-square-o"></a></td>
                        </tr>
                       <?php } }  ?>
                        </tbody>
                    </table>
                        </div>

                        <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                      <table class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Category</th>
                            <th>Event City</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $rows){
                           $adv_sts=$rows->adv_status;
                           $hotspot_sts=$rows->hotspot_status;
                          if($hotspot_sts=='N' && $adv_sts=='N'){ 
                           ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                            <td><a href="<?php echo base_url();?>organizer/updateevents/<?php echo $rows->id;?>"><i class="fa fa-pencil-square-o"></a></td>
                        </tr>
                       <?php } }  ?>
                        </tbody>
                    </table>                       
                        </div>
                       
                    </div>

                </div>
            </div>
        </div>
      </div> <!-- end row -->

     </div><!-- container -->
    </div> <!-- Page content Wrapper -->    
        </div><!--/span-->

        
      </div><!--/row-->
 </div>

        <!-- Footer -->
        <footer class="footer-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="fnt-footer">Powerded By Happysanz Tech</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline fnt-footer ">
                            <li class="list-inline-item"><a href="">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="">Payment Policy</a></li>
                            <li class="list-inline-item"><a href="">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </footer>



    </body>
    
    </html>
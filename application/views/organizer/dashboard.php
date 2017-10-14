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
    <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet">
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

        <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="<?php echo base_url(); ?>home" class="list-group-item active">Dashboard</a>
            <a href="<?php echo base_url(); ?>organizer/createevents/" class="list-group-item">Create Events</a>
            <a href="<?php echo base_url(); ?>organizer/viewevents/" class="list-group-item">View Events</a>
            <a href="<?php echo base_url(); ?>organizerbooking/view_booking/" class="list-group-item">Bookings</a>
            <a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a>
            <a href="<?php echo base_url(); ?>organizerbooking/reviews/" class="list-group-item">Reviews</a>
            <a href="<?php echo base_url();?>organizerbooking/view_followers/" class="list-group-item">Followers</a>
          </div>
        </div><!--/span-->
        
        <div class="col-12 col-md-9">
          
          <div class="jumbotron">
            <h1>Hello, world!</h1>
            <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
          </div>
         
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
    <script type="text/javascript">
    $("#loginbtn").click(function(){
         $(this).toggleClass("menuactive");
    });
    $('ul li').click(function(){
      $('li ').removeClass("tabactive");
      $(this).addClass("tabactive");
    });



    </script>

    </html>




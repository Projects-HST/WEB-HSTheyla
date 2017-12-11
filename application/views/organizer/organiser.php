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
                    <li class="nav-item active">
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

    <section class="organiser-section">
      <div class="container-fluid organiser-bg">
  <div class="row">
    <div  class="col-sm-12">


  <div class="row">
  <div class="col-md-2 organiser-menu"> <!-- required for floating -->
    <!-- Nav tabs -->
    <ul class="nav nav-tabs tabs-left">
      <li class="tabactive"><a href="#home" data-toggle="tab">View Profile</a></li>
      <li><a href="#profile" data-toggle="tab">Create Event</a></li>
      <li><a href="#messages" data-toggle="tab">View Event</a></li>
      <li><a href="#settings" data-toggle="tab">Payment History</a></li>
    </ul>
  </div>

  <div class="col-md-10 organiser-menu">
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="home">
        <div class="profile-section">
          <img src="<?php echo base_url(); ?>assets/front/images/add.png" class="img-fluid">
          <span  class="profilename">Name</span>
        </div>
        <div class="personalinfo">
          <div class="">
            <form action="" method="post" class="form-organiser">
              <div class="form-group row">
              <label for="example-text-input" class="col-1 col-form-label">Text</label>
              <div class="col-md-4 col-sm-12">
                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-search-input" class="col-1 col-form-label">Search</label>
              <div class="col-md-4 col-sm-12">
                <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-email-input" class="col-1 col-form-label">Email</label>
              <div class="col-md-6 col-sm-12">
                <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-search-input" class="col-1 col-form-label">Search</label>
              <div class="col-md-4 col-sm-12">
                <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-email-input" class="col-1 col-form-label">Email</label>
              <div class="col-md-4 col-sm-12">
                <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
              </div>
            </div>

  </form>
  </div>
        </div>

      </div>
      <div class="tab-pane" id="profile">Profile Tab.</div>
      <div class="tab-pane" id="messages">Messages Tab.</div>
      <div class="tab-pane" id="settings">Settings Tab.</div>
    </div>
  </div>
    </div>

  <div class="clearfix"></div>

</div>
  </div><!-- /row -->
</div>
    </scetion>



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

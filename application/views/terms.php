<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#478ECC" />

    <title>HEYLA</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92904528-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-92904528-2');
    </script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
    <!--  Forms Validations Plugin -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark   menupage">
      <div class="container">
          <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url(); ?>home">Home
                      <span class="sr-only"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>home#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>home#services">Services</a>
                </li>
                 <?php
                    $user_role=$this->session->userdata('user_role');

                 if($user_role=='2'){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo  base_url(); ?>dashboard">Create Event</a>
                </li>
                <?php }else{ ?>
                <li class="nav-item">
                    <a class="nav-link" href="home#create">Create Event</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>home#contact">Contact</a>
                </li>

          <?php
          	// $user_role=$this->session->userdata('user_role');
             if(empty($user_role)){ ?>

          <?php
             }else{ ?>
               <?php  if($user_role=='3' || $user_role=='2'){ ?>
             <li class="nav-item">
                 <a class="nav-link" href="<?php echo base_url(); ?>profile">Profile</a>
             </li>
           <?php  } ?>
                  <li class="nav-item">
                      <a class="nav-link" href="<?php echo base_url(); ?>logout">Logout</a>
                  </li>
                  <?php } ?>

              </ul>
          </div>
      </div>
  </nav>
  <section class="privacy">
<div class="container">
  <div class="col-md-12">
    <p style="color:#000;">
                      <b>Acceptance of Terms</b><br>
                      The HeylaApp is one stop platform for all your event needs which is owned and operated by PalPro Technologies Pvt. Ltd., with its registered office at 21, Vaigai North Bank Road, Alwarpuram Thiruvenkatapuram, Madurai TN 625002.
                      Through our platform, mobile apps and website; Heyla shall enable users to view and share the events and book tickets for events in and around Chennai, Coimbatore, Madurai and Pondicherry. This User Agreement (Agreement) sets out the terms and conditions on which Heyla shall provide the services to the User through Website and App.
                      The usage of the Website/App is offered to the User conditioned on acceptance without modification of all the terms, conditions and notices contained in this Agreement, as may be posted on the Website/App from time to time. For the removal of doubts, it is clarified that use of the Website/App by the User constitutes an acknowledgement and acceptance by the User of this Agreement.
                      Heyla reserves the right to change the terms & conditions and notices under which the Services are offered through the Website/ App, including but not limited to the charges for the Services provided through the Website/App. The User shall be responsible for regularly reviewing these terms and conditions.
                    <br><br><b>  Privacy Policy</b><br>
                      The User hereby consents, expresses and agrees that he/she has read and fully understands the Privacy Policy of Helya in respect to the website/app. The User further consents that the terms and contents of such Privacy Policy are acceptable to him/her.

                      <br><br><b>Services</b><br>
                      Users are entitled to use the Services including viewing,  and sharing of events. Heyla also lets users book their tickets or register for events through the app. The company reserves the right to modify the nature of their services.
                      If the users are booking their tickets through our platform, they hereby consent, express and agree that they have read and fully understands the Pricing Policy of Helya in respect to the website/app. The User further consents that the terms of such Pricing Policy are acceptable to him/her.

                     <br> <br><b>Restrictions on use</b><br>
                      Your use of the website/app is restricted to viewing information of events, booking tickets, giving suggestions or raising queries or complaints. To protect our website, app and other users, we reserve all the rights to delete any content from the website/app. We also reserve the right to restrict the access of the website/app to certain users.
                      <br><br><b>Changes on Terms & Conditions</b><br>
                      This terms & conditions was last updated on 29.03.2017. From time to time we may change or make additions to our terms & Condition. We will notify you of any material changes to this policy as required by law. We will also post an updated copy on our website and during app updates.
                      Contact Us
                      If there is any query regarding the terms & conditions, you may contact us.
    </p>
  </div>
</div>
</section>

<!-- Footer -->
<footer class="footer-bg ">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="fnt-footer">Crafted With Happiness</p>
            </div>
            <div class="col-md-6">
                <ul class="list-inline fnt-footer ">
                  <li class="list-inline-item"><a href="<?php echo base_url(); ?>privacy">Privacy Policy</a></li>
                  <li class="list-inline-item"><a href="<?php echo base_url(); ?>payment">Payment Policy</a></li>
                  <li class="list-inline-item"><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
                </ul>
            </div>
        </div>

    </div>
    <!-- /.container -->
</footer>

</body>
<script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>

</html>

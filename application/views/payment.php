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
                  <b>Payment Policy</b><br>
                  Heyla accepts Visa, MasterCard, American Express, selected Debit Cards and Net Banking. Other payment methods may be added from time to time. We process our payments through CC-avenues payment gateway. Users are subject to internet handling fees and a non-refundable processing fees per ticket.
                  Heyla acts as an agent to promote the events and sell tickets on behalf of the event organizers. We do not hold any control on the availability and pricing of the tickets.
               <br> <br><b>  Payment Confirmation</b><br>
                  Once your payment is successful, you will be directed to the confirmation page which will contain all the details regarding your order. You will also receive a text message and email regarding your order confirmation. If you do not receive a confirmation or experience an error during payments, contact the customer care regarding your order. We are not liable for your losses if you do not contact us regarding your issue faced during booking.
                  Refund / Cancellation / Exchanges
                  Once the payment is made and the booking is confirmed, you cannot make any changes in the order.  Kindly read the details of the event and eligibility before making the booking. We are not liable to make any refund for tickets purchased.
                  If the event gets cancelled by the organizers of the event, we will refund the amount as per the policy of the organizer. If in case the event date has been changed by the organizer, we will contact you and proceed as per the policy of the organizer.
                  HelyaApp may, in its discretion, attempt to mediate such dispute, however, we will have no liability for an Organizer’s failure to give refunds, our failure to mediate a dispute; or our decision if it does mediate the dispute.
                  <br><br><b>Customer Care</b><br>
                  If there are any queries regarding your order, you can get in touch with us at mention the email address/a toll free number. We assure you a response within one business day.
                  <br><br><b>Changes on Pricing</b><br>
                  This Pricing Policy was last updated on 29.03.2017. From time to time we may change or make additions to our Pricing Policy. We will notify you of any material changes to this policy as required by law. We will also post an updated copy on our website and during app updates.
  </p>
  </div>
</div>
</section>

<!-- Footer -->
<footer class="footer-bg fixed-bottom">
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

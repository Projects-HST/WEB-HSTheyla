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
          <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
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
                 <b>Introduction to the Privacy Policy</b><br>
                 This privacy policy is for the website <a href="http://heylaapp.com/" target="_blank">www.heylaapp.com</a> and its application, and served by Heyla App and governs the privacy of its users who choose to use it.

                 The policy sets out the different areas where user privacy is concerned. It outlines the obligations and requirements of the users, the app, the website and website owners. Furthermore, the way it processes, stores and protects user data and information will also be detailed within this policy.

                 <br><br><b>The Website & App</b><br>
                 This Website and the App take a proactive approach to users’ privacy and ensures the necessary steps are taken to protect the privacy of its  users throughout their visiting experience.

                 <br><br><b>Personal Information</b><br>
                 We collect information directly from you when you register for an event or buy tickets. We also collect information if you post a comment on our app, website or social media pages or ask us a question through phone or email. We also collect information about you through third parties. If you use, Facebook to login then we obtain information about you through the third party sites.

                 Whenever you use our app /website, we will detect your location to customize the events based on your location. This information will remain discrete with us. Your location information will be collected only if you enable your location services. We may collect demographic information about you, events you like, events you intend to participate in, tickets you buy, or any other information provided by you during the use of our app/website. For the users who register for an event through our app, we will collect basic attendees details required for registration / booking and this will be shared with the organizers of the event.  For users who book  tickets through us, we will process your payments through CC-avenues payment gateway. Please visit <a href="https://www.ccavenue.com/privacy.jsp" target="_blank">https://www.ccavenue.com/privacy.jsp</a>  to know about their privacy policy. We will not ask for any banking details on our website / app.

                 <br><br><b>Email Newsletter</b><br>
                 This website/app operates an email newsletter program that is used to inform subscribers about new events added on  this website/app. Users can subscribe through an online automated process if they wish to do so but at their own discretion. Email marketing campaigns published by this website/app or its owners may contain tracking facilities within the actual email. Subscriber activity is tracked and stored in a database for future analysis and evaluation. Such tracked activity may include; the opening and forwarding of emails, the clicking of links within the email content, time, dates and frequency of activity. This information is used to refine future email campaigns and supply the users with more relevant content based around their activity.

                 <br><br><b>Use of Cookies</b><br>
                 This website uses cookies to better the user experience while visiting the website. Wherever applicable, this website uses a cookie control system, enabling the users on their visit to the website, to allow or disallow the use of cookies on their computer/device. This complies with recent legislation requirements for websites to obtain explicit consent from users before leaving behind or reading files such as cookies on a user’s computer/device.

                 Cookies are small files saved to the user computer’s hard drive, or devices that track, save and store information about the user interactions and usage of the website. This allows the website, through its server to provide the users with a tailored experience within this website. Users are advised that if they wish to deny the use and saving of cookies from this website onto their computer's hard drive, they should take the necessary steps within their web browser's security settings to block all cookies from this website and its external serving vendors.

                 Other cookies may be stored on your computer’s hard drive by external vendors when this website uses referral programs, sponsored links or adverts. Such cookies are used for the conversion and referral tracking. No personal information is stored, saved or collected.

                 <br><br><b>External Links</b></br>
                 Although this website/App only looks to include quality, safe and relevant external links, users should always adopt a policy of caution before clicking on any external web links mentioned anywhere in this website/App.
                 The owners of this website/App cannot guarantee or verify the contents of any externally linked website despite their best efforts. Users should therefore note that, they click on external links at their own risk and this website/App and its owners cannot be held liable for any damages or implications caused by visiting any external links mentioned.

                <br> <br><b>Social Media Platforms</b><br>
                 Any communication, engagement or action taken by the website or the App through an external social media platform are in custom to the terms and conditions, and privacy policies held with each social media platform.

                 Users are advised to use social media platforms wisely and communicate or engage upon them with due care and caution in regard to their own privacy and personal details. The Website or the App will never ask for personal or sensitive information through any social media platform. It encourages the users who wish to discuss sensitive details, to contact them though primary communication channels, such as, by telephone or email.

                 This Website or the App may use social sharing buttons, which help to share web content directly from web pages to the respective social media platform. Users are advised before using the social sharing buttons that, they do it at their own discretion, and also note that the social media platform may track and save your request to share a web page respectively through your social media platform account.

                <br> <br><b>Shortened Links in Social Media</b><br>
                 The website and the App may share links to relevant pages on their social media accounts. Some social media platforms, by default, shorten the length of the URL’s. Users are advised to take caution before clicking on the shortened URLs published on social media platforms by this website or the App. The owners put all efforts to ensure only genuine URL’s are published, but many social media platforms are prone to spam as well as hacking. Thus, the website, the App or it's owners cannot be held liable for any damage or implication caused by visiting any shortened URL’s.

                 <br><br><b>Updates to this policy</b></br>
                 This Privacy Policy was last updated on 29.03.2017. From time to time we may change or make additions to our privacy policy. We will notify you of any material changes to this policy as required by law. We will also post an updated copy on our website and during App updates.
                 </p>
  </div>
</div>
</section>

<!-- Footer -->
<footer class="footer-bg ">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                 <p class="fnt-footer"><a href="http://happysanz.com/" target="_blank">Crafted With Happiness</a></p>
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

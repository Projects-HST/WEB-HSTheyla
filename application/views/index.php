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
    <link href="<?php echo base_url(); ?>assets/css/button.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark  fixed-top" data-spy="affix" data-offset-top="(scroll value)" >
        <div class="container">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="#">Home
                <span class="sr-only"></span>
              </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#create">Create Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
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

    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs modalmenu" role="tablist">
                        <li role="presentation" class="active tabmenu"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab" class="" id="loginbtn">Login</a>

                        </li>
                        <li role="presentation" class="loginbtn"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab" >Sign Up</a>

                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="uploadTab">
                          <div class="card">

                      <div class="">
                          <form class="form" role="form" autocomplete="off" id="formLogin" action="<?php echo base_url(); ?>adminlogin/home" method="post">
                              <div class="form-group">
                                  <input type="text" class="form-control" name="username" id="username" placeholder="UserName or Mobile Number or Email" required="">
                              </div>
                              <div class="form-group">
                                  <input type="password" class="form-control" id="pwd" name="pwd" required="" placeholder="Password"
                           autocomplete="new-password">
                              </div>
                          <center>  <button type="submit" class="btn btn-event btn-lg">Login</button></center>
                          </form>
                      </div>

                      <div class="socialmedia">
                        <span  class="">Or Sign Up With Social Media</span>
                      </div>
                      <center>
                        <div class="social-login">
                      <?php
                     $this->load->library('googleplus');
                     $CLIENT_ID = '56118066242-ndqa7sis300o0ce5otglegn629ktmjj5.apps.googleusercontent.com';
                     $CLIENT_SECRET = 'QBjwPGP5PE6tzJt3bDekC4a1';
                     $APPLICATION_NAME = "Heyla";
                     $client = new Google_Client();
                     $client->setApplicationName($APPLICATION_NAME);
                     $client->setClientId($CLIENT_ID);
                     $client->setClientSecret($CLIENT_SECRET);
                     $client->setAccessType("offline");
                     $client->setRedirectUri('http://localhost/heyla/adminlogin/glogin/');
                     $client->setScopes('email');
                     $objOAuthService = new Google_Service_Plus($client);

                     $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
                     $authUrl=$client->createAuthUrl();
                     echo '<a class="loginBtn loginBtn--google" href="'.$authUrl.'">Login with Google</a>';
                     ?>
                     <a  href="<?php echo base_url(); ?>facebook_login" class="loginBtn loginBtn--facebook">
                       Login with Facebook
                     </a>
                   </div>
                 </center>
                      <!--/card-block-->
                  </div>
                  <!-- /form card login -->
                        </div>
                        <div role="tabpanel" class="tab-pane" id="browseTab">
                          <div class="card">

                      <div class="">
                          <form class="form" role="form" autocomplete="off" id="formLogin">
                              <div class="form-group">
                                  <input type="text" class="form-control" name="uname1" id="uname1" placeholder="Name" >
                              </div>
                              <div class="form-group">
                                  <input type="password" class="form-control" id="pwd1" required="" placeholder="Email">
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control" name="uname1" id="uname1" placeholder="Mobile Number" >
                              </div>
                              <div class="form-group">
                                  <input type="password" class="form-control" id="pwd1" required="" placeholder="Password">
                              </div>
                            <button type="button" class="btn btn-event btn-lg">Sign Up</button>
                          </form>
                      </div>
                      <!--/card-block-->
                  </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner carousel-fade" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url('<?php echo base_url(); ?>assets/front/images/slider1.jpg')">
                    <div class="carousel-caption d-none d-md-block">
                      <img src="<?php echo base_url(); ?>assets/front/images/play.png" class=""> <img src="<?php echo base_url(); ?>assets/front/images/app.png" class="">


                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('<?php echo base_url(); ?>assets/front/images/slider2.jpg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Second Slide</h3>
                        <p>This is a description for the second slide.</p>
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('<?php echo base_url(); ?>assets/front/images/slider3.jpg')">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Third Slide</h3>
                        <p>This is a description for the third slide.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>

    <!-- Page Content -->
    <section class="about" style="" id="about">
        <div class="container">
          <div >
            <p class="heading2">WHAT'S HEYLA</p>
            <p class="whatsheyla">Wanna do something exciting? Wanna do something alone? Or wanna take someone out? Or are you one amongst those who is the planner of the group? Or are you the bored set to find out what's happening in your city? We all think that, don't we??<p>
              <p class="whatsheyla">
With Heyla App, create, share, find and attend events that enrich lives and make your wishes come true. So what are you waiting for? Hit the download icon and let Heyla App be your go-to for events!

            </p>
          </div>
        </div>
    </section>




    <div class="arrowimg"><img src="<?php echo base_url(); ?>assets/front/images/arrow.png" class="img-fluid mx-auto d-block"></div>
    <section class="features" id="services">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <p class="text-center getin">Take a look awesome app </p>
                    <p class="text-center featuretext">Features You Ill Love it </p>
                </div>
            </div>

        </div>

        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <img src="<?php echo base_url(); ?>assets/front/images/iphone1.png" class="img-fluid">
                </div>
                <div class="col-9 listfeauture">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/refer.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Media heading</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                            </div>

                        </div>
                        <div class="col-sm-6 col-md-6  featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/Popular.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Media heading</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/preminum.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Media heading</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                            </div>
                        </div>
                        <div class="col-6 featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/Rewards.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Media heading</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6   featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/hotspot.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Media heading</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                            </div>
                        </div>
                        <div class="col-6 featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/favourite.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Media heading</h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <section class="organsier" style="" id="create">
        <div class="container">
          <div class="heading">
            Promote & Sell Tickets
          </div>
            <p class="normal-txt white-color">The background images for the slider are set directly in the HTML using inline CSS. The rest of the styles for this template are contained within the
            </p>
            <p class="text-center">
              <a href="" class="btn btn-event">CREATE EVENT</a>
            </p>
        </div>
    </section>
    <section class="organiserevent" style="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 center-block">
                    <div class="organiserbox text-center">
                        <img src="<?php echo base_url(); ?>assets/front/images/add.png" class="featureicons img-fluid mx-auto d-block">
                        <p class="organiser-heading">CREATE</p>
                        <p class="normal-txt">It's simple! Enter events, setup ticketing option and Go live.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="organiserbox text-center">
                        <img src="<?php echo base_url(); ?>assets/front/images/view.png" class="featureicons img-fluid mx-auto d-block">
                        <p class="organiser-heading">PROMOTE</p>
                        <p class="normal-txt">Our promotional reach is widespread; Be it local, social or even mobile. </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="organiserbox-last text-center">
                        <img src="<?php echo base_url(); ?>assets/front/images/ticket.png" class=" featureicons img-fluid mx-auto d-block">
                        <p class="organiser-heading">HOST</p>
                        <p class="normal-txt">Right from guest lists to scanning of tickets; we assure you a great event without a glitch.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="formbg" id="contact">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <p class="text-center getin">GET IN TOUCH </p>
                    <p class="text-center  cnt"><span class="blueline">Contact Us</span> </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="Enter the Name">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="Enter the Email">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" placeholder="Enter the Subject">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" placeholder="Write Message"></textarea>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <input type="submit" class="form-control submitbtn" value="SUBMIT FORM">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <p>Contact Information</p>
                </div>
            </div>
        </div>
    </section>


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
$('ul li a').click(function(){
  $('li a').removeClass("menuactive");
  $(this).addClass("menuactive");
});

$(document).ready(function(){
    $(window).scroll(function(){
        if($(window).scrollTop() > $(window).height()){
            $(".navbar").css({"background-color":"#478ECC"});
        }
        else{
            $(".navbar").css({"background-color":"transparent"});
        }

    })
})
</script>

</html>

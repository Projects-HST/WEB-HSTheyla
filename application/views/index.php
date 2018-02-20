<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#478ECC" />
    <title>HEYLA</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/button.css" rel="stylesheet" type="text/css">
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
<style>
.carousel-fade .carousel-item {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  opacity: 0;
  transition: opacity 100ms ease;
}
.carousel-fade .carousel-item.active {
  opacity: 1;
}

</style>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark  fixed-top " data-spy="affix" data-offset-top="(scroll value)">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto topmenu">
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
                     <?php
                        $user_role=$this->session->userdata('user_role');
                     if($user_role=='2'){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo  base_url(); ?>dashboard">Create Event</a>
                    </li>
                    <?php }else{ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#create">Create Event</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                    <?php
                    	// $user_role=$this->session->userdata('user_role');
                       if(empty($user_role)){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Sign In / Sign Up</a>
                        </li>
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

    <!-- Button trigger modal -->
    <div class="container">
           <?php
               if($this->session->flashdata('msg') !=   ''){
               ?>

                   <script>
                   $(document).ready(function(){
                       $("#wrongpassword").modal();
                   });
                   </script>

               <?php
               }
           ?>
   </div>

   <div class="modal fade" id="wrongpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-body">
                 <center>


                   <p class="modal-msg">
                     <?php echo $this->session->flashdata('msg'); ?>

                 </p>
                 </center>
               </div>

           </div>
       </div>
   </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs modalmenu" role="tablist">
                            <li role="presentation" class="tabmenu"><a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab" class="" id="loginbtn">Sign In</a>

                            </li>
                            <li role="presentation" class="loginbtn"><a href="#browseTab" aria-controls="browseTab" role="tab" data-toggle="tab">Sign Up</a>

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
                                                <input type="password" class="form-control" id="pwd" name="pwd" required="" placeholder="Password" autocomplete="new-password">
                                            </div>
                                            <center>
                                                <button type="submit" class="btn btn-event btn-lg">Login</button>
                                            </center>
                                        </form>
                                        <p class="float-right"><a href="<?php echo base_url(); ?>reset">Forgot Password</a></p>
                                    </div>

                                    <div class="socialmedia">
                                        <span class="">Or Sign Up With Social Media</span>
                                    </div>
                                    <center>
                                        <div class="social-login">

                     <a href="<?php echo base_url(); ?>google_login" class="btn btn-lg  btn-google"><i class="fa fa-google-plus"></i> Login With Google + </a>
                                                <a href="#" class="btn btn-facebook btn-lg">
                      <i class="fa fa-facebook"></i> Login with Facebook
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
                                        <form class="form" role="form" autocomplete="off" id="formsignup" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Username" onchange="check_username()">
                                                <p id="usermsg"></p>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="email" name="email" required="" placeholder="Email" onchange="check_email()">
                                                <p id="emailmsg"></p>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" onchange="check_mobile()">
                                                <p id="mobilemsg"></p>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" id="new_password" name="new_password" required="" placeholder="Password">
                                            </div>
                                            <button type="submit" id="submit" class="btn btn-event btn-lg">Sign Up</button>
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


        <div class="slider">
            <div class="carousel carousel-fade" data-ride="carousel" data-interval="2500">
            <!-- <div class="carousel-inner carousel-fade" role="listbox"> -->
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url('<?php echo base_url(); ?>assets/front/images/slider1.jpg')">
                    <h1 class="caption-head"> Events on your Fingertips</h1>
                    <div class="carousel-caption  d-md-block">

                        <img src="<?php echo base_url(); ?>assets/front/images/play.png" class=""> <img src="<?php echo base_url(); ?>assets/front/images/app.png" class="">

                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('<?php echo base_url(); ?>assets/front/images/slider2.jpg')">
                      <h1 class="caption-head">Extreme Event Search is now Heyla</h1>
                    <div class="carousel-caption  d-md-block">
                      <img src="<?php echo base_url(); ?>assets/front/images/play.png" class=""> <img src="<?php echo base_url(); ?>assets/front/images/app.png" class="">

                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('<?php echo base_url(); ?>assets/front/images/slider3.jpg')">
                      <h1 class="caption-head">Encyclopedia of Events</h1>
                    <div class="carousel-caption  d-md-block">
                      <img src="<?php echo base_url(); ?>assets/front/images/play.png" class=""> <img src="<?php echo base_url(); ?>assets/front/images/app.png" class="">

                    </div>
                </div>
            </div>


        </div>


    <!-- Page Content -->
    <section class="about" style="" id="about">
        <div class="container">
            <div>
                <p class="heading2">WHAT'S HEYLA</p>
                <p class="whatsheyla">Heyla is your Gateway to the World Outside in your Pocket – Explore, Discover, Share and Enjoy. It is the encyclopaedia of “What, When and Where” of the World of Entertainment, Shopping, Sports, Dining, Travelling and more
                    <p>
                        <p class="whatsheyla">
                          The Power of Heyla is just clicks away – Download the app now and embark on a journey to discover the undiscovered World of total Entertainment. Heyla is an everything-for-everybody App – Start Exploring Straightaway.

                        </p>
            </div>
        </div>
    </section>

    <div class="arrowimg"><img src="<?php echo base_url(); ?>assets/front/images/arrow.png" class="img-fluid mx-auto d-block"></div>
    <section class="features" id="services">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <!-- <p class="text-center getin">Take a look awesome app </p> -->
                    <p class="text-center" style="font-size:35px;">Features You Will Love it </p>
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
                                <!-- <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/refer.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Refer & Earn</h5> Refer, refer and refer - Redemption for paid events is always exciting </div> -->
                                    <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/Popular.png" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="mt-0">Popular</h5>The trending events happening in your city . </div>
                            </div>

                        </div>
                        <div class="col-sm-6 col-md-6  featurebox">
                            <div class="media mediaobj">
                              <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/favourite.png" alt="Generic placeholder image">
                              <div class="media-body">
                                  <h5 class="mt-0">Favourite</h5> Tailor fit events for you.<br></div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/preminum.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Hotspot</h5> You can't leave the city without checking in here  </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/Rewards.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Leaderboard</h5> Let's add to the overall fun by competing with other Heyla App Users. </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6   featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/hotspot.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Premium</h5> Become our Premium member and have access to the hidden treasures.</div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 featurebox">
                            <div class="media mediaobj">
                              <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/Rewards1.png" alt="Generic placeholder image">
                              <div class="media-body">
                                  <h5 class="mt-0">Rewards</h5>Book, Check-in, share and review to win rewards.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <section class="mobileslider">
        <div class="container">
            <div class="row">

                <div id="wrap">
                    <div id="showcase" class="noselect">
                        <img class="cloud9-item img-fluid" src="<?php echo base_url(); ?>assets/front/images/1.jpg" alt="Heyla">
                        <img class="cloud9-item img-fluid" src="<?php echo base_url(); ?>assets/front/images/2.jpg" alt="Heyla">
                        <img class="cloud9-item img-fluid" src="<?php echo base_url(); ?>assets/front/images/3.jpg" alt="Heyla">
                        <img class="cloud9-item img-fluid" src="<?php echo base_url(); ?>assets/front/images/4.jpg" alt="Heyla">
                        <img class="cloud9-item img-fluid" src="<?php echo base_url(); ?>assets/front/images/5.jpg" alt="Heyla">
                        <img class="cloud9-item img-fluid" src="<?php echo base_url(); ?>assets/front/images/6.jpg" alt="Heyla">

                    </div>
                    <p id="item-title">&nbsp;</p>
                    <div class="nav1" class="noselect">
                        <span class="left"><i class="fa fa-chevron-left" aria-hidden="true"></i>
</span>
                        <span class="right"><i class="fa fa-chevron-right" aria-hidden="true"></i>
 </span>
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
            <p class="normal-txt white-color">Promote and sell your ticket with our ticketing service, we’ll ensure you gain momentum the whole way through; right from tickets Avaliable to Sold Out!.
            </p>
            <p class="text-center">
              <?php
              $user_role=$this->session->userdata('user_role');
              if($user_role=="2"){ ?>
                  <a href="<?php echo base_url(); ?>organizer/createevents" class="btn btn-event">CREATE EVENT</a>
            <?php   }else{  ?>
                <a  data-toggle="modal" data-target="#myModal" class="btn btn-event white">CREATE EVENT</a>
              <?php }    ?>

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
                        <p class="normal-txt">It's simple! Enter events, setup ticketing option,<br> and Go live.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="organiserbox text-center">
                        <img src="<?php echo base_url(); ?>assets/front/images/view.png" class="featureicons img-fluid mx-auto d-block">
                        <p class="organiser-heading">PROMOTE</p>
                        <p class="normal-txt">Our promotional reach is widespread; <br> Be it local, social or even mobile. </p>
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
                    <form action="" method="post" id="contact_form">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="name" placeholder="Enter the Name" required>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="email" placeholder="Enter the Email" required>
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" name="subject" placeholder="Enter the Subject" required>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="message" placeholder="Write Message" required></textarea>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <input type="submit" class="form-control submitbtn btn-primary" value="SUBMIT FORM">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <p class="getin">Contact Information</p>
                    <p>No: 6, Kummalamman Koil Street,<br>
                    3rd Lane Tondiarpet, <br>Chennai - 600081</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-bg">
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
<script src="<?php echo base_url(); ?>assets/front/js/jquery.reflection.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.cloud9carousel.js"></script>
<script>
    $(function() {
        var showcase = $("#showcase")

        showcase.Cloud9Carousel({
            yPos: 42,
            yRadius: 48,
            mirrorOptions: {
                gap: 12,
                height: 0.2
            },
            buttonLeft: $(".nav1 > .left"),
            buttonRight: $(".nav1 > .right"),
            autoPlay: true,
            bringToFront: true,
            onRendered: showcaseUpdated,
            onLoaded: function() {
                showcase.css('visibility', 'visible')
                showcase.css('display', 'none')
                showcase.fadeIn(1500)
            }
        })

        function showcaseUpdated(showcase) {
            var title = $('#item-title').html(
                $(showcase.nearestItem()).attr('alt')
            )

            var c = Math.cos((showcase.floatIndex() % 1) * 2 * Math.PI)
            title.css('opacity', 0.5 + (0.5 * c))
        }

        // Simulate physical button click effect
        $('.nav1 > button').click(function(e) {
            var b = $(e.target).addClass('down')
            setTimeout(function() {
                b.removeClass('down')
            }, 80)
        })

        $(document).keydown(function(e) {
            //
            // More codes: http://www.javascripter.net/faq/keycodes.htm
            //
            switch (e.keyCode) {
                /* left arrow */
                case 37:
                    $('.nav1 > .left').click()
                    break

                    /* right arrow */
                case 39:
                    $('.nav1 > .right').click()
            }
        })
    })
</script>

<script type="text/javascript">
    $('.topmenu .nav-item a').click(function() {
        $('.topmenu .nav-item a').removeClass("menuactive");
        $(this).addClass("menuactive");
    });
    $('.modalmenu .tabmenu a').click(function() {
        $(' .modalmenu .tabmenu a').removeClass("tabmenu");
        $(this).addClass("tabmenu");
    });

    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(window).scrollTop() > $(window).height()) {
                $(".navbar").css({
                    "background-color": "#478ECC"
                });
            } else {
                $(".navbar").css({
                    "background-color": "transparent"
                });
            }

        })
    });

    $('#formsignup').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,minlength: 6, maxlength: 12
            },
            email: {
                required: true
            },
            mobile: {
                required: true,minlength: 10, maxlength: 10, digits: true
            },
            new_password: {
                required: true,minlength: 6, maxlength: 12
            },
        },
        messages: {
            name: { required:"Enter the Username", minlength: "Min is 6", maxlength: "Max is 12" },
            email: "Enter Valid Email ",
              mobile: { required:"Enter the Mobile number", minlength: "Min is 6", maxlength: "Max is 10" },

            new_password: { required:"Enter the Password", minlength: "Min is 6", maxlength: "Max is 12" }
        },
        submitHandler: function(form) {
            //alert("hi");

            $.ajax({
                url: "<?php echo base_url(); ?>home/create_profile",
                type: 'POST',
                data: $('#formsignup').serialize(),
                success: function(response) {

                    if (response == "verify") {
                        swal({
                            title: "Success",
                            text: "You have Registered Successfully.",
                            type: "success"
                        }).then(function() {
                            location.href = '<?php echo base_url(); ?>verify';
                        });
                    } else {
                        sweetAlert("Oops...", response, "error");
                    }
                }
            });
        }
    });

    $('#contact_form').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,maxlength:20
            },
            email: {
                required: true,email:true
            },
            subject: {
                required: true,maxlength:70
            },
            message: {
                required: true
            },
        },
        messages: {
            name: { required:"Enter the name" },
            email: "Enter Valid Email ",
            subject: { required:"Enter the Subject" ,maxlength:"Enter Below 70 Characters"},
            message: { required:"Enter the Message"}
        },
        submitHandler: function(form) {
            //alert("hi");

            $.ajax({
                url: "<?php echo base_url(); ?>home/mail",
                type: 'POST',
                data: $('#contact_form').serialize(),
                success: function(response) {

                    if (response == "success") {
                        swal({
                            title: "Thank You For Contacting Us",
                            text: " We Get Back To You Soon.",
                            type: "success"
                        }).then(function() {
                           location.reload();
                        });
                    } else {
                        sweetAlert("Oops...", response, "error");
                    }
                }
            });
        }
    });


    function check_email() {
        var email = $('#email').val();
        $.ajax({
            method: "post",
            data: {
                email: email
            },
            url: 'home/existemail',
            success: function(data) {

                if ((data) == "success") {
                    $("#submit").removeAttr("disabled");
                      $('#emailmsg').html(' ');
                } else {
                    $('#submit').prop('disabled', true);
                    $('#emailmsg').html('Email  Already Exist');
                }
            }
        });
    }

    function check_username() {
        var name = $('#name').val();
        // alert(name);
        $.ajax({
            method: "post",
            data: {
                name: name
            },
            url: 'home/existusername',
            success: function(data) {

                if ((data) == "success") {
                    $("#submit").removeAttr("disabled");
                    $('#usermsg').html('Username Available');
                } else {
                    $('#submit').prop('disabled', true);
                    $('#usermsg').html('Username Already Exist');
                }
            }
        });
    }

    function check_mobile() {
        var mobile = $('#mobile').val();

        $.ajax({
            method: "post",
            data: {
                mobile: mobile
            },
            url: 'home/existmobile',
            success: function(data) {
                console.log(data);
                if ((data) == "success") {
                    $("#submit").removeAttr("disabled");
                        $('#mobilemsg').html(' ');
                    // $('#mobilemsg').html('Username Available');
                } else {
                    $('#submit').prop('disabled', true);
                    $('#mobilemsg').html('Mobile number Already Exist');
                }
            }
        });
    }

</script>
</html>

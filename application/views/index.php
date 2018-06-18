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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900" rel="stylesheet">
      <!-- <link href="<?php echo base_url(); ?>assets/front/css/multislider.css" rel="stylesheet"> -->
    <!-- <link href="<?php echo base_url(); ?>assets/front/css/main.css" rel="stylesheet"> -->
    <link href="<?php echo base_url(); ?>assets/css/button.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <!-- <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet"> -->
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

/* .carousel-fade .carousel-item {
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
} */
.carousel-inner .carousel-item.active,
.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
  display: flex;
}

.carousel-inner .carousel-item-right.active,
.carousel-inner .carousel-item-next {
  transform: translateX(33%);
}

.carousel-inner .carousel-item-left.active,
.carousel-inner .carousel-item-prev {
  transform: translateX(-33%);
}

.carousel-inner .carousel-item-right,
.carousel-inner .carousel-item-left{
  transform: translateX(0);

}
.slider-img{
  padding-left: 0px;
  padding-right: 0px;
  height: 450px;
}

</style>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark  fixed-top " data-spy="affix" data-offset-top="(scroll value)" style="background-color:#478ECC;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto topmenu">
                    <li class="nav-item ">
                        <a class="nav-link" href="#">Home<span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo  base_url(); ?>eventlist/">List Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#create">Become Organiser</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#contact">Contact</a>
                    </li>
                   <?php
                   	$user_role = $this->session->userdata('user_role');
                       if(empty($user_role)){ ?>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>signin" >Sign In </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>signup" >Sign Up</a>
                          </li>
                    <?php
                       }else{ ?>
                         <?php  if($user_role=='3' || $user_role=='2'){ ?>
                           <li class="nav-item">
                               <a class="nav-link" href="<?php echo base_url(); ?>profile">Profile</a>
                           </li>
                     <?php  } ?>
                            <li class="nav-item">
                                <a class="nav-link logout-btn" onclick="logout()">Logout</a>
                            </li>
                     <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Button trigger modal -->
    <div class="container">
           <?php if($this->session->flashdata('msg') !=   ''){ ?>
		   <script>
			   $(document).ready(function(){
				   $("#wrongpassword").modal();
			   });
           </script>
           <?php } ?>
   </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div role="tabpanel">
                      <div role="tabpanel" class="tab-pane" id="browseTab">
                          <div class="card">

                              <div class="">
                                  <form class="form" role="form" autocomplete="off" id="formsignup" method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                          <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                          <p id="usermsg"></p>
                                      </div>
                                      <div class="form-group">
                                          <input type="email" class="form-control" id="email" name="email" required placeholder="Email or Phone number">

                                      </div>
                                      <div class="form-group">
                                        <textarea type="text" name="message" rows="3" cols="50" class="form-control" placeholder="Message" style=" max-width: 100%;"></textarea>

                                      </div>

                                      <button type="submit" id="submit" class="btn btn-event btn-lg">Become an organiser</button>
                                  </form>
                              </div>

                          </div>
                      </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


        <!-- <div class="slider">
            <div class="carousel carousel-fade" data-ride="carousel" data-interval="2500">

                <div class="carousel-item active" style="background-image: url('<?php echo base_url(); ?>assets/front/images/slider1.jpg')">
                    <h1 class="caption-head"> Events on your Fingertips</h1>
                    <div class="carousel-caption  d-md-block">

                        <img src="<?php echo base_url(); ?>assets/front/images/play.png" class=""> <img src="<?php echo base_url(); ?>assets/front/images/app.png" class="">

                    </div>
                </div>
                <div class="carousel-item" style="background-image: url('<?php echo base_url(); ?>assets/front/images/slider2.jpg')">
                      <h1 class="caption-head">Extreme Event Search is now Heyla</h1>
                    <div class="carousel-caption  d-md-block">
                      <img src="<?php echo base_url(); ?>assets/front/images/play.png" class=""> <img src="<?php echo base_url(); ?>assets/front/images/app.png" class="">

                    </div>
                </div>
                <div class="carousel-item" style="background-image: url('<?php echo base_url(); ?>assets/front/images/slider3.jpg')">
                      <h1 class="caption-head">Encyclopedia of Events</h1>
                    <div class="carousel-caption  d-md-block">
                      <img src="<?php echo base_url(); ?>assets/front/images/play.png" class=""> <img src="<?php echo base_url(); ?>assets/front/images/app.png" class="">

                    </div>
                </div>
            </div>
        </div> -->



  <div class="container-fluid ad_slider">

    <div class="row">
        <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel" style="margin-top:60px;">
            <div class="carousel-inner w-100" role="listbox">

<?php if (count($adv_event_result)>0){

			 $i = 0;
			foreach($adv_event_result as $res){
				$event_id = $res->id * 564738;
				$event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
				$enc_event_id = base64_encode($event_id);
?>

				<div class="carousel-item <?php if ($i=='0') echo "active"; ?>">
                <!--<a href="<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/">--><img class="d-block col-6 img-fluid slider-img" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" alt="<?php echo $event_name; ?>"><!--</a><-->
                </div>

                 <?php $i = $i+1; } ?>

 <?php } ?>


            </div>
            <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

</div>

<?php if (count($popular_events)>0){ ?>
<div class="container-fluid popular_event_section popular_events">
  <div class="">
  <div class="heading">
  <p class="text-center popular "><b class="blueline">Popular Events</b> </p>
  </div>
  <div class="row ">
<?php
//print_r($popular_events);
			foreach($popular_events as $pres){
				$event_id = $pres->id * 564738;
				//$disp_event_name = $pres->event_name;
				$event_name = strtolower(preg_replace("/[^\w]/", "-", $pres->event_name));
				$enc_event_id = base64_encode($event_id);

 ?>
    <div class="col-xs-18 col-sm-4 col-md-3 event_box">
     <div class="thumbnail event_section" style="height:410px;;">
       <img src="assets/events/banner/<?php echo $pres->event_banner; ?>" alt="<?php echo $event_name; ?>" style="height:204px; width:100%;">
         <div class="event_thumb">
           <a href="<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/"><p class="event_heading event_title_heading"><?php echo $pres->event_name; ?></p></a>
           <p><img src="<?php echo base_url(); ?>assets/front/images/date.png"><span class="event_thumb"><?php echo date('d-M-y',strtotime($pres->start_date));?> - <?php echo date('d-M-y',strtotime($res->end_date));?><span></p>
           <p><img src="<?php echo base_url(); ?>assets/front/images/time.png"><span class="event_thumb"><?php echo $pres->start_time;?> - <?php echo $pres->end_time;?><span></p>
           <p><img src="<?php echo base_url(); ?>assets/front/images/location.png"><span class="event_thumb"><?php echo $pres->event_venue;?><span></p>

       </div>
       <p class="price_section"><img src="<?php echo base_url(); ?>assets/front/images/paid.png" class="pull-left"><img src="<?php echo base_url(); ?>assets/front/images/fav-select.png" class="pull-right"></p>
     </div>
   </div>
 <?php } ?>

  </div>
  <center><a href="" class="btn" style="    background-color: #478ecc;margin-top: 15px;   color: #fff;">View More Events</a></center>
</div>
</div>

<?php } ?>





    <!-- Page Content -->
    <section class="about" style="" id="about">
        <div class="container">
            <div>
                <p class="heading2">WHAT'S HEYLA</p>

            </div>
        </div>
    </section>
      <div class="arrowimg"><img src="<?php echo base_url(); ?>assets/front/images/arrow.png" class="img-fluid mx-auto d-block"></div>
    <section class="" style="" id="">
        <div class="container">
            <div>

                <p class="whatsheyla">Heyla is your Gateway to the World Outside in your Pocket – Explore, Discover, Share and Enjoy. It is the encyclopaedia of “What, When and Where” of the World of Entertainment, Shopping, Sports, Dining, Travelling and more
                    <p>
                        <p class="whatsheyla">
                          The Power of Heyla is just clicks away – Download the app now and embark on a journey to discover the undiscovered World of total Entertainment. Heyla is an everything-for-everybody App – Start Exploring Straightaway.

                        </p>
            </div>
        </div>
    </section>
    <section class="features_section" style="" id="create">
        <div class="container">
            <div class="heading">
            <p class="text-center" style="font-size:35px;">Features You Will Love it </p>
            </div>


        </div>
    </section>


    <section class="features" id="services">
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
                              <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/Rewards.png" alt="Generic placeholder image">
                              <div class="media-body">
                                  <h5 class="mt-0">Rewards</h5>Book, Check-in, share and review to win rewards.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <!-- <section class="mobileslider">
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
    </section> -->

    <section class="organsier" style="" id="create">
        <div class="container">
            <div class="heading">
              Become an Event Organizer
            </div>
            <p class="normal-txt white-color">Heyla is a powerhouse of opportunities for event organizers. You can expect the widest visiblity that will translate into big ticket sales. That is not all either - Heyla is punch packed to help your business to build a formidable brand image and a lasting reputation. Start now to experience the power of Heyla.
            </p>
            <br>
            <p class="text-center">
              <?php
              $user_role=$this->session->userdata('user_role');
              if($user_role=="2"){ ?>
                  <a href="<?php echo base_url(); ?>organizer/createevents" class="btn btn-event">CREATE EVENT</a>
            <?php   }else{
              $user_id=$this->session->userdata('id');
              if(empty($user_id)){ ?>
                  <a href="<?php echo base_url(); ?>signin" class="btn btn-event">Login here</a>
              <?php }else{ ?>
                <a  data-toggle="modal" data-target="#myModal" class="btn btn-event white">Request Now</a>
            <?php  }   ?>


              <?php }    ?>

            </p>
        </div>
    </section>


    <section class="formbg" id="contact">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                  <div class="heading">
                  <p class="text-center popular"><b>Get in Touch</b> </p>
                  </div>
                    <p class="text-center  cnt"><span class="blueline">Contact Us</span> </p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="post" id="contact_form">
                        <div class="">
                            <div class="row">
                              <div class="col-1">
                                 <img src="<?php echo base_url(); ?>assets/front/images/name.png" class="img-responsive contact_icon">
                              </div>
                              <div class="col-11">
                                <input type="text" class="form-control text_box" name="name" placeholder="Enter the Name" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-1">
                                 <img src="<?php echo base_url(); ?>assets/front/images/email_icon.png" class="img-responsive contact_icon">
                              </div>
                              <div class="col-11">
                                <input type="text" class="form-control text_box" name="email" placeholder="Enter the Email" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-1">
                                 <img src="<?php echo base_url(); ?>assets/front/images/subject.png" class="img-responsive contact_icon">
                              </div>
                              <div class="col-11">
                                <input type="text" class="form-control text_box" name="subject" placeholder="Enter the Subject" required>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-1">
                                 <img src="<?php echo base_url(); ?>assets/front/images/message.png" class="img-responsive contact_icon">
                              </div>
                              <div class="col-11">
                                <textarea class="form-control textarea-form text_box" name="message"  rows="6"  placeholder="Write Message" required></textarea>
                              </div>
                            </div>
                            <div class="col-md-3 col-sm-6 pull-right">
                                <input type="submit" class="form-control submitbtn btn-primary" value="SUBMIT ">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <p class="getin">Contact Information</p>
                    <p class="address_form">No: 6, Kummalamman Koil Street,<br>
                    3rd Lane Tondiarpet, <br>Chennai - 600081</p>
                    <p>
                      <a href=""><img src="<?php echo base_url(); ?>assets/front/images/facebook.png"></a>
                      <a href=""><img src="<?php echo base_url(); ?>assets/front/images/twitter.png"></a>
                    </p>
                    <p class="getin">Get Our App</p>
                    <p>
                      <a href=""><img src="<?php echo base_url(); ?>assets/front/images/play.png" class="img-responsive app_img"></a>
                      <a href=""><img src="<?php echo base_url(); ?>assets/front/images/app.png" class="img-responsive app_img"></a>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- <footer class="footer-bg">
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
    </footer> -->

    <footer class="footer-bg footer" id="stickfooter">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                  <p class="footer_heading">Categories</p>
                  <ul class="fnt-footer ">
                    <li class=""><a href="">Events</a></li>
                    <li class=""><a href="">Hotspot</a></li>
                    <li class=""><a href="">Ads Event</a></li>
                  </ul>

                </div>
                <div class="col-md-3">
                  <p class="footer_heading">Quick links</p>
                  <ul class="fnt-footer ">
                      <li class=""><a href="#">Events</a></li>
                      <li class=""><a href="#">Blog</a></li>
                    <li class=""><a href="<?php echo base_url(); ?>privacy">Privacy Policy</a></li>
                    <li class=""><a href="<?php echo base_url(); ?>payment">Payment Policy</a></li>
                    <li class=""><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
                  </ul>

                </div>
                <div class="col-md-3">
                  <p class="footer_heading">Country</p>
                  <ul class="fnt-footer ">
                    <li class=""><a href="">India</a></li>
                    <li class=""><a href="">Singapore</a></li>
                    <li class=""><a href="">Malaysia</a></li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <p class="footer_heading">Follow  Us On</p>
                  <ul class="fnt-footer social_follow">
                    <li class=""><a href=""><img src="<?php echo base_url(); ?>assets/front/images/fb_follow.png"></a></li>
                    <li class=""><a href=""><img src="<?php echo base_url(); ?>assets/front/images/in_follow.png"></a></li>
                    <li class=""><a href=""><img src="<?php echo base_url(); ?>assets/front/images/gp_follow.png"></a></li>
                    <li class=""><a href=""><img src="<?php echo base_url(); ?>assets/front/images/tw_follow.png"></a></li>
                  </ul>
                </div>
            </div>
        </div>
        <!-- /.container -->
        <div class="container">
            <p class=" text-center foot_copyrights">Crafted with <a href="" style="text-decoration:none;"><b style="color:#fff;font-size:20px;">Happiness</b></a></p>
        </div>
    </footer>

</body>
<script src="<?php echo base_url(); ?>assets/front/js/multislider.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/front/js/jquery.reflection.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.cloud9carousel.js"></script> -->
<script>
    // $(function() {
    //     var showcase = $("#showcase")
    //
    //     showcase.Cloud9Carousel({
    //         yPos: 42,
    //         yRadius: 48,
    //         mirrorOptions: {
    //             gap: 12,
    //             height: 0.2
    //         },
    //         buttonLeft: $(".nav1 > .left"),
    //         buttonRight: $(".nav1 > .right"),
    //         autoPlay: true,
    //         bringToFront: true,
    //         onRendered: showcaseUpdated,
    //         onLoaded: function() {
    //             showcase.css('visibility', 'visible')
    //             showcase.css('display', 'none')
    //             showcase.fadeIn(1500)
    //         }
    //     })
    //
    //     function showcaseUpdated(showcase) {
    //         var title = $('#item-title').html(
    //             $(showcase.nearestItem()).attr('alt')
    //         )
    //
    //         var c = Math.cos((showcase.floatIndex() % 1) * 2 * Math.PI)
    //         title.css('opacity', 0.5 + (0.5 * c))
    //     }
    //
    //     // Simulate physical button click effect
    //     $('.nav1 > button').click(function(e) {
    //         var b = $(e.target).addClass('down')
    //         setTimeout(function() {
    //             b.removeClass('down')
    //         }, 80)
    //     })
    //
    //     $(document).keydown(function(e) {
    //         //
    //         // More codes: http://www.javascripter.net/faq/keycodes.htm
    //         //
    //         switch (e.keyCode) {
    //             /* left arrow */
    //             case 37:
    //                 $('.nav1 > .left').click()
    //                 break
    //
    //                 /* right arrow */
    //             case 39:
    //                 $('.nav1 > .right').click()
    //         }
    //     })
    // })
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
                    "background-color": "#478ECC"
                });
            }

        })
    });

    $('#formsignup').validate({ // initialize the plugin
        rules: {
            name: {
                required: true
            },
            email: {
                required: true
            },
            message: {
                required: true
            },

        },
        messages: {
            name: { required:"Enter the Name", minlength: "Min is 6", maxlength: "Max is 12" },
            email: "Enter Valid Email or Phone Number",
              message: { required:"Enter the Message" }


        },
        submitHandler: function(form) {
            //alert("hi");

            $.ajax({
                url: "<?php echo base_url(); ?>home/become_organiser",
                type: 'POST',
                data: $('#formsignup').serialize(),
                success: function(response) {

                    if (response == "success") {
                        swal({
                            title: "Success",
                            text: response,
                            type: "success"
                        }).then(function() {
                            location.href = '<?php echo base_url(); ?>';
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


    function logout(){
      swal({
          title: 'Are you sure?',
          text: "You Want to logout !",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Confirm!'
      }).then(function(){
        window.location.href='<?php echo base_url(); ?>logout';
      }).catch(function(reason){

      });
    }
</script>
</html>

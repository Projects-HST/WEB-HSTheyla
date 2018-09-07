<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="theme-color" content="#478ECC" />
    <title><?php if(isset($meta_title)){echo $meta_title;}else{echo "Heyla";}?> </title>
    <meta name="description" content="<?php if(isset($meta_description)){echo $meta_description;}else{echo "Heyla";}?>"/>
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>assets/front/css/main.css" rel="stylesheet"> -->
    <!-- <link href="<?php echo base_url(); ?>assets/css/button.css" rel="stylesheet" type="text/css"> -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">


    <link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <!-- <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet"> -->
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92904528-2"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
    <!--  Forms Validations Plugin -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
</head>
<style>
.modal-dialog{
  max-width:700px;
}
.ui-autocomplete {
          max-height: 200px;
          overflow-y: auto;
          /* prevent horizontal scrollbar */
          overflow-x: hidden;
          /* add padding to account for vertical scrollbar */
          padding-right: 20px;
      }
.field-icon {
  float: right;
  left:10px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

/* Carousel base class */
.event_thumb p{
  margin-bottom: 10px;
}
.event_date{
  font-size: 16px;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
  z-index: 10;
  bottom: 3rem;
}

/* Declare heights because of positioning of img element */
.carousel-item {
  height: 32rem;

}
.carousel-item > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 32rem;
}



.slider-img{
  padding-left: 0px;
  padding-right: 0px;
  height: 450px;
}
body{background-color: #fff;}
.homeslider{
  margin-left: 50px;
  margin-right: 50px;
}
.slider_form{
  position:relative;
      bottom:50px;
      padding: 30px;


}
.form-label{
  margin-left: 15px;
}
.head_text{
  margin-bottom: 20px;
}
.event_list{
  margin-left: 50px;
  margin-right: 50px;
}
.form_search{
  margin-left: 100px;
  margin-right: 100px;
}
</style>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#fff;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/heyla_logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto topmenu">
                  <li class="nav-item">
                     <a class="nav-link organiser_btn" data-toggle="modal" data-target="#exampleModal">Become A Organiser</a>
                 </li>
                    <?php
                   	$user_role = $this->session->userdata('user_role');
                    $user_id = $this->session->userdata('id');
                       if(empty($user_role)){ ?>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>signin" >Login / Sign Up </a>
                        </li>


                    <?php
                       }else{ ?>

                         <?php  if($user_role=='3'){ ?>

                        <?php  }elseif($user_role=='2'){?>
                          <li class="nav-item">
                              <a class="nav-link organiser_btn" href="<?php echo base_url(); ?>createevent">Create Event</a>
                          </li>
                       <?php }elseif($user_role=='1'){?>
                         <li class="nav-item">
                             <a class="nav-link organiser_btn" href="<?php echo base_url(); ?>adminlogin/dashboard">Dashboard</a>
                         </li>
                      <?php }else{?>

                        <?php } ?>
                              <?php  if($user_role=='3' || $user_role=='2'){ ?>
                                <?php
                                $user_id = $this->session->userdata('id');
                                $select="SELECT * FROM  user_details  WHERE user_id='$user_id'";
                                 $res=$this->db->query($select);
                                 $result=$res->result();
                                 foreach($result as $rows){} ?>


                                <li class="nav-item">
                                  <p class="welcome_name">Hi <?php echo $rows->name; ?> !</p>
                                </li>
                                <li class="dropdown keep-open">
                                  <div id="dLabel" role="button" href="#" class="nav-item" data-toggle="dropdown" data-target="#" >
                                <?php if(empty($rows->user_picture)){ ?>
                                       <img src="<?php echo base_url(); ?>assets/users/profile/noimage.png" class="img-circle profile_img_head img-thumbnail img-responsive">
                                    <?php }else{ ?>
                                      <img src="<?php echo base_url(); ?>assets/users/profile/<?php echo $rows->user_picture; ?>" class="img-circle profile_img_head img-thumbnail img-responsive">
                                    <?php  }
                                    ?>
                                     <span class="caret"></span>
                                  </div>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <li><a class="nav-link" href="<?php echo base_url(); ?>profile">Profile</a></li>
                                        <li><a class="nav-link logout-btn" onclick="logout()">Logout</a></li>

                                    </ul>
                                </li>
                          <?php  } ?>

                     <?php } ?>



                </ul>
            </div>
        </div>
    </nav>
<div class="container-fluid" style="background-color:#fff;">
  <div class="homeslider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="first-slide" src="<?php echo base_url(); ?>assets/front/images/about_usbanner.jpg" alt="First slide">
        </div>
    </div>
  </div>
  </div>
</div>
  <div class="">
    <div class="container-fluid">

        <div class="about_us">
            <center><h3>About Us</h3></center>
            <p class="whatsheyla">Heyla is your Gateway to the World Outside in your Pocket – Explore, Discover, Share and Enjoy. It is the encyclopaedia of “What, When and Where” of the World of Entertainment, Shopping, Sports, Dining, Travelling and more
            <p><p class="whatsheyla" id="services">
                      The Power of Heyla is just clicks away – Download the app now and embark on a journey to discover the undiscovered World of total Entertainment. Heyla is an everything-for-everybody App – Start Exploring Straightaway.

                    </p>
        </div>
    </div>
  </div>
  <section class="features_section" style="" id="services">
      <div class="container">
          <div class="heading">
          <p class="text-center" style="font-size:26px;color:#000;margin-bottom: 0px;">Features You Will Love it </p>
          <img src="<?php echo base_url(); ?>assets/front/images/line.png" class="img-center">
          </div>


      </div>
  </section>
  <section class="features" id="">
      <div class="container">
          <div class="row">

              <div class="col-md-3">
                  <img src="<?php echo base_url(); ?>assets/front/images/iphone1.png" class="img-fluid">
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-8 listfeauture">
                  <div class="row">
                    <div class="col-sm-6 col-md-10  featurebox">
                        <div class="media mediaobj">
                          <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/favourite.png" alt="Generic placeholder image">
                          <div class="media-body">
                              <h5 class="mt-0">Favourite</h5> Tailor fit events for you.<br></div>
                        </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-sm-6 col-md-10 featurebox">
                        <div class="media mediaobj">
                            <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/Popular.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Popular</h5>The trending events happening in your city . </div>
                        </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-sm-6 col-md-10 featurebox">
                        <div class="media mediaobj">
                          <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/hotspot.png" alt="Generic placeholder image">
                          <div class="media-body">
                              <h5 class="mt-0">Hotspot</h5>You can't leave the city without checking in here.</div>
                        </div>
                    </div>

                        </div>
                          <div class="row">
                        <div class="col-sm-6 col-md-10  featurebox">
                            <div class="media mediaobj">
                                <img class="d-flex mr-3 featureicons" src="<?php echo base_url(); ?>assets/front/images/leaderboard.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Leaderboard</h5> Let's add to the overall fun by competing with other Heyla App Users.</div>
                            </div>
                        </div>
                  </div>
              </div>
          </div>

      </div>

  </section>

<footer class="footer-bg footer" id="stickfooter">
  <div class="container-fluid">
      <div class="row footer_container">
          <div class="col">
            <p class="footer_heading">Categories</p>
            <ul class="fnt-footer ">
              <li class=""><a href="">Events</a></li>
              <li class=""><a href="">Hotspot</a></li>
              <li class=""><a href="">Ads Event</a></li>
            </ul>
          </div>
          <div class="col">
            <p class="footer_heading">Country</p>
            <ul class="fnt-footer ">
              <li class=""><a href="">India</a></li>
              <li class=""><a href="">Singapore</a></li>
              <li class=""><a href="">Malaysia</a></li>
            </ul>

          </div>
          <div class="col">
            <p class="footer_heading">Quick links</p>
            <ul class="fnt-footer ">
              <li class=""><a href="<?php echo base_url(); ?>about-us">About Us</a></li>
              <li class=""><a href="<?php echo base_url(); ?>">Events</a></li>
                <li class=""><a href="#">Blog</a></li>
              <li class=""><a href="<?php echo base_url(); ?>privacy">Privacy Policy</a></li>
              <li class=""><a href="<?php echo base_url(); ?>payment">Payment Policy</a></li>
              <li class=""><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
            </ul>

          </div>
          <div class="col">
            <p class="footer_heading">Contact Us</p>
            <p class="address_form">No: 6, Kummalamman Koil Street,<br>
                      3rd Lane Tondiarpet, <br>Chennai - 600081</p>
          </div>
          <div class="col">
            <p class="footer_heading">Follow  Us On</p>
            <ul class="fnt-footer social_follow">
              <li class=""><a href="https://www.facebook.com/heylaapp/" target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/share_facebook.png"></a></li>
              <li class=""><a href="https://www.instagram.com/heyla_app/" target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/instagram.png"></a></li>
              <!-- <li class=""><a href=""><img src="<?php echo base_url(); ?>assets/front/images/gp_follow.png"></a></li> -->
              <li class=""><a href="https://twitter.com/heylaapp"  target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/share_twitter.png"></a></li>
                <li class=""><a href="https://twitter.com/heylaapp"  target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/share_googleplus.png"></a></li>
            </ul>
            <p class="footer_heading">Download Apps</p>
            <ul class="fnt-footer social_follow">
              <li class=""><a href="" target="_blank"><img class="store_img" src="<?php echo base_url(); ?>assets/front/images/app.png"></a></li>
              <li class=""><a href="" target="_blank"><img class="store_img"  src="<?php echo base_url(); ?>assets/front/images/play.png"></a></li>

            </ul>
          </div>
      </div>
  </div>
    <!-- /.container -->
    <div class="container">
          <center><img class="text-center" src="<?php echo base_url(); ?>assets/front/images/heyla_white.png"></center>
        <p class=" text-center foot_copyrights">Crafted with <a href="" style="text-decoration:none;"><b style="color:#fff;font-size:20px;">Happiness</b></a></p>
    </div>
</footer>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="row">
    <div class="col-md-5"><img src="<?php echo base_url(); ?>assets/front/images/become_organiser.jpg"></div>
      <div class="col-md-7">
      <p class="become_organiser_text"> <p class="heading" style="color:#000;font-size:22px;">Become A Event Organiser</p>
        <p class="popup_txt">When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.</p>
      </p>
      <?php $user_id = $this->session->userdata('id');
       if ($user_id!='') { ?>
      <form class="form" role="form" autocomplete="off" id="formsignup" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
        <center><button type="submit" id="submit" class="btn btn-primary btn-lg">Request Now</button></center>
          </form>
      <?php } else { ?>
    	<center><a class="btn btn-lg btn-primary" href="<?php echo base_url(); ?>/signin" role="button">Sign In</a></center>
      <?php } ?>
    </div>
    </div>
    </div>
  </div>
</div>
</body>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script><!-- Sweet Alerts-->
 <script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
<!-- Required datatable js -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
<!--script src="assets/plugins/datatables/jszip.min.js"></script-->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/buttons.colVis.min.js"></script>
<!-- Responsive examples -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url(); ?>assets/pages/datatables.init.js"></script>

 <!-- Plugins js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

 <!-- Plugins Init js -->
<script src="<?php echo base_url(); ?>assets/pages/form-advanced.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/multislider.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.reflection.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.cloud9carousel.js"></script>
<script type="text/javascript">

$('#formsignup').validate({ // initialize the plugin
        rules: {
        },
        messages: {
        },
        submitHandler: function(form) {

            $.ajax({
                url: "<?php echo base_url(); ?>home/become_organiser",
                type: 'POST',
                data: $('#formsignup').serialize(),
                success: function(response) {
                    if (response == "Thanks for requesting we contact you shortly") {
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
                "background-color": "#fff"
            });
        } else {
            $(".navbar").css({
                "background-color": "#fff"
            });
        }

    })
});



</script>
</html>

<?php $user_id = $this->session->userdata('id');?>
<?php    $sql="SELECT id,category_name FROM category_master  WHERE status='Y' ORDER BY order_by ASC";
  $resu=$this->db->query($sql);
  $res=$resu->result();
$len = count($res);
$firsthalf = array_slice($res, 0, $len / 2);
$secondhalf = array_slice($res, $len / 2);
   ?>
<footer class="footer-bg footer" id="stickfooter">
  <div class="container-fluid no_padding">
      <div class="row footer_container">


          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <p class="footer_heading">Categories</p>
            <ul class="fnt-footer ">
              <?php  foreach($firsthalf as $row_cat){  ?>
                  <li class=""><a href="<?php echo base_url(); ?>eventlist/category/<?php echo base64_encode($row_cat->id*98765); ?>/<?php echo $row_cat->category_name; ?>"><?php echo $row_cat->category_name; ?></a></li>
              <?php } ?>

            </ul>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <p class="footer_heading">&nbsp;</p>
            <ul class="fnt-footer ">
              <?php  foreach($secondhalf as $row_sec_cat){  ?>
                  <li class=""><a href="<?php echo base_url(); ?>eventlist/category/<?php echo base64_encode($row_sec_cat->id*98765); ?>/<?php echo $row_sec_cat->category_name; ?>"><?php echo $row_sec_cat->category_name; ?></a></li>
              <?php } ?>
            </ul>

          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <p class="footer_heading">Get In Touch</p>
            <ul class="fnt-footer contact_text">
              <li class=""><i class="fa fa-envelope" aria-hidden="true"></i><span> info@heylaapp.com </span></li>
              <li class=""><i class="fa fa-phone" aria-hidden="true"></i> +65 8110 0119</li>
            </ul>
            <p class="footer_heading">Follow  Us On</p>
            <ul class="fnt-footer social_follow">
              <li class=""><a href="https://www.facebook.com/heylaapp/" target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/share_facebook.png"></a></li>
              <li class=""><a href="https://www.instagram.com/heyla_app/" target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/instagram.png"></a></li>
              <!-- <li class=""><a href=""><img src="<?php echo base_url(); ?>assets/front/images/gp_follow.png"></a></li> -->
              <li class=""><a href="https://twitter.com/heylaapp"  target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/share_twitter.png"></a></li>
              <li class=""><a href="https://www.youtube.com/channel/UCrjx62OpVHGhX5UONO8QDmw"  target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/youtube.png"></a></li>
            </ul>

          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <p class="footer_heading">Download Heyla</p>
            <ul class="fnt-footer social_follow">
              <li class=""><a href="https://apps.apple.com/us/app/heyla/id1438601804?ls=1" target="_blank"><img class="store_img" src="<?php echo base_url(); ?>assets/front/images/app.png"></a></li>
              <br>
              <li class=""><a href="https://play.google.com/store/apps/details?id=com.palprotech.heylaapp" target="_blank"><img class="store_img"  src="<?php echo base_url(); ?>assets/front/images/play.png"></a></li>

            </ul>
          </div>
      </div>
  </div>
    <!-- /.container -->
    <div class="container-fluid no_padding">
      <div class="row footer_container">
        <hr>
        <div class="col-lg-8">
          <ul class="list-inline footer_bottom_links">
              <li class="list-inline-item"><a href="<?php echo base_url(); ?>about-us">About</a></li>
              <li class="list-inline-item"><a href="<?php echo base_url(); ?>">Events</a></li>
              <li class="list-inline-item"><a href="<?php echo base_url(); ?>faq">FAQ</a></li>
			  <!--<li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#acModal">Reactivate Account</a></li>-->
			  <li class="list-inline-item"><a href="<?php echo base_url(); ?>reactivate">Reactivate Account</a></li>
              <li class="list-inline-item"><a href="#">Blog</a></li>
              <li class="list-inline-item"><a href="<?php echo base_url(); ?>privacy">Privacy Policy</a></li>
              <li class="list-inline-item"><a href="<?php echo base_url(); ?>payment">Payment Policy</a></li>
              <li class="list-inline-item"><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
            </ul>
        </div>
        <div class="col-lg-4">
          <p class=" text-center foot_copyrights">Built with <i class="fa fa-heart" aria-hidden="true" style="    width: 10px;"></i> by <a href="https://happysanztech.com" target="_blank" style="text-decoration:none;">
            <!-- <b style="color:#fff;font-size:20px;">Happy Sanz Tech</b> -->
            <img src="<?php  echo base_url(); ?>assets/happy-logo.png" class="img-responsive foot_logo">
          </a>
        </p>
        </div>
          </div>

    </div>
</footer>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="row popup_body">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
              <a href="#" class="pull-right close_popup" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
              <p class="text-center"><img class="organizer_icon" src="<?php echo base_url(); ?>assets/front/images/organizer.png"></p>
              <p class="become_organiser_text"> <p class="heading" style="color:#000;font-size:22px;">Become An Event Organiser</p>
                  <p class="popup_txt">Whether it's an event that fulfills people's needs or the one that gets their adrenalin going, we're here to help you get it done. Click the button to get started!</p>
              </p>
      		        <?php if ($user_id!='') { ?>
              		<form class="form" role="form" autocomplete="off" id="formsignup" method="post" enctype="multipart/form-data">
              			<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
              		  <center><button type="submit" id="submit" class="btn btn-primary btn-lg">Request Now</button></center>
                      </form>
              		<?php } else { ?>
              		<center><a class="btn btn-lg btn-primary btn-lg" href="<?php echo base_url(); ?>/signin" role="button">Sign In</a></center>
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
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>

<!-- Sweet Alerts-->
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
<!--<script src="<?php echo base_url(); ?>assets/front/js/multislider.js"></script>-->
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
                            text: "Your application to become an organizer has been registered. We will get back to you shortly.",
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
    title: '',
    text: "You want to logout?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No'

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

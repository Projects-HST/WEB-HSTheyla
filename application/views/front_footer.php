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


          <div class="col-lg-3 col-md-3 col-sm-6">
            <p class="footer_heading">Categories</p>
            <ul class="fnt-footer ">
              <?php  foreach($firsthalf as $row_cat){  ?>
                  <li class=""><a href=""><?php echo $row_cat->category_name; ?></a></li>
              <?php } ?>

            </ul>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6">
            <p class="footer_heading">&nbsp;</p>
            <ul class="fnt-footer ">
              <?php  foreach($secondhalf as $row_sec_cat){  ?>
                  <li class=""><a href=""><?php echo $row_sec_cat->category_name; ?></a></li>
              <?php } ?>
            </ul>

          </div>
          <div class="col">
            <p class="footer_heading">Quick links</p>
            <ul class="fnt-footer ">
                <li class=""><a href="<?php echo base_url(); ?>about-us">About</a></li>
                <li class=""><a href="<?php echo base_url(); ?>">Events</a></li>
                <li class=""><a href="#">Blog</a></li>
              <li class=""><a href="<?php echo base_url(); ?>privacy">Privacy Policy</a></li>
              <li class=""><a href="<?php echo base_url(); ?>payment">Payment Policy</a></li>
              <li class=""><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
            </ul>

          </div>
          <div class="col">
            <p class="footer_heading">Contact Us</p>
            <p class="address_form">Happy Sanz Tech <br>
                 #3, Perks campus, <br> Uppilipalayam,<br> Coimbatore-641015</p>
                 <p class="address_form">hello@heylaapp.com</p>
          </div>
          <div class="col">
            <p class="footer_heading">Follow  Us On</p>
            <ul class="fnt-footer social_follow">
              <li class=""><a href="https://www.facebook.com/heylaapp/" target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/share_facebook.png"></a></li>
              <li class=""><a href="https://www.instagram.com/heyla_app/" target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/instagram.png"></a></li>
              <!-- <li class=""><a href=""><img src="<?php echo base_url(); ?>assets/front/images/gp_follow.png"></a></li> -->
              <li class=""><a href="https://twitter.com/heylaapp"  target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/share_twitter.png"></a></li>
                <li class=""><a href="https://www.youtube.com/channel/UCrjx62OpVHGhX5UONO8QDmw"  target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/youtube.png"></a></li>
            </ul>
            <p class="footer_heading">Download Heyla</p>
            <ul class="fnt-footer social_follow">
              <li class=""><a href="https://itunes.apple.com/us/app/heyla/id1438601804?ls=1&mt=8" target="_blank"><img class="store_img" src="<?php echo base_url(); ?>assets/front/images/app.png"></a></li>
              <li class=""><a href="https://play.google.com/store/apps/details?id=com.palprotech.heylaapp" target="_blank"><img class="store_img"  src="<?php echo base_url(); ?>assets/front/images/play.png"></a></li>

            </ul>
          </div>
      </div>
  </div>
    <!-- /.container -->
    <div class="container">

        <p class=" text-center foot_copyrights">Built with <i class="fa fa-heart" aria-hidden="true" style="    width: 10px;"></i> by <a href="https://happysanztech.com" target="_blank" style="text-decoration:none;"><b style="color:#fff;font-size:20px;">Happy Sanz Tech</b></a></p>
    </div>
</footer>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="row">
    <div class="col-md-5"><img src="<?php echo base_url(); ?>assets/front/images/become_organiser.jpg"></div>
      <div class="col-md-7">

        <p class="become_organiser_text"> <p class="heading" style="color:#000;font-size:22px;">Become A Event Organiser</p>
        <p class="popup_txt">When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.</p></p>
		<?php if ($user_id!='') { ?>
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

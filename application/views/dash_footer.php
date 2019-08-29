</div>
<div class="container-fluid footer_section">
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
                  <li class=""><a href="https://www.facebook.com/heylaapp/" target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/fb_follow.png"></a></li>
                  <li class=""><a href="https://www.instagram.com/heyla_app/" target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/in_follow.png"></a></li>
                  <!-- <li class=""><a href=""><img src="<?php echo base_url(); ?>assets/front/images/gp_follow.png"></a></li> -->
                  <li class=""><a href="https://twitter.com/heylaapp"  target="_blank"><img src="<?php echo base_url(); ?>assets/front/images/tw_follow.png"></a></li>
                </ul>
              </div>
          </div>
      </div>
      <!-- /.container -->
      <div class="container">
          <p class=" text-center foot_copyrights">Crafted with <a href="" style="text-decoration:none;"><b style="color:#fff;font-size:20px;">Happiness</b></a></p>
      </div>
  </footer>
</div>
</body>
<script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<!-- Datatable init js -->
<script src="<?php echo base_url(); ?>assets/pages/datatables.init.js"></script>
<script>


$('#datetimepicker').datetimepicker();
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
</script>
</html>

<footer class="footer-bg footer" id="stickfooter">
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

<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.reflection.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.cloud9carousel.js"></script>
<script type="text/javascript">
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
                "background-color": "#478ECC"
            });
        } else {
            $(".navbar").css({
                "background-color": "#478ECC"
            });
        }

    })
});



</script>
</html>

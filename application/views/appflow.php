<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery.galpop.css" media="screen" />
<script src="<?php echo base_url(); ?>assets/front/js/jquery.galpop.min.js"></script>
<div class="container" style="margin-top:150px;margin-bottom:150px;">
    <center> <p class="event_heading">App Working Flow</p></center>
  <div class="row">

    <div class="col-md-2">
       <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/mobile/1.jpg"><img src="<?php echo base_url(); ?>assets/flow/mobile/1.jpg" class="img-responsive  img_gallery" alt="Login"></a>
       <p>Login</p>
    </div>
    <div class="col-md-2">
        <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/mobile/2.jpg"><img src="<?php echo base_url(); ?>assets/flow/mobile/2.jpg" class="img-responsive  img_gallery"></a>
         <p>Select City </p>
    </div>
    <div class="col-md-2">
      <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/mobile/3.jpg"><img src="<?php echo base_url(); ?>assets/flow/mobile/3.jpg" class="img-responsive  img_gallery"></a>
         <p>Select category </p>
    </div>

  <div class="col-md-2">
     <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/mobile/4.jpg"><img src="<?php echo base_url(); ?>assets/flow/mobile/4.jpg" class="img-responsive  img_gallery"></a>
      <p>Event list </p>
    </div>
  <div class="col-md-2">
   <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/mobile/5.jpg"><img src="<?php echo base_url(); ?>assets/flow/mobile/5.jpg" class="img-responsive  img_gallery"></a>
     <p>Event details </p>
     </div>
     <div class="col-md-2">
      <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/mobile/6.jpg"><img src="<?php echo base_url(); ?>assets/flow/mobile/6.jpg" class="img-responsive  img_gallery"></a>
       <p>Event booking </p>
        </div>
        <div class="col-md-2">
         <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/mobile/7.jpg"><img src="<?php echo base_url(); ?>assets/flow/mobile/7.jpg" class="img-responsive  img_gallery"></a>
          <p>Booking Confirm </p>
           </div>


  </div>
</div>
<style>

</style>
<script>
$(document).ready(function() {
    $('.galpop-multiple').galpop();
    var callback = function() {
      var wrapper = $('#galpop-wrapper');
      var info    = $('#galpop-info');
      var count   = wrapper.data('count');
      var index   = wrapper.data('index');
      var current = index + 1;
      var string  = 'Image '+ current +' of '+ count;
      info.append('<p>'+ string +'</p>').fadeIn();
    };
    $('.galpop-callback').galpop({
      callback: callback
    });

    $('.manual-open').change(function(e) {
      var image = $(this).val();
      if (image) {
        var settings = {};
        $.fn.galpop('openBox',settings,image);
      }
    });
  });
</script>

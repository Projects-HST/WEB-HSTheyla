<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery.galpop.css" media="screen" />
<script src="<?php echo base_url(); ?>assets/front/js/jquery.galpop.min.js"></script>
<div class="container" style="margin-top:150px;margin-bottom:150px;">
    <center> <p class="event_heading">Web Working Flow</p></center>
  <div class="row">

    <div class="col-md-2">
       <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/web/1.jpg"><img src="<?php echo base_url(); ?>assets/flow/web/1.jpg" class="img-responsive  img_gallery" alt="Login" title="Login"></a>
       <p>Login </p>
    </div>
    <div class="col-md-2">
        <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/web/2.jpg"><img src="<?php echo base_url(); ?>assets/flow/web/2.jpg" class="img-responsive  img_gallery"></a>
         <p>Event List </p>
    </div>
    <div class="col-md-2">
      <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/web/3.jpg"><img src="<?php echo base_url(); ?>assets/flow/web/3.jpg" class="img-responsive  img_gallery"></a>
       <p>Event details </p>
    </div>

  <div class="col-md-2">
     <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/web/4.jpg"><img src="<?php echo base_url(); ?>assets/flow/web/4.jpg" class="img-responsive  img_gallery"></a>
      <p>Booking  </p>
    </div>
  <div class="col-md-2">
   <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/flow/web/5.jpg"><img src="<?php echo base_url(); ?>assets/flow/web/5.jpg" class="img-responsive  img_gallery"></a>
    <p>Confirm booking </p>
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

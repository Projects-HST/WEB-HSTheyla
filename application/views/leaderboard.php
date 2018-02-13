<div class="container-fluid leaderboard-bg">
<div class="container">
<div class="row header-title">
  <div class="col-md-12">
    <p class="leader-title">Bootstrap example of Fixed Background Image using HTML, Javascript, jQuery, and CSS. Snippet by iammahesh.</p>
  </div>
</div>
<section>
  <div class="container" style="margin-top:30px;margin-bottom:50px;max-width:100%;">
        <div class="row row-offcanvas row-offcanvas-right">
          <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
              <a href="#" class="list-group-item active">Dashboard</a>
              <a href="<?php echo base_url(); ?>organizer/createevents/" class="list-group-item">Create Events</a>
              <a href="<?php echo base_url(); ?>organizer/viewevents/" class="list-group-item">View Events</a>
              <a href="<?php echo base_url(); ?>organizerbooking/view_booking/" class="list-group-item">Bookings</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="<?php echo base_url(); ?>organizerbooking/reviews/" class="list-group-item">Reviews</a>
              <a href="<?php echo base_url();?>organizerbooking/view_followers/" class="list-group-item">Followers</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
            <div class="jumbotron">
              <h1>Hello, world!</h1>
              <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
            </div>
          </div><!--/span-->

        </div><!--/row-->
   </div>
</section>
</div>
</div>
<style>

</style>
<script>

$(document).ready(function() {

var docHeight = $(window).height();
var footerHeight = $('.footer').height();
var footerTop = $('.footer').position().top + footerHeight;

if (footerTop < docHeight) {
 $('.footer').css('margin-top', 10+ (docHeight - footerTop) + 'px');
}
});
</script>

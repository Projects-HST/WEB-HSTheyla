<div class="container-fluid page-bg">
<div class="">
<div class="row header-title leaderboard-bg">
  <div class="col-md-12">
    <p class="leader-title">Bootstrap example of Fixed Background Image using HTML, Javascript, jQuery, and CSS. Snippet by iammahesh.</p>
  </div>
</div>

<section class="container">
  <div class="leaderboard-menu-tab">
        <div class="row row-offcanvas row-offcanvas-right">
          <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
              <a href="#" class="list-group-item active"><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
            <h3>Heyla Leaderboard</h3>
            <div class="row justify-content-md-center">
             <div class="col col-lg-3">

             </div>
             <div class="col-md-auto total-points-div">
               <p><img src="<?php echo base_url(); ?>assets/front/images/trophy.png" class="rounded mx-auto d-block leaderboard-img"></p>
               <p class="text-center">Total Points : <b>200</b></p>
             </div>
             <div class="col col-lg-3">

             </div>
           </div>
            <div class="row">
              <div class="col-sm points-one-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/login-img.png" class="img-responsive ">
                    <span class="text-center">login()</span>
                </p>

              </div>
              <div class="col-sm points-two-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/event-share.png" class="img-responsive ">
                    <span class="text-center">Events-Share()</span>
                </p>
              </div>
              <div class="col-sm points-three-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/event-checkin.png" class="img-responsive ">
                    <span class="text-center">Check-ins()</span>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 points-four-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/review.png" class="img-responsive ">
                    <span class="text-center">Review ()</span>
                </p>
              </div>
              <div class="col-sm-4 points-five-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/event-booking.png" class="img-responsive ">
                    <span class="text-center">Booking ()</span>
                </p>
              </div>
              <div class="col-sm-3"></div>
              <div class="col-sm-3"></div>


            </div>
          </div><!--/span-->

        </div><!--/row-->
   </div>
</section>
</div>
</div>
<style>
.list-group-item{
  border: none;
  color: #000;
}
body{
  background-color: #f6f6f6;
}
</style>
<script>

</script>

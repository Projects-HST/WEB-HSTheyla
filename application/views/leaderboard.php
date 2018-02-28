<div class="container-fluid page-bg">
<div class="">
<div class="row header-title leaderboard-bg">
  <div class="col-md-12">
    <div class="container">
    <p class="leader-title">Bootstrap example of Fixed Background Image using HTML, Javascript, jQuery, and CSS. Snippet by iammahesh.</p>
  </div>
  </div>
</div>

<section class="container">
  <div class="leaderboard-menu-tab">
        <div class="row row-offcanvas row-offcanvas-right">
          <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
              <a href="<?php echo base_url(); ?>leaderboard" class="list-group-item active"><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="<?php echo base_url(); ?>profile" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
                <a href="<?php echo base_url(); ?>profile_picture" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Display Picture</a>
                <?php $user_id=$this->session->userdata('id');
                if($user_id=='2'){ ?>
                    <a href="<?php echo base_url(); ?>createevent" class="list-group-item"><span class="menu-icons"><i class="far fa-plus-square"></i></span>Create event </a>
                      <a href="<?php echo base_url(); ?>viewevents" class="list-group-item"><span class="menu-icons"><i class="fas fa-table"></i></span>View events </a>
                        <a href="<?php echo base_url(); ?>viewevents" class="list-group-item"><span class="menu-icons"><i class="far fa-list-alt"></i></i></span>Events Booked </a>
              <?php   }else{

                } ?>
              <a href="<?php echo base_url(); ?>booking_history" class="list-group-item"><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>
              <a href="<?php echo base_url(); ?>wishlist" class="list-group-item"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <a href="<?php echo base_url(); ?>logout" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
            <h3>Heyla Leaderboard</h3>
            <div class="row justify-content-md-center">
             <div class="col col-lg-3">
            </div>

<?php
		foreach($user_points as $res){

		}
?>
             <div class="col-md-auto total-points-div">
               <p><img src="<?php echo base_url(); ?>assets/front/images/trophy.png" class="rounded mx-auto d-block leaderboard-img"></p>
               <p class="text-center">Total Points : <b><?php echo $res->total_points; ?></b></p>
             </div>
             <div class="col col-lg-3">

             </div>
           </div>
            <div class="row">
              <div class="col-sm points-one-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/login-img.png" class="img-responsive ">
                    <span class="text-center">login(<?php echo $res->login_points ; ?>)</span>
                </p>

              </div>
              <div class="col-sm points-two-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/event-share.png" class="img-responsive ">
                    <span class="text-center">Events-Share(<?php echo $res->sharing_points  ; ?>)</span>
                </p>
              </div>
              <div class="col-sm points-three-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/event-checkin.png" class="img-responsive ">
                    <span class="text-center">Check-ins(<?php echo $res->checkin_points  ; ?>)</span>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 points-four-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/review.png" class="img-responsive ">
                    <span class="text-center">Review (<?php echo $res->review_points ; ?>)</span>
                </p>
              </div>
              <div class="col-sm-4 points-five-div">
                <p class="leaderboard-widgets"><img src="<?php echo base_url(); ?>assets/front/images/event-booking.png" class="img-responsive ">
                    <span class="text-center">Booking (<?php echo $res->booking_points  ; ?>)</span>
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

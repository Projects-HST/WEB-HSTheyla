<div id="page-wrapper">
    <div class="container">

        <div class="row well mobile_leaderboard" id="main" >
            <!-- <div class="col-sm-12 col-md-12 " id="content">
                <h3 class="dashboard_tab"> Dashboard</h3>
            </div> -->
            	<?php foreach($user_points as $res){ } ?>
            <div class="col-md-12 points_tab">
              <img src="<?php echo base_url(); ?>assets/front/images/trophy.png" class="img-center">
              <center><p class="total_points_font border_gold">Total Points - <b><?php echo $res->total_points; ?></p></center>
            </div>
            <div class="row points_tab">
              <div class="col-md-2 col-md-offset-1">
                  <img src="<?php echo base_url(); ?>assets/front/images/login-img.png" class="img-center">
                  <center><p class="points_font">Login (<?php echo $res->login_points ; ?>)</p></center>
              </div>
              <div class="col-md-2">
                <img src="<?php echo base_url(); ?>assets/front/images/event-share.png" class="img-center">
                <center><p class="points_font">Event Sharing (<?php echo $res->sharing_points ; ?>)</p></center>
              </div>
              <div class="col-md-2">
                  <img src="<?php echo base_url(); ?>assets/front/images/event-checkin.png" class="img-center">
                  <center><p class="points_font">Event Checkins (<?php echo $res->checkin_points ; ?>)</p></center>
              </div>
              <div class="col-md-2">
                <img src="<?php echo base_url(); ?>assets/front/images/event-booking.png" class="img-center">
                <center><p class="points_font">Booking (<?php echo $res->booking_points ; ?>)</p></center>
              </div>
              <div class="col-md-2">
                <img src="<?php echo base_url(); ?>assets/front/images/review.png" class="img-center">
                <center><p class="points_font">Review (<?php echo $res->review_points ; ?>)</p></center>
              </div>
          </div>
        </div>

    </div>

</div>

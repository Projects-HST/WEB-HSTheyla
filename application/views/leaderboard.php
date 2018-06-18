<style>
.card-block{
  background-color: #fff;

  padding-bottom: 150px;
  margin-top: 0px;
  margin-left: 50px;
  margin-right: 50px;
  box-shadow: 3px 11px 15px 0px #959696;
}
.leaderboard_active{
    background-color: #92bce0  !important;
    color: #fff !important;
}

</style>
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab"> </h3>
</div>
<?php foreach($user_points as $res){ } ?>
<div class="col-md-12  text-center">
<div class="card-block">
<img src="<?php echo base_url(); ?>assets/front/images/trophy.png" class="img-center img_trophy">
<center><p class="total_points_font border_gold">Total Points - <b><?php echo $res->total_points; ?></p></center>
</div>
</div>


<div class="col-md-12 points_tab_section">
<div class="card-block">
  <div class="col-md-2 col-md-offset-1 text-center">
      <img src="<?php echo base_url(); ?>assets/front/images/login-img.png" class="img-center">
      <center><p class="points_font">Login (<?php echo $res->login_points ; ?>)</p></center>
  </div>
  <div class="col-md-2 text-center">
    <img src="<?php echo base_url(); ?>assets/front/images/event-share.png" class="img-center">
    <center><p class="points_font">Event Sharing (<?php echo $res->sharing_points ; ?>)</p></center>
  </div>
  <div class="col-md-2 text-center">
      <img src="<?php echo base_url(); ?>assets/front/images/event-checkin.png" class="img-center">
      <center><p class="points_font">Event Checkins (<?php echo $res->checkin_points ; ?>)</p></center>
  </div>
  <div class="col-md-2 text-center">
    <img src="<?php echo base_url(); ?>assets/front/images/event-booking.png" class="img-center">
    <center><p class="points_font">Booking (<?php echo $res->booking_points ; ?>)</p></center>
  </div>
  <div class="col-md-2 text-center">
    <img src="<?php echo base_url(); ?>assets/front/images/review.png" class="img-center">
    <center><p class="points_font">Review (<?php echo $res->review_points ; ?>)</p></center>
  </div>
</div>
</div>

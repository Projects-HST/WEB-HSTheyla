<style>

.leaderboard_active{
    border-left: 4px solid #92bce0;
}
.box{
  background-color: #fff;
  padding: 12px;
  margin-bottom: 15px;
  margin-right: -15px;
}
.login_box{
    background-color: #fff;
    padding: 55px;
    margin-right: -15px;
}
.points_tab_section{
padding-left: 150px;
padding-right: 150px;
}
.total_points_tab{
  margin-left: 150px;
  margin-right: 150px;

}
.footer_section{
  display: none;
}
.city_bg{
  margin-left: 50px;
}
</style>
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">Leaderboard </h3>
</div>
<?php foreach($user_points as $res){ } ?>
<div class="col-md-12  text-center">
<div class="total_points_tab">

    <div class="box">
<img src="<?php echo base_url(); ?>assets/front/images/trophy.png" class="img-center img_trophy"><span class="total_points_font">Total Points - <b><?php echo $res->total_points; ?></span>
<center></center>
</div>
</div>
</div>


<div class="col-md-12 points_tab_section">
<div class="card-block">
  <div class="col-md-4  text-center">
      <div class="login_box">
      <img src="<?php echo base_url(); ?>assets/front/images/login-img.png" class="img-center">
      <center><p class="points_font">Login (<?php echo $res->login_points ; ?>)</p></center>
    </div>
  </div>
  <div class="col-md-4 text-center">
    <div class="box">
      <img src="<?php echo base_url(); ?>assets/front/images/event-share.png" class="img-center">
      <center><p class="points_font">Event Sharing (<?php echo $res->sharing_points ; ?>)</p></center>
      </div>
      <div class="box">
    <img src="<?php echo base_url(); ?>assets/front/images/event-booking.png" class="img-center">
    <center><p class="points_font">Booking (<?php echo $res->booking_points ; ?>)</p></center>
    </div>
  </div>
  <div class="col-md-4 text-center">
    <div class="box">
      <img src="<?php echo base_url(); ?>assets/front/images/event-checkin.png" class="img-center">
      <center><p class="points_font">Event Checkins (<?php echo $res->checkin_points ; ?>)</p></center>
        </div>
      <div class="box">
      <img src="<?php echo base_url(); ?>assets/front/images/review.png" class="img-center">
      <center><p class="points_font">Review (<?php echo $res->review_points ; ?>)</p></center>
      </div>
  </div>

</div>
</div>

<div class="">
  <center><img src="<?php echo base_url(); ?>assets/front/images/city_bg.png" class="img-center city_bg"></center>
</div>

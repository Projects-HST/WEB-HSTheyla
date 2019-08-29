<style>

.leaderboard_active{
    border-left: 4px solid #458ecc;
}
.box{
  background-color: #fff;
  padding: 12px;
  margin-bottom: 15px;
  margin-right: -15px;
}
.login_box{
    background-color: #fff;
    padding: 38px;
    margin-right: -15px;
}
.points_tab_section{
padding-left: 50px;
padding-right: 50px;
}
.total_points_tab{
  margin-left: 50px;
  margin-right: 50px;

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
<img src="<?php echo base_url(); ?>assets/front/images/trophy.png" class="img-center img_trophy"><span class="total_points_font">Total Points Earned  <b><?php echo $res->total_points; ?></span>
<center></center>
</div>
</div>
</div>


<div class="col-md-12 points_tab_section">
<div class="card-block">
  <div class="col-md-4  text-center">
      <div class="login_box">
        <img src="<?php echo base_url(); ?>assets/front/images/event-booking.png" class="img-center">
        <span class="points_font">Bookings (<?php echo $res->booking_points ; ?>)</span>

    </div>
  </div>
  <div class="col-md-4 text-center">
    <div class="box">
      <img src="<?php echo base_url(); ?>assets/front/images/event-checkin.png" class="img-center">
      <span class="points_font">Event Check-ins (<?php echo $res->checkin_points ; ?>)</span>

      </div>
      <div class="box">
        <img src="<?php echo base_url(); ?>assets/front/images/review.png" class="img-center">
        <span class="points_font">Event Reviews (<?php echo $res->review_points ; ?>)</span>
    </div>
  </div>
  <div class="col-md-4 text-center">
    <div class="box">
      <img src="<?php echo base_url(); ?>assets/front/images/event-share.png" class="img-center">
    <span class="points_font">Sharing Events (<?php echo $res->sharing_points ; ?>)</span>
        </div>
      <div class="box">

      <img src="<?php echo base_url(); ?>assets/front/images/login-img.png" class="img-center">
    <span class="points_font">Logins (<?php echo $res->login_points ; ?>)</span>
      </div>
  </div>

</div>
</div>

<div class="">
  <center><img src="<?php echo base_url(); ?>assets/front/images/city_bg.png" class="img-center city_bg"></center>
</div>

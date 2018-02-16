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
              <a href="#" class="list-group-item "><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="#" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
              <a href="#" class="list-group-item active"><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
            <div class="card-header card-header-title">
                           <h3 class="mb-0">Booking history</h3>
            </div>

          <div class="card booked-ticket">
          <div class="card-block">
            <div class="row">
              <div class="col-md-8">
                <a href="#"><h4 class="card-title">Event title</h4></a>
                <h6 class="card-subtitle mb-2 text-muted">Venue</h6>
                <img src="<?php echo base_url(); ?>assets/front/images/sample.jpg" class="img-fluid booked-event-img">
                <p  class="card-text">Something Description</p>
              </div>
              <div class="col-md-4 booked-date">
                <p class="card-title">Booked Date</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card booked-ticket">
        <div class="card-block">
          <div class="row">
            <div class="col-md-8">
              <a href="#"><h4 class="card-title">Event title</h4></a>
              <h6 class="card-subtitle mb-2 text-muted">Venue</h6>
              <img src="<?php echo base_url(); ?>assets/front/images/sample.jpg" class="img-fluid booked-event-img">
              <p  class="card-text">Something Description</p>
            </div>
            <div class="col-md-4 booked-date">
              <p class="card-title">Booked Date</p>
            </div>
          </div>
        </div>
      </div>




            </div><!--/span-->

        </div><!--/row-->
   </div>
</section>
</div>
</div>
<style>
.form-group{
  margin-bottom: 0px;
}
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

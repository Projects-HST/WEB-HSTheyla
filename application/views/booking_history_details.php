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
              <a href="<?php echo base_url(); ?>leaderboard" class="list-group-item "><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="<?php echo base_url(); ?>profile" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
                <a href="<?php echo base_url(); ?>profile_picture" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Display Picture</a>
                <?php $user_role = $this->session->userdata('user_role');
                if($user_role=='2'){ ?>
                    <a href="<?php echo base_url(); ?>createevent" class="list-group-item"><span class="menu-icons"><i class="far fa-plus-square"></i></span>Create event </a>
                    <a href="<?php echo base_url(); ?>viewevents" class="list-group-item"><span class="menu-icons"><i class="fas fa-table"></i></span>View events </a>
                    <a href="<?php echo base_url(); ?>bookedevents" class="list-group-item"><span class="menu-icons"><i class="far fa-list-alt"></i></i></span>Booked Events </a>
                   <a href="<?php echo base_url(); ?>reviewevents" class="list-group-item"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <?php   } ?>
              <a href="<?php echo base_url(); ?>booking_history" class="list-group-item active"><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>
              <a href="<?php echo base_url(); ?>wishlist" class="list-group-item"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="<?php echo base_url(); ?>logout" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
          
            <div class="card-header card-header-title">
				<h3 class="mb-0">Booking History</h3>
            </div>
            
			<div class="card-block" style="padding:20px;">
                  <?php foreach($booking_details as $rows){}?>
                  		<div class="row" style="padding:5px;">
                            <div class="col-sm-3">Event Name  : </div>
                            <div class="col-sm-6"><?php echo $rows-> event_name; ?></div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row" style="padding:5px;">
                            <div class="col-sm-3">Event Venue  : </div>
                            <div class="col-sm-6"><?php echo $rows-> event_venue; ?></div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row" style="padding:5px;">
                            <div class="col-sm-3">Event Address  : </div>
                            <div class="col-sm-6"><?php echo $rows-> event_address; ?></div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row" style="padding:5px;">
                            <div class="col-sm-3">Event Category  : </div>
                            <div class="col-sm-6"><?php echo $rows-> category_name; ?></div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row" style="padding:5px;">
                            <div class="col-sm-3">Order Id  : </div>
                            <div class="col-sm-6"><?php echo $rows-> order_id; ?></div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row" style="padding:5px;">
                            <div class="col-sm-3">Track Id : </div>
                            <div class="col-sm-6"><?php echo $rows->track_id; ?></div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row" style="padding:5px;">
                            <div class="col-sm-3">Status  : </div>
                            <div class="col-sm-3"><?php echo $rows-> status_message; ?></div>
                            <div class="col-sm-3"></div>
                        </div>
                        <div class="row" style="padding:5px;">
                            <div class="col-sm-3">Show Date Time  : </div>
                            <div class="col-sm-3"><?php echo $rows->show_date; ?> - <?php echo $rows->show_time; ?></div>
                            <div class="col-sm-3"></div>
                        </div>
 						<div class="row" style="padding:5px;">
                            <div class="col-sm-3">No. of Seats  : </div>
                            <div class="col-sm-3"><?php echo $rows->number_of_seats; ?> Seats</div>
                            <div class="col-sm-3"></div>
                        </div>
 						<div class="row" style="padding:5px;">
                            <div class="col-sm-3">Total Amount  : </div>
                            <div class="col-sm-3">₹ <?php echo $rows->total_amount; ?></div>
                            <div class="col-sm-3"></div>
                        </div>                
			</div><!--/span-->



 			<div class="card-header card-header-title">
				<h3 class="mb-0">Booking Attendees</h3>
            </div>
            
			<div class="card-block" style="padding:20px;">
				<?php foreach($event_attendees as $rows){ ?>
                <div class="row" style="padding:5px;">
                    <div class="col-sm-3"><?php echo $rows-> name; ?></div>
                    <div class="col-sm-3"><?php echo $rows-> email_id; ?></div>
                    <div class="col-sm-6"><?php echo $rows-> mobile_no; ?></div>
                </div>
                <?php } ?>
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

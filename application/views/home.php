  <?php $user_role=$this->session->userdata('user_role'); ?>
  <div class="page-content-wrapper ">
      <div class="container">
          <div class="row">
            <?php  
			
            if($user_role==1){ ?>

            <div class="col-md-6 col-lg-6 col-xl-3">
               <!-- <a href="<?php echo base_url();?>events/view_events" class="test" data-toggle="tooltip" title="View Events Details"> -->
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/admin.png" /></span>
                    <div class="mini-stat-info text-right text-white">
                        <span class="counter"><?php foreach ($admin_users as $rows_admin) {
                          echo $rows_admin->users;
                        } ?></span>
                        <b style="font-size:14px;">Staff</b>
                    </div>
                </div>
              <!-- </a> -->
            </div>
          <?php  } ?>
		  
		  
              <div class="col-md-6 col-lg-6 col-xl-3">

                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($users as $value) {
                            echo $value->users;
                          } ?></span>
                          <b style="font-size:14px;">Users</b>
                      </div>
                  </div>
                <!-- </a> -->

              </div>


              <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/organiser.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($org_users as $rows_org) {
                            echo $rows_org->users;
                          } ?></span>
                          <b style="font-size:14px;">Organizers</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/category.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($total_category as $rows_cat) {
                            echo $rows_cat->count;
                          } ?></span>
                          <b style="font-size:14px;">Event Categories</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/total_events.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($events as $rows) {
                            echo $rows->events;
                          } ?></span>
                          <b style="font-size:14px;">Total Events</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
              
			 <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/active_events.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter">
						  <?php foreach ($live_events as $rows) {
							  $slive_events = $rows->live_events;
                          } ?>
						  <?php foreach ($archive_events as $rows) {
								$sarchive_events = $rows->archive_events;
                          } ?>
						  <?php echo $slive_events + $sarchive_events;?> </span>
                          <b style="font-size:14px;">Mainstream Events</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
			  <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/hotspot.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($hotspot_events as $row_hotspot) {
                            echo $row_hotspot->hotspot_events;
                          } ?></span>
                          <b style="font-size:14px;">Hotspots </b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
			  <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/general.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($live_events as $rows) {
							  $live_events = $rows->live_events;
                            echo $live_events;
                          } ?></span>
                          <b style="font-size:14px;">Active Mainstream Events</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
			   <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/active_events.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($archive_events as $rows) {
								$archive_events = $rows->archive_events;
								echo $archive_events;
                          } ?></span>
                          <b style="font-size:14px;">Unlisted Events</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
			
              <!--<div class="col-md-6 col-lg-6 col-xl-3">
                  <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> 
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/general.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($general_events as $row_general) {
                            echo $row_general->count;
                          } ?></span>
                          <b style="font-size:14px;">General </b>
                      </div>
                  </div>
                 </a> 
              </div>-->
			   
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/paid_event.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($paid_events as $row_piad) {
                            echo $row_piad->count;
                          } ?></span>
                          <b style="font-size:14px;">Active Paid Events</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/free_event.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($free_events as $row_free) {
                            echo $row_free->count;
                          } ?></span>
                          <b style="font-size:14px;">Active Free Events</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Events Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/ad_event.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($ad_events as $row_ad) {
                            echo $row_ad->count;
                          } ?></span>
                          <b style="font-size:14px;">Active Event Advertisements</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <div class="mini-stat clearfix bg-primary">
                     <!-- <a href="<?php echo base_url();?>events/organizer_events" class="test" data-toggle="tooltip" title="View Organizer Events Details"> -->
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/organiser_event.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($org_events as $res) {
                            echo $res->org;
                          } ?></span>
                        <b style="font-size:14px;">Unreviewed Organizer Events</b>
                      </div>
                    <!-- </a> -->
                  </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Booking Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/booking.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($booking as $res) {
                            echo $res->booking;
                          } ?></span>
                          <b style="font-size:14px;">Total Tickets Booked</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Pending Reviews Details"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/Pending.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($reviews as $res) {
                            echo $res->reviews;
                          } ?></span>
                         <b style="font-size:14px;">Unrestrained User Reviews</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
			  
              <?php   if($user_role==1){ ?>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <!-- <a href="#" class="test" data-toggle="tooltip" title="View Organiser Request"> -->
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/organiser_request.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($organiser_request as $res) {
                            echo $res->request_pending;
                          } ?></span>
                         <b style="font-size:14px;">Organizer Applications</b>
                      </div>
                  </div>
                <!-- </a> -->
              </div>
            <?php } ?>
			
            <!--<div class="col-md-6 col-lg-6 col-xl-3">
              <a href="#" class="test" data-toggle="tooltip" title="View Booking Details">
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/subscribed_user.png" /></span>
                    <div class="mini-stat-info text-right text-white">
                        <span class="counter"><?php foreach ($newsletter_user as $row_news) {
                          echo $row_news->count;
                        } ?></span>
                        <b style="font-size:14px;">Newsletter Subscriptions</b>
                    </div>
                </div>
              </a> 
            </div>-->


          </div>
      </div><!-- container -->


  </div> <!-- Page content Wrapper -->
</div> <!-- content -->
<style>
.bg-primary{height: 110px;}
</style>

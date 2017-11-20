<style type="text/css">
.test :hover
 {
    /*background-color:#ccc;
    outline-width: 10px;*/
 }
</style>

  <div class="page-content-wrapper ">
      <div class="container">
          <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-3">
                <a href="<?php echo base_url();?>users/view" class="test">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($users as $value) {
                            echo $value->users;
                          } ?></span>
                          Users
                      </div>
                  </div>
                </a>

              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>events/view_events" class="test">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/event.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($events as $rows) {
                            echo $rows->events;
                          } ?></span>
                          Events
                      </div>
                  </div></a>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <div class="mini-stat clearfix bg-primary">
                     <a href="<?php echo base_url();?>events/organizer_events" class="test">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/organiser.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($org_events as $res) {
                            echo $res->org;
                          } ?></span>
                         Organizer Events
                      </div></a>
                  </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>bookinghistory/home" class="test">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/booking.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($booking as $res) {
                            echo $res->booking;
                          } ?></span>
                          Booking
                      </div>
                  </div></a>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>reviews/view_reviews" class="test">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/Pending.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($reviews as $res) {
                            echo $res->reviews;
                          } ?></span>
                          Pending Reviews
                      </div>
                  </div></a>
              </div>
          </div>
      </div><!-- container -->


  </div> <!-- Page content Wrapper -->
</div> <!-- content -->

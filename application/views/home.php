  <div class="page-content-wrapper ">
      <div class="container">
          <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-3">
                <?php  $user_role=$this->session->userdata('user_role');
                if($user_role==4){ ?>
                    <a href="#" class="test" data-toggle="tooltip" title="View Users Details">
              <?php  }else{ ?>
                    <a href="<?php echo base_url();?>users/view" class="test" data-toggle="tooltip" title="View Users Details">
              <?php  } ?>

                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($users as $value) {
                            echo $value->users;
                          } ?></span>
                          <b style="font-size:18px;">Users</b>
                      </div>
                  </div>
                </a>

              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>events/view_events" class="test" data-toggle="tooltip" title="View Events Details">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom: 9px;padding-right: 2px;" src="<?php echo base_url();?>assets/icons/dashboard/event.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($events as $rows) {
                            echo $rows->events;
                          } ?></span>
                          <b style="font-size:18px;">Events</b>
                      </div>
                  </div></a>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <div class="mini-stat clearfix bg-primary">
                     <a href="<?php echo base_url();?>events/organizer_events" class="test" data-toggle="tooltip" title="View Organizer Events Details">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/organiser.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($org_events as $res) {
                            echo $res->org;
                          } ?></span>
                        <b style="font-size:16px;"> Organizer Events </b>
                      </div></a>
                  </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>bookinghistory/home" class="test" data-toggle="tooltip" title="View Booking Details">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/booking.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($booking as $res) {
                            echo $res->booking;
                          } ?></span>
                          <b style="font-size:18px;">Booking</b>
                      </div>
                  </div></a>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>reviews/view_reviews" class="test" data-toggle="tooltip" title="View
                  Pending Reviews Details">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/Pending.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($reviews as $res) {
                            echo $res->reviews;
                          } ?></span>
                         <b style="font-size:16px;"> Pending Reviews </b>
                      </div>
                  </div></a>
              </div>
              <?php   $user_role=$this->session->userdata('user_role');if($user_role==1){ ?>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>dashboard/get_all_organiser_request" class="test" data-toggle="tooltip" title="View
                  Organiser Request">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><img style="padding-bottom:10px; padding-right:2px;" src="<?php echo base_url();?>assets/icons/dashboard/Pending.png" /></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($organiser_request as $res) {
                            echo $res->request_pending;
                          } ?></span>
                         <b style="font-size:16px;"> Organiser  Request </b>
                      </div>
                  </div></a>
              </div>
            <?php }else{

            } ?>


          </div>
      </div><!-- container -->


  </div> <!-- Page content Wrapper -->
</div> <!-- content -->
<script>
   // $('[data-toggle="tooltip"]').tooltip();
</script>

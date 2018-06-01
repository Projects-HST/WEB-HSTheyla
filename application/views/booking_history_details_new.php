<div id="page-wrapper">
    <div class="container">

        <div class="row well mobile_leaderboard" id="main" >
            <div class="col-sm-12 col-md-12 " id="content">
                <h3 class="dashboard_tab"> Booking history</h3>
            </div>

            <div class="col-md-12 ">
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
              </div>
              <div class="card-header card-header-title">
                <h3 class="mb-0">Booking Attendees</h3>
              </div>

              <div class="card-block" style="padding:20px;">
                <?php if(empty($event_attendees)){ echo "<center>No Attendees found</center>";}else{foreach($event_attendees as $rows){ ?>
                        <div class="row" style="padding:5px;">
                            <div class="col-sm-3"><?php echo $rows->name; ?></div>
                            <div class="col-sm-3"><?php echo $rows->email_id; ?></div>
                            <div class="col-sm-6"><?php echo $rows->mobile_no; ?></div>
                        </div>
                      <?php }} ?>
              </div>
            </div>

        </div>

    </div>

</div>
<script>
$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

<style>
.card-block{
  background-color: #fff;
  padding-bottom: 100px;
  padding-top: 50px;
  margin-left: 50px;
  margin-right: 50px;
  box-shadow: 3px 11px 15px 0px #959696;
}
.booking_history_active{
  border-left: 4px solid #458ecc;
}
</style>

<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab"></h3>
</div>
<div class="col-md-12 ">
  <div class="card-block" style="padding:20px;">
              <?php foreach($booking_details as $rows){}?>
                  <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">Event Name  : </p></div>
                        <div class="col-sm-6"><p class="summary_value"><?php echo $rows-> event_name; ?></p></div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">Event Venue  :</p> </div>
                        <div class="col-sm-6"><p class="summary_value"><?php echo $rows-> event_venue; ?></p></div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">Event Address  : </p></div>
                        <div class="col-sm-6"><p class="summary_value"><?php echo $rows-> event_address; ?></p></div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">Event Category  : </p></div>
                        <div class="col-sm-6"><p class="summary_value"><?php echo $rows-> category_name; ?></p></div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">Order Id  : </p></div>
                        <div class="col-sm-6"><p class="summary_value"><?php echo $rows-> order_id; ?></p></div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">Track Id : </p></div>
                        <div class="col-sm-6"><p class="summary_value"><?php echo $rows->track_id; ?></p></div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">Status  : </p></div>
                        <div class="col-sm-3"><p class="summary_value"><?php echo $rows->status_message; ?></p></div>
                        <div class="col-sm-3"></div>
                    </div>
                    <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">Show Date Time  : </p></div>
                        <div class="col-sm-3"><p class="summary_value"><?php echo $rows->show_date; ?> - <?php echo $rows->show_time; ?></p></div>
                        <div class="col-sm-3"></div>
                    </div>
        <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">No. of Seats  : </p></div>
                        <div class="col-sm-3"><p class="summary_value"><?php echo $rows->number_of_seats; ?> Seats</p></div>
                        <div class="col-sm-3"></div>
                    </div>
        <div class="row" style="padding:5px;">
                        <div class="col-sm-3"><p class="summary_text">Total Amount  : </p></div>
                        <div class="col-sm-3"><p class="summary_value">₹ <?php echo $rows->total_amount; ?><p class="summary_value"></div>
                        <div class="col-sm-3"></div>
                    </div>
  </div>
  <div class="card-header card-header-title">
    <h3 class="mb-0 booking_attendees_title">Booking Attendees</h3>
  </div>

  <div class="card-block" style="padding:20px;">
    <?php if(empty($event_attendees)){ echo "<center>No Attendees found</center>";}else{foreach($event_attendees as $rows){ ?>
            <div class="row" style="padding:5px;">
                <div class="col-sm-3"><p class="summary_value"><?php echo $rows->name; ?></p></div>
                <div class="col-sm-3"><p class="summary_value"><?php echo $rows->email_id; ?></p></div>
                <div class="col-sm-6"><p class="summary_value"><?php echo $rows->mobile_no; ?></p></div>
            </div>
          <?php }} ?>
  </div>
</div>
<script>
$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

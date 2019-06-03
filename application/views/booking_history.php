<style>
.booking_history_active{
  border-left: 4px solid #458ecc;
}
.profile_tab{
  height: 100vh;
}
.footer_section{
  display: none;
}

</style><div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">Booking history</h3>
</div>
<div class="col-md-12 profile_tab">

        <div class="card-block" style="padding:20px;">
          <?php  
		  if (empty($booking_details)) {
				echo "<center><h3>Sorry!.. Booking not found.</h3></center>";
			} else {
			
			  foreach($booking_details as $res){
				$event_id = $res->event_id * 564738;
				$event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
				$enc_event_id = base64_encode($event_id);

				$string = strip_tags($res->description);
				  if (strlen($string) > 150) {

					$stringCut = substr($string, 0, 150);
					$endPoint = strrpos($stringCut, ' ');

					$string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
					$string .= '...';
				  }  ?>
			  <div class="col-xs-18 col-sm-6 col-md-4">
			   <div class="thumbnail">
				 <img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" alt="" style="height:220px;width:100%;">
				   <div class="caption">
					 <a href="<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $res->event_name; ?>"><h4><?php echo $res->event_name; ?></h4></a>
						 <!-- <p class="plan_details"><?php //echo $string;?></p>-->
						  <p class="plan_details">Plan <?php echo $res->plan_name; ?></p>
						  <p class="plan_details">Number of Tickets <?php echo $res->number_of_seats; ?></p>
						  <p class="plan_details">Total Amount :  <?php echo $res->total_amount; ?></p>
						  <p class="plan_details">Booking Date <?php echo $res->show_date; ?><a href="<?php echo base_url(); ?>home/user_booking_history/<?php echo $res->order_id; ?>/<?php echo $res->payment_gateway; ?>" class="btn btn-default btn-xs pull-right" role="button">
						  <i class="fa fa-eye"></i></a></p>
				 </div>
			   </div>
			 </div>
		   <?php } 
		}
		?>

        </div>
</div>
<script>
$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

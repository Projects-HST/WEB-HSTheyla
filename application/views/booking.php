<?php $user_id = $this->session->userdata('id'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/multiselect.css">
<script src="<?php echo base_url(); ?>assets/front/js/multiselect.js"></script>
	<div class="container-fluid eventdetail-pge">
		<div class="container">
			<div class="row">
				<div class="carousel carousel-fade" data-ride="carousel" data-interval="2000">
					<div class="carousel-inner" role="listbox">
	<?php
	if (!empty($event_gallery)){
		$i = 0;
		foreach($event_gallery as $res){
	?>
			<div class="carousel-item <?php if ($i=='0') echo "active"; ?>">
				<img class="d-block w-100" src="<?php echo base_url(); ?>assets/events/gallery/<?php echo $res->event_image; ?>">
			</div>
	  <?php
	   $i = $i+1;
		}
	  } else {
		foreach($event_details as $res){}
	  ?>
			<div class="carousel-item active">
				<img class="d-block w-100" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>">
			</div>
	  <?php  } ?>
								</div>
							</div>
						</div>
					<?php foreach($event_details as $res){ $event_id = $res->id;} 	?>
					<div class="row booking-section">
							<div class="col-md-10">
								<div class="event-heading">
									<p class="event-heading-text"><?php echo $res->event_name; ?></p>
								</div>
							</div>
							<div class="col-md-2"></div>
						</div>

            <form class="form-horizontal" method='post' action='<?php echo base_url(); ?>eventlist/event_booking' id='eventplan'>
            <section class="row event-details-desc" style="min-height:400px;">
            
            <div class="col-md-6">
               <fieldset>
                <p class="event-desc-head">Select Date </p>
                <div class="form-group">
                    <div class="col-md-4">
                    		<?php if (!empty($booking_dates)){ ?>
                            <select class="form-control input-lg select_booking" id="show_date" onchange="disp_time()">
                            <option value="">Select Date</option>
							<?php foreach($booking_dates as $res){ 
							$originalDate = $res->show_date;;
							?>
                            
                            <option value="<?php echo $res->show_date; ?>"><?php echo  date("d-m-Y", strtotime($originalDate)) ?></option>
							<?php } ?>
                            </select>
                            <?php }  else {
							echo "No Dates Found";
							}?>
                        </div>
                    </div>
                </fieldset>
                <div id="plan_time"></div>
                <div id="plan_details"></div>
                <div id="plan_seats"></div>
            </div>


            <div class="col-md-4">
                <p class="event-desc-head">Summary</p>
                 <div id="plan_summary"></div>
            </div>
            
            <div class="col-md-2">
            </div>
         
        </section>
         </form>
</div>
</div>
<style>
.select_booking{
	border: 2px solid #478ecc;
	color: #000;
}

.carousel-fade .carousel-inner, .carousel-fade .carousel-item{
height: 400px;
}
.carousel{
  width: 100%;
}
@media (min-width: 320px) and (max-width: 480px){
  .carousel-fade .carousel-inner, .carousel-fade .carousel-item{
  height: 180px;
  }
}
</style>
<script>
    $('.carousel').carousel({
      interval:6000,
      pause: "false"
  })
 
function disp_time()
	{
		var plan_date=$('#show_date').val();

		$('#plan_details').hide();
		$('#plan_seats').hide();
		$('#plan_summary').hide();
		var result = '';
		
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/plantiming',
		type: 'POST',
		data: {event_id : <?php echo $event_id; ?>,plan_date : plan_date},
		success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			result +="<fieldset><p class='event-desc-head'>Select Time</p><div class='form-group'><div class='col-md-4'><select class='form-control input-lg select_booking' id='show_time' onchange='disp_plan()'><option value=''>Select Time</option>";

			for (var i = 0; i < dataArray.length; i++){
				var id = dataArray[i].id;
				var show_time = dataArray[i].show_time;
				
				result +="<option value='"+show_time+"'>"+show_time+"</option>";
			};
				result +="</select></div></div></fieldset>";

			$("#plan_time").html(result).show();
		} else {
			result +="No Records found!..";
			$("#plan_time").html(result).show();
			$('#plan_details').hide();
			$('#plan_seats').hide();
		}
		}
		});
	}

	function disp_plan()
	{
		$('#plan_seats').hide();
		$('#plan_summary').hide()
		
		var show_date=$('#show_date').val();
		var show_time=$('#show_time').val();
		
		var result = '';
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/plandetails',
		type: 'POST',
		data: {event_id : <?php echo $event_id; ?>,show_date : show_date,show_time : show_time},
		success: function(data) {
		var dataArray = JSON.parse(data);

		if (dataArray.length>0) {
			
			result +="<fieldset><p class='event-desc-head'>Select Plan</p><div class='form-group'><div class='col-md-4'><select class='form-control input-lg select_booking' id='show_plan' onchange='disp_seats()'><option value=''>Select Plan</option>";

			for (var i = 0; i < dataArray.length; i++){
				var plan_name = dataArray[i].plan_name;
				var plantime_id = dataArray[i].plantime_id;
			result +="<option value='"+plan_name+"'>"+plan_name+"</option>";
			};
			result +="</select></div></div></fieldset>";

			$("#plan_details").html(result).show();
			
		} else {
			result +="No Records found!..";
			$("#plan_details").html(result).show();
			$('#plan_seats').hide();
		}

		}
		});
	}
	function disp_seats()
	{
		$('#plan_summary').hide()
		
		var show_date=$('#show_date').val();
		var show_time=$('#show_time').val();
		var show_plan = $('#show_plan').val();
		
		var result = '';
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/seatdetails',
		type: 'POST',
		data: {event_id : <?php echo $event_id; ?>,show_date : show_date,show_time : show_time,show_plan : show_plan},
		success: function(data) {

		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			result +="<fieldset><p class='event-desc-head'>Select Seats</p><div class='form-group'><div class='col-md-4'><select class='form-control input-lg select_booking' id='show_seats' onchange='plan_summary()'><option value=''>Select Seats</option>";
			for (var i = 0; i < dataArray.length; i++){
				var event_id = dataArray[i].event_id;
				var plan_id = dataArray[i].plan_id;
				var plan_name = dataArray[i].plan_name;
				var plantime_id = dataArray[i].plantime_id;
				var seat_available = dataArray[i].seat_available;
				var seat_rate = dataArray[i].seat_rate;
			};
			var available_seats = (parseInt(seat_available)+1);
			for (var i = 1; i < available_seats; i++){
				result +="<option value='"+i+"'>"+i+"</option>";
			};
			result +="</select><input type='hidden' id='booking_date' name='booking_date' value='"+show_date+"' /><input type='hidden' id='event_id' name='event_id' value='"+event_id+"' /><input type='hidden' name='plan_id' id='plan_id' value='"+plan_id+"' /><input type='hidden' id='plan_name' value='"+plan_name+"' /><input type='hidden' name='plantime_id' id='plantime_id' value='"+plantime_id+"' /><input type='hidden' name='seat_rate' id='seat_rate' value='"+seat_rate+"' /></div></div></fieldset>";

			$("#plan_seats").html(result).show();
			
		} else {
			result +="No Records found!..";
			$("#plan_seats").html(result).show();
			$('#plan_summary').hide();
		}

		}
		});
	}
	
	function plan_summary()
	{
		var result = '';
		var disp_plan_name=$('#show_plan').val();
		var disp_plan_rate=$('#seat_rate').val();
		var no_seats=$('#show_seats').val();
		var GST = 0;
		var total = disp_plan_rate * no_seats;
		var stotal = total + GST;
		var disp_total = stotal.toFixed(2);

		 result +="<div class='price-details'><p class='amt-price'>"+disp_plan_name+"<span class='pull-right plan-amt'>"+disp_plan_rate+"</span></p><p class='total-price'>GST Tax :<span class='pull-right amt'>"+GST.toFixed(2)+"</span></p><p class='total-price'>Total Amount:<span class='pull-right amt'>"+disp_total+"</span></p><p><input type='submit' class='btn btn-primary btn-block btn-login' placeholder='Password' value='Continue' /></p><input type='hidden' name='no_seats' id='no_seats' value='"+no_seats+"' /><input type='hidden' name='total_amount' id='total_amount' value='"+disp_total+"' /><input type='hidden' name='user_id' id='user_id' value='<?php echo $user_id; ?>' /></div>";
		 $("#plan_summary").html(result).show();
	}
</script>
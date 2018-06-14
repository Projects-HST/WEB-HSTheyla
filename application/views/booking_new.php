<?php 
$user_id = $this->session->userdata('id');
foreach($event_details as $res){$event_id = $res->id;}
 ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery.galpop.css" media="screen" />
<script src="<?php echo base_url(); ?>assets/front/js/jquery.galpop.min.js"></script>
<div class="container-fluid event_details_bg">
  <div class="row event_details_bg_row">
    <div class="col-md-8">
        <img class="img-responsive" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" style="height:500px;width:100%;">

    </div>
    <div class="col-md-4">
      <div class="event_detail_thumb">
         <p class="event_heading"><?php echo $res->event_name; ?></p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/date.png"><span class="event_thumb"><?php echo date('d/m/Y',strtotime($res->start_date));?> - <?php echo date('d/m/Y',strtotime($res->end_date));?><span></p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/time.png"><span class="event_thumb"><?php echo $res->start_time;?> - <?php echo $res->end_time;?><span></p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/location.png"><span class="event_thumb"><?php echo $res->event_venue; ?><span></p>
      </div>

    </div>
  </div>
  
  <form method='post' action='<?php echo base_url(); ?>eventlist/event_booking' id='eventplan'>
  <div class="row event_details_bg_row">
  
    <div class="col-md-6">
       <div class="form-group">
            <p class="event_select_label">Select Date</p>
             <div class="col-sm-4">
				<?php if (!empty($booking_dates)){ ?>
                    <select class="form-control" id="show_date" onchange="disp_time()">
                    <option value="">Select Date</option>
                    <?php foreach($booking_dates as $res){ 
                    $originalDate = $res->show_date;
                    ?>
                       <option value="<?php echo $res->show_date; ?>"><?php echo  date("d-m-Y", strtotime($originalDate)) ?></option>
                    <?php } ?>
                    </select>
                    <?php }  else {
                    echo "No Dates Found";
                }?>
           </div>
       </div>
       
       <div id="plan_time"></div>
       <div id="plan_details"></div>
       <div id="plan_seats"></div>

    </div>

    <div class="col-md-6">
        <p class="event_select_label">Booking Summary Details</p>
        <div class="row" id="plan_summary">
        	
     	</div>
    </div>
    
  </div>
</form>
</div>
<script type="text/javascript">

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
			result +="<div class='form-group'><p class='event_select_label'>Select Time</p><div class='col-sm-4'><select class='form-control' id='show_time' onchange='disp_plan()'><option value=''>Select Time</option>";

			for (var i = 0; i < dataArray.length; i++){
				var id = dataArray[i].id;
				var show_time = dataArray[i].show_time;
				
				result +="<option value='"+show_time+"'>"+show_time+"</option>";
			};
				result +="</select></div></div>";

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
			
			result +="<div class='form-group'><p class='event_select_label'>Select Plan</p><div class='col-sm-4'><select class='form-control' id='show_plan' onchange='disp_seats()'><option value=''>Select Plan</option>";

			for (var i = 0; i < dataArray.length; i++){
				var plan_name = dataArray[i].plan_name;
				var plantime_id = dataArray[i].plantime_id;
			result +="<option value='"+plan_name+"'>"+plan_name+"</option>";
			};
			result +="</select></div></div>";

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
			result +="<div class='form-group'><p class='event_select_label'>Select Seats</p><div class='col-md-4'><select class='form-control' id='show_seats' onchange='plan_summary()'><option value=''>Select Seats</option>";
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
			result +="</select><input type='hidden' id='booking_date' name='booking_date' value='"+show_date+"' /><input type='hidden' id='event_id' name='event_id' value='"+event_id+"' /><input type='hidden' name='plan_id' id='plan_id' value='"+plan_id+"' /><input type='hidden' id='plan_name' value='"+plan_name+"' /><input type='hidden' name='plantime_id' id='plantime_id' value='"+plantime_id+"' /><input type='hidden' name='seat_rate' id='seat_rate' value='"+seat_rate+"' /></div></div>";

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
		var CGST = 0;
		var SGST = 0;
		var IHC = 0;
		var total = disp_plan_rate * no_seats;
		var stotal = total + CGST + SGST + IHC;
		var disp_total = stotal.toFixed(2);

		 result +="<div class='col-md-6'><p class='event_select_text'>Plan Name</p></div><div class='col-md-6'><p class='event_select_text'>"+disp_plan_name+"</p></div><div class='col-md-6'><p class='event_select_text'>Ticket Price</p></div><div class='col-md-6'><p class='event_select_text'>"+disp_plan_rate+"</p></div><div class='col-md-6'><p class='event_select_text'>No. of Seats</p></div><div class='col-md-6'><p class='event_select_text'>"+no_seats+"</p></div><div class='col-md-6'><p class='event_select_text'>Internet handling fees</p></div><div class='col-md-6'><p class='event_select_text'>"+IHC.toFixed(2)+"</p></div><div class='col-md-6'><p class='event_select_text'>CGST</p></div><div class='col-md-6'><p class='event_select_text'>"+CGST.toFixed(2)+"</p></div><div class='col-md-6'><p class='event_select_text'>SGST</p></div><div class='col-md-6'><p class='event_select_text'>"+SGST.toFixed(2)+"</p></div><div class='col-md-6 total_price'><p class='event_select_text'>Total Price</p></div><div class='col-md-2 total_price'><p class='event_select_text'>"+disp_total+"</p></div><div class='col-md-8'><input type='submit' class='btn book_tickets confirm_btn' value='Continue' /></p><input type='hidden' name='no_seats' id='no_seats' value="+no_seats+" /><input type='hidden' name='total_amount' id='total_amount' value="+disp_total+" /><input type='hidden' name='user_id' id='user_id' value='<?php echo $user_id; ?>' /></div>";
		 $("#plan_summary").html(result).show();
	} 
</script>
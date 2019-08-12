<?php
	$user_id = $this->session->userdata('id');
	if ($user_id==''){
		$redirect = current_url();;
		set_cookie('redirect_url',$redirect,'3600');
	}

	if (count($booking_planamount)>0){
		//echo count($booking_planamount);
		foreach($booking_planamount as $plan_amount_range){
			$mini_amount_range = $plan_amount_range->mini;
			$maxi_amount_range = $plan_amount_range->maxi;
		}
	}
?>

<style>
.pay_sum{
	font-size: 20px;
    font-weight: 600;
    margin-bottom: 25px;
}
.review_btn{
	padding: 10px 20px 10px 20px;
    border: 2px solid black;
    color: #2b2424;
    text-decoration: none;
    font-size: 16px;
		cursor: pointer;
}
.event_book{
	margin-top: 50px;
}
.event_book_tickets{
	color: #fff !important;
    font-size: 16px;
    font-weight: 500;
    padding: 10px 25px 10px 25px;
	background-color: #478ECC;
	border-radius: 10px;
}

.event_detail_desc{
	font-size: 16px;

}
.event_detail_title{
	color: #000;
	font-size: 20px;
	font-weight: 500;

}
.event_detail_date{
	font-size: 16px;
	color: #8e9398 ;
}
.btn-primary{
	padding: 10px 30px 10px 30px;
	font-size: 14px;

}
.booking_dialog{
  max-width:900px;

}
.booking_form{
	margin-top: 20px;
	padding: 30px;
}
.booking_section{
	padding-top:  20px;
	padding-bottom:  20px;
}
.user-rating {
	direction: rtl;
	font-size: 20px;
	unicode-bidi: bidi-override;
	padding: 10px 30px;
	display: inline-block;
	width: 500px;
}
.user-rating input {
	opacity: 0;
	position: relative;
	left: -15px;
	z-index: 2;
	cursor: pointer;
}
.user-rating span.star:before {
	color: #777777;
	content:"ï€†";
	/*padding-right: 5px;*/
}
.user-rating span.star {
	display: inline-block;
	font-family: FontAwesome;
	font-style: normal;
	font-weight: normal;
	position: relative;
	z-index: 1;
}
.user-rating span {
	margin-left: -15px;
}
.user-rating span.star:before {
	color: #777777;
	content:"\f006";
	/*padding-right: 5px;*/
}
.user-rating input:hover + span.star:before, .user-rating input:hover + span.star ~ span.star:before, .user-rating input:checked + span.star:before, .user-rating input:checked + span.star ~ span.star:before {
	color: #ffd100;
	content:"\f005";
}

.user-rating span.selected-rating{
	color: #ffd100;
	font-size: 20px;
}

span.fa.fa-star.checked{
	color: yellow;

}


#galpop-content img{
  width:100%;
}
.event_heading{
	margin-top: 15px;
}
</style>
<?php
$user_id = $this->session->userdata('id');

foreach($event_details as $res){
			$disp_event_id = $res->id;
			$event_id = $res->id * 564738;
			$event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
			$enc_event_id = base64_encode($event_id);
			$wlstatus = $res->wlstatus;
			$hotspot_status = $res->hotspot_status;
			$event_latitude =  $res->event_latitude;
			$event_longitude = $res->event_longitude;
			$event_type = $res->event_type;

			if ($wlstatus!= '') {
					$wlstatusstatus = "<span class='pull-right' id='wishlist".$disp_event_id."'><a href='javascript:void(0);' onclick='editwishlist(".$user_id.",".$disp_event_id.");'><img src='".base_url()."assets/front/images/fav-select.png' class='pull-right'></a></span>";
			} else {
					$wlstatusstatus = "<span class='pull-right' id='wishlist".$disp_event_id."'><a href='javascript:void(0);' onclick='editwishlist(".$user_id.",".$disp_event_id.");'><img src='".base_url()."assets/front/images/fav-unselect.png' class='pull-right'></a></span>";
			}
}
?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery.galpop.css" media="screen" />
<script src="<?php echo base_url(); ?>assets/front/js/jquery.galpop.min.js"></script>
<div class="container-fluid event_details_bg">
  <div class="row event_details_bg_row">
    <div class="col-md-8">
    	<img class="d-block w-100" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" style="height:500px;width:100%;">

    </div>
    <div class="col-md-4">
      <div class="event_detail_thumb">
				<?php if ($hotspot_status == 'N') { ?>
					<p><span class="event_thumb event_detail_date">
					<?php echo date('d-M-Y',strtotime($res->start_date));?> - <?php echo date('d-M-Y',strtotime($res->end_date));?></span></p><?php } ?>
					<?php if ($user_id!= '') { echo "<p>";echo $wlstatusstatus; echo "</p>";} ?>
					<p class="event_detail_title  "><?php echo $res->event_name; ?></p>


         <p><img src="<?php echo base_url(); ?>assets/front/images/time.png"><span class="event_thumb event_detail_date"><?php echo $res->start_time;?> - <?php echo $res->end_time;?></span></p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/location.png"><span class="event_thumb event_detail_date event_deetail_venue"><?php echo $res->event_venue; ?></span></p>
		 <p><a href="http://maps.google.com/maps?z=12&t=m&q=loc:<?php echo $event_latitude;?>+<?php echo $event_longitude;?>" target="_blank"> View Location</a> </p>
		 <?php if(is_null($mini_amount_range)){
				echo "";
			} else {
			?>
				<p><span class="event_thumb event_detail_date event_deetail_venue">₹<?php echo $mini_amount_range; ?> - ₹<?php echo $maxi_amount_range; ?></span></p>
		<?php } ?>
		 <p>
		 <?php if ($event_type == 'Paid'){ ?>
			<img src='<?php echo base_url(); ?>assets/front/images/paid.png'>
		<?php } else { ?>
			<img src='<?php echo base_url(); ?>assets/front/images/free.png'>
		<?php } ?>
		</p>
      </div>
      <div class="event_booking_section">
      <?php if ($res->booking_status =='Y') { ?>
				<?php if ($user_id==''){ ?>
					<p class="text-center event_book"><a href="#" onclick="session_check()" class="event_book_tickets">Book Your Tickets</a></p>
				<?php } else { ?>
					<p class="text-center event_book"><a href="#" onclick="session_check()" class="event_book_tickets" data-toggle="modal" data-target="#bookingmodel" >Book Your Tickets</a></p>
				<?php } ?>
		<?php } ?>
      </div>


      <div class="event_detail_thumb">
         <p class="event_heading">Share with your Friends</p>
         <p>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" title="Share on Facebook"><img src="<?php echo base_url(); ?>assets/front/images/share_facebook.png"></a>
            <a href="https://web.whatsapp.com/send?text=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" data-action="share/whatsapp/share" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" title="Share on WhatsApp"><img src="<?php echo base_url(); ?>assets/front/images/share_whatsapp.png"></a>
            <a href="https://twitter.com/share?&text=<?php echo $res->event_name; ?>&url=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" ><img src="<?php echo base_url(); ?>assets/front/images/share_twitter.png"></a>
			<!--<a href="https://plus.google.com/share?url=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" title="Share on Google+"><img src="<?php echo base_url(); ?>assets/front/images/share_instagram.png"></a>-->
         </p>
      </div>


    </div>
		<div class="col-md-12">
			<p class="event_heading">Description</p>
			<p class="event_detail_desc"><?php echo nl2br($res->description); ?></p>
			<?php if (!empty($event_gallery)){ ?>

			      <div class="event_detail_thumb">
			         <p class="event_heading">Gallery</p>
			         <?php foreach($event_gallery as $gallery_img){ ?>
			         <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/events/gallery/<?php echo $gallery_img->event_image; ?>"><img src="<?php echo base_url(); ?>assets/events/gallery/<?php echo $gallery_img->event_image; ?>" class="img-responsive  img_gallery"></a>
			         <?php } ?>
			      </div>
			 <?php } ?>
			<!--<p class="event_heading">Location</p>

			<div id="map" class="map"></div>-->

			<p class="event_heading">Review</p>
			<hr>
			<?php
				if (!empty($event_reviews)){ ?>
			 		<div class="event_detail_thumb">
			 <?php
					foreach($event_reviews as $result){
						 $ratings = $result->event_rating;
			?>
			          <div class="review_section">
			            <p class="review_name"><?php echo $result->user_name; ?>
			              <span class="rated_star">
			              	<?php
			                     for ($i=1; $i <6; $i++)
			            			{
										if ($i <= $ratings){
											echo "<img src='".base_url()."assets/front/images/rated.png' class='img-responsive'>";
										} else {
											echo "<img src='".base_url()."assets/front/images/unrated.png' class='img-responsive'>";
										}
									}
								?>
			              </span>
			            </p>
			            <p class="review_desc"><?php echo $result->comments;?></p>
			            </div>
			 <?php
					}
					?>
			        </div>
			 <?php
				}
			?>
			      <div class="event_booking_section">
			        <p><?php if (empty($event_reviews)){?>Be the first one to Review ! Share Your experience<?php } ?><a  onclick="session_check()" class="review_btn pull-right" data-toggle="modal" data-target="#reviewModal">Write a review</a></p>
			      </div>

		</div>
  </div>
</div>

<div class="modal fade" id="bookingmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog booking_dialog" role="document">
    <div class="modal-content booking_section">
	<form method='post' action='<?php echo base_url(); ?>eventlist/event_booking' id='eventplan'>
				<center><img src="<?php echo base_url(); ?>assets/front/images/heyla_logo.png" style="width:150px;"></center>
					<center><h2>Book Your Tickets</h2></center>
		<div class="row booking_form">
		<?php if (!empty($booking_dates)){ ?>
				<div class="col-md-3">

					 <label class="form-label">Select Date</label>
						<select class="form-control" id="show_date" onchange="disp_time()">
						<option value="">Select Date</option>
						<?php foreach($booking_dates as $res){
							$originalDate = $res->show_date;
						?>
						   <option value="<?php echo $res->show_date; ?>"><?php echo  date("d-m-Y", strtotime($originalDate)) ?></option>
						<?php } ?>
						</select>
				</div>
				<div class="col-md-3" id="plan_time"><label class="form-label">Select Time</label><select class="form-control" id="show_time"><option value="">Select Time</option></select></div>
				<div class="col-md-3" id="plan_details"><label class="form-label">Select Plan</label><select class="form-control" id="show_time"><option value="">Select Plan</option></select></div>
				<div class="col-md-3" id="plan_seats"><label class="form-label">Select Seats</label><select class="form-control" id="show_time"><option value="">Select Seats</option></select></div>
				<div class="row" style="padding-top:20px;" id="plan_summary"></div>
				<?php }  else {
						echo "No Dates Found";
					}?>
		</div>
	 </form>
  </div>
   </div>
 </div>
 <div class="modal fade " id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="false">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header">
   <h4 class="modal-title">Write Review</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 </div>
 <div class="modal-body" id="modal-body">
   <center>

	<?php if (count($event_reviews_users)>0){
		foreach($event_reviews_users as $reviewres){
			$review_id = $reviewres->id;
			$event_rating = $reviewres->event_rating;
			$comments = $reviewres->comments;
		}?>

	<form name="frmReview" id="" action="#" method="post" enctype="multipart/form-data" class="form" autocomplete="off">
       <div class="form-group row">
       <div class="col-lg-12">
           <div class="rating">
             <span class="user-rating">

			 <?php
				for ($i=1; $i <6; $i++)
				//$y = 5;
				{
					if ($i <= $event_rating){
						echo '<input type="radio" name="rating" id="rating_'.$i.'" value="'.$i.'" checked><span class="star"></span>';
					} else {
						echo '<input type="radio" name="rating" id="rating_'.$i.'" value="'.$i.'"><span class="star"></span>';
					}
				}
			?>
             </span>
           </div>
         </div>
       </div>
       <div class="form-group row">
         <div class="col-lg-12">
           <textarea type="text" name="message" id="message"  class="form-control" maxlength="240" placeholder="Max 240 Characters"><?php echo $comments; ?></textarea>
         </div>
       </div>
       <div class="form-group row">
         <div class="col-lg-12">
 			<input type="hidden" name="event_id" id="event_id" value="<?php echo $disp_event_id; ?>" />
			<input type="hidden" name="event_id" id="review_id" value="<?php echo $review_id; ?>" />
 			<input type="button" id="review_update" value="Update Review" placeholder="Message" class="btn btn-primary btn-login">
         </div>
       </div>
    </form>

	<?php } else { ?>

	<form name="frmReview" id="" action="#" method="post" enctype="multipart/form-data" class="form" autocomplete="off">
       <div class="form-group row">
       <div class="col-lg-12">
           <div class="rating">
             <span class="user-rating">
             <input type="radio" name="rating" id="rating_1" value="5"><span class="star"></span>
             <input type="radio" name="rating" id="rating_2" value="4"><span class="star"></span>
             <input type="radio" name="rating" id="rating_3" value="3"><span class="star"></span>
             <input type="radio" name="rating" id="rating_4" value="2"><span class="star"></span>
             <input type="radio" name="rating" id="rating_5" value="1"><span class="star"></span>
             </span>
           </div>
         </div>
       </div>
       <div class="form-group row">
         <div class="col-lg-12">
           <textarea type="text" name="message" id="message" maxlength="240" placeholder="Max 240 Characters" class="form-control"></textarea>
         </div>
       </div>
       <div class="form-group row">
         <div class="col-lg-12">
 			<input type="hidden" name="event_id" id="event_id" value="<?php echo $disp_event_id; ?>" />
 			<input type="button" id="review_add" value="Submit Review" placeholder="Message" class="btn btn-primary btn-login">
         </div>
       </div>
    </form>

	<?php } ?>


   </center>
 </div>

 </div>
 </div>
 </div>

<script>

	var time_result ="<label class='form-label'>Select Time</label><select class='form-control' id='show_time'><option value=''>Select Time</option>";
	var plan_result ="<label class='form-label'>Select Plan</label><select class='form-control' id='show_plan'><option value=''>Select Plan</option>";
	var seat_result ="<label class='form-label'>Select Seats</label><select class='form-control' id='show_seats'><option value=''>Select Seats</option>";

	function session_check()
	{
		  var user_id ='<?php echo $this->session->userdata('id');?>';
		  if (user_id ==''){
			redirect_url = '<?php echo base_url(); ?>signin/';
			window.location.replace(redirect_url);
		  }
	}

  	function disp_time()
	{
		$('#show_plan').prop('selectedIndex',0);
		$('#show_seats').prop('selectedIndex',0);

		$('#plan_summary').hide()
		var plan_date=$('#show_date').val();
		var result = '';

		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/plantiming',
		type: 'POST',
		data: {event_id : <?php echo $disp_event_id; ?>,plan_date : plan_date},
		success: function(data) {
		var dataArray = JSON.parse(data);

		if (dataArray.length>0) {
			result +="<label class='form-label'>Select Time</label><select class='form-control' id='show_time' onchange='disp_plan()'><option value=''>Select Time</option>";


			for (var i = 0; i < dataArray.length; i++){
				var id = dataArray[i].id;
				var show_time = dataArray[i].show_time;

				result +="<option value='"+show_time+"'>"+show_time+"</option>";
			};
				result +="</select>";

			$("#plan_time").html(result).show();
			$("#show_plan").html(plan_result).show();
			$("#show_seats").html(seat_result).show();
		} else {
			//result +="No Records found!..";
			$("#plan_time").html(time_result).show();
			$("#show_plan").html(plan_result).show();
			$("#show_seats").html(seat_result).show();

		}
		}
		});
	}

	 function disp_plan()
	{
		$('#plan_summary').hide()
		$('#show_seats').prop('selectedIndex',0);

		var show_date=$('#show_date').val();
		var show_time=$('#show_time').val();

		var result = '';
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/plandetails',
		type: 'POST',
		data: {event_id : <?php echo $disp_event_id; ?>,show_date : show_date,show_time : show_time},
		success: function(data) {
		var dataArray = JSON.parse(data);

		if (dataArray.length>0) {

			result +="<label class='form-label'>Select Plan</label><select class='form-control' id='show_plan' onchange='disp_seats()'><option value=''>Select Plan</option>";

			for (var i = 0; i < dataArray.length; i++){
				var plan_name = dataArray[i].plan_name;
				var plantime_id = dataArray[i].plantime_id;
			result +="<option value='"+plan_name+"'>"+plan_name+"</option>";
			};
			result +="</select>";

			$("#plan_details").html(result).show();
			$("#show_seats").html(seat_result).show();

		} else {
			$("#show_plan").html(plan_result).show();
			$("#show_seats").html(seat_result).show();;
		}

		}
		});
	}

	 function disp_seats()
	{
		$('#plan_summary').hide()
		$('#show_seats').prop('selectedIndex',0);

		var show_date=$('#show_date').val();
		var show_time=$('#show_time').val();
		var show_plan = $('#show_plan').val();

		var result = '';
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/seatdetails',
		type: 'POST',
		data: {event_id : <?php echo $disp_event_id; ?>,show_date : show_date,show_time : show_time,show_plan : show_plan},
		success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			result +="<label class='form-label'>Select Seats</label><select class='form-control' id='show_seats' onchange='plan_summary()'><option value=''>Select Seats</option>";
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
			result +="</select><input type='hidden' id='booking_date' name='booking_date' value='"+show_date+"' /><input type='hidden' id='event_id' name='event_id' value='"+event_id+"' /><input type='hidden' name='plan_id' id='plan_id' value='"+plan_id+"' /><input type='hidden' id='plan_name' value='"+plan_name+"' /><input type='hidden' name='plantime_id' id='plantime_id' value='"+plantime_id+"' /><input type='hidden' name='seat_rate' id='seat_rate' value='"+seat_rate+"' />";

			$("#plan_seats").html(result).show();

		} else {
			$('#plan_summary').hide()
			$("#show_seats").html(seat_result).show();;
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
		//var CGST = 0;
		//var SGST = 0;
		//var IHC = 0;
		//var stotal = total + CGST + SGST + IHC;
		var total = disp_plan_rate * no_seats;
		var disp_total = total.toFixed(2);


		// result +="<div class='col-md-6'><p class='event_select_text'>Plan Name</p></div><div class='col-md-6'><p class='event_select_text'>"+disp_plan_name+"</p></div><div class='col-md-6'><p class='event_select_text'>Ticket Price</p></div><div class='col-md-6'><p class='event_select_text'>₹ "+disp_plan_rate+"</p></div><div class='col-md-6'><p class='event_select_text'>No. of Seats</p></div><div class='col-md-6'><p class='event_select_text'>"+no_seats+"</p></div><div class='col-md-6 total_price'><p class='event_select_text'>Total Price</p></div><div class='col-md-6 total_price'><p class='event_select_text'>₹ "+disp_total+"</p></div><div class='col-md-12'><input type='submit' class='btn book_tickets confirm_btn' value='Continue' /></p><input type='hidden' name='no_seats' id='no_seats' value="+no_seats+" /><input type='hidden' name='total_amount' id='total_amount' value="+disp_total+" /><input type='hidden' name='user_id' id='user_id' value='<?php echo $user_id; ?>' /></div>";
		result +="<div class='row'><div class='col-md-12'><center><p class='pay_sum'>Payment Summary</p></center></div><div class='col-md-3'></div><div class='col-md-3'> <p class='event_select_text'>Plan Name</p></div><div class='col-md-2'> <p class='event_select_text'>"+disp_plan_name+"</p></div><div class='col-md-4'></div><div class='col-md-3'></div><div class='col-md-3'> <p class='event_select_text'>Ticket Price</p></div><div class='col-md-2'> <p class='event_select_text'>₹ "+disp_plan_rate+"</p></div><div class='col-md-4'></div><div class='col-md-3'></div><div class='col-md-3'><p class='event_select_text'>No. of Seats</p></div><div class='col-md-2'> <p class='event_select_text'>"+no_seats+"</p></div><div class='col-md-4'></div><div class='col-md-3'></div><div class='col-md-3 total_price'> <p class='event_select_text'>Total Price</p></div><div class='col-md-2 total_price'> <p class='event_select_text'>₹ "+disp_total+"</p></div><div class='col-md-4'></div></div><div class='col-md-12'><center><input type='submit' class='btn book_tickets confirm_btn' value='Continue'/></center> </p><input type='hidden' name='no_seats' id='no_seats' value="+no_seats+"><input type='hidden' name='total_amount' id='total_amount' value="+disp_total+"><input type='hidden' name='user_id' id='user_id' value='<?php echo $user_id; ?>'></div>";

		 $("#plan_summary").html(result).show();
	}
</script>
<div>



</div>

<script>
/*
	function initMap() {
		  //var uluru = {lat: 11.002598, lng: 77.016933};
		  var uluru = {lat: <?php echo $event_latitude; ?>, lng: <?php echo $event_longitude; ?>};
		  var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: uluru
		  });
		  var marker = new google.maps.Marker({
			position: uluru,
			map: map
		  });
	}
*/

	function editwishlist(user_id,event_id)
	{
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/eventwishlist',
		type: 'POST',
		data: {user_id : user_id,event_id : event_id},
		success: function(data) {
			var dataArray = JSON.parse(data);
			if (dataArray =='Added'){
				$('#wishlist' + event_id).html("<span class='pull-right favourite-icon' id='wishlist"+event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-select.png' alt=''></a></span>").show();
			} else {
				$('#wishlist' + event_id).html("<span class='pull-right favourite-icon' id='wishlist"+event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' alt=''></a></span>").show();
			}
		}
		});
	}

	function sharepoints(user_id,event_id)
	{
		var user_id ='<?php echo $this->session->userdata('id');?>';
		  if (user_id !=''){

			$.ajax({
			url: '<?php echo base_url(); ?>eventlist/eventsharing',
			type: 'POST',
			data: {user_id : user_id,event_id : event_id},
			success: function(data) {
				var dataArray = JSON.parse(data);
			}
			});
		  }
	}



	$('#review_update').on('click', function() {
		var result = '';
		var form_data = new FormData();
		var rating=$('input[name=rating]:checked').val();
		var message=$('#message').val();
		var review_id=$('#review_id').val();
		var event_id=$('#event_id').val();

		if (message == '') {
			alert("Enter Message");
			return false;
		}

		form_data.append('rating', rating);
		form_data.append('message', message);
		form_data.append('event_id', event_id);
		form_data.append('review_id', review_id);

         $.ajax({
			 url         : '<?php echo base_url(); ?>eventlist/updatereview',     // point to server-side PHP script
			 dataType    : 'text',           // what to expect back from the PHP script, if anything
			 cache       : false,
			 contentType : false,
			 processData : false,
			 data        : form_data,
			 type        : 'post',
			 success     : function(result){
				 if (result=='OK'){
					  swal({
						title: "success",
						text: " Review Updated.",
						type: "success"
						}).then(function() {
						location.reload();
						});
				 }
			}
          });
    });


	$('#review_add').on('click', function() {
		var result = '';
		var form_data = new FormData();
		var rating=$('input[name=rating]:checked').val();
		var message=$('#message').val();
		var event_id=$('#event_id').val();

		if (message == '') {
			alert("Enter Message");
			return false;
		}

		form_data.append('rating', rating);
		form_data.append('message', message);
		form_data.append('event_id', event_id);
		//alert(form_data);
         $.ajax({
			 url         : '<?php echo base_url(); ?>eventlist/addreview',     // point to server-side PHP script
			 dataType    : 'text',           // what to expect back from the PHP script, if anything
			 cache       : false,
			 contentType : false,
			 processData : false,
			 data        : form_data,
			 type        : 'post',
			 success     : function(result){
				 if (result=='OK'){
					  swal({
						title: "success",
						text: " Review Added.",
						type: "success"
						}).then(function() {
						location.reload();
						});
				 }
			}
          });
    });

	$(document).ready(function() {
    	$('.galpop-multiple').galpop();
    	var callback = function() {
    		var wrapper = $('#galpop-wrapper');
    		var info    = $('#galpop-info');
    		var count   = wrapper.data('count');
    		var index   = wrapper.data('index');
    		var current = index + 1;
    		var string  = 'Image '+ current +' of '+ count;
    		info.append('<p>'+ string +'</p>').fadeIn();
    	};
    	$('.galpop-callback').galpop({
    		callback: callback
    	});

    	$('.manual-open').change(function(e) {
    		var image = $(this).val();
    		if (image) {
    			var settings = {};
    			$.fn.galpop('openBox',settings,image);
    		}
    	});
    });
</script>
<!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZLXcA6pQcEJA_iE0xX5XA_ObPQ4ww1eM&callback=initMap"></script>-->

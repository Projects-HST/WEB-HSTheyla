<?php
$user_id = $this->session->userdata('id');
foreach($event_details as $res){
			$disp_event_id = $res->id;
			$event_id = $res->id * 564738;
			$event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
			$enc_event_id = base64_encode($event_id);
			$wlstatus = $res->wlstatus;
			$hotspot_status = $res->hotspot_status;
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
				<?php if ($hotspot_status == 'N') { ?><p><span class="event_thumb event_detail_date">
					<?php echo date('d-M-Y',strtotime($res->start_date));?> - <?php echo date('d-M-Y',strtotime($res->end_date));?><span></p><?php } ?>
         <p class="event_detail_title  "><?php echo $res->event_name; ?><?php if ($user_id!= '') { echo $wlstatusstatus; } ?></p>

         <p><img src="<?php echo base_url(); ?>assets/front/images/time.png"><span class="event_thumb event_detail_date"><?php echo $res->start_time;?> - <?php echo $res->end_time;?><span></p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/location.png"><span class="event_thumb event_detail_date event_deetail_venue"><?php echo $res->event_venue; ?><span></p>
      </div>
      <div class="event_booking_section">
      <?php if ($res->booking_status =='Y') { ?>
				<p><a href="<?php echo base_url(); ?>eventlist/booking/<?php echo $enc_event_id; ?>/" class="btn-block book_tickets">Book Your Tickets</a></p>
				<p class="text-center event_book"><a  class=" event_book_tickets" data-toggle="modal" data-target="#bookingmodel">Book Your Tickets</a></p>
				<p class="text-center"><a  class="btn-block book_tickets" data-toggle="modal" data-target="#ordermodel">Order Summary</a></p>
		<?php } ?>
      </div>



      <?php if ($user_id !='') { ?>

      <div class="event_detail_thumb">
         <p class="event_heading">Share with your Friends</p>
         <p>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" title="Share on Facebook"><img src="<?php echo base_url(); ?>assets/front/images/share_facebook.png"></a>
            <a href="https://plus.google.com/share?url=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" title="Share on Google+"><img src="<?php echo base_url(); ?>assets/front/images/share_googleplus.png"></a>
            <a href="https://twitter.com/share?&text=<?php echo $res->event_name; ?>&url=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" ><img src="<?php echo base_url(); ?>assets/front/images/share_twitter.png"></a>
						  <a href="https://plus.google.com/share?url=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" title="Share on Google+"><img src="<?php echo base_url(); ?>assets/front/images/share_instagram.png"></a>
         </p>
      </div>
      <?php } ?>




    </div>
		<div class="col-md-12">
			<p class="event_heading">Description</p>
			<p class="address_form"><?php echo nl2br($res->description); ?></p>
			<?php if (!empty($event_gallery)){ ?>

			      <div class="event_detail_thumb">
			         <p class="event_heading">Gallery</p>
			         <?php foreach($event_gallery as $gallery_img){ ?>
			         <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/events/gallery/<?php echo $gallery_img->event_image; ?>"><img src="<?php echo base_url(); ?>assets/events/gallery/<?php echo $gallery_img->event_image; ?>" class="img-responsive  img_gallery"></a>
			         <?php } ?>
			      </div>
			 <?php } ?>
			<p class="event_heading">Location</p>

			<div id="map" class="map"></div>

			<p class="event_heading">Review</p>
			<hr>

			<?php

				if (!empty($event_reviews)){ ?>
			 		<div class="event_detail_thumb">
			         <p class="event_heading">Review</p>
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

				 <?php if ($user_id !='') { ?>
			      <div class="event_booking_section">
			        <p class="">
								<img src="<?php echo base_url(); ?>assets/front/images/write_review.png">
							 &nbsp; &nbsp; &nbsp; &nbsp; 	Be the first one to Review ! Share Your experience
								<a href="" class="review_btn pull-right" data-toggle="modal" data-target="#myModal">Write a review</a></p>
			      </div>
			      <?php } ?>
		</div>
  </div>
</div>

<div class="modal fade modal-lg " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h4 class="modal-title">Write Review</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body" id="modal-body">
  <center>
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
        <input type="hidden" name="event_id" id="event_id" value="<?php echo $disp_event_id; ?>" />
          <textarea type="text" name="message" id="message" placeholder="Message" class="form-control"></textarea>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-lg-12">
                      <input type="hidden" name="event_id" id="event_id" value="" />
          <input type="button" id="upload" value="Submit Review" placeholder="Message" class="btn btn-primary btn-login">
        </div>
      </div>
    </form>
  </center>
</div>

</div>
</div>
</div>
<div class="modal fade" id="ordermodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog order_dialog" role="document">
    <div class="modal-content booking_section">
				<center><img src="<?php echo base_url(); ?>assets/front/images/heyla_logo.png" style="width:150px;"></center>
					<center><h2>Order Summary</h2></center>
      <div class="row ">

				<div class="col-md-12 summary_card">
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Order id</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Order id</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Event Name</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Event Name</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Category Name</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Category</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Event Venue</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Event</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Event Address</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Address</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Event Show date</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Show date</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Event Show time</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Event Show time</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Booking Plan</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Booking</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Booking Seats</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Booking</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-5"><p class="summary_label summary_text">Booking Amount</p></div>
				    <div class="col-md-1 text-center"><p class="summary_text">:</p></div>
				    <div class="col-md-6"><p class="summary_text">Booking</p></div>
				  </div>
				  <div class="row">
				    <div class="col-md-12 text-center" style="margin-top:20px;">
				     <form method="post" name="customerData"  class="confirm_process" action="http://hobbistan.com/web/ccavenue/ccavRequestHandler.php">
				                    <input type="hidden" name="merchant_id" value="89958"/>
				                    <input type="hidden" name="order_id" value="order_id"/>
				                    <input type="hidden" name="amount" value="total_amount"/>
				                    <input type="hidden" name="currency" value="INR"/>
				                    <input type="hidden" name="redirect_url" value="http://hobbistan.com/web/ccavenue/ccavResponseHandler.php"/>
				                    <input type="hidden" name="cancel_url" value="https://heylaapp.com/eventlist/"/>
				                    <input type="hidden" name="language" value="EN"/>
				                    <INPUT type="submit" value="CheckOut" class="btn btn-primary">
				            </form>
				    </div>

				  </div>


				</div>

    </div>

    </div>
  </div>
</div>

<div class="modal fade" id="bookingmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog booking_dialog" role="document">
    <div class="modal-content booking_section">
				<center><img src="<?php echo base_url(); ?>assets/front/images/heyla_logo.png" style="width:150px;"></center>
					<center><h2>Book Your Tickets</h2></center>
      <div class="row booking_form">
    	<div class="col-md-3">
				  <label class="form-label">Select City</label>
					<select class="form-control" name="event_type" id="event_type" onchange="gettypeevents();">
						<option value="">Select Type</option>
						<option value="1">General</option>
						<option value="2">Hotspot</option>
					</select>

		 	</div>
      <div class="col-md-3">
				<label class="form-label">Select City</label>
				<select class="form-control" name="event_type" id="event_type" onchange="gettypeevents();">
					<option value="">Select Type</option>
					<option value="1">General</option>
					<option value="2">Hotspot</option>
				</select>
			</div>
			<div class="col-md-3">
				<label class="form-label">Select City</label>
				<select class="form-control" name="event_type" id="event_type" onchange="gettypeevents();">
					<option value="">Select Type</option>
					<option value="1">General</option>
					<option value="2">Hotspot</option>
				</select>
			</div>
      <div class="col-md-3">
				<label class="form-label">Select City</label>
				<select class="form-control" name="event_type" id="event_type" onchange="gettypeevents();">
					<option value="">Select Type</option>
					<option value="1">General</option>
					<option value="2">Hotspot</option>
				</select>
			</div>
    </div>
		<center>  <input type="button" id="upload" value="Book Now" placeholder="Message" class="btn btn-primary btn-login"></center>
    </div>
  </div>
</div>
<style>
.review_btn{
		padding: 10px 20px 10px 20px;
    border: 2px solid black;
    color: #2b2424;
    text-decoration: none;
    font-size: 16px;
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

.event_detail_title{
	color: #000;
	font-size: 22px;
	font-weight: 500;

}
.event_detail_date{
	font-size: 16px;

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
<script>
function initMap() {
      //var uluru = {lat: 11.002598, lng: 77.016933};
	  var uluru = {lat: <?php echo $res->event_latitude; ?>, lng: <?php echo $res->event_longitude; ?>};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: uluru
      });
      var marker = new google.maps.Marker({
        position: uluru,
        map: map
      });
}
	$('#user-rating-form').on('change','[name="rating"]',function(){
		$('#selected-rating').text($('[name="rating"]:checked').val());
	});

	$('.carousel').carousel({
		  interval:4000,
		  pause: "false"
	})

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
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/eventsharing',
		type: 'POST',
		data: {user_id : user_id,event_id : event_id},
		success: function(data) {
			var dataArray = JSON.parse(data);
		}
		});
	}

$('#upload').on('click', function() {
		var result = '';
		var form_data = new FormData();
		//var rating= $("input[name=rating]").val();
		//var name = '';
		var rating=$('input[name=rating]:checked').val();
		var message=$('#message').val();
		var event_id=$('#event_id').val();
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZLXcA6pQcEJA_iE0xX5XA_ObPQ4ww1eM&callback=initMap"></script>

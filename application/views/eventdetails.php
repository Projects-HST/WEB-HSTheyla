<?php $user_id = $this->session->userdata('id'); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container-fluid eventdetail-pge">
<div class="container">
<div class="row">
<div class="carousel carousel-fade" data-ride="carousel" data-interval="2000">
	<div class="carousel-inner" role="listbox">
	<?php
	//print_r($event_gallery);
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
		<?php foreach($event_details as $res){
			$disp_event_id = $res->id;
			$event_id = $res->id * 564738;
			$event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
			$enc_event_id = base64_encode($event_id);
		} ?>
		<div class="row booking-section">
			<div class="col-md-10">
				<div class="event-heading">
					<p class="event-heading-text"><?php echo $res->event_name; ?></p>
				</div>
			</div>
			<div class="col-md-2">
			<?php if ($res->booking_status =='Y') { ?>
				<p><a href="<?php echo base_url(); ?>eventlist/booking/<?php echo $enc_event_id; ?>/" class="btn btn-primary btn-login">Book Now</a></p>
			<?php } ?>
			</div>
		</div>

        <section class="row event-details-desc">
			<div class="col-md-6">
				<p class="event-desc">Description</p>
				<p class="event-desc-details"><?php echo nl2br($res->description); ?></p>
			</div>
			<div class="col-md-3">
				<p class="event-desc">Date and Time</p>
				<p class="event-desc-details"><?php echo date('d/m/Y',strtotime($res->start_date));?> <?php echo $res->start_time;?> <br /> to  <br /><?php echo date('d/m/Y',strtotime($res->end_date)); ?> <?php echo $res->end_time;?></p>
				<p class="event-desc">Venue</p>
				<p class="event-desc-details"><b><?php echo $res->event_venue; ?></b> <br /><?php echo $res->event_address; ?></p>
			</div>
            <div class="col-md-3">
            <p class="event-desc">Contact</p>
				<p class="event-desc-details"><?php echo $res->contact_person; ?><br /><?php echo $res->primary_contact_no; ?><br /><?php echo $res->contact_email; ?></p>
                <?php if ($user_id !='') { ?>
				<p class="event-desc">Sharing</p>
				<ul class="share-buttons">
				  <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/&redirect_uri=https://developers.facebook.com/tools/explorer" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" title="Share on Facebook"><img alt="Sharing" src="<?php echo base_url(); ?>assets/images/Facebook.svg" /></a></li>
				  <li><a href="https://plus.google.com/share?url=<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" onclick="sharepoints(<?php echo $user_id; ?> ,<?php echo $disp_event_id; ?>)" target="_blank" title="Share on Google+"><img alt="Share on Google+" src="<?php echo base_url(); ?>assets/images/Google+.svg" /></a></li>
				</ul>
				 <p><a class="btn btn-login btn-primary btn-block review-btn" data-toggle="modal" data-target="#myModal" data-original-title>Wite a  Review</a> </p>
<?php } ?>
            </div>
		</section>

        <section class="row">
			<div class="col-md-12">
				<p class="event-desc">Location</p>
				<div id="map" class="map"></div>
			</div>
		</section>


<?php
	if (!empty($event_reviews)){
?>
<section class="row">
	<div class="col-md-12">
		<p class="event-desc">User Reviews</p>
        <?php foreach($event_reviews as $result){
				 $ratings = $result->event_rating;
		?>
		<div class="row">
		<div class="col-md-12">
			<div class="rating">
					<span class="user-rating" style="direction:ltr;padding:0px 10px 0px 10px;">
                    <?php
                     for ($i=1; $i <6; $i++)
            			{
							if ($i <= $ratings){
								echo "<span style='margin:1px;'><img src='".base_url()."assets/front/images/rated.png'></span>";
							} else {
								echo "<span style='margin:1px;'><img src='".base_url()."assets/front/images/unrated.png'></span>";
							}
						}
					?>
					</span>
				</div>
			<p  style="margin-left:10px;"><b><?php echo $result->user_name; ?></b></p>
			<p style="margin-left:10px;"><?php echo $result->comments;?></p>
			</div>

		</div>
       	<?php } ?>
	</div>
</section>
 <?php } ?>

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
							<textarea type="text" name="message" id="message" placeholder="Message" class="form-control"></textarea>
						</div>
					</div>
                    <!--<div class="form-group row">
						<div class="col-lg-12">
                        <input type="file" name="reviewimage" id="reviewimage" class="form-control" accept="image/*" >
						</div>
					</div>-->
					<div class="form-group row">
						<div class="col-lg-12">
                        	<input type="hidden" name="event_id" id="event_id" value="<?php echo $disp_event_id; ?>" />
							<input type="button" id="upload" value="Submit Review" placeholder="Message" class="btn btn-primary btn-login">
						</div>
					</div>
				</form>
			</center>
		</div>

		</div>
		</div>
		</div>

	</div>
</div>

<style>
ul.share-buttons{
  list-style: none;
  padding: 0;
}
ul.share-buttons li{
  display: inline;
}

ul.share-buttons .sr-only{
  position: absolute;
  clip: rect(1px 1px 1px 1px);
  clip: rect(1px, 1px, 1px, 1px);
  padding: 0;
  border: 0;
  height: 1px;
  width: 1px;
  overflow: hidden;
}

ul.share-buttons img{
  width: 32px;
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
.modal-lg{
   max-width: 80% !important;
}
.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}
.modal-body{
  padding-top:30px;
  padding-bottom:30px;
  padding-left: 20px;
  padding-right: 20px;
  border-radius: 20px;
}
.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
.modal{
	left: 30%;
}
.carousel-fade .carousel-inner, .carousel-fade .carousel-item{
	height: 387px;
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
function initMap() {
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


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZLXcA6pQcEJA_iE0xX5XA_ObPQ4ww1eM&callback=initMap"></script>

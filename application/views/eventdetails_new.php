<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery.galpop.css" media="screen" />
<script src="<?php echo base_url(); ?>assets/front/js/jquery.galpop.min.js"></script>
<div class="container-fluid event_details_bg">
  <div class="row event_details_bg_row">
    <div class="col-md-8">
        <img class="img-responsive" src="<?php echo base_url(); ?>assets/slider3.jpg" style="height:500px;width:100%;">
        <p class="event_heading">Description</p>
        <p class="address_form">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <p class="event_heading">Location</p>
        <div id="map" class="map"></div>
    </div>
    <div class="col-md-4">
      <div class="event_detail_thumb">
         <p class="event_heading">Event Name</p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/date.png"><span class="event_thumb">May 25<span></p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/time.png"><span class="event_thumb">May 25<span></p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/location.png"><span class="event_thumb">May 25<span></p>
      </div>
      <div class="event_booking_section">
        <p><a href="" class="btn-block book_tickets">Book Your Tickets</a></p>
      </div>
      <div class="event_detail_thumb">
         <p class="event_heading">Gallery</p>
         <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/front/images/slider1.jpg"><img src="<?php echo base_url(); ?>assets/front/images/slider1.jpg" class="img-responsive  img_gallery"></a>
         <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/front/images/slider2.jpg"><img src="<?php echo base_url(); ?>assets/front/images/slider2.jpg" class="img-responsive  img_gallery"></a>
         <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/front/images/slider3.jpg"><img src="<?php echo base_url(); ?>assets/front/images/slider3.jpg" class="img-responsive  img_gallery"></a>
          <a class="galpop-callback" data-galpop-group="callback" href="<?php echo base_url(); ?>assets/front/images/slider3.jpg"><img src="<?php echo base_url(); ?>assets/front/images/slider3.jpg" class="img-responsive  img_gallery"></a>
      </div>
      <div class="event_detail_thumb">
         <p class="event_heading">Share with your Friends</p>
         <p>
           <a href=""><img src="<?php echo base_url(); ?>assets/front/images/share_facebook.png"></a>
           <a href=""><img src="<?php echo base_url(); ?>assets/front/images/share_twitter.png"></a>
           <a href=""><img src="<?php echo base_url(); ?>assets/front/images/share_googleplus.png"></a>
           <a href=""><img src="<?php echo base_url(); ?>assets/front/images/share_instagram.png"></a>
         </p>
      </div>
      <div class="event_detail_thumb">
         <p class="event_heading">Review</p>
          <div class="review_section">
            <p class="review_name">Kamal raj
              <span class="rated_star">
                <img src="<?php echo base_url(); ?>assets/front/images/rated.png" class="img-responsive">
                <img src="<?php echo base_url(); ?>assets/front/images/rated.png" class="img-responsive">
                <img src="<?php echo base_url(); ?>assets/front/images/rated.png" class="img-responsive">
                <img src="<?php echo base_url(); ?>assets/front/images/unrated.png" class="img-responsive">
                <img src="<?php echo base_url(); ?>assets/front/images/unrated.png" class="img-responsive">
              </span>
            </p>
            <p class="review_desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </p>
            <p class="review_name">Kamal raj
              <span class="rated_star">
                <img src="<?php echo base_url(); ?>assets/front/images/rated.png" class="img-responsive">
                <img src="<?php echo base_url(); ?>assets/front/images/unrated.png" class="img-responsive">
                <img src="<?php echo base_url(); ?>assets/front/images/unrated.png" class="img-responsive">
                <img src="<?php echo base_url(); ?>assets/front/images/unrated.png" class="img-responsive">
                <img src="<?php echo base_url(); ?>assets/front/images/unrated.png" class="img-responsive">
              </span>
            </p>
            <p class="review_desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </p>
          </div>
      </div>
      <div class="event_booking_section">
        <p><a href="" class="book_tickets" data-toggle="modal" data-target="#myModal">Write a review</a></p>
      </div>
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
<style>
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
#galpop-content img{
  width:100%;
}
</style>
<script>
function initMap() {
      var uluru = {lat: 11.002598, lng: 77.016933};
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

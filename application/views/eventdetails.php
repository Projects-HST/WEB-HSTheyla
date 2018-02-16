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
                        <?php foreach($event_details as $res){} ?>
						<div class="row booking-section">
							<div class="col-md-10">
								<div class="event-heading">
									<p class="event-heading-text"><?php echo $res->event_name; ?></p>
								</div>
							</div>
							<div class="col-md-2"><?php if ($res->booking_status =='Y') { ?>
								<p>
									<a href="" class="btn btn-primary btn-login">Book Now</a>
								</p>
                                <?php } ?>
							</div>
						</div>
						<section class="row event-details-desc">
							<div class="col-md-8">
								<p class="event-desc">Description</p>
								<p class="event-desc-details"><?php echo $res->description; ?></p>
							</div>
							<div class="col-md-4">
								<p class="event-desc">Date and Time</p>
								<p class="event-desc-details"><?php echo date('d/m/Y',strtotime($res->start_date));?> <?php echo $res->start_time;?> to <?php echo date('d/m/Y',strtotime($res->end_date)); ?> <?php echo $res->end_time;?></p>
								<p class="event-desc">Venue</p>
								<p class="event-desc-details"><b><?php echo $res->event_venue; ?></b> <br /><?php echo $res->event_address; ?></p>
								<p class="event-desc">Reviews</p>
                <p>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>

                  <p><a class="btn btn-login btn-primary btn-block review-btn" data-toggle="modal" data-target="#myModal" data-original-title>Wite a  Review</a> </p>
                  </p>
							</div>
						</section>
						<section class="row">
							<div class="col-md-12">
								<p class="event-desc">Location</p>
								<div id="map" class="map"></div>
							</div>
						</section>
						<div class="modal fade modal-lg " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
								<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Write Review about the Event</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
												<div class="modal-body">
													<center>
														<form class="form" role="form" autocomplete="off">
																<div class="form-group row">
																		<div class="col-lg-12">
																				<input class="form-control" type="text" value="" placeholder="Name">
																		</div>
																</div>
																<div class="form-group row">
																		<div class="col-lg-12">
																				<input class="form-control" type="text" value="" placeholder="Email">
																		</div>
																</div>
																<div class="form-group row">
																		<div class="col-lg-12">
																				 <div class="rating" >
																						<span class="user-rating">
																						<input type="radio" name="rating" value="5"><span class="star"></span>

																						    <input type="radio" name="rating" value="4"><span class="star"></span>

																						    <input type="radio" name="rating" value="3"><span class="star"></span>

																						    <input type="radio" name="rating" value="2"><span class="star"></span>

																						    <input type="radio" name="rating" value="1"><span class="star"></span>
																						</span>
																					 </div>

																		</div>
																</div>
																<div class="form-group row">
																	<div class="col-lg-12">
																<div class="g-recaptcha " data-sitekey="6Lf_tUYUAAAAAFhSWPgXhaoCJ-Zlr8ax4rLo-cxE"></div>
															</div>
															</div>
																<div class="form-group row">
																		<div class="col-lg-12">
																				<textarea  type="text" value="" placeholder="Message" class="textarea-review"></textarea>
																		</div>
																</div>
																<div class="form-group row">
																		<div class="col-lg-12">
																				<input  type="submit" value="Submit Review" placeholder="Message" class="btn btn-primary btn-login">
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

				.selected-rating{
				    color: #ffd100;
				    font-weight: bold;
				    font-size: 3em;
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
$('#user-rating-form').on('change','[name="rating"]',function(){
	$('#selected-rating').text($('[name="rating"]:checked').val());
});
    $('.carousel').carousel({
      interval:4000,
      pause: "false"
  })

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
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZLXcA6pQcEJA_iE0xX5XA_ObPQ4ww1eM&callback=initMap"></script>

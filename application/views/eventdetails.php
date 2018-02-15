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
                               
							</div>
						</section>
						<section class="row">
							<div class="col-md-12">
								<p class="event-desc">Location</p>
								<div id="map" class="map"></div>
							</div>
						</section>
					</div>
				</div>
				<style>
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
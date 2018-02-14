<link rel="stylesheet" href="
	<?php echo base_url(); ?>assets/front/css/multiselect.css">
	<script src="
		<?php echo base_url(); ?>assets/front/js/multiselect.js">
	</script>
	<div class="container-fluid eventdetail-pge">
		<div class="container">
			<div class="row">
				<div class="carousel carousel-fade" data-ride="carousel" data-interval="2000">
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<a href="#">
								<img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Third slide">
								</a>
							</div>
							<div class="carousel-item" style="background: blue;">
								<a href="#">
									<img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(129).jpg" alt="Second slide">
									</a>
								</div>
								<div class="carousel-item" style="background: green;">
									<a href="#">
										<img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Third slide">
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="row booking-section">
							<div class="col-md-10">
								<div class="event-heading">
									<p class="event-heading-text">Event Name</p>
								</div>
							</div>
							<div class="col-md-2">
								<p>
									<a href="" class="btn btn-primary btn-login">Book Now</a>
								</p>
							</div>
						</div>
						<section class="row event-details-desc">
							<div class="col-md-8">
								<p class="event-desc">Description</p>
								<p class="event-desc-details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                    book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                    more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
							</div>
							<div class="col-md-4">
								<p class="event-desc">Date and Time</p>
								<p class="event-desc-details">Lorem Ipsum is simply dummy text of the printing</p>
								<p class="event-desc">Venue</p>
								<p class="event-desc-details">Lorem Ipsum is simply dummy text of the printing</p>
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
      var uluru = {lat: -25.363, lng: 131.044};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: uluru
      });
      var marker = new google.maps.Marker({
        position: uluru,
        map: map
      });
    }
</script>

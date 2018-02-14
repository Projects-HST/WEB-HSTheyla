<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/multiselect.css">
	<script src="<?php echo base_url(); ?>assets/front/js/multiselect.js"></script>
	<div class="container-fluid eventlist-pge">
		<div class="container">
			<div class="row">
				<div class="carousel carousel-fade" data-ride="carousel" data-interval="2000">
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<a href="#">
								<img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Third slide">
								</a>
							</div>
							<div class="carousel-item">
								<a href="#">
									<img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(129).jpg" alt="Second slide">
									</a>
								</div>
								<div class="carousel-item">
									<a href="#">
										<img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Third slide">
										</a>
									</div>
								</div>
							</div>
						</div>
						<form method="post" class="navbar-form navbar-right search-event-form" role="search" action="#">
							<div class="row search-area">
								<div class="col-md-2">
									<b>Country</b>
									<br>
										<select class="event-selectpage" name="cnyname"  id="cnyname" onchange="getcityname(this.value)">
											<option value="">Select Country</option>
											<?php foreach($country_list as $cntry){ ?>
											<option value="
												<?php echo $cntry->id; ?>">
												<?php echo $cntry->country_name; ?>
											</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-2">
										<b>City</b>
										<br>
											<select class="event-selectpage" name="ctyname"  id="ctyname">
												<option value="">Select City</option>
												<?php foreach($city_list as $cty){ ?>
												<option value="
													<?php echo $cty->id; ?>">
													<?php echo $cty->city_name; ?>
												</option>
												<?php } ?>
											</select>
											<div id="cmsg"></div>
										</div>
										<div class="col-md-2">
											<b>Category</b>
											<br>
												<select id="category" multiple="multiple" name="catname[]"  onchange="getevents()">
													<?php foreach($category_list as $res){ ?>
													<option value="
														<?php echo $res->id; ?>">
														<?php echo $res->category_name; ?>
													</option>
													<?php } ?>
												</select>
											</div>
										</form>
										<div class="col-md-6">
											<b></b>
											<br>
												<form class="navbar-form navbar-right search-event-form" role="search">
													<div class="input-group">
														<input type="text" class="form-control btn-block" placeholder="Type the City Name" name="srch-term" id="srch-term">
															<div class="input-group-btn">
																<button class="btn btn-info btn-login" type="submit">
																	<i class="fas fa-search"></i>
																</button>
															</div>
														</div>
													</form>
												</div>
											</div>
											<p class="upcoming-event-heading">Upcoming Events</p>
											<br>
												<div class="row" id="event_list">
													<?php foreach($event_result as $res){
			$sdate = $res->start_date;
			?>
													<div class="col-md-4 event-thumb">
														<div class="card event-card">
															<img class="img-fluid" src="
																<?php echo base_url(); ?>assets/events/banner/
																<?php echo $res->event_banner; ?>" alt="">
																<div class="card-img-overlay">
																	<span class="badge badge-pill badge-danger">
																		<?php echo $res->event_type; ?>
																	</span>
																</div>
																<div class="card-body">
																	<p class="card-text">
																		<small class="text-time">
																			<p>
																				<?php echo date('D M d Y', strtotime($sdate));?>
																				<?php echo $res->start_time  ?>
																				<span class="pull-right favourite-icon">
																					<img class="img-fluid" src="
																						<?php echo base_url(); ?>assets/front/images/fav-unselect.png" alt="">
																					</span>
																				</p>
																			</small>
																		</p>
																		<div class="news-title">
																			<p class=" title-small event-title-list">
																				<a href="#">
																					<?php echo $res->event_name; ?>
																				</a>
																			</p>
																		</div>
																		<p class="card-text">
																			<small class="text-time">
																				<em>
																					<?php echo $res->country_name; ?>,
																					<?php echo $res->city_name; ?>
																				</em>
																			</small>
																		</p>
																	</div>
																</div>
															</div>
															<?php } ?>
														</div>
													</div>
												</div>
												<style>

    .badge-pill{
      float: right;
      border-radius: 0px;
      padding: 5px 5px 5px 5px;
    }
    /* .carousel-indicators{
      position: absolute;
    } */
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
// $('#example-getting-started').multiselect();
    $('#category').multiselect();
    $('.carousel').carousel({
      interval:6000,
      pause: "false"
  })


function getevents()
 {
	 	var country_id=cnyname.value;
		var city_id=ctyname.value;
		var category_id=$("#category").val();
		cat_id = category_id.toString();

    //make the ajax call
    $.ajax({
        url: '<?php echo base_url(); ?>eventslist/get_search_events',
        type: 'POST',
        data: {country_id : country_id,city_id:city_id,cat_id:cat_id},
        success: function(data) {
			alert(data);
			var len = data.length;
			alert(len);
			var cityname='';
			var ctitle='<option>Select City</option>';
			if(data!='')
			 {    alert(len);
				for(var i=0; i
													<len; i++)
				{

				}

				$("#cmsg").hide();
			}else{
			  $("#cmsg").html('<p style="color: red;">Events Not Found</p>').show();

			}
        }
    });
}

	function getcityname(cid) {
	//alert(cid);
	$.ajax({
		type: 'post',
		url: '<?php echo base_url(); ?>eventslist/get_city_name',
		data: { country_id:cid },
		dataType: "JSON",
		cache: false,
		success:function(cty)
		{
			//alert(cty);
			var len = cty.length;
			//alert(len);
			var cityname='';
			var ctitle='<option>Select City</option>';
			if(cty!='')
			 {    //alert(len);
				for(var i=0; i
														<len; i++)
				{
					var cityid = cty[i].id;
					var city_name = cty[i].city_name;
					//alert(city_name);
					cityname +='<option value=' + cityid + '> ' + city_name + ' </option>';
				}

				$("#ctyname").html(ctitle+cityname).show();
				$("#cmsg").hide();
			}else{
			  $("#cmsg").html('<p style="color: red;">City Not Found</p>').show();
			  $("#ctyname").hide();
			}
		}
	});
	}

														</script>

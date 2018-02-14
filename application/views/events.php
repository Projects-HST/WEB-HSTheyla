<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/multiselect.css">
<script src="<?php echo base_url(); ?>assets/front/js/multiselect.js"></script>
<div class="container-fluid eventlist-pge">
   <div class="container">
      <div class="row">
         <div class="carousel carousel-fade" data-ride="carousel" data-interval="2000">
            <div class="carousel-inner" role="listbox">
            <?php 
			$i = 0;
			foreach($adv_event_result as $res){ 
			?>
               <div class="carousel-item <?php if ($i=='0') echo "active" ?>">
                  <a href="#"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" alt="First slide"></a>
               </div>
               
               <?php $i = $i+1; } ?>
            </div>
         </div>
      </div>
      <form method="post" class="navbar-form navbar-right search-event-form" role="search" action="">
         <div class="row search-area">
            <div class="col-md-2">
               <b>Country</b>
               <br>
               <select class="event-selectpage" name="cnyname" id="cnyname" onchange="getcityname(this.value)">
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
               <select class="event-selectpage" name="ctyname" id="ctyname">
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
            <div class="col-md-3">
               <b>Category</b>
               <br>
               <select id="category" multiple="multiple" name="catname[]" onchange="getevents()">
                  <?php foreach($category_list as $res){ ?>
                  <option value="
                     <?php echo $res->id; ?>">
                     <?php echo $res->category_name; ?>
                  </option>
                  <?php } ?>
               </select>
            </div>
      </form>
      <div class="col-md-5">
      <b></b>
      <br>
      <form class="navbar-form navbar-right search-event-form" role="search" method="post" action="" name="search_form">
      <div class="input-group">
      <input type="text" class="form-control btn-block" placeholder="Type Event Name" name="search_term" id="search_term">
      <div class="input-group-btn">
      <button class="btn btn-info btn-login" type="button" onclick="searchevents()">
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
               <img class="img-fluid event-banner-img" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" alt="" >
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
	var result = '';
	
	//make the ajax call
	$.ajax({
	url: '<?php echo base_url(); ?>eventslist/get_search_events',
	type: 'POST',
	data: {country_id : country_id,city_id:city_id,cat_id:cat_id},
	success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			for (var i = 0; i < dataArray.length; i++){
			   var event_name = dataArray[i].event_name;
			   var event_banner = dataArray[i].event_banner;
			   var event_type = dataArray[i].event_type;
			   var country_name = dataArray[i].country_name;
			   var city_name = dataArray[i].city_name;
			   var start_time = dataArray[i].start_time;
			   var start_date = dataArray[i].start_date;
				var date = new Date(Date.parse(start_date));
				var sdate = String (date);
				var disp_date = sdate.replace('05:30:00 GMT+0530 (India Standard Time)', '');

			   result +="<div class='col-md-4 event-thumb'><div class='card event-card'><img class='img-fluid event-banner-img' src='<?php echo base_url(); ?>assets/events/banner/"+event_banner+"' alt='' ><div class='card-img-overlay'><span class='badge badge-pill badge-danger'>"+event_type+"</span></div><div class='card-body'><p class='card-text'><small class='text-time'><p>"+disp_date+", "+start_time+"<span class='pull-right favourite-icon'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' alt=''></span></p></small></p><div class='news-title'><p class=' title-small event-title-list'><a href='#'>"+event_name+"</a></p></div><p class='card-text'><small class='text-time'><em>"+country_name+", "+city_name+"</em></small></p></div></div></div>";
			   $("#event_list").html(result).show();
			};
		} else {
			result +="No Records found!..";
			$("#event_list").html(result).show();
		}
	}
	});
}

function searchevents()
{
	var srch_term = search_term.value;
	var result = '';
	
	//make the ajax call
	$.ajax({
	url: '<?php echo base_url(); ?>eventslist/search_term_events',
	type: 'POST',
	data: {srch_term : srch_term},
	success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			for (var i = 0; i < dataArray.length; i++){
				var event_name = dataArray[i].event_name;
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
				var start_time = dataArray[i].start_time;
				var start_date = dataArray[i].start_date;
				var date = new Date(Date.parse(start_date));
				var sdate = String (date);
				var disp_date = sdate.replace('05:30:00 GMT+0530 (India Standard Time)', '');
			
			   result +="<div class='col-md-4 event-thumb'><div class='card event-card'><img class='img-fluid event-banner-img' src='<?php echo base_url(); ?>assets/events/banner/"+event_banner+"' alt='' ><div class='card-img-overlay'><span class='badge badge-pill badge-danger'>"+event_type+"</span></div><div class='card-body'><p class='card-text'><small class='text-time'><p>"+disp_date+", "+start_time+"<span class='pull-right favourite-icon'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' alt=''></span></p></small></p><div class='news-title'><p class=' title-small event-title-list'><a href='#'>"+event_name+"</a></p></div><p class='card-text'><small class='text-time'><em>"+country_name+", "+city_name+"</em></small></p></div></div></div>";
			  
			   $("#event_list").html(result).show();
			};
		} else {
			result +="No Records found!..";
			$("#event_list").html(result).show();
		}
	}
	});
}



function getcityname(cid) {
	$.ajax({
	type: 'post',
	url: '<?php echo base_url(); ?>eventslist/get_city_name',
	data: { country_id:cid },
	dataType: "JSON",
	cache: false,
	success:function(cty)
	{
	var len = cty.length;
	var cityname='';
	var ctitle='<option>Select City</option>';
	if(cty!='')
	 {    //alert(len);
		for(var i=0; i<len; i++)
		{
			var cityid = cty[i].id;
			var city_name = cty[i].city_name;
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

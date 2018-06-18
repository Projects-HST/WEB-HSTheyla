<?php $user_id = $this->session->userdata('id'); ?>

<style>
.field-icon {
  float: right;
  left:-10px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
.carousel-inner .carousel-item.active,
.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
  display: flex;
}

.carousel-inner .carousel-item-right.active,
.carousel-inner .carousel-item-next {
  transform: translateX(33%);
}

.carousel-inner .carousel-item-left.active,
.carousel-inner .carousel-item-prev {
  transform: translateX(-33%);
}

.carousel-inner .carousel-item-right,
.carousel-inner .carousel-item-left{
  transform: translateX(0);

}
.slider-img{
  padding-left: 0px;
  padding-right: 0px;
  height: 450px;
}
body{background-color: #f5f5f5;}
.eventdetail-pge{
  padding-left: 50px;
  padding-right: 50px;
}
.search_filter{
  padding-left: 40px;
  padding-right: 40px;
}
</style>
<script src="<?php echo base_url(); ?>assets/front/js/jquery-ui.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/front/js/multiselect.js"></script> -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery-ui.css">
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/multiselect.css"> -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/select2.min.css">
<script src="<?php echo base_url(); ?>assets/front/js/select2.min.js"></script>

<div class="container-fluid ">
  <div class="row">
      <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
          <div class="carousel-inner w-100" role="listbox">
              <?php if (count($adv_event_result)>0){

			 $i = 0;
			foreach($adv_event_result as $res){
				$event_id = $res->id * 564738;
				$event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
				$enc_event_id = base64_encode($event_id);
?>

				<div class="carousel-item <?php if ($i=='0') echo "active"; ?>">
                <!--<a href="<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/">--><img class="d-block col-6 img-fluid slider-img" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" alt="<?php echo $event_name; ?>"><!--</a><-->
                </div>

                 <?php $i = $i+1; } ?>

 <?php } ?>

          </div>
          <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
      </div>
  </div>
</div>

<div class="container-fluid eventdetail-pge">
  <div class="container-fluid search_form">
    <div class="row search_events_box">
    <div class="col-md-2">
      <p class="event_heading">Search Events</p>
    </div>
    <div class="col-md-10" style="padding-right:0px;">
      <div class="left-inner-addon">
      <form class="navbar-form navbar-right search-event-form" role="search" method="post" action="" name="search_form">
        	<input  type="text" class="form-control btn-block" name="search_term" id="search_term"  placeholder="Search Event by name" value="">
           <a href="#"  onclick="getsearchtermevents()"><span toggle="#password-field" class="fa fa-search field-icon toggle-password"></span></a>
        </form>
       </div>
    </div>
    </div>
  </div>
</div>

 <form method="post" class="navbar-form navbar-right search-event-form" role="search" action="">
<div class="container-fluid eventdetail-pge">
  <div class="row search_filter">
    <div class="col-md-3">
      <div class="form-group">
            <div class="col-sm-12">
            <select class="form-control" name="cnyname" id="cnyname" onChange="getcityname(this.value); getcountryevents(this.value);">
                  <option value="">Select Country</option>
                  <?php

				  foreach($country_list as $cntry){ ?>
                  <option value="
                     <?php echo $cntry->id; ?>">
                     <?php echo $cntry->country_name; ?>
                  </option>
                  <?php } ?>
               </select>
          </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
            <div class="col-sm-12">
            <select class="form-control" name="ctyname" id="ctyname" onChange="getcityevents();">
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
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
            <div class="col-sm-12">
              <select class="form-control" name="type">
                <option value="">Select Type</option>
                <option value="1">General</option>
                <option value="2">Hotspot</option>
              </select>
          </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group ">
            <div class="col-sm-12">
            <select id="category" size="3" onchange="getsearchevents()" class="form-control"  multiple>
                 <?php foreach($category_list as $res){ ?>
                 <option value="
                    <?php echo $res->id; ?>">
                    <?php echo $res->category_name; ?>
                 </option>
                 <?php } ?>
			</select>


          </div>
      </div>
    </div>
  </div>
</div>
</form>
<div class="container-fluid search_filter">
  <div class="row" id="event_list"> </div>
	  <div id='loader_image'><img src='<?php echo base_url(); ?>assets/loader.gif' width='24' height='24'> Loading...please wait</div>
      <div id='loader_message'></div>
</div>
<script>

// $('#category').multiselect();
		$('.carousel').carousel({
		interval:6000,
		pause: "false"
});


$('#category').select2({

    placeholder: 'Select Category',
        "multiple": true,

});



//$(document).ready(function() {
$(window).on('load', function(){
		var limit = 9
		var offset = 0;
		var result = '';

        // start to load the first set of data
        getAllevents(limit, offset);

        $('#loader_message').click(function() {
          // if it has no more records no need to fire ajax request
          var d = $('#loader_message').find("button").attr("data-atr");
          if (d != "nodata") {
            offset = limit + offset;
            getAllevents(limit, offset);
          }
        });
});


function getAllevents(lim, off) {
  	var result = '';
        $.ajax({
		url: '<?php echo base_url(); ?>eventlist/get_all_events',
		type: 'POST',
		data: {limit:lim,offset:off},
		cache: false,
        beforeSend: function() {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
          },
        success: function(html) {
			//alert(html);
            $('#loader_image').hide();
			var dataArray = JSON.parse(html);
		if (dataArray.length>0) {

			for (var i = 0; i < dataArray.length; i++){
				var disp_event_id = dataArray[i].id;
				var event_id = dataArray[i].id*564738;
				var enc_event_id = btoa(event_id);
				var event_name = dataArray[i].event_name;
				var sm_event_name = event_name.toLowerCase();
				var eevent_name = sm_event_name.replace(/"/g, "");
				var sevent_name = eevent_name.replace(/'/g, "");
				var qevent_name = sevent_name.replace(/,/g, '');
				var enc_event_name = qevent_name.replace(/\s/g,"-");
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
				var event_venue = dataArray[i].event_venue;
				var start_time = dataArray[i].start_time;
				var start_date = dataArray[i].start_date;
				var date = new Date(Date.parse(start_date));
				var sdate = String (date);
				var disp_date = sdate.replace('05:30:00 GMT+0530 (India Standard Time)', '');
				var wlstatus = dataArray[i].wlstatus;
				if(wlstatus==null){
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' alt=''><a></span>";
				}else{
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-select.png' alt=''></a></span>";
				}

				 result +="<div class='col-xs-18 col-sm-3 col-md-3 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><img src='<?php echo base_url(); ?>assets/front/images/date.png'><span class='event_thumb'>"+disp_date+" <span></p><p><img src='<?php echo base_url(); ?>assets/front/images/time.png'><span class='event_thumb'>"+start_time+"<span></p><p><img src='<?php echo base_url(); ?>assets/front/images/location.png'><span class='event_thumb'>"+event_venue+"<span></p></div> <p class='price_section'><img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></p></div></div>";

			};
				$("#event_list").append(result);

			}

         if (dataArray.length>0) {
			$("#loader_message").html('<button class="btn btn-default" type="button">Load more data</button>').show();

            } else {
             $("#loader_message").html('<button data-atr="nodata" class="btn btn-default" type="button">No more records.</button>').show()
            }


		}
        });

      }

function getcountryevents()
{
	var country_id=cnyname.value;
	var result = '';

	//make the ajax call
	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_country_events',
	type: 'POST',
	data: {country_id : country_id},
	success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			for (var i = 0; i < dataArray.length; i++){
				var disp_event_id = dataArray[i].id;
				var event_id = dataArray[i].id*564738;
				var enc_event_id = btoa(event_id);
				var event_name = dataArray[i].event_name;
				var sm_event_name = event_name.toLowerCase();
				var eevent_name = sm_event_name.replace(/"/g, "");
				var sevent_name = eevent_name.replace(/'/g, "");
				var qevent_name = sevent_name.replace(/,/g, '');
				var enc_event_name = qevent_name.replace(/\s/g,"-");
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
				var event_venue = dataArray[i].event_venue;
				var start_time = dataArray[i].start_time;
				var start_date = dataArray[i].start_date;
				var date = new Date(Date.parse(start_date));
				var sdate = String (date);
				var disp_date = sdate.replace('05:30:00 GMT+0530 (India Standard Time)', '');
				var wlstatus = dataArray[i].wlstatus;

				if(wlstatus==null){
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' alt=''><a></span>";
				}else{
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-select.png' alt=''></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-3 col-md-3 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><img src='<?php echo base_url(); ?>assets/front/images/date.png'><span class='event_thumb'>"+disp_date+" <span></p><p><img src='<?php echo base_url(); ?>assets/front/images/time.png'><span class='event_thumb'>"+start_time+"<span></p><p><img src='<?php echo base_url(); ?>assets/front/images/location.png'><span class='event_thumb'>"+event_venue+"<span></p></div> <p class='price_section'><img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></p></div></div>";

			};
			$('#loader_message').hide();
			 $("#event_list").html(result).show();
		} else {
			$('#loader_message').hide();
      // $("#event_list").css({padding-bottom: "100px;"});
			result +="No Records found!..";
			$("#event_list").html(result).show();
		}
	}
	});
}

function getcityevents()
{
	var country_id=cnyname.value;
	var city_id=ctyname.value;
	var result = '';

	//make the ajax call
	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_city_events',
	type: 'POST',
	data: {country_id : country_id,city_id:city_id},
	success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			for (var i = 0; i < dataArray.length; i++){
				var disp_event_id = dataArray[i].id;
				var event_id = dataArray[i].id*564738;
				var enc_event_id = btoa(event_id);
				var event_name = dataArray[i].event_name;
				var sm_event_name = event_name.toLowerCase();
				var eevent_name = sm_event_name.replace(/"/g, "");
				var sevent_name = eevent_name.replace(/'/g, "");
				var qevent_name = sevent_name.replace(/,/g, '');
				var enc_event_name = qevent_name.replace(/\s/g,"-");
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
				var event_venue = dataArray[i].event_venue;
				var start_time = dataArray[i].start_time;
				var start_date = dataArray[i].start_date;
				var date = new Date(Date.parse(start_date));
				var sdate = String (date);
				var disp_date = sdate.replace('05:30:00 GMT+0530 (India Standard Time)', '');
				var wlstatus = dataArray[i].wlstatus;

				if(wlstatus==null){
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' alt=''><a></span>";
				}else{
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-select.png' alt=''></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-3 col-md-3 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><img src='<?php echo base_url(); ?>assets/front/images/date.png'><span class='event_thumb'>"+disp_date+" <span></p><p><img src='<?php echo base_url(); ?>assets/front/images/time.png'><span class='event_thumb'>"+start_time+"<span></p><p><img src='<?php echo base_url(); ?>assets/front/images/location.png'><span class='event_thumb'>"+event_venue+"<span></p></div> <p class='price_section'><img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></p></div></div>";

			};
			$('#loader_message').hide();
			 $("#event_list").html(result).show();
		} else {
			$('#loader_message').hide();
      // $("#event_list").css({padding-bottom: "100px;"});
			result +="No Records found!..";
			$("#event_list").html(result).show();
		}
	}
	});
}

function getsearchevents()
{
	var country_id=cnyname.value;
	var city_id=ctyname.value;
	var category_id=$("#category").val();
	cat_id = category_id.toString();
	var result = '';

	//make the ajax call
	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_search_events',
	type: 'POST',
	data: {country_id : country_id,city_id:city_id,cat_id:cat_id},
	success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			for (var i = 0; i < dataArray.length; i++){
				var disp_event_id = dataArray[i].id;
				var event_id = dataArray[i].id*564738;
				var enc_event_id = btoa(event_id);
				var event_name = dataArray[i].event_name;
				var sm_event_name = event_name.toLowerCase();
				var eevent_name = sm_event_name.replace(/"/g, "");
				var sevent_name = eevent_name.replace(/'/g, "");
				var qevent_name = sevent_name.replace(/,/g, '');
				var enc_event_name = qevent_name.replace(/\s/g,"-");
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
				var event_venue = dataArray[i].event_venue;
				var start_time = dataArray[i].start_time;
				var start_date = dataArray[i].start_date;
				var date = new Date(Date.parse(start_date));
				var sdate = String (date);
				var disp_date = sdate.replace('05:30:00 GMT+0530 (India Standard Time)', '');
				var wlstatus = dataArray[i].wlstatus;

				if(wlstatus==null){
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' alt=''><a></span>";
				}else{
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-select.png' alt=''></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-3 col-md-3 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><img src='<?php echo base_url(); ?>assets/front/images/date.png'><span class='event_thumb'>"+disp_date+" <span></p><p><img src='<?php echo base_url(); ?>assets/front/images/time.png'><span class='event_thumb'>"+start_time+"<span></p><p><img src='<?php echo base_url(); ?>assets/front/images/location.png'><span class='event_thumb'>"+event_venue+"<span></p></div> <p class='price_section'><img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></p></div></div>";

			};
			$('#loader_message').hide();
			 $("#event_list").html(result).show();
		} else {
			$('#loader_message').hide();
      // $("#event_list").css({padding-bottom: "100px;"});
			result +="No Records found!..";
			$("#event_list").html(result).show();
		}
	}
	});
}


function getsearchtermevents()
{
	var srch_term = search_term.value;
	var result = '';

	//make the ajax call
	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/search_term_events',
	type: 'POST',
	data: {srch_term : srch_term},
	success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			for (var i = 0; i < dataArray.length; i++){
				var disp_event_id = dataArray[i].id;
				var event_id = dataArray[i].id*564738;
				var enc_event_id = btoa(event_id);
				var event_name = dataArray[i].event_name;
				var sm_event_name = event_name.toLowerCase();
				var eevent_name = sm_event_name.replace(/"/g, "");
				var sevent_name = eevent_name.replace(/'/g, "");
				var qevent_name = sevent_name.replace(/,/g, '');
				var enc_event_name = qevent_name.replace(/\s/g,"-");
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
				var event_venue = dataArray[i].event_venue;
				var start_time = dataArray[i].start_time;
				var start_date = dataArray[i].start_date;
				var date = new Date(Date.parse(start_date));
				var sdate = String (date);
				var disp_date = sdate.replace('05:30:00 GMT+0530 (India Standard Time)', '');
				var wlstatus = dataArray[i].wlstatus;

				if(wlstatus==null){
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' alt=''><a></span>";
				}else{
					 var wishliststatus="<span class='pull-right favourite-icon' id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-select.png' alt=''></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-3 col-md-3 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><img src='<?php echo base_url(); ?>assets/front/images/date.png'><span class='event_thumb'>"+disp_date+" <span></p><p><img src='<?php echo base_url(); ?>assets/front/images/time.png'><span class='event_thumb'>"+start_time+"<span></p><p><img src='<?php echo base_url(); ?>assets/front/images/location.png'><span class='event_thumb'>"+event_venue+"<span></p></div> <p class='price_section'><img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></p></div></div>";
			};

			$('#loader_message').hide();
			$("#event_list").html(result).show();
		} else {
			$('#loader_message').hide();
			result +="No Records found!..";
			$("#event_list").html(result).show();
		}
	}
	});
}


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
			$('#wishlist' + event_id).html("<span class='pull-right favourite-icon'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-select.png' alt=''></span>").show();
		} else {
			$('#wishlist' + event_id).html("<span class='pull-right favourite-icon'><img class='img-fluid' src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' alt=''></span>").show();
		}
	}
	});
}


function getcityname(cid) {
	$.ajax({
	type: 'post',
	url: '<?php echo base_url(); ?>eventlist/get_city_name',
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

$( function() {
    var availableTags = [<?php
	 $tot_count = count($event_resu);
	 $i = 1;
		foreach($event_resu as $res){
		echo "'";
		echo $str = addslashes($res->event_name);
		//echo str_replace("'", "", $res->event_name);
		echo "'";
		if ($i < $tot_count) echo ",";
		 $i = $i+1;} ?>];
    $( "#search_term" ).autocomplete({
      source: availableTags
    });
  } );
</script>

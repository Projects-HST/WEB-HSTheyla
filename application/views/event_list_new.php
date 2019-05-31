<?php $user_id = $this->session->userdata('id'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/knockout/2.3.0/knockout-min.js"></script> -->
<style>
.ui-autocomplete {
    max-height: 200px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
    /* add padding to account for vertical scrollbar */
    padding-right: 20px;
}
.field-icon {
  float: right;
  left:10px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
/* Carousel base class */
.event_thumb p{
  margin-top: 10px;
  margin-bottom: 0px;
  margin-left: 3px;
}
.event_date{
  font-size: 14px;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
  z-index: 10;
  bottom: 3rem;
}

/* Declare heights because of positioning of img element */
.carousel-item {
  height: 32rem;

}
.carousel-item > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 32rem;
}
.slider-img{
  padding-left: 0px;
  padding-right: 0px;
  height: 450px;
}
body{background-color: #f7f8fa;}

.homeslider{
  margin-left: 50px;
  margin-right: 50px;
}
.slider_form{
  position:relative;
  bottom:50px;
  padding: 30px;
}
.form-label{
  margin-left: 15px;
}
.head_text{
  margin-bottom: 20px;
  margin-left: 15px;

}
.head_text h2{
  font-size: 30px;
  border-right: 3px solid #000;
}
.event_list{
  margin-left: 50px;
  margin-right: 50px;
}
.form_search{
  margin-left: 100px;
  margin-right: 100px;
}
.more_event{
    text-align: center;
    border: 1px solid #000;
    margin-bottom: 15px;
    margin-top: 15px;
}
.no_event{
    text-align: center;
    border: 1px solid #000;
	color:#fffff;
	background-color:#4c4c4c;
    margin-bottom: 15px;
    margin-top: 15px;
}
</style>
<script src="<?php echo base_url(); ?>assets/front/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/select2.min.css">

<div class="container-fluid">
<div class="homeslider">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
  <?php
	if (count($banner_event_result)>0){
		$i = 0;
		foreach($banner_event_result as $res){
			$event_id = $res->id * 564738;
			$event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
			$enc_event_id = base64_encode($event_id);
			$description  = $res->description ;
			$num_words = 25;
			$words = array();
			$words = explode(" ", $description, $num_words);
			$shown_string = "";
			if(count($words) == 25){
			   $words[24] = " ... ";
			}
			$shown_string = implode(" ", $words);
			$disp_banner_desc  = wordwrap($shown_string, 100, "<br />");
?>

<div class="carousel-item <?php if ($i=='0') echo "active"; ?>" style="background-image: url('<?php echo base_url(); ?>assets/events/slider/<?php echo $res->banner; ?>');background-size: cover;background-position: center;background-repeat: no-repeat;">
  <!--<img src="<?php echo base_url(); ?>assets/events/advertisement/<?php echo $res->banner; ?>" alt="<?php echo $res->event_name; ?>">-->
      <div class="container">
        <div class="carousel-caption d-none d-md-block text-left">
          <h1><?php echo $res->event_name; ?></h1>
          <p><?php echo $disp_banner_desc; ?></p>
          <p><a class="btn btn-lg btn-primary" href="<?php echo base_url(); ?>eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/" role="button">Explore Now</a></p>
        </div>
      </div>
    </div>
	<?php $i = $i+1;
		}
	} ?>

  </div>
  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
</div>

<div class="container-fluid ">
  <div class="form_search eventdetail-pge slider_form">
    <div class="row">
      <div class="col-md-4">
        <div class="head_text"><h2>Find Events Near You</h2></div>
      </div>

      <div class="col-md-8">
      <div class="form-group">
            <div class="col-sm-12">
              <form class="navbar-form navbar-right search-event-form" role="search" method="post" action="" name="search_form" id="search_form">
                  <input  type="text" class="form-control btn-block" name="search_term" id="search_term"  placeholder="Search Event by name" value="" autocomplete="off">
                   <a href="#"  onclick="getSearchevents()"><span toggle="#password-field" class="fa fa-search field-icon toggle-password"></span></a>
                </form>
          </div>
      </div>
      </div>
    </div>

    <div class="row">
    <div class="col-md-3">
      <label class="form-label">Select Country</label>
      <div class="form-group">
          <div class="col-sm-12">
            <select class="form-control" name="cnyname" id="cnyname" onChange="change_country();getCountryevents();">
                  <option value="">Select Country</option>
                  <?php foreach($country_list as $cny){ ?>
                  <option value="<?php echo $cny->id; ?>"><?php echo $cny->country_name; ?></option>
                  <?php } ?>
               </select>
                <script language="JavaScript">document.eventform.cnyname.value="<?php echo $country_values; ?>";</script>
          </div>
      </div>
    </div>
    <div class="col-md-3">
      <label class="form-label">Select City</label>
      <div class="form-group">
          <div class="col-sm-12" id="select_city">
            <select class="form-control" name="ctyname" id="ctyname" onChange="getCityevents();">
                  <option value="">Select City</option>
                  <?php foreach($city_list as $cty){ ?>
                  <option value="<?php echo $cty->id; ?>"><?php echo $cty->city_name; ?></option>
                  <?php } ?>
               </select>
                <script language="JavaScript">document.eventform.ctyname.value="<?php echo $city_values; ?>";</script>
               <div id="cmsg"></div>
          </div>
      </div>
    </div>
    <div class="col-md-3">
        <label class="form-label">Select Category</label>
      <div class="form-group ">
            <div class="col-sm-12">

			   <?php
					$tot_count = count($category_list);
					$str_value = '';
					$i = 1;
						foreach($category_list as $res){
						$str = $res->id;
						if ($i < $tot_count) { $str = $str.',';}
						$i = $i+1;
						$str_value = $str_value . $str;
					}
				 ?>

            <select id="category" size="3" onchange="getCategoryevents()" class="form-control" multiple>
                 <?php
				 foreach($category_list as $res){ ?>
                 <option value="<?php echo $res->id; ?>"><?php echo $res->category_name; ?></option>
                 <?php } ?>
				 <option value="<?php echo $str_value; ?>"><?php echo "All"; ?></option>
               </select>
          </div>
      </div>
    </div>
    <div class="col-md-3">
        <label class="form-label">Preference</label>
        <div class="form-group">
              <div class="col-sm-12">
                <select class="form-control" name="event_type" id="event_type" onchange="getTypeevents();">
                  <option value="">Select Type</option>
                  <option value="1">Popular</option>
                  <option value="2">Hotspot</option>
                </select>
            </div>
        </div>
      </div>

      </div>
  </div>
</div>

<div class="container-fluid">
		<div class="row event_list" id="event_list_all"> </div>
		<div class="row event_list" id="event_list_cny"> </div>
		<div class="row event_list" id="event_list_cty"> </div>
		<div class="row event_list" id="event_list_cat"> </div>
		<div class="row event_list" id="event_list_type"> </div>
		<div class="row event_list" id="event_list_search"> </div>
	  <div class="col-sm-12 text-center" id='loader_image' style="padding-bottom:20px;display:none;"><img src='<?php echo base_url(); ?>assets/ajax-loader.gif'></div>
      <div id='loader_message'><center></center></div>
</div>

<script>

$('.carousel').carousel({
		interval:6000,
		pause: "false"
});

$('#category').select2({
    placeholder: 'Select Category',
    "multiple": true,
});

$(window).on('load', function(){

	var country_val ='<?php  echo $country_values ?>';

	if(country_val!==''){
	 var country_values ='<?php  echo $country_values ?>';

	 //var city_values='<?php  echo $city_values ?>';
	// if(country_values!='' && city_values!=''){
	if(country_values!=''){
		$("#cnyname").val("<?php echo $country_values; ?>");
	//	$("#ctyname").val("<?php echo $city_values; ?>");
		  //getCityevents();
		  getCountryevents(country_values);
	  } else {
		 getAllevents()
	  }
	}else{
	    $.ajax({ url: "<?php echo base_url(); ?>eventlist/get_ip_country",
        context: document.body,
        success: function(data){
        var country_values = data;

	if(country_values!=''){
		$("#cnyname").val("<?php echo $country_values; ?>");
	//	$("#ctyname").val("<?php echo $city_values; ?>");
		  //getCityevents();
		  getCountryevents(country_values);
	  } else {
		 getAllevents()
	  }
        }});
	}

});

function change_country()
{
	var country_id=cnyname.value;
	var result = '';
	var city_result = "<select class='form-control' id='ctyname' name='ctyname' onchange='getCityevents()'><option value=''>Select City</option></select>";

	//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/get_city_name',
		type: 'POST',
		data: {country_id : country_id},
		success: function(data) {
		var dataArray = JSON.parse(data);
			if (dataArray.length>0) {

				result +="<select class='form-control' id='ctyname' name='ctyname' onchange='getCityevents()'><option value=''>Select City</option>";
				for (var i = 0; i < dataArray.length; i++){
					var id = dataArray[i].id;
					var city_name = dataArray[i].city_name;
					result +="<option value='"+id+"'>"+city_name+"</option>";
				};
					result +="</select>";
					$("#select_city").html(result).show();
			} else {
					$("#select_city").html(city_result).show();
			}
		}
		});
}

function getAllevents()
{
	$("#event_list_all").html("").show();

	var limit = 9;
	var offset = 0;

	$('#event_type').prop('selectedIndex',0);
	$('#loader_message').hide();
	var result = '';
	
	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_all_events',
	type: 'POST',
	data: {limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
            $("#loader_message").html("").hide();
			$("#event_list_cny").html("").hide();
			$("#event_list_cty").html("").hide();
			$("#event_list_cat").html("").hide();
			$("#event_list_type").html("").hide();
			$("#event_list_search").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};

				$("#event_list_all").append(result);
				$('#loader_image').hide();
				offset = limit + offset;

				$("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getAlleventsresult('+limit+','+offset+')" role="button">More Events</a></center>').show();
			} else {
				$('#loader_image').hide();
				$("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
            }
	}
	});

}

function getAlleventsresult(limit,offset)
{
	$('#loader_message').hide();
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_all_events',
	type: 'POST',
	data: {limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
            $("#loader_message").html("").hide();
			$("#event_list_cny").html("").hide();
			$("#event_list_cty").html("").hide();
			$("#event_list_cat").html("").hide();
			$("#event_list_type").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};

				$("#event_list_all").append(result);
				$('#loader_image').hide();
				offset = limit + offset;
				$("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getAlleventsresult('+limit+','+offset+')" role="button">More Events</a></center>').show();
			} else {
				$('#loader_image').hide();
				$("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
            }
	}
	});
}

function getCountryevents(country_values)
{
	$("#event_list_cny").html("").show();

	var limit = 9;
	var offset = 0;

   var c_id=country_values;
   if(c_id){
      var country_id=country_values;
      $('#cnyname').val(country_id);
    }else{
        var country_id=cnyname.value;
    }

	$('#event_type').prop('selectedIndex',0);
	$('#loader_message').hide();
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_country_events',
	type: 'POST',
	data: {country_id:country_id,limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
            $("#loader_message").html("").hide();
			$("#event_list_all").html("").hide();
			$("#event_list_cty").html("").hide();
			$("#event_list_cat").html("").hide();
			$("#event_list_type").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};

				$("#event_list_cny").append(result);
				$('#loader_image').hide();
				offset = limit + offset;
				$("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getCountryeventsresult('+limit+','+offset+')" role="button">More Events</a></center>').show();
				//$("#loader_message").html('<a onclick="getCountryeventsresult('+limit+','+offset+')">More Events</a>').show();
			} else {
				$('#loader_image').hide();
				$("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
            }
	}
	});
}

function getCountryeventsresult(limit,offset)
{
	var country_id=cnyname.value;
	$('#event_type').prop('selectedIndex',0);
	$('#loader_message').hide();
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_country_events',
	type: 'POST',
	data: {country_id:country_id,limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
            $("#loader_message").html("").hide();
			$("#event_list_all").html("").hide();
			$("#event_list_cty").html("").hide();
			$("#event_list_cat").html("").hide();
			$("#event_list_type").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};

				$("#event_list_cny").append(result);
				$('#loader_image').hide();
				offset = limit + offset;
				$("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getCountryeventsresult('+limit+','+offset+')" role="button">More Events</a></center>').show();
			} else {
				$('#loader_image').hide();
				$("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
            }
	}
	});
}

function getCityevents()
{
	$("#event_list_cty").html("").show();

	var limit = 9;
	var offset = 0;

	var country_id=cnyname.value;
	var city_id_value=ctyname.value;
	var category_id = $("#category").val();
	cat_id = category_id.toString();
	$('#event_type').prop('selectedIndex',0);

// 	if(city_id_value==''){
// 			var city_id='<?php echo $city_values; ?>';
// 	  }else
// 	  {
		  var city_id=city_id_value;
// 	}
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_city_events',
	type: 'POST',
	data: {country_id:country_id,city_id:city_id,cat_id:cat_id,limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
            $("#loader_message").html("").hide();
			$("#event_list_all").html("").hide();
			$("#event_list_cny").html("").hide();
			$("#event_list_cat").html("").hide();
			$("#event_list_type").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};

				$("#event_list_cty").append(result);
				$('#loader_image').hide();
				offset = limit + offset;
				$("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getCityeventsresult('+limit+','+offset+')" role="button">More Events</a></center>').show();

			} else {
				$('#loader_image').hide();
				$("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
            }
	}
	});
}

function getCityeventsresult(limit,offset)
{
	var country_id=cnyname.value;
	var city_id_value=ctyname.value;
	var category_id = $("#category").val();
	cat_id = category_id.toString();
	$('#event_type').prop('selectedIndex',0);

	if(city_id_value==''){
			var city_id='<?php echo $city_values; ?>';
	  }else{
		  var city_id=city_id_value;
	}
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_city_events',
	type: 'POST',
	data: {country_id:country_id,city_id:city_id,cat_id:cat_id,limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
            $("#loader_message").html("").hide();
			$("#event_list_all").html("").hide();
			$("#event_list_cny").html("").hide();
			$("#event_list_cat").html("").hide();
			$("#event_list_type").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};

				$("#event_list_cty").append(result);
				$('#loader_image').hide();
				offset = limit + offset;
				$("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getCityeventsresult('+limit+','+offset+')" role="button">More Events</a></center>').show();
			} else {
				$('#loader_image').hide();
				$("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
            }
	}
	});
}


function getCategoryevents()
{
	$("#event_list_cat").html("").show();

	var limit = 9;
	var offset = 0;

	var country_id=cnyname.value;
	var city_id_value=ctyname.value;
	var category_id = $("#category").val();
	cat_id = category_id.toString();
	$('#event_type').prop('selectedIndex',0);

	if(city_id_value==''){
			var city_id='<?php echo $city_values; ?>';
	  }else{
		  var city_id=city_id_value;
	}
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_category_events',
	type: 'POST',
	data: {country_id:country_id,city_id:city_id,cat_id:cat_id,limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
		if (cat_id == ''){
				$('#loader_image').hide();
			}
            $("#loader_message").html("").hide();
			$("#event_list_all").html("").hide();
			$("#event_list_cny").html("").hide();
			$("#event_list_cty").html("").hide();
			$("#event_list_type").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};

				$("#event_list_cat").append(result);
				$('#loader_image').hide();
				offset = limit + offset;
				$("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getCategoryeventsresult('+limit+','+offset+')" role="button">More Events</a></center>').show();
				//$("#loader_message").html('<a onclick="getCategoryeventsresult('+limit+','+offset+')">More Events</a>').show();
			} else {
				$('#loader_image').hide();
				$("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
            }
	}
	});
}

function getCategoryeventsresult(limit,offset)
{

	var country_id=cnyname.value;
	var city_id_value=ctyname.value;
	var category_id = $("#category").val();
	cat_id = category_id.toString();
	$('#event_type').prop('selectedIndex',0);

	if(city_id_value==''){
			var city_id='<?php echo $city_values; ?>';
	  }else{
		  var city_id=city_id_value;
	}
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_category_events',
	type: 'POST',
	data: {country_id:country_id,city_id:city_id,cat_id:cat_id,limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
            $("#loader_message").html("").hide();
			$("#event_list_all").html("").hide();
			$("#event_list_cny").html("").hide();
			$("#event_list_cty").html("").hide();
			$("#event_list_type").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};


        $("#event_list_cat").append(result);
        $('#loader_image').hide();
        $("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getCategoryeventsresult('+limit+','+offset+')" role="button">More Events</a><center>').show();
		} else {
        $('#loader_image').hide();
        $("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
        }
	}
	});
}


function getTypeevents()
{
	$("#event_list_type").html("").show();

	var limit = 9;
	var offset = 0;

	var country_id=cnyname.value;
	var city_id_value=ctyname.value;
	var type_id = event_type.value;
	var category_id = $("#category").val();
	cat_id = category_id.toString();
	//$('#event_type').prop('selectedIndex',0);

	if(city_id_value==''){
			var city_id='<?php echo $city_values; ?>';
	  }else{
		  var city_id=city_id_value;
	}
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_type_events',
	type: 'POST',
	data: {country_id:country_id,city_id:city_id,cat_id:cat_id,type_id:type_id,limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
		if (cat_id == ''){
				$('#loader_image').hide();
			}
            $("#loader_message").html("").hide();
			$("#event_list_all").html("").hide();
			$("#event_list_cny").html("").hide();
			$("#event_list_cty").html("").hide();
			$("#event_list_cat").html("").hide();
			$("#event_list_search").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};

				$("#event_list_type").append(result);
				$('#loader_image').hide();
				offset = limit + offset;
				$("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getTypeeventsresult('+limit+','+offset+')" role="button">More Events</a></center>').show();
				//$("#loader_message").html('<a onclick="getTypeeventsresult('+limit+','+offset+')">More Events</a>').show();
			} else {
				$('#loader_image').hide();
				$("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
            }
	}
	});
}

function getTypeeventsresult(limit,offset)
{
	var country_id=cnyname.value;
	var city_id_value=ctyname.value;
	var type_id = event_type.value;
	var category_id = $("#category").val();
	cat_id = category_id.toString();
	//$('#event_type').prop('selectedIndex',0);

	if(city_id_value==''){
			var city_id='<?php echo $city_values; ?>';
	  }else{
		  var city_id=city_id_value;
	}
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/get_type_events',
	type: 'POST',
	data: {country_id:country_id,city_id:city_id,cat_id:cat_id,type_id:type_id,limit:limit,offset:offset},
	cache: false,
    beforeSend: function() {
		if (cat_id == ''){
				$('#loader_image').hide();
			}
            $("#loader_message").html("").hide();
			$("#event_list_all").html("").hide();
			$("#event_list_cny").html("").hide();
			$("#event_list_cty").html("").hide();
			$("#event_list_cat").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				var end_date = dataArray[i].dend_date;
				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}
				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}
				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};

			 $("#event_list_type").append(result);
				$('#loader_image').hide();
				offset = limit + offset;
				$("#loader_message").html('<center><a class="btn btn-sm more_event" onclick="getTypeeventsresult('+limit+','+offset+')" role="button">More Events</a></center>').show();
			} else {
				$('#loader_image').hide();
				$("#loader_message").html('<center><p class="btn btn-sm no_event" style="color:#ffffff;">No more Events</p></center>').show();
            }

	}
	});
}

function getSearchevents()
{
	$('#cnyname').prop('selectedIndex',0);
	$('#ctyname').prop('selectedIndex',0);
	//$('#category').prop('selectedIndex',0);
	$('#event_type').prop('selectedIndex',0);
	
	var srch_term = search_term.value;
	var result = '';

	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/search_term_events',
	type: 'POST',
	data: {srch_term : srch_term},
	cache: false,
    beforeSend: function() {
            $("#loader_message").html("").hide();
			$("#event_list_all").html("").hide();
			$("#event_list_cny").html("").hide();
			$("#event_list_cty").html("").hide();
			$("#event_list_cat").html("").hide();
			$("#event_list_type").html("").hide();
            $('#loader_image').show();
          },
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
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].dstart_date;
				//var sdate = new Date(Date.parse(start_date));
				//var s_date = String (sdate);
				//var disp_from_date = s_date.replace('05:30:00 GMT+0530 (India Standard Time)', '');

				var end_date = dataArray[i].dend_date;
				//var edate = new Date(Date.parse(end_date));
				//var e_date = String (sdate);
				//var disp_end_date = e_date.replace('05:30:00 GMT+0530 (India Standard Time)', '');

				var wlstatus = dataArray[i].wlstatus;
				var hotspot_status = dataArray[i].hotspot_status;

				if (event_type == 'Paid'){
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/paid.png' class='pull-left pf_btn'>";
				} else {
					var sevent_type = "<img src='<?php echo base_url(); ?>assets/front/images/free.png' class='pull-left pf_btn'>";
				}

				if (hotspot_status=='N'){
					var display_date = "<p><span class=' event_date'>"+start_date+" - "+end_date+"<span></p>";
				} else {
					var display_date = "<p><span class='event_date'>&nbsp;<span></p>";
				}

				if(wlstatus==null){
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-unselect.png' class='pull-right'><a></span>";
				}else{
					 var wishliststatus="<span id='wishlist"+disp_event_id+"'><a href='javascript:void(0);' onclick='editwishlist(<?php echo $user_id; ?> ,"+disp_event_id+");'><img src='<?php echo base_url(); ?>assets/front/images/fav-select.png' class='pull-right'></a></span>";
				}

				result +="<div class='col-xs-18 col-sm-4 col-md-4 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'>"+display_date+"<p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a><p><span class='event_thumb'>"+start_time+" - "+end_time+" <span class='pull-right'>"+sevent_type+" <span></span></p></div><p class='price_section'><span class='event_thumb'>"+event_venue+"<span><?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></div></div>";
			};
			$('#loader_image').hide();
			$('#loader_message').hide();
			$("#event_list_search").html(result).show();
		} else {
			$('#loader_message').hide();
			$('#loader_image').hide();
			result +="No Records found!..";
			$("#event_list_search").html(result).show();
		}
	}
	});
}


/* function getcityname(cid) {
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
} */


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

    $("#search_term").autocomplete({
		source: availableTags,
		select: function(event, ui) {
		$("#search_term").val(ui.item.value);
			getSearchevents();
		}
	});

  });

/* $('#reset_cookie').hide();
window.onload=set_cookies_values();

function set_cookies_values(){
  var country_values='<?php  echo $country_values ?>';
  var city_values='<?php  echo $city_values ?>';

  if(country_values=='' && city_values==''){
  }else{
    if(city_values==''){
      getcountryevents();
    }else{
      getcityevents();
	}
  }
}

function reset(){
	<?php
	unset($_COOKIE['country_values']);
	unset($_COOKIE['city_values']);

	delete_cookie('country_values');
	delete_cookie('city_values');
	?>
	location.reload();
} */

</script>

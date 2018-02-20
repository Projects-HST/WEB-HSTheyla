<?php $user_id = $this->session->userdata('id'); ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/multiselect.css">
<script src="<?php echo base_url(); ?>assets/front/js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/multiselect.js"></script>
<div class="container-fluid eventlist-pge">
   <div class="container">
   <?php if (count($adv_event_result)>0){ ?>
      <div class="row">
         <div class="carousel carousel-fade" data-ride="carousel" data-interval="2000">
            <div class="carousel-inner" role="listbox">
            <?php $i = 0;
			foreach($adv_event_result as $res){
				$event_id = $res->id * 564738;
				$event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
				$enc_event_id = base64_encode($event_id);
			?>
               <div class="carousel-item <?php if ($i=='0') echo "active"; ?>">
                  <a href="<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/"><img class="d-block w-100" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" alt="<?php echo $event_name; ?>"></a>
               </div>
               <?php $i = $i+1; } ?>
            </div>
         </div>
      </div>
      <?php } ?>
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
      </div>
	  <div id='loader_image'><img src='<?php echo base_url(); ?>assets/loader.gif' width='24' height='24'> Loading...please wait</div>
      <div id='loader_message'></div>
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
.card-img-overlay{
  position: relative;
  padding: 0px;
}
.card-body{
  padding-top: 0px;
}
</style>
<script>

$('#category').multiselect();
		$('.carousel').carousel({
		interval:6000,
		pause: "false"
})

	var limit = 9
   	var offset = 0;
	var result = '';
      $(document).ready(function() {
        // start to load the first set of data
        displayEvents(limit, offset);

        $('#loader_message').click(function() {
          // if it has no more records no need to fire ajax request
          var d = $('#loader_message').find("button").attr("data-atr");
          if (d != "nodata") {
            offset = limit + offset;
            displayEvents(limit, offset);
          }
        });

      });


function displayEvents(lim, off) {
		
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
            $('#loader_image').hide();
			var dataArray = JSON.parse(html);
			
		if (dataArray.length>0) {
			for (var i = 0; i < dataArray.length; i++){
				var disp_event_id = dataArray[i].id;
				var event_id = dataArray[i].id*564738;
				var enc_event_id = btoa(event_id);
				var event_name = dataArray[i].event_name;
				var sevent_name = event_name.toLowerCase();
				var enc_event_name = sevent_name.replace(/\s/g, '-');
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
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
				
				result +="<div class='col-md-4 event-thumb'><div class='card event-card'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img class='img-fluid event-banner-img' src='<?php echo base_url(); ?>assets/events/banner/"+event_banner+"' alt='' ></a><div class='card-img-overlay'><span class='badge badge-pill badge-danger'>"+event_type+"</span></div><div class='card-body'><p class='card-text'><small class='text-time'><p>"+disp_date+", "+start_time+"<?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></small></p><div class='news-title'><p class=' title-small event-title-list'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></div><p class='card-text'><small class='text-time'><em>"+country_name+", "+city_name+"</em></small></p></div></div></div>";
				
			};
				$("#event_list").html(result);
			}
			
            if (dataArray.length>0) {
			$("#loader_message").html('<button class="btn btn-default" type="button">Load more data</button>').show();
              
            } else {
             $("#loader_message").html('<button data-atr="nodata" class="btn btn-default" type="button">No more records.</button>').show()
            }

          }
        });
      }



function getevents()
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
				var sevent_name = event_name.toLowerCase();
				var enc_event_name = sevent_name.replace(/\s/g, '-');
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
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
				
				result +="<div class='col-md-4 event-thumb'><div class='card event-card'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img class='img-fluid event-banner-img' src='<?php echo base_url(); ?>assets/events/banner/"+event_banner+"' alt='' ></a><div class='card-img-overlay'><span class='badge badge-pill badge-danger'>"+event_type+"</span></div><div class='card-body'><p class='card-text'><small class='text-time'><p>"+disp_date+", "+start_time+"<?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></small></p><div class='news-title'><p class=' title-small event-title-list'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></div><p class='card-text'><small class='text-time'><em>"+country_name+", "+city_name+"</em></small></p></div></div></div>";
			  
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

function searchevents()
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
				var sevent_name = event_name.toLowerCase();
				var enc_event_name = sevent_name.replace(/\s/g, '-');
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
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
				
				result +="<div class='col-md-4 event-thumb'><div class='card event-card'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img class='img-fluid event-banner-img' src='<?php echo base_url(); ?>assets/events/banner/"+event_banner+"' alt='' ></a><div class='card-img-overlay'><span class='badge badge-pill badge-danger'>"+event_type+"</span></div><div class='card-body'><p class='card-text'><small class='text-time'><p>"+disp_date+", "+start_time+"<?php if ($user_id !=''){?>"+wishliststatus+"<?php } ?></p></small></p><div class='news-title'><p class=' title-small event-title-list'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></div><p class='card-text'><small class='text-time'><em>"+country_name+", "+city_name+"</em></small></p></div></div></div>";
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
		echo $event_name = $res->event_name;
		echo "'";
		if ($i < $tot_count) echo ",";
		 $i = $i+1;} ?>];
    $( "#search_term" ).autocomplete({
      source: availableTags
    });
  } ); 
</script>
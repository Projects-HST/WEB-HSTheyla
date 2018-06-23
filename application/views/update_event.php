<style>
.form_box{
	margin-bottom: 20px;
}
.error{
	color:red;
	font-weight: 400;
}
</style>
<?php
function get_times( $default = '10:00', $interval = '+15 minutes' )
{
	$output = '';
	$current = strtotime( '00:00:00' );
	$end = strtotime( '23:59:00' );
	while( $current <= $end ) {
		$time = date( 'H:i:s', $current );
		$sel = ( $time == $default ) ? ' selected' : '';
		$output .= "<option value=\"{$time}\">" . date( 'h.i A', $current ) .'</option>';
		$current = strtotime( $interval, $current );
	}
	return $output;
	}
?>
<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">
<div class="col-md-12" id="content">
	<h3 class="dashboard_tab">Update  Event</h3>
</div>
<div class="card">
	<?php	foreach($edit as $rows){} $sts=$rows->event_status; ?>
	<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>home/updateeventsdetails" name="eventform" id="eventform" onSubmit='return check();'>
<div class="col-md-12 form_box">
	<div class="form-group">
			<label for="Category" class="col-sm-2 col-form-label">Select Category</label>
			<div class="col-sm-4">
					<select class="form-control" name="category">
						<option value="">Select Category Name</option>
							 <?php foreach($category_list as $res){ ?>
									<option value="<?php echo $res->id; ?>"><?php echo $res->category_name; ?></option>
							 <?php } ?>
					</select>
           <script language="JavaScript">document.eventform.category.value="<?php echo $rows->category_id; ?>";</script>
			</div>
			<label for="Name" class="col-sm-2 col-form-label">Event Name</label>
			<div class="col-sm-4">
				  <input class="form-control" type="text"  name="event_name" value="<?php echo $rows->event_name; ?>">
			</div>
	</div>
</div>
<div class="col-md-12 form_box">
	       <div class="form-group">
	            <label for="country" class="col-sm-2 col-form-label">Select Country</label>
	            <div class="col-sm-4">
	              <select class="form-control" name="country" onchange="getcityname(this.value)">
	              <option value="">Select Country Name</option>
	                     <?php foreach($country_list as $cntry){ ?>
	                        <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
	                     <?php } ?>
	                </select>
                  <script language="JavaScript">document.eventform.country.value="<?php echo $rows->event_country; ?>";</script>
	            </div>
	             <label for="city" class="col-sm-2 col-form-label">Select City</label>
	            <div class="col-sm-4">
                <select class="form-control" name="city" id="ctname">
  							<?php
  								$cntyrid=$rows->event_country;
  								$sql="SELECT id,city_name FROM city_master WHERE country_id='$cntyrid' AND event_status='Y' ORDER BY id ASC";
  								$resu=$this->db->query($sql);
  								$res=$resu->result();
  								foreach ($res as $value) { ?>
  								<option value="<?php echo $value->id; ?>"><?php echo $value->city_name; ?></option>
  								<?php } ?>
  								</select>
  								<script language="JavaScript">document.eventform.city.value="<?php echo $rows->event_city; ?>";</script>
	                <div id="cmsg"></div>
	            </div>
	        </div>
</div>
	<div class="col-md-12 form_box">
		<div class="form-group">
				<label for="Venue" class="col-sm-2 col-form-label">Venue</label>
				<div class="col-sm-4">
					  <input class="form-control" type="text"  name="venue"  value="<?php echo $rows->event_venue; ?>">
				</div>
				 <label for="Address" class="col-sm-2 col-form-label">Address</label>
				<div class="col-sm-4">
          <textarea id="textarea" name="address" required="" class="form-control" maxlength="240" rows="3" placeholder="">
            <?php echo $rows->event_address; ?></textarea>
				</div>
		</div>
	</div>
	<div class="col-md-12 form_box">
		<div class="form-group">
				<label for="Description" class="col-sm-2 col-form-label">Description</label>
				<div class="col-sm-4">
          <textarea  id="textarea" required="" name="description" class="form-control" maxlength="30000" rows="3" placeholder=""><?php echo $rows->description; ?></textarea>
      	</div>

				 <label for="ecost" class="col-sm-2 col-form-label">Event Type</label>
				<div class="col-sm-4">
						 <select class="form-control"  name="eventcost">
								<option value="Free">Free</option>
								<option value="Paid">Paid</option>
								<option value="Invite">Invite</option>
						</select>
            <script language="JavaScript">document.eventform.eventcost.value="<?php echo $rows->event_type; ?>";</script>
				</div>
		</div>
	</div>
    <div class="col-md-12 form_box">
							<div class="form-group ">
									<label for="Status" class="col-sm-2 col-form-label">Advertisement Display</label>
									<div class="col-sm-4">
										 <select class="form-control" name="eadv_status">
													<option value="">Select Status</option>
													<option value="Y">Yes</option>
													<option value="N">No</option>
											</select>
                       <script language="JavaScript">document.eventform.eadv_status.value="<?php echo $rows->adv_status; ?>";</script>
									</div>

									 <label for="Status" class="col-sm-2 col-form-label">Hotspot Display</label>
									<div class="col-sm-4">
										 <select class="form-control" name="hotspot_sts" id="hotspot_sts">
													<option value="">Select Status</option>
													<option value="Y">Yes</option>
													<option value="N">No</option>
											</select>
                      <script language="JavaScript">document.eventform.hotspot_sts.value="<?php echo $rows->hotspot_status; ?>";</script>
									</div>

						 </div>
						</div>
                        <div id = "date_time">
		<div class="col-md-12 form_box">
			<div class="form-group">
					 <label for="sdate" class="col-sm-2 col-form-label">Start Date</label>
					 <div class="col-sm-4">
						 <div class="input-group">
               <input type="text" class="form-control" value="<?php $date=date_create($rows->start_date);echo date_format($date,"d-m-Y");  ?>" name="start_date" id="datepicker-autoclose">
               <span class="input-group-addon bg-custom b-0"><i class="far fa-calendar-plus"></i></span>
					 </div>
					 </div>

						<label for="edate" class="col-sm-2 col-form-label">End Date</label>
					 <div class="col-sm-4">
							<div class="input-group">
                <input type="text" class="form-control" required="" value="<?php $date=date_create($rows->end_date);echo date_format($date,"d-m-Y");  ?>" name="end_date" id="datepicker">
                <span class="input-group-addon bg-custom b-0"><i class="far fa-calendar-plus"></i></span>

					 </div>
					 </div>
			 </div>
		</div>
         </div>
			<div class="col-md-12 form_box">
				<div class="form-group">
				<label for="stime" class="col-sm-2 col-form-label">Start Time</label>
				<div class="col-sm-4">
					 <input  type="text" class="form-control" id="stime" name="start_time" value="<?php echo $rows->start_time; ?>">
				</div>
				 <label for="etime" class="col-sm-2 col-form-label">End Time</label>
				<div class="col-sm-4">
				<input  type="text" class="form-control" id="etime" name="end_time" value="<?php echo $rows->end_time; ?>">
				</div>
			</div>
			</div>

				<div class="col-md-12 form_box">
					<label for="latitude" class="col-sm-2 col-form-label">Select</label>
					 <div id="dvMap" style="width:300px; height:250px"> </div>
				</div>
					<div class="col-md-12 form_box">
						<div class="form-group">
								<label for="latitude" class="col-sm-2 col-form-label">Event Latitude</label>
								<div class="col-sm-4">
								  <input class="form-control" type="text" name="txtLatitude" value="<?php echo $rows->event_latitude; ?>" id="latu" >
										<div id="ermsg"></div> <div id="ermsg2"></div>
								</div>
									<label for="longitude" class="col-sm-2 col-form-label">Event Longitude</label>
								<div class="col-sm-4">
									  <input class="form-control" type="text" name="txtLongitude" id="lon" value="<?php echo $rows->event_longitude; ?>">
										 <div id="ermsg1"></div> <div id="ermsg3"></div>
								</div>
						</div>
					</div>
					<div class="col-md-12 form_box">
						<div class="form-group">
								<label for="primarycell" class="col-sm-2 col-form-label">Primary Contact Phone</label>
								<div class="col-sm-4">
                  <input class="form-control" type="text" required="" value="<?php echo $rows->primary_contact_no; ?>" name="pcontact_cell" maxlength="10" value="">

								</div>
								<label for="seccell" class="col-sm-2 col-form-label">Secondary Contact Phone</label>
								<div class="col-sm-4">
                  <input class="form-control" type="text" value="<?php echo $rows->secondary_contact_no; ?>" name="scontact_cell" value="" >

								</div>
						</div>
					</div>
						<div class="col-md-12 form_box">
							<div class="form-group">
									 <label for="Person" class="col-sm-2 col-form-label">Contact Person</label>
									 <div class="col-sm-4">
                     <input class="form-control" type="text" required="" value="<?php echo $rows->contact_person; ?>" name="contact_person" value="">

									 </div>
									 <label for="Email" class="col-sm-2 col-form-label">Contact Email</label>
									 <div class="col-sm-4">
										<input class="form-control" type="text" value="<?php echo $rows->contact_email; ?>" required="" name="email" value="" >
									 </div>
							 </div>
						</div>
						
						<div class="col-md-12 form_box">
							<div class="form-group">

									<label for="Colour" class="col-sm-2 col-form-label">Colour</label>
									<div class="col-sm-4">
											<!--input class="form-control" type="text" name="colour_scheme" value=""-->
											 <select class="form-control" name="colour_scheme">
													<option value="">Select Colour</option>
													<option value="green">Green</option>
													<option value="blue">Blue</option>
													<option value="red">Red</option>
											</select>
                      <script language="JavaScript">document.eventform.colour_scheme.value="<?php echo $rows->event_colour_scheme; ?>";</script>
									</div>

									 <label class="col-sm-2 col-form-label">Event Banner <span style="color:#F00;">(985*550px)</span></label>
										<div class="col-sm-4">
                      <input type="file" name="eventbanner" id="file_upload" class="form-control" accept="image/*" >
                      <input type="hidden" name="currentcpic" class="form-control" value="<?php echo $rows->event_banner;?>" >
                     <input type="hidden" name="eventid" class="form-control" value="<?php echo $rows->id; ?>" >
                      <img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $rows->event_banner; ?>" class="img-responsive" style="width:150px;">
                       <div id="preview" style="color: red;"></div>
										</div>
							</div>
						</div>
						<div class="col-md-12 form_box">
							<div class="form-group ">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-2">

                  <?php if($sts!='Y'){?>
                  <button type="submit" class="btn btn-primary waves-effect waves-light">
                  Update </button>
                  <?php } ?>
                </div>
                  <div class="col-sm-2">
                  </div>
							</div>
						</div>
   </form>
</div>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByz7sU142AeFwpK3KiFilK0IOoa2GU9tw"></script>
<script type="text/javascript">

	$('#stime').timepicki();
	$('#etime').timepicki();
  
	 window.onload = function () {
		var mapOptions = {
					center: new google.maps.LatLng(20.5937, 78.9629),
					zoom:4,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var infoWindow = new google.maps.InfoWindow();
				var latlngbounds = new google.maps.LatLngBounds();
				var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
				google.maps.event.addListener(map, 'click', function (e)
				{
				 var la=e.latLng.lat();
				 var lo=e.latLng.lng();
				 document.getElementById("latu").value=la;
				 document.getElementById("lon").value=lo;
				});
				
				var hotspot = "<?php echo $rows->hotspot_status; ?>";
			var ee = document.getElementById("date_time");
			if(hotspot == "Y") {
				ee.style.display = "none";
			} else {
				ee.style.display = "block";
			}
	 }

$(document).ready(function () {

	$('#datepicker').datetimepicker({format: 'DD-MM-YYYY'});
	$('#datepicker-autoclose').datetimepicker({format: 'DD-MM-YYYY'});
	  
	$('#hotspot_sts').on('change', function() {
	var strdisplay = $(this).val();
    var e = document.getElementById("date_time");
    if(strdisplay == "Y") {
        e.style.display = "none";
    } else {
        e.style.display = "block";
    }
  });
  
  $('#file_upload').on('change', function()
        {
          var f=this.files[0]
          var actual=f.size||f.fileSize;
          var orgi=actual/1024;
            if(orgi<1024){
              $("#preview").html('');
            }else{
              $("#preview").html('File Size Must be  Lesser than 1 MB');
              return false;
            }
        });

    $('#eventform').validate({ // initialize the plugin
       rules: {
         category:{required:true },
         event_name:{required:true },
         country:{required:true },
         city:{required:true },
         venue:{required:true },
         address:{required:true },
         description:{required:true },
         eventcost:{required:true },
         start_date:{required:true },
         end_date:{ required:true },
         start_time:{required:true },
         end_time:{required:true },
         eadv_status:{required:true},
         hotspot_sts:{required:true},
         pcontact_cell:{required:true },
         contact_person:{required:true },
         email:{required:true },
         event_status:{required:true },
         txtLatitude:{required:true },
         txtLongitude:{required:true }
        },

        messages: {
        category:"Select Category Name",
        event_name:"Enter Event Name",
        country:"Select Country Name",
        city:"Select City Name",
        venue:"Enter Venue",
        address:"Enter Address",
        description:"Enter Description",
        eventcost:"Select Event Type",
        start_date:"Select Start Date",
        end_date:"Select End Date",
        start_time:"Select Start Time",
        end_time:"Select End Time",
        eadv_status:"Select Advertisement Status ",
        hotspot_sts:"Select Hotspot Status ",
        pcontact_cell:"Enter Primary Contact Number",
        contact_person:"Enter Name",
        email:"Enter Email",
        event_status:"Select Status",
        txtLatitude:"Enter Latitude",
        txtLongitude:"Enter Longitude"
       },
         });
   });

	function getcityname(cid) {
			$.ajax({
			type: 'post',
			url: '<?php echo base_url(); ?>events/get_city_name',
			data: { country_id:cid },
			dataType: "JSON",
			cache: false,
			success:function(cty)
            {
				// alert(cty);
				var len = cty.length;
				//alert(len);
				var cityname='';
				var ctitle='<option value="">Select City</option>';
				if(cty!='')
				{    //alert(len);
					for(var i=0; i<len; i++)
					{
					 var cityid = cty[i].id;
					 var city_name = cty[i].city_name;
					 //alert(city_name);
					 cityname +='<option value=' + cityid + '> ' + city_name + ' </option>';
					}
				$("#ctname").html(ctitle+cityname).show();
				$("#cmsg").hide();
				}else{
				$("#ctname").html(ctitle+cityname).show();	
				
				
				}
            }
          });
       }

function check()
{
      var fdate = document.getElementById("datepicker-autoclose").value;
      var tdate = document.getElementById("datepicker").value;

      var chunks = fdate.split('-');
      var formattedDate = chunks[1]+'/'+chunks[0]+'/'+chunks[2];

      var chunks1 = tdate.split('-');
      var formattedDate1 = chunks1[1]+'/'+chunks1[0]+'/'+chunks1[2];

      if(Date.parse(formattedDate) > Date.parse(formattedDate1) )
      {
		alert("Startdate should be less than Enddate");
		return false;
      }

      if(Date.parse(formattedDate)==Date.parse(formattedDate1) )
      {
        var strStartTime = document.getElementById("stime").value;
        var strEndTime = document.getElementById("etime").value;

        var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
        var endTime = new Date(startTime)
        endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);

         temp =strStartTime.split(":");
         var a = temp[0];
         var b = temp[1];
         temp1 =b.split(" ");
         var c = temp1[1]

        if(a==12 && c=='AM'){

        }else if (startTime > endTime){
          alert("Start Time is greater than end time");
          return false;
        }
    }else{
        var date1 = new Date(formattedDate);
        var date2 = new Date(formattedDate1);

         var y1=chunks[2];
         var y2=chunks1[2];
        if(y1<y2){
            //alert(chunks[2]);alert(chunks1[2]);
        }else{
          var strStartTime = document.getElementById("stime").value;
          var strEndTime = document.getElementById("etime").value;
          var startTime = date1.setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
          var endTime = new Date(startTime);
          endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
          var a=formattedDate + '' +startTime;
          var b=formattedDate1 + ''+endTime;
          //alert(startTime);alert(endTime); alert(a);alert(b);
          if (a == b || a > b) {
          alert("Start Date & Time is greater than end Date & Time");
          return false;
          }
        }
    }
    function GetHours(d)
    {
        var h = parseInt(d.split(':')[0]);
        if (d.split(':')[1].split(' ')[1] == "PM") {
        h = h + 12;
		} 
      return h;
    }
	
	function GetMinutes(d)
    {
		return parseInt(d.split(':')[1].split(' ')[0]);
    }

}
</script>

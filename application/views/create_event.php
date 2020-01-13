<?php
  	$dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
	$current_time = $dateTime->format("h:i A");
	
	$ip=$_SERVER['REMOTE_ADDR'];
	$access_key = 'ed4a0ff6cd906632c411e531777136e5';
	// Initialize CURL:
	$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Store the data:
	$json = curl_exec($ch);
	curl_close($ch);
	// Decode JSON response:
	$api_result = json_decode($json, true);
	 $country=$api_result['country_name'];
	 $slatitude=$api_result['latitude'];
	 $slongitude=$api_result['longitude'];
?>
<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">
<style>
.form_box{
	margin-bottom: 20px;
}
.footer_section{
  display: none;
}
.error{
	color:red;
	font-weight: 400;
}
.col-form-label{
  font-size: 18px;
  font-weight: 500;
}
.form-control{
  font-size: 16px;
}
.createevent_active{
  border-left: 4px solid #458ecc;
}
.card{
  background-color: #fff;
  margin-left: 50px;
  margin-right: 50px;
  box-shadow: 3px 11px 15px 0px #959696;

	margin-top: 20px;
	margin-bottom: 20px;
}
.ui-datepicker-trigger{cursor:pointer}

</style>

<div class="col-md-12" id="content">
	<h3 class="dashboard_tab">Create Event</h3>
</div>
<div class="col-md-12">

<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>home/insertevents" name="eventform" id="eventform" onSubmit='return check();'>
  <div class="col-md-12 form_box">
  	       <div class="form-group">


  	             <label for="city" class="col-sm-2 col-form-label">Select Location <span class="red_txt_label">*</span></label>
  	            <div class="col-sm-4">
  	               <select class="form-control" name="city"  id="ctname">
                     <option value="">Select Location</option>
  	                     <?php foreach($city_list as $cty){ ?>
  	                        <option value="<?php echo $cty->id; ?>"><?php echo $cty->city_name; ?></option>
  	               <?php } ?>
				    </select>
  	            </div>

				<label for="Category" class="col-sm-2 col-form-label">Select Category <span class="red_txt_label">*</span></label>
			<div class="col-sm-4">
					<select class="form-control" name="category">
						<option value="">Select Category Name</option>
							 <?php foreach($category_list as $res){ ?>
									<option value="<?php echo $res->id; ?>"><?php echo $res->category_name; ?></option>
							 <?php } ?>
					</select>
			</div>

  	        </div>
  </div>
<div class="col-md-12 form_box">
	<div class="form-group">

			<label for="Name" class="col-sm-2 col-form-label">Event Name <span class="red_txt_label">*</span></label>
			<div class="col-sm-4">
					<input class="form-control" type="text"  name="event_name" maxlength="100">
			</div>

	<label for="Venue" class="col-sm-2 col-form-label">Venue <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
						<input class="form-control" type="text"  name="venue" maxlength="50">
				</div>
	</div>
</div>

	<div class="col-md-12 form_box">
		<div class="form-group">
				<label for="Address" class="col-sm-2 col-form-label">Address <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
					 <textarea id="address" name="address"  class="form-control" maxlength="240" rows="3" placeholder=""></textarea>
				</div>

		</div>
	</div>
  <div class="col-md-12 form_box">
    <label for="latitude" class="col-sm-12 col-form-label">Choose the latitude and longitude by clicking on the map</label>
     <div id="dvMap" style="width:100%; height:250px"> </div>
  </div>



  <div class="col-md-12 form_box">
    <div class="form-group">
        <label for="latitude" class="col-sm-2 col-form-label">Event Latitude <span class="red_txt_label">*</span></label>
        <div class="col-sm-4">
            <input class="form-control" type="text" name="txtLatitude"  id="latu" maxlength="20">
            <div id="ermsg"></div> <div id="ermsg2"></div>
        </div>
          <label for="longitude" class="col-sm-2 col-form-label">Event Longitude <span class="red_txt_label">*</span></label>
        <div class="col-sm-4">
            <input class="form-control" type="text" name="txtLongitude" id="lon" maxlength="20">
             <div id="ermsg1"></div> <div id="ermsg3"></div>
        </div>
    </div>
  </div>
  <div class="col-md-12 form_box">
    <div class="form-group">
      <label for="Description" class="col-sm-2 col-form-label">Description <span class="red_txt_label">*</span></label>
         <div class="col-sm-12">
             <textarea  id="description"  name="description" class="form-control" maxlength="30000" rows="8" placeholder=""></textarea>
         </div>
      </div>
  </div>

             <div id = "date_time">
			<div class="col-md-12 form_box">
			<div class="form-group">
					 <label for="sdate" class="col-sm-2 col-form-label">Start Date <span class="red_txt_label">*</span></label>
					 <div class="col-sm-4">

							 <input type="text" class="form-control"  name="start_date" id="datepicker-autoclose" value="<?php echo date("d-m-Y"); ?>">

					 </div>

						<label for="edate" class="col-sm-2 col-form-label">End Date <span class="red_txt_label">*</span></label>
					 <div class="col-sm-4">

							 <input type="text" class="form-control" name="end_date" id="datepicker" value="<?php echo date("d-m-Y"); ?>">

					 </div>
			 </div>
		</div>
        </div>
			<div class="col-md-12 form_box">
				<div class="form-group">
				<label for="stime" class="col-sm-2 col-form-label">Start Time <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
					 <input  type="text" class="form-control" id="stime" name="start_time">
				</div>
				 <label for="etime" class="col-sm-2 col-form-label">End Time <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
					<input  type="text" class="form-control" id="etime" name="end_time" >
				</div>
			</div>
			</div>
      <div class="col-md-12 form_box">
        <div class="form-group">




			<label for="Person" class="col-sm-2 col-form-label">Contact Person <span class="red_txt_label">*</span></label>
			 <div class="col-sm-4">
					 <input class="form-control" type="text"  name="contact_person" value="" maxlength="50">
			 </div>
			 <label for="Person" class="col-sm-2 col-form-label">Secondary Contact Person</label>
			 <div class="col-sm-4">
					 <input class="form-control" type="text"  name="sec_contact_person" value="" maxlength="50">
			 </div>

        </div>
      </div>


	  					<div class="col-md-12 form_box">
						<div class="form-group">
								<label for="primarycell" class="col-sm-2 col-form-label">Primary Contact Phone <span class="red_txt_label">*</span></label>
								<div class="col-sm-4">
										<input class="form-control" type="text"  name="pcontact_cell" maxlength="10" value="">
								</div>
								<label for="seccell" class="col-sm-2 col-form-label">Secondary Contact Phone</label>
								<div class="col-sm-4">
										<input class="form-control" type="text" name="scontact_cell" value="" maxlength="10">
								</div>
						</div>
					</div>

					<div class="col-md-12 form_box">
							<div class="form-group">

									 <label for="Email" class="col-sm-2 col-form-label">Contact Email <span class="red_txt_label">*</span></label>
									 <div class="col-sm-4">
											 <input class="form-control" type="text"  name="email" value="" maxlength="50">
									 </div>

									              <label for="ecost" class="col-sm-2 col-form-label">Event Type <span class="red_txt_label">*</span></label>
            <div class="col-sm-4">
                 <select class="form-control"  name="eventcost">
					<option value="">Select Type</option>
                    <option value="Free">Free</option>
                    <option value="Paid">Paid</option>
                </select>
            </div>
							 </div>
						</div>
        <div class="col-md-12 form_box">
                  <div class="form-group ">
                      <label for="Status" class="col-sm-2 col-form-label">Advertisement Display <span class="red_txt_label">*</span></label>
                      <div class="col-sm-4">
                         <select class="form-control" name="eadv_status">
                              <option value="">Select Status</option>
                              <option value="Y">Yes</option>
                              <option value="N">No</option>
                          </select>
                      </div>

                       <label for="Status" class="col-sm-2 col-form-label">Hotspot Display <span class="red_txt_label">*</span></label>
                      <div class="col-sm-4">
                         <select class="form-control" name="hotspot_sts"  id="hotspot_sts">
                              <option value="">Select Status</option>
                              <option value="Y">Yes</option>
                              <option value="N">No</option>
                          </select>
                      </div>

                 </div>
                </div>






						<div class="col-md-12 form_box">
							<div class="form-group">

									<!--<label for="Colour" class="col-sm-2 col-form-label">Colour</label>
									<div class="col-sm-4">
											 <select class="form-control" name="colour_scheme">
													<option value="">Select Colour</option>
													<option value="green">Green</option>
													<option value="blue">Blue</option>
													<option value="red">Red</option>
											</select>
									</div>-->

									 <label class="col-sm-2 col-form-label">Event Banner <span style="color:#F00;">(985*550px)</span></label>
										<div class="col-sm-4">
											 <input type="file" name="eventbanner" id="file_upload" class="form-control" accept="image/*" >
												<div id="preview" style="color: red;"></div>
										</div>
							</div>
						</div>
						<div class="col-md-12 form_box">
							<div class="form-group row">
									<label class="col-sm-2 col-form-label"></label>
									<div class="col-sm-8 text-center">
										<button type="submit" class="btn btn-primary waves-effect waves-light" style="font-size:18px;">
										Submit </button> &nbsp;
										<button type="reset" class="btn btn-secondary waves-effect m-l-5" style="font-size:18px;">
										Reset
										</button>
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
					center: new google.maps.LatLng(<?php echo  $slatitude; ?>, <?php echo $slongitude;?>),
					zoom:12,
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
	 }

$(document).ready(function () {

	$('#datepicker').datetimepicker({format: 'DD-MM-YYYY',minDate : moment()});
	$('#datepicker-autoclose').datetimepicker({format: 'DD-MM-YYYY',minDate: moment()});

	$('#hotspot_sts').on('change', function() {
	var strdisplay = $(this).val();
    var e = document.getElementById("date_time");
    if(strdisplay == "Y") {
        e.style.display = "none";
    } else {
        e.style.display = "block";
    }
  });

  $('#file_upload').on('change', function() {
	  var f=this.files[0]
	  var actual=f.size||f.fileSize;
	  var orgi=actual/1024;
		if(orgi<1024){
		  $("#preview").html('');
		  //$("#preview").html('<img src="<?php echo base_url(); ?>assets/loader.gif" alt="Uploading...."/>');
		  $("#eventform").ajaxForm({
			  target: '#preview'
		  }).submit();
		}else{
		  //$("#preview").html('File Size Must be  Lesser than 1 MB');
		  //alert("File Size Must be  Lesser than 1 MB");
		  return false;
		}
	});
	
  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, 'File size must be less than 1 MB');

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
		 pcontact_cell:{required:true,digits:true,maxlength:12,minlength:8 },
		 scontact_cell:{required:false,digits:true,maxlength:12,minlength:8 },
         contact_person:{required:true },
         email:{required:true },
         event_status:{required:true },
         txtLatitude:{required:true },
         txtLongitude:{required:true },
		 eventbanner:{required:true }
        },

        messages: {
        category:"Select Category Name",
        event_name:"Enter Event Name",
        country:"Select Country Name",
        city:"Select Location",
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
		pcontact_cell:{
          required:"Enter Primary Contact Number",
          digits:"Only numbers",
        },
		scontact_cell:{
          digits:"Only numbers",
        },
        contact_person:"Enter Name",
        email:"Enter Email",
        event_status:"Select Status",
        txtLatitude:"Enter Latitude",
        txtLongitude:"Enter Longitude",
		eventbanner:{
          required:"Select banner",
          accept:"Please upload .jpg or .png .",
          fileSize:"File must be JPG or PNG, less than 1MB"
        }
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

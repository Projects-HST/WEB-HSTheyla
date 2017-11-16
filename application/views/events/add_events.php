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
<div class="content-page">
<!-- Footer Close-->
<!-- Start content -->
<div class="content">
   <!-- Top Bar Start -->
   <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <!--li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>
            </li!-->
            <li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
               </a>
               <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                  <!--a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                  <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                  <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a!-->
                  <a class="dropdown-item" href="<?php echo base_url(); ?>adminlogin/logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
               </div>
            </li>
         </ul>
         <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
               <button type="button" class="button-menu-mobile open-left waves-effect">
               <i class="ion-navicon"></i>
               </button>
            </li>
            <li class="hide-phone list-inline-item app-search">
               <h3 class="page-title">Add Events</h3>
            </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
   </div>
   <div class="page-content-wrapper ">
     <div class="container">
        <div class="row">
           <!--div class="col-12">
            <div class="card m-b-20">
                <div class="card-block">
                    </div>
            </div>
           </div-->
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">
                 <h4 class="mt-0 header-title"></h4>

                  <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                       ×</button> <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                  <?php endif; ?>

                <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>events/add_events" name="eventform" id="eventform" onSubmit='return check();'>

                        <div class="form-group row">
                            <label for="Category" class="col-sm-2 col-form-label">Select Category</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="category">
                                  <option value="">Select Category Name</option>
                                     <?php foreach($category_list as $res){ ?>
                                        <option value="<?php echo $res->id; ?>"><?php echo $res->category_name; ?></option>
                                     <?php } ?>
                                </select>
                            </div>

                            <label for="Name" class="col-sm-2 col-form-label">Event Name</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text"  name="event_name">
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="country" class="col-sm-2 col-form-label">Select Country</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="country" onchange="getcityname(this.value)">
                              <option value="">Select Country Name</option>
                                     <?php foreach($country_list as $cntry){ ?>
                                        <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                </select>
                            </div>
                             <label for="city" class="col-sm-2 col-form-label">Select City</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="city"  id="ctname">
                                </select>
                                <div id="cmsg"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Venue" class="col-sm-2 col-form-label">Venue</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text"  name="venue"  >
                            </div>
                             <label for="Address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-4">
                               <textarea id="textarea" name="address"  class="form-control" maxlength="240" rows="3" placeholder=""></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-4">
                                <textarea  id="textarea"  name="description" class="form-control" maxlength="30000" rows="3" placeholder=""> </textarea>
                            </div>

                             <label for="ecost" class="col-sm-2 col-form-label">Event Type</label>
                            <div class="col-sm-4">
                                 <select class="form-control"  name="eventcost">
                                    <option value="Free">Free</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Invite">Invite</option>
                                </select>
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="sdate" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <input type="text" class="form-control datepicker"  name="start_date" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>

                             <label for="edate" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-4">
                               <div class="input-group">
                                <input type="text" class="form-control datepicker" name="end_date" id="datepicker">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                                 
                            </div>
                            </div>
                        </div>

                        <div class="form-group row">
                           
                            <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">

                               <input  type="text" class="form-control" id="stime" name="start_time">

                                <!-- select name="start_time" required="" class="form-control"  >
                                     <option value="">Select Start Time</option>
                                     <option value="<?php echo get_times(); ?>"><?php echo get_times(); ?></option>
                                </select>
                                <script language="JavaScript">document.eventform.start_time.value="<?php echo $rows->start_time; ?>";</script-->

                            </div>

                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                              <input  type="text" class="form-control" id="etime" name="end_time" >
                                <!--select name="end_time" required="" class="form-control" id="etime">
                                     <option value="">Select End Time</option>
                                     <option value="<?php echo get_times(); ?>"><?php echo get_times(); ?></option>
                                </select>
                                 <script language="JavaScript">document.eventform.end_time.value="<?php echo $rows->end_time; ?>";</script-->
                            </div>

                        </div>
                          <div class="form-group row">
                             <label for="latitude" class="col-sm-2 col-form-label">Select</label>
                            <div id="dvMap" style="width:500px; height:350px"> </div>

                          </div>
                        <div class="form-group row">
                            <label for="latitude" class="col-sm-2 col-form-label">Event Latitude</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="txtLatitude"  id="latu" >
                                <div id="ermsg"></div> <div id="ermsg2"></div>
                            </div>
                              <label for="longitude" class="col-sm-2 col-form-label">Event Longitude</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="txtLongitude" id="lon">
                                 <div id="ermsg1"></div> <div id="ermsg3"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="primarycell" class="col-sm-2 col-form-label">primary Contact Phone</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text"  name="pcontact_cell" maxlength="10" value="">
                            </div>
                            <label for="seccell" class="col-sm-2 col-form-label">secondary Contact Phone</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="scontact_cell" value="" >
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="Person" class="col-sm-2 col-form-label">Contact Person</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text"  name="contact_person" value="">
                            </div>
                            <label for="Email" class="col-sm-2 col-form-label">Contact Email</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text"  name="email" value="" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Advertisement Display</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="eadv_status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                        <label for="Colour" class="col-sm-2 col-form-label">Booking Display</label>
                            <div class="col-sm-4">
                                 <select class="form-control" name="booking_sts">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                       </div>

                        <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Hotspot Display</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="hotspot_sts">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>

                            <label for="Colour" class="col-sm-2 col-form-label">Colour</label>
                            <div class="col-sm-4">
                                <!--input class="form-control" type="text" name="colour_scheme" value=""-->
                                 <select class="form-control" name="colour_scheme">
                                    <option value="">Select Colour</option>
                                    <option value="green">Green</option>
                                    <option value="blue">Blue</option>
                                    <option value="red">Red</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Event Display</label>
                            <div class="col-sm-4">
                               <select class="form-control"  name="event_status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>

                            <label class="col-sm-2 col-form-label">Event Banner</label>
                              <div class="col-sm-4">
                                 <input type="file" name="eventbanner" class="form-control" accept="image/*" >
                              </div>                            
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-2">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit </button></div>
                              <div class="col-sm-2">
                              <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                              Reset
                              </button></div>
                        </div>

                     </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

                        </div><!-- container -->
   </div>
   <!-- Page content Wrapper -->
</div>
<!-- content -->
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
             //alert(la); alert(lo);
            //alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
            });
 }

      
  $(document).ready(function () {
      
      $( ".datepicker" ).datepicker({
        format: 'dd-mm-yyyy'
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
        hotspot_sts:"Select Hotspot Display Status ",
        pcontact_cell:"Enter Cell Number",
        contact_person:"Enter Name",
        email:"Enter Email",
        event_status:"Select Status",
        txtLatitude:"Enter Latitude",
        txtLongitude:"Enter Longitude",
       },
         }); 
   });
  
 function getcityname(cid) {
           //alert(cid);
            $.ajax({
               type: 'post',
               url: '<?php echo base_url(); ?>events/get_city_name',
               data: { country_id:cid },
             dataType: "JSON",
             cache: false,
            success:function(test)
            {
              // alert(test);
               var len = test.length;
               //alert(len);
                var cityname='';
                var ctitle='<option>Select City</option>';
                if(test!='')
                 {    //alert(len);
                   for(var i=0; i<len; i++)
                   {
                     var cityid = test[i].id;
                     var city_name = test[i].city_name;
                     //alert(city_name);
                     cityname +='<option value=' + cityid + '> ' + city_name + ' </option>';
                  }
                  $("#ctname").html(ctitle+cityname).show();
                  $("#cmsg").hide();
                  }else{
                  $("#cmsg").html('<p style="color: red;">City Not Found</p>').show();
                  $("#ctname").hide();
                 }
            }
          }); 
       }

function check()
{
      var fdate = document.getElementById("datepicker-autoclose").value;
      var tdate = document.getElementById("datepicker").value;

       //alert(fdate);alert(tdate);
      var chunks = fdate.split('-');
      var formattedDate = chunks[1]+'/'+chunks[0]+'/'+chunks[2];
       //alert(formattedDate);
      var chunks1 = tdate.split('-');
      var formattedDate1 = chunks1[1]+'/'+chunks1[0]+'/'+chunks1[2];
      //alert(formattedDate1);
      //alert( Date.parse(formattedDate));
      //alert( Date.parse(formattedDate1));
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
        if (startTime > endTime) {
        alert("Start Time is greater than end time");
         return false; }
  
    }else{
        var date1 = new Date(fdate);
      var date2 = new Date(tdate);
      var strStartTime = document.getElementById("stime").value;
      var strEndTime = document.getElementById("etime").value;
       var startTime = date1.setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
       var endTime = new Date(startTime);
       endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
      var a=formattedDate + '' + strStartTime;
      var b=formattedDate1 + '' + strEndTime;
      //alert(startTime);alert(endTime); alert(a);alert(b); 
      if (a == b || a > b) {
      alert("Start Date & Time is greater than end Date & Time");
      return false;
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


  if(document.eventform.txtLatitude.value!="")
    {
            sLatitude = document.eventform.txtLatitude.value
            if(isNaN(sLatitude) || sLatitude.indexOf(".")<0)
            {
                $("#ermsg2").html('<p style="color:red;">Please enter valid Latitude.</p>').show();
                $("#ermsg").hide();
                //alert ("Please enter valid Latitude.")
                document.eventform.txtLatitude.focus();
                return false;
            }else{
                 $("#ermsg").hide();
                 $("#ermsg2").hide();
            }
    }

    if(document.eventform.txtLongitude.value!="")
    {
            sLongitude = document.eventform.txtLongitude.value
            
            if(isNaN(sLongitude) || sLongitude.indexOf(".")<0)
            {
                //alert ("Please enter valid Longitude.")
                 $("#ermsg3").html('<p style="color: red;">Please enter valid Longitude.</p>').show();
                 $("#ermsg1").hide();
                document.eventform.txtLongitude.focus();
                return false;
            }else{
                 $("#ermsg1").hide();
                 $("#ermsg3").hide();
            }
    }

    // if(document.eventform.txtLatitude.value!="")

    // {
    //     var latitude = document.eventform.txtLatitude.value;
    //     var longitude = document.eventform.txtLongitude.value;
        
    //     var reg = new RegExp("^[-+]?[0-9]{1,3}(?:\.[0-9]{1,10})?$");
        
    //     if( reg.exec(latitude) ) {
    //      //do nothing
    //     } else {
    //          $("#ermsg2").html('<p style="color: red;">Please enter valid Latitude.</p>').show();
    //          $("#ermsg").hide();
    //         //alert("Please enter valid Latitude.");
    //         document.eventform.txtLatitude.focus();
    //         return false;
    //     }
        
    //     if( reg.exec(longitude) ) {
    //      //do nothing
    //     } else {
    //         //alert("Please enter valid Longitude.");
    //         $("#ermsg3").html('<p style="color: red;">Please enter valid Longitude.</p>').show();
    //         $("#ermsg1").hide();
    //         document.eventform.txtLongitude.focus();
    //         return false;
    //     }
    // }
    
}

</script>



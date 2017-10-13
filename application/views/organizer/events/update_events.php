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
<style type="text/css">
   .img-circle{
          width: 90px;
         border-radius: 30px;
         margin-top: 10px;
       }
</style>
<div class="container" style="margin-top:30px;margin-bottom:50px;max-width:100%;">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="<?php echo base_url(); ?>home" class="list-group-item">Dashboard</a>
            <a href="<?php echo base_url(); ?>organizer/createevents/" class="list-group-item">Create Events</a>
            <a href="<?php echo base_url(); ?>organizer/viewevents/" class="list-group-item active">View Events</a>
            <a href="<?php echo base_url(); ?>organizerbooking/view_booking/" class="list-group-item">Bookings</a>
            <a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a>
            <a href="organizer/reviews/" class="list-group-item">Reviews</a>
            <a href="organizer/followers/" class="list-group-item">Followers</a>
          </div>
        </div><!--/span-->
        
        <div class="col-12 col-md-9">
          
         <div class="page-content-wrapper ">
     <div class="container">

        <div class="row">
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

               
                 <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>organizer/updateeventsdetails" name="eventform" id="eventform" onSubmit='return check();'>
                  <?php foreach($edit as $rows){}?>
                        <div class="form-group row">
                            <label for="Category" class="col-sm-2 col-form-label">Select Category</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="category" required="">
                                  <option value="">Select Category Name</option>
                                     <?php foreach($category_list as $res){ ?>
                                        <option value="<?php echo $res->id; ?>"><?php echo $res->category_name; ?></option>
                                     <?php } ?>
                                </select>
                              <script language="JavaScript">document.eventform.category.value="<?php echo $rows->category_id; ?>";</script>
                            </div>

                            <label for="Name" class="col-sm-2 col-form-label">Event Name</label>
                            <div class="col-sm-4">
                              <input class="form-control" type="text" required="" name="event_name" value="<?php echo $rows->event_name; ?>">
                            </div>

                        </div>
                       <div class="form-group row">
                            <label for="country" class="col-sm-2 col-form-label">Select Country</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="country" required="" onchange="getcityname(this.value)">
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
                        <div class="form-group row">
                           
                            <label for="Venue" class="col-sm-2 col-form-label">Venue</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" value="<?php echo $rows->event_venue; ?>" required="" name="venue"  >
                            </div>
                             <label for="Address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-4">
                               <textarea id="textarea" name="address" required="" class="form-control" maxlength="240" rows="3" placeholder=""><?php echo $rows->event_address; ?></textarea>
                            </div>

                        </div>
                        <div class="form-group row">
                           
                            <label for="Description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-4">
                                <textarea  id="textarea" required="" name="description" class="form-control" maxlength="30000" rows="3" placeholder=""><?php echo $rows->description; ?></textarea>
                            </div>

                             <label for="ecost" class="col-sm-2 col-form-label">Event Type</label>
                            <div class="col-sm-4">
                                 <select class="form-control" required="" name="eventcost">
                                    <option value="Free">Free</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Invite">Invite</option>
                                </select>
                                <script language="JavaScript">document.eventform.eventcost.value="<?php echo $rows->event_type; ?>";</script>
                            </div>
                        </div>
                       <div class="form-group row">
                           
                            <label for="sdate" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <input type="text" class="form-control" value="<?php $date=date_create($rows->start_date);echo date_format($date,"m/d/Y");  ?>" name="start_date" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>

                             <label for="edate" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-4">
                               <div class="input-group">
                                <input type="text" class="form-control" required="" value="<?php $date=date_create($rows->end_date);echo date_format($date,"m/d/Y");  ?>" name="end_date" id="datepicker">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                           
                            <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">
                                <select name="start_time" required="" class="form-control" id="stime" >
                                     <option value="">Select Start Time</option>
                                     <option value="<?php echo get_times(); ?>"><?php echo get_times(); ?></option>
                                </select>
                                <script language="JavaScript">document.eventform.start_time.value="<?php echo $rows->start_time; ?>";</script>

                            </div>

                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                                <select name="end_time" required="" class="form-control" id="etime">
                                     <option value="">Select End Time</option>
                                     <option value="<?php echo get_times(); ?>"><?php echo get_times(); ?></option>
                                </select>
                                 <script language="JavaScript">document.eventform.end_time.value="<?php echo $rows->end_time; ?>";</script>
                            </div>

                        </div>
                        <div class="form-group row">
                             <label for="latitude" class="col-sm-2 col-form-label">Select</label>
                            <div id="dvMap" style="width:300px; height:250px"> </div>

                          </div>
                        <div class="form-group row">
                           
                            <label for="latitude" class="col-sm-2 col-form-label">Event Latitude</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="txtLatitude" value="<?php echo $rows->event_latitude; ?>" id="latu" >
                                <div id="ermsg"></div> <div id="ermsg2"></div>
                            </div>
                              <label for="longitude" class="col-sm-2 col-form-label">Event Longitude</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" value="<?php echo $rows->event_longitude; ?>" name="txtLongitude" id="lon">
                                 <div id="ermsg1"></div> <div id="ermsg3"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="primarycell" class="col-sm-2 col-form-label">primary Contact Phone</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" required="" value="<?php echo $rows->primary_contact_no; ?>" name="pcontact_cell" maxlength="10" value="">
                            </div>
                            <label for="seccell" class="col-sm-2 col-form-label">secondary Contact Phone</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" value="<?php echo $rows->secondary_contact_no; ?>" name="scontact_cell" value="" >
                            </div>
                        </div>
                       <div class="form-group row">
                            <label for="Person" class="col-sm-2 col-form-label">Contact Person</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" required="" value="<?php echo $rows->contact_person; ?>" name="contact_person" value="">
                            </div>
                            <label for="Email" class="col-sm-2 col-form-label">Contact Email</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" value="<?php echo $rows->contact_email; ?>" required="" name="email" value="" >
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
                                <script language="JavaScript">document.eventform.eadv_status.value="<?php echo $rows->adv_status; ?>";</script>
                            </div>
                        
                        <label for="Colour" class="col-sm-2 col-form-label">Booking Display</label>
                            <div class="col-sm-4">
                                 <select class="form-control" name="booking_sts">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                <script language="JavaScript">document.eventform.booking_sts.value="<?php echo $rows->booking_status; ?>";</script>
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
                                <script language="JavaScript">document.eventform.hotspot_sts.value="<?php echo $rows->hotspot_status; ?>";</script>
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
                                <script language="JavaScript">document.eventform.colour_scheme.value="<?php echo $rows->event_colour_scheme; ?>";</script>

                            </div>

                        </div>


                        <div class="form-group row">
                            
                            <label for="Status" class="col-sm-2 col-form-label">Event Display</label>
                            <div class="col-sm-4">
                               <select class="form-control" required="" name="event_status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                <script language="JavaScript">document.eventform.event_status.value="<?php echo $rows->event_status; ?>";</script>
                            </div>

                            <label class="col-sm-2 col-form-label">Event Banner</label>
                              <div class="col-sm-4">
                                 <input type="file" name="eventbanner" class="form-control" accept="image/*" >
                               <input type="hidden" name="currentcpic" class="form-control" value="<?php echo $rows->event_banner;?>" >
                              <input type="hidden" name="eventid" class="form-control" value="<?php echo $rows->id; ?>" >
                               <img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $rows->event_banner; ?>" class="img-circle">
                              </div>                            
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-2">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Update </button></div>
                              <div class="col-sm-2">
                              </div>
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
         
        </div><!--/span-->

        
      </div><!--/row-->
 </div>

      


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByz7sU142AeFwpK3KiFilK0IOoa2GU9tw"></script>

<script type="text/javascript">
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
         end_date:{required:true },
         start_time:{required:true },
         end_time:{required:true },
         pcontact_cell:{required:true },
         contact_person:{required:true },
         email:{required:true },
         eadv_status:{required:true},
         hotspot_sts:{required:true},
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
        pcontact_cell:"Enter Cell Number",
        contact_person:"Enter Name",
         eadv_status:"Select Advertisement Status ",
        hotspot_sts:"Select Hotspot Display Status ",
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
               url: '<?php echo base_url(); ?>organizer/get_city_name',
               data: {
                   country_id:cid
               },
             dataType: "JSON",
             cache: false,
            success:function(test)
            {
              // alert(test);
               var len = test.length;
               //alert(len);
                var cityname='';
                if(test!='')
                 {    //alert(len);
                   for(var i=0; i<len; i++)
                   {
                     var cityid = test[i].id;
                     var city_name = test[i].city_name;
                     //alert(city_name);
                     cityname +='<option value=' + cityid + '> ' + city_name + ' </option>';
                  }
                  $("#ctname").html(cityname).show();
                  $("#cmsg").hide();
                  $("#cityid").hide();
                  $("#new").show();
                  }else{
                  $("#cmsg").html('<p style="color: red;">City Not Found</p>').show();
                  $("#ctname").hide();
                 }
            }
          }); 
       }

function check()
{

  if(document.eventform.txtLatitude.value=="")
    {
            //alert("Please enter Latitude.");
            $("#ermsg").html('<p style="color: red;">Please enter Latitude.</p>');
            document.eventform.txtLatitude.focus();
            return false;
    }
    
    if(document.eventform.txtLongitude.value=="")
    {
            //alert("Please enter Longitude.");
            $("#ermsg1").html('<p style="color: red;">Please enter Longitude.</p>');
            document.eventform.txtLongitude.focus();
            return false;
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
      
      var objFromDate = document.getElementById("datepicker-autoclose").value;
      var objToDate = document.getElementById("datepicker").value;
     
      var date1 = new Date(objFromDate);
      var date2 = new Date(objToDate);
       
      var date3 = new Date();
      var date4 = date3.getMonth() + "/" + date3.getDay() + "/" + date3.getYear();
      var currentDate = new Date(date4);
       
      if(date1 > date2)
      {
        alert("Startdate should be less than Enddate");
        return false; 
      }


      var strStartTime = document.getElementById("stime").value;
      var strEndTime = document.getElementById("etime").value;

      var startTime = date1.setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
      var endTime = new Date(startTime);
      endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
      
      var a=objFromDate + '' + startTime;
      var b=objToDate + '' + endTime;
     //alert(a);alert(b);
      if (a == b || a > b) {
      alert("Start Date & Time is greater than end Date & Time");
      return false;
      }

      // if (startTime > endTime) {
      //  alert("Start Time is greater than end time");
      //  return false;
      // }
      // if (startTime == endTime) {
      // alert("Start Time equals end time");
      // return false;
      // }
      // if (startTime < endTime) {
      // alert("Start Time is less than end time");
      // return false;
      // }
      
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

 



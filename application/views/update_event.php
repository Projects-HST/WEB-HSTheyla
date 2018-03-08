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
<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">
<div class="container-fluid page-bg">
<div class="">
<div class="row header-title leaderboard-bg">
  <div class="col-md-12">
  <div class="container">
      <p class="leader-title">Bootstrap example of Fixed Background Image using HTML, Javascript, jQuery, and CSS. Snippet by iammahesh.</p>
    </div>
  </div>
</div>

<section class="container">
  <div class="leaderboard-menu-tab">
        <div class="row row-offcanvas row-offcanvas-right">
          <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
              <a href="<?php echo base_url(); ?>leaderboard" class="list-group-item "><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="<?php echo base_url(); ?>profile" class="list-group-item"><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
                <a href="<?php echo base_url(); ?>profile_picture" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Display Picture</a>
               <?php $user_role = $this->session->userdata('user_role');
                if($user_role=='2'){ ?>
                    <a href="<?php echo base_url(); ?>createevent" class="list-group-item"><span class="menu-icons"><i class="far fa-plus-square"></i></span>Create event </a>
                    <a href="<?php echo base_url(); ?>viewevents" class="list-group-item active"><span class="menu-icons"><i class="fas fa-table"></i></span>View events </a>
                    <a href="<?php echo base_url(); ?>bookedevents" class="list-group-item"><span class="menu-icons"><i class="far fa-list-alt"></i></i></span>Booked Events </a>
                    <a href="<?php echo base_url(); ?>reviewevents" class="list-group-item"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <?php } ?>
              <a href="<?php echo base_url(); ?>booking_history" class="list-group-item"><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>
              <a href="<?php echo base_url(); ?>wishlist" class="list-group-item"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="<?php echo base_url(); ?>logout" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">

              <div class="card-header">
					<h3 class="mb-0">Update Event</h3>
				</div>
                <!-- form user info -->
                  <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                  <?php endif; ?>
                        
                  <div class="card card-outline-secondary">
                    <div class="card-block">
                          <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>home/updateeventsdetails" name="eventform" id="eventform" onSubmit='return check();'>
                  <?php foreach($edit as $rows){} $sts=$rows->event_status;?>
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
                                <input type="text" class="form-control" value="<?php $date=date_create($rows->start_date);echo date_format($date,"d-m-Y");  ?>" name="start_date" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>

                             <label for="edate" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-4">
                               <div class="input-group">
                                <input type="text" class="form-control" required="" value="<?php $date=date_create($rows->end_date);echo date_format($date,"d-m-Y");  ?>" name="end_date" id="datepicker">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>
                        </div>

                        <div class="form-group row">
                           
                            <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">

                               <input  type="text" class="form-control" id="stime" name="start_time" value="<?php echo $rows->start_time; ?>">

                                <!-- select name="start_time" required="" class="form-control"  >
                                     <option value="">Select Start Time</option>
                                     <option value="<?php echo get_times(); ?>"><?php echo get_times(); ?></option>
                                </select>
                                <script language="JavaScript">document.eventform.start_time.value="<?php echo $rows->start_time; ?>";</script-->

                            </div>

                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                              <input  type="text" class="form-control" id="etime" name="end_time" value="<?php echo $rows->end_time; ?>">
                                <!--select name="end_time" required="" class="form-control" id="etime">
                                     <option value="">Select End Time</option>
                                     <option value="<?php echo get_times(); ?>"><?php echo get_times(); ?></option>
                                </select>
                                 <script language="JavaScript">document.eventform.end_time.value="<?php echo $rows->end_time; ?>";</script-->
                            </div>

                        </div>

                        <!--div class="form-group row">
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
                        </div-->


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
                            
                            <!--label for="Status" class="col-sm-2 col-form-label">Event Display</label>
                            <div class="col-sm-4">
                               <select class="form-control" required="" name="event_status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                <script language="JavaScript">document.eventform.event_status.value="<?php echo $rows->event_status; ?>";</script>
                            </div-->

                            <label class="col-sm-2 col-form-label">Event Banner</label>
                              <div class="col-sm-4">
                               <input type="file" name="eventbanner" id="file_upload" class="form-control" accept="image/*" >
                                 <div id="preview" style="color: red;"></div>
                               <input type="hidden" name="currentcpic" class="form-control" value="<?php echo $rows->event_banner;?>" >
                              <input type="hidden" name="eventid" class="form-control" value="<?php echo $rows->id; ?>" >
                               <img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $rows->event_banner; ?>" class="img-circle">

                              </div>                            
                        </div>

                        <div class="form-group row">
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
                     </form>
                      </div>
                  </div>
                  <!-- /form user info -->

          </div><!--/span-->

        </div><!--/row-->
   </div>
</section>
</div>
</div>
<style>
.form-group{
  margin-bottom: 0px;
}
.list-group-item{
  border: none;
  color: #000;
}
body{
  background-color: #f6f6f6;
}
.error{
  color:red;
  font-size: 16px;
}
</style>
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

$('#file_upload').on('change', function()
        {
          var f=this.files[0]
          var actual=f.size||f.fileSize;
          var orgi=actual/1024;
            if(orgi<1024){
              $("#preview").html('');
              //$("#preview").html('<img src="<?php echo base_url(); ?>assets/loader.gif" alt="Uploading...."/>');
              // $("#eventform").ajaxForm({
              //     target: '#preview'
              // }).submit();
            }else{
              $("#preview").html('File Size Must be  Lesser than 1 MB');
              //alert("File Size Must be  Lesser than 1 MB");
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
         
        //var timefrom = date1;
         temp =strStartTime.split(":");
         var a = temp[0];
         var b = temp[1];
         temp1 =b.split(" ");
         var c = temp1[1]
      // alert(a); alert(c);
        if(a==12 && c=='AM'){

        }else if (startTime > endTime){
          alert("Start Time is greater than end time");
          return false;
        }
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
        h = h + 24;
      }
      return h;
      }
      function GetMinutes(d) 
      {
       return parseInt(d.split(':')[1].split(' ')[0]);
      }
}


</script>
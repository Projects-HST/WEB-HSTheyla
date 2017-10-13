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
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#999999" />

    <title>HEYLA</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/frontcss/carousel.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark  fixed-top menupage">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home
                <span class="sr-only"></span>
              </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Create Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <?php
                       $user_id=$this->session->userdata('user_role');
                       if(empty($user_id)){ ?>
                         <li class="nav-item">
                             <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Login / Sign in</a>
                         </li>
                      <?php }else{ ?>
                         <li class="nav-item">
                             <a class="nav-link" href="<?php echo base_url(); ?>logout">Logout</a>
                         </li>
                      <?php } ?>

                </ul>
            </div>
        </div>
    </nav>

    <section class="organiser-home">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <p class="organiser-title">Let's create your very own event page to draw millions to experience events like never before.</p>
        </div>
        </div>
      </div>
    </section>


<div class="container" style="margin-top:30px;margin-bottom:50px;max-width:100%;">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="<?php echo base_url(); ?>home" class="list-group-item">Dashboard</a>
            <a href="<?php echo base_url(); ?>organizer/createevents/" class="list-group-item active">Create Events</a>
            <a href="<?php echo base_url(); ?>organizer/viewevents/" class="list-group-item">View Events</a>
            <a href="organizer/bookings/" class="list-group-item">Bookings</a>
            <a href="organizer/messageboard/" class="list-group-item">Messages</a>
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
                     
                 	<h4 class="mt-0 header-title">Create Events</h4>

                  <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>


                <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>organizer/inserteevents" name="eventform" onSubmit='return check();'>
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
                                <input class="form-control" type="text" name="event_name">
                            </div>

                        </div>
                       <div class="form-group row">
                            <label for="country" class="col-sm-2 col-form-label">Select Country</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="country" onchange="get_cityname(this.value)">
                              <option value="">Select Country Name</option>
                                     <?php foreach($country_list as $cntry){ ?>
                                        <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                </select>
                            </div>
                             <label for="city" class="col-sm-2 col-form-label">Select City</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="city" id="ctname">
                                </select>
                                <div id="cmsg"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                           
                            <label for="Venue" class="col-sm-2 col-form-label">Venue</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="venue"  >
                            </div>
                             <label for="Address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-4">
                               <textarea id="textarea" name="address" class="form-control" maxlength="240" rows="3" placeholder=""></textarea>
                            </div>

                        </div>
                        <div class="form-group row">
                           
                            <label for="Description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-4">
                                <textarea  id="textarea" name="description" class="form-control" maxlength="30000" rows="3" placeholder=""></textarea>
                            </div>

                             <label for="ecost" class="col-sm-2 col-form-label">Event Type</label>
                            <div class="col-sm-4">
                                 <select class="form-control" name="eventcost">
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
                                <input type="text" class="form-control" name="start_date" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>

                             <label for="edate" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-4">
                               <div class="input-group">
                                <input type="text" class="form-control" name="end_date" id="datepicker">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                           
                            <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">
                                <select name="start_time" class="form-control" >
                                     <option value="">Select Start Time</option>
									 <option value=""><?php echo get_times(); ?></option>
								</select>

                            </div>

                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                                <select name="end_time" class="form-control" >
                                     <option value="">Select End Time</option>

									 <option value=""><?php echo get_times(); ?></option>
								</select>
                            </div>

                        </div>
                        <div class="form-group row">
                           
                            <label for="latitude" class="col-sm-2 col-form-label">Event Latitude</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="txtLatitude"  id="lat" >
                                <div id="ermsg"></div> <div id="ermsg2"></div>
                            </div>
                              <label for="longitude" class="col-sm-2 col-form-label">Event Longitude</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="txtLongitude" id="lng">
                                 <div id="ermsg1"></div> <div id="ermsg3"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="primarycell" class="col-sm-2 col-form-label">primary Contact Phone</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="pcontact_cell" maxlength="10" value="">
                            </div>
                            <label for="seccell" class="col-sm-2 col-form-label">secondary Contact Phone</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="scontact_cell" value="" >
                            </div>
                        </div>
                       <div class="form-group row">
                            <label for="Person" class="col-sm-2 col-form-label">Contact Person</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="contact_person" value="">
                            </div>
                            <label for="Email" class="col-sm-2 col-form-label">Contact Email</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="email" value="" >
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
                               <select class="form-control" name="event_status">
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
         
        </div><!--/span-->

        
      </div><!--/row-->
 </div>

        <!-- Footer -->
        <footer class="footer-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="fnt-footer">Powerded By Happysanz Tech</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline fnt-footer ">
                            <li class="list-inline-item"><a href="">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="">Payment Policy</a></li>
                            <li class="list-inline-item"><a href="">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </footer>


<script type="text/javascript">  

  
 function get_cityname(cid) {
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
    
}

</script>
    </body>

    </html>




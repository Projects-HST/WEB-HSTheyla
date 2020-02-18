<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">

      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit  Show Timings </h4>
                        <form  method="post"  enctype="multipart/form-data" action="<?php echo base_url();?>booking/update_show_times_details" name="plantimeform" id="plantimeform">

                           <?php foreach ($edit as $res){ }?>

                             <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Date <span class="error">*</span></label>
                              <div class="col-sm-6">

                               

                                <!--div style="display: none;"-->
                                 <select class="form-control" name="showdate">
                                   <?php
                                   //foreach($dates as $rows1) { }
                                    $start_date=$res->start_date;
                                    $end_date=$res->end_date;
                                    $start_date = date('Y-m-d', strtotime($start_date));
                                    $end_date =  date('Y-m-d', strtotime($end_date));
                                    $day = 86400; // Day in seconds
                                    $format = 'd-m-Y'; // Output format (see PHP date funciton)
									$sformat = 'Y-m-d'; // Output format (see PHP date funciton)
                                    $sTime = strtotime($start_date); // Start as time
                                    $eTime = strtotime($end_date); // End as time
                                    $numDays = round(($eTime - $sTime) / $day) + 1;
                                    $days = array();
                                    for ($d = 0; $d < $numDays; $d++)
                                    {  ?>
                                    <option value="<?php echo $days[] = date($sformat, ($sTime + ($d * $day)));?>"><?php echo $days[] = date($format, ($sTime + ($d * $day)));?></option>
                                   <?php } ?>
                                 </select>
                    <script language="JavaScript">document.plantimeform.showdate.value="<?php echo $days[] = $res->show_date; ?>";</script>

                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Time <span class="error">*</span></label>
                              <div class="col-sm-6">

       <input id="timepicker1" type="text" class="form-control"  name="showtime" value="<?php echo $res->show_time; ?>" >

       <!--input class="form-control"   type="text" name="showtime" value="<?php echo $res->show_time; ?>"-->
                      <input class="form-control" type="hidden" name="time_id" value="<?php echo $res->id;?>">
                     <input class="form-control" type="hidden" name="event_id" value="<?php echo $res->event_id;?>">
                     <input class="form-control" type="hidden" name="plan_id"  value="<?php echo $res->plan_id; ?>">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Available Seats <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <input class="form-control"  type="text" name="seats" value="<?php echo $res->seat_available; ?>" maxlength="5">
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-success waves-effect waves-light">
                              Save </button>

                           </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>


         </div>
         <!-- container -->
      </div>
      <!-- Page content Wrapper -->

</div>
<!-- content -->
<script type="text/javascript">

   $('#timepicker1').timepicki();

 $('#vieweve').addClass("active");
  $('#events').addClass("has_sub active nav-active");

   $(document).ready(function () {
   $('#plantimeform').validate({ // initialize the plugin
      rules: {
        showtime:{required:true },
        seats:{required:true,number:true }

       },

       messages: {
         showtime:"When does the show start?",
         seats:{ required:"Seat count required!",number:"This doesn't seem to be a number!"}

              },
        });
   });

</script>

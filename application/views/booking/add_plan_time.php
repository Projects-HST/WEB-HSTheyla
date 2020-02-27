<style>
th{
  width: 100px;
}
</style>
<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">

      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Create Show Timings </h4>
                        <form  method="post"  enctype="multipart/form-data" action="<?php echo base_url();?>booking/add_show_times_details" name="plantimeform" id="plantimeform">

                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Date <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="showdate">
								 <!--<option value="all">Select All</option>-->
                                   <?php
                                   foreach($dates as $rows1) { }
                                    $start_date=$rows1->start_date;
                                    $end_date=$rows1->end_date;
                                    $start_date = date('Y-m-d', strtotime($start_date));
                                    $end_date =  date('Y-m-d', strtotime($end_date));
                                    $day = 86400; // Day in seconds
                                    $format = 'd-m-Y'; // Output format (see PHP date funciton)
                                    $sTime = strtotime($start_date); // Start as time
                                    $eTime = strtotime($end_date); // End as time
                                    $numDays = round(($eTime - $sTime) / $day) + 1;
                                    $days = array();
                                    for ($d = 0; $d < $numDays; $d++)
                                    {  ?>
                                    <option>
                                    <?php echo $days[] = date($format, ($sTime + ($d * $day))); echo'<br>';?></option>
                                   <?php } ?>
                                 </select>

                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Time <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <input id="timepicker1" type="text" class="form-control"  name="showtime"/>
                                 <!--input class="form-control"   type="text" name="showtime"-->
                              <input class="form-control"  type="hidden" name="event_id" value="<?php echo $eventid ;?>">
                              <input class="form-control"  type="hidden" name="plan_id" value="<?php echo $planid ;?>">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Available Seats <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <input class="form-control"  type="text" name="seats" maxlength="5">
                              </div>
                           </div>

                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-success waves-effect waves-light">
                              Create </button>

                           </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- end row -->
            <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">Show Timings</h4>
                        <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>
                        <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
                                 <th>S. No</th>
                                 <th>Event Name</th>
                                 <th>Plan Name</th>
                                 <th>Show Date</th>
                                 <th>Show Time</th>
                                 <th>Available Seats</th>
                                 <th>Amount</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach($plan_time as $rows) {
                                    $tlt=$rows->total_seats;
                                    $ave=$rows->seat_available;
                                 ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->event_name; ?></td>
                                 <td><?php  echo $rows->plan_name; ?></td>
                                 <td><?php  echo $newDate = date("d-m-Y",strtotime($rows->show_date));?></td>
                                 <td><?php  echo $rows->show_time; ?></td>
                                 <td><?php  echo $ave; ?></td>
                                 <td><?php  echo $rows->seat_rate; ?></td>
                                 <td>
                                    <a href="<?php echo base_url();?>booking/edit_plan_time/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
                                 </td>
                              </tr>
                              <?php $i++;  }  ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
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
	   
   	$(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
	
	$('table').DataTable({
         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false
    });
	   
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

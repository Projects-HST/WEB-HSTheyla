<style>
.viewevents_active{
	 background-color: #696969;
}
.event_section{
  height: 100vh;
}
.footer_section{
  display: none;
}
table{
  background-color: #fff;
}
.table-striped>tbody>tr:nth-child(odd){
  background-color: #fff;
}
th{
  width: 150px;
}
.dataTables_filter {
   width: 50%;
   float: right;
   text-align: right;
}

.form_box{
	margin-bottom: 20px;
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
</style>
<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">Create Show Timings</h3>
</div>
<div class="col-md-12">

<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>home/add_show_times_details" name="plantimeform" id="plantimeform" onSubmit='return check();'>

	<div class="col-md-12 form_box">
		<div class="form-group">
				<label for="Name" class="col-sm-2 col-form-label">Select Date <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
						<select class="form-control" name="showdate">
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
	</div>
		<div class="col-md-12 form_box">
			<div class="form-group">
				
				<label for="Venue" class="col-sm-2 col-form-label">Time <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
						 <input id="stime" type="text" class="form-control"  name="showtime"/>
				</div>
		</div>
	</div>
			<div class="col-md-12 form_box">
			<div class="form-group">
				
				<label for="Venue" class="col-sm-2 col-form-label">Available Seats <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
						 <input id="stime" type="text" class="form-control"  name="seats" maxlength="5"/>
				</div>
		</div>
	</div>
	
		<div class="col-md-12 form_box">
		<div class="form-group">
				<label class="col-sm-2 col-form-label"></label>
				<div class="col-sm-4">
					<input class="form-control"  type="hidden" name="event_id" value="<?php echo $eventid ;?>">
                    <input class="form-control"  type="hidden" name="plan_id" value="<?php echo $planid ;?>">
					<button type="submit" class="btn btn-primary waves-effect waves-light" style="font-size:18px;">Submit </button>
				</div>
				
		</div>
	</div>
	<div class="col-md-12 form_box">
		<div class="form-group row">
				<label class="col-sm-2 col-form-label"></label>
				<div class="col-sm-8 text-center">
					
				</div>

		</div>
	</div>
   </form>
</div>

           <?php if($this->session->flashdata('msg')): ?>
                        <div class="col-md-12 alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
       <?php endif; ?>                      

<div class="col-md-12 event_section">
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
					<a href="<?php echo base_url();?>home/edit_show_time/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
				 </td>
			  </tr>
			  <?php $i++;  }  ?>
		   </tbody>
        </table>
</div>
<script>
$(document).ready(function() {
	
	   $('#stime').timepicki();
	   
  $(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
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
  
	$('.table').DataTable({
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false,
		"bAutoWidth": false,
		"columns": [
					{ "width": "5%" },
					{ "width": "25%" },
					{ "width": "20%" },
					{ "width": "10%" },
					{ "width": "10%" },
					{ "width": "15%" },
					{ "width": "10%" },
					{ "width": "5%" }
				  ]
    });
} );
</script>

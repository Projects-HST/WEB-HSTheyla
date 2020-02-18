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
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">Ticket Plans</h3>
</div>
<div class="col-md-12">

<form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>home/add_event_plan" name="planform" id="planform" onSubmit='return check();'>

	<div class="col-md-12 form_box">
		<div class="form-group">
				<label for="Name" class="col-sm-2 col-form-label">Plan Name <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
						<input class="form-control" type="text"  name="planname" maxlength="25">
				</div>
				
		</div>
	</div>
		<div class="col-md-12 form_box">
			<div class="form-group">
				
				<label for="Venue" class="col-sm-2 col-form-label">Amount <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
						<input class="form-control" type="text"  name="amount" maxlength="10">
				</div>
		</div>
	</div>
		<div class="col-md-12 form_box">
		<div class="form-group">
				<label class="col-sm-2 col-form-label"></label>
				<div class="col-sm-4">
					<input class="form-control"  type="hidden" name="event_id" value="<?php echo $eventid ;?>">
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
				 <th>Plan Name</th>
				 <th>Event  Name</th>
				 <th>Amount</th>
				 <th>Actions</th>
              </tr>
           </thead>
		   <tbody>
			  <?php
				 $i=1;
				 foreach($view_plan as $rows) {
					$eveid=$rows->event_id;
				
					$plaid=$rows->id;
					$planid = base64_encode($plaid*564738);
				 ?>
			  <tr>
				 <td><?php  echo $i; ?></td>
				 <td><?php  echo $rows->plan_name; ?></td>
				 <td><?php  echo $rows->event_name; ?></td>
				 <td><?php  echo $rows->seat_rate; ?></td>
				 <td>
					<a href="<?php echo base_url();?>booking_plan_edit/<?php echo $planid;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
					<a href="<?php echo base_url();?>home/add_show_time/<?php echo $plaid;?>/<?php echo $eveid;?>">
			  <img title="Show Timings" src="<?php echo base_url();?>assets/icons/booking.png"/></a>
			   <!--a href="<?php echo base_url();?>booking/delete_plan/<?php echo $plaid;?>/<?php echo $eveid;?>">
			  <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a-->
				 </td>
			  </tr>
			  <?php $i++;  }  ?>
		   </tbody>
        </table>
</div>
<script>
$(document).ready(function() {
	
	$(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
  
     $('#planform').validate({ // initialize the plugin
      rules: {
        planname:{required:true },
        amount:{required:true,number:true }
       },

       messages: {
       planname:"Plan name cannot be empty",
       amount:{required:"Amount cannot be empty",number:"This doesn't seem to be an amount!"}
              },
        });
  
	$('table').DataTable({
        "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false,
		"bAutoWidth": false,
		"columns": [
					{ "width": "7%" },
					{ "width": "20%" },
					{ "width": "43%" },
					{ "width": "20%" },
					{ "width": "10%" }
				  ]
    });
} );
</script>

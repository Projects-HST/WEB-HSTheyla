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

 <?php   foreach($edit as $res){ } ?>
                           <form  method="post" action="<?php echo base_url();?>home/org_update_plans" name="planform" id="planform">

	<div class="col-md-12 form_box">
		<div class="form-group">
				<label for="Name" class="col-sm-2 col-form-label">Plan Name <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
						<input class="form-control" type="text"  name="planname" maxlength="25" value="<?php echo $res->plan_name ;?>">
				</div>
				
		</div>
	</div>
		<div class="col-md-12 form_box">
			<div class="form-group">
				
				<label for="Venue" class="col-sm-2 col-form-label">Amount <span class="red_txt_label">*</span></label>
				<div class="col-sm-4">
						<input class="form-control" type="text"  name="amount" maxlength="10" value="<?php echo $res->seat_rate ;?>">
				</div>
		</div>
	</div>
		<div class="col-md-12 form_box">
		<div class="form-group">
				<label class="col-sm-2 col-form-label"></label>
				<div class="col-sm-4">
					
							<input class="form-control"  type="hidden" name="event_id" value="<?php echo $res->event_id ;?>">
                           <input class="form-control"  type="hidden" name="plan_id" value="<?php echo $res->id ;?>">
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
					{ "width": "48%" },
					{ "width": "5%" },
					{ "width": "20%" },
					{ "width": "5%" },
					{ "width": "15%" }
				  ]
    });
} );
</script>

<div class="page-content-wrapper ">
    <div class="container">
      <div class="row">

      <div class="col-lg-12">
          <h4 class="mt-0 header-title">Events List</h4>
          <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>S. No</th>
                <th style="width:200px;">Event</th>
                <th>City/Area</th>
                <th>Start Date</th>
                  <th>End Date</th>
                <th>Type</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
              <tbody>
                <?php $i=1; foreach($org_tracks as $rows_event){  ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $rows_event->event_name; ?></td>
                  <td><?php echo $rows_event->city_name; ?></td>
                  <td><?php echo $rows_event->start_date; ?></td><td><?php  echo $rows_event->end_date; ?></td>
                  <td><?php echo $rows_event->event_type; ?></td>
                <td><?php  if($rows_event->event_status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Inactive </button>'; }?></td>
                  <td><a href="<?php echo base_url(); ?>events/edit_events/<?php echo base64_encode($rows_event->id); ?>"><img title="Edit" src="<?php echo base_url(); ?>assets/icons/edit.png"></a></td>

                </tr>
              <?php $i++; }  ?>
              </tbody>
            </table>

      </div>
    </div>
    </div>
</div>
<script type="text/javascript">

	$('#track').addClass("has_sub active nav-active");
  
$(document).ready(function() {

	 $(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
	
	$('table').DataTable({
         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false
    });
} );
</script>

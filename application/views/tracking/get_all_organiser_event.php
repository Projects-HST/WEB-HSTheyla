<div class="page-content-wrapper ">
    <div class="container">
      <div class="row">
      <div class="col-lg-12">
          <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>S.No</th>
                <th>Event Name</th>
                <th>Event City</th>
                <th>Start date</th>
                  <th>End date</th>
                <th>Status</th>
                <th>Action</th>
                <th>View</th>
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
                <td><?php  if($rows_event->event_status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Deactive </button>'; }?></td>
                  <td><a href="<?php echo base_url(); ?>events/edit_events/<?php echo base64_encode($rows_event->id); ?>"><img title="View Events" src="<?php echo base_url(); ?>assets/icons/edit.png"></a></td>

                </tr>
              <?php $i++; }  ?>
              </tbody>
            </table>

      </div>
    </div>
    </div>
</div>
<script>
$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

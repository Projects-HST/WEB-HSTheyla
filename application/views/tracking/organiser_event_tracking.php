<div class="page-content-wrapper ">
    <div class="container">
      <div class="row">
      <div class="col-lg-12">
          <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>S.No</th>
                <th>Username/ Email / Mobile No </th>
                <th>Total Event Posted</th>
                <th>Approved</th>
                <th>Pending</th>
                <th>View Events</th>
            </tr>
            </thead>
              <tbody>
                <?php $i=1; foreach($org_event_tracks as $rows_event){  ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $rows_event->user_name; echo "<br>";echo $rows_event->email_id; echo "<br>";echo $rows_event->mobile_no; ?></td>
                  <td><?php echo $rows_event->posted_event; ?></td>
                  <td><?php echo $rows_event->approved_event; ?></td>
                  <td><?php echo $rows_event->pending_event; ?></td>
                  <td><a href="<?php echo base_url(); ?>tracking/organiser_events/<?php echo base64_encode($rows_event->id*98765); ?>"><img title="View Events" src="<?php echo base_url(); ?>assets/icons/view.png"></a></td>

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

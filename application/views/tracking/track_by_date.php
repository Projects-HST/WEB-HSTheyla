<div class="page-content-wrapper ">
    <div class="container">
      <div class="row">
      <div class="col-lg-12">
        <h4 class="mt-0 header-title">Events by Date </h4>
          <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>S. No</th>
                <th>Username/Email ID/Mobile Number </th>
                <th>Date </th>
                <th>Event Count</th>
                <th>Actions</th>
            </tr>
            </thead>
              <tbody>
                <?php $i=1; foreach($event_track as $rows_event){  ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $rows_event->user_name; echo "<br>";echo $rows_event->email_id; echo "<br>";echo $rows_event->mobile_no; ?></td>
                  <td><?php echo $new_date = date('d-m-Y', strtotime($rows_event->created_at)); ?></td>
                  <td><?php echo $rows_event->event_count; ?></td>
                  <td><a href="<?php echo base_url(); ?>tracking/get_all_event_by_date_id/<?php echo base64_encode($rows_event->id*98765); ?>/<?php echo $date_id = date('Y-m-d', strtotime($rows_event->created_at)); ?>"><img title="View Events" src="<?php echo base_url(); ?>assets/icons/view.png"></a></td>

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

<div class="page-content-wrapper ">
    <div class="container">
      <div class="row">
        <h5>Refund Request </h5>
      <div class="col-lg-12">
          <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>S.No</th>
                <th>Username/ Email /Mobile </th>
                <th>Order id</th>

                  <th>Order date.</th>
<th>Status</th>
                <th>View</th>
            </tr>
            </thead>
              <tbody>
                <?php $i=1; foreach($tracks as $rows_event){  ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $rows_event->user_name; ?><br>
                  <?php echo $rows_event->email_id; ?><br>
                  <?php echo $rows_event->mobile_no; ?></td>
                  <td><?php echo $rows_event->order_id; ?></td>
                  <td><?php echo $rows_event->created_at; ?></td>
                  <td><?php  echo $rows_event->status; ?></td>
                  <td><a href="<?php echo base_url(); ?>tracking/change_refund_status/<?php echo base64_encode($rows_event->refund_id*98765); ?>"><img title="View Events" src="<?php echo base_url(); ?>assets/icons/edit.png"></a></td>
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

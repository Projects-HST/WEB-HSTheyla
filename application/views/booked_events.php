<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab"> Booked Events</h3>
</div>
<div class="col-md-12 ">
  <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
              <tr>
                 <th>S.No</th>
                 <th>Event Name</th>
                 <th>Plan</th>
                 <th>Show Date & Time</th>
                 <th>Seats</th>
                 <th>Booking Date</th>
                 <!--th>Amount</th-->
              </tr>
           </thead>
           <tbody>
<?php
                $i=1;
                foreach($view as $rows) {
                ?>
              <tr>
                 <td><?php echo $i; ?></td>
                 <td><?php echo $rows->event_name; ?></td>
                 <td><?php echo $rows->plan_name; ?></td>
                  <td><?php $date=date_create($rows->show_date);
                       echo date_format($date,"d-m-Y");  ?> ( <?php echo $rows->show_time; ?> ) </td>
                 <td><?php echo $rows->number_of_seats; ?></td>
                 <td><?php $date=date_create($rows->booking_date);
                       echo date_format($date,"d-m-Y"); ?></td>
                  <!--td><?php echo $rows->total_amount; ?></td-->
              </tr>
             <?php $i++;  }  ?>
           </tbody>
        </table>
</div>
<script>
$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

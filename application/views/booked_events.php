<style>
.booked_events_active{
  border-left: 4px solid #458ecc;
}
.event_section{
  height: 100vh;
}
.footer_section{
  display: none;
}
</style>
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">Event Reviews </h3>
</div>
<div class="col-md-12 event_section">
  <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
              <tr>
                 <th>S.No</th>
                 <th>Event</th>
                 <th>Plan</th>
                 <th>Date & Time</th>
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

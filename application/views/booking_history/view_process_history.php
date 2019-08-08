
      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> View Booking Process Details </h4>

                           <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
							                   <th>S.No</th>
                                 <th>Event Name</th>
                                 <th>Plan</th>
                                 <th>Show Date & Time</th>
                                 <th>Seats</th>
                                 <th>Amount</th>
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
                                 <td><?php echo $rows->show_date; ?> ( <?php echo $rows->show_time; ?> ) </td>
                                 <td><?php echo $rows->number_of_seats; ?></td>
                                 <td><?php echo $rows->total_amount; ?></td>
                              </tr>
                             <?php $i++;  }  ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
         </div>
		   <!-- container -->
      </div>
     <!-- Page content Wrapper -->
</div>
<!-- content -->
<script type="text/javascript">
 $(document).ready(function () {
    $('#countryform').validate({ // initialize the plugin
       rules: {
         countryname:{required:true },
         eventsts:{required:true }
        },
        messages: {
        countryname:"Enter Country Name",
        eventsts:"Select Status"
               },
         });
   });

</script>

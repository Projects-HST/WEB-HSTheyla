
      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Booking Status</h4>

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
							     <th>Order ID</th>
                                 <th>Order Status</th>
                                 <th>Payment Mode</th>
                                 <th>Transaction ID</th>
                                 <th>Amount</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
						    <?php
                                $i=1;
                                foreach($status as $rows) {
                                ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $rows->order_id; ?></td>
                                 <td><?php echo $rows->order_status; ?></td>
                                 <td><?php echo $rows->payment_mode; ?></td>
                                 <td><?php echo $rows->track_id; ?></td>
                                 <td><?php echo $rows->amount; ?></td>
                                 <td>
                                  <a href="<?php echo base_url();?>bookinghistory/view_payment_details/<?php echo $rows->id;?>">
                                  <img title="View Booking Details" src="<?php echo base_url();?>assets/icons/view.png" /> </a>
                                </td>
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


      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Event Plans </h4>
                        <form  method="post"  enctype="multipart/form-data" action="<?php echo base_url();?>booking/add_plans" name="planform" id="planform">
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Plan Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control"   type="text" name="planname">
                                 <input class="form-control"  type="hidden" name="event_id" value="<?php echo $eventid ;?>">
                              </div>
                           </div>
                           <!--div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Available Seats</label>
                              <div class="col-sm-6">
                                 <input class="form-control"  type="text" name="seats" >
                              </div>
                           </div-->
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Amount </label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="amount" >
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit </button>
                              <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                              Reset
                              </button>
                           </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- end row -->
            <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">Plan Details</h4>
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
                                 <th>Plan Name</th>
                                 <th>Event  Name</th>
                                 <th>Amount</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach($view_plan as $rows) {
                                    $eveid=$rows->event_id;
                                    $plaid=$rows->id;
                                 ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->plan_name; ?></td>
                                 <td><?php  echo $rows->event_name; ?></td>
                                 <td><?php  echo $rows->seat_rate; ?></td>
                                 <td>
                                    <a href="<?php echo base_url();?>booking/edit_plan/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
                                    <a href="<?php echo base_url();?>booking/add_show_time/<?php echo $plaid;?>/<?php echo $eveid;?>">
                              <img title="Show Times" src="<?php echo base_url();?>assets/icons/booking.png"/></a>
                               <!--a href="<?php echo base_url();?>booking/delete_plan/<?php echo $plaid;?>/<?php echo $eveid;?>">
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a-->
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
   $('#vieweve').addClass("active");
  $('#events').addClass("has_sub active nav-active");
   $(document).ready(function () {
   $('#planform').validate({ // initialize the plugin
      rules: {
        planname:{required:true },
        seats:{required:true },
        amount:{required:true,number:true }
       },

       messages: {
       planname:"Enter Plan Name",
       seats:"Enter  Seats",
       amount:{required:"Enter Amount",number:"Enter the number"}

              },
        });
   });

</script>

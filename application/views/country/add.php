      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> <b> ADD COUNTRY</b> </h4>

                        <form class="" method="post" action="<?php echo base_url();?>country/add_country" name="countryform" id="countryform">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Country Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text"  name="countryname" value="" id="example-text-input">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Status</label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="eventsts">
                                    <option value="">Select  Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                 </select>
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
                        <h4 class="mt-0 header-title">View All Countries</h4>

                       <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert <?php $msg=$this->session->flashdata('msg');
                        if($msg=='Added Successfully' || $msg=='Update Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
							            <th>S.No</th>
                                 <th>Country Name</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
						    <?php
                                $i=1;
                                foreach($result as $rows) {
									$status=$rows->event_status;
                                ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->country_name; ?></td>
                                 <td><?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Deactive </button>'; }?></td>
								 <td><a href="<?php echo base_url();?>country/edit_country/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a></td>
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
    <!-- Top Bar Start -->
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

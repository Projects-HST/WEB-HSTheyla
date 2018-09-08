<style type="text/css">
   .img-circle{
          width: 90px;
         border-radius: 30px;
       }
</style>

      <div class="page-content-wrapper">
         <div class="container">

            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Add Plan </h4>

                        <form method="post" action="<?php echo base_url();?>advertisement/add_plans" name="advertisementform" id="advertisementform" enctype="multipart/form-data">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Plan Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="planname">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Plan Rate</label>
                              <div class="col-sm-6">
                                 <input type="text" name="plan_rate" class="form-control">
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
                        <h4 class="mt-0 header-title">View All Plans</h4>

                           <?php if($this->session->flashdata('msg')): ?>
                             <div class="alert <?php $msg=$this->session->flashdata('msg');
                             if($msg=='Added Successfully' || $msg=='Updated Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
							                  <th>S.No</th>
                                <th>Plan Name</th>
                                <th>Plan Rate</th>
                                <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
						            <?php
                                $i=1;
                                foreach($all_plan as $rows) {
                                  $pid=$rows->id;
                                ?>
                                 <!-- href="<?php echo base_url();?>advertisement/delete_plans/<?php echo $rows->id;?>" -->
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->plan_name; ?></td>
                                 <td> <?php echo $rows->plan_rate; ?></td>
                                <td>
                                   <a href="<?php echo base_url();?>advertisement/edit_plans/<?php echo $rows->id;?>">
                                   <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
                                   <!--a onclick="confirmGetMessage(<?php echo $pid;?>)">
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
    <!-- Top Bar Start -->
</div>
<!-- content -->
<script type="text/javascript">

  function confirmGetMessage(pid)
  {
    var r=confirm("Do you want to delete this?")
    if (r==true) {
      $.ajax({
        url: "<?php echo base_url(); ?>advertisement/delete_plans",
        type: 'POST',
        data: { planid: pid },
        success: function(response) {
        //alert(response);exit;
            if (response == "success") {
                swal({
                    title: "Success",
                    text: "Deleted Successfully",
                    type: "success"
                }).then(function() {
                    location.href = '<?php echo base_url(); ?>advertisement/home';
                });
            }else {
              sweetAlert("Oops...", response, "error");
            }
        }
      });
    }else{
        swal("Cancelled", "Process Cancel :)", "error");
       }
  }

 $(document).ready(function () {
    $('#advertisementform').validate({ // initialize the plugin
       rules: {
         planname:{required:true },
         plan_rate:{required:true,number:true }
        },
        messages: {
        planname:"Enter Plan Name",
        plan_rate:{required:"Enter Rate",number:"Enter the numbers"}
               },
         });
   });

</script>

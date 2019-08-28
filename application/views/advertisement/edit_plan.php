<style type="text/css">
   .img-circle{
          width: 90px;
         border-radius: 30px;
         margin-top: 10px;
       }
</style>

      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit Advertisement Plan </h4>
                        <?php foreach($edit as $res){ }?>

                     <form  method="post" action="<?php echo base_url();?>advertisement/update_plans" name="advertisementform" id="advertisementform" enctype="multipart/form-data">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Plan Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="planname" value="<?php echo $res->plan_name;?>" id="example-text-input">
                                 <input class="form-control" type="hidden" name="planid" value="<?php echo $res->id;?>" id="example-text-input">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Plan Price</label>
                              <div class="col-sm-6">
                                 <input type="text" name="plan_rate" class="form-control" value="<?php echo $res->plan_rate;?>" id="example-text-input">
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-success waves-effect waves-light">
                              Save </button>

                           </div>
                     </div>
                     </form>

                  </div>
               </div>
            </div>

         </div>
		   <!-- container -->
      </div>
     <!-- Page content Wrapper -->
   </div>
    <!-- Top Bar Start -->
</div>
<!-- content -->
<script type="text/javascript">

  $('#plan').addClass("active");
  $('#advertisement').addClass("has_sub active nav-active");

 $(document).ready(function () {
    $('#advertisementform').validate({ // initialize the plugin
      rules: {
        planname:{required:true },
        plan_rate:{required:true,number:true }
       },
       messages: {
         planname:"Enter plan name",
         plan_rate:{required:"Enter plan price",number:"This doesn't seem to be a price!"}
              },
         });
   });

</script>

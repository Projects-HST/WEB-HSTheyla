
      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit Ticket Plan </h4>
                        <?php   foreach($edit as $res){ } ?>
                           <form  method="post" action="<?php echo base_url();?>booking/update_plans" name="planform" id="planform">
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Plan Name </label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="planname" value="<?php echo $res->plan_name ;?>" >
                           <input class="form-control"  type="hidden" name="event_id" value="<?php echo $res->event_id ;?>">
                           <input class="form-control"  type="hidden" name="plan_id" value="<?php echo $res->id ;?>">
                              </div>
                           </div>

                            <!--div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Available Seats </label>
                              <div class="col-sm-6">
                                 <input class="form-control"  type="text" name="seats" value="<?php echo $res->seat_available ;?>" >
                              </div>
                           </div-->

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Amount </label>
                              <div class="col-sm-6">
                                 <input class="form-control"  type="text" name="amount"  value="<?php echo $res->seat_rate ;?>" >
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
        planname:"Enter plan name",
        seats:"Enter  Seats",
       amount:{required:"Enter amount",number:"This doesn't seem to be an amount!"}
               },
         });
   });

</script>

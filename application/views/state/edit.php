
      <!-- Top Bar End -->
      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit State </h4>
                        <?php foreach($edit as $res){ }?>
                        <form class="" method="post" action="<?php echo base_url();?>state/update_state" id="stateform" name="stateform">

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Country <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="countryid" >
                                     <option value="">Select Country </option>
                                     <?php foreach($countyr_list as $cntry){ ?>
                                                <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                 </select>
                                  <script language="JavaScript">document.stateform.countryid.value="<?php echo $res->countryid; ?>";</script>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">State <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text"  name="statename" value="<?php echo $res->state_name; ?>" id="example-text-input" maxlength="50"> 
                                  <input class="form-control" type="hidden"  name="stateid" value="<?php echo $res->id; ?>" id="example-text-input">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Status <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <select class="form-control"  name="eventsts">
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                 </select>
								 <script language="JavaScript">document.stateform.eventsts.value="<?php echo $res->event_status; ?>";</script>

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

  $('#state').addClass("active");
  $('#master').addClass("has_sub active nav-active");

   $(document).ready(function () {
    $('#stateform').validate({ // initialize the plugin
       rules: {
         countryid:{required:true },
         statename:{required:true },
         eventsts:{required:true }

        },
        messages: {
        countryid:"Select Country",
        statename:"Enter State",
        eventsts:"Select Status"
               },
         });
   });
</script>

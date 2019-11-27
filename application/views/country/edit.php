
      <!-- Top Bar End -->
      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit Country </h4>
                        <?php foreach($edit as $res){ }?>
                        <form class="" method="post" action="<?php echo base_url();?>country/update_country" name="countryform" id="countryform">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Country <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="countryname" value="<?php echo $res->country_name; ?>" id="example-text-input" maxlength="50">
                                  <input class="form-control" type="hidden" name="cnid" value="<?php echo $res->id; ?>" id="example-text-input">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Status <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="eventsts">
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                 </select>
								 <script language="JavaScript">document.countryform.eventsts.value="<?php echo $res->event_status; ?>";</script>

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

 $(document).ready(function () {

   $('#country').addClass("active");
   $('#master').addClass("has_sub active nav-active");

    $('#countryform').validate({ // initialize the plugin
       rules: {
         countryname:{required:true },
         eventsts:{required:true }
        },
        messages: {
        countryname:"Enter Country",
        eventsts:"Select Status"
               },
         });
   });

</script>

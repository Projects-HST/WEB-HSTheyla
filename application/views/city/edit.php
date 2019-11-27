      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit City/Area </h4>
                        <?php foreach($edit as $res){ }?>
                        <form class="" method="post" action="<?php echo base_url();?>city/update_city" id="cityform" name="cityform" onSubmit='return check();'>

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Country <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="countryid"  onchange="getstatename(this.value)">
                                     <option value="">Select Country </option>
                                     <?php foreach($countyr_list as $cntry){ ?>
                                                <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                 </select>
                                  <script language="JavaScript">document.cityform.countryid.value="<?php echo $res->countryid; ?>";</script>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">State <span class="error">*</span></label>
                              <div class="col-sm-6">
                              <!--input class="form-control" type="hidden" value="<?php echo $res->state_id; ?>" name="stateid">
                              <div id="old" style="display:none;"">
                               <input class="form-control" type="hidden" value="<?php echo $res->state_name; ?>"  >
                                 </div-->

                                 <select class="form-control" name="newstateid" id="staname">
                                  <?php foreach($edit as $res){ ?>
                                     <option value="<?php echo $res->staid; ?>"><?php echo $res->state_name; ?></option>
                                     <?php } ?>
                                 </select>
                                <script language="JavaScript">document.cityform.newstateid.value="<?php echo $res->state_id; ?>";</script>
                                 <div id="msg"></div>
                              </div>
                           </div>


                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">City/Area <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text"  name="cityname" id="city_id" value="<?php echo $res->city_name; ?>" id="example-text-input" maxlength="50">
                                  <input class="form-control" type="hidden"  name="cityid" value="<?php echo $res->id; ?>" id="example-text-input" >
                              </div>
                           </div>
                           <div class="form-group row">

                            <label for="latitude" class="col-sm-4 col-form-label">City/Area Latitude <span class="error">*</span></label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="txtLatitude"  id="latu" value="<?php echo $res->city_latitude; ?>" maxlength="30">
                                <div id="ermsg"></div> <div id="ermsg2"></div>
                            </div>
                          </div>
                           <div class="form-group row">
                              <label for="longitude" class="col-sm-4 col-form-label">City/Area Longitude <span class="error">*</span></label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="txtLongitude" id="lon" value="<?php echo $res->city_longitude; ?>" maxlength="30">
                                 <div id="ermsg1"></div> <div id="ermsg3"></div>
                            </div>
                        </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Status <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <select class="form-control"  name="eventsts">
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                 </select>
					<script language="JavaScript">document.cityform.eventsts.value="<?php echo $res->event_status; ?>";</script>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" id="save" class="btn btn-success waves-effect waves-light">
                              Save </button>
                           </div>
                     </div>
                     </form>
                  </div>
               </div>
                <!--div class="col-lg-4">
    <div id="dvMap" style="width:300px; height:300px"> </div>
               </div-->
            </div>

         </div>
		   <!-- container -->
      </div>
     <!-- Page content Wrapper -->
   </div>
    <!-- Top Bar Start -->
</div>
<!-- content -->
<!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByz7sU142AeFwpK3KiFilK0IOoa2GU9tw"></script-->

<script type="text/javascript">

   $('#city').addClass("active");
   $('#master').addClass("has_sub active nav-active");

   $(document).ready(function () {

    $('#cityform').validate({ // initialize the plugin
       rules: {
         countryid:{required:true },
         stateid:{required:true },
         cityname:{required:true },
         eventsts:{required:true },
         txtLatitude:{required:true },
         txtLongitude:{required:true }

        },
        messages: {
        countryid:"Select Country",
        stateid:"Select State",
        cityname:"Enter City/Area ",
        eventsts:"Select Status",
        txtLatitude:"Enter city/area latitude",
        txtLongitude:"Enter city/area longitude",
               },
         });
   });

function check()
{
if(document.cityform.txtLatitude.value!="")
    {
            sLatitude = document.cityform.txtLatitude.value
            if(isNaN(sLatitude) || sLatitude.indexOf(".")<0)
            {
                $("#ermsg2").html('<p style="color:red;">Please enter valid Latitude.</p>').show();
                $("#ermsg").hide();
                //alert ("Please enter valid Latitude.")
                document.cityform.txtLatitude.focus();
                return false;
            }else{
                 $("#ermsg").hide();
                 $("#ermsg2").hide();
            }
    }

    if(document.cityform.txtLongitude.value!="")
    {
            sLongitude = document.cityform.txtLongitude.value

            if(isNaN(sLongitude) || sLongitude.indexOf(".")<0)
            {
                //alert ("Please enter valid Longitude.")
                 $("#ermsg3").html('<p style="color: red;">Please enter valid Longitude.</p>').show();
                 $("#ermsg1").hide();
                document.cityform.txtLongitude.focus();
                return false;
            }else{
                 $("#ermsg1").hide();
                 $("#ermsg3").hide();
            }
    }
  }
 function getstatename(cid) {
           //alert(cid);
            $.ajax({
               type: 'post',
               url: '<?php echo base_url(); ?>city/get_sate_name',
               data: {
                   country_id:cid
               },
             dataType: "JSON",
             cache: false,
            success:function(test)
            {
              // alert(test);
               var len = test.length;
               //alert(len);
                var statename='';
                if(test!='')
                 {       //alert(len);
                   for(var i=0; i<len; i++)
                   {
                     var stateid = test[i].id;
                     var state_name = test[i].state_name;
                     //alert(state_name);
                     statename +='<select class="form-control" name="newstateid" id="staname" ><option value=' + stateid + '> ' + state_name + ' </option></select>';
                  }
                  $("#staname").html(statename).show();
                  $("#msg").hide();
                  $("#city_id").show();
                  $("#save").show();
                  }else{
                  $("#msg").html('<p style="color: red;">State Name Not Found</p>').show();
                  $("#staname").hide();
                  $("#city_id").hide();
                  $("#save").hide();
                 }
            }
          });
       }
</script>

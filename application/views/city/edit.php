<!-- Start content -->
<div class="content-page">
<div class="content">
   <!-- Top Bar Start -->
   <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>
          
            </li>
            <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
            <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>adminlogin/logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
            </div>
            </li>
         </ul>
         <ul class="list-inline menu-left mb-0">
         <li class="list-inline-item">
         <button type="button" class="button-menu-mobile open-left waves-effect">
         <i class="ion-navicon"></i>
         </button>
         </li>
         <li class="hide-phone list-inline-item app-search">
         <h3 class="page-title">Edit City</h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
	  
      </div>
      <!-- Top Bar End -->
      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"></h4>
                        <?php foreach($edit as $res){ }?>
                        <form class="" method="post" action="<?php echo base_url();?>city/update_city" name="cityform">
                           
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Country Name</label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="countryid"  required=""  onchange="getstatename(this.value)">
                                     <option value="">Select Country Name</option>
                                     <?php foreach($countyr_list as $cntry){ ?>
                                                <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                 </select>
                                  <script language="JavaScript">document.cityform.countryid.value="<?php echo $res->countryid; ?>";</script>
                              </div>
                           </div> 

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">State Name</label>
                              <div class="col-sm-6">
                              <input class="form-control" type="hidden" value="<?php echo $res->state_id; ?>" name="stateid">
                              <div id="old" style="display:none;"">
                               <input class="form-control" type="text" value="<?php echo $res->state_name; ?>"  >
                                 </div>
                              <div id="msg"></div>
                                 <select class="form-control" name="newstateid" id="staname" >
                                     <option value=""><?php echo $res->state_name; ?></option>
                                 </select>
                                <!--script language="JavaScript">document.cityform.eventsts.value="<?php echo $res->state_id; ?>";</script-->
                              </div>
                           </div> 


                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">City Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" required="" name="cityname" value="<?php echo $res->city_name; ?>" id="example-text-input">
                                  <input class="form-control" type="hidden" required="" name="cityid" value="<?php echo $res->id; ?>" id="example-text-input">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Event Status</label>
                              <div class="col-sm-6">
                                 <select class="form-control" required="" name="eventsts">
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                 </select>
								 <script language="JavaScript">document.cityform.eventsts.value="<?php echo $res->event_status; ?>";</script>

                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Update </button>
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
                  
                  }else{
                  $("#msg").html('<p style="color: red;">Stata Name Not Found</p>').show();
                  $("#staname").hide();
                  //$("#old").show();
                 }
            }
          }); 
       }
</script>
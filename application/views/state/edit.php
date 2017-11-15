<!-- Start content -->
<div class="content-page">
<div class="content">
  <!-- Top Bar Start -->
   <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <!--li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>
            </li-->
            <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!--a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
            <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a-->
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
         <h3 class="page-title">Add Country</h3>
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
                        <form class="" method="post" action="<?php echo base_url();?>state/update_state" id="stateform" name="stateform">
                           
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Country Name</label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="countryid" >
                                     <option value="">Select Country Name</option>
                                     <?php foreach($countyr_list as $cntry){ ?>
                                                <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                 </select>
                                  <script language="JavaScript">document.stateform.countryid.value="<?php echo $res->countryid; ?>";</script>
                              </div>
                           </div> 

                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">State Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text"  name="statename" value="<?php echo $res->state_name; ?>" id="example-text-input">
                                  <input class="form-control" type="hidden"  name="stateid" value="<?php echo $res->id; ?>" id="example-text-input">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Event Status</label>
                              <div class="col-sm-6">
                                 <select class="form-control"  name="eventsts">
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                 </select>
								 <script language="JavaScript">document.stateform.eventsts.value="<?php echo $res->event_status; ?>";</script>

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
   $(document).ready(function () {
    $('#stateform').validate({ // initialize the plugin
       rules: {
         countryid:{required:true },
         statename:{required:true },
         eventsts:{required:true }
        
        },
        messages: {
        countryid:"Select Country Name",
        statename:"Enter State Name",
        eventsts:"Select Status"
               },
         }); 
   });
</script>

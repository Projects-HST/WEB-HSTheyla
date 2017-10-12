<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">
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
                  <h3 class="page-title">Edit Plan Show Time</h3>
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
                        <form  method="post"  enctype="multipart/form-data" action="<?php echo base_url();?>booking/update_show_times_details" name="plantimeform" id="plantimeform">

                           <?php foreach ($edit as $res){ }?>

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Show Time</label>
                              <div class="col-sm-6">

       <input id="timepicker1" type="text" class="form-control"  name="showtime" value="<?php echo $res->show_time; ?>" >

       <!--input class="form-control"   type="text" name="showtime" value="<?php echo $res->show_time; ?>"-->
                      <input class="form-control" type="hidden" name="time_id" value="<?php echo $res->id;?>">
                     <input class="form-control" type="hidden" name="event_id" value="<?php echo $res->event_id;?>">
                     <input class="form-control" type="hidden" name="plan_id"  value="<?php echo $res->plan_id; ?>">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Available Seats</label>
                              <div class="col-sm-6">
                                 <input class="form-control"  type="text" name="seats" value="<?php echo $res->seat_available; ?>" >
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
<!-- content -->
<script type="text/javascript">

   $('#timepicker1').timepicki();

   $(document).ready(function () {
   $('#plantimeform').validate({ // initialize the plugin
      rules: {
        showtime:{required:true },
        seats:{required:true }
              
       },
   
       messages: {
       showtime:"Enter Show Times",
       seats:"Enter  Seats"
       
              },
        }); 
   });
   
</script>




<div class="content-page">
<!-- Footer Close-->
<!-- Start content -->
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
               <h3 class="page-title">Add Events</h3>
            </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
   </div>
   <div class="page-content-wrapper ">
     <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">

                        <h4 class="mt-0 header-title">Add Events Details</h4>
                       
                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Event Name</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" value="">
                            </div>
                            <label for="Category" class="col-sm-2 col-form-label">Select Category</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="">
                                    <option>Select</option>
                                    <option>Large select</option>
                                    <option>Small select</option>
                                </select>
                            </div>
                        </div>
                       <div class="form-group row">
                            <label for="country" class="col-sm-2 col-form-label">Select Country</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="">
                                    <option>Select</option>
                                    <option>Large select</option>
                                    <option>Small select</option>
                                </select>
                            </div>
                             <label for="city" class="col-sm-2 col-form-label">Select City</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="" >
                                    <option>Select</option>
                                    <option>Large select</option>
                                    <option>Small select</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                           
                            <label for="Venue" class="col-sm-2 col-form-label">Venue</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" value="" >
                            </div>
                             <label for="Address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-4">
                               <textarea  name="address" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 240 chars."></textarea>
                            </div>

                        </div>
                        <div class="form-group row">
                           
                            <label for="Description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-4">
                                <textarea  name="description" class="form-control" maxlength="225" rows="3" placeholder="This textarea has a limit of 30000 chars."></textarea>
                            </div>

                             <label for="ecost" class="col-sm-2 col-form-label">Event Cost</label>
                            <div class="col-sm-4">
                                 <select class="form-control" name="eventcost">
                                    <option>Free</option>
                                    <option>Paid</option>
                                    <option>Invite</option>
                                </select>
                            </div>
                        </div>
                       <div class="form-group row">
                           
                            <label for="sdate" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <input type="text" class="form-control" name="start_date" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>

                             <label for="edate" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-4">
                               <div class="input-group">
                                <input type="text" class="form-control" name="end_date" id="datepicker">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                           
                            <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" value="" >
                            </div>

                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" value="">
                            </div>

                        </div>
                        <div class="form-group row">
                           
                            <label for="latitude" class="col-sm-2 col-form-label">Event Latitude</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" value="" >
                            </div>
                              <label for="longitude" class="col-sm-2 col-form-label">Event Longitude</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="primarycell" class="col-sm-2 col-form-label">primary Contact Phone</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" value="">
                            </div>
                            <label for="seccell" class="col-sm-2 col-form-label">secondary Contact Phone</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" value="" >
                            </div>
                        </div>
                       <div class="form-group row">
                            <label for="Person" class="col-sm-2 col-form-label">Contact Person</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" value="">
                            </div>
                            <label for="Email" class="col-sm-2 col-form-label">Contact Email</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="" value="" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Event Banner</label>
                              <div class="col-sm-4">
                                 <input type="file" name="eventbanner" class="form-control" accept="image/*" >
                              </div>
                            
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-2">
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit </button></div>
                              <div class="col-sm-2">
                              <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                              Reset
                              </button></div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

                        </div><!-- container -->
   </div>
   <!-- Page content Wrapper -->
</div>
<!-- content -->


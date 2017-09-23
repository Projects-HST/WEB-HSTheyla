<?php
    function get_times( $default = '10:00', $interval = '+15 minutes' ) 
   {
      $output = '';
      $current = strtotime( '00:00:00' );
      $end = strtotime( '23:59:00' );
      while( $current <= $end ) {
         $time = date( 'H:i:s', $current );
         $sel = ( $time == $default ) ? ' selected' : '';
         $output .= "<option value=\"{$time}\">" . date( 'h.i A', $current ) .'</option>';
         $current = strtotime( $interval, $current );
      }
      return $output;
    }
?>
<style type="text/css">
   .img-circle{
          width: 90px;
         border-radius: 30px;
       }
</style>

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
         <h3 class="page-title">Add  Advertisement Details</h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
      </div>
      <!-- Top Bar End -->
      <div class="page-content-wrapper">
         <div class="container">
            
            <div class="row">
               <div class="col-lg-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"></h4>
                        <form  method="post" action="<?php echo base_url();?>advertisement/add_adv_history" name="advertisementform" enctype="multipart/form-data">
                         <?php //echo $event_id;   echo $category_id;?>
                       <div class="form-group row">
                            <label for="sdate" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <input type="text" class="form-control"  name="start_date" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>

                           <input type="hidden" class="form-control"  name="event_id" value=" <?php echo $event_id;   ?>">
                            <input type="hidden" class="form-control"  name="category_id" value=" <?php echo $category_id;?>" >
                            </div>
                            </div>

                             <label for="edate" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-4">
                               <div class="input-group">
                                <input type="text" class="form-control" required="" name="end_date" id="datepicker">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                           
                             <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">
                                <select name="start_time" required="" class="form-control" >
                                     <option value="">Select Start Time</option>
                            <option value=""><?php echo get_times(); ?></option>
                        </select>

                            </div>

                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                                <select name="end_time" required="" class="form-control" >
                                     <option value="">Select End Time</option>
                            <option value=""><?php echo get_times(); ?></option>
                        </select>
                            </div>

                        </div>
                        <div class="form-group row">
                             <label for="ecost" class="col-sm-2 col-form-label">Plans</label>
                            <div class="col-sm-4">
                                 <select class="form-control" required="" name="adv_plan">
                                    <option value="Free">Select Plans </option>
                                    <?php foreach ($plans as $values) {?>
                                    <option value="<?php echo $values->id; ?>"><?php  echo $values->plan_name; ?></option>
                                   <?php  } ?>
                                  
                                </select>
                            </div>
                            <label for="Status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
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
                        <h4 class="mt-0 header-title">View Advertisement Plans</h4>
                        
                           <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
							     <th>S.NO</th>
                                 <th>Event Name</th>
                                 <th>Category Rate</th>
                                 <th>From Date</th>
                                 <th>To Date</th>
                                 <th>From Time</th>
                                 <th>To Time</th>
                                 <th>Plan Name</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
						            <?php
                                $i=1;
                                foreach($result as $rows) {
                                ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->event_name; ?></td>
                                 <td> <?php echo $rows->category_name; ?></td>
                                 <td><?php  echo $rows->date_from; ?></td>
                                 <td> <?php echo $rows->date_to; ?></td>
                                 <td><?php  echo $rows->time_from; ?></td>
                                 <td> <?php echo $rows->time_to; ?></td>
                                 <td><?php  echo $rows->plan_name; ?></td>
                                 <td> <?php echo $rows->status; ?></td>


                                 <td> </td>
                                  
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


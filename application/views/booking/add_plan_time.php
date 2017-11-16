
<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">

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
               </li!-->
               <li class="list-inline-item dropdown notification-list">
                  <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                     aria-haspopup="false" aria-expanded="false">
                  <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
                  </a>
                  <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                     <!--a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                     <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                     <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a!-->
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
                  <h3 class="page-title">Plan Show Time</h3>
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
                        <form  method="post"  enctype="multipart/form-data" action="<?php echo base_url();?>booking/add_show_times_details" name="plantimeform" id="plantimeform">

                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Show Date</label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="showdate">
                                   <?php  
                                   foreach($dates as $rows1) { }
                                    $start_date=$rows1->start_date;
                                    $end_date=$rows1->end_date;
                                    $start_date = date('Y-m-d', strtotime($start_date));
                                    $end_date =  date('Y-m-d', strtotime($end_date));
                                    $day = 86400; // Day in seconds  
                                    $format = 'd-m-Y'; // Output format (see PHP date funciton)  
                                    $sTime = strtotime($start_date); // Start as time  
                                    $eTime = strtotime($end_date); // End as time  
                                    $numDays = round(($eTime - $sTime) / $day) + 1;  
                                    $days = array();  
                                    for ($d = 0; $d < $numDays; $d++)
                                    {  ?>
                                    <option> 
                                    <?php echo $days[] = date($format, ($sTime + ($d * $day))); echo'<br>';?></option>
                                   <?php } ?>
                                 </select>

                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Show Time</label>
                              <div class="col-sm-6">
                                 <input id="timepicker1" type="text" class="form-control"  name="showtime"/>
                                 <!--input class="form-control"   type="text" name="showtime"-->
                              <input class="form-control"  type="hidden" name="event_id" value="<?php echo $eventid ;?>">
                              <input class="form-control"  type="hidden" name="plan_id" value="<?php echo $planid ;?>">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Available Seats</label>
                              <div class="col-sm-6">
                                 <input class="form-control"  type="text" name="seats" >
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
                        <h4 class="mt-0 header-title"></h4>
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
                                 <th>Plan Name</th>
                                 <th>Show Date</th>
                                 <th>Show Time</th>
                                 <th>Available Seats</th>
                                 <th>Amount</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach($plan_time as $rows) {
                                    $tlt=$rows->total_seats;
                                    $ave=$rows->seat_available;
                                 ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->event_name; ?></td>
                                 <td><?php  echo $rows->plan_name; ?></td>
                                 <td><?php  echo $newDate = date("d-m-Y",strtotime($rows->show_date));?></td>
                                 <td><?php  echo $rows->show_time; ?></td>
                                 <td><?php  if(empty($tlt)){ echo $ave; }else{ echo $tlt; } ?></td>
                                 <td><?php  echo $rows->seat_rate; ?></td>
                                 <td>
                                    <a href="<?php echo base_url();?>booking/edit_plan_time/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
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


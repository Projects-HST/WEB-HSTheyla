<!-- Start content -->
<div class="content-page">
<div class="content">
   <!-- Top Bar Start -->
   <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <!--!--li class="list-inline-item dropdown notification-list">
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
         <h3 class="page-title">View Booking History</h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
      </div>
      <!-- Top Bar End -->
      <div class="page-content-wrapper">
         <div class="container">
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
                                 <th>Plan</th>
                                 <th>Show Date & Time</th>
                                 <th>Seats</th>
                                 <th>Booking Date</th>
                                 
                                 <th>Amount</th>
                                 <!--th>Status</th-->
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
						                <?php
                                $i=1;
                                foreach($view as $rows) {
                                ?>
                               <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $rows->event_name; ?></td>
                                 <td><?php echo $rows->plan_name; ?></td>
                                 <td><?php echo $rows->show_date; ?> ( <?php echo $rows->show_time; ?> ) </td>
                                 <td><?php echo $rows->number_of_seats; ?></td>
                                 <td><?php echo $rows->booking_date; ?></td>
                                 <td><?php echo $rows->total_amount; ?></td>
                                 <!--td><?php // echo $rows->country_name; ?></td-->
								 <td><a href="<?php echo base_url();?>bookinghistory/view_attendees/<?php echo $rows->order_id;?>"><img title="View Attendees" src="<?php echo base_url();?>assets/icons/view.png" /></a></td>
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
 $(document).ready(function () {
    $('#countryform').validate({ // initialize the plugin
       rules: {
         countryname:{required:true },
         eventsts:{required:true }
        },
        messages: {
        countryname:"Enter Country Name",
        eventsts:"Select Status"
               },
         }); 
   });
  
</script>

<div class="content-page"> <!-- Footer Close-->
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
         <h3 class="page-title">view Attendees List</h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
      </div>
    <!-- Top Bar End -->

    <div class="page-content-wrapper ">
        <div class="container">
         
          <div class="row">
             <?php foreach ($view_attendees as $res) { ?>
            <div class="col-lg-4">
                <div class="card m-b-20 card-block">
                    <h4 class="card-title font-20 mt-0">Name : <?php echo $res->name;?></h4>
                    <p class="card-text"> Email Id : <?php echo $res->email_id;?></p>
                    <a href="#" class="btn btn-primary waves-effect waves-light">Mobile No : <?php echo $res->mobile_no;?></a>
                </div>
            </div>
            <?php } ?> 
        </div>
        <!-- end row --> 
       
        </div><!-- container -->
    </div> <!-- Page content Wrapper -->


</div> <!-- content -->
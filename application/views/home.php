<style type="text/css">
.test :hover
 {
    /*background-color:#ccc;
    outline-width: 10px;*/
 }
</style>

<!-- Start right Content here -->
<div class="content-page">
<!-- Start content -->
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
      <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
          <div class="dropdown-item noti-title">
              <h5><span class="badge badge-danger float-right">87</span>Notification</h5>
          </div>
          <a href="javascript:void(0);" class="dropdown-item notify-item">
              <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
              <p class="notify-details"><b>Your order is placed</b><small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
          </a>
          <a href="javascript:void(0);" class="dropdown-item notify-item">
              <div class="notify-icon bg-primary"><i class="mdi mdi-message"></i></div>
              <p class="notify-details"><b>New Message received</b><small class="text-muted">You have 87 unread messages</small></p>
          </a>
          <a href="javascript:void(0);" class="dropdown-item notify-item">
              <div class="notify-icon bg-primary"><i class="mdi mdi-martini"></i></div>
              <p class="notify-details"><b>Your item is shipped</b><small class="text-muted">It is a long established fact that a reader will</small></p>
          </a>
          <a href="javascript:void(0);" class="dropdown-item notify-item">
              View All
          </a>
      </div>
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
                      <a class="dropdown-item" href="<?php echo base_url(); ?>adminlogin/logout"><i class="mdi mdi-logout m-r-5 text-muted"></i>Logout</a>
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
                <h3 class="page-title">Admin Dashboard</h3>
            </li>
          </ul>

          <div class="clearfix"></div>
      </nav>
  </div>
  <!-- Top Bar End -->

  <div class="page-content-wrapper ">
      <div class="container">
          <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-3">
                <a href="<?php echo base_url();?>users/view" class="test">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($users as $value) {
                            echo $value->users;
                          } ?></span>
                          Users
                      </div>
                  </div>
                </a>

              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>events/view_events" class="test">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><i class="mdi mdi-currency-usd"></i></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($events as $rows) {
                            echo $rows->events;
                          } ?></span>
                          Events
                      </div>
                  </div></a>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <div class="mini-stat clearfix bg-primary">
                     <a href="<?php echo base_url();?>events/organizer_events" class="test">
                      <span class="mini-stat-icon"><i class="mdi mdi-cube-outline"></i></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($org_events as $res) {
                            echo $res->org;
                          } ?></span>
                         Organizer Events
                      </div></a>
                  </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>bookinghistory/home" class="test">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><i class="mdi mdi-currency-btc"></i></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($booking as $res) {
                            echo $res->booking;
                          } ?></span>
                          Booking
                      </div>
                  </div></a>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                 <a href="<?php echo base_url();?>reviews/view_reviews" class="test">
                  <div class="mini-stat clearfix bg-primary">
                      <span class="mini-stat-icon"><i class="mdi mdi-currency-btc"></i></span>
                      <div class="mini-stat-info text-right text-white">
                          <span class="counter"><?php foreach ($reviews as $res) {
                            echo $res->reviews;
                          } ?></span>
                          Pending Reviews
                      </div>
                  </div></a>
              </div>
          </div>
      </div><!-- container -->


  </div> <!-- Page content Wrapper -->
</div> <!-- content -->

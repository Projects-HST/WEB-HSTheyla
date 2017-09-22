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
         <h3 class="page-title">View Events</h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
      </div>
    <!-- Top Bar End -->

    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
      
        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-block">

                    <h4 class="mt-0 header-title"></h4>

                     <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>


                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified" role="tablist" style="width:60%;margin-left:3%;">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">Advertisement</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">Hotspot </a>
                        </li>
                         <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab">Normal Events</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                            <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Category</th>
                            <th>Event City</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $rows){ 
                           $adv_sts=$rows->adv_status;
                           $etype=$rows->event_type;
                          if($adv_sts=='Y'){ ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                            <td>
                             <a href="<?php echo base_url();?>events/edit_events/<?php echo $rows->id;?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>

                             <a href="<?php echo base_url();?>events/view_single_events/<?php echo $rows->id;?>">
                              <img  title="View Events" src="<?php echo base_url();?>assets/icons/view.png"/></a>

                              <a href="<?php echo base_url();?>events/delete_events/<?php echo $rows->id;?>">   
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a>

                              <?php if($etype=='Paid'){?>
                              <a href="<?php echo base_url();?>booking/home/<?php echo $rows->id;?>">
                              <img title="Booking Events" src="<?php echo base_url();?>assets/icons/booking.png"/></a>
                              <?php } ?>

                              <a href="<?php echo base_url();?>events/add_events_gallery/<?php echo $rows->id;?>">   
                              <img title="Add Gallery" src="<?php echo base_url();?>assets/icons/gallery.png"/></a>

                            </td>
                        </tr>
                       <?php } } ?>
                        </tbody>
                    </table>
                        </div>

                        <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                      <table class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Category</th>
                            <th>Event City</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $rows){ 
                           $hotspot_sts=$rows->hotspot_status;
                           $etype=$rows->event_type;
                          if($hotspot_sts=='Y'){ ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                           <td>
                             <a href="<?php echo base_url();?>events/edit_events/<?php echo $rows->id;?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>

                             <a href="<?php echo base_url();?>events/view_single_events/<?php echo $rows->id;?>">
                              <img  title="View Events" src="<?php echo base_url();?>assets/icons/view.png"/></a>

                              <a href="<?php echo base_url();?>events/delete_events/<?php echo $rows->id;?>">   
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a>
                              
                              <?php if($etype=='Paid'){?>
                              <a href="<?php echo base_url();?>booking/home/<?php echo $rows->id;?>">
                              <img title="Booking Events" src="<?php echo base_url();?>assets/icons/booking.png"/></a>
                              <?php } ?>

                              <a href="<?php echo base_url();?>events/add_events_gallery/<?php echo $rows->id;?>">   
                              <img title="Add Gallery" src="<?php echo base_url();?>assets/icons/gallery.png"/></a>

                            </td>
                        </tr>
                       <?php } }  ?>
                        </tbody>
                    </table>
                        </div>

                        <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                      <table class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Event Category</th>
                            <th>Event City</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $rows){
                           $adv_sts=$rows->adv_status;
                           $hotspot_sts=$rows->hotspot_status;
                           $etype=$rows->event_type;
                          if($hotspot_sts=='N' && $adv_sts=='N'){ 
                           ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                           <td>
                             <a href="<?php echo base_url();?>events/edit_events/<?php echo $rows->id;?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>

                             <a href="<?php echo base_url();?>events/view_single_events/<?php echo $rows->id;?>">
                              <img  title="View Events" src="<?php echo base_url();?>assets/icons/view.png"/></a>

                              <a href="<?php echo base_url();?>events/delete_events/<?php echo $rows->id;?>">   
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a>
                              
                              <?php if($etype=='Paid'){?>
                              <a href="<?php echo base_url();?>booking/home/<?php echo $rows->id;?>">
                              <img title="Booking Events" src="<?php echo base_url();?>assets/icons/booking.png"/></a>
                              <?php } ?>

                              <a href="<?php echo base_url();?>events/add_events_gallery/<?php echo $rows->id;?>">   
                              <img title="Add Gallery" src="<?php echo base_url();?>assets/icons/gallery.png"/></a>

                              
                            </td>
                        </tr>
                       <?php } }  ?>
                        </tbody>
                    </table>                       
                        </div>
                       
                    </div>

                </div>
            </div>
        </div>
      </div> <!-- end row -->

     </div><!-- container -->
    </div> <!-- Page content Wrapper -->


</div> <!-- content -->
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable();
} );
</script>
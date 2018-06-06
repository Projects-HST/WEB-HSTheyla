<style type="text/css">
   .img-circle{
          width: 90px;
         border-radius: 30px;
       }
</style>
<!--div class="content-page">
< Start content >
<div class="content">
    <! Top Bar Start 
  <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <!-li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>
            </li!->
            <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!--a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
            <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a!->
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
         <h3 class="page-title">Add Photos ( <span style="color: #28c2dc;">  <?php foreach($eventname as $rows){ echo $rows->event_name;}?>  </span> ) </h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
      </div>
    <!-- Top Bar End -->

<div class="page-content-wrapper ">

<div class="container">

<div class="row">
<div class="col-12">
<div class="card m-b-20">
    <div class="card-block">
        <h4 class="mt-0 header-title"> Add Gallery ( <span style="color: #28c2dc;">  <?php foreach($eventname as $rows){ echo $rows->event_name;}?>  </span> ) </h4>
        <div class="m-b-30">
           <form  method="post" action="<?php echo base_url();?>events/add_gallery" name="eventpicform" id="eventpicform" enctype="multipart/form-data">
              <div class="form-group row">
                 <div class="col-sm-4">
                  <input type="file" name="eventpicture[]" class="form-control" accept="image/*"  multiple="">
                  <input type="hidden" name="eventid" class="form-control" value="<?php echo $evnid;?>">
                 </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-4">
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                  </div>
             </div>
            </form>
        </div>

    </div>
    </div>
</div> <!-- end col -->
  </div> <!-- end row -->

           <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">View Event Gallery</h4>
                        
                           <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
                                  <th>S.No</th>
                                 <th>Event Name</th>
                                 <th>Event Picture</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                             <?php
                                $i=1;
                                foreach($view_pic as $rows) {
                                ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->event_name; ?></td>
                                 <td> 
                                    <img src="<?php echo base_url(); ?>assets/events/gallery/<?php echo $rows->event_image; ?>" class="img-circle">
                                 </td>
                                 <td> <a href="<?php echo base_url();?>events/delete_events_img/<?php echo $rows->id;?>/<?php echo $rows->eventid;?>">   
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a></td>
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

</div><!-- container -->
</div> <!-- Page content Wrapper -->


</div> <!-- content -->
<script type="text/javascript">

  $('#vieweve').addClass("active");
  $('#events').addClass("has_sub active nav-active");
  
 $(document).ready(function () {
    $('#eventpicform').validate({ // initialize the plugin
       rules: {
          eventid:{required:true },
         'eventpicture[]':{required:true }
        },
        messages: {
         eventid:"Enter Event Id",
        'eventpicture[]':"Select Picture"
               },
         }); 
   });
  
</script>


<!--link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet"-->

<div class="container" style="margin-top:30px;margin-bottom:50px;max-width:100%;">
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="#" class="list-group-item">Dashboard</a>
            <a href="<?php echo base_url();?>organizer/createevents/" class="list-group-item">Create Events</a>
            <a href="<?php echo base_url();?>organizer/viewevents/" class="list-group-item">View Events</a>
            <a href="<?php echo base_url();?>organizerbooking/view_booking/" class="list-group-item">Bookings</a>
            <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
            <a href="<?php echo base_url();?>organizerbooking/reviews/" class="list-group-item active">Reviews</a>
            <a href="<?php echo base_url();?>organizerbooking/view_followers/" class="list-group-item">Followers</a>
          </div>
        </div><!--/span-->
        
        <div class="col-12 col-md-9">
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
                        <li class="nav-item waves-effect waves-light" style="webkit-flex:none; */
    -ms-flex: 1 1 100%; flex: none;">
                            <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">Advertisement</a>
                        </li>
                        <li class="nav-item waves-effect waves-light" style="webkit-flex:none; */
    -ms-flex: 1 1 100%; flex: none; padding-left: 50px;">
                            <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">Hotspot </a>
                        </li>
                         <li class="nav-item waves-effect waves-light" style="webkit-flex:none; */
    -ms-flex: 1 1 100%; flex: none;padding-left: 50px;">
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
                        <?php
                        foreach($result as $rows){ 
                           $adv_sts=$rows->adv_status;
                          if($adv_sts=='Y'){ ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                            <td><a href="<?php echo base_url();?>organizerbooking/view_reviews/<?php echo $rows->id;?>"><img title="View Reviews" src="<?php echo base_url();?>assets/icons/customerreviews.png"/></a></td>
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
                          if($hotspot_sts=='Y'){ ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                            <td><a href="<?php echo base_url();?>organizerbooking/view_reviews/<?php echo $rows->id;?>"><img title="View Reviews" src="<?php echo base_url();?>assets/icons/customerreviews.png"/></a></td>
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
                          if($hotspot_sts=='N' && $adv_sts=='N'){ 
                           ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                            <td>
                          <a href="<?php echo base_url();?>organizerbooking/view_reviews/<?php echo $rows->id;?>">
                          <img title="View Reviews" src="<?php echo base_url();?>assets/icons/customerreviews.png"/>
                            </a>
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
        </div><!--/span-->
      </div><!--/row-->
 </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('table.display').DataTable();
} );
</script>
    

<!--link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet"-->

<div class="container" style="margin-top:30px;margin-bottom:50px;max-width:100%;">
  <div class="row row-offcanvas row-offcanvas-right">
      <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar">
        <div class="list-group">
          <a href="<?php echo base_url();?>home" class="list-group-item">Dashboard</a>
          <a href="<?php echo base_url();?>organizer/createevents/" class="list-group-item">Create Events</a>
          <a href="<?php echo base_url();?>organizer/viewevents/" class="list-group-item">View Events</a>
        <a href="<?php echo base_url();?>organizerbooking/view_booking/" class="list-group-item">Bookings</a>
        <a href="<?php echo base_url();?>organizerbooking/messageboard/" class="list-group-item">Messages</a>
          <a href="<?php echo base_url();?>organizerbooking/reviews/" class="list-group-item">Reviews</a>
          <a href="<?php echo base_url();?>organizerbooking/view_followers/" class="list-group-item active">Followers</a>
        </div>
      </div><!--/span-->
    <div class="col-12 col-md-9">
    <div class="page-content-wrapper ">
    <div class="container">
        <div class="row">
         <?php if(empty($fdetails)){ 
            echo "No Followers";
            }else{ foreach ($fdetails as $res) { ?>
          <div class="col-lg-4">
               <div class="card m-b-20 card-block">
                    <h4 class="card-title font-20 mt-0">Name : <?php echo $res->name;?></h4>
                    <p class="card-text"> Email Id : <?php echo $res->email_id;?></p>
                    <a href="#" class="btn btn-primary waves-effect waves-light">Mobile No : <?php echo $res->mobile_no;?></a>
                </div>
            </div>
            <?php } } ?> 
        </div>
        <!-- end row --> 
    </div><!-- container -->
    </div> <!-- Page content Wrapper -->
  </div><!--/span-->
 </div><!--/row-->
</div>
    
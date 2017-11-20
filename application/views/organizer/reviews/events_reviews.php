
<!--link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet"-->

<div class="container" style="margin-top:30px;margin-bottom:50px;max-width:100%;">
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="<?php echo base_url();?>home" class="list-group-item">Dashboard</a>
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
           <?php if($this->session->flashdata('msg')): ?>
                          <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                          </div>
                        <?php endif; ?> 
         <?php if(!empty($views)) { foreach ($views as $value) {  ?>
         <div class="row">
            <div class="col-md-10">
                <div class="card m-b-20 card-block">
                    <h3 class="card-title font-20 mt-0"> <?php echo $value->event_name;?> ( <?php echo $value->event_rating; ?> ) </h3>
                    <p class="card-text">
                     <?php echo $value->comments;?> 
                    
                   </p>
                    <div class="form-group row">
                      
                      <div class="col-sm-2">
                           <img src="<?php echo base_url();?>assets/review/images/<?php echo $value->photo; ?>" style="width:80%;border-radius:100px;float: right;">
                        </div>
                          
                        </div>
            </div>
            </div>
        </div>
      <!-- end row -->
        <?php } }else{ echo "<p class=card-text> No Reviews Found </p>";}?>

        </div><!-- container -->
    </div> <!-- Page content Wrapper -->
    
        </div><!--/span-->
      </div><!--/row-->
 </div>

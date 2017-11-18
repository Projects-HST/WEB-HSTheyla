<style type="text/css">
  .btn btn-secondary buttons-copy buttons-html5
  {
    display: none;
  }
</style>
    <div class="container" style="margin-top:30px;margin-bottom:50px;max-width:100%;">
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="<?php echo base_url(); ?>home" class="list-group-item">Dashboard</a>
            <a href="<?php echo base_url(); ?>organizer/createevents/" class="list-group-item">Create Events</a>
            <a href="<?php echo base_url(); ?>organizer/viewevents/" class="list-group-item ">View Events</a>
            <a href="<?php echo base_url(); ?>organizerbooking/view_booking/" class="list-group-item active">Bookings</a>
            <a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a>
            <a href="<?php echo base_url(); ?>organizerbooking/reviews/" class="list-group-item">Reviews</a>
            <a href="<?php echo base_url();?>organizerbooking/view_followers/" class="list-group-item">Followers</a>
          </div>
        </div><!--/span-->
        
        <div class="col-12 col-md-9">
          
<div class="page-content-wrapper ">
<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">
                     
                 	<h4 class="mt-0 header-title">View Booking History</h4>

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
                                 <!--th>Amount</th-->
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
                                  <td><?php $date=date_create($rows->show_date);
                                       echo date_format($date,"d-m-Y");  ?> ( <?php echo $rows->show_time; ?> ) </td>
                                 <td><?php echo $rows->number_of_seats; ?></td>
                                 <td><?php $date=date_create($rows->booking_date);
                                       echo date_format($date,"d-m-Y"); ?></td>
                                  <!--td><?php echo $rows->total_amount; ?></td-->
                              </tr>
                             <?php $i++;  }  ?>
                           </tbody>
                        </table>

                
                     
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
	</div><!-- container -->
</div>
   <!-- Page content Wrapper -->
        </div><!--/span-->
      </div><!--/row-->
 </div>

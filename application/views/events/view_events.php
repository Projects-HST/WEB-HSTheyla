<style>
th{
  width:200px;
}
</style>
    <div class="page-content-wrapper ">
        <div class="container">
        <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-block">

                    <h4 class="mt-0 header-title"> View Events </h4>

                     <?php if($this->session->flashdata('msg')): ?>
                       <div class="alert <?php $msg=$this->session->flashdata('msg');
                       if($msg=='Event created successfully' || $msg=='Changes made are saved'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>


                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified" role="tablist" style="width:70%;margin-left:3%;">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-toggle="tab" href="#home-1" role="tab">Advertisements</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#profile-1" role="tab">Hotspots </a>
                        </li>
                         <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab">General Events</a>
                        </li>
                         <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#archived-1" role="tab">Archived Events</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                            <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Event</th>
                            <th>City/Area</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($result as $rows){
                           $eid=$rows->id;
                           $adv_sts=$rows->adv_status;
                           $etype=$rows->event_type;
                           $eid=$rows->id;
                           $status=$rows->event_status;
                          if($adv_sts=='Y'){
                             ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $rows->event_name ; ?></td>
                            <!--td><?php //echo $rows->category_name ; ?></td-->
                            <td><?php echo $rows->city_name ; ?></td>
                            <td><?php foreach($popular as $values){  $evid=$values->event_id;
                             if($eid==$evid){ echo $values->popular; } }?></td>
                             <td><?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Inactive </button>'; }?></td>

                            <td>
                             <a href="<?php echo base_url();?>events/edit_events/<?php echo base64_encode($rows->id);?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>

                             <a href="<?php echo base_url();?>events/view_single_events/<?php echo base64_encode($rows->id);?>">
                              <img  title="Event details" src="<?php echo base_url();?>assets/icons/view.png"/></a>

                              <!--a onclick="confirmGetMessage(<?php echo $eid;?>)" >
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a-->

                              <?php if($etype=='Paid'){?>
                              <a href="<?php echo base_url();?>booking/home/<?php echo base64_encode($rows->id);?>">
                              <img title="Ticket plans" src="<?php echo base_url();?>assets/icons/booking.png"/></a>
                              <?php } ?>

                              <a href="<?php echo base_url();?>events/add_events_gallery/<?php echo $rows->id;?>">
                              <img title="Gallery" src="<?php echo base_url();?>assets/icons/gallery.png"/></a>

                              <a href="<?php echo base_url();?>events/view_events_reviews/<?php echo base64_encode($rows->id);?>">
                              <img title="Reviews" src="<?php echo base_url();?>assets/icons/review.png"/></a>

                            </td>
                        </tr>
                      <?php $i++; }  }  ?>
                        </tbody>
                    </table>
                        </div>

                    <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                      <table class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                          <th>S. No</th>
                          <th>Event</th>
                          <th>City/Area</th>
                          <th>Views</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($result as $rows){
                            $eid=$rows->id;
                            $hotspot_sts=$rows->hotspot_status;
                            $etype=$rows->event_type;
                             $status=$rows->event_status;

                          if($hotspot_sts=='Y'){
                              ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                            <td><?php echo $rows->event_name ; ?></td>
                            <!--td><?php //echo $rows->category_name ; ?></td-->
                            <td><?php echo $rows->city_name ; ?></td>
                            <td><?php  foreach($popular as $values){
                              $evid=$values->event_id; if($eid==$evid){ echo $values->popular; } }?></td>
                               <td><?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Inactive </button>'; }?></td>
                           <td>
                             <a href="<?php echo base_url();?>events/edit_events/<?php echo base64_encode($rows->id);?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>

                             <a href="<?php echo base_url();?>events/view_single_events/<?php echo base64_encode($rows->id);?>">
                              <img  title="Event details" src="<?php echo base_url();?>assets/icons/view.png"/></a>
                             <!--href="<?php echo base_url();?>events/delete_events/<?php echo $rows->id;?>" -->
                              <!--a onclick="confirmGetMessage(<?php echo $eid;?>)">
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a-->

                              <?php if($etype=='Paid'){?>
                              <a href="<?php echo base_url();?>booking/home/<?php echo base64_encode($rows->id);?>">
                              <img title="Ticket plans" src="<?php echo base_url();?>assets/icons/booking.png"/></a>
                              <?php } ?>

                              <a href="<?php echo base_url();?>events/add_events_gallery/<?php echo $rows->id;?>">
                              <img title="Gallery" src="<?php echo base_url();?>assets/icons/gallery.png"/></a>

                              <a href="<?php echo base_url();?>events/view_events_reviews/<?php echo base64_encode($rows->id);?>">
                              <img title="Reviews" src="<?php echo base_url();?>assets/icons/review.png"/></a>

                            </td>
                        </tr>
                       <?php $i++; } }  ?>
                        </tbody>
                    </table>
                        </div>

                      <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                      <table class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                          <th>S. No</th>
                          <th>Event</th>
                          <th>City/Area</th>
                          <th>Views</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($result as $rows){
                           $eid=$rows->id;
                           $adv_sts=$rows->adv_status;
                           $hotspot_sts=$rows->hotspot_status;
                           $etype=$rows->event_type;
                           $status=$rows->event_status;
                          if($hotspot_sts=='N' && $adv_sts=='N')
                          {
                           ?>
                        <tr>
                              <td><?php echo $i; ?></td>
                            <td><?php echo $rows->event_name ; ?></td>
                            <!--td><?php // echo $rows->category_name ; ?></td-->
                            <td><?php echo $rows->city_name ; ?></td>
                            <td><?php foreach($popular as $values){
                              $evid=$values->event_id; if($eid==$evid){ echo $values->popular; } }?></td>
                               <td><?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Inactive </button>'; }?></td>
                           <td>
                             <a href="<?php echo base_url();?>events/edit_events/<?php echo base64_encode($rows->id);?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
                             <a href="<?php echo base_url();?>events/view_single_events/<?php echo base64_encode($rows->id);?>">
                              <img  title="Event details" src="<?php echo base_url();?>assets/icons/view.png"/></a>
                              <!--a onclick="confirmGetMessage(<?php echo $eid;?>)">
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a-->
                              <?php if($etype=='Paid'){ ?>
                              <a href="<?php echo base_url();?>booking/home/<?php echo base64_encode($rows->id);?>">
                                <img title="Ticket plans" src="<?php echo base_url();?>assets/icons/booking.png"/>
                             </a>
                              <?php } ?>
                              <a href="<?php echo base_url();?>events/add_events_gallery/<?php echo $rows->id;?>">
                              <img title="Gallery" src="<?php echo base_url();?>assets/icons/gallery.png"/>
                            </a>
                            <a href="<?php echo base_url();?>events/view_events_reviews/<?php echo base64_encode($rows->id);?>">
                              <img title="Reviews" src="<?php echo base_url();?>assets/icons/review.png"/>
                            </a>
                            </td>
                        </tr>
                       <?php $i++; } }  ?>
                        </tbody>
                    </table>
                  </div>
                    <div class="tab-pane p-3" id="archived-1" role="tabpanel">
                      <table class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                          <th>S. No</th>
                          <th>Event</th>
                          <th>City/Area</th>
                          <th>Views</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($sts as $rows){
                           $eid=$rows->id;
                           $evn_sts=$rows->event_status;
                           //$hotspot_sts=$rows->hotspot_status;
                           //$etype=$rows->event_type;
                           ?>
                        <tr>
                              <td><?php echo $i; ?></td>
                          <td><?php echo $rows->event_name ; ?></td>
                          <!--td><?php // echo $rows->category_name ; ?></td-->
                          <td><?php echo $rows->city_name ; ?></td>
                          <td><?php foreach($popular as $values){
                            $evid=$values->event_id; if($eid==$evid){ echo $values->popular; } }?></td>
                             <td><?php if($evn_sts=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Inactive </button>'; }?></td>
                          <td>
                           <a href="<?php echo base_url();?>events/edit_events/<?php echo base64_encode($rows->id);?>">
                            <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>

                           <a href="<?php echo base_url();?>events/view_single_events/<?php echo base64_encode($rows->id);?>">
                            <img  title="Event details" src="<?php echo base_url();?>assets/icons/view.png"/></a>
                            <!--a onclick="confirmGetMessage(<?php echo $eid;?>)">
                            <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a-->
                            <?php if($etype=='Paid'){ ?>
                            <a href="<?php echo base_url();?>booking/home/<?php echo base64_encode($rows->id);?>">
                              <img title="Ticket plans" src="<?php echo base_url();?>assets/icons/booking.png"/>
                           </a>
                            <?php } ?>
                            <a href="<?php echo base_url();?>events/add_events_gallery/<?php echo $rows->id;?>">
                            <img title="Gallery" src="<?php echo base_url();?>assets/icons/gallery.png"/>
                          </a>
                          <a href="<?php echo base_url();?>events/view_events_reviews/<?php echo base64_encode($rows->id);?>">
                            <img title="Reviews" src="<?php echo base_url();?>assets/icons/review.png"/>
                          </a>
                          </td>
                        </tr>
                       <?php $i++; }  ?>
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
<style>

</style>
<script type="text/javascript">
  function confirmGetMessage(eid)
  {
    var r=confirm("Do you want to delete this?")
    if (r==true) {
    $.ajax({
      url: "<?php echo base_url(); ?>events/delete_events",
      type: 'POST',
      data: { eventid: eid },
      success: function(response) {
      //alert(response);exit;
          if (response == "success") {
              swal({
                  title: "Success",
                  text: "Deleted Successfully",
                  type: "success"
              }).then(function() {
                  location.href = '<?php echo base_url(); ?>events/view_events';
              });
          } else {
              sweetAlert("Oops...", response, "error");
          }
      }
    });
    }else{
        swal("Cancelled", "Process Cancel :)", "error");
       }
  }

  $(document).ready(function() {
    $('table.display').DataTable();
} );
</script>

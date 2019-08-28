

    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">

        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-block">

                    <h4 class="mt-0 header-title"> View Banner Advertisements</h4>

                     <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                            <table  id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>S. No</th>
                            <th style="width:250px;">Event</th>
                            <th>Event Category</th>
                            <th>Event City/Area</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                          $i=1;
                           foreach($result as $rows){
                           $eid=$rows->id;
                           $adv_sts=$rows->adv_status;
                           $etype=$rows->event_type;
                          if($adv_sts=='Y'){
                             ?>
                        <tr>
                            <td><?php echo $i ; ?></td>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->category_name ; ?></td>
                            <td><?php echo $rows->city_name ; ?></td>
                            <td>
                             <a href="<?php echo base_url();?>events/edit_events/<?php echo base64_encode($rows->id);?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>

                             <a href="<?php echo base_url();?>events/view_single_events/<?php echo base64_encode($rows->id);?>">
                              <img  title="Event details" src="<?php echo base_url();?>assets/icons/view.png"/></a>

                              <a href="<?php echo base_url();?>advertisement/add_advertisement_details/<?php echo $rows->id;?>/<?php echo $rows->category_id;?>">
                              <img title="Add Advertisement Details" src="<?php echo base_url();?>assets/icons/booking.png"/></a>

                            </td>
                        </tr>
                       <?php $i++; }   } ?>
                        </tbody>
                    </table>
                        </div>


                    </div>

                </div>
            </div>
        </div>
      </div> <!-- end row -->

     </div><!-- container -->
    </div> <!-- Page content Wrapper href="<?php echo base_url();?>events/delete_events/<?php echo $rows->id;?>" -->

</div> <!-- content -->
<script type="text/javascript">

  function confirmGetMessage(eid)
  {
    var r=confirm("Do you want to delete this?")
    if (r==true) {
    $.ajax({
      url: "<?php echo base_url(); ?>events/delete_events",
      type: 'POST',
      data: { eid: eid },
      success: function(response) {
      //alert(response);exit;
          if (response == "success") {
              swal({
                  title: "Success",
                  text: "Deleted Successfully",
                  type: "success"
              }).then(function() {
                  location.href = '<?php echo base_url(); ?>advertisement/view_adv_plan';
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

} );
</script>

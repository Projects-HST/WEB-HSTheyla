

    <div class="page-content-wrapper ">
        <div class="container">
        <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-block">
                    <h4 class="mt-0 header-title"></h4>

                     <?php if($this->session->flashdata('msg')): ?>
                       <div class="alert <?php $msg=$this->session->flashdata('msg');
                       if($msg=='Added Successfully' || $msg=='Deleted Successfully' || $msg=='updated Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>



                  <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                            <tr> <th>S.No</th>
                            <th>Event Name</th>
                            <!--th>Event Category</th-->
                            <th>City</th>
                            <th>Popularity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                         foreach($org as $rows){
                           $eid=$rows->id;
                           $etype=$rows->event_type;
                           $eid=$rows->id;
                           $status=$rows->event_status;
                             ?>
                        <tr>
                          <td><?php  echo $i; ?></td>
                            <td><?php echo $rows->event_name ; ?></td>
                            <!--td><?php //echo $rows->category_name ; ?></td-->
                            <td><?php echo $rows->city_name ; ?></td>
                            <td><?php foreach($popular as $values){  $evid=$values->event_id;
                             if($eid==$evid){ echo $values->popular; } }?></td>
                             <td><?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Deactive </button>'; }?></td>
                            <td>
                             <a href="<?php echo base_url();?>events/edit_events/<?php echo base64_encode($rows->id);?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>

                             <a href="<?php echo base_url();?>events/view_single_events/<?php echo base64_encode($rows->id);?>">
                              <img  title="View Events" src="<?php echo base_url();?>assets/icons/view.png"/></a>

                              <!--a onclick="confirmGetMessage(<?php echo $eid;?>)" >
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a-->

                            </td>
                        </tr>
                       <?php  $i++; }  ?>
                        </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div> <!-- end row -->
          </div><!-- container -->
        </div> <!-- Page content Wrapper -->
      </div> <!-- content -->

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

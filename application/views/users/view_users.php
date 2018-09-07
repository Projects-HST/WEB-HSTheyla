    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">

        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-block">

                    <h4 class="mt-0 header-title"> View Admin Users List </h4>

                     <?php if($this->session->flashdata('msg')): ?>
                       <div class="alert <?php $msg=$this->session->flashdata('msg');
                       if($msg=='Added Successfully' || $msg=='Updated Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
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
                            <th>S.No</th>
                            <th>Username/ Email </th>
                            <th>Full Name</th>

                            <th>Phone</th>

                            <th>City</th>
                            <th>Points</th>

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                           $i=1;
                           foreach($users_view as $rows){
                           $sts=$rows->status;
                           $uid=$rows->user_id;
                           $usid=$rows->id;
                              ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                              <?php echo $rows->user_name ; ?><br>
                            <?php echo $rows->email_id; ?>
                          </td>
                            <td><?php echo $rows->name ; ?></td>

                            <td><?php echo $rows->mobile_no; ?></td>

                            <td><?php echo $rows->city_name ; ?></td>
                            <td><?php echo $rows->total_points ; ?></td>

                            <td><?php if($sts=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Deactive </button>'; }?></td>
                            <td>
                             <a href="<?php echo base_url();?>users/edit/<?php echo $rows->id;?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
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
    </div> <!-- Page content Wrapper href="<?php echo base_url();?>users/delete/<?php echo $rows->id;?>/<?php echo $rows->user_id; ?>"-->

</div> <!-- content -->
<script type="text/javascript">

  function confirmGetMessage(usid,uid)
  {
    var r=confirm("Do you want to delete this?")
    if (r==true) {
    $.ajax({
      url: "<?php echo base_url(); ?>users/delete",
      type: 'POST',
      data: { uaid: usid, userid: uid },
      success: function(response) {
      alert(response);exit;
          if (response == "success") {
              swal({
                  title: "Success",
                  text: "Deleted Successfully",
                  type: "success"
              }).then(function() {
                  location.href = '<?php echo base_url(); ?>users/view';
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

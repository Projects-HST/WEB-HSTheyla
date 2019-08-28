

    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">

        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-block">

                     <?php if($this->session->flashdata('msg')): ?>
                       <div class="alert <?php $msg=$this->session->flashdata('msg');
                       if($msg=='Added Successfully' || $msg=='Updated Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                    <!-- Tab panes -->

                            <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th style="width:200px;">Event</th>
                            <th>Event Rating</th>
                            <th>Comments</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($views as $rows){
                           $sts=$rows->status; ?>
                        <tr>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->event_rating ; ?></td>
                            <td><?php echo $rows->comments ; ?></td>
                             <td><?php if($sts=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Deactive </button>'; }?></td>
                            <td>
                             <a href="<?php echo base_url();?>reviews/edit_reviews/<?php echo $rows->id;?>">
                              <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>

                             <a href="<?php echo base_url();?>reviews/view_single_reviews/<?php echo $rows->id;?>">
                              <img  title="View Events" src="<?php echo base_url();?>assets/icons/view.png"/></a>

                              <a href="<?php echo base_url();?>reviews/delete_reviews/<?php echo $rows->id;?>">
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a>
                            </td>
                        </tr>
                       <?php }  ?>
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
  $(document).ready(function() {
    $('table.display').DataTable();
} );
</script>

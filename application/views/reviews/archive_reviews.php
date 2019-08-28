<style>
td{
  width: 100px;
}
</style>
    <div class="page-content-wrapper ">
        <div class="container">

           <?php if($this->session->flashdata('msg')): ?>
             <div class="alert <?php $msg=$this->session->flashdata('msg');
             if($msg=='Added Successfully' || $msg=='Updated Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                          </div>
                        <?php endif; ?>

                        <div class="row">
                          <div class="col-md-12">
                            <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                              <th>S. No</th>
                                <th style="width:200px;">Event</th>
                                <th>Rating</th>
                                <th >Comments</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        <tbody>
                      <?php $i=1; if(!empty($views)) { foreach ($views as $value) {  ?>
                        <tr>
                          <td><?php  echo $i; ?></td>
                          <td><?php echo $value->event_name;?> </td>
                          <td><?php echo $value->event_rating; ?></td>
                            <td><?php echo $value->comments;?></td>
                           <td><a href="<?php echo base_url(); ?>reviews/display/<?php echo $value->id; ?>/Y/<?php echo $value->event_id; ?>/<?php echo $value->user_id; ?>" class="btn btn-primary waves-effect waves-light">
                               Display </a>  </td>
                        </tr>
                      <?php $i++; }  }else{ echo "<p class=card-text> No Reviews Found </p>";}?>
                        </tbody>
                    </table>
                          </div>
                        </div>




</div> <!-- content -->
<script>
$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

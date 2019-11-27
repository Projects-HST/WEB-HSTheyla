
    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">

        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-block">
					<h4 class="mt-0 header-title">Pending Reviews </h4>
					
					<?php if($this->session->flashdata('msg')): ?>
                          <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                          </div>
                        <?php endif; ?>

                <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>S. No</th>
                    <th style="width:250px;">Event</th>
                    <th>Rating</th>
                    <th>Comments</th>
                    <th style="width:250px;">Actions</th>
                </tr>
                </thead>
            <tbody>
          <?php $i=1; if(!empty($views)) { foreach ($views as $value) {  ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $value->event_name;?> </td>
                <td><?php echo $value->event_rating; ?></td>
                <td><?php echo $value->comments;?></td>

               <td><a href="<?php echo base_url(); ?>reviews/display/<?php echo $value->id; ?>/Y/<?php echo $value->event_id; ?>/<?php echo $value->user_id; ?>" class="btn btn-success waves-effect waves-light">
                   Display </a>
                   &nbsp;<a href="<?php echo base_url(); ?>reviews/archive/<?php echo $value->id; ?>/A/<?php echo $value->event_id; ?>/<?php echo $value->user_id; ?>" class="btn btn-warning waves-effect waves-light">
             Archive</a>  </td>
            </tr>
          <?php $i++; }  } else{ echo "<p class=card-text> No Reviews Found </p>";}?>
            </tbody>
        </table>
              </div>
                  </div>
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
         </div>
		   <!-- container -->
      </div>
     <!-- Page content Wrapper href="<?php echo base_url();?>advertisement/delete_history_all/<?php echo $rows->id;?>" -->
   </div>
    <!-- Top Bar Start -->
</div>
<!-- content -->
<script type="text/javascript">
  $(document).ready(function() {
	$(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
	
	$('table').DataTable({
         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false
    });
} );
</script>



    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">

        <div class="col-lg-12">
            <div class="card m-b-20">
                <div class="card-block">
					<h4 class="mt-0 header-title">All Reviews </h4>
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
						
                    <th>S. No</th>
                    <th>Event</th>
                    <th>Rating</th>
                    <th>Comments</th>
					<th>Status</th>
                    <th>Actions</th>
                </tr>
				
							
                        </thead>
                        <tbody>
						 <?php $i=1; if(!empty($views)) { foreach ($views as $rows) {  
                        
                           $sts=$rows->status; ?>
                        <tr>
						 <td><?php echo $i; ?></td>
                            <td><?php echo $rows->event_name ; ?></td>
                            <td><?php echo $rows->event_rating ; ?></td>
                            <td><?php echo $rows->comments ; ?></td>
                             <td><?php if($sts=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Inactive </button>'; }?></td>
                            <td>
                              <a onclick="return confirm_remove(<?php echo $rows->id; ?>)" style="cursor:pointer">
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/ ></a>
                            </td>
                        </tr>
                       <?php $i++; }  } else{ echo "<p class=card-text> No Reviews Found </p>";}?>
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
	$(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
	
	$('table').DataTable({
        "aLengthMenu": [[25, 50, 75, 100, -1], [25, 50, 75, 100, "All"]],
        "iDisplayLength": 25,
		"ordering": false,
		"bAutoWidth": false,
		"columns": [
					{ "width": "7%" },
					{ "width": "35%" },
					{ "width": "8%" },
					{ "width": "35%" },
					{ "width": "5%" },
					{ "width": "10%" }
				  ]
    });
} );

function confirm_remove(id){
  swal({
      title: '',
      text: "Are you sure want to remove?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
  }).then(function(){
		window.location.href='<?php echo base_url(); ?>reviews/remove_review/'+id;
  }).catch(function(reason){

  });
}
</script>

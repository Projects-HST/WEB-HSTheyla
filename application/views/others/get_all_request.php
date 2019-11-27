<div class="page-content-wrapper ">
    <div class="container">
    <h4 class="mt-0 header-title"> Organizer Requests </h4>
                    <div class="row">
                      <div class="col-md-12">
                        <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name/Email ID</th>
                            <!-- <th>Message</th> -->
                            <th>Status</th>

                            <th>Actions</th>
                        </tr>
                        </thead>
                    <tbody>
                  <?php $i=1; foreach ($get_all_request as $value) {   ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                        <td><?php echo $value->name_req;?> <br><?php echo $value->email_id; ?> </td>
                        <!-- <td><?php echo $value->message;?></td> -->
                          <td><?php if($value->req_status=="Pending"){ ?>
                            <p class="btn btn-danger waves-effect waves-light">Pending</p>
                          <?php }else if($value->req_status=="Approved"){ ?>
                              <p class="btn btn-success waves-effect waves-light">Approved</p>
                        <?php  }else{ ?>
                            <p class="btn btn-primary waves-effect waves-light">Denied</p>
                      <?php  }?></td>

                       <td><a href="<?php echo base_url(); ?>dashboard/update_req_status/<?php echo $value->rq_id*9876; ?>"><img title="Update" src="<?php echo base_url(); ?>assets/icons/view.png"></a>  </td>
                    </tr>
                  <?php $i++; }  ?>
                    </tbody>
                </table>
                      </div>
                    </div>




</div> <!-- content -->
<script>
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

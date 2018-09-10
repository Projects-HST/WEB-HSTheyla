<div class="page-content-wrapper ">
    <div class="container">
    <h4 class="mt-0 header-title"> Organiser Requests </h4>
                    <div class="row">
                      <div class="col-md-12">
                        <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name (Email)</th>
                            <th>Message</th>
                            <th>status</th>

                            <th>Action</th>
                        </tr>
                        </thead>
                    <tbody>
                  <?php foreach ($get_all_request as $value) { $i=1;  ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                        <td><?php echo $value->name;?> ( <?php echo $value->email_id; ?> )</td>
                        <td><?php echo $value->message;?></td>
                          <td><?php if($value->req_status=="Pending"){ ?>
                            <a href="" class="btn btn-primary waves-effect waves-light">Pending</a>
                          <?php }else if($value->req_status=="Approved"){ ?>
                              <a href="" class="btn btn-primary waves-effect waves-light">Approved</a>
                        <?php  }else{ ?>
                            <a href="" class="btn btn-primary waves-effect waves-light">Rejected</a>
                      <?php  }?></td>

                       <td><a href="<?php echo base_url(); ?>dashboard/update_req_status/<?php echo $value->rq_id*9876; ?>"><img title="View Request" src="<?php echo base_url(); ?>assets/icons/view.png"></a>  </td>
                    </tr>
                  <?php $i++; }  ?>
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

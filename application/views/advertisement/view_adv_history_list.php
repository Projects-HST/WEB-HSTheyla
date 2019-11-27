<?php
    function get_times( $default = '10:00', $interval = '+15 minutes' )
   {
      $output = '';
      $current = strtotime( '00:00:00' );
      $end = strtotime( '23:59:00' );
      while( $current <= $end ) {
         $time = date( 'H:i:s', $current );
         $sel = ( $time == $default ) ? ' selected' : '';
         $output .= "<option value=\"{$time}\">" . date( 'h.i A', $current ) .'</option>';
         $current = strtotime( $interval, $current );
      }
      return $output;
    }
?>
<style type="text/css">
   .img-circle{
          width: 90px;
         border-radius: 30px;
       }
</style>


      <div class="page-content-wrapper">
         <div class="container">

            <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">Banner Advertisement History </h4>

                           <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                        <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
							     <th>S. No</th>
                                 <th style="width:250px;">Event</th>
                                 <th>Category </th>
                                 <th>From Date</th>
                                 <th>To Date</th>
                                 <!-- <th>From Time</th> -->
                                 <!-- <th>To Time</th> -->
                                 <th>Plan</th>
                                 <!--<th>Status</th>-->
                                 <!--th>Action</th-->
                              </tr>
                           </thead>
                           <tbody>
						            <?php
                                $i=1;
                                foreach($adv_view as $rows) {
                                  $status=$rows->status;
                                  $ahid=$rows->id;
                                ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->event_name; ?></td>
                                 <td> <?php echo $rows->category_name; ?></td>
                                 <td><?php  $date=date_create($rows->date_from);
                                       echo date_format($date,"d-m-Y");  ?></td>
                                 <td> <?php $date=date_create($rows->date_to);
                                       echo date_format($date,"d-m-Y"); ?></td>
                                 <!-- <td><?php  echo date("g:i a",strtotime("$rows->time_from")); ?></td>
                                 <td> <?php echo date("g:i a",strtotime("$rows->time_to")); ?></td> -->
                                 <td><?php  echo $rows->plan_name; ?></td>
                                    <!--<td><?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Deactive </button>'; }?></td>
                                 <td>
                                  <a href="<?php echo base_url();?>advertisement/edit_history_all/<?php echo $rows->id;?>">
                                  <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
                                 <a onclick="confirmGetMessage(<?php echo $ahid;?>)" >
                                 <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a>
                               </td-->


                              </tr>
                             <?php $i++;  }  ?>
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

 $(document).ready(function () {
	   
   	$(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
	
	$('table').DataTable({
         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false
    });
	   
   });

  function confirmGetMessage(ahid)
  {
    var r=confirm("Do you want to delete this?")
    if (r==true) {
    $.ajax({
      url: "<?php echo base_url(); ?>advertisement/delete_history_all",
      type: 'POST',
      data: { advid: ahid },
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

</script>

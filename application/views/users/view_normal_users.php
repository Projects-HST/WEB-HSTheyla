<div class="page-content-wrapper">
    <div class="container">
    <div class="col-12">
      <div class="card m-b-20">

                <h4 class="mt-0 header-title"> View Normal Users List </h4>
                <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Username / Email </th>
                        <th>Full Name</th>

                        <th>Phone</th>

                        <th>City</th>
                        <th>Points</th>
                        <th>Status</th>
                        <th>View </th>
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
                        <td><?php echo $rows->user_name ; ?><br>
                        <?php echo $rows->email_id; ?>
                        </td>
                        <td><?php echo $rows->name ; ?></td>
                        <td><?php echo $rows->mobile_no; ?></td>

                        <td><?php echo $rows->city_name ; ?></td>
                        <td><?php echo $rows->total_points ; ?></td>
                        <td><?php if($sts=='Y'){ echo'<p class="btn btn-secondary btn-success btn-sm"> Active </p>'; }else{ echo'<p class="btn btn-secondary btn-primary btn-sm"> Deactive </p>'; }?></td>
                        <td>
                          <a href="<?php echo base_url();?>users/edit_noraml_users/<?php echo $rows->id;?>">
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
  $('table.display').DataTable();
});
</script>

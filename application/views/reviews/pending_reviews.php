<style>
td{
  width: 100px;
}
</style>

    <div class="page-content-wrapper ">
        <div class="container">

           <?php if($this->session->flashdata('msg')): ?>
                          <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                          </div>
                        <?php endif; ?>

            <div class="row">
              <div class="col-md-12">
                <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Rating</th>
                    <th>Event Comments</th>
                    <th>Action</th>
                </tr>
                </thead>
            <tbody>
          <?php if(!empty($views)) { foreach ($views as $value) {  ?>
            <tr>
                <td><?php echo $value->event_name;?> </td>
                <td><?php echo $value->event_rating; ?></td>
                <td><?php echo $value->comments;?></td>

               <td><a href="<?php echo base_url(); ?>reviews/display/<?php echo $value->id; ?>/Y/<?php echo $value->event_id; ?>/<?php echo $value->user_id; ?>" class="btn btn-primary waves-effect waves-light">
                   Display </a> <a href="<?php echo base_url(); ?>reviews/archive/<?php echo $value->id; ?>/A/<?php echo $value->event_id; ?>/<?php echo $value->user_id; ?>" class="btn btn-primary waves-effect waves-light">
             Archive</a>  </td>
            </tr>
              <?php } }else{ echo "<p class=card-text> No Reviews Found </p>";}?>
            </tbody>
        </table>
              </div>
            </div>


         <!-- <?php if(!empty($views)) { foreach ($views as $value) {  ?> -->
         <!-- <div class="row">

            <div class="col-md-10">
                <div class="card m-b-20 card-block">
                    <h3 class="card-title font-20 mt-0"> <?php echo $value->event_name;?> ( <?php echo $value->event_rating; ?> ) </h3>
                    <p class="card-text">
                     <?php echo $value->comments;?>

                   </p>
                    <div class="form-group row">
                      <div class="col-sm-2">
                        </div>
                      <div class="col-sm-2">
                          <a href="<?php echo base_url(); ?>reviews/display/<?php echo $value->id; ?>/Y/<?php echo $value->event_id; ?>/<?php echo $value->user_id; ?>" class="btn btn-primary waves-effect waves-light">
                          Display </a>
                        </div>
                          <div class="col-sm-2">
                            <a href="<?php echo base_url(); ?>reviews/archive/<?php echo $value->id; ?>/A/<?php echo $value->event_id; ?>/<?php echo $value->user_id; ?>" class="btn btn-primary waves-effect waves-light">
                          Archive</a>
                         </div>
                        </div>
            </div>
            </div>
        </div> -->

        <!-- <?php } }else{ echo "<p class=card-text> No Reviews Found </p>";}?> -->

        </div>
    </div>


</div> <!-- content -->
<script type="text/javascript">
// $(document).ready(function () {
//  $('#myformsection').validate({ //
//   submitHandler: function(formdisplay) {
//     alert("hi");
// //function reviewfunc(){
//  swal({

//         title: "Are you sure?",
//         text: "You Want To Display This Review",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#DD6B55",
//         confirmButtonText: "Yes, Do it",
//         cancelButtonText: "No, cancel",
//         closeOnConfirm: false,
//         closeOnCancel: false
//     },
//     function(isConfirm) {
//         if (isConfirm) {
//          $.ajax({
//                   url: "<?php echo base_url(); ?>reviews/display",
//                   type:'POST',
//                   data: $('#myformsection').serialize(),
//                   success: function(response) {
//                   alert(response);
//                    if(response=="success")
//                     {
//                      //swal("Success!", "Thanks for Your Note!", "success");
//                         $('#myformsection')[0].reset();
//                         swal({
//                            title: "Wow!",
//                            text: "Message!",
//                            type: "success"
//                          },
//            function() {
//                  window.location = "<?php echo base_url(); ?>reviews/home";
//              });
//              }else{
//                     sweetAlert("Oops...", "Something went wrong!", "error");
//                    }
//                  }
//              });
//         }else {
//             swal("Cancelled", "Your imaginary file is safe :)", "error");
//         }
//     });

// }
// });
//    });

$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

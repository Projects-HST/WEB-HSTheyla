

    <div class="page-content-wrapper ">
        <div class="container">
           <?php if($this->session->flashdata('msg')): ?>
             <div class="alert <?php $msg=$this->session->flashdata('msg');
             if($msg=='Added Successfully' || $msg=='Deleted Successfully' || $msg=='updated Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                          </div>
                        <?php endif; ?>
               <?php if(!empty($views)) { foreach ($views as $value) { } } ?>

                 <h4 class="mt-0 header-title"><?php echo $value->event_name;?></h4>
         <?php if(!empty($views)) { foreach ($views as $value) {  ?>
         <div class="row">
            <div class="col-md-10">
                <div class="card m-b-20 card-block">
                    <h3 class="card-title font-20 mt-0">  ( <?php echo $value->event_rating; ?> ) </h3>
                    <p class="card-text">
                     <?php echo $value->comments;?>

                   </p>
                    <div class="form-group row">

                      <div class="col-sm-2">
                           <img src="<?php echo base_url();?>assets/review/images/<?php echo $value->photo; ?>" style="width:80%;border-radius:100px;float: right;">
                        </div>

                        </div>
            </div>
            </div>
        </div>
      <!-- end row -->
        <?php } }else{ echo "<p class=card-text> No Reviews Found </p>";}?>

        </div><!-- container -->
    </div> <!-- Page content Wrapper -->


</div> <!-- content -->
<script type="text/javascript">
  $('#vieweve').addClass("active");
  $('#events').addClass("has_sub active nav-active");
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
</script>

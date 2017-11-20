<!--div class="content-page"> 
<!-Start content ->
<div class="content">
    <!- Top Bar Start ->
  <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <!-li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>
            </li!->
            <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!-a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
            <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a!->
            <a class="dropdown-item" href="<?php echo base_url(); ?>adminlogin/logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
            </div>
            </li>
         </ul>
         <ul class="list-inline menu-left mb-0">
         <li class="list-inline-item">
         <button type="button" class="button-menu-mobile open-left waves-effect">
         <i class="ion-navicon"></i>
         </button>
         </li>
         <li class="hide-phone list-inline-item app-search">
         <h3 class="page-title">View All Reviews</h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
      </div>
    <!-- Top Bar End -->

    <div class="page-content-wrapper ">
        <div class="container">
           <?php if($this->session->flashdata('msg')): ?>
                          <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                          </div>
                        <?php endif; ?> 
         <?php if(!empty($views)) { foreach ($views as $value) {  ?>
         <div class="row">
            <div class="col-md-10">
                <div class="card m-b-20 card-block">
                    <h3 class="card-title font-20 mt-0"> <?php echo $value->event_name;?> ( <?php echo $value->event_rating; ?> ) </h3>
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
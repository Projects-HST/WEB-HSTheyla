<style type="text/css">
   .img-circle {
   width: 90px;
   border-radius: 30px;
   }
</style>
<!-- Start content >
<div class="content-page">
   <div class="content">
      <!- Top Bar Start >
      <div class="topbar">
         <nav class="navbar-custom">
            <ul class="list-inline float-right mb-0">
               <!-li class="list-inline-item dropdown notification-list">
                  <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                  <i class="ion-ios7-bell noti-icon"></i>
                  <span class="badge badge-success noti-icon-badge">3</span>
                  </a>
               </li!->
               <li class="list-inline-item dropdown notification-list">
                  <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
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
                  <h3 class="page-title">Add Category</h3>
               </li>
            </ul>
            <div class="clearfix"></div>
         </nav>
      </div>
      <! Top Bar End -->
      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Add Category </h4>
                        <form method="post" action="<?php echo base_url();?>category/add_category" name="categoryform" enctype="multipart/form-data" id="categoryform">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Category Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="categoryname" id="example-text-input">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Picture</label>
                              <div class="col-sm-6">
                                 <input type="file" id="file_upload" name="categorypic" class="form-control" accept="image/*">
                                 <div id="preview" style="color: red;"></div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Display Order</label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="disp_order">
                                    <?php if(!empty($result)){
                                       foreach($result as $rows) { $lastInc=$rows->order_by; ?>
                                    <option value="<?php echo $rows->order_by;?>"><?php echo $rows->order_by; ?></option>
                                    <?php } ?>
                                    <option value="<?php echo $lastInc+1;?>">
                                       <?php echo $lastInc+1; ?>
                                    </option>
                                    <?php }else{ ?>
                                    <option value="1">1</option>
                                    <?php  } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Status</label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="eventsts">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Submit </button>
                              <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                              Reset
                              </button>
                           </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- end row -->
            <div class="row">
               <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content"></div>
                  </div>
                  <div class="modal-dialog">
                     <div class="modal-content"></div>
                  </div>
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h4 class="modal-title" id="myModalLabel">Update Title</h4>
                           <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true" class="">×   </span><span class="sr-only">Close</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <form method="post" action="" name="categoryform" enctype="multipart/form-data" id="categoryformtitle">
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-sm-4 col-form-label">Category Name</label>
                                 <div class="col-sm-6">
                                    <input type="hidden" name="ct_id" id="ct_id" class="form-control" value="">
                                    <input type="text" name="categoryname" id="ct_name" class="form-control" value="">
                                 </div>
                              </div>
                              <button type="submit" id="save" class="btn btn-primary" style="float:right;">Save changes</button>
                           </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">View All Category</h4>
                        <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button>
                           <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
                                 <th>S.No</th>
                                 <th>Category Name</th>
                                 <th>Category Picture</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach($result as $rows) {
                                 $status=$rows->status;
                                 ?>
                              <tr>
                                 <td>
                                    <?php  echo $i; ?>
                                 </td>
                                 <td id="ct"><a href="" data-toggle="modal" class="open-AddBookDialog" data-target="#myModal" data-id="<?php echo $rows->id; ?>" data-name="<?php echo $rows->category_name; ?>"><?php  echo $rows->category_name; ?></a></td>
                                 <td>
                                    <img src="<?php echo base_url(); ?>assets/category/<?php echo $rows->category_image; ?>" class="img-circle">
                                 </td>
                                 <td>
                                    <?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Deactive </button>'; }?>
                                 </td>
                                 <td><a href="<?php echo base_url();?>category/edit_category/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a></td>
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
      <!-- Page content Wrapper -->
   </div>
   <!-- Top Bar Start -->
</div>
<!-- content -->
<script type="text/javascript">

 // function validate()
 // {
 //   var size=1000000;
 //   var file_size=document.getElementById('file_upload').files[0].size;
 //   //alert(file_size);
 //   if(file_size>=size)
 //   {
 //    alert('Upload image 1MB or Less Than 1MB');
 //    return false;
 //   }
 // }

   $(document).on("click", ".open-AddBookDialog", function() {
   var ct_id = $(this).data('id');
   var cat_name = $(this).data('name');
   $(".modal-body #ct_id").val(ct_id);
   $(".modal-body #ct_name").val(cat_name);
   });

   $(document).ready(function() 
   {
        $('#file_upload').on('change', function()
        {
          var f=this.files[0]
          var actual=f.size||f.fileSize;
          var orgi=actual/1024;
            if(orgi<1024){
              $("#preview").html('');
              //$("#preview").html('<img src="<?php echo base_url(); ?>assets/loader.gif" alt="Uploading...."/>');
              // $("#categoryform").ajaxForm({
              //     target: '#preview'
              // }).submit();
            }else{
              $("#preview").html('File Size Must be  Lesser than 1 MB');
             
              //alert("File Size Must be  Lesser than 1 MB");
              //$("#file_upload").empty();
              return false;

            }
        });
   
      $('#categoryform').validate({ // initialize the plugin 
      rules: {
            categoryname: { required: true },
            categorypic: { required: true },
            eventsts: { required: true },
            disp_order: { required: true }
          },
      messages: {
            categoryname: "Enter Category Name",
            categorypic: "Select Category Picture",
            eventsts: "Select Status",
            disp_order:"Select Display Order"
            },
         });
   });
   
   $('#categoryformtitle').validate({ // initialize the plugin
   rules: {
   categoryname: {required: true},
   },
   messages: {
   categoryname: "Enter Category Name"
   },
   submitHandler: function(form) {
   //alert("hi");
   $.ajax({
   url: "<?php echo base_url(); ?>category/change_category_name",
   type: 'POST',
   data: $('#categoryformtitle').serialize(),
   success: function(response) {
   
   if (response == "success") {
   swal({
   title: "Success",
   text: "Category Name Updated",
   type: "success"
   }).then(function() {
   location.reload();
   });
   } else {
   sweetAlert("Oops...", response, "error");
   }
   }
   });
   }
   });
</script>


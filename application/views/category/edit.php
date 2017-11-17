<style type="text/css">
   .img-circle{
          width: 90px;
         border-radius: 30px;
         margin-top: 10px;
       }
</style>
<!-- Start content -->
<div class="content-page">
<div class="content">
   <!-- Top Bar Start -->
   <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <!--li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>

            </li!-->
            <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!--a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
            <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a!-->
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
         <h3 class="page-title">Edit Category</h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>

      </div>
      <!-- Top Bar End -->
      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"></h4>
                        <?php foreach($edit as $res){ }?>
                        <form  method="post" action="<?php echo base_url();?>category/update_category" name="categoryform" enctype="multipart/form-data" id="categoryform">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Category Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="categoryname" value="<?php echo $res->category_name; ?>" readonly>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Picture</label>
                           <div class="col-sm-6">
                              <input type="file" name="categorypic" id="file_upload" class="form-control" accept="image/*">
                                 <div id="preview" style="color: red;"></div>
                              <input type="hidden" name="currentcpic" class="form-control" value="<?php echo $res->category_image; ?>" >
                              <input type="hidden" name="id" class="form-control" value="<?php echo $res->id; ?>" >
                               <img src="<?php echo base_url(); ?>assets/category/<?php echo $res->category_image; ?>" class="img-circle">
                              </div>
                           </div>
                            <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Display Order</label>
                            <div class="col-sm-6">
                             <input type="hidden" name="old_disp_order" class="form-control" value="<?php echo $res->order_by; ?>">
                                <select class="form-control" name="disp_order">
                                    <?php foreach($result as $rows) { ?>
                                    <option value="<?php echo $rows->order_by; ?>"><?php echo $rows->order_by; ?></option>
                                    <?php } ?>
                                </select>
                                 <script language="JavaScript">document.categoryform.disp_order.value="<?php echo $res->order_by; ?>";</script>
                                  </div>
                                    </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label"> Status</label>
                              <div class="col-sm-6">
                                 <select class="form-control"  name="eventsts">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                 </select>
                                  <script language="JavaScript">document.categoryform.eventsts.value="<?php echo $res->status; ?>";</script>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Update </button>
                           </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
		   <!-- container -->
      </div>
     <!-- Page content Wrapper -->
   </div>
    <!-- Top Bar Start -->
</div>
<!-- content -->
<script type="text/javascript">

  $('#category').addClass("active");
  $('#master').addClass("has_sub active nav-active");

//   function validate()
//  {
//    var size=1000000;
//    var file_size=document.getElementById('file_upload').files[0].size;
//    //alert(file_size);
//    if(file_size>=size)
//    {
//     alert('Upload image 1MB or Less Than 1MB');
//     return false;
//    }
// }

 $(document).ready(function () {

  $('#file_upload').on('change', function()
        {
          var f=this.files[0]
          var actual=f.size||f.fileSize;
          var orgi=actual/1024;
            if(orgi<1024){
              $("#preview").html('');
              //$("#preview").html('<img src="<?php echo base_url(); ?>assets/loader.gif" alt="Uploading...."/>');
              $("#categoryform").ajaxForm({
                  target: '#preview'
              }).submit();
            }else{
              $("#preview").html('File Size Must be  Lesser than 1 MB');
              //alert("File Size Must be  Lesser than 1 MB");
              //$("#file_upload").empty();
              return false;
            }
        });

    $('#categoryform').validate({ // initialize the plugin
       rules: {
         categoryname:{required:true },
         //categorypic:{required:true },
         eventsts:{required:true },
        disp_order: { required: true }

        },
        messages: {
        categoryname:"Enter Category Name",
        //categorypic:"Select Category Picture",
        eventsts:"Select Status",
        disp_order:"Select Display Order"
               },
         });
   });
 </script>

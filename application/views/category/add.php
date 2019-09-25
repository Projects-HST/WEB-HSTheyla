<style type="text/css">
   .img-circle {
   width: 90px;
   border-radius: 30px;
   }
</style>

      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Add Event Category </h4>
                        <form method="post" action="<?php echo base_url();?>category/add_category" name="categoryform" enctype="multipart/form-data" id="categoryform">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Category</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="categoryname" id="example-text-input">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Image</label>
                              <div class="col-sm-6">
                                 <input type="file" id="file_upload" name="categorypic" class="form-control" accept="image/*">
                                 <span style="color: red;">(Size: 73 X 73)</span>
                                 <div id="preview" style="color: red;"></div>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Banner Image</label>
                              <div class="col-sm-6">
                                 <input type="file" id="file_upload" name="category_banner" class="form-control" accept="image/*">
                                 <span style="color: red;">(Size: 73 X 73)</span>
                                 <div id="category_banner" style="color: red;"></div>
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
                                    <option value="">Select status</option>
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-success waves-effect waves-light">
                              Add </button>

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
                              <button type="submit" class="btn btn-primary" style="float:right;">Save changes</button>
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
                        <h4 class="mt-0 header-title">View All  Categories</h4>
                        <?php if($this->session->flashdata('msg')): ?>
                          <div class="alert <?php $msg=$this->session->flashdata('msg');
                          if($msg=='Category added successfully' || $msg=='Changes made are saved'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button>
                           <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
                                 <th>S. No</th>
                                 <th>Category</th>
                                 <th>Image</th>
                                 <th>Banner</th>
                                 <th>Status</th>
                                 <th>Actions</th>
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
                                    <img src="<?php echo base_url(); ?>assets/category/<?php echo $rows->category_banner; ?>" class="img-responsive" style="width:150px;">
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
            categoryname: { required: true },
            categorypic: { required: true },
            category_banner:{required: true},
            eventsts: { required: true },
            disp_order: { required: true }
          },
      messages: {
            categoryname: "Enter category",
            categorypic: "Select image",
            category_banner: "Select image",
            eventsts: "Select status",
            disp_order:"Select display order"
            },
         });
   });

   $('#categoryformtitle').validate({ // initialize the plugin
   rules: {
   categoryname: {required: true},
   },
   messages: {
   categoryname: "Enter category"
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

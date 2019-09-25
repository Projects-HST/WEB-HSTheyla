<style type="text/css">
   .img-circle{
          width: 90px;
         border-radius: 30px;
         margin-top: 10px;
       }
</style>

      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit Category </h4>
                        <?php foreach($edit as $res){ }?>
                        <form  method="post" action="<?php echo base_url();?>category/update_category" name="categoryform" enctype="multipart/form-data" id="categoryform">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Category</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="categoryname" value="<?php echo $res->category_name; ?>" readonly>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Image</label>
                           <div class="col-sm-6">
                              <input type="file" name="categorypic" id="file_upload" class="form-control" accept="image/*">
                                 <div id="preview" style="color: red;"></div>
                              <input type="hidden" name="currentcpic" class="form-control" value="<?php echo $res->category_image; ?>" >
                              <input type="hidden" name="id" class="form-control" value="<?php echo $res->id; ?>" >
                               <img src="<?php echo base_url(); ?>assets/category/<?php echo $res->category_image; ?>" class="img-circle">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Banner</label>
                           <div class="col-sm-6">
                              <input type="file" name="category_banner" id="file_upload" class="form-control" accept="image/*">

                              <input type="hidden" name="category_banner_old" class="form-control" value="<?php echo $res->category_banner; ?>" >

                               <img src="<?php echo base_url(); ?>assets/category/<?php echo $res->category_banner; ?>" class="img-circle">
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
                                    <option value="">Select status</option>
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                 </select>
                                  <script language="JavaScript">document.categoryform.eventsts.value="<?php echo $res->status; ?>";</script>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-success waves-effect waves-light">
                              Save </button>
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
        categoryname:"Enter category",
        //categorypic:"Select Category Picture",
        eventsts:"Select status",
        disp_order:"Select display order"
               },
         });
   });
 </script>


      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-9">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit Notification </h4>
                        <?php foreach($edit as $res){ }?>
        <form  method="post" enctype="multipart/form-data" action="<?php echo base_url();?>emailtemplate/update_template" name="templateform" id="templateform">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Title</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="templatename" maxlength="30" id="example-text-input"  value="<?php echo $res->template_name;?>">
                                  <input class="form-control" type="hidden" name="tid"   value="<?php echo $res->id;?>">
                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Message</label>
                              <div class="col-sm-8">
                                  <textarea class="form-control" rows="5" name="templatecontent" maxlength="240" placeholder="Max 240 Characters"><?php echo $res->template_content;?></textarea>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Change Image(optional)</label>
                              <div class="col-sm-6">
                                   <input class="form-control" type="file" name="notification_img"  id="notification_img" >
                              </div>
                              <div class="col-sm-2">
                                <?php if(empty($res->notification_img)){

                                }else{ ?>
                                  <input class="form-control" type="hidden" name="old_notification_img" maxlength="30" id="old_notification_img" value="<?php echo $res->notification_img;  ?>">
                                  <img src="<?php echo base_url(); ?>assets/notification/images/<?php  echo $res->notification_img; ?>" style="width:100px;">
                             <?php   } ?>

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
  $('#newsletter').addClass("active");
  $('#email').addClass("has_sub active nav-active");
 $(document).ready(function () {
    $('#templateform').validate({ // initialize the plugin
       rules: {
         templatename:{required:true },
          notification_img:{required:false,extension: "jpg|JPG|jpeg|png" },
         templatecontent:{required:true }
        },
        messages: {
        templatename:"Enter title",
        templatecontent:"What do you want to convey?",
          notification_img:{extension: "Upload only PNG or  JPEG" },
         },
         });
   });



</script>

      <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Add Template </h4>

                        <form  method="post" enctype="multipart/form-data" action="<?php echo base_url();?>emailtemplate/add_template" name="templateform" id="templateform">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">Template Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="templatename" maxlength="30" id="example-text-input" placeholder="Title">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Template Content</label>
                              <div class="col-sm-8">
                                  <textarea class="form-control" rows="5" name="templatecontent" maxlength="240" placeholder="Max 240 Characters"></textarea>
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
                     </form>
                  </div>
               </div>
            </div>
          </div>
            <!-- end row -->
            <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">View All Templates</h4>

                           <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
							                 <th>S.No</th>
                               <th style="width:200px;">Title</th>
                                <th>Message</th>
                               <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
						          <?php
                                $i=1;
                                foreach($view as $rows) { ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->template_name; ?></td>
                                 <td><?php  echo $rows->template_content; ?></td>
								                 <td>
                                    <a href="<?php echo base_url();?>emailtemplate/edit_template/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
                                     <!--a href="<?php echo base_url();?>emailtemplate/delete_template/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/delete.png" /></a-->
                                 </td>
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
 $(document).ready(function () {
    $('#templateform').validate({ // initialize the plugin
       rules: {
         templatename:{required:true },
         templatecontent:{required:true }
        },
        messages: {
        templatename:"Enter Template Name",
        templatecontent:"Enter Template Details"
         },
         });
   });



</script>

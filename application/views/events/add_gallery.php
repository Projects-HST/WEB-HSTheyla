<style type="text/css">
   .img-circle{
          width: 100px;

       }
</style>

<div class="page-content-wrapper ">

<div class="container">

<div class="row">
<div class="col-12">
<div class="card m-b-20">
    <div class="card-block">
        <h4 class="mt-0 header-title"> Gallery</h4>
        <div class="m-b-30">
           <form  method="post" action="<?php echo base_url();?>events/add_gallery" name="eventpicform" id="eventpicform" enctype="multipart/form-data">
               <label>Event: &nbsp;<span style="color: #28c2dc;">  <?php foreach($eventname as $rows){ echo $rows->event_name;}?>  </span></label>
              <div class="form-group row">

                 <div class="col-sm-4">
                  <input type="file" name="eventpicture[]" class="form-control" accept="image/*"  multiple="">
                  <input type="hidden" name="eventid" class="form-control" value="<?php echo $evnid;?>"><span style="color:#F00;">(985*550px)</span>
                 </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-4">
                      <button type="submit" class="btn btn-success waves-effect waves-light">Upload</button>
                  </div>
             </div>
            </form>
        </div>

    </div>
    </div>
</div> <!-- end col -->
  </div> <!-- end row -->

           <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">View Gallery</h4>

                           <?php if($this->session->flashdata('msg')): ?>
                             <div class="alert <?php $msg=$this->session->flashdata('msg');
                             if($msg=='Image uploaded successfully' || $msg=='Image deleted'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                        <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
                                  <th>S. No</th>
                                 <th>Event Name</th>
                                 <th>Image</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                             <?php
                                $i=1;
                                foreach($view_pic as $rows) {
                                ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->event_name; ?></td>
                                 <td>
                                    <img src="<?php echo base_url(); ?>assets/events/gallery/<?php echo $rows->event_image; ?>" class="img-circle">
                                 </td>
                                 <td> <a href="<?php echo base_url();?>events/delete_events_img/<?php echo $rows->id;?>/<?php echo $rows->eventid;?>">
                              <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a></td>
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

</div><!-- container -->
</div> <!-- Page content Wrapper -->


</div> <!-- content -->
<script type="text/javascript">

  $('#vieweve').addClass("active");
  $('#events').addClass("has_sub active nav-active");

 $(document).ready(function () {

	$(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
	
	$('table').DataTable({
         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false,
		"bFilter": false
    });
	
    $('#eventpicform').validate({ // initialize the plugin
       rules: {
          eventid:{required:true },
         'eventpicture[]':{required:true }
        },
        messages: {
         eventid:"Enter Event Id",
        'eventpicture[]':"Select picture"
               },
         });
   });

</script>

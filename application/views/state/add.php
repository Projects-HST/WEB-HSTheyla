
      <div class="page-content-wrapper">
         <div class="container">

            <div class="row">
               <div class="col-lg-8">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Add State </h4>

                        <form class="" method="post" action="<?php echo base_url();?>state/add_state" id="stateform" name="stateform">

                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Country <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="countryid"  >
                                     <option value="">Select Country </option>
                                     <?php foreach($countyr_list as $cntry){ ?>
                                          <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                 </select>
                              </div>
                           </div>

                            <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">State Name <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <input class="form-control"   type="text" name="statename" id="example-text-input" maxlength="50">
                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Status <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <select class="form-control"  name="eventsts">
                                    <option value="">Select Status</option>
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
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">View All State</h4>

                           <?php if($this->session->flashdata('msg')): ?>
                          <div class="alert <?php $msg=$this->session->flashdata('msg');
                          if($msg=='State added successfully' || $msg=='Changes made are saved'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                          </div>
                        <?php endif; ?>

                        <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
							            <th>S. No</th>
                                 <th>Country </th>
                                 <th>State </th>
                                 <th> Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
						        <?php
                                $i=1;
                                foreach($result as $rows) {
									     $status=$rows->event_status;
                                ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->country_name; ?></td>
                                  <td><?php  echo $rows->state_name; ?></td>
                                 <td><?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Deactive </button>'; }?></td>
								         <td><a href="<?php echo base_url();?>state/edit_state/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a></td>
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

	$(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
	
	$('table').DataTable({
         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false
    });
	
    $('#stateform').validate({ // initialize the plugin
       rules: {
         countryid:{required:true },
         statename:{required:true },
         eventsts:{required:true }

        },
        messages: {
        countryid:"Select Country ",
        statename:"Enter State",
        eventsts:"Select Status"
               },
         });
   });

 // function getstatename(cid) {
 //           alert(cid);
 //            $.ajax({
 //               type: 'post',
 //               url: '<?php echo base_url(); ?>state/get_sate_name',
 //               data: {
 //                   country_id:cid
 //               },
 //              dataType: 'json',
 //               success: function(test1) {
 //   				alert(test1.status);
 //                if (test1.status=='Success') {
 //                       var sid = test1.stateid;
 //   					     //alert(sub.length);
 //                       var sname = test1.statename;
 //                       var len=sid.length;
 //   					     //alert(len);
 //                       var i;
 //                       var statename = '';
 //                       for (i = 0; i < len; i++) {
 //   						'<form name="exam" id="examvalidate">';
 //                           statename += '<option value="' + sid[i] + '">' + sname[i] + '</option>';
 //   						'</form>';

 //                           $("#state").html(statename);
 //                           $('#msg').html('');
 //                       }
 //                   } else {
 //   					    $('#msg').html('<span style="color:red;text-align:center;">State Not Found</p>');
 //   					    $("#ajaxres").html('');
 //                   }
 //               }
 //           });
 //       }
</script>

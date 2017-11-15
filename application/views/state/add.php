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
            </li-->
            <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!--a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
            <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a-->
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
         <h3 class="page-title">Add Country</h3>
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
                       
                        <form class="" method="post" action="<?php echo base_url();?>state/add_state" id="stateform" name="stateform">
                            
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Country Name</label>
                              <div class="col-sm-6">
                                 <select class="form-control" name="countryid"  >
                                     <option value="">Select Country Name</option>
                                     <?php foreach($countyr_list as $cntry){ ?>
                                          <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                 </select>
                              </div>
                           </div> 

                            <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">State Name</label>
                              <div class="col-sm-6">
                                 <input class="form-control"   type="text" name="statename" id="example-text-input">
                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Event Status</label>
                              <div class="col-sm-6">
                                 <select class="form-control"  name="eventsts">
                                    <option value="">Select Event Status</option>
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
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">View All State</h4>
                        
                           <?php if($this->session->flashdata('msg')): ?>
                          <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                          </div>
                        <?php endif; ?>

                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
							            <th>S.NO</th>
                                 <th>Country Name</th>
                                 <th>State Name</th>
                                 <th>Event Status</th>
                                 <th>Action</th>
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
    $('#stateform').validate({ // initialize the plugin
       rules: {
         countryid:{required:true },
         statename:{required:true },
         eventsts:{required:true }
        
        },
        messages: {
        countryid:"Select Country Name",
        statename:"Enter State Name",
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
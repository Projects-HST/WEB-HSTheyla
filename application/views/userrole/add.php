<!-- Start content -->
<div class="content-page">
<div class="content">
   <!-- Top Bar Start -->
   <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>
            </li>
            <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
            <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
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
         <h3 class="page-title">Add Users</h3>
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
                       
                        <form class="" method="post" action="<?php echo base_url();?>userrole/add_users" id="usersform" name="usersform">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-4 col-form-label">User Name</label>
                              <div class="col-sm-6">
                            <input class="form-control" type="text"  name="username" onkeyup="checknamefun(this.value)">
                            <div id="umsg" style="color:red;"></div>
                              </div>
                           </div>
                           <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status</label>
                              <div class="col-sm-6">
                                 <select class="form-control"  name="usersts">
                                    <option value="">Select  Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group">
                             <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" id="save" class="btn btn-primary waves-effect waves-light">
                              Submit </button>
                              <button type="reset" id="save"  class="btn btn-secondary waves-effect m-l-5">
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
                        <h4 class="mt-0 header-title">View All Users</h4>
                        
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
                                 <th>User Name</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
						    <?php
                                $i=1;
                                foreach($result as $rows) {
									                  $status=$rows->status;
                                    $uid=$rows->id;
                                ?>
                              <tr>
                                  <td><?php  echo $i; ?></td>
                                  <td><?php  echo $rows->user_role_name; ?></td>
                                  <td>
                                    <?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Deactive </button>'; }?></td>
								                  <td>
                                    <a href="<?php echo base_url();?>userrole/edit_users/<?php echo $rows->id;?>"><img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
                                    <?php if($uid!=1){ ?>
                         <a onclick="confirmGetMessage(<?php echo $uid;?>)" >   
                           <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a>
                                <?php } ?>
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
  function confirmGetMessage(uid)
  {
     var r=confirm("Do you want to delete this?")
    if (r==true) {
   //alert(uid);
    $.ajax({
      url: "<?php echo base_url(); ?>userrole/delete_users",
      type: 'POST',
      data: { userid: uid },
      success: function(response) {
      //alert(response);exit;
          if (response == "success") {
              swal({
                  title: "Success",
                  text: "Deleted Successfully",
                  type: "success"
              }).then(function() { 
                  location.href = '<?php echo base_url(); ?>userrole/home';
              });
          } else {
              sweetAlert("Oops...", response, "error");
          }
      }
    });
    }else{
           swal("Cancelled", "Process Cancel :)", "error");
       }
  }

 $(document).ready(function () {

    $('#usersform').validate({ // initialize the plugin
       rules: {
         username:{required:true },
         //categorypic:{required:true },
         usersts:{required:true }
        
        },
        messages: {
        username:"Enter User Name",
        //categorypic:"Select Category Picture",
        usersts:"Select Status"
               },
         }); 
   });

 function checknamefun(val)
 {
   $.ajax({
     type:'post',
     url:'<?php echo base_url(); ?>/userrole/checker',
     data:'uname='+val,
     success:function(test)
      { //alert(test);
        if(test=="Username already Exit")
          {
             $("#umsg").html(test);
             $("#save").hide();
          }else{
             $("#umsg").html(test);
             $("#save").show();
          }
      }
   });
 }
 </script>

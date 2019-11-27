<style>
.label-value{
  font-size: 18px;
}
</style>

   <div class="page-content-wrapper ">
     <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">

                 <h4 class="mt-0 header-title"> Heyla User Details </h4>

                  <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert <?php $msg=$this->session->flashdata('msg');
                    if($msg=='Added Successfully' || $msg=='Updated Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>


                <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>users/update_user_login_status" name="usersform" id="usersform" onSubmit='return check();'>
<?php foreach($users_view AS $res){ } ?>
<input type="hidden" name="user_id" value="<?php echo $res->user_id; ?>">
<div class="row">
    <div class="col-md-3 bor"><p class="txt_label">Username</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->user_name; ?></p></div>
    <div class="col-md-3 bor"><p class="txt_label">Role</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->user_role_name; ?></p></div>
    <div class="col-md-3 bor"><p class="txt_label">Full Name</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->name; ?></p></div>
    <div class="col-md-3 bor"><p class="txt_label">Mobile Number</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->mobile_no;?></p></div>

    <div class="col-md-3 bor"><p class="txt_label">DOB</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->birthdate; ?></p></div>
    <div class="col-md-3 bor"><p class="txt_label">Gender</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->gender;?></p></div>

    <div class="col-md-3 bor"><p class="txt_label">Newsletter Subscription</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->newsletter_status; ?></p></div>
    <div class="col-md-3 bor"><p class="txt_label">Referal Code</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->referal_code;?></p></div>

    <div class="col-md-3 bor"><p class="txt_label">Email ID</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->email_id;?></p></div>
    <div class="col-md-3 bor"><p class="txt_label">Location</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->city_name;?></p></div>
    <div class="col-md-3 bor"><p class="txt_label">Last login</p></div>
    <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->last_login;?></p></div>
    <div class="col-md-3 bor"><p class="txt_label">Login Status</p></div>
    <div class="col-md-3 bor"><p class="txt_value">
      <select class="form-control"  name="login_status" id="login_status">
           <option value="Y">Enable</option>
           <option value="N">Disable</option>
       </select>
       <script>$('#login_status').val('<?php echo $res->status; ?>');</script>
     </p></div>

</div>
<br>
<div class="text-right">
      <button type="submit" id="save" class="btn btn-success waves-effect waves-light">
  Save
    </button>

</div>















                     </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
      </div><!-- container -->
   </div>
   <!-- Page content Wrapper -->
</div>
<!-- content -->

<script type="text/javascript">

  $('#normaluser').addClass("active");
  $('#users').addClass("has_sub active nav-active");

 $('#ctname').prop('disabled', 'disabled');
 $('#country_id').prop('disabled', 'disabled');
 $('#staname').prop('disabled', 'disabled');
 $('#gender').prop('disabled', 'disabled');


   $(document).ready(function () {

     $('#usersform').validate({
        rules: {
          username:{required:true,
            remote: {
                   url: "<?php echo base_url(); ?>users/username_checker_exist/<?php echo $res->id ?>",
                   type: "post"
                }
          },
          name:{required:true},
          mobile:{required:true,
            remote: {
                   url: "<?php echo base_url(); ?>users/mobile_checker_exist/<?php echo $res->id ?>",
                   type: "post"
                }
          },
          email:{required:true,
            remote: {
                   url: "<?php echo base_url(); ?>users/mail_checker_exist/<?php echo $res->id ?>",
                   type: "post"
                }
          },
          pwd:{required:true },
          dob:{required:true },
          gender:{required:true },
          occupation:{required:true },
          address1:{required:true },
          country:{required:true },
          statename:{required:true },
          city:{required:true },
          zip:{required:true },
          //user_picture:{required:true },
          status:{required:true },
          userrole:{required:true},
          display_status:{required:true}
         },

         messages: {
         username: { required:"Enter the Username ",remote:"Username Already Exists" },
         name:"Enter Name",
         mobile: { required:"Enter the Mobile Number ",remote:"Mobile Number Already Exists" },
         email: { required:"Enter the Email ",remote:"Email Already Exists" },
         pwd:"Enter Password",
         dob:"Select DOB",
         gender:"Select Gender",
         occupation:"Enter Occupation",
         address1:"Enter Address1",
         country:"Select Country Name",
         statename:"Select State Name",
         city:"Select City Name",
         zip:"Enter Zip",
         status:"Select Status",
         userrole:"Select User Role",
         display_status:"Select Display Status"
               },
          });
    });






</script>
<style>
.txt_label{
  margin-top: 0px;
  margin-bottom: 0px;
}
.txt_value{
  color: #f71010;
  font-size: 15px;
  font-weight: 600;
}
.bor{
  border: 1px solid #000;
  padding-top: 10px;
}
</style>

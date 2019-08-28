<div class="page-content-wrapper ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit Profile </h4>
                        <?php if($this->session->flashdata('msg')): ?>
                            <div class="alert <?php $msg=$this->session->flashdata('msg');
                            if($msg=='Added Successfully' || $msg=='Updated Successfully'){ echo " alert-success "; }else{ echo "alert-danger "; } ?>">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×</button>
                                <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            <?php endif; ?>
                            <?php  foreach($res as $rows) {} ?>
                                <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>users/update_user_details" name="usersform" id="usersform">
                                    <div class="form-group row">
                                        <label for="Category" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="ufun" name="username" value="<?php  echo $rows->user_name; ?>">
                                              <input class="form-control" type="hidden" name="user_id" value="<?php echo $rows->user_id; ?>">
                                              <input type="hidden" name="old_picture" class="form-control" value="<?php echo $rows->user_picture; ?>" >

                                        </div>
                                        <label for="Category" class="col-sm-2 col-form-label">Full Name</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="name" value="<?php  echo $rows->name; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Name" class="col-sm-2 col-form-label">Mobile Number</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="mobile" id="mfun" value="<?php  echo $rows->mobile_no; ?>">

                                        </div>
                                        <label for="Name" class="col-sm-2 col-form-label">Email ID</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="efun" name="email"  value="<?php  echo $rows->email_id; ?>">

                                        </div>

                                    </div>


                                    <div class="form-group row">
                                        <label for="ecost" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-4">
                                            <textarea id="textarea" name="address1" class="form-control" maxlength="100" rows="3"><?php  echo $rows->address_line1; ?></textarea>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Profile Picture</label>
                                        <div class="col-sm-4">
                                            <input type="file" name="user_picture" class="form-control" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Status" class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="display_status" id="display_status">
                                                <option value="">Select Status</option>
                                                <option value="Y">Active</option>
                                                <option value="N">Inactive</option>
                                            </select>
                                            <script>$('#display_status').val('<?php echo $rows->status; ?>');</script>
                                        </div>
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-4">
                                          <img src="<?php  echo base_url(); ?>assets/users/<?php echo $rows->user_picture; ?>" class="img-circle" style="width:100px;height:100px;border-radius:50px;">
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-2">
                                            <button type="submit" id="save" class="btn btn-success waves-effect waves-light">
                                                Save </button>
                                        </div>

                                    </div>
                                </form>
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
<!-- content -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#usersform').validate({
            rules: {
                username: {
                    required: true,
                    remote: {
                        url: "<?php echo base_url(); ?>users/username_checker_exist/<?php echo $rows->id ?>",
                        type: "post"
                    }
                },
                name: {
                    required: true
                },
                mobile: {
                    required: true,
                    remote: {
                       url: "<?php echo base_url(); ?>users/mobile_checker_exist/<?php echo $rows->id ?>",
                        type: "post"
                    }
                },
                email: {
                    required: true,
                    remote: {
                       url: "<?php echo base_url(); ?>users/mail_checker_exist/<?php echo $rows->id ?>",
                        type: "post"
                    }
                },
                pwd: {
                    required: true
                },
                dob: {
                    required: true
                },
                gender: {
                    required: true
                },
                occupation: {
                    required: true
                },
                address1: {
                    required: true
                },
                country: {
                    required: true
                },
                statename: {
                    required: true
                },
                city: {
                    required: true
                },
                zip: {
                    required: true
                },
                //user_picture:{required:true },
                status: {
                    required: true
                },
                userrole: {
                    required: true
                },
                display_status: {
                    required: true
                }
            },

            messages: {
                username: {
                    required: "This field cannot be empty!",
                    remote: "Username already exists!"
                },
                name: "This field cannot be empty!",
                mobile: {
                    required: "This field cannot be empty!",
                    remote: "Mobile number already exists!"
                },
                email: {
                    required: "This field cannot be empty!",
                    remote: "Email already exists!"
                },
                pwd: "Enter Password",
                dob: "Select DOB",
                gender: "Select Gender",
                occupation: "Enter Occupation",
                address1: "This field cannot be empty!",
                country: "Select Country Name",
                statename: "Select State Name",
                city: "Select City Name",
                zip: "Enter Zip",
                status: "Select Status",
                userrole: "Select User Role",
                display_status: "Select status"
            },
        });
    });
</script>

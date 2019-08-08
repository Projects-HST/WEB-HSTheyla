<div class="page-content-wrapper ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">
                        <h4 class="mt-0 header-title"> Add Users Details </h4>
                        <?php if($this->session->flashdata('msg')): ?>
                            <div class="alert <?php $msg=$this->session->flashdata('msg');
                            if($msg=='Added Successfully' || $msg=='Updated Successfully'){ echo " alert-success "; }else{ echo "alert-danger "; } ?>">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                    ×</button>
                                <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            <?php endif; ?>
                                <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>users/add_user_details" name="usersform" id="usersform" onSubmit='return check();'>
                                    <div class="form-group row">
                                        <label for="Category" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="ufun" name="username">

                                        </div>
                                        <label for="Category" class="col-sm-2 col-form-label">Full Name</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Name" class="col-sm-2 col-form-label">Mobile Number</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" name="mobile" id="mfun">

                                        </div>
                                        <label for="Name" class="col-sm-2 col-form-label">Email Id</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="text" id="efun" name="email">

                                        </div>

                                    </div>


                                    <div class="form-group row">
                                        <label for="ecost" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-4">
                                            <textarea id="textarea" name="address1" class="form-control" maxlength="100" rows="3"></textarea>
                                        </div>
                                        <label class="col-sm-2 col-form-label">User Picture</label>
                                        <div class="col-sm-4">
                                            <input type="file" name="user_picture" class="form-control" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Status" class="col-sm-2 col-form-label">Display Status</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="display_status">
                                                <option value="">Select Status</option>
                                                <option value="Y">Yes</option>
                                                <option value="N">No</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-2">
                                            <button type="submit" id="save" class="btn btn-primary waves-effect waves-light">
                                                Submit </button>
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
                        url: "<?php echo base_url(); ?>users/username_checker",
                        type: "post"
                    }
                },
                name: {
                    required: true
                },
                mobile: {
                    required: true,
                    remote: {
                        url: "<?php echo base_url(); ?>users/mobile_checker",
                        type: "post"
                    }
                },
                email: {
                    required: true,
                    remote: {
                        url: "<?php echo base_url(); ?>users/mail_checker",
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
                    required: "Enter the Username ",
                    remote: "Username Already Exists"
                },
                name: "Enter Name",
                mobile: {
                    required: "Enter the Mobile Number ",
                    remote: "Mobile Number Already Exists"
                },
                email: {
                    required: "Enter the Email ",
                    remote: "Email Already Exists"
                },
                pwd: "Enter Password",
                dob: "Select DOB",
                gender: "Select Gender",
                occupation: "Enter Occupation",
                address1: "Enter Address",
                country: "Select Country Name",
                statename: "Select State Name",
                city: "Select City Name",
                zip: "Enter Zip",
                status: "Select Status",
                userrole: "Select User Role",
                display_status: "Select Display Status"
            },
        });
    });
</script>

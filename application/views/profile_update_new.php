<div id="page-wrapper">
    <div class="container">

        <div class="row well mobile_leaderboard" id="main" >
            <div class="col-sm-12 col-md-12 " id="content">
                <h3 class="dashboard_tab"> Profile Update</h3>
            </div>

                <?php  foreach($res as $rows){} ?>
            <div class="col-md-12 profile_tab">
              <div class="card-block">
                  <form class="form" role="form" autocomplete="off" method="post" action="" id="profile_form">
                      <div class="form-group row">
                          <label class="col-md-3 col-form-label form-control-label">Name</label>
                          <div class="col-md-4">
                              <input class="form-control" type="text" name="first_name" value="<?php echo $rows->name; ?>">
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="col-md-3 col-form-label form-control-label">Username</label>
                          <div class="col-md-4">
                              <input class="form-control" type="text" name="user_name" value="<?php echo $rows->user_name; ?>">
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="col-md-3 col-form-label form-control-label">Email</label>
                          <div class="col-md-4">
                            <p>  <?php echo $rows->email_id;  if($rows->email_verify=='N'){ ?><i class="fas fa-exclamation-triangle notverfied" title="Email is Not Verified"></i>

                          <?php  }else{  } ?> <span class="change-email"><a href="<?php echo  base_url(); ?>changemail">Change My Email</a></span></p>
                          </div>
                      </div>
                          <div class="form-group row">
                              <label class="col-md-3 col-form-label form-control-label">Gender</label>
                              <div class="col-md-4">
                                <label class="custom-control custom-radio">
                                  <input id="radio1" name="gender" type="radio" class="custom-control-input" value="Male" <?php echo ($rows->gender=='Male')?'checked':'' ?>>
                                  <span class="custom-control-indicator"></span>
                                  <span class="custom-control-description">Male</span>
                                </label>
                                <label class="custom-control custom-radio">
                                  <input id="radio2" name="gender" type="radio" class="custom-control-input" value="Female" <?php echo ($rows->gender=='Female')?'checked':'' ?>>
                                  <span class="custom-control-indicator"></span>
                                  <span class="custom-control-description">Female</span>
                                </label>
                              </div>
                            </div>
                      <div class="form-group row">
                          <label class="col-md-3 col-form-label form-control-label">Mobile number</label>
                          <div class="col-md-4">
                            <p>  <?php if(empty($rows->mobile_no)){ echo $rows->mobile_no; ?>
                                <span class="change-email"><a href="<?php echo  base_url(); ?>mobile">Add Mobile number</a></span></p>
                          <?php  }else{ echo $rows->mobile_no; ?>
                              <span class="change-email"><a href="<?php echo  base_url(); ?>mobilenumber">Change Mobile number</a></span></p>
                          <?php   } ?>
                          <!-- <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="<?php echo $rows->mobile_no; ?>"> -->


                          </div>
                      </div>
                      <input class="form-control" type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>">

                      <div class="form-group row">
                          <label class="col-md-3 col-form-label form-control-label">Address</label>
                          <div class="col-md-4">
                            <textarea class="textarea form-control textarea-form" name="address"><?php echo $rows->address_line1; ?></textarea>
                              </div>
                      </div>


                      <div class="form-group row">
                          <label class="col-md-3 col-form-label form-control-label">Occupation</label>
                          <div class="col-md-4">
                            <input class="form-control" type="text" name="occupation" value="<?php echo $rows->occupation; ?>">

                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-md-3 col-form-label form-control-label">Subscribe  Newsletter</label>
                          <div class="col-md-4">



                              <label class="custom-control custom-radio">
                                <input id="radio1" name="newsletter_status" type="radio" class="custom-control-input" value="Y" <?php echo ($rows->newsletter_status=='Y')?'checked':'' ?>>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Yes</span>
                              </label>
                              <label class="custom-control custom-radio">
                                <input id="radio2" name="newsletter_status" type="radio" class="custom-control-input" value="N" <?php echo ($rows->newsletter_status=='N')?'checked':'' ?>>
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">No</span>
                              </label>
                          </div>
                        </div>
                      <div class="form-group row">
                          <label class="col-md-3 col-form-label form-control-label"></label>
                          <div class="col-md-4">
                              <input type="reset" class="btn btn-secondary" value="Cancel">
                              <input type="submit" class="btn btn-primary" value="Save Changes">
                          </div>
                      </div>
                  </form>
              </div>
            </div>

        </div>

    </div>

</div>
<script>
$('#profile_form').validate({ // initialize the plugin
    rules: {
        // mobile_no: {
        //   required: true,
        //   remote: {
        //          url: "<?php echo base_url(); ?>home/check_mobile/<?php echo $this->session->userdata('id'); ?>",
        //          type: "post"
        //       }
        // },
        user_name:{
          required: true,minlength: 6, maxlength: 12,
          remote: {
                 url: "<?php echo base_url(); ?>home/check_username/<?php echo $this->session->userdata('id'); ?>",
                 type: "post"
              }
        },
        name: {
            required: true
        },
        gender: {
            required: true
        },
        address: {
            required: true
        },
    },
    messages: {
        user_name: {
                        minlength:"Minimum 6 Characters",
                        maxlength:"Maximum 12 characters",
                       required: "Please enter your username",
                       user_name: "Please enter a username",
                       remote: "Username already in use!"
                   },
         mobile_no: {
                        required: "Please enter your username",
                        mobile_no: "Please enter a username",
                        remote: "Mobile number already in exist!"
                    },

        name: "Enter Name",
          gender: "Select Gender",
        address: "Enter Address "
    },
    submitHandler: function(form) {
        //alert("hi");
        $.ajax({
            url: "<?php echo base_url(); ?>home/save_profile",
            type: 'POST',
            data: $('#profile_form').serialize(),

            success: function(response) {
                if (response == "success") {
                    swal({
                        title: "success",
                        text: " Profile Saved.",
                        type: "success"
                    }).then(function() {
                       location.reload();
                    });
                } else {
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }
});
</script>

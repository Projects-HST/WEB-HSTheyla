<div class="container-fluid page-bg">
<div class="">
<div class="row header-title leaderboard-bg">
  <div class="col-md-12">
  <div class="container">
      <p class="leader-title">Heyla is an everything-for-everybody App – Start Exploring Straightaway.</p>
      </div>
  </div>
</div>

<section class="container">
  <div class="leaderboard-menu-tab">
        <div class="row row-offcanvas row-offcanvas-right">
          <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
              <a href="<?php echo base_url(); ?>leaderboard" class="list-group-item "><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="<?php echo base_url(); ?>profile" class="list-group-item active"><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
                <a href="<?php echo base_url(); ?>profile_picture" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Display Picture</a>
               <?php $user_role = $this->session->userdata('user_role');
                if($user_role=='2'){ ?>
                    <a href="<?php echo base_url(); ?>createevent" class="list-group-item"><span class="menu-icons"><i class="far fa-plus-square"></i></span>Create event </a>
                    <a href="<?php echo base_url(); ?>viewevents" class="list-group-item"><span class="menu-icons"><i class="fas fa-table"></i></span>View events </a>
                    <a href="<?php echo base_url(); ?>bookedevents" class="list-group-item"><span class="menu-icons"><i class="far fa-list-alt"></i></i></span>Booked Events </a>
                    <a href="<?php echo base_url(); ?>reviewevents" class="list-group-item"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <?php } ?>
              <a href="<?php echo base_url(); ?>booking_history" class="list-group-item"><span class="menu-icons"><i class="fas fa-book"></i></span>Booking history</a>
              <a href="<?php echo base_url(); ?>wishlist" class="list-group-item"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="<?php echo base_url(); ?>logout" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
            <div class="">
              <div class="card-header">
                             <h3 class="mb-0">User Information</h3>
                         </div>
                <!-- form user info -->
                  <?php  foreach($res as $rows){} ?>
                  <div class="card card-outline-secondary">

                      <div class="card-block">
                          <form class="form" role="form" autocomplete="off" method="post" action="" id="profile_form">
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="text" name="first_name" value="<?php echo $rows->name; ?>">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="text" name="user_name" value="<?php echo $rows->user_name; ?>">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                  <div class="col-lg-9">
                                    <p>  <?php echo $rows->email_id;  if($rows->email_verify=='N'){ ?><i class="fas fa-exclamation-triangle notverfied" title="Email is Not Verified"></i>

                                  <?php  }else{  } ?> <span class="change-email"><a href="<?php echo  base_url(); ?>changemail">Change My Email</a></span></p>
                                  </div>
                              </div>
                                  <div class="form-group row">
                                      <label class="col-lg-3 col-form-label form-control-label">Gender</label>
                                      <div class="col-lg-9">
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
                                  <label class="col-lg-3 col-form-label form-control-label">Mobile number</label>
                                  <div class="col-lg-9">
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
                                  <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                  <div class="col-lg-9">
                                    <textarea class="textarea form-control textarea-form" name="address"><?php echo $rows->address_line1; ?></textarea>
                                      </div>
                              </div>


                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Occupation</label>
                                  <div class="col-lg-9">
                                    <input class="form-control" type="text" name="occupation" value="<?php echo $rows->occupation; ?>">

                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Subscribe  Newsletter</label>
                                  <div class="col-lg-9">



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
                                  <label class="col-lg-3 col-form-label form-control-label"></label>
                                  <div class="col-lg-9">
                                      <input type="reset" class="btn btn-secondary" value="Cancel">
                                      <input type="submit" class="btn btn-primary" value="Save Changes">
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                  <!-- /form user info -->

            </div>
          </div><!--/span-->

        </div><!--/row-->
   </div>
</section>
</div>
</div>
<style>
.form-group{
  margin-bottom: 0px;
}
.list-group-item{
  border: none;
  color: #000;
}
body{
  background-color: #f6f6f6;
}
.error{
  color:red;
  font-size: 16px;
}
</style>
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

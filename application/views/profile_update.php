<script src="<?php echo base_url(); ?>assets/front/js/jquery.form.js"></script>
<style>
.card-block{
  padding: 30px;
  margin-left: 10px;
  margin-right: 10px;
}
.footer_section{
  display: none;
}
.profile_active {
    border-left: 4px solid #458ecc;
}
.form-control-label{
  font-size: 18px;
  font-weight: 500;
}
.form-control{
  font-size: 16px;
}
.profile_tab{
  margin-top: 50px;
  margin-bottom:50px;
}

.upload-button {
    border: 1px solid black;
    border-radius: 20px;
    width: 150px;
    text-align: center;
    color: #fff;
    border-color: #fff;
    margin-top: 5px;
    margin-left: 5px;
    display: none;
}

.profile-pic {
    max-width: 200px;
    max-height: 200px;

    margin-top: 10px;
    margin-left: 20px;
    height: 200px;

}
.file-upload{
  padding-left:140px;
  margin-top: 10px;
}
.profile-img{
  text-align: center;
      margin-top: -200px;
}
.change_pic{
  margin-top: 200px;
}
</style>
<div class=" col-md-12 " id="content">
    <h3 class="dashboard_tab">Profile Setting</h3>
</div>
<?php  foreach($res as $rows){} ?>
<div class="col-md-12 profile_tab">
<div class="col-md-7">
  <form class="form" role="form" autocomplete="off" method="post" action="" id="profile_form">
      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Name</label>
          <div class="col-md-6">
              <input class="form-control" type="text" name="first_name" value="<?php echo $rows->name; ?>">
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Username</label>
          <div class="col-md-6">
              <input class="form-control" type="text" name="user_name" value="<?php echo $rows->user_name; ?>">
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Email</label>
          <div class="col-md-6">
            <p>  <?php echo $rows->email_id;  if($rows->email_verify=='N'){ ?><i class="fas fa-exclamation-triangle notverfied" title="Email is Not Verified"></i>

          <?php  }else{  } ?> <span class="change-email"><a href="<?php echo  base_url(); ?>changemail"><br><b>Change My Email</b></a></span></p>
          </div>
      </div>
          <div class="form-group row">
              <label class="col-md-3 col-form-label form-control-label">Gender</label>
              <div class="col-md-6">
                <select class="col-form-label" name="gender" id="gender">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                <script>$('#gender').val('<?php echo $rows->gender; ?>');</script>

              </div>

            </div>
      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Mobile number</label>
          <div class="col-md-6">
            <p>  <?php if(empty($rows->mobile_no)){ echo $rows->mobile_no; ?>
                <span class="change-email"><a href="<?php echo  base_url(); ?>mobile">Add Mobile number</a></span></p>
          <?php  }else{ echo $rows->mobile_no; ?>
              <span class="change-email"><a href="<?php echo  base_url(); ?>mobilenumber">&nbsp; <b>Change Mobile number</b></a></span></p>
          <?php   } ?>
          <!-- <input class="form-control" type="text" name="mobile_no" id="mobile_no" value="<?php echo $rows->mobile_no; ?>"> -->


          </div>
      </div>
      <input class="form-control" type="hidden" name="user_id" value="<?php echo $this->session->userdata('id'); ?>">

      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Address</label>
          <div class="col-md-8">
            <textarea class="textarea form-control textarea-form"  rows="4" name="address"><?php echo $rows->address_line1; ?></textarea>
              </div>
      </div>


      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Occupation</label>
          <div class="col-md-6">
            <input class="form-control" type="text" name="occupation" value="<?php echo $rows->occupation; ?>">

          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Subscribe  Newsletter</label>
          <div class="col-md-6">
            <select class="col-form-label" name="newsletter_status" id="newsletter_status">
              <option value="Y">Yes</option>
              <option value="N">No</option>
            </select>
            <script>$('#newsletter_status').val('<?php echo $rows->newsletter_status; ?>');</script>

          </div>
        </div>
      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label"></label>
          <div class="col-md-6">
              <input type="submit" class="btn btn-primary" value="Save Changes">
          </div>
      </div>
  </form>
</div>

<div class="col-md-5 change_pic">
<div class="profile-img">
  <?php if(empty($rows->user_picture)){ ?>
      <img src="<?php echo base_url(); ?>assets/images/profile/noimage.png" class="img-circle  profile-pic">
<?php  }else{ ?>
    <img src="<?php echo base_url(); ?>assets/users/profile/<?php echo $rows->user_picture; ?>" class="img-circle  profile-pic">
<?php  } ?>

<form  action="<?php echo base_url(); ?>home/change_pic" method="post" id="image_upload_form" enctype="multipart/form-data">
      <div class="upload-button">Change Picture</div>

     <input class="file-upload" name="profilepic" id="profilepic" type="file" accept="image/x-png,image/jpeg" />
        <div id="preview"></div>
    </form>

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

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function() {
        readURL(this);
    });

    $(".upload-button").on('click', function() {
        $(".file-upload").click();
    });

    $(document).ready(function() {

        $('#profilepic').on('change', function() {

          var f=this.files[0]
			     var actual=f.size||f.fileSize;
           var orgi=actual/1024;
            if(orgi<1024){
              $("#preview").html('');
              $("#preview").html('<img src="<?php echo base_url(); ?>assets/loader.gif" alt="Uploading...." style="width:10%;"/>');
              $("#image_upload_form").ajaxForm({
                  target: '#preview'
              }).submit();
            }else{
              alert("File Size Must be  Lesser than 1 MB");
            }


        });
    });
</script>

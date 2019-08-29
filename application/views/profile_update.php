<script src="<?php echo base_url(); ?>assets/front/js/jquery.form.js"></script>
<script src="<?php  echo base_url(); ?>assets/js/croppie.js"></script>
<link rel="stylesheet" href="<?php  echo base_url(); ?>assets/css/croppie.css" />
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
input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>
<div class=" col-md-12 " id="content">
    <h3 class="dashboard_tab">User Profile</h3>
</div>
<?php  foreach($res as $rows){} ?>
<div class="col-md-12 profile_tab">
<div class="col-md-7">
  <form class="form" role="form" autocomplete="off" method="post" action="" id="profile_form">
      <div class="form-group row">
          <label class="col-md-3 col-form-label form-control-label">Full Name</label>
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
          <label class="col-md-3 col-form-label form-control-label">Email ID</label>
          <div class="col-md-6">
            <p>  <?php echo $rows->email_id;  if($rows->email_verify=='N'){ ?><i class="fas fa-exclamation-triangle notverfied" title="Email is Not Verified"></i>

          <?php  }else{  } ?> <span class="change-email"><a href="<?php echo  base_url(); ?>changemail"><br><small>Change Email ID</small></a></span></p>
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
          <label class="col-md-3 col-form-label form-control-label">Mobile Number</label>
          <div class="col-md-6">
            <p>  <?php if(empty($rows->mobile_no)){ echo $rows->mobile_no; ?><br>
                <span class="change-email"><a href="<?php echo  base_url(); ?>mobile">Add Mobile number</a></span></p>
          <?php  }else{ echo $rows->mobile_no; ?>
              <span class="change-email"><a href="<?php echo  base_url(); ?>mobilenumber"><br> <small>Change Mobile Number</small></a></span></p>
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
          <label class="col-md-3 col-form-label form-control-label">Newsletter Subscription</label>
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
              <input type="submit" class="btn btn-primary" value="Save">
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


</div>
<br>
<div class="">
  <!-- <input type="file" name="upload_image" class="btn btn-primary" id="upload_image" style="margin-left:150px;" /> -->
  <label for="upload_image" class="custom-file-upload"  style="margin-left:150px;">
    <i class="fa fa-cloud-upload"></i> Upload Image
</label>
<input id="upload_image" type="file" name="upload_image" />
</div>

    <?php if(empty($rows->user_picture)){ ?>
  <?php  }else{ ?>
    <small class="" style="margin-left:150px;"><a onclick="remove_img()" style="cursor: pointer;">Remove Profile Picture</a></small>
  <?php  } ?>


</div>

</div>

<div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Crop & Upload Image</h4>
      		</div>
      		<div class="modal-body">
        		<div class="row">
  					<div class="col-md-12 text-center">
						  <center><div id="image_demo" style="width:450px; margin-top:30px"></div></center>
  					</div>
            	</div>
          	<div class="row">
  					<div class="col-md-12 text-center" style="padding-top:30px;">
  										  <button class="btn btn-success crop_image">Upload</button>
					</div>
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
    </div>
</div>


<script>
function remove_img(){
  $.ajax({
    url:"<?php  echo base_url();  ?>home/remove_img",
    type: "POST",
    data:{"hi": "response"},
    success:function(data)
    {
      if(data=="success"){
          alert("Picture Removed");
          window.setTimeout(function(){location.reload()},1000)
      }else{
          alert("Something Went Wrong");
      }
    }
  });
}

$(document).ready(function(){

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $('#upload_image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });

  $('.crop_image').click(function(event){
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      $.ajax({
        url:"<?php  echo base_url();  ?>home/change_pic",
        type: "POST",
        data:{"image": response},
        success:function(data)
        {
          if(data=="success"){
            swal({
                title: "",
                text: " Profile picture updated",
                type: "success"
            }).then(function() {
               location.reload();
            });
          }else{
              sweetAlert("Oops...", response, "error");
          }
        }
      });
    })
  });

});



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
                       remote: "Username already exists!"
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
            $.ajax({
            url: "<?php echo base_url(); ?>home/save_profile",
            type: 'POST',
            data: $('#profile_form').serialize(),

            success: function(response) {
                if (response == "success") {
                    swal({
                        title: "",
                        text: "Changes made are saved",
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

<script src="<?php echo base_url(); ?>assets/front/js/jquery.form.js"></script>
<div class="container-fluid page-bg">
<div class="">
<div class="row header-title leaderboard-bg">
  <div class="col-md-12">
  <div class="container">
      <p class="leader-title">Bootstrap example of Fixed Background Image using HTML, Javascript, jQuery, and CSS. Snippet by iammahesh.</p>
    </div>
  </div>
</div>

<section class="container">
  <div class="leaderboard-menu-tab">
        <div class="row row-offcanvas row-offcanvas-right">
          <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
              <a href="<?php echo base_url(); ?>leaderboard" class="list-group-item "><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="<?php echo base_url(); ?>profile" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
                <a href="<?php echo base_url(); ?>profile_picture" class="list-group-item active"><span class="menu-icons"><i class="fas fa-user"></i></span>Display Picture</a>
               <?php $user_role = $this->session->userdata('user_role');
                if($user_role=='2'){ ?>
                    <a href="<?php echo base_url(); ?>createevent" class="list-group-item"><span class="menu-icons"><i class="far fa-plus-square"></i></span>Create event </a>
                    <a href="<?php echo base_url(); ?>viewevents" class="list-group-item"><span class="menu-icons"><i class="fas fa-table"></i></span>View events </a>
                    <a href="<?php echo base_url(); ?>bookedevents" class="list-group-item"><span class="menu-icons"><i class="far fa-list-alt"></i></i></span>Booked Events </a>
                    <a href="<?php echo base_url(); ?>reviewevents" class="list-group-item"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <?php } ?>
              <a href="<?php echo base_url(); ?>booking_history" class="list-group-item"><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>              <a href="<?php echo base_url(); ?>wishlist" class="list-group-item"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="<?php echo base_url(); ?>logout" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
            <div class="">
              <div class="card-header">
                             <h3 class="mb-0">Profile Picture</h3>
                         </div>
                <!-- form user info -->
                  <?php  foreach($res as $rows){} ?>
                  <div class="card card-outline-secondary">

                      <div class="card-block">

                              <div class="form-group row">
                                <div class="profile-img">
                                  <?php if(empty($rows->user_picture)){ ?>
                                      <img src="<?php echo base_url(); ?>assets/images/profile/noimage.png" class="img-circle  profile-pic">
                                <?php  }else{ ?>
                                    <img src="<?php echo base_url(); ?>assets/users/profile/<?php echo $rows->user_picture; ?>" class="img-circle  profile-pic">
                                <?php  } ?>

                                <form  action="<?php echo base_url(); ?>home/change_pic" method="post" id="image_upload_form" enctype="multipart/form-data">
                                      <div class="upload-button">Change Picture</div>

                                        <input class="file-upload" name="profilepic" id="profilepic" type="file"accept="image/x-png,image/jpeg" />
                                        <div id="preview"></div>
                                    </form>

                                </div>
                              </div>


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

    #form {
        display: none;
        padding-top: 20px;
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
    }

    .profile-pic {
        max-width: 200px;
        max-height: 200px;
        border-radius: 50px;
        margin-top: 10px;
        margin-left: 20px;
        height: 200px;
    }


</style>
<script>

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
              $("#preview").html('<img src="<?php echo base_url(); ?>assets/loader.gif" alt="Uploading...." style="width:100%;"/>');
              $("#image_upload_form").ajaxForm({
                  target: '#preview'
              }).submit();
            }else{
              alert("File Size Must be  Lesser than 1 MB");
            }


        });
    });
</script>

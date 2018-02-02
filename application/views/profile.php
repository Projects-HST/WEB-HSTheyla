<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#999999" />

    <title>HEYLA</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92904528-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-92904528-2');
    </script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.form.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
</head>
<style>
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
        max-width: 100px;
        max-height: 100px;
        border-radius: 50px;
        margin-top: 10px;
        margin-left: 20px;
        height: 100px;
    }

    .file-upload {
        display: none;
    }
</style>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark  fixed-top  navbar-inverse menupage">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url(); ?>home">Home
                          <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#services">Services</a>
                    </li>
                     <?php
                        $user_role=$this->session->userdata('user_role');

                     if($user_role=='2'){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo  base_url(); ?>dashboard">Create Event</a>
                    </li>
                    <?php }else{ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="home#create">Create Event</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>home#contact">Contact</a>
                    </li>
                    <?php
                       $user_id=$this->session->userdata('user_role');
                       if(empty($user_id)){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Sign In / Sign Up</a>
                        </li>
                        <?php }else{ ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>logout">Logout</a>
                            </li>
                            <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <section class="profile">
        <div class="container">
            <div class="row">
                <?php foreach($res as $rows){} ?>

                    <div class="center-div">
                        <div class="cover">
                            <span>
                      <p class="float-right setting-btn" >
                          <a href="#" class="setting" id="setting"><i class="fa fa-cog" aria-hidden="true"></i></a></p>
                            <p class="float-right"><a href="#" class="btn " id="edit-btn">Edit</i></a>
                            <br>
                          <a href="#" class="btn " id="edit-btn">Edit</i></a></p>


                    </span>
                            <div class="profile-img">
                              <?php if(empty($rows->user_picture)){ ?>
                                  <img src="<?php echo base_url(); ?>assets/images/profile/noimage.png" class="img-circle  profile-pic">
                            <?php  }else{ ?>
                                <img src="<?php echo base_url(); ?>assets/users/profile/<?php echo $rows->user_picture; ?>" class="img-circle  profile-pic">
                            <?php  } ?>

                                <form id="image_upload_form" action="<?php echo base_url(); ?>home/change_pic" method="post" enctype="multipart/form-data" action='image_upload.php' autocomplete="off">
                                    <div class="upload-button">Change Picture</div>

                                    <input class="file-upload" name="profilepic" id="profilepic" type="file"accept="image/x-png,image/jpeg" />
                                    <div id="preview"></div>
                                </form>

                            </div>

                        </div>

                        <div class="infobox">
                            <p class="profileedit">
                                <div class="per-info" id="per-info">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-5">
                                            <?php echo $rows->name; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-5">
                                            <?php echo $rows->email_id; ?> <?php if($rows->email_verify=='N'){ ?> <span style="color:red;" title="Verify Your Email"><i class="fa fa-times" aria-hidden="true"></i></span><br>


                                          <?php  } ?><br>
                                        <a href="<?php echo  base_url(); ?>changemail">Change the Email</a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-5">
                                            <?php echo $rows->address_line1; ?>
                                        </div>
                                    </div>
                                    <?php   if(empty($rows->mobile_no)){ ?>

                                  <?php  }else{ ?>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Mobile </label>
                                        <div class="col-sm-5">
                                            <?php echo $rows->mobile_no; ?><br>
                                          <?php   if(empty($rows->mobile_no)){ ?>

                                        <?php  }else{ ?>
                                            <a href="<?php echo  base_url(); ?>mobilenumber">Change the Number</a>
                                        <?php  } ?>

                                        </div>
                                    </div>
                                  <?php } ?>

                                </div>
                                <form method="post" enctype="multipart/form-data" id="form">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $rows->name; ?>">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-5">
                                            <textarea type="text" class="form-control" id="address" name="address"><?php echo $rows->address_line1; ?></textarea>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Mobile </label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $rows->mobile_no; ?>" onblur="check_mobile()">
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-5">
                                            <input type="submit" class="btn btn-event" id="submit" value="Save">
                                        </div>
                                    </div>

                                </form>
                            </p>
                        </div>

                    </div>
            </div>
        </div>

    </section>

    <!-- Footer -->
    <footer class="footer-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                     <p class="fnt-footer"><a href="http://happysanz.com/" target="_blank">Crafted With Happiness</a></p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline fnt-footer ">
                      <li class="list-inline-item"><a href="<?php echo base_url(); ?>privacy">Privacy Policy</a></li>
                      <li class="list-inline-item"><a href="<?php echo base_url(); ?>payment">Payment Policy</a></li>
                      <li class="list-inline-item"><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->
    </footer>

</body>
<script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script> -->
<script type="text/javascript">
    $("#loginbtn").click(function() {
        $(this).toggleClass("menuactive");
    });
    $('ul li a').click(function() {
        $('li a').removeClass("menuactive");
        $(this).addClass("menuactive");
    });

    $("#setting").click(function() {
        $("#edit-btn").toggle();
    });

    $("#edit-btn").click(function() {
        $("#form").toggle();
        $('#per-info').hide();

    });


    $('#form').validate({ // initialize the plugin
        rules: {
            mobile: {
                required: true
            },
            email: {
                required: true
            },
            name: {
                required: true
            },
            address: {
                required: true
            },
        },
        messages: {
            email: "Enter Email",
            mobile: "Enter mobile ",
            name: "Enter Name",
            address: "Enter Address "
        },
        submitHandler: function(form) {
            //alert("hi");
            $.ajax({
                url: "<?php echo base_url(); ?>home/save_profile",
                type: 'POST',
                data: $('#form').serialize(),

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

    function check_email() {
        var email = $('#email').val();
        $.ajax({
            method: "post",
            data: {
                email: email
            },
            url: 'home/checkemail',
            success: function(data) {

                if ((data) == "success") {
                    $("#submit").removeAttr("disabled");
                } else {
                    $('#submit').prop('disabled', true);
                }
            }
        });
    }



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
</html>

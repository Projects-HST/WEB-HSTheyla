<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="theme-color" content="#478ECC" />
    <link rel="icon" href="<?php echo base_url(); ?>assets/fav_icon.png" type="image/gif" sizes="32x32">
    <title><?php if(isset($meta_title)){echo "Heyla - ".$meta_title;}else{echo "Heyla";}?> </title>
    <meta name="description" content="<?php if(isset($meta_description)){echo $meta_description;}else{echo "Heyla";}?>"/>
    <link href="<?php echo base_url(); ?>assets/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/front/css/style.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url(); ?>assets/front/css/main.css" rel="stylesheet"> -->
    <!-- <link href="<?php echo base_url(); ?>assets/css/button.css" rel="stylesheet" type="text/css"> -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">


    <link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <!-- <link href="<?php echo base_url(); ?>assets/front/css/carousel.css" rel="stylesheet"> -->
    <script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
    <!--  Forms Validations Plugin -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92904528-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-92904528-2');
    </script>
</head>


<style>
.modal-dialog{
  max-width:700px;
}

.dropdown-menu>li:hover, .dropdown-menu>li:focus {
    color: #262626;
    text-decoration: none;
    background-color: #f5f5f5;
}
</style>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#fff;z-index: 100">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/heyla_logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggle_menu"><i class="fa fa-bars" aria-hidden="true"></i></span>

            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto topmenu">
                  <?php
                  $user_role = $this->session->userdata('user_role');
                  $user_id = $this->session->userdata('id');?>
                   <?php if($user_role=='2'){

                   }else{ ?>
                     <li class="nav-item">
                        <a href="#" class="nav-link organiser_btn" data-toggle="modal" data-target="#exampleModal">Become An Organizer</a>
                    </li>
                    
                <?php   }?>

                    <?php
                    $user_role = $this->session->userdata('user_role');
                    $user_id = $this->session->userdata('id');
                       if(empty($user_role)){ ?>
                         <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url(); ?>signup" style="margin-top:10px;">Login / Sign Up </a>
                        </li>


                    <?php
                       }else{ ?>

                         <?php  if($user_role=='3'){ ?>

                        <?php  }elseif($user_role=='2'){?>
                          <li class="nav-item">
                              <a class="nav-link organiser_btn" href="<?php echo base_url(); ?>createevent">Create Event</a>
                          </li>
                       <?php }elseif($user_role=='1'){?>
                         <li class="nav-item">
                             <a class="nav-link organiser_btn" href="<?php echo base_url(); ?>adminlogin/dashboard">Dashboard</a>
                         </li>
                      <?php }else{?>

                        <?php } ?>
                              <?php  if($user_role=='3' || $user_role=='2'){ ?>
                                <?php
                                $user_id = $this->session->userdata('id');
                                $select="SELECT * FROM  user_details  WHERE user_id='$user_id'";
                                 $res=$this->db->query($select);
                                 $result=$res->result();
                                 foreach($result as $rows){} ?>


                                <li class="nav-item">
                                  <p class="welcome_name">Hi <?php  if(!empty($rows->name)){ echo $rows->name; }else{ } ?> </p>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <?php if(empty($rows->user_picture)){ ?>
                                             <img src="<?php echo base_url(); ?>assets/users/profile/noimage.png" class="img-circle profile_img_head img-thumbnail img-responsive">
                                          <?php }else{ ?>
                                            <img src="<?php echo base_url(); ?>assets/users/profile/<?php echo $rows->user_picture; ?>" class="img-circle profile_img_head img-thumbnail img-responsive">
                                          <?php  }
                                          ?>
                                    </a>

                                    <ul class="dropdown-menu dropdown-block profile_menu" role="menu" style="">
                                        <li><a href="<?php echo base_url(); ?>profile">Profile</a></li>
                                         <li><a href="<?php echo base_url(); ?>change_password">Change Password</a></li>
                                        <li><a class="cursor_link" onclick="logout()">Logout</a></li>
                                    </ul>
                                  </li>

                          <?php  } ?>

                     <?php } ?>



                </ul>
            </div>
        </div>
    </nav>
    <style>


    </style>

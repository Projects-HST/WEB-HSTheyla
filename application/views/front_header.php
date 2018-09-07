<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="theme-color" content="#478ECC" />
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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-92904528-2"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
    <!--  Forms Validations Plugin -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
</head>
<style>
.modal-dialog{
  max-width:700px;
}


</style>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#fff;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/heyla_logo.png" class="imglogo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto topmenu">
                    <?php
                   	$user_role = $this->session->userdata('user_role');
                    $user_id = $this->session->userdata('id');
                       if(empty($user_role)){ ?>
                         <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>signin" >Login / Sign Up </a>
                          </li>

                    <?php
                       }else{ ?>

                             <?php  if($user_role=='3'){ ?>
                               <li class="nav-item">
                                   <a class="nav-link organiser_btn" href="<?php echo base_url(); ?>createevent">Create Event</a>
                               </li>
                             <?php  }else{?>
                               <li class="nav-item">
                                  <a class="nav-link organiser_btn" data-toggle="modal" data-target="#exampleModal">Become Organiser</a>
                              </li>
                            <?php } ?>
                              <?php  if($user_role=='3' || $user_role=='2'){ ?>
                                <?php
                                $user_id = $this->session->userdata('id');
                                $select="SELECT * FROM  user_details  WHERE user_id='$user_id'";
                                 $res=$this->db->query($select);
                                 $result=$res->result();
                                 foreach($result as $rows){} ?>


                                <li class="nav-item">
                                  <p class="welcome_name">Hi <?php echo $rows->name; ?> !</p>
                                </li>
                                <li class="dropdown keep-open">
                                  <div id="dLabel" role="button" href="#" class="nav-item" data-toggle="dropdown" data-target="#" >
                                <?php if(empty($rows->user_picture)){ ?>
                                       <img src="<?php echo base_url(); ?>assets/users/profile/noimage.png" class="img-circle profile_img_head">
                                    <?php }else{ ?>
                                      <img src="<?php echo base_url(); ?>assets/users/profile/<?php echo $rows->user_picture; ?>" class="img-circle profile_img_head">
                                    <?php  }
                                    ?>
                                     <span class="caret"></span>
                                  </div>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                        <li><a class="nav-link" href="<?php echo base_url(); ?>profile">Profile</a></li>
                                        <li><a class="nav-link logout-btn" onclick="logout()">Logout</a></li>

                                    </ul>
                                </li>
                          <?php  } ?>

                     <?php } ?>


                </ul>
            </div>
        </div>
    </nav>

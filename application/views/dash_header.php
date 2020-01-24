<!DOCTYPE html>
<html>
<head>

<title>Heyla</title>
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="viewport" content="width=1024">
  <link rel="icon" href="<?php echo base_url(); ?>assets/fav_icon.png" type="image/gif" sizes="32x32">
<link href="<?php echo base_url(); ?>assets/front/css/bootstrap3.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/dashboard.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/bootstrap3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>

<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/front/js/moment.js"></script>


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
.logout-btn{
  cursor: pointer;
}
</style>
<body>
<div id="navbar-wrapper">
      <header>
          <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#478ecc;">
              <div class="container-fluid">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="<?php echo base_url(); ?>">
                          <img src="<?php echo base_url(); ?>assets/front/images/logo_white.png" alt="heylaapp" style="width:125px;">
                      </a>
                  </div>
                  <div id="navbar-collapse" class="collapse navbar-collapse">
                      <ul class="nav navbar-nav navbar-right">

                          <?php
                          $user_role = $this->session->userdata('user_role');
                             if(empty($user_role)){ ?>
                               <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url(); ?>signin" >Sign In </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url(); ?>signup" >Sign Up</a>
                                </li>
                          <?php
                             }else{ ?>
                               <?php  if($user_role=='3' || $user_role=='2'){
                                 $user_id = $this->session->userdata('id');
                                 $select="SELECT * FROM  user_details  WHERE user_id='$user_id'";
                                  $res=$this->db->query($select);
                                  $result=$res->result();
                                  foreach($result as $rows){} ?>
                                  <li class="nav-item">
                                    <p class="welcome_name">Hi <?php echo $rows->name; ?> </p>
                                  </li>
                                 <li class="dropdown">
                                     <a id="user-profile" href="#" class="dropdown-toggle" data-toggle="dropdown">

                                <?php   if(empty($rows->user_picture)){ ?>
                                     <img src="<?php echo base_url(); ?>assets/users/profile/noimage.png" class="img-responsive img-thumbnail img-circle">
                                  <?php }else{ ?>
                                    <img src="<?php echo base_url(); ?>assets/users/profile/<?php echo $rows->user_picture; ?>" class="img-responsive img-thumbnail img-circle">
                                  <?php  }
                                  ?>
                                        </a>
                                     <ul class="dropdown-menu dropdown-block" role="menu">
                                         <li><a href="<?php echo base_url(); ?>profile">Profile</a></li>
										 <li><a href="<?php echo base_url(); ?>change_password">Change Password</a></li>
										 <li><a href="<?php echo base_url(); ?>user_points">User Points</a></li>
                                         <li><a class="nav-link logout-btn" onclick="logout()">Logout</a></li>
                                     </ul>
                                 </li>

                           <?php  } ?>

                           <?php } ?>


                      </ul>
                  </div>
              </div>
          </nav>
      </header>
  </div>
  <div id="wrapper">
      <div id="sidebar-wrapper">
          <aside id="sidebar">
              <ul id="sidemenu" class="sidebar-nav">
                  <li>
                      <a href="<?php echo base_url(); ?>leaderboard" class="leaderboard_active">
                          <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/leaderboard.png"></span>
                          <span class="sidebar-title">Leaderboard</span>
                      </a>
                  </li>

                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>profile" class="profile_active">
                        <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/profile.png"></span>
                        <span class="sidebar-title">Profile</span>
                      </a>
                  </li>

                  <?php $user_role = $this->session->userdata('user_role');
                  if($user_role=='2'){ ?>
                    <li class="side-menu">
                        <a href="<?php echo base_url(); ?>createevent" class="createevent_active">
                          <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/create_event.png"></span>
                          <span class="sidebar-title">Create Event</span>
                        </a>
                    </li>
                    <li class="side-menu">
                          <a href="<?php echo base_url(); ?>viewevents" class="viewevents_active">
                            <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/view_events.png"></span>
                            <span class="sidebar-title">View Events</span>
                          </a>
                    </li>
                    <li class="side-menu">
                        <a href="<?php echo base_url(); ?>bookedevents" class="booked_events_active">
                          <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/booking_details.png"></span>
                          <span class="sidebar-title">Booking Details</span>
                        </a>
                    </li>
                    <li class="side-menu">
                        <a href="<?php echo base_url(); ?>reviewevents" class="review_active">
                          <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/review.png"></span>
                          <span class="sidebar-title">Reviews</span>
                        </a>
                    </li>

                  <?php  } ?>
                  <li class="side-menu">
                        <a href="<?php echo base_url(); ?>wishlist" class="wishlist_active">
                          <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/wishlist.png"></span>
                          <span class="sidebar-title">Wish List</span>
                        </a>
                  </li>
                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>booking_history" class="booking_history_active">
                        <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/booking_history.png"></span>
                        <span class="sidebar-title">Booking History</span>
                      </a>
                  </li>
                  <!--<li class="side-menu">
                      <a href="<?php echo base_url(); ?>user_points" class="user_points">
                        <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/user_points.png"></span>
                        <span class="sidebar-title">User Points</span>
                      </a>
                  </li>-->
				  <li class="side-menu">
                      <a class="user_points" onclick="delete_ac(<?php echo $user_id;?>)" style="cursor:pointer;">
                        <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/deactivate_account.png"></span>
                        <span class="sidebar-title">Deactivate Account</span>
                      </a>
                  </li>
              </ul>
          </aside>
      </div>

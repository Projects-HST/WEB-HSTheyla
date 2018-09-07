<!DOCTYPE html>
<html>
<head>

<title>Heyla</title>
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="viewport" content="width=1024">

<link href="<?php echo base_url(); ?>assets/front/css/bootstrap3.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/dashboard.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/bootstrap3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script> -->
<script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" />
</head>
<style>
.profile_img_head {
    height: 45px;
    width: 45px;
    border-radius: 30px;
    border: 1px solid #ddd;
}
.navbar-nav li:hover > ul.dropdown-menu {
display: block;
}
.dropdown-submenu {
position:relative;
}
.dropdown-submenu>.dropdown-menu {
top:0;
left:100%;
margin-top:-6px;
}

/* rotate caret on hover */
.dropdown-menu > li > a:hover:after {
text-decoration: underline;
transform: rotate(-90deg);
}
</style>
<body>
<div id="navbar-wrapper">
      <header>
          <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#fff;">
              <div class="container-fluid">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="<?php echo base_url(); ?>">
                          <img src="<?php echo base_url(); ?>assets/front/images/heyla_logo.png" alt="heylaapp" style="width:125px;">
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
                                    <p class="welcome_name">Hi <?php echo $rows->name; ?> !</p>
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

                                         <li>
                                            <a class="nav-link logout-btn" onclick="logout()">Logout</a>
                                          </li>
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
                          <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/dashboard.png"></span>
                          <span class="sidebar-title">Dashboard</span>
                      </a>
                  </li>

                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>profile" class="profile_active">
                        <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/profile.png"></span>
                        <span class="sidebar-title">Pofile</span>
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
                          <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/booked_events.png"></span>
                          <span class="sidebar-title">Booked events</span>
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
                          <span class="sidebar-title">Wishlist</span>
                        </a>
                  </li>
                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>booking_history" class="booking_history_active">
                        <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/booking_history.png"></span>
                        <span class="sidebar-title">Booking History</span>
                      </a>
                  </li>
                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>user_points" class="user_points">
                        <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/user_points.png"></span>
                        <span class="sidebar-title">User Points</span>
                      </a>
                  </li>
              </ul>
          </aside>
      </div>

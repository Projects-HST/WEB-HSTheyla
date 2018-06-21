<!DOCTYPE html>
<html>
<head>

<title>Heyla</title>
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="viewport" content="width=1024">
<head>
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

<style>
.navbar-fixed-top {
    top: 0;
    border-width: 0 0 1px;
    height: 80px;
}

.navbar-default .navbar-nav #user-profile {
    height: 50px;
    padding-top: 15px;
    padding-left: 58px;
}

.navbar-default .navbar-nav #user-profile img {
    height: 45px;
    width: 45px;
    position: absolute;
    top: 2px;
    left: 8px;
    padding: 1px;
}

#wrapper {
    padding-top: 50px;
    padding-left: 0;
    -webkit-transition: all .5s ease;
    -moz-transition: all .5s ease;
    -o-transition: all .5s ease;
    transition: all .5s ease;
}

@media (min-width: 992px) {
    #wrapper {
        padding-left: 225px;
    }
}

@media (min-width: 992px) {
    #wrapper #sidebar-wrapper {
        width: 225px;
    }
}

#sidebar-wrapper {
    border-right: 1px solid #e7e7e7;
}

#sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: 225px;
    width: 0;
    height: 100%;
    margin-left: -225px;
    overflow-y: auto;
    background-color: #418ecc;
    -webkit-transition: all .5s ease;
    -moz-transition: all .5s ease;
    -o-transition: all .5s ease;
    transition: all .5s ease;
}

#sidebar-wrapper .sidebar-nav {
    position: absolute;
    top: 18px;
    width: 225px;
    font-size: 20px;
    margin: 0;
    padding: 0;
    list-style: none;
}

#sidebar-wrapper .sidebar-nav li {
    text-indent: 0;
    line-height: 60px;
}

#sidebar-wrapper .sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #fff;
    font-size: 18px;
}



#sidebar-wrapper .sidebar-nav li a .sidebar-icon {
    width: auto;
    height: auto;
    font-size: 14px;
    padding: 0 2px;
    display: inline-block;
    text-indent: 7px;
    margin-right: 10px;
    color: #fff;
    float: left;
}

#sidebar-wrapper .sidebar-nav li a .caret {
  position: absolute;
  right: 23px;
  top: auto;
  margin-top: 20px;
}

#sidebar-wrapper .sidebar-nav li ul.panel-collapse {
    list-style: none;
    -moz-padding-start: 0;
    -webkit-padding-start: 0;
    -khtml-padding-start: 0;
    -o-padding-start: 0;
    padding-start: 0;
    padding: 0;
}

#sidebar-wrapper .sidebar-nav li ul.panel-collapse li i {
    margin-right: 10px;
}

#sidebar-wrapper .sidebar-nav li ul.panel-collapse li {
    text-indent: 15px;
}

@media (max-width: 992px) {
    #wrapper #sidebar-wrapper {
        width: 45px;
    }
    #wrapper #sidebar-wrapper #sidebar #sidemenu li ul {
        position: fixed;
        left: 45px;
        margin-top: -45px;
        z-index: 1000;
        width: 200px;
        height: 0;
    }
}






.navbar-default{
  background-color: #fff;
}
</style>
<div id="navbar-wrapper">
      <header>
          <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:#478ECC;">
              <div class="container-fluid">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">
                          <img src="<?php echo base_url(); ?>assets/front/images/logo.png" alt="heylaapp" style="width:100px;">
                      </a>
                  </div>
                  <div id="navbar-collapse" class="collapse navbar-collapse">
                      <ul class="nav navbar-nav navbar-right">

                          <li class="nav-item ">
                              <a class="nav-link" href="<?php echo base_url(); ?>home">Home<span class="sr-only"></span></a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>home#about">About</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>home#services">Services</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo  base_url(); ?>eventlist/">List Events</a>
                          </li>
                           <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>home#create">Become Organiser</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="<?php echo base_url(); ?>home#contact">Contact</a>
                          </li>

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
                               <?php  if($user_role=='3' || $user_role=='2'){ ?>

                                 <li class="dropdown">
                                     <a id="user-profile" href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php
                                $user_id = $this->session->userdata('id');
                                $select="SELECT * FROM  user_details  WHERE user_id='$user_id'";
                                 $res=$this->db->query($select);
                                 $result=$res->result();
                                 foreach($result as $rows){}
                                   if(empty($rows->user_picture)){ ?>
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
                  <li class="side-menu">
                      <a href="<?php echo base_url(); ?>profile_picture" class="profile_picture_active">
                        <span class="sidebar-icon"><img src="<?php echo base_url();  ?>assets/front/icons/display_picture.png"></span>
                        <span class="sidebar-title">Display Picture</span>
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
              </ul>
          </aside>
      </div>

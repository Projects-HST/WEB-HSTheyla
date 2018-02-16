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
              <a href="#" class="list-group-item "><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="#" class="list-group-item active"><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
            <div class="">
              <div class="card-header">
                             <h3 class="mb-0">User Information</h3>
                         </div>
                <!-- form user info -->
                  <div class="card card-outline-secondary">

                      <div class="card-block">
                          <form class="form" role="form" autocomplete="off">
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="text" value="Jane">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="text" value="Bishop">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                  <div class="col-lg-9">
                                    <p>email@gmail.com <span class="change-email"><a href="#">Change My Email</a></span></p>
                                  </div>
                              </div>
                                  <div class="form-group row">
                                      <label class="col-lg-3 col-form-label form-control-label">Gender</label>
                                      <div class="col-lg-9">
                                        <label class="custom-control custom-radio">
                                          <input id="radio1" name="radio" type="radio" class="custom-control-input">
                                          <span class="custom-control-indicator"></span>
                                          <span class="custom-control-description">Male</span>
                                        </label>
                                        <label class="custom-control custom-radio">
                                          <input id="radio2" name="radio" type="radio" class="custom-control-input">
                                          <span class="custom-control-indicator"></span>
                                          <span class="custom-control-description">Female</span>
                                        </label>
                                      </div>
                                    </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Company</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="text" value="">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Website</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="url" value="">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Time Zone</label>
                                  <div class="col-lg-9">
                                      <select id="user_time_zone" class="form-control" size="0">
                                          <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                          <option value="Alaska">(GMT-09:00) Alaska</option>
                                          <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                          <option value="Arizona">(GMT-07:00) Arizona</option>
                                          <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                          <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                          <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                          <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Occupation</label>
                                  <div class="col-lg-9">
                                      <select id="occupation" class="form-control">
                                          <option value="Students">Students</option>
                                          <option value="Employee">Employee</option>

                                      </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="text" value="janeuser">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="password" value="11111122333">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label">Confirm</label>
                                  <div class="col-lg-9">
                                      <input class="form-control" type="password" value="11111122333">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-lg-3 col-form-label form-control-label"></label>
                                  <div class="col-lg-9">
                                      <input type="reset" class="btn btn-secondary" value="Cancel">
                                      <input type="button" class="btn btn-primary" value="Save Changes">
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
</style>
<script>

</script>

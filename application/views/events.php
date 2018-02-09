<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/multiselect.css">
<script src="<?php echo base_url(); ?>assets/front/js/multiselect.js"></script>
<div class="container-fluid eventlist-pge">
<div class="container">
  <div class="row">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <a href="#">
    <div class="carousel-item active">
      <img class="d-block w-100" src="http://placehold.it/1200x400" >
    </div>
  </a>
    <a href="#">
    <div class="carousel-item">
      <img class="d-block w-100" src="http://placehold.it/1200x400">
    </div>
      </a>
      <a href="#">
    <div class="carousel-item">
      <img class="d-block w-100" src="http://placehold.it/1200x400">
    </div>
      </a>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>


</div>

<div class="row search-area">
  <div class="col-md-2">
    <b>Country</b><br>
    <select class="event-selectpage">
      <option value="india">India</option>
      <option value="Singapore">Singapore</option>
    </select>
  </div>
  <div class="col-md-2">
    <b>City</b><br>
    <select id="" class="event-selectpage">
      <option value="india">India</option>
      <option value="Singapore">Singapore</option>
    </select>

  </div>
  <div class="col-md-2">
    <b>Category</b><br>
    <select id="example-getting-started" multiple="multiple">
      <option value="cheese">Cheese</option>
      <option value="tomatoes">Tomatoes</option>
      <option value="mozarella">Mozzarella</option>
      <option value="mushrooms">Mushrooms</option>
      <option value="pepperoni">Pepperoni</option>
      <option value="onions">Onions</option>
  </select>
  </div>
  <div class="col-md-6">
    <b>&nbsp;</b>
    <form class="navbar-form navbar-right search-event-form" role="search">
       <div class="input-group">
           <input type="text" class="form-control btn-block" placeholder="Type the City Name" name="srch-term" id="srch-term">
           <div class="input-group-btn">
               <button class="btn btn-info btn-login" type="submit">  <i class="fas fa-search"></i>
               </button>
           </div>
       </div>
   </form>
  </div>
</div>
<p class="upcoming-event-heading">Upcoming Events</p><br>
<div class="row">

  <div class="col-md-4 event-thumb">
      <div class="card event-card">
          <img class="img-fluid" src="<?php echo base_url(); ?>assets/front/images/sample.jpg" alt="">
          <div class="card-img-overlay">
              <span class="badge badge-pill badge-danger">Free</span>
          </div>
          <div class="card-body">
            <p class="card-text">
                <small class="text-time">
                    <p>Fri Feb 9 2018 1:00 PM
                      <span class="pull-right favourite-icon">  <img class="img-fluid" src="<?php echo base_url(); ?>assets/front/images/fav-unselect.png" alt=""></span>
                    </p>

                </small>
            </p>
              <div class="news-title">
                  <p class=" title-small event-title-list">
                      <a href="#">Syria war: Why the battle for Aleppo matters</a>
                  </p>
              </div>
              <p class="card-text">
                  <small class="text-time">
                      <em>India,Coimbatore</em>
                  </small>
              </p>
          </div>
      </div>
  </div>


  <div class="col-md-4 event-thumb">
      <div class="card event-card">
          <img class="img-fluid" src="<?php echo base_url(); ?>assets/front/images/sample.jpg" alt="">
          <div class="card-img-overlay">
              <span class="badge badge-pill badge-danger">Free</span>
          </div>
          <div class="card-body">
            <p class="card-text">
                <small class="text-time">
                    <p>Fri Feb 9 2018 1:00 PM
                      <span class="pull-right favourite-icon">  <img class="img-fluid" src="<?php echo base_url(); ?>assets/front/images/fav-select.png" alt=""></span>
                    </p>

                </small>
            </p>
              <div class="news-title">
                  <p class=" title-small event-title-list">
                      <a href="#">Syria war: Why the battle for Aleppo matters</a>
                  </p>
              </div>
              <p class="card-text">
                  <small class="text-time">
                      <em>India,Coimbatore</em>
                  </small>
              </p>
          </div>
      </div>
  </div>


</div>


</div>
</div>
<style>
.carousel-item{
  height: 370px;
}
.badge-pill{
  float: right;
  border-radius: 0px;
  padding: 5px 5px 5px 5px;
}
</style>
<script>
    $('#example-getting-started').multiselect();
</script>

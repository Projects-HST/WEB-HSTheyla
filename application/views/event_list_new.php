<style>
.field-icon {
  float: right;
  left:-10px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
.carousel-inner .carousel-item.active,
.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
  display: flex;
}

.carousel-inner .carousel-item-right.active,
.carousel-inner .carousel-item-next {
  transform: translateX(33%);
}

.carousel-inner .carousel-item-left.active,
.carousel-inner .carousel-item-prev {
  transform: translateX(-33%);
}

.carousel-inner .carousel-item-right,
.carousel-inner .carousel-item-left{
  transform: translateX(0);

}
.slider-img{
  padding-left: 0px;
  padding-right: 0px;
}
body{background-color: #f5f5f5;}

</style>
<div class="container-fluid ">
  <div class="row">
      <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
          <div class="carousel-inner w-100" role="listbox">
              <div class="carousel-item active">
                  <img class="d-block col-6 img-fluid slider-img" src="http://www.cars101.com/subaru/ads-subaru-2013-love-spring-event3.JPG" style="height:500px;">
              </div>
              <div class="carousel-item">
                  <img class="d-block col-6 img-fluid slider-img" src="https://mir-s3-cdn-cf.behance.net/project_modules/disp/5e26e1428035.560095600048d.png" style="height:500px;">
              </div>
              <div class="carousel-item">
                  <img class="d-block col-6 img-fluid slider-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKX4DJ_5k_5DKAqgOOrk1-ZMgkPTsSl7Fd7mxPh_M5TTEhJtrtfw" style="height:500px;">
              </div>

          </div>
          <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
      </div>
  </div>
</div>
<div class="container eventdetail-pge">
  <div class="row search_form">
    <div class="col-md-2">
      <p class="event_heading">Search Events</p>
    </div>
    <div class="col-md-10">
      <div class="left-inner-addon">
        <input  type="text" class="form-control btn-block"  name="pwd"  placeholder="Search Event by name" value="" required>
           <span toggle="#password-field" class="fa fa-search field-icon toggle-password"></span>
       </div>
    </div>
  </div>
</div>
<div class="container eventdetail-pge">
  <div class="row search_filter">
    <div class="col-md-2">
      <div class="form-group">
            <div class="col-sm-12">
              <select class="form-control" name="category">
                <option value="">Country</option>
                <option value="1">11</option>
              </select>
          </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
            <div class="col-sm-12">
              <select class="form-control" name="category">
                <option value="">City</option>
                <option value="1">11</option>
              </select>
          </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
            <div class="col-sm-12">
              <select class="form-control" name="category">
                <option value="">Category</option>
                <option value="1">11</option>
              </select>
          </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group ">
            <div class="col-sm-12">
              <select class="form-control btn-block" name="category">
                <option value="">Preferences</option>
                <option value="1">11</option>
              </select>
          </div>
      </div>
    </div>
  </div>
</div>
<div class="container search_filter">
  <div class="row">
    <div class="col-xs-18 col-sm-4 col-md-4 event_box">
     <div class="thumbnail  event_section">
       <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKX4DJ_5k_5DKAqgOOrk1-ZMgkPTsSl7Fd7mxPh_M5TTEhJtrtfw" alt="" style="height:204px; width:100%;">
         <div class="event_thumb">
           <a href="#"><p class="event_heading">Event Name</p></a>
           <p><img src="<?php echo base_url(); ?>assets/front/images/date.png"><span class="event_thumb">May 25<span></p>
           <p><img src="<?php echo base_url(); ?>assets/front/images/time.png"><span class="event_thumb">May 25<span></p>
           <p><img src="<?php echo base_url(); ?>assets/front/images/location.png"><span class="event_thumb">May 25<span></p>
       </div>
     </div>
   </div>
   <div class="col-xs-18 col-sm-4 col-md-4 event_box">
    <div class="thumbnail  event_section">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKX4DJ_5k_5DKAqgOOrk1-ZMgkPTsSl7Fd7mxPh_M5TTEhJtrtfw" alt="" style="height:204px; width:100%;">
        <div class="event_thumb">
          <a href="#"><p class="event_heading">Event Name</p></a>
          <p><img src="<?php echo base_url(); ?>assets/front/images/date.png"><span class="event_thumb">May 25<span></p>
          <p><img src="<?php echo base_url(); ?>assets/front/images/time.png"><span class="event_thumb">May 25<span></p>
          <p><img src="<?php echo base_url(); ?>assets/front/images/location.png"><span class="event_thumb">May 25<span></p>
      </div>
    </div>
  </div>
  <div class="col-xs-18 col-sm-4 col-md-4 event_box">
   <div class="thumbnail  event_section">
     <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKX4DJ_5k_5DKAqgOOrk1-ZMgkPTsSl7Fd7mxPh_M5TTEhJtrtfw" alt="" style="height:204px; width:100%;">
       <div class="event_thumb">
         <a href="#"><p class="event_heading">Event Name</p></a>
         <p><img src="<?php echo base_url(); ?>assets/front/images/date.png"><span class="event_thumb">May 25<span></p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/time.png"><span class="event_thumb">May 25<span></p>
         <p><img src="<?php echo base_url(); ?>assets/front/images/location.png"><span class="event_thumb">May 25<span></p>
     </div>
   </div>
 </div>
 <div class="col-xs-18 col-sm-4 col-md-4 event_box">
  <div class="thumbnail  event_section">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKX4DJ_5k_5DKAqgOOrk1-ZMgkPTsSl7Fd7mxPh_M5TTEhJtrtfw" alt="" style="height:204px; width:100%;">
      <div class="event_thumb">
        <a href="#"><p class="event_heading">Event Name</p></a>
        <p><img src="<?php echo base_url(); ?>assets/front/images/date.png"><span class="event_thumb">May 25<span></p>
        <p><img src="<?php echo base_url(); ?>assets/front/images/time.png"><span class="event_thumb">May 25<span></p>
        <p><img src="<?php echo base_url(); ?>assets/front/images/location.png"><span class="event_thumb">May 25<span></p>
    </div>
  </div>
</div>

  </div>
</div>

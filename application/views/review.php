<div class="container-fluid page-bg">
<div class="">
<div class="row header-title leaderboard-bg">
  <div class="col-md-12">
  <div class="container">
        <p class="leader-title">Heyla is an everything-for-everybody App – Start Exploring Straightaway.</p>
        </div>
  </div>
</div>

<section class="container">
  <div class="leaderboard-menu-tab">
        <div class="row row-offcanvas row-offcanvas-right">
          <div class="col-12 col-md-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
              <a href="#" class="list-group-item "><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="#" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
              <a href="#" class="list-group-item "><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>
              <a href="#" class="list-group-item "><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="#" class="list-group-item active"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <a href="#" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
            <div class="card-header card-header-title">
                           <h3 class="mb-0">Reviews</h3>
            </div>
              <div class="row">
                <div class="col-12 event-wish">
                  <div class="card-group">
                  <div class="card whishlist-card">
                    <div class="card-block">
                    <a href="#">  <h4 class="card-title">Event name</h4></a>
                    <div class="rating" >
                       <span class="user-rating">
                       <input type="radio" name="rating" value="5"><span class="star"></span>

                           <input type="radio" name="rating" value="4"><span class="star"></span>

                           <input type="radio" name="rating" value="3"><span class="star"></span>

                           <input type="radio" name="rating" value="2"><span class="star"></span>

                           <input type="radio" name="rating" value="1"><span class="star"></span>
                       </span>
                      </div>
                      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 event-wish">
                <div class="card-group">
                <div class="card whishlist-card">
                  <div class="card-block">
                  <a href="#">  <h4 class="card-title">Event name</h4></a>
                  <div class="rating" >
                     <span class="user-rating">
                     <input type="radio" name="rating" value="5"><span class="star"></span>

                         <input type="radio" name="rating" value="4"><span class="star"></span>

                         <input type="radio" name="rating" value="3"><span class="star"></span>

                         <input type="radio" name="rating" value="2"><span class="star"></span>

                         <input type="radio" name="rating" value="1"><span class="star"></span>
                     </span>
                    </div>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                  </div>
                </div>
              </div>
            </div>






              </div>
            </div><!--/span-->

        </div><!--/row-->
   </div>
</section>
</div>
</div>
<style>
.user-rating {
    direction: rtl;
    font-size: 15px;
    unicode-bidi: bidi-override;
    padding: 0px 14px;
    display: inline-block;

}
.user-rating input {
    opacity: 0;
    position: relative;
    left: -15px;
    z-index: 2;
    cursor: pointer;
}
.user-rating span.star:before {
    color: #777777;
    content:"ï€†";
    /*padding-right: 5px;*/
}
.user-rating span.star {
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    position: relative;
    z-index: 1;
}
.user-rating span {
    margin-left: -15px;
}
.user-rating span.star:before {
    color: #777777;
    content:"\f006";
    /*padding-right: 5px;*/
}
.user-rating input:hover + span.star:before, .user-rating input:hover + span.star ~ span.star:before, .user-rating input:checked + span.star:before, .user-rating input:checked + span.star ~ span.star:before {
    color: #ffd100;
    content:"\f005";
}

.selected-rating{
    color: #ffd100;
    font-weight: bold;
    font-size: 3em;
}
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

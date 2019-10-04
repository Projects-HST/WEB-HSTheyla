<style>
.review_rating{
  margin-top: 90px;
  margin-bottom: 10px;
}
.review_box{
  padding: 10px;
}
.review_rating_box{
  border: 1px solid #e6e5e5;
}
</style>
<div class="container">
  <div class="row review_rating">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <p class="event_heading">Reviews and Ratings</p>
      <hr>
      <?php
        if (!empty($res_event_review)){

           ?>
          <div class="review_rating_box">
       <?php
          foreach($res_event_review as $result){

             $ratings = $result->event_rating;
      ?>
                <div class="review_section review_box">
                  <p class="review_name"><?php echo $result->user_name; ?>
                    <span class="rated_star">
                      <?php
                           for ($i=1; $i <6; $i++)
                        {
                    if ($i <= $ratings){
                      echo "<img src='".base_url()."assets/front/images/rated.png' class='img-responsive'>";
                    } else {
                      echo "<img src='".base_url()."assets/front/images/unrated.png' class='img-responsive'>";
                    }
                  }
                ?>
                    </span>
                  </p>
                  <p class="review_desc"><?php echo $result->comments;?></p>
                  </div>

       <?php
          }
          ?>
              </div>
       <?php
        }
      ?>
    </div>
  </div>
</div>

<?php $user_id = $this->session->userdata('id'); ?>
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
              <a href="<?php echo base_url(); ?>leaderboard" class="list-group-item "><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="<?php echo base_url(); ?>profile" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
                <a href="<?php echo base_url(); ?>profile_picture" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Display Picture</a>
              <?php $user_role = $this->session->userdata('user_role');
                if($user_role=='2'){ ?>
                    <a href="<?php echo base_url(); ?>createevent" class="list-group-item"><span class="menu-icons"><i class="far fa-plus-square"></i></span>Create event </a>
                    <a href="<?php echo base_url(); ?>viewevents" class="list-group-item"><span class="menu-icons"><i class="fas fa-table"></i></span>View events </a>
                    <a href="<?php echo base_url(); ?>bookedevents" class="list-group-item"><span class="menu-icons"><i class="far fa-list-alt"></i></i></span>Booked Events </a>
                    <a href="<?php echo base_url(); ?>reviewevents" class="list-group-item"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <?php } ?>
              <a href="<?php echo base_url(); ?>booking_history" class="list-group-item "><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>
              <a href="<?php echo base_url(); ?>wishlist" class="list-group-item active"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
              <a href="<?php echo base_url(); ?>logout" class="list-group-item "><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
            <div class="card-header card-header-title">
                           <h3 class="mb-0">Wishlist</h3>
            </div>
              <div class="row">

              <?php
			foreach($wishlist_details as $res){

				$event_id = $res->id * 564738;
				$event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
				$enc_event_id = base64_encode($event_id);

            $string = strip_tags($res->description);
			if (strlen($string) > 150) {

				// truncate string
				$stringCut = substr($string, 0, 150);
				$endPoint = strrpos($stringCut, ' ');

				//if the string doesn't contain any space then it will cut without word basis.
				$string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
				$string .= '...';
			}
?>
                <div class="col-6 event-wish">
                  <div class="card-group">
                  <div class="card whishlist-card">
                    <img class="card-img-top" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" alt="">
                    <div class="card-block">
                    <h4 class="card-title"><a href="<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>/"><?php echo $res->event_name; ?></a></h4>
                      <p class="card-text"><?php echo $string;?></p>
                      <p class="card-text"><small class="text-muted">Last updated on <?php echo $res->wl_updated_at; ?></small></p>
                      <p class="card-text"><a href="<a href='javascript:void(0);' onclick='remove_wishlist(<?php echo $res->wishlist_id; ?>);'>">Remove</a></p>
                    </div>
                  </div>
                </div>
              </div>
<?php
		}
?>

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

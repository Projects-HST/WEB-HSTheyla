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
              <a href="<?php echo base_url(); ?>leaderboard" class="list-group-item "><span class="menu-icons"><i class="fas fa-trophy"></i></span>Dashboard</a>
              <a href="<?php echo base_url(); ?>profile" class="list-group-item"><span class="menu-icons"><i class="fas fa-user"></i></span>Profile</a>
                <a href="<?php echo base_url(); ?>profile_picture" class="list-group-item "><span class="menu-icons"><i class="fas fa-user"></i></span>Display Picture</a>
                 <?php $user_role = $this->session->userdata('user_role');
                if($user_role=='2'){ ?>
                    <a href="<?php echo base_url(); ?>createevent" class="list-group-item"><span class="menu-icons"><i class="far fa-plus-square"></i></span>Create event </a>
                      <a href="<?php echo base_url(); ?>viewevents" class="list-group-item"><span class="menu-icons"><i class="fas fa-table"></i></span>View events </a>
                        <a href="<?php echo base_url(); ?>bookedevents" class="list-group-item"><span class="menu-icons"><i class="far fa-list-alt"></i></i></span>Booked Events</a>
                         <a href="<?php echo base_url(); ?>reviewevents" class="list-group-item active"><span class="menu-icons"><i class="fab fa-wpforms"></i></span>Reviews</a>
              <?php  } ?>
              <a href="<?php echo base_url(); ?>booking_history" class="list-group-item"><span class="menu-icons"><i class="fas fa-book"></i></span>Booking </a>
              <a href="<?php echo base_url(); ?>wishlist" class="list-group-item"><span class="menu-icons"><i class="fas fa-heart"></i></span>Whishlist</a>
              <!--a href="<?php echo base_url(); ?>organizerbooking/messageboard/" class="list-group-item">Messages</a-->
             
              <a href="<?php echo base_url(); ?>logout" class="list-group-item"><span class="menu-icons"><i class="fas fa-sign-out-alt"></i></span>Sign Out</a>
            </div>
          </div><!--/span-->

          <div class="col-12 col-md-9">
       
              <div class="card-header">
				<h3 class="mb-0">Event Reviews</h3>
			</div>

           <div class="card card-outline-secondary" style="padding:5px;">
                  
		<?php if(!empty($views)) { 
				foreach ($views as $value) {  ?>
         <div class="row">
            <div class="col-md-10">
                <div class="card m-b-20 card-block">
                    <h3 class="card-title font-20 mt-0"> <?php echo $value->event_name;?> ( <?php echo $value->event_rating; ?> ) </h3>
                    <p class="card-text">
                     <?php echo $value->comments;?> 
	                </p>
           		</div>
            </div>
        </div>
      <!-- end row -->
        <?php } 
			}else{ 
			echo "<p class=card-text> No Reviews Found </p>";
			}?>

        </div><!-- container -->
                  
					
                  </div>
            </div>
          </div><!--/span-->
        </div><!--/row-->

</section>
</div>
</div>
<style>
div#DataTables_Table_0_filter{
  float: right;
}
.list-group-item{
  border: none;
}
.list-group a{
  color: #000;
}
body{
  background-color: #f6f6f6;
}
.dt-buttons{
  display: none;
}
</style>
<script>
$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

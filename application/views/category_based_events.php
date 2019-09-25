<style>
.catgory_banner_img{
  height: auto;
  width: 100%;
  margin-top: 80px;

}
.category_section{
  margin-top: 20px;
  margin-bottom: 20px;
}
.noevent_section{
  text-align: center;
  margin-top: 150px;
  margin-bottom:100px;
}
</style>
<?php $user_id = $this->session->userdata('id'); ?>
<?php foreach($res_cat as $rows_cat){} ?>
<div class="container-fluid">
  <div class="container">
    <?php if(empty($rows_cat->category_banner)){ ?>
      <img class="catgory_banner_img" src="<?php echo base_url(); ?>assets/front/images/about_usbanner.jpg" alt="First slide" style="">
    <?php }else{ ?>
        <img class="catgory_banner_img" src="<?php echo base_url(); ?>assets/category/<?php echo $rows_cat->category_banner; ?>" alt="First slide" style="">
    <?php } ?>

  </div>
</div>
<div class="container-fluid category_section" id="category_events">
  <div class="container">
    <div class="row event_list" id="event_list_all">
      <?php if(empty($cat_event)){ ?>
        <div class="container noevent_section"><h4>No Events Found</h4></div>
      <?php }else{
        foreach($cat_event as $row_events){ ?>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 event_box">
              <div class="thumbnail event_section">
                  <a href="<?php echo base_url(); ?>eventdetails/<?php echo base64_encode($row_events->id*564738); ?>/<?php echo $row_events->event_name; ?>/">
                    <!-- <img class="event_img" src="https://localhost/heyla/assets/events/banner/156525795427.jpg" alt=""> -->
                    <img class="event_img" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $row_events->event_banner; ?>" alt="">
                  </a>
                <div class="event_thumb">
                  <?php if($row_events->hotspot_status=='N'){ ?>
                    <p><span class=" event_date"><?php echo $row_events->dstart_date; ?> - <?php echo $row_events->dend_date; ?><span></span></span></p>
                  <?php }else{ ?>
                    <p><span class=" event_date"><span></span></span></p>
                  <?php }   ?>

                  <p class="event_heading event_title_heading">
                  <a href="<?php echo base_url(); ?>eventdetails/<?php echo base64_encode($row_events->id*564738); ?>/<?php echo $row_events->event_name; ?>/"><?php echo $row_events->event_name; ?></a></p><p>
                  <span class="event_thumb"><?php echo $row_events->start_time; ?> - <?php echo $row_events->end_time; ?>
                    <span class="pull-right">
                    <?php if($row_events->event_type=='Paid'){ ?>
                      <img src="<?php echo base_url(); ?>assets/front/images/paid.png" class="pull-left pf_btn">
                  <?php  }else{ ?>
                      <img src="<?php echo base_url(); ?>assets/front/images/free.png" class="pull-left pf_btn">
                  <?php  } ?>
                     <span></span></span></span></p>
                </div>
                <p class="price_section">
                  <span class="event_thumb"><?php echo $row_events->city_name; ?><span>
                    <?php if(empty($row_events->wlstatus)){ ?>
                      <span id="wishlist">
                        <a href="javascript:void(0);" onclick="editwishlist(<?php echo $user_id; ?> ,<?php echo $row_events->id; ?>);">
                          <img src="<?php echo base_url(); ?>assets/front/images/fav-unselect.png" class="pull-right">
                        </a>
                      </span>
                  <?php  }else{ ?>
                    <span id="wishlist">
                      <a href="javascript:void(0);" onclick="editwishlist(<?php echo $user_id; ?> ,<?php echo $row_events->id; ?>);">
                        <img src="<?php echo base_url(); ?>assets/front/images/fav-select.png" class="pull-right">
                      </a>
                    </span>
                  <?php   } ?>

                  </span>
                </span>
              </p>
            </div>
          </div>
      <?php   }  } ?>



</div>
</div>
</div>
<script>
function editwishlist(user_id,event_id)
{
	$.ajax({
	url: '<?php echo base_url(); ?>eventlist/eventwishlist',
	type: 'POST',
	data: {user_id : user_id,event_id : event_id},
	success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray =='Added'){
      $('#category_events').load(document.URL + ' #category_events');
		} else {
      $('#category_events').load(document.URL + ' #category_events');
		}
	}
	});
}
</script>

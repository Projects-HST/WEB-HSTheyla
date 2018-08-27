<style>
.wishlist_active{
  border-left: 4px solid #92bce0;
}
.footer_section{
  display: none;
}

</style>

<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">Wishlist</h3>
</div>

<div class="container profile_tab">
              <?php if(empty($wishlist_details)){ echo "<style>.profile_tab{height:100vh;} </style><center><h3>No Wishlist Added</h3></center>"; }else{ foreach($wishlist_details as $res){
                  $event_id = $res->id * 564738;
                  $event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
                  $enc_event_id = base64_encode($event_id);

                  $string = strip_tags($res->description);
                if (strlen($string) > 150) {

                  $stringCut = substr($string, 0, 150);
                  $endPoint = strrpos($stringCut, ' ');

                  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                  $string .= '...';
                } ?>
<style>.profile_tab{
height:100vh;

  }</style>
      <div class="col-xs-18 col-sm-6 col-md-4">
       <div class="thumbnail">
         <img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" alt="" style="height:204px;width:100%;">
           <div class="caption">
             <a href="<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>"><h4><?php echo $res->event_name; ?></h4></a>
             	<!--<p><?php //echo $string;?></p>-->
               <p>Last updated on <?php echo $res->wl_updated_at; ?>
               <a href="<?php echo base_url(); ?>home/removewishlist/<?php echo $res->wishlist_id; ?>" class="btn btn-default btn-xs pull-right" role="button" onclick="return confirm('Are you sure want to Remove?')"><i class="fa fa-trash-o" aria-hidden="true" ></i></a></p>
         </div>
       </div>
     </div>


   <?php  } } ?>

            </div>

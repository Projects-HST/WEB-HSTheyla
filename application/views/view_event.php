<div class="col-md-12" id="content">
  <div class="col-sm-12 col-md-12 " id="content">
      <h3 class="dashboard_tab">View Events</h3>
  </div>
  <?php if(empty($result)){ echo "<center><h3>No Events Added</h3></center>"; }else{
    foreach($result as $rows){
$status=$rows->event_status;
     ?>

<div class="col-xs-18 col-sm-6 col-md-3">
<div class="thumbnail">
<img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $rows->event_banner; ?>" alt="" style="height:204px;">
<div class="caption">
<h4><?php  echo $rows->event_name; ?></h4>
 <p><?php echo $rows->category_name;?></p>
   <p>City <?php echo $rows->city_name; ?><a href="<?php echo base_url();?>home/updateevents/<?php echo base64_encode($rows->id);?>" class="btn btn-default btn-xs pull-right" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></p>
</div>
</div>
</div>


<?php  }} ?>
</div>

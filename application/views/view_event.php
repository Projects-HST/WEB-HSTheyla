<style>
.viewevents_active{
    border-left: 4px solid #458ecc;
}
.event_section{
  height: 100vh;
}
.footer_section{
  display: none;
}
</style>
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">View Events</h3>
</div>
<div class="col-md-12 event_section" id="content">

<div class="col-md-12 ">
  <?php if(empty($result)){ echo "<center><h3>No Events Added</h3></center>"; }else{
    foreach($result as $rows){
$status=$rows->event_status;
$enc_event_id=$rows->id;
     ?>

<div class="col-xs-18 col-sm-6 col-md-3">
<div class="thumbnail">
<img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $rows->event_banner; ?>" alt="" style="height:204px;">
<div class="caption">
<h4><?php $stat=$rows->event_status; if($stat=='Y'){ ?><a target="_blank" href="<?php echo base_url(); ?>eventlist/eventdetails/<?php  echo base64_encode($enc_event_id*564738); ?>/<?php  echo $rows->event_name; ?>"><?php } ?><?php  echo $rows->event_name; ?></a></h4>
 <p><?php echo $rows->category_name;?></p>

   <p>City <?php echo $rows->city_name; ?>
    <?php $stat=$rows->event_status; if($stat=='N'){ ?>
<a href="<?php echo base_url();?>home/updateevents/<?php echo base64_encode($rows->id);?>" class="btn btn-default btn-xs pull-right" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
  <?php  }else{

    }?> </p>
</div>
</div>
</div>


<?php  }} ?>
</div>
</div>

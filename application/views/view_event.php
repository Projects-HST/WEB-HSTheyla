<style>
.viewevents_active{
   	 background-color: #696969;
}
.event_section{
  height: 100vh;
}
.footer_section{
  display: none;
}
</style>
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">Events By Me</h3>
</div>
<div class="col-md-12 event_section" id="content">

<div class="col-md-12 ">
  <?php if(empty($result)){ echo "<center><h3>You haven't added any event yet!</h3></center>"; }else{
    foreach($result as $rows){
		$status=$rows->event_status;
		$enc_event_id=$rows->id;
		$event_name = strtolower(preg_replace("/[^\w]/", "-", $rows->event_name));
     ?>

<div class="col-xs-18 col-sm-6 col-md-3">
<div class="thumbnail">
<img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $rows->event_banner; ?>" alt="" style="height:204px;">
<div class="caption">
<h4 style="height:100px;"><?php $stat=$rows->event_status; if($stat=='Y'){ ?><a target="_blank" href="<?php echo base_url(); ?>eventlist/eventdetails/<?php  echo base64_encode($enc_event_id*564738); ?>/events/"><?php } ?><?php  echo $rows->event_name; ?></a></h4>
 <p><?php echo $rows->category_name;?></p>
 <p><?php echo $rows->city_name; ?>
 <a href="<?php echo base_url();?>booking_plan/<?php echo base64_encode($rows->id);?>" class="btn btn-default btn-xs pull-right" role="button"><i class="fa fa-calendar " aria-hidden="true" title="Booking Plan" ></i></a>
    <?php $stat=$rows->event_status; if($stat=='N'){ ?>
<a href="<?php echo base_url();?>home/updateevents/<?php echo base64_encode($rows->id);?>" class="btn btn-default btn-xs pull-right" role="button" style="margin-right:5px;"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Edit"></i></a>
  <?php  }else{

    }?> </p>
</div>
</div>
</div>


<?php  }} ?>
</div>
</div>

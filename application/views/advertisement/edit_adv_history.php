<?php
    function get_times( $default = '10:00', $interval = '+15 minutes' ) 
   {
      $output = '';
      $current = strtotime( '00:00:00' );
      $end = strtotime( '23:59:00' );
      while( $current <= $end ) {
         $time = date( 'H:i:s', $current );
         $sel = ( $time == $default ) ? ' selected' : '';
         $output .= "<option value=\"{$time}\">" . date( 'h.i A', $current ) .'</option>';
         $current = strtotime( $interval, $current );
      }
      return $output;
    }
?>
<style type="text/css">
   .img-circle{
          width: 90px;
         border-radius: 30px;
       }
</style>

<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">

<!-- Start content ->
<div class="content-page">
<div class="content">
   <!- Top Bar Start ->
   <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <!-li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>
         
            </li->
            <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <!-a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
            <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a->
            <a class="dropdown-item" href="<?php echo base_url(); ?>adminlogin/logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
            </div>
            </li>
         </ul>
         <ul class="list-inline menu-left mb-0">
         <li class="list-inline-item">
         <button type="button" class="button-menu-mobile open-left waves-effect">
         <i class="ion-navicon"></i>
         </button>
         </li>
         <li class="hide-phone list-inline-item app-search">
         <h3 class="page-title">Edit  Advertisement Details</h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
      </div>
      <!- Top Bar End -->
      <div class="page-content-wrapper">
         <div class="container">
            
            <div class="row">
               <div class="col-lg-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit  Advertisement Details </h4>
                        <form  method="post" action="<?php echo base_url();?>advertisement/update_adv_history_all" name="advertisementform" enctype="multipart/form-data" onSubmit='return check();'>
                         <?php foreach($edit AS $res){}?>

                         <div class="form-group row">
                           
                            <label for="stime" class="col-sm-2 col-form-label">Event Name</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" readonly="" value="<?php echo $res->event_name;   ?>">
                            <input type="hidden" class="form-control"  name="event_id" value=" <?php echo $res->event_id;?>" >
                            <input type="hidden" class="form-control"  name="id" value=" <?php echo $res->id;?>" >
                             </div>

                            <label for="etime" class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" readonly="" value=" <?php echo $res->category_name;   ?>">
                            <input type="hidden" class="form-control"  name="category_id" value=" <?php echo $res->category_id;?>" >
                              
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="sdate" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <input type="text" class="form-control"  name="start_date"  value="<?php $date=date_create($res->date_from);echo date_format($date,"m-d-Y");  ?>" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>

                             <label for="edate" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-4">
                               <div class="input-group">
                                <input type="text" class="form-control" required="" name="end_date" value="<?php $date=date_create($res->date_to);echo date_format($date,"m-d-Y");  ?>" id="datepicker">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>
                        </div>
                        <!--div class="form-group row">
                             <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">
                                <select name="start_time" required="" class="form-control" >
                                     <option value="">Select Start Time</option>
                            <option value=""><?php echo get_times(); ?></option>
                        </select>
                            <script language="JavaScript">document.advertisementform.start_time.value="<?php echo $res->time_from; ?>";</script>
                            </div>

                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                                <select name="end_time" required="" class="form-control" >
                                     <option value="">Select End Time</option>
                            <option value=""><?php echo get_times(); ?></option>
                        </select>
                        <script language="JavaScript">document.advertisementform.end_time.value="<?php echo $res->time_to; ?>";</script>
                            </div>

                        </div-->

                        <div class="form-group row">
                            <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">
                               <input  type="text" class="form-control" id="stime" name="start_time" value="<?php echo $res->time_from; ?>">
                            </div>
                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                              <input  type="text" class="form-control" id="etime" name="end_time" value="<?php echo $res->time_to; ?>">
                            </div>
                        </div>


                        <div class="form-group row">
                             <label for="ecost" class="col-sm-2 col-form-label">Plans</label>
                            <div class="col-sm-4">
                                 <select class="form-control" required="" name="adv_plan">
                                    <option value="Free">Select Plans </option>
                                    <?php foreach ($plans as $values) {?>
                                    <option value="<?php echo $values->id; ?>"><?php  echo $values->plan_name; ?></option>
                                   <?php  } ?>
                                  
                                </select>
                                <script language="JavaScript">document.advertisementform.adv_plan.value="<?php echo $res->adv_plan_id; ?>";</script>
                            </div>
                            <label for="Status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                 <script language="JavaScript">document.advertisementform.status.value="<?php echo $res->status; ?>";</script>
                            </div>
                        </div>
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-primary waves-effect waves-light">
                              Update </button>
                             
                           </div>
                     </div>
                     </form>
                  
               </div>
            </div>
            <!-- end row -->
            </div>
         </div>
		   <!-- container -->
      </div>
     <!-- Page content Wrapper -->
   </div>
    <!-- Top Bar Start -->
</div>
<!-- content -->
<script type="text/javascript">
  $('#history').addClass("active");
  $('#advertisement').addClass("has_sub active nav-active");

  $('#stime').timepicki();
  $('#etime').timepicki();


  function check()
    {

      var fdate = document.getElementById("datepicker-autoclose").value;
      var tdate = document.getElementById("datepicker").value;

       //alert(fdate);alert(tdate);
      var chunks = fdate.split('-');
      var formattedDate = chunks[1]+'/'+chunks[0]+'/'+chunks[2];
       //alert(formattedDate);
      var chunks1 = tdate.split('-');
      var formattedDate1 = chunks1[1]+'/'+chunks1[0]+'/'+chunks1[2];
      //alert(formattedDate1);
      //alert( Date.parse(formattedDate));
      //alert( Date.parse(formattedDate1));
      if(Date.parse(formattedDate) > Date.parse(formattedDate1) )
      {
       alert("Startdate should be less than Enddate");
       return false;
      }

      if(Date.parse(formattedDate)==Date.parse(formattedDate1) )
      {
      
        var strStartTime = document.getElementById("stime").value;
        var strEndTime = document.getElementById("etime").value;

        var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
        var endTime = new Date(startTime)
        endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
         
        //var timefrom = date1;
         temp =strStartTime.split(":");
         var a = temp[0];
         var b = temp[1];
         temp1 =b.split(" ");
         var c = temp1[1]
       
        if(a==12 && c=='AM'){
        
        }else if (startTime > endTime){
          alert("Start Time is greater than end time");
          return false;
        }
    }else{
      var date1 = new Date(formattedDate);
      var date2 = new Date(formattedDate1);

      var strStartTime = document.getElementById("stime").value;
      var strEndTime = document.getElementById("etime").value;
      var startTime = date1.setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
      var endTime = new Date(startTime);
       endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);
      var a=formattedDate + '' + strStartTime;
      var b=formattedDate1 + '' + strEndTime;
      //alert(startTime);alert(endTime); alert(a);alert(b); 
      if (a == b || a > b) {
      alert("Start Date & Time is greater than end Date & Time");
      return false;
      }
    }
      function GetHours(d) 
      {
        var h = parseInt(d.split(':')[0]);
        if (d.split(':')[1].split(' ')[1] == "PM") {
        h = h + 12;
      }
      return h;
      }
      function GetMinutes(d) 
      {
       return parseInt(d.split(':')[1].split(' ')[0]);
      }
}
</script>

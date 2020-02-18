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

      <div class="page-content-wrapper">
         <div class="container">

            <div class="row">
               <div class="col-lg-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Edit Advertisement Details</h4>
                        <form  method="post" action="<?php echo base_url();?>advertisement/update_adv_history_all" name="advertisementform" enctype="multipart/form-data" id="aform" onSubmit='return check();'>
                         <?php foreach($edit AS $res){}?>

                         <div class="form-group row">
                            <label for="stime" class="col-sm-2 col-form-label">Event Name</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" readonly="" value="<?php echo htmlentities($res->event_name);   ?>">
                             </div>

                            <label for="etime" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" readonly="" value="<?php echo $res->category_name;   ?>">
								
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="sdate" class="col-sm-2 col-form-label">Start Date <span class="error">*</span></label>
                            <div class="col-sm-4">

                                <input type="text" class="form-control datepicker"  name="start_date" readonly="" value="<?php $date=date_create($res->date_from);echo date_format($date,"d-m-Y");  ?>" id="datepicker1">

                            </div>

                             <label for="edate" class="col-sm-2 col-form-label">End Date <span class="error">*</span></label>
                            <div class="col-sm-4">

                                <input type="text" class="form-control datepicker" readonly="" name="end_date" value="<?php $date=date_create($res->date_to);echo date_format($date,"d-m-Y");  ?>" id="datepicker2">

                            </div>
                        </div>



                         <!-- <div class="form-group row">
                            <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">
                               <input  type="text" class="form-control" id="stime" name="start_time" value="<?php echo $res->time_from; ?>">
                            </div>
                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                              <input  type="text" class="form-control" id="etime" name="end_time" value="<?php echo $res->time_to; ?>">
                            </div>
                        </div> -->


                        <div class="form-group row">
                             <label for="ecost" class="col-sm-2 col-form-label">Plan <span class="error">*</span></label>
                            <div class="col-sm-4">
                                 <select class="form-control" name="adv_plan" readonly="">
                                    <?php foreach ($plans as $values) {?>
                                    <option value="<?php echo $values->id; ?>"><?php  echo $values->plan_name; ?></option>
                                   <?php  } ?>

                                </select>
                                <script language="JavaScript">document.advertisementform.adv_plan.value="<?php echo $res->adv_plan_id; ?>";</script>
                            </div>
                            <label for="Status" class="col-sm-2 col-form-label">Banner Status <span class="error">*</span></label>
                            <div class="col-sm-4">
                               <select class="form-control" name="status">
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                </select>
                                 <script language="JavaScript">document.advertisementform.status.value="<?php echo $res->status; ?>";</script>
                            </div>
                        </div>

                         <div class="form-group row">
                             <label for="Banner" class="col-sm-2 col-form-label">Banner</label>
                            <div class="col-sm-4">
                                <input type="file" name="eventbanner" id="eventbanner" class="form-control" accept="image/*" >
                                <input type="hidden" name="currentcpic" class="form-control" value="<?php echo $res->banner;?>" >
                            </div>
                            <div class="col-sm-4"><img src="<?php echo base_url(); ?>assets/events/slider/<?php echo $res->banner; ?>" class="img-circle">
                            </div>
                        </div>
					
                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
							  <input type="hidden" class="form-control"  name="event_id" value="<?php echo $res->event_id;?>" >
                            <input type="hidden" class="form-control"  name="id" value="<?php echo $res->id;?>" >
							<input type="hidden" class="form-control"  name="category_id" value="<?php echo $res->category_id;?>" >
                              <button type="submit" class="btn btn-success waves-effect waves-light">
                              Save </button>
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

  $('#list').addClass("active");
  $('#advertisement').addClass("has_sub active nav-active");

  $('#stime').timepicki();
  $('#etime').timepicki();

 $(document).ready(function () {
  $( ".datepicker" ).datepicker({
        format: 'dd-mm-yyyy',
		 autoclose: true
      });

  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, 'File size must be less than 1 MB');
  
    $('#aform').validate({ // initialize the plugin
       rules: {
         start_date:{required:true },
         end_date:{required:true },
         start_time:{required:true },
         end_time:{required:true },
         adv_plan:{required:true },
		 eventbanner:{required:false,accept: "jpg,jpeg,png", filesize: 1048576  },
         status:{required:true }
        },
        messages: {
        start_date:"Select start date",
        start_time:"Select start time",
        end_date:"Select end date",
        end_time:"Select end time",
        adv_plan:"Select plan",
		eventbanner:{
          accept:"Please upload .jpg or .png .",
          fileSize:"File must be JPG or PNG, less than 1MB"
        },
        status:"Select status",
               },
         });
   });
  function check()
    {

      var fdate = document.getElementById("datepicker1").value;
      var tdate = document.getElementById("datepicker2").value;

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
      var y1=chunks[2];
      var y2=chunks1[2];
      if(y1<y2){
            //alert(chunks[2]);alert(chunks1[2]);
        }else{
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
            return false; }
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

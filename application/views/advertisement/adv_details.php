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
                        <h4 class="mt-0 header-title"> Add  Advertisement Details </h4>
                        <form  method="post" action="<?php echo base_url();?>advertisement/add_adv_history" name="advertisementform" id="aform" enctype="multipart/form-data" onSubmit='return check();'>
                         <?php //echo $event_id;   echo $category_id;?>
                       <div class="form-group row">
                            <label for="sdate" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-4">

                                <input type="text" class="form-control datepicker"  name="start_date" id="datepicker-autoclose" autocomplete="off" >


                           <input type="hidden" class="form-control"  name="event_id" value=" <?php echo $event_id;   ?>">
                            <input type="hidden" class="form-control"  name="category_id" value=" <?php echo $category_id;?>" >

                            </div>

                             <label for="edate" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-4">

                                <input type="text" class="form-control datepicker"  name="end_date" id="datepicker"  autocomplete="off">


                            </div>
                        </div>

                          <!-- <div class="form-group row">
                            <label for="stime" class="col-sm-2 col-form-label">Start Time</label>
                            <div class="col-sm-4">
                               <input  type="text" class="form-control" id="stime" name="start_time">

                            </div>
                             <label for="etime" class="col-sm-2 col-form-label">End Time</label>
                            <div class="col-sm-4">
                              <input  type="text" class="form-control" id="etime" name="end_time" >

                            </div>
                        </div> -->


                        <div class="form-group row">
                             <label for="ecost" class="col-sm-2 col-form-label">Plan</label>
                            <div class="col-sm-4">
                                 <select name="adv_plan" class="form-control">
                                    <?php foreach ($plans as $values) { ?>
                                    <option value="<?php echo $values->id; ?>"> <?php  echo $values->plan_name; ?>
                                    </option>
                                   <?php  } ?>

                                </select>
                            </div>
                            <label for="Status" class="col-sm-2 col-form-label">Banner Status</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="status">
                                    <option value="">Select status</option>
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                             <label for="Banner" class="col-sm-2 col-form-label">Banner </label>
                            <div class="col-sm-4">
                                <input type="file" name="eventbanner" id="file_upload" class="form-control" accept="image/*" >
                                <span style="color: red;">Size: 985*550px</span>
                            </div>
                            <div class="col-sm-4">
                            </div>
                        </div

                           <div class="form-group">
                              <label class="col-sm-4 col-form-label"></label>
                              <button type="submit" class="btn btn-success waves-effect waves-light">
                              Add </button>

                           </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- end row -->
            <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title">View Advertisement Plans</h4>

                           <?php if($this->session->flashdata('msg')): ?>
                             <div class="alert <?php $msg=$this->session->flashdata('msg');
                             if($msg=='Advertisement details added' || $msg=='Changes made are saved'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>

                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
							                   <th>S.No</th>
                                 <th>Event Name</th>
                                 <th>Category Name</th>
                                 <th>From Date</th>
                                 <th>To Date</th>
                                 <!-- <th>From Time</th>
                                 <th>To Time</th> -->
                                 <th>Plan Name</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
						            <?php
                                $i=1;
                                foreach($result as $rows) {
                                  $status=$rows->status;
                                  $adid=$rows->id;
                                ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->event_name; ?></td>
                                 <td> <?php echo $rows->category_name; ?></td>
                                 <td><?php  $date=date_create($rows->date_from);
                                       echo date_format($date,"d-m-Y");  ?></td>
                                 <td> <?php $date=date_create($rows->date_to);
                                       echo date_format($date,"d-m-Y");  ?></td>
                                 <!-- <td><?php echo date("g:i a",strtotime("$rows->time_from")); ?></td>
                                 <td> <?php echo date("g:i a",strtotime("$rows->time_to")); ?></td> -->
                                 <td><?php  echo $rows->plan_name; ?></td>
                                 <td><?php if($status=='Y'){ echo'<button type="button" class="btn btn-secondary btn-success btn-sm"> Active </button>'; }else{ echo'<button type="button" class="btn btn-secondary btn-primary btn-sm"> Inactive </button>'; }?></td>
                                 <td> <a href="<?php echo base_url();?>advertisement/edit_history/<?php echo $rows->id;?>">
                                  <img title="Edit" src="<?php echo base_url();?>assets/icons/edit.png" /></a>
                                 <!--a onclick="confirmGetMessage(<?php echo $adid;?>)">
                                 <img title="Delete" src="<?php echo base_url();?>assets/icons/delete.png"/></a-->
                               </td>
                             </td>
                              </tr>
                             <?php $i++;  }  ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
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
function confirmGetMessage(adid)
  {
    var r=confirm("Do you want to delete this?")
    if (r==true) {
    $.ajax({
      url: "<?php echo base_url(); ?>advertisement/delete_history",
      type: 'POST',
      data: { advid: adid },
      success: function(response) {
      //alert(response);exit;
          if (response == "success") {
              swal({
                  title: "Success",
                  text: "Deleted Successfully",
                  type: "success"
              }).then(function() {
                  location.href = '<?php echo base_url(); ?>advertisement/view_adv_plan';
              });
          } else {
              sweetAlert("Oops...", response, "error");
          }
      }
    });
    }else{
        swal("Cancelled", "Process Cancel :)", "error");
       }
 }

 $(document).ready(function ()
 {

    $( ".datepicker" ).datepicker({
      format: 'dd-mm-yyyy'


});

    $('#aform').validate({ // initialize the plugin
       rules: {
         start_date:{required:true },
         end_date:{required:true },
         start_time:{required:true },
         end_time:{required:true },
         adv_plan:{required:true },
         status:{required:true }
        },
        messages: {
        start_date:"This field cannot be empty!",
        start_time:"Select start time",
        end_date:"This field cannot be empty!",
        end_time:"Select end time",
        adv_plan:"Select plan ",
        status:"Select status",
               },
         });
   });
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

<?php  $user_id = $this->session->userdata('id');?>
<style>
.navbar {
  border-bottom: 1px solid #dad9d9;
}

hr{
  border-color: #fff;
}

.total_bor{
  opacity: 0.5;
}
</style>

<div class="container-fluid">
    <div class="row order_page">
      <?php
      if(empty($booking_process)){ ?>
			<div class="col-md-12 text-center" style="margin-top:100px;"><h3>Something went wrong! Please try again later.</h3></div>
      <?php } else {

      		foreach($booking_process as $res){
      			$originalDate = $res->show_date;;
      		}
      ?>

      <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 no_padding box_grey_border">
        <div class="summary_box">Order Summary</div>
          <div class="row">
            <div class="col"><p class="summary_label summary_text">Order ID: </p></div>
            <div class="col"><p class="summary_text"><?php echo $res->order_id;?></p></div>

         </div>
           <div class="row">
             <div class="col"><p class="summary_label summary_text">Ticket Plan: </p></div>
             <div class="col"><p class="summary_text"><?php echo $res->plan_name;?></p></div>

          </div>
          <div class="row">
            <div class="col"><p class="summary_label summary_text">Date: </p></div>
            <div class="col"><p class="summary_text"><?php echo  date("d-m-Y", strtotime($originalDate)) ?></p></div>

         </div>
         <div class="row">
           <div class="col"><p class="summary_label summary_text">Time: </p></div>
           <div class="col"><p class="summary_text"><?php echo $res->show_time;?></p></div>

        </div>
        <div class="row">
          <div class="col"><p class="summary_label summary_text">No.of Seats: </p></div>
          <div class="col"><p class="summary_text"><?php echo $res->event_name;?></p></div>

       </div>
         <div class="row">
           <div class="col"><p class="summary_label summary_text">Event: </p></div>
             <div class="col"><p class="summary_text"><?php echo $res->number_of_seats;?></p></div>

        </div>
          <div class="row">
            <div class="col"><p class="summary_label summary_text">Category: </p></div>
              <div class="col"><p class="summary_text"><?php echo $res->category_name;?></p></div>

         </div>
         <div class="row">
           <div class="col"><p class="summary_label summary_text">Event Venue: </p></div>
             <div class="col"><p class="summary_text"><?php echo $res->event_venue;?></p></div>

        </div>
        <div class="row">
          <div class="col"><p class="summary_label summary_text">Event Address: </p></div>
            <div class="col"><p class="summary_text"><?php echo $res->event_address;?></p></div>

       </div>

      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <div class="payment_summary">
          <p class="payment_heading" style="font-weight:bold;">Payment</p>
            <hr>
           <div class="row">
             <div class="col"><p class="payment_heading">Ticket Price</p></div>
             <div class="col"><p class="payment_heading">₹ <?php echo $res->booking_amount;?></p></div>

           </div>
           <div class="row">
             <div class="col"><p class="payment_heading">Booking Fee</p></div>
             <div class="col"><p class="payment_heading">₹ <?php echo $res->IHC;?></p></div>

           </div>
           <div class="row">
             <div class="col"><p class="payment_heading">GST (18%)</p></div>
             <div class="col"><p class="payment_heading">₹ <?php echo $res->CGST;?></p></div>

           </div>
           <br>
             <hr>
             <div class="row">
               <div class="col"><p class="payment_heading">Total</p></div>
                <div class="col"><p class="payment_heading">₹ <?php echo number_format($res->total_amount,2);?></p></div>

             </div>
             <hr>
             <br>
             <div class="row">
                <div class="col text-center">
                  <div id="strclock" style="text-align: center;"></div>
                  <!--<div id="clock" style="text-align: center;">until timer runs out!</div>-->
				  <div id="clock" style="text-align: center;">Until timer runs out!</div>
                </div>
             </div>
             <div class="row">
               <div class="col text-center">
                 <form method="post" name="OrderData" class="confirm_process" action="<?php echo base_url(); ?>eventlist/payment_gateway/">
                   <input type="hidden" name="order_id" value="<?php echo $res->order_id;?>"/>
                   <input type="hidden" name="payment_type" value="paytm"/>
                   <INPUT type="submit" value="CheckOut" class="btn btn-primary" style="width:200px;">
                </form>
               </div>

             </div>


      </div>
        </div>
  <?php } ?>
    </div>

</div>

<script type="text/javascript">

	//window.onbeforeunload = function() {
	//  return "Data will be lost if you leave the page, are you sure?";
	//};

    var hour = 0
    var min = 5;
    var sec = 00;

    function countdown() {
    if(sec <= 0 && min > 0) {
        sec = 60;
        min -= 1;
    }
    else if(min <= 0 && sec <= 0) {
        min = 0;
        sec = 0;
    }
    else {
        sec -= 1;
    }
    if(min <= 0 && hour > 0) {
        min = 60;
        hour -= 1;
    }
    var pat = /^[0-9]{1}$/;
    secs = (pat.test(sec) == true) ? '0'+sec : sec;
    mins = (pat.test(min) == true) ? '0'+min : min;
    hours = (pat.test(hour) == true) ? '0'+hour : hour;

    document.getElementById('strclock').innerHTML = hours+":"+mins+":"+secs;
	//document.getElementById('strclock').innerHTML = hours+":"+mins+":"+secs+" until timer runs out!";
   /*  if(hour >= 1) {
           document.getElementById('clock').innerHTML = hour+1+' hour until timer runs out!';
    }
    else if(min >= 1) {
           document.getElementById('clock').innerHTML = min+' minutes until time runs out!';
    }
    else {
           document.getElementById('clock').innerHTML = sec+' seconds until timer runs out!';
    } */
   var time = document.getElementById('strclock').innerHTML;
        if(time == '00:00:00') {
			swal("You've exceeded your booking time limit!");
            //alert(" You've exceeded your booking time limit!");
            window.location="<?php echo base_url(); ?>";
        } else{
            setTimeout("countdown()",1000);
        }
    }
    countdown();
    </script>

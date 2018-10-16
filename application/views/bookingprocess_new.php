<?php
//$booking_expire = $_SESSION['booking_expire'];
$user_id = $this->session->userdata('id');

foreach($booking_process as $res){
		$originalDate = $res->show_date;;
}
//$IHC = "0.00";
//$CGST = "0.00";
//$SGST = "0.00";
?>
<style>
.navbar {
  border-bottom: 1px solid #dad9d9;
}
.order_page{
  padding-top: 100px;
  padding-bottom: 0px;
  margin-left: 50px;
  margin-right: 50px;
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
    <div class="col-md-8">
      <div class="summary_box">Order Summary</div>
      <div class="col-md-12 col-sm-12 summary_card">
        <div class="row">
          <div class="col-md-5 col-sm-2"><p class="summary_label summary_text">Order id</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6 col-sm-6"><p class="summary_text"><?php echo $res->order_id;?></p></div>
        </div>
		<div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Booking Plan</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text"><?php echo $res->plan_name;?></p></div>
        </div>
		<div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Show date</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text"><?php echo  date("d-m-Y", strtotime($originalDate)) ?></p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Show time</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text"><?php echo $res->show_time;?></p></div>
        </div>
		<div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">No.of Seats</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text"><?php echo $res->number_of_seats;?></p></div>
        </div>
		
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Name</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text"><?php echo $res->event_name;?></p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Category Name</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text"><?php echo $res->category_name;?></p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Venue</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text"><?php echo $res->event_venue;?></p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Address</p></div>
          <div class="col-md-1 text-center"><p class="summary_text  dot">:</p></div>
          <div class="col-md-6"><p class="summary_text"><?php echo $res->event_address;?></p></div>
        </div>

      </div>

    </div>
    <div class="col-md-4">
      <div class="payment_summary">
        <p class="payment_heading" style="font-weight:bold;">Payment Summary</p>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <p class="payment_heading">Price</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-5">
              <p class="payment_heading">₹ <?php echo $res->booking_amount;?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <p class="payment_heading">Booking Fees</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-5">
              <p class="payment_heading">₹ <?php echo $res->IHC;?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <p class="payment_heading">GST (18%)</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-5">
              <p class="payment_heading">₹ <?php echo $res->CGST;?></p>
          </div>
        </div><!--
        <div class="row">
          <div class="col-md-7">
            <p class="payment_heading">SGST</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-4">
              <p class="payment_heading">₹ <?php echo $res->SGST;?></p>
          </div>
        </div>-->
          <hr class="total_bor">
        <div class="row">

          <div class="col-md-6">
            <p class="payment_heading">Total</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-5">
              <p class="payment_heading">₹ <?php echo number_format($res->total_amount,2);?></p>
          </div>

        </div>
        <hr class="total_bor">

        <div id="strclock" style="text-align: center;"></div>
        <div id="clock" style="text-align: center;"></div>

		<form method="post" name="OrderData" class="confirm_process" action="<?php echo base_url(); ?>eventlist/payment_gateway/">
			<input type="hidden" name="order_id" value="<?php echo $res->order_id;?>"/>
			<input type="hidden" name="payment_type" value="paytm"/>
			<INPUT type="submit" value="CheckOut" class="btn btn-primary" style="width:200px;">
        </form>
<!--
	    <form method="post" name="OrderData" class="confirm_process" action="">
			<INPUT type="button" value="CheckOut" class="btn btn-primary" style="width:200px;" onclick="alert('Waiting for Payment Gateway')">
		</form>
        <form method="post" name="customerData" id='ccaven' class="confirm_process" action="http://hobbistan.com/web/ccavenue/ccavRequestHandler.php">
			<input type="hidden" name="merchant_id" value="89958"/>
			<input type="hidden" name="order_id" value="<?php echo $res->order_id;?>"/>
			<input type="hidden" name="amount" value="<?php echo $res->total_amount;?>"/>
			<input type="hidden" name="currency" value="INR"/>
			<input type="hidden" name="redirect_url" value="http://hobbistan.com/web/ccavenue/ccavResponseHandler.php"/>
			<input type="hidden" name="cancel_url" value="https://heylaapp.com/eventlist/"/>
			<input type="hidden" name="language" value="EN"/>
			<INPUT type="submit" value="CheckOut" class="btn btn-primary" style="width:200px;">
        </form>
-->
      </div>
    </div>
    <center>  <img src="<?php echo base_url(); ?>assets/front/images/login_bg.png" class="img-thumbnail"> </center>
  </div>
</div>
<script type="text/javascript">
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
    if(hour >= 1) { 
           document.getElementById('clock').innerHTML = hour+1+' hour until timer runs out!';
    } 
    else if(min >= 1) {
           document.getElementById('clock').innerHTML = min+' minute until timer runs out!';
    }
    else {
           document.getElementById('clock').innerHTML = sec+' seconds until timer runs out!';
    }
   var time = document.getElementById('strclock').innerHTML;
   
        if(time == '00:00:00') {
            alert("You have exceeded the time limit and your booking has been released.");
            window.location="http://heylaapp.com";
        } else{ 
            setTimeout("countdown()",1000);
        }
    }
    countdown();
    </script>
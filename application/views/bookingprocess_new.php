<?php
$user_id = $this->session->userdata('id');
foreach($booking_process as $res){
		$originalDate = $res->show_date;;
}
$IHC = "0.00";
$CGST = "0.00";
$SGST = "0.00";
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
.img-thumbnail{
  margin-top: -150px;
}
</style>
<div class="container-fluid">
  <div class="row order_page">
    <div class="col-md-8">
      <div class="summary_box">
        Order Summary
      </div>
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
        <p class="payment_heading">Payment Summary</p>
        <hr>
        <div class="row">
          <div class="col-md-7">
            <p class="payment_heading">Booking Price</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-4">
              <p class="payment_heading">₹<?php echo $res->total_amount;?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-7">
            <p class="payment_heading">Internet Handing Charges</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-4">
              <p class="payment_heading">₹<?php echo $IHC;?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-7">
            <p class="payment_heading">CGST</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-4">
              <p class="payment_heading">₹<?php echo $CGST;?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7">
            <p class="payment_heading">SGST</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-4">
              <p class="payment_heading">₹<?php echo $SGST;?></p>
          </div>
        </div>
          <hr class="total_bor">
        <div class="row">

          <div class="col-md-7">
            <p class="payment_heading">Total</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-4">
              <p class="payment_heading">₹<?php echo $res->total_amount;?></p>
          </div>

        </div>
        <hr  class="total_bor">
        <form method="post" name="customerData"  class="confirm_process" action="http://hobbistan.com/web/ccavenue/ccavRequestHandler.php">
                    <input type="hidden" name="merchant_id" value="89958"/>
                    <input type="hidden" name="order_id" value="<?php echo $res->order_id;?>"/>
                    <input type="hidden" name="amount" value="<?php echo $res->total_amount;?>"/>
                    <input type="hidden" name="currency" value="INR"/>
                    <input type="hidden" name="redirect_url" value="http://hobbistan.com/web/ccavenue/ccavResponseHandler.php"/>
                    <input type="hidden" name="cancel_url" value="https://heylaapp.com/eventlist/"/>
                    <input type="hidden" name="language" value="EN"/>
                    <INPUT type="submit" value="CheckOut" class="btn btn-primary">
            </form>
      </div>
    </div>
    <center>  <img src="<?php echo base_url(); ?>assets/front/images/login_bg.png" class="img-thumbnail"> </center>
  </div>
</div>
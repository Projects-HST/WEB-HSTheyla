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
          <div class="col-md-6 col-sm-6"><p class="summary_text">Order id</p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Name</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text">Event Name</p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Category Name</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text">Category</p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Venue</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text">Event</p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Address</p></div>
          <div class="col-md-1 text-center"><p class="summary_text  dot">:</p></div>
          <div class="col-md-6"><p class="summary_text">Address</p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Show date</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text">Show date</p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Event Show time</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text">Event Show time</p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Booking Plan</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text">Booking</p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Booking Seats</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text">Booking</p></div>
        </div>
        <div class="row">
          <div class="col-md-5"><p class="summary_label summary_text">Booking Amount</p></div>
          <div class="col-md-1 text-center"><p class="summary_text dot">:</p></div>
          <div class="col-md-6"><p class="summary_text">Booking</p></div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center" style="margin-top:20px;">
           <form method="post" name="customerData"  class="confirm_process" action="http://hobbistan.com/web/ccavenue/ccavRequestHandler.php">
                          <input type="hidden" name="merchant_id" value="89958"/>
                          <input type="hidden" name="order_id" value="order_id"/>
                          <input type="hidden" name="amount" value="total_amount"/>
                          <input type="hidden" name="currency" value="INR"/>
                          <input type="hidden" name="redirect_url" value="http://hobbistan.com/web/ccavenue/ccavResponseHandler.php"/>
                          <input type="hidden" name="cancel_url" value="https://heylaapp.com/eventlist/"/>
                          <input type="hidden" name="language" value="EN"/>
                          <INPUT type="submit" value="CheckOut" class="btn btn-primary">
        </form>
          </div>

        </div>


      </div>

    </div>
    <div class="col-md-4">
      <div class="payment_summary">
        <p class="payment_heading">Payment Summary</p>
        <hr>
        <div class="row">
          <div class="col-md-4">
            <p class="payment_heading">Total</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-7">
              <p class="payment_heading">Total</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <p class="payment_heading">Total</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-7">
              <p class="payment_heading">Total</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <p class="payment_heading">Total</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-7">
              <p class="payment_heading">Total</p>
          </div>
        </div>

          <hr class="total_bor">
        <div class="row">

          <div class="col-md-4">
            <p class="payment_heading">Total</p>
          </div>
          <div class="col-md-1">
            <p class="payment_heading dot">:</p>
          </div>
          <div class="col-md-7">
              <p class="payment_heading">Total</p>
          </div>

        </div>
        <hr  class="total_bor">
        <center>  <INPUT type="submit" value="CheckOut" class="btn btn-primary"></center>
      </div>
    </div>
    <center>  <img src="<?php echo base_url(); ?>assets/front/images/login_bg.png" class="img-thumbnail"> </center>
  </div>
</div>

<?php $order_id = $this->uri->segment(3); ?>
<div class="container-fluid">
    <div class="row">
      <div class="container">
        <div class="col-md-12 payment_msg">
			<center><img src="<?php  echo base_url(); ?>assets/front/images/success.png" style="margin-bottom:15px;">
             <br>
            <h1>Payment Refund</h1>
            <p class="payment_success">Your payment has been received successfully. For other details regarding the payment visit your booking details page. We have sent an email to you with order details. If you have queries contact us.</p>
			
         <form id="refund" name="refund" class="form-inline" method="post" action="<?php echo base_url(); ?>home/requestrefund">
         	<input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id; ?>" />
            <br>
            <input type="submit" class="btn btn-primary" name="button" id="button" value="Submit" />
         </form>
		 
		 </center>
        </div>
      </div>
	</div>
</div>
<style>
.payment_msg{
  margin-top: 150px;
  margin-bottom: 150px;
}
.payment_success{
  width: 600px;
    font-size: 18px;
}
</style>

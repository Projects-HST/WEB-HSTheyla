<?php
foreach($booking_result as $res){
		$originalDate = $res->show_date;
}
?>
<html>
<body>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
         $("#paytm").submit();
    });
    </script>
	<form method="post" name="paytm" id='paytm' class="confirm_process" action="https://heylaapp.com/paytm_web/pgRedirect.php">
		<input type="hidden" name="ORDER_ID" value="<?php echo $res->order_id;?>"/>
		<input type="hidden" name="CUST_ID" value="123456"/>
		<input type="hidden" name="INDUSTRY_TYPE_ID" value="Retail109"/>
		<input type="hidden" name="CHANNEL_ID" value="WAP"/>
		<input type="hidden" name="TXN_AMOUNT" value="<?php echo $res->total_amount;?>"/>
	</form>

<!--
 <div style="text-align:center"><a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/heyla_logo.png" class="imglogo"></a></div>
	<form method="post" name="paytm" id='paytm' class="confirm_process" action="http://hobbistan.com/web/paytmue/ccavRequestHandler.php">
		<input type="hidden" name="merchant_id" value="89958"/>
		<input type="hidden" name="order_id" value="<?php echo $res->order_id;?>"/>
		<input type="hidden" name="amount" value="<?php echo $res->total_amount;?>"/>
		<input type="hidden" name="currency" value="INR"/>
		<input type="hidden" name="redirect_url" value="http://hobbistan.com/web/paytmue/ccavResponseHandler.php"/>
		<input type="hidden" name="cancel_url" value="https://heylaapp.com/"/>
		<input type="hidden" name="language" value="EN"/>
	</form>
-->
</body>
</html>
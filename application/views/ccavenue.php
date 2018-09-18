<html>
<body>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
     $("#ccaven").submit();
});
</script>
<?php
foreach($booking_result as $res){
		$originalDate = $res->show_date;;
}
?>
 <div style="text-align:center"><a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/heyla_logo.png" class="imglogo"></a></div>
 
	<form method="post" name="ccaven" id='ccaven' class="confirm_process" action="http://hobbistan.com/web/ccavenue/ccavRequestHandler.php">
		<input type="hidden" name="merchant_id" value="89958"/>
		<input type="hidden" name="order_id" value="<?php echo $res->order_id;?>"/>
		<input type="hidden" name="amount" value="<?php echo $res->total_amount;?>"/>
		<input type="hidden" name="currency" value="INR"/>
		<input type="hidden" name="redirect_url" value="http://hobbistan.com/web/ccavenue/ccavResponseHandler.php"/>
		<input type="hidden" name="cancel_url" value="https://heylaapp.com/testing/"/>
		<input type="hidden" name="language" value="EN"/>
		<!--<INPUT type="submit" value="CheckOut" class="btn btn-primary" style="width:200px;">-->
	</form>
</body>
</html>
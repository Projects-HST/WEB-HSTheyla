<?php 
$user_id = $this->session->userdata('id'); ?>
<div class="container-fluid eventlist-pge">
   <div class="container" style="min-height:400px;">
   
		<?php foreach($booking_process as $res){ } ?>
        <table width="100%" border="0" cellpadding="3" cellspacing="3">
  <tr>
    <td width="50%">order_id</td>
    <td width="50%"><?php echo $res->order_id;?></td>
  </tr>
  <tr>
    <td>event_name</td>
    <td><?php echo $res->order_id;?></td>
  </tr>
  <tr>
    <td>category_name</td>
    <td><?php echo $res->order_id;?></td>
  </tr>
  <tr>
    <td>event_venue</td>
    <td><?php echo $res->event_venue;?></td>
  </tr>
  <tr>
    <td>event_address</td>
    <td><?php echo $res->event_address;?></td>
  </tr>
  <tr>
    <td>show_date</td>
    <td><?php echo $res->show_date;?></td>
  </tr>
  <tr>
    <td>show_time</td>
    <td><?php echo $res->show_time;?></td>
  </tr>
  <tr>
    <td>plan_name</td>
    <td><?php echo $res->plan_name;?></td>
  </tr>
  <tr>
    <td>number_of_seats</td>
    <td><?php echo $res->number_of_seats;?></td>
  </tr>
  <tr>
    <td>total_amount</td>
    <td><?php echo $res->total_amount;?></td>
  </tr>
      </table>
      <form method="post" name="customerData" action="http://hobbistan.com/web/ccavenue/ccavRequestHandler.php">
        	<input type="hidden" name="merchant_id" value="89958"/>
            <input type="hidden" name="order_id" value="<?php echo $res->order_id;?>"/>
            <input type="hidden" name="amount" value="<?php echo $res->total_amount;?>"/>
            <input type="hidden" name="currency" value="INR"/>
            <input type="hidden" name="redirect_url" value="http://hobbistan.com/web/ccavenue/ccavResponseHandler.php"/>
            <input type="hidden" name="cancel_url" value="http://heylaapp.com/heylav2/eventlist/"/>
            <input type="hidden" name="language" value="EN"/>
            <INPUT type="submit" value="CheckOut">
 	</form>
<!--
				<tr>
		     		<td colspan="2">Billing information(optional):</td>
		     	</tr>
		        <tr>
		        	<td>Billing Name	:</td><td><input type="text" name="billing_name" value="Charli"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Address	:</td><td><input type="text" name="billing_address" value="Room no 1101, near Railway station Ambad"/></td>
		        </tr>
		        <tr>
		        	<td>Billing City	:</td><td><input type="text" name="billing_city" value="Indore"/></td>
		        </tr>
		        <tr>
		        	<td>Billing State	:</td><td><input type="text" name="billing_state" value="MP"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Zip	:</td><td><input type="text" name="billing_zip" value="425001"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Country	:</td><td><input type="text" name="billing_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Tel	:</td><td><input type="text" name="billing_tel" value="9876543210"/></td>
		        </tr>
		        <tr>
		        	<td>Billing Email	:</td><td><input type="text" name="billing_email" value="test@test.com"/></td>
		        </tr>
		        <tr>
		        	<td colspan="2">Shipping information(optional)</td>
		        </tr>
		        <tr>
		        	<td>Shipping Name	:</td><td><input type="text" name="delivery_name" value="Chaplin"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Address	:</td><td><input type="text" name="delivery_address" value="room no.701 near bus stand"/></td>
		        </tr>
		        <tr>
		        	<td>shipping City	:</td><td><input type="text" name="delivery_city" value="Hyderabad"/></td>
		        </tr>
		        <tr>
		        	<td>shipping State	:</td><td><input type="text" name="delivery_state" value="Andhra"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Zip	:</td><td><input type="text" name="delivery_zip" value="425001"/></td>
		        </tr>
		        <tr>
		        	<td>shipping Country	:</td><td><input type="text" name="delivery_country" value="India"/></td>
		        </tr>
		        <tr>
		        	<td>Shipping Tel	:</td><td><input type="text" name="delivery_tel" value="9876543210"/></td>
		        </tr>
		        <tr>
		        	<td>Merchant Param1	:</td><td><input type="text" name="merchant_param1" value="additional Info."/></td>
		        </tr>
		        <tr>
		        	<td>Merchant Param2	:</td><td><input type="text" name="merchant_param2" value="additional Info."/></td>
		        </tr>
				<tr>
					<td>Merchant Param3	:</td><td><input type="text" name="merchant_param3" value="additional Info."/></td>
				</tr>
				<tr>
					<td>Merchant Param4	:</td><td><input type="text" name="merchant_param4" value="additional Info."/></td>
				</tr>
				<tr>
					<td>Merchant Param5	:</td><td><input type="text" name="merchant_param5" value="additional Info."/></td>
				</tr>
				<tr>
					<td>Promo Code	:</td><td><input type="text" name="promo_code" value=""/></td>
				</tr>
				<tr>
					<td>Vault Info.	:</td><td><input type="text" name="customer_identifier" value=""/></td>
				</tr>
-->
</div>
</div>

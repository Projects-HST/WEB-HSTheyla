<div class="container-fluid signinbg">
    <?php
        foreach($seats as $rows) {
         $number_of_seats = $rows->number_of_seats;
         $order_id = $rows->order_id; 
         $name = $rows->name; 
         $email_id = $rows->email_id; 
         $mobile_no = $rows->mobile_no; 
        }
    ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-md-auto signin-div" style="margin-bottom:100px;">
            <form id="attendees" name="attendees" method="post" action="<?php echo base_url(); ?>home/insertattendees" onsubmit="return check();">
            <?php
                for ($i=1; $i < $number_of_seats+1; $i++) {
                    if ($i=='1'){
            ?>
                    <h4>Event attendees <?php echo $i; ?></h4>
                    <input type="text" name="name<?php echo $i;?>" value="<?php echo $name; ?>">
                    <input type="text" name="email<?php echo $i;?>" value="<?php echo $email_id; ?>">
                    <input type="text" name="phone<?php echo $i;?>" value="<?php echo $mobile_no; ?>">
            <?php
                    } else {
            ?>
                    <h4>Event attendees <?php echo $i; ?></h4>
                    <input type="text" name="name<?php echo $i;?>" value="">
                    <input type="text" name="email<?php echo $i;?>" value="">
                    <input type="text" name="phone<?php echo $i;?>" value="">
            <?php
                    }
                }
            ?>
            <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id; ?>" />
            <input type="hidden" name="count" id="count" value="<?php echo $number_of_seats; ?>" />
            <input type="submit" name="button" id="button" value="Submit" />
            </form>
        </div>
    	<div class="col-md-3"></div>
	</div>
</div>
<script language="javascript" type="text/javascript">
function check()
{
	var count =document.attendees.count.value;
	myArrayName=new Array();
	for(i=0;i<count;i++)
	{
		
		elmName=("name"+(i+1));
		myArrayName[i]=document.attendees.elements[elmName].value;

		var sName=myArrayName[i];

		if (sName=="")
		{
			alert("Enter Attendees "+(i+1));
			document.attendees.elements[elmName].focus();
			return false;
		}
	}
return true;
}
</script>
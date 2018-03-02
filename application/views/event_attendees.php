 <?php
        foreach($seats as $rows) {
         $number_of_seats = $rows->number_of_seats;
         $order_id = $rows->order_id;
         $name = $rows->name;
         $email_id = $rows->email_id;
         $mobile_no = $rows->mobile_no;
        }
?>
<div class="container-fluid page-bg">
  <div class="row header-title attendees-bg">
    <div class="col-md-12">
    <div class="container">
        <p class="add-attendees">Add Attendees</p>
      </div>
      <div class="container attendees-form">
    <div class="row">
      <div class="col-md-12" style="margin-bottom:100px;">

        <form id="attendees" name="attendees" class="form-inline" method="post" action="<?php echo base_url(); ?>home/insertattendees" onsubmit="return check();">


         <?php
                for ($i=1; $i < $number_of_seats+1; $i++) {
                    if ($i=='1'){
            ?>
              <div class="row formrow">
                  <div class="col-md-4">
                  <label for="exampleInputEmail3" class="label-form">Name</label>
                    <input type="text" class="form-control" name="name<?php echo $i;?>" value="<?php echo $name; ?>">
                  </div>
                  <div class="col-md-4">
                  <label for="exampleInputEmail3" class="label-form">Email Id</label>
                    <input type="text" class="form-control" name="email<?php echo $i;?>" value="<?php echo $email_id; ?>">
                  </div>
                  <div class="col-md-4">
                  <label for="exampleInputEmail3" class="label-form">Phone Number</label>
                    <input type="text" class="form-control" name="email<?php echo $i;?>" value="<?php echo $mobile_no; ?>">
                  </div>
               </div>
            <?php
                    } else {
            ?>
                <div class="row formrow">
                  <div class="col-md-4">
                  <label for="exampleInputEmail3" class="label-form">Name</label>
                    <input type="text" class="form-control" name="name<?php echo $i;?>" value="">
                  </div>
                  <div class="col-md-4">
                  <label for="exampleInputEmail3" class="label-form">Email Id</label>
                    <input type="text" class="form-control" name="email<?php echo $i;?>" value="">
                  </div>
                  <div class="col-md-4">
                  <label for="exampleInputEmail3" class="label-form">Phone Number</label>
                    <input type="text" class="form-control" name="email<?php echo $i;?>" value="">
                  </div>
               </div>

            <?php
                    }
                }
            ?>
         	<input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id; ?>" />
            <input type="hidden" name="count" id="count" value="<?php echo $number_of_seats; ?>" />
            <input type="submit" class="btn btn-primary" name="button" id="button" value="Submit" />
         </form>
      </div>
    </div>
  </div>

    </div>
  </div>

</div>
<style>
#stickfooter{
  position:fixed;
      bottom:0;
      width: 100%;
}

label {
  margin-bottom: 0;
  margin-left: 1px;
}
.form-inline .form-control{
  width: 100%;
}
.formrow{
  width: 100%;
}
body{
  background-color:  #eeeeee;
  margin-bottom:  70px;

}
</style>




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

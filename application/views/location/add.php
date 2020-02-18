     <div class="page-content-wrapper">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Add Location </h4>
                        <form method="post" action="" name="locationfrm" enctype="multipart/form-data" id="locationfrm">
                           <div class="form-group row">
                              <label for="example-text-input" class="col-sm-3 col-form-label">Location <span class="error">*</span></label>
                              <div class="col-sm-6">
                                 <input class="form-control" type="text" name="location" id="example-text-input" maxlength="50">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Row From <span class="error">*</span></label>
                              <div class="col-sm-3">
								<select class="form-control" id="row_from" name="row_from">
								<option value="">Select</option>
									<?php for ($x = 1; $x <= 40; $x++) {
										echo "<option value=".$x.">".$x."</option>";
									}?>
								</select>
                              </div>
                              <label class="col-sm-3 col-form-label">Row To <span class="error">*</span></label>
                              <div class="col-sm-3">
								<select class="form-control" id="row_to" name="row_to">
									<option value="">Select</option>
									<?php for ($x = 1; $x <= 40; $x++) {
										echo "<option value=".$x.">".$x."</option>";
									}?>
								</select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Column From <span class="error">*</span></label>
                              <div class="col-sm-3">
								<select class="form-control" id="column_from" name="column_from">
									<option value="">Select</option>
									<?php for ($x = 1; $x <= 40; $x++) {
										echo "<option value=".$x.">".$x."</option>";
									}?>
								</select>
                              </div>
                              <label class="col-sm-3 col-form-label">Column To <span class="error">*</span></label>
                              <div class="col-sm-3">
								<select class="form-control" id="column_to" name="column_to">
									<option value="">Select</option>
									<?php for ($x = 1; $x <= 40; $x++) {
										echo "<option value=".$x.">".$x."</option>";
									}?>
								</select>
                              </div>
                           </div>
						   <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Start Seat Name <span class="error">*</span></label>
                              <div class="col-sm-3">
								<select class="form-control" id="seat_name" name="seat_name">
										<option value="">Select</option>
										<option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option><option value="F">F</option><option value="G">G</option><option value="H">H</option><option value="I">I</option><option value="J">J</option><option value="K">K</option><option value="L">L</option><option value="M">M</option><option value="N">N</option><option value="O">O</option><option value="P">P</option><option value="Q">Q</option><option value="R">R</option><option value="S">S</option><option value="T">T</option><option value="U">U</option><option value="V">V</option><option value="W">W</option><option value="X">X</option><option value="Y">Y</option><option value="Z">Z</option>	
								</select>
                              </div>
                              <label class="col-sm-3 col-form-label">Seat Name Order <span class="error">*</span></label>
                              <div class="col-sm-3">
								<select class="form-control" id="seat_name_order" name="seat_name_order">
									<option value="">Select</option>
									<option value="i">Increase</option><option value="d">Decrease</option>		
								</select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Start Seat No. <span class="error">*</span></label>
                              <div class="col-sm-3">
								<select class="form-control" id="seat_no" name="seat_no">
									<option value="">Select</option>
									<?php for ($x = 1; $x <= 40; $x++) {
										echo "<option value=".$x.">".$x."</option>";
									}?>
								</select>
                              </div>
                              <label class="col-sm-3 col-form-label">Seat No. Order <span class="error">*</span></label>
                              <div class="col-sm-3">
								<select class="form-control" id="seat_order" name="seat_order">
									<option value="">Select</option>
									<option value="i">Increase</option><option value="d">Decrease</option>		
								</select>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-sm-3 col-form-label"></label>
                              <button type="submit" class="btn btn-success waves-effect waves-light">
                              Generate </button>

                           </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- end row -->
         </div>
         <!-- container -->
		 
		  <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="card m-b-20">
                     <div class="card-block">
                        <h4 class="mt-0 header-title"> Seat Arrangements </h4>
						<form method="post" action="<?php echo base_url(); ?>location/arrange_seats" name="seatsfrm" enctype="multipart/form-data" id="seatsfrm">
							<div id="table_details">
						</form>
						</div>
                  </div>
               </div>
            </div>
            <!-- end row -->
         </div>
         <!-- container -->
		 
      </div>
      <!-- Page content Wrapper -->

<script type="text/javascript">
$(document).ready(function() {
	   
   $('#locationfrm').validate({ // initialize the plugin
		rules: {
			location: { required: true },
			row_from: { required: true },
			row_to: { required: true },
			column_from: { required: true },
			column_to: { required: true },
			seat_name: { required: true },
			seat_name_order: { required: true },
			seat_no: { required: true },
			seat_order: { required: true }
		  },
		messages: {
			location: "Enter Location",
			row_from: "Select From Row",
			row_to: "Select To Row",
			column_from:"Select From Column",
			column_to:"Select To Column",
			seat_name:"Select Seat Name",
			seat_name_order:"Select Seat Name Order",
			seat_no:"Select Seat Number",
			seat_order:"Select Seat Order"
			},
		submitHandler: function(form) {
			var row_from_value=row_from.value;
			var row_to_value=row_to.value;
			var column_from_value=column_from.value;
			var column_to_value=column_to.value;
			var seat_name_value=seat_name.value;
			var seat_name_order_value=seat_name_order.value;
			var seat_no_value=seat_no.value;
			var seat_order_value=seat_order.value;
			var table_value = '';
			var flag = true;

			table_value +="<table width='100% border='0' cellspacing='2' cellpadding='2' class='m-b-20'>";

			// for loop for rows
			for(var i = row_from_value;i<=row_to_value;i++)
			{
				table_value +="<tr>";

				if(seat_no_value == '')
				{
					seat_no_value = '';
				}
				if(seat_name_value != '')
				{
					seatarray = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
					seatcnt = seatarray.length;
					getIndex = seatarray.indexOf(seat_name_value);
				}
				else
				{
					seat_name_value = '';
				}
				
				// for loop for columns
				for(var j = column_from_value; j<=column_to_value; j++)
				{	
					if(flag)
					{
						alert("You have selected Row-"+row_from_value+"-"+row_to_value+" & Column-"+column_from_value+"-"+column_to_value);
					}
					flag = false;
					var tdid = i+'.'+j;
									
					getSeatName =  seat_name_value+seat_no_value;
					//alert(getSeatName);
					table_value +="<td id="+tdid+"><input type='checkbox' name='seats[]' id='seats' value="+getSeatName+'|'+tdid+" checked><br>"+getSeatName+"</td>";
					
					//var tdtitle = getSeatName;
					//$('#'+tdid).attr('title',tdtitle);
				
					if(seat_order_value == 'i')
					{
						if(seat_no_value != '')
						{
							seat_no_value++;
						}
						else
						{
							seat_no_value = '';
						}
					}
					else if(seat_order_value == 'd')
					{
						if(seat_no_value != '')
						{
							seat_no_value--;
						}
						else
						{
							seat_no_value = '';
						}
					}
				}
				
				
				if(seat_name_order_value == 'i')
					{
						if(seat_name_value != '')
						{
							getIndex++;
							seat_name_value = seatarray[getIndex];
						}
						else
						{
							seat_name_value = '';
						}
					}
					else if(seat_name_order_value == 'd')
					{
						if(seat_name_value != '')
						{
							getIndex--;
							seat_name_value = seatarray[getIndex];
						}
						else
						{
							seat_name_value = '';
						}
					}
					
				table_value +="</tr>";	
			}
				/* for (var i = row_from_value; i <= row_to_value; i++){
					table_value +="<tr>";
						
						for (var j = column_from_value; j <= column_to_value; j++){
							table_value +="<td>"+j+"</td>";
						}
					table_value +="</tr>";
				} */
			
			table_value +="</table>";
			table_value +="<button type='submit' class='btn btn-success waves-effect waves-light'>Assign </button>";
			$("#table_details").html(table_value).show();	
    }
			
   });
   

    $("#seatsfrm").validate({
         rules: {
               'seats[]': { required: true },
         },
         messages:{
               'seats[]': "check the checbox"
         },
       

     });
});


</script>

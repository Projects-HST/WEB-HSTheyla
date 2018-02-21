<?php $user_id = $this->session->userdata('id'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/multiselect.css">
<script src="<?php echo base_url(); ?>assets/front/js/multiselect.js"></script>
	<div class="container-fluid eventdetail-pge">
		<div class="container">
			<div class="row">
				<div class="carousel carousel-fade" data-ride="carousel" data-interval="2000">
					<div class="carousel-inner" role="listbox">
						<?php
	//print_r($event_gallery);
	if (!empty($event_gallery)){
		$i = 0;
		foreach($event_gallery as $res){
	?>
			<div class="carousel-item <?php if ($i=='0') echo "active"; ?>">
				<img class="d-block w-100" src="<?php echo base_url(); ?>assets/events/gallery/<?php echo $res->event_image; ?>">
			</div>

	  <?php
	   $i = $i+1;
		}
	  } else {
		foreach($event_details as $res){}
	  ?>
			<div class="carousel-item active">
				<img class="d-block w-100" src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>">
			</div>
	  <?php  } ?>
								</div>
							</div>
						</div>
					<?php foreach($event_details as $res){ $event_id = $res->id;} 	?>
					<div class="row booking-section">
							<div class="col-md-10">
								<div class="event-heading">
									<p class="event-heading-text"><?php echo $res->event_name; ?></p>
								</div>
							</div>
							<div class="col-md-2"></div>
						</div>

                <section class="row event-details-desc">
                <div class="col-md-8">
                <form class="form-horizontal" method='post' action='' id='eventplan'>
                <fieldset>
                <p class="event-desc-head">Select date</p>
                <div class="form-group">
                    <div class="col-md-10">
                        <div class="input-group">
						<input type="hidden" name="event_id" id="event_id" value="<?php  echo $event_id; ?>">
                            <div class="radio-group">
                                <?php
								//print_r ($booking_dates);
								if (!empty($booking_dates)){
								foreach($booking_dates as $res){
								?>
								<label class="btn btn-primary not-active"><?php echo $res->show_date; ?>
							<input type="radio" value="<?php echo $res->show_date; ?>" name="show_date" id="show_date" onchange="disp_time(<?php echo $event_id; ?>,this.value)">
								</label>
								<?php }
								} else {
								echo "No Dates Found";
								}
								?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                          <div id="plan_time"></div>
						  <div id="plan_details"></div>

                            <!-- <fieldset>
                                <p class="event-desc-head">Select Time</p>
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <div class="radio-group">
                                                <label class="btn btn-primary not-active">10:00 AM
                                                    <input type="radio" value="male" name="gender">
                                                    </label>
                                                    <label class="btn btn-primary not-active">11:00 AM
                                                        <input type="radio" value="female" name="gender">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>


                                    <fieldset>
                                        <p class="event-desc-head">Select Plan</p>
                                        <div class="form-group">
                                            <div class="col-md-10">
                                                <div class="input-group">
                                                    <div class="radio-group">
                                                        <label class="btn btn-primary not-active">Gold
                                                            <input type="radio" value="male" name="gender">
                                                            </label>
                                                            <label class="btn btn-primary not-active">Platinum
                                                                <input type="radio" value="female" name="gender">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <p class="event-desc-head">Select Ticket</p>
                                                <div class="form-group">
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="quantity-left-minus btn  btn-number  btn-color"  data-type="minus" data-field="">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </span>
                                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="10">
                                                                <span class="input-group-btn">
                                                                    <button type="button" class="quantity-right-plus btn  btn-number btn-color" data-type="plus" data-field="">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
 -->


                                            </form>
                                        </div>
                                        <div class="col-md-4">

                                            <p class="event-desc-head">Summary</p>
<!--
                                            <div class="price-details">
                                                <p class="amt-price">Gold Plan:
                                                    <span class="pull-right plan-amt">100</span>
                                                </p>
                                                <p class="total-price">Total Amount:
                                                    <span class="pull-right amt">100</span>
                                                </p>
                                                <p>
                                                    <input type="submit" class="btn btn-primary btn-block btn-login" placeholder="Password" value="Continue" />
                                                </p>
                                            </div>
-->
                                        </div>
                                    </section>
														</div>
													</div>
													<style>
.fa-plus{
  color:#fff;
}
.fa-minus{
  color:#fff;
}
    .quantity-remove, .quantity-add {
        cursor: pointer;
    }
    .quantity-add.glyphicon, .quantity-remove.glyphicon {
        display: block;
        cursor: pointer;
    }
    .form-group{
      margin-bottom: 20px;
    }
    .radio-group label {
       overflow: hidden;
    } .radio-group input {
        /* This is on purpose for accessibility. Using display: hidden is evil.
        This makes things keyboard friendly right out tha box! */
       height: 1px;
       width: 1px;

       top: -20px;
    } .radio-group .not-active  {
       color: #000;
       background-color: #fff;
       border:2px solid #478ecc;
    }
    input[type="radio"] {
        visibility:hidden;
    }
		.plan_show_time{
			background: none;
    	color: #000;
    	margin-right: 10px;
		}
		label.btn.btn-primary.plan_show_time.active {
    color: #fff;
	}
    .carousel-fade .carousel-inner, .carousel-fade .carousel-item{
    height: 400px;
    }
    .carousel{
      width: 100%;
    }
    @media (min-width: 320px) and (max-width: 480px){
      .carousel-fade .carousel-inner, .carousel-fade .carousel-item{
      height: 180px;
      }
    }
</style>
<script>
    $('.carousel').carousel({
      interval:6000,
      pause: "false"
  })
  $(function() {
      // Input radio-group visual controls
      $('.radio-group label').on('click', function(){
          $(this).removeClass('not-active').siblings().addClass('active');
      });
  });

  var quantitiy=0;
     $('.quantity-right-plus').click(function(e){

          // Stop acting like a button
          e.preventDefault();
          // Get the field name
          var quantity = parseInt($('#quantity').val());

          // If is not undefined

              $('#quantity').val(quantity + 1);


              // Increment

      });

       $('.quantity-left-minus').click(function(e){
          // Stop acting like a button
          e.preventDefault();
          // Get the field name
          var quantity = parseInt($('#quantity').val());

          // If is not undefined

              // Increment
              if(quantity>0){
              $('#quantity').val(quantity - 1);
              }
      });

	function disp_time(event_id,plan_date)
	{
		var result = '';
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/plantiming',
		type: 'POST',
		data: {event_id : event_id,plan_date : plan_date},
		success: function(data) {
		var dataArray = JSON.parse(data);
		if (dataArray.length>0) {
			result +="<fieldset><p class='event-desc-head'>Select Time</p><div class='form-group'><div class='btn-group colors' data-toggle='buttons'>";

			for (var i = 0; i < dataArray.length; i++){
				var id = dataArray[i].id;
				var show_date = dataArray[i].show_date;
				var show_time = dataArray[i].show_time;
				result +="<label class='btn btn-primary plan_show_time'>"+show_time+"<input type='radio' value='"+show_time+"' id='show_plan_time' name='show_plan_time' onchange='disp_plan(<?php echo $event_id; ?>,show_date.value,this.value)'></label>";
			};
				result +="</div></div></fieldset>";

			$("#plan_time").html(result).show();
		} else {
			result +="No Records found!..";
			$("#plan_time").html(result).show();
		}
		}
		});
	}
	
	function disp_plan(event_id,show_date,show_time)
	{
		var result = '';
		//make the ajax call
		$.ajax({
		url: '<?php echo base_url(); ?>eventlist/plandetails',
		type: 'POST',
		data: {event_id : event_id,show_date : show_date,show_time : show_time},
		success: function(data) {
		//alert(data);
		var dataArray = JSON.parse(data);
		

		if (dataArray.length>0) {
			result +="<fieldset><p class='event-desc-head'>Select Plan</p><div class='form-group'><div class='col-md-10'><div class='input-group'><div class='radio-group'>";
			for (var i = 0; i < dataArray.length; i++){
				[{"plan_name":"BKT_A","seat_rate":"1.00","event_id":"41","plan_id":"60","show_date":"2018-02-23","show_time":"11:00 AM","seat_available":"45"}]
				var event_id = dataArray[i].event_id;
				var plan_name = dataArray[i].plan_name;
				var show_date = dataArray[i].show_date;
				var show_time = dataArray[i].show_time;
				var seat_available = dataArray[i].seat_available;
				var show_time = dataArray[i].seat_rate;

				result +="<label class='btn btn-primary not-active'>"+plan_name+"<input type='radio' value='"+plan_name+"' name='plan_name'></label>";
			};
			result +="</div></div></div></div></fieldset>";
			
			result +="</fieldset><p class='event-desc-head'>Select Ticket</p><div class='form-group'><div class='col-md-4'><div class='input-group'><span class='input-group-btn'><button type='button' class='quantity-left-minus btn  btn-number  btn-color'  data-type='minus' data-field=''><i class='fas fa-minus'></i></button></span><input type='text' id='quantity' name='quantity' class='form-control input-number' value='1' min='1' max='"+seat_available+"'><span class='input-group-btn'><button type='button' class='quantity-right-plus btn  btn-number btn-color' data-type='plus' data-field=''><i class='fas fa-plus'></i></button></span></div></div></div></fieldset>";
			
			$("#plan_details").html(result).show();
		} else {
			result +="No Records found!..";
			$("#plan_details").html(result).show();
		}
			
		}
		});
	}
</script>

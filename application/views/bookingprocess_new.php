<?php
$user_id = $this->session->userdata('id');
foreach($booking_process as $res){
		$originalDate = $res->show_date;;
}
?>

<div class="container-fluid" style="background-color:#fff;">
  <div class="homeslider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="first-slide" src="https://localhost/heyla/assets/front/images/about_usbanner.jpg" alt="First slide">
        </div>
    </div>
  </div>
  </div>
</div>

<div class="container summary_tab">

<div class="col-md-12 top_heading_box">
  <p class="text-center summary_title"> Heyla Order summary</p>
</div>
<div class="col-md-12 summary_card">
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Order id</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo $res->order_id;?></p></div>
  </div>
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Event Name</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo $res->event_name;?></p></div>
  </div>
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Category Name</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo $res->category_name;?></p></div>
  </div>
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Event Venue</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo $res->event_venue;?></p></div>
  </div>
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Event Address</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo $res->event_address;?></p></div>
  </div>
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Event Show date</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo  date("d-m-Y", strtotime($originalDate)) ?></p></div>
  </div>
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Event Show time</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo $res->show_time;?></p></div>
  </div>
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Booking Plan</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo $res->plan_name;?></p></div>
  </div>
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Booking Seats</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo $res->number_of_seats;?></p></div>
  </div>
  <div class="row">
    <div class="col-md-5"><p class="summary_label summary_text">Booking Amount</p></div>
    <div class="col-md-1"><p class="summary_text">:</p></div>
    <div class="col-md-6"><p class="summary_text"><?php echo $res->total_amount;?></p></div>
  </div>
  <div class="row">
    <div class="col-md-12 text-center" style="margin-top:20px;">
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


</div>

</div>


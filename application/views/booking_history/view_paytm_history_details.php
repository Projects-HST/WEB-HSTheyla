
   <div class="page-content-wrapper ">
     <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">
                 <h4 class="mt-0 header-title"> Event Booking Details </h4>

                <form method="post" enctype="multipart/form-data" action="" name="eventform">
                  <?php foreach($all as $rows){}?>
                        <div class="form-group row">

                            <label for="Category" class="col-sm-2 col-form-label">Order ID: </label>
                            <div class="col-sm-4">
                            <h4 class="header-title"> <?php echo $rows->order_id; ?> </h4>
                            </div>

                            <label for="Name" class="col-sm-2 col-form-label">Transaction ID: </label>
                            <div class="col-sm-4">
                               <h4 class="header-title"> <?php echo $rows->track_id; ?> </h4>
                            </div>

                        </div>
                       <div class="form-group row">
                            <label for="country" class="col-sm-2 col-form-label">Bank Reference No: </label>
                            <div class="col-sm-4">
                                <h4 class="header-title"> <?php echo $rows->bank_trans_id; ?> </h4>
                            </div>
                             <label for="city" class="col-sm-2 col-form-label">Order Status: </label>
                            <div class="col-sm-4">
                            <h4 class="header-title"> <?php echo $rows->order_status; ?> </h4>
                               </div>
                            </div>

                        <div class="form-group row">
                            <label for="Venue" class="col-sm-2 col-form-label">Transaction type: </label>
                            <div class="col-sm-4">
                              <h4 class="header-title"> <?php echo $rows->trans_type; ?> </h4>
                            </div>
                             <label for="Address" class="col-sm-2 col-form-label">Gateway: </label>
                            <div class="col-sm-4">
                                <h4 class="header-title"> <?php echo $rows->gateway; ?> </h4>
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="sdate" class="col-sm-2 col-form-label">Response Code: </label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <h4 class="header-title"> <?php echo $rows->resp_code; ?> </h4>
                            </div>
                            </div>
                             <label for="edate" class="col-sm-2 col-form-label">Response Message: </label>
                            <div class="col-sm-4">
                               <div class="input-group">
                                  <h4 class="header-title"> <?php echo $rows->resp_msg; ?> </h4>
                            </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stime" class="col-sm-2 col-form-label">Bank Name: </label>
                            <div class="col-sm-4">
                              <h4 class="header-title"> <?php echo $rows->bank_name; ?> </h4>
                            </div>

                             <label for="etime" class="col-sm-2 col-form-label">Date and Time: </label>
                            <div class="col-sm-4">
                               <h4 class="header-title"> <?php echo $rows->trans_date; ?> </h4>
                            </div>
                        </div>



                     </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

   </div><!-- container -->
   </div>
   <!-- Page content Wrapper -->
</div>
<!-- content -->

<script type="text/javascript">
 $('#booking_status').addClass("active");
  $('#booking').addClass("has_sub active nav-active");

</script>

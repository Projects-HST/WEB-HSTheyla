
   <div class="page-content-wrapper ">
     <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">
                 <h4 class="mt-0 header-title"> View Booking </h4>

                <form method="post" enctype="multipart/form-data" action="" name="eventform">
                  <?php foreach($all as $rows){}?>
                        <div class="form-group row">

                            <label for="Category" class="col-sm-2 col-form-label">Order Id  : </label>
                            <div class="col-sm-4">
                            <h4 class="header-title"> <?php echo $rows->order_id; ?> </h4>
                            </div>

                            <label for="Name" class="col-sm-2 col-form-label">Track Id : </label>
                            <div class="col-sm-4">
                               <h4 class="header-title"> <?php echo $rows->track_id; ?> </h4>
                            </div>

                        </div>
                       <div class="form-group row">
                            <label for="country" class="col-sm-2 col-form-label">Bank Ref No : </label>
                            <div class="col-sm-4">
                                <h4 class="header-title"> <?php echo $rows->bank_ref_no; ?> </h4>
                            </div>
                             <label for="city" class="col-sm-2 col-form-label">Order Status : </label>
                            <div class="col-sm-4">
                            <h4 class="header-title"> <?php echo $rows->order_status; ?> </h4>
                               </div>
                            </div>

                        <div class="form-group row">
                            <label for="Venue" class="col-sm-2 col-form-label">Failure Msg : </label>
                            <div class="col-sm-4">
                              <h4 class="header-title"> <?php echo $rows->failure_message; ?> </h4>
                            </div>
                             <label for="Address" class="col-sm-2 col-form-label">Payment Mode : </label>
                            <div class="col-sm-4">
                                <h4 class="header-title"> <?php echo $rows->payment_mode ; ?> </h4>
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="sdate" class="col-sm-2 col-form-label">Card Name : </label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <h4 class="header-title"> <?php echo $rows->card_name; ?> </h4>
                            </div>
                            </div>
                             <label for="edate" class="col-sm-2 col-form-label">Status Code : </label>
                            <div class="col-sm-4">
                               <div class="input-group">
                                  <h4 class="header-title"> <?php echo $rows->status_code ; ?> </h4>
                            </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stime" class="col-sm-2 col-form-label">Status Msg : </label>
                            <div class="col-sm-4">
                              <h4 class="header-title"> <?php echo $rows->status_message; ?> </h4>
                            </div>

                             <label for="etime" class="col-sm-2 col-form-label">Currency : </label>
                            <div class="col-sm-4">
                               <h4 class="header-title"> <?php echo $rows->currency; ?> </h4>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="latitude" class="col-sm-2 col-form-label">Amount : </label>
                            <div class="col-sm-4">
                              <h4 class="header-title"> <?php echo $rows->amount; ?> </h4>

                            </div>
                              <label for="longitude" class="col-sm-2 col-form-label">Billing Person Name : </label>
                            <div class="col-sm-4">
                               <h4 class="header-title"> <?php echo $rows->billing_name; ?> </h4>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="primarycell" class="col-sm-2 col-form-label">Billing Address : </label>
                            <div class="col-sm-4">

                               <h4 class="header-title"> <?php echo $rows->billing_address; ?> </h4>

                            </div>
                            <label for="seccell" class="col-sm-2 col-form-label">Billing City : </label>
                            <div class="col-sm-4">
                              <h4 class="header-title"> <?php echo $rows->billing_city; ?> </h4>

                            </div>
                        </div>
                       <div class="form-group row">
                            <label for="Person" class="col-sm-2 col-form-label">Billing State : </label>
                            <div class="col-sm-4">
                                <h4 class="header-title"> <?php echo $rows->billing_state; ?> </h4>

                            </div>
                            <label for="Email" class="col-sm-2 col-form-label">Billing Zip  : </label>
                            <div class="col-sm-4">
                                <h4 class="header-title"> <?php echo $rows->billing_zip; ?> </h4>

                            </div>
                        </div>

                        <div class="form-group row">

                            <label for="Status" class="col-sm-2 col-form-label">Billing Country : </label>
                            <div class="col-sm-4">
                              <h4 class="header-title"> <?php echo $rows->billing_country;?> </h4>

                            </div>

                        <label for="Colour" class="col-sm-2 col-form-label">Billing Tel : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo$rows->billing_tel; ?> </h4>
                            </div>
                       </div>

                        <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Billing Email : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title">
                                  <?php echo $rows->billing_email; ?> </h4>
                            </div>
                            <label for="Colour" class="col-sm-2 col-form-label">Delievery Name : </label>
                            <div class="col-sm-4">
                               <h4 class="header-title">
                                <?php echo $rows->delievery_name ; ?> </h4>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Delievery Address : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->delievery_address; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Delievery City : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->delievery_city; ?> </h4>
                            </div>
                        </div>

                        <!--  -->

                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Delievery State : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->delievery_state; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Delievery Zip : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows-> delievery_zip ; ?> </h4>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Delievery Counttry : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->delievery_country; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Delievery Tel : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->delievery_tel; ?> </h4>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Merch Param1 : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->merch_param1; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Merch Param2 : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->merch_param2; ?> </h4>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Merch Param3 : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->merch_param3; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Merch Param4 : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->merch_param4; ?> </h4>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Merch Param5 : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->merch_param5; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Vault : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->vault; ?> </h4>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Offer Type : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->offer_type; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Offer Code : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->offer_code; ?> </h4>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Discount Value : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->discount_value; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Mer Amount : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->mer_amt; ?> </h4>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Eci Value : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->eci_value; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Retry : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->retry; ?> </h4>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Response Code  : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title"> <?php echo $rows->response_code ; ?> </h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Billing Notes : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->billing_notes ; ?> </h4>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Transation Date : </label>
                            <div class="col-sm-4">
                                 <h4 class="header-title">
								 <?php
								 if ($rows->trans_date !='null') {
									 echo $rows->trans_date;
								 } //else {
									 // echo "Not OK";
								 //} ?></h4>
                            </div>
                          <label for="ecost" class="col-sm-2 col-form-label">Bin Country : </label>
                            <div class="col-sm-2">
                                   <h4 class="header-title"> <?php echo $rows->bin_country ; ?> </h4>
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

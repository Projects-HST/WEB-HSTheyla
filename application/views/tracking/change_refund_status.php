<div class="page-content-wrapper ">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
        <div class="card m-b-20">
                             <div class="card-block">
                               <?php foreach($refund_track as $rows){} ?>
                                <h4 class="mt-0 header-title">Refund  Request </h4>

                                <form method="post" enctype="multipart/form-data" action="" name="organsier_req_form" id="change_req_status" novalidate="novalidate">

                                   <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-4 col-form-label">Email / Phone / username</label>
                                      <div class="col-sm-6">
                                        <?php echo $rows->email_id; ?> <br> <?php echo $rows->mobile_no; ?><br>
                                              <?php echo $rows->user_name; ?>
                                      </div>
                                      <input type="hidden" name="refund_id" value="<?php echo base64_encode($rows->refund_id*98765); ?>">
                                      <input type="hidden" name="email_id" value="<?php echo base64_encode($rows->email_id); ?>">
                                      <!-- <input type="hidden" name="org_id" value="<?php echo $rows->user_id; ?>"> -->
                                   </div>
                                   <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-4 col-form-label">Order id</label>
                                      <div class="col-sm-6">
                                        <?php echo $rows->order_id; ?>
                                      </div>

                                   </div>

                                   <div class="form-group row">
                                      <label class="col-sm-4 col-form-label">Refund Status</label>
                                      <div class="col-sm-8">
                                        <select name="req_status" class="form-control">
                                          <option  value="Rejected">Rejected</option>
                                          <option  value="Onhold">Onhold</option>
                                          <option  value="Pending">Pending</option>
                                          <option  value="Approved">Approved</option>
                                        </select>
                                          <script language="JavaScript">document.organsier_req_form.req_status.value="<?php echo $rows->status; ?>";</script>
                                      </div>
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-4 col-form-label"></label>
                                      <button type="submit" class="btn btn-primary waves-effect waves-light">
                                      Update  </button>

                                   </div>
                             </form>
                          </div>
                       </div>
                       </div>
      </div>
    </div>
</div>
<script>
$('#change_req_status').validate({ // initialize the plugin
    rules: {
        req_status: {
            required: true
        },
    },
    messages: {


    },
    submitHandler: function(form) {
        $.ajax({
            url: "<?php echo base_url(); ?>tracking/update_refund_status",
            type: 'POST',
            data: $('#change_req_status').serialize(),
            success: function(response) {
                if (response == "success") {
                    swal({
                        title: "Success",
                        text: "Update Successfully",
                        type: "success"
                    }).then(function() {
                        location.href = '<?php echo base_url(); ?>tracking/refund_request';
                    });
                } else {
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }
});

</script>

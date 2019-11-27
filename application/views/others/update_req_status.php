<div class="page-content-wrapper ">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
        <div class="card m-b-20">
                             <div class="card-block">
                               <?php foreach($get_org_request as $rows){} ?>
                                <h4 class="mt-0 header-title">Organiser Request </h4>

                                <form method="post" enctype="multipart/form-data" action="" name="organsier_req_form" id="change_req_status" novalidate="novalidate">
                                   <!-- <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-4 col-form-label"> Name</label>
                                      <div class="col-sm-6">
                                        <?php echo $rows->name; ?>

                                      </div>
                                   </div> -->
                                   <div class="form-group row">
                                      <label for="example-text-input" class="col-sm-5 col-form-label">Email ID/Phone Number</label>
                                      <div class="col-sm-6">
                                        <?php echo $rows->email_id; ?>
                                      </div>
                                      <input type="hidden" name="req_id" value="<?php echo $rows->rq_id; ?>">
                                      <input type="hidden" name="org_id" value="<?php echo $rows->user_id; ?>">
                                   </div>
                                   <!-- <div class="form-group row">
                                      <label class="col-sm-4 col-form-label">Message</label>
                                      <div class="col-sm-8">
                                        <?php echo $rows->message; ?>
                                      </div>
                                   </div> -->
                                   <div class="form-group row">
                                      <label class="col-sm-5 col-form-label">Status <span class="red_txt_label">*</span></label>
                                      <div class="col-sm-4">
                                        <select name="req_status" class="form-control">
                                            <option  value="Denied">Denied</option>
                                          <option  value="Pending">Pending</option>
                                          <option  value="Approved">Approved</option>
                                        </select>
                                          <script language="JavaScript">document.organsier_req_form.req_status.value="<?php echo $rows->req_status; ?>";</script>
                                      </div>
                                   </div>
                                   <div class="form-group">
                                      <label class="col-sm-5 col-form-label"></label>
                                      <button type="submit" class="btn btn-success waves-effect waves-light">
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
            url: "<?php echo base_url(); ?>dashboard/change_req_status",
            type: 'POST',
            data: $('#change_req_status').serialize(),
            success: function(response) {

                if (response == "success") {
                    swal({
                        title: "",
                        text: "Status Updated",
                        type: "success"
                    }).then(function() {
                        location.href = '<?php echo base_url(); ?>dashboard/get_all_organiser_request';
                    });
                } else {
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }
});

</script>

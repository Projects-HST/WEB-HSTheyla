    <section class="">
      <div class="container">
        <div class="">
          <div class="verify-text" style="    margin-bottom: 200px;">
            <center>
                <img src="<?php echo base_url(); ?>assets/front/images/email.png" class="img-fluid">
              <form action="" method="post" id="resetform">
                <div class="form-group">
                  <label for="exampleInputPassword1">Enter the Registered Email to Reset. </label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Registered Email Id.">
                </div>
                <div class="form-group">

                  <input type="submit" class="form-control btn-event btn btn-login" id="" value="Reset Now">
                </div>
              </form>
            </center>

          </div>
        </div>
      </div>
    </section>
    <style>

    .modal {
      text-align: center;
      padding: 0!important;
    }

    .modal:before {
      content: '';
      display: inline-block;
      height: 100%;
      vertical-align: middle;
      margin-right: -4px;
    }
    .modal-body{
      padding-top:30px;
      padding-bottom:30px;
      padding-left: 40px;
      padding-right: 40px;
      border: 2px solid #6D6E71;
      border-radius: 20px;
    }
    .modal-dialog {
      display: inline-block;
      text-align: left;
      vertical-align: middle;
    }

    </style>

<script type="text/javascript">
    $("#myModal").modal('show');

    $("#loginbtn").click(function() {
        $(this).toggleClass("menuactive");
    });
    $('ul li a').click(function() {
        $('li a').removeClass("menuactive");
        $(this).addClass("menuactive");
    });

    $("#setting").click(function() {
        $("#edit-btn").toggle();
    });

    $("#edit-btn").click(function() {
        $("#form").toggle();
        $('#per-info').hide();
    });

   $('.verify-page').height($(window).height());

   $('#resetform').validate({ // initialize the plugin
       rules: {
           email: {required: true},
       },
       messages: {
           email: "Enter Registered Email"
       },
       submitHandler: function(form) {
           //alert("hi");
           $.ajax({
               url: "<?php echo base_url(); ?>home/reset_password",
               type: 'POST',
               data: $('#resetform').serialize(),
               success: function(response) {

                   if (response == "success") {
                     swal({
                title: "Success",
                text: "Reset Password has sent Registered Email",
                type: "success"
            }).then(function() {
                location.href = '<?php echo base_url(); ?>';
            });
                   } else {
                       sweetAlert("Oops...", response, "error");
                   }
               }
           });
       }
   });

</script>

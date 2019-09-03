    <section class="">
      <div class="container">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="verify-text" style="    margin-bottom: 100px;">
            <center>
                <img src="<?php echo base_url(); ?>assets/front/images/forgot_password.png" class="img-responsive imgsize_80 forgot_img">
              <form action="" method="post" id="resetform" class="resetform">
                <div class="form-group">
                  <label for="exampleInputPassword1">Please enter your registered email ID to reset your password</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ex: dawkins@gmail.com">
                </div>
                <div class="form-group">

                  <input type="submit" class=" btn_no_radius btn btn-login" id="" value="Submit">
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
           email: "Email ID is required!"
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
                title: " ",
                text: "Please check your email.<br> We have sent you a link to reset your login password.",
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


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
  padding-left: 20px;
  padding-right: 20px;
  border: 2px solid #6D6E71;
  border-radius: 20px;
}
.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

</style>

<body>


    <section class="verify-page profile">
      <div class="container">
        <div class="row">
          <div class="verify-text">

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-body">
                        <center>
                          <img src="<?php echo base_url(); ?>assets/front/images/email.png" class="img-fluid">
                          <p class="verify-text1">Thanking for Registering.</p>
                          <p class="verify-text1">

              Check Your Inbox for  the verification email We’ve sent you a message to your registered email ID. Click on the verification link to confirm your email ID.
                          </p>
                        </center>
                      </div>

                  </div>
              </div>
          </div>
          </div>
        </div>
      </div>
    </section>


<script type="text/javascript">
    $("#myModal").modal('show');
    $('#myModall').modal({
                         backdrop: 'static',
                         keyboard: true,
                         show: true
                 });
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

</script>

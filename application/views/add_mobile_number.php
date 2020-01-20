
<style>
.reset{

  align-items: center;
  margin-top: 5%;
}
.form-control{
  width: 270px;
}


</style>

    <section class="" style="margin-bottom:100px;">
      <div class="container">
        <div class="">
<center>


  <p style="margin-top:10%;font-size:22px;">Add the Mobile Number</p>
        <div class="reset">

  <div class="">
    <form class="form" role="form" autocomplete="off" id="update_mobile_number" method="post" enctype="multipart/form-data">
      <?php foreach($res as $rows){} ?>



        <div class="form-group">
            <input type="text" class="form-control" id="mobile" name="mobile" required="" placeholder="Enter New Mobile Number " onkeyup="check_mobile()" maxlength="12"> 
              <br><span><button onclick="sendOTP()" id="sendbtn">Send  OTP</button></span>
            <p id="mobilenum"></p>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="mobileotp" name="mobileotp"  placeholder="Enter OTP" onkeyup="checkOTP()">
            <p id="mobilemsg"></p>
        </div>
        <button type="submit" id="submit" class="btn btn-event btn-lg">save</button>
    </form>
  </div>
</div>
</center>
        </div>
      </div>
    </section>


<script type="text/javascript">
   $('.verify-page').height($(window).height());
   $('#update_mobile_number').validate({ // initialize the plugin
       rules: {
         mobile : {
            required:true,digits:true,maxlength:12,minlength:8
          },
          mobileotp : {
             required: true,
             remote: {
                    url: "<?php echo base_url(); ?>home/checkotp",
                    type: "post"
                 }
           },
       },
       messages: {
		   mobile:{
				required:"This field cannot be empty!",
				digits:"Only numbers",
        },
            mobileotp: {   required: "Enter  OTP",remote:"You have enter invalid OTP "}
       },
       submitHandler: function(form) {
           //alert("hi");
           $.ajax({
               url: "<?php echo base_url(); ?>home/save_mobile_number",
               type: 'POST',
               data: $('#update_mobile_number').serialize(),
               success: function(response) {

                   if (response == "success") {
                     swal({
                title: "Success",
                text: " Mobile number added successfully",
                type: "success"
            }).then(function() {
                location.href = '<?php echo base_url(); ?>profile';
            });
                   } else {
                       sweetAlert("Oops...", response, "error");
                   }
               }
           });
       }
   });

   function sendOTP(){

     var mobile=$('#mobile').val();

     $.ajax({
         method: "post",
       url: "<?php echo base_url(); ?>home/sendOTP",
       data: {
           mobile: mobile
       },
       cache: false,
       success: function(response){
           $('#sendbtn').prop('disabled', true);

       }
     });
   }
   // function checkOTP(){
   //   var mobileotp = $('#mobileotp').val();
   //
   //   $.ajax({
   //       method: "post",
   //       data: {
   //           mobileotp: mobileotp
   //       },
   //       url: 'home/checkotp',
   //       success: function(data) {
   //        //   console.log(data);
   //           if ((data) == "success") {
   //               $("#submit").removeAttr("disabled");
   //                   $('#mobilemsg').html(' ');
   //
   //               // $('#mobilemsg').html('Username Available');
   //           } else {
   //               $('#submit').prop('disabled', true);
   //               $('#mobilemsg').html(data);
   //
   //           }
   //       }
   //   });
   // }
   function check_mobile() {
       var mobile = $('#mobile').val();

       $.ajax({
           method: "post",
           data: {
               mobile: mobile
           },
           url: 'home/checkmobile',
           success: function(data) {
               console.log(data);
               if ((data) == "success") {
                   $("#submit").removeAttr("disabled");
                    $('#mobilenum').html(' ');
                    //  $("#sendbtn").removeAttr("disabled");
                       $('#sendbtn').show();
               } else {
                   $('#submit').prop('disabled', true);
                    $('#mobilenum').html(data);
                      $('#sendbtn').hide();
               }
           }
       });
   }
</script>

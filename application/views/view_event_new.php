<div id="page-wrapper">
    <div class="container">

        <div class="row well mobile_leaderboard" id="main" >
            <div class="col-sm-12 col-md-12 " id="content">
                <h3 class="dashboard_tab">view events</h3>
            </div>


            <div class="row profile_tab">
              <?php if(empty($result)){ echo "<center><h3>No Events Added</h3></center>"; }else{
                foreach($result as $rows){
       $status=$rows->event_status;
                 ?>

      <div class="col-xs-18 col-sm-6 col-md-3">
       <div class="thumbnail">
         <img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $rows->event_banner; ?>" alt="" style="height:204px;">
           <div class="caption">
            <h4><?php  echo $rows->event_name; ?></h4>
             <p><?php echo $rows->category_name;?></p>
               <p>City <?php echo $rows->city_name; ?><a href="<?php echo base_url();?>home/updateevents/<?php echo base64_encode($rows->id);?>" class="btn btn-default btn-xs pull-right" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></p>
         </div>
       </div>
     </div>


   <?php  }} ?>

            </div>


        </div>

    </div>

</div>

<script>

$('#profile_form').validate({ // initialize the plugin
    rules: {
        // mobile_no: {
        //   required: true,
        //   remote: {
        //          url: "<?php echo base_url(); ?>home/check_mobile/<?php echo $this->session->userdata('id'); ?>",
        //          type: "post"
        //       }
        // },
        user_name:{
          required: true,minlength: 6, maxlength: 12,
          remote: {
                 url: "<?php echo base_url(); ?>home/check_username/<?php echo $this->session->userdata('id'); ?>",
                 type: "post"
              }
        },
        name: {
            required: true
        },
        gender: {
            required: true
        },
        address: {
            required: true
        },
    },
    messages: {
        user_name: {
                        minlength:"Minimum 6 Characters",
                        maxlength:"Maximum 12 characters",
                       required: "Please enter your username",
                       user_name: "Please enter a username",
                       remote: "Username already in use!"
                   },
         mobile_no: {
                        required: "Please enter your username",
                        mobile_no: "Please enter a username",
                        remote: "Mobile number already in exist!"
                    },

        name: "Enter Name",
          gender: "Select Gender",
        address: "Enter Address "
    },
    submitHandler: function(form) {
        //alert("hi");
        $.ajax({
            url: "<?php echo base_url(); ?>home/save_profile",
            type: 'POST',
            data: $('#profile_form').serialize(),

            success: function(response) {
                if (response == "success") {
                    swal({
                        title: "success",
                        text: " Profile Saved.",
                        type: "success"
                    }).then(function() {
                       location.reload();
                    });
                } else {
                    sweetAlert("Oops...", response, "error");
                }
            }
        });
    }
});
</script>

<div id="page-wrapper">
    <div class="container">

        <div class="row well mobile_leaderboard" id="main" >
            <div class="col-sm-12 col-md-12 " id="content">
                <h3 class="dashboard_tab">Wishlist</h3>
            </div>


            <div class="row profile_tab">
              <?php if(empty($wishlist_details)){ echo "<center><h3>No Wishlist Added</h3></center>"; }else{ foreach($wishlist_details as $res){
                  $event_id = $res->id * 564738;
                  $event_name = strtolower(preg_replace("/[^\w]/", "-", $res->event_name));
                  $enc_event_id = base64_encode($event_id);

                  $string = strip_tags($res->description);
                if (strlen($string) > 150) {

                  $stringCut = substr($string, 0, 150);
                  $endPoint = strrpos($stringCut, ' ');

                  $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                  $string .= '...';
                } ?>

      <div class="col-xs-18 col-sm-6 col-md-4">
       <div class="thumbnail">
         <img src="<?php echo base_url(); ?>assets/events/banner/<?php echo $res->event_banner; ?>" alt="" style="height:204px;">
           <div class="caption">
             <a href="<?php echo base_url(); ?>eventlist/eventdetails/<?php echo $enc_event_id; ?>/<?php echo $event_name; ?>"><h4><?php echo $res->event_name; ?></h4></a>
             <p><?php echo $string;?></p>
               <p>Last updated on <?php echo $res->wl_updated_at; ?><a href="<?php echo base_url(); ?>home/removewishlist/<?php echo $res->wishlist_id; ?>" class="btn btn-default btn-xs pull-right" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a></p>
         </div>
       </div>
     </div>


   <?php  } } ?>

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

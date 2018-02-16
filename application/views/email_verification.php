
<style>

.email-verify{
  font-size: 33px;
  text-align: center;
  padding-top: 15%;
}
#stickfooter{
  position: absolute;
  width: 100%;
  bottom: 0px;
}
</style>

    <section class="verify-page ">
      <div class="container">
        <div class="">
          <div class="verified">


            <p class="email-verify">
              <?php
                if($res['msg']=="verify"){ ?>
                  Thank Your  Email Has been Verified Successfully .Click here to<a href="<?php echo base_url(); ?>"> Login</a>
              <?php  }else{
                  echo $res['msg'];
                }
               ?>

        </p>
          </div>
        </div>
      </div>
    </section>

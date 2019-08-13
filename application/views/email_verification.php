
<style>

.email-verify{
  font-size: 33px;
  text-align: center;
  padding-top: 15%;
}
.footer{
  position: fixed;
  bottom: 0px;
  width: 100%;
}
</style>

    <section class="verify-page ">
      <div class="container">
        <div class="">
          <div class="verified">


            <p class="email-verify">
              <?php
                if($res['msg']=="verify"){ ?>
                  Thank you! Your email has been verified successfully. <a href="<?php echo base_url(); ?>"> Click here to Login.</a>
              <?php  }else{
                  echo $res['msg'];
                }
               ?>

        </p>
          </div>
        </div>
      </div>
    </section>

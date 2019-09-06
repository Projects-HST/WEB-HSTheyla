
<style>

.email-verify{
  font-size: 33px;
  text-align: center;
  padding-top: 15%;
}
.verify-page{
  padding-top: 100px;
  padding-bottom: 100px;

}
</style>

    <section class="verify-page ">
      <div class="container">
        <div class="">
          <div class="verified">


            <p class="email-verify">
              <?php
                if($res['msg']=="verify"){ ?>
                  Yay! Email verified successfully. <a href="<?php echo base_url(); ?>signin"> Click here to sign in.</a>
              <?php  }else{
                  echo $res['msg'];
                }
               ?>


        </p>
          </div>
        </div>
      </div>
    </section>

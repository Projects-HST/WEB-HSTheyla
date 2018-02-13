<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/multiselect.css">
<script src="<?php echo base_url(); ?>assets/front/js/multiselect.js"></script>
<div class="container-fluid eventdetail-pge">
    <div class="container">
        <div class="row">
            <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
                <!--Indicators-->


                <!--/.Indicators-->
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                    <!--First slide-->
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(130).jpg" alt="First slide">
                    </div>
                    <!--/First slide-->
                    <!--Second slide-->
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(129).jpg" alt="Second slide">
                    </div>
                    <!--/Second slide-->
                    <!--Third slide-->
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg" alt="Third slide">
                    </div>
                    <!--/Third slide-->
                </div>
                <!--/.Slides-->
                <!--Controls-->
                <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
                <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
                <!--/.Controls-->
            </div>

            <!--/.Carousel Wrapper-->


        </div>
        <div class="row booking-section">

            <div class="col-md-10">
                <div class="event-heading">
                    <p class="event-heading-text">Event Name</p>

                </div>
            </div>
            <div class="col-md-2">

            </div>



        </div>

        <section class="row event-details-desc">

            <div class="col-md-8">

                <form class="form-horizontal">
                    <fieldset>
                        <p class="event-desc-head">Select date</p>
                        <div class="form-group">

                            <div class="col-md-10">
                                <div class="input-group">
                                    <div class="radio-group">
                                        <label class="btn btn-primary not-active">Male <input type="radio" value="male" name="gender"></label>
                                        <label class="btn btn-primary not-active">Female <input type="radio" value="female" name="gender"></label>
                                        <label class="btn btn-primary not-active">Male <input type="radio" value="male" name="gender"></label>
                                        <label class="btn btn-primary not-active">Female <input type="radio" value="female" name="gender"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <p class="event-desc-head">Select Time</p>
                        <div class="form-group">

                            <div class="col-md-10">
                                <div class="input-group">
                                    <div class="radio-group">
                                        <label class="btn btn-primary not-active">10:00 AM <input type="radio" value="male" name="gender"></label>
                                        <label class="btn btn-primary not-active">11:00 AM <input type="radio" value="female" name="gender"></label>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <p class="event-desc-head">Select Plan</p>
                        <div class="form-group">

                            <div class="col-md-10">
                                <div class="input-group">
                                    <div class="radio-group">
                                        <label class="btn btn-primary not-active">Gold <input type="radio" value="male" name="gender"></label>
                                        <label class="btn btn-primary not-active">Platinum <input type="radio" value="female" name="gender"></label>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <p class="event-desc-head">Select Ticket</p>
                        <div class="form-group">

                            <div class="col-md-4">

                                <div class="input-group">
                                    <span class="input-group-btn">
                                     <button type="button" class="quantity-left-minus btn  btn-number  btn-color"  data-type="minus" data-field="">
                                         <i class="fas fa-minus"></i>
                                     </button>
                                 </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="10">
                                    <span class="input-group-btn">
                                     <button type="button" class="quantity-right-plus btn  btn-number btn-color" data-type="plus" data-field="">
                                          <i class="fas fa-plus"></i>
                                     </button>
                                 </span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>

            </div>
            <div class="col-md-4">
                <p class="event-desc-head">Summary</p>

                <div class="price-details">
                    <p class="amt-price">Gold Plan:<span class="pull-right plan-amt">100</span></p>
                    <p class="total-price">Total Amount:<span class="pull-right amt">100</span></p>
                    <p><input type="submit" class="btn btn-primary btn-block btn-login" placeholder="Password" value="Continue" /></p>
                </div>
            </div>

        </section>


    </div>
</div>
<style>
.fa-plus{
  color:#fff;
}
.fa-minus{
  color:#fff;
}
    .quantity-remove, .quantity-add {
        cursor: pointer;
    }
    .quantity-add.glyphicon, .quantity-remove.glyphicon {
        display: block;
        cursor: pointer;
    }
    .form-group{
      margin-bottom: 20px;
    }
    .radio-group label {
       overflow: hidden;
    } .radio-group input {
        /* This is on purpose for accessibility. Using display: hidden is evil.
        This makes things keyboard friendly right out tha box! */
       height: 1px;
       width: 1px;

       top: -20px;
    } .radio-group .not-active  {
       color: #000;
       background-color: #fff;
       border:2px solid #478ecc;
    }
    input[type="radio"] {
        visibility:hidden;
    }
    .carousel-indicators .active{
      background: none;
    }
    .booking-section{
      top:-60px;
    }
    .carousel-fade .carousel-inner, .carousel-fade .carousel-item{
    height: 400px;
    }
    .carousel{
      width: 100%;
    }
    .btn-primary{
      background-color: #478ecc;
    }
    @media (min-width: 320px) and (max-width: 480px){
      .carousel-fade .carousel-inner, .carousel-fade .carousel-item{
      height: 210px;
      }
    }
</style>
<script>
    $('.carousel').carousel({
      interval:6000,
      pause: "false"
  })
  $(function() {
      // Input radio-group visual controls
      $('.radio-group label').on('click', function(){
          $(this).removeClass('not-active').siblings().addClass('not-active');
      });
  });

  var quantitiy=0;
     $('.quantity-right-plus').click(function(e){

          // Stop acting like a button
          e.preventDefault();
          // Get the field name
          var quantity = parseInt($('#quantity').val());

          // If is not undefined

              $('#quantity').val(quantity + 1);


              // Increment

      });

       $('.quantity-left-minus').click(function(e){
          // Stop acting like a button
          e.preventDefault();
          // Get the field name
          var quantity = parseInt($('#quantity').val());

          // If is not undefined

              // Increment
              if(quantity>0){
              $('#quantity').val(quantity - 1);
              }
      });
</script>

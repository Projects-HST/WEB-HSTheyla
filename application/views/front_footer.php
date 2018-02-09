<footer class="footer-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                  <p class="fnt-footer"><a href="http://happysanz.com/" target="_blank">Crafted With Happiness</a></p>
            </div>
            <div class="col-md-6">
                <ul class="list-inline fnt-footer ">
                  <li class="list-inline-item"><a href="<?php echo base_url(); ?>privacy">Privacy Policy</a></li>
                  <li class="list-inline-item"><a href="<?php echo base_url(); ?>payment">Payment Policy</a></li>
                  <li class="list-inline-item"><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
                </ul>
            </div>
        </div>

    </div>
    <!-- /.container -->
</footer>

</body>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.reflection.js"></script>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.cloud9carousel.js"></script>
<script type="text/javascript">
$('.topmenu .nav-item a').click(function() {
    $('.topmenu .nav-item a').removeClass("menuactive");
    $(this).addClass("menuactive");
});
$('.modalmenu .tabmenu a').click(function() {
    $(' .modalmenu .tabmenu a').removeClass("tabmenu");
    $(this).addClass("tabmenu");
});

$(document).ready(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop() > $(window).height()) {
            $(".navbar").css({
                "background-color": "#478ECC"
            });
        } else {
            $(".navbar").css({
                "background-color": "#478ECC"
            });
        }

    })
});



</script>
</html>

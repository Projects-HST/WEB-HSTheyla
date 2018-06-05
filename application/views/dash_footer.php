
</div>
<div class="footer">
  <div class="">
    <div class="col-md-6">Crafted with Happiness
    </div>

    <div class="col-md-6">
      <ul id="footmenu">
          <li><a href="">Privacy Policy</a></li>
          <li><a href="">Payment Policy</a></li>
          <li><a href="">Terms and Conditions</a></li>
        </ul>
    </div>
  </div>

</div>
</body>
<script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url(); ?>assets/pages/datatables.init.js"></script>
<script>
function logout(){
  swal({
      title: 'Are you sure?',
      text: "You Want to logout !",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirm!'
  }).then(function(){
    window.location.href='<?php echo base_url(); ?>logout';
  }).catch(function(reason){

  });
}
</script>
</html>

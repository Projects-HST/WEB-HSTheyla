
</div>
<script src="<?php echo base_url(); ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/pages/sweet-alert.init.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<!-- Datatable init js -->
<script src="<?php echo base_url(); ?>assets/pages/datatables.init.js"></script>
<script>
$('#datetimepicker').datetimepicker();
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

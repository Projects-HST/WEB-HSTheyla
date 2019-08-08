
<div class="page-content-wrapper ">
  <div class="container">

     <div class="row">
         <div class="col-12">
             <div class="card m-b-20">
                 <div class="card-block">

              <h4 class="mt-0 header-title"> View Attendees  list </h4>


               <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile number</th>

                     </tr>
                  </thead>
                  <tbody>
    <?php $i=1; foreach ($view_attendees as $res) { ?>
                     <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $res->name; ?></td>
                        <td><?php echo $res->email_id; ?></td>
                        <td><?php echo $res->mobile_no; ?></td>


                     </tr>
                    <?php $i++;  }  ?>
                  </tbody>
               </table>




</div>
</div>
</div> <!-- end col -->
</div> <!-- end row -->
</div><!-- container -->
</div>
<!-- Page content Wrapper -->

<script type="text/javascript">
  $('#booking_history').addClass("active");
  $('#booking').addClass("has_sub active nav-active");
</script>

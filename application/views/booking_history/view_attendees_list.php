
<div class="page-content-wrapper ">
  <div class="container">

     <div class="row">
         <div class="col-12">
             <div class="card m-b-20">
                 <div class="card-block">

              <h4 class="mt-0 header-title"> Event Attendees  </h4>


               <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>S. No</th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>Mobile Number</th>

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
  

 $(document).ready(function () {
	 
	  $(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
	
	$('table').DataTable({
         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false
    });
	

   });

</script>

<style>
.review_active{
  border-left: 4px solid #458ecc;
}
.event_section{
  height: 100vh;
}
.footer_section{
  display: none;
}
</style>
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">Event Reviews </h3>
</div>
<div class="col-md-12 event_section">
  <table class="table table-striped table-bordered display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Event</th>
            <th>Category</th>
            <th>City/Area</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($result as $rows){
                 $status=$rows->event_status;
                        ?>
        <tr>
            <td><?php echo $rows->event_name ; ?></td>
            <td><?php echo $rows->category_name ; ?></td>
            <td><?php echo $rows->city_name ; ?></td>
            <td><a href="<?php echo base_url();?>home/viewreviews/<?php echo $rows->id;?>">
          <img title="View Reviews" src="<?php echo base_url();?>assets/icons/customerreviews.png"/></td>
        </tr>
       <?php  } ?>
        </tbody>
    </table>
</div>
<script>
$(document).ready(function() {
  $(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
  
	$('table').DataTable({
         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false
    });
} );
</script>

<style>
.event_section{
  height: 100vh;
}
.footer_section{
  display: none;
}
td{
  width: 100px;
}
table{
  background-color: #fff;
}
.table-striped>tbody>tr:nth-child(odd){
  background-color: #fff;
}
th{
  width: 150px;
}
.dataTables_filter {
   width: 50%;
   float: right;
   text-align: right;
}
</style>
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab"> Reviews events (  <?php if(empty($views)){ }else{ foreach ($views as $value) {} echo $value->event_name;  }  ?>)  </h3>
</div>
<div class="col-md-12 event_section">
  <div class="card card-outline-secondary" style="padding:5px;">
    <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
          <thead>
          <tr>
              <th>User / Name </th>
              <th>Rating</th>
              <th>Comments</th>

          </tr>
          </thead>
          <tbody>
           <?php foreach ($views as $value) {  
		   $sname = $value->name;
					if($sname == ''){
						 $name="Heyla User";
					  }else{
						 $name=$sname;
					  } 
		   ?>
          <tr>
              <td><?php echo $name ; ?></td>
              <td><?php echo $value->event_rating; ?></td>
              <td>  <?php echo $value->comments;?></td>

          </tr>
         <?php  } ?>
          </tbody>
      </table>
      </div>
</div>
<script>
$(document).ready(function() {
  $(document).on("preInit.dt", function(){
		$(".dataTables_filter input[type='search']").attr("maxlength", 20);
	});
  
	$('table').DataTable({
         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
        "iDisplayLength": 25,
		"ordering": false,
		"bAutoWidth": false,
		"columns": [
					{ "width": "15%" },
					{ "width": "10%" },
					{ "width": "75%" }
				  ]
    });
} );
</script>

<style>
.user_points{
    border-left: 4px solid #458ecc;
}
.event_section{
  height: 100vh;
}
.footer_section{
  display: none;
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
    <h3 class="dashboard_tab">Well endowed with points!</h3>
</div>
<div class="event_section">
  <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
              <tr>
                 <th>S. No</th>
                 <th>Name</th>
                 <th>Points Earned</th>
                 <th>Rank</th>
              </tr>
           </thead>
           <tbody>
<?php
				$user_id = $this->session->userdata('id');
                $i=1;
                foreach($user_points as $rows) 
				{
					$sname = $rows->name;
					$sid = $rows->id;
					
					   if($sname == ''){
						 $name="Heyla User";
					  }else{
						 $name=$sname;
					  } 
                ?>
			
              <tr>
                <td <?php if ($user_id == $sid) { ?>bgcolor="#e1e3e1"<?php } ?>><?php echo $i; ?></td>
                <td <?php if ($user_id == $sid) { ?>bgcolor="#e1e3e1"<?php } ?>><?php echo $name; ?></td>
                <td <?php if ($user_id == $sid) { ?>bgcolor="#e1e3e1"<?php } ?>><?php echo $rows->total_points;?></td>
                <td <?php if ($user_id == $sid) { ?>bgcolor="#e1e3e1"<?php } ?>><?php echo $i; ?></td>
              </tr>
             <?php $i++;  }  ?>
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

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

</style>
<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab">Points table</h3>
</div>
<div class="event_section">
  <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
              <tr>
                 <th>S.No</th>
                 <th>Name</th>
                 <th>Total Points</th>
                 <th>Rank</th>
              </tr>
           </thead>
           <tbody>
<?php
                $i=1;

                foreach($user_points['user_points'] as $rows) {
                  if(empty($rows['name'])){
                     $name=$rows['user_name'];
                  }else{
                     $name=$rows['name'];
                  }
                ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $rows['total_points']; ?></td>
                <td><?php echo $i; ?></td>
              </tr>
             <?php $i++;  }  ?>
           </tbody>
        </table>
</div>
<script>
$(document).ready(function() {
  $('table.display').DataTable();
} );
</script>

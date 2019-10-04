

    <div class="page-content-wrapper ">
        <div class="container">
           <?php if($this->session->flashdata('msg')): ?>
             <div class="alert <?php $msg=$this->session->flashdata('msg');
             if($msg=='Added Successfully' || $msg=='Deleted Successfully' || $msg=='updated Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                   ×</button> <?php echo $this->session->flashdata('msg'); ?>
                  </div>
                <?php endif; ?>


         <!-- <?php if(!empty($views)) { foreach ($views as $value) {  ?>
         <div class="row">
            <div class="col-md-10">
                <div class="card m-b-20 card-block">
                    <h3 class="card-title font-20 mt-0">  ( <?php echo $value->event_rating; ?> ) </h3>
                    <p class="card-text"><?php echo $value->comments;?></p>
              </div>
            </div>
        </div>
       <?php } }else{ echo "<p class=card-text> No reviews found for event</p>";}?> -->


       <div class="row">
         <div class="col-md-12">
           <table  class="table table-striped table-bordered display" cellspacing="0" width="100%">
           <thead>
           <tr>
               <th>S. No</th>
               <th style="width:150px;">Event</th>
               <th>Rating</th>
               <th style="width:250px;">Comments</th>
               <!-- <th style="width:250px;">Actions</th> -->
           </tr>
           </thead>
       <tbody>
     <?php $i=1; if(!empty($views)) { foreach ($views as $value) {  ?>
       <tr>
           <td><?php echo $i; ?></td>
           <td><?php echo $value->event_name;?> </td>
           <td><?php echo $value->event_rating; ?></td>
           <td><?php echo $value->comments;?></td>

          <!-- <td><a href="<?php echo base_url(); ?>reviews/display/<?php echo $value->id; ?>/Y/<?php echo $value->event_id; ?>/<?php echo $value->user_id; ?>" class="btn btn-success waves-effect waves-light">
              Display </a>
              &nbsp;<a href="<?php echo base_url(); ?>reviews/archive/<?php echo $value->id; ?>/A/<?php echo $value->event_id; ?>/<?php echo $value->user_id; ?>" class="btn btn-warning waves-effect waves-light">
        Archive</a>  </td> -->
       </tr>
     <?php $i++; }  }?>
       </tbody>
   </table>
         </div>
       </div>


        </div>
    </div>


</div> <!-- content -->
<script type="text/javascript">
  $('#vieweve').addClass("active");
  $('#events').addClass("has_sub active nav-active");
  $(document).ready(function() {
    $('table.display').DataTable();
  } );

</script>

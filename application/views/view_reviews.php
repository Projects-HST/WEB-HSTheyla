<div class="col-sm-12 col-md-12 " id="content">
    <h3 class="dashboard_tab"> Reviews events</h3>
</div>
<div class="col-md-12 ">
  <div class="card card-outline-secondary" style="padding:5px;">
   <?php if(!empty($views)) {
       foreach ($views as $value) {  ?>
        <div class="">
           <div class="col-md-10">
               <div class="card m-b-20 card-block">
                   <h3 class="card-title font-20 mt-0"> <?php echo $value->event_name;?> ( <?php echo $value->event_rating; ?> ) </h3>
                   <p class="card-text">
                    <?php echo $value->comments;?>
                 </p>
             </div>
           </div>
       </div>
     <!-- end row -->
       <?php }
     }else{
     echo "<p class=card-text> No Reviews Found </p>";
     }?>
      </div>


</div>

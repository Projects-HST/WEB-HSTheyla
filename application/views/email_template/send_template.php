<!-- Start content -->
 <!--Summernote js-->
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote.min.js"></script>
 <link href="<?php echo base_url(); ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />
<div class="content-page">
<div class="content">
   <!-- Top Bar Start -->
   <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>
            </li>
            <li class="list-inline-item dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
            <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
            <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
            <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
            <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>adminlogin/logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
            </div>
            </li>
         </ul>
         <ul class="list-inline menu-left mb-0">
         <li class="list-inline-item">
         <button type="button" class="button-menu-mobile open-left waves-effect">
         <i class="ion-navicon"></i>
         </button>
         </li>
         <li class="hide-phone list-inline-item app-search">
         <h3 class="page-title">Send Email</h3>
         </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
      </div>
      <!-- Top Bar End -->
      <div class="page-content-wrapper">
         <div class="container">
          <form method="post" action="<?php echo base_url();?>emailtemplate/select_users" name="emailform" id="emailform" style="margin-bottom: 20px;">
         <?php  if(empty($search_view)) { ?>
            <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <!--div class="mini-stat clearfix bg-primary"-->
                  <select class="form-control" name="countryid"   onchange="getstatename(this.value)">
                   <option value="">Select Country Name</option>
                     <?php foreach($countyr_list as $cntry){ ?>
                        <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                     <?php } ?>
                  </select>
                  <!--/div-->
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <select class="form-control" name="cityid" id="cityname" >
                    <option value="">Select City Name</option>
                  </select>
                 <div id="msg"></div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                     <input class="form-control"  type="text" name="username" id="example-text-input">
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <!--div class="mini-stat clearfix bg-primary"-->
                     <button type="submit" class="btn btn-primary waves-effect waves-light">
                      Submit </button>
                      <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                      Reset
                      </button>
                  <!--/div-->
              </div>
           
          </div>
          <?php }else{  foreach($search_view as $res) { } ?>
            <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <!--div class="mini-stat clearfix bg-primary"-->
                  <select class="form-control" name="countryid"   onchange="getstatename(this.value)">
                   <option value="">Select Country Name</option>
                     <?php foreach($countyr_list as $cntry){ ?>
                        <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                     <?php } ?>
                  </select>
                  <script language="JavaScript">document.emailform.countryid.value="<?php echo $res->country_id; ?>";</script>
                  <!--/div-->
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <select class="form-control" name="cityid" id="cityname" >
                     <?php foreach($city_list as $city){ ?>
                        <option value="<?php echo $city->id; ?>"><?php echo $city->city_name; ?></option>
                     <?php } ?>
                  </select>
                  <script language="JavaScript">document.emailform.cityid.value="<?php echo $res->city_id; ?>";</script>
                 <div id="msg"></div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                     <input class="form-control"  type="text" name="username" id="example-text-input" value="<?php //echo $res->user_name; ?>">
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <!--div class="mini-stat clearfix bg-primary"-->
                     <button type="submit" class="btn btn-primary waves-effect waves-light">
                      Submit </button>
                      <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                      Reset
                      </button>
                  <!--/div-->
              </div>
           
          </div>
         <?php } ?>
           </form>
               <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>
            <div class="row">
               <div class="col-12">
                  <div class="card m-b-20">
                     <div class="card-block">

                        <label id="user" style="width: 100%;"><input type="checkbox" class="checkbox" id="checkAll" style="display: inline;" />&nbsp;Check All
                         <!--div class="text-center">
                            < Large modal-->
                             <button type="button" id="sendSelectedBtn" data-toggle="modal" data-target="#addmodel" class="btn btn-primary waves-effect waves-light" >Send To Selected</button>

                             <button type="button" style="float: right;" data-toggle="modal" id="sendAll" data-target="#addmodel" class="btn btn-primary waves-effect waves-light" >Send To All</button>
                        <!--/div-->
                      </label>
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>S.NO</th>
                          <th>#</th>
                          <th>Email</th>
                        </tr>
                     </thead>
                     <tbody>
				                <?php
                          $i=1;
                          if(empty($search_view))
                          {
                            $pro_id = [];
                           foreach($view as $rows) { $pro_id[] = $rows->email_id; $a=implode(',',$pro_id);?>
                            <tr>
                               <td><?php  echo $i; ?></td>
                               <td><input type="checkbox" name="email[]" id="sendmail" class="checkbox check" value="<?php  echo $rows->email_id; ?>"></td>
                               <td><?php  echo $rows->email_id; ?></td>
                            </tr>
                           <?php $i++;  } ?> 
                           <div style="display: none;">
                              <input type="text" name="useremail[]"  class="demo" value="<?php echo $a; ?>">
                           </div>
                            <?php  }else{  $ser_id = [];
                             foreach($search_view as $res){   $ser_id[] = $res->email_id; $b=implode(',',$ser_id); ?>
                            <tr>
                               <td><?php  echo $i; ?></td>
                               <td>
                                 <input type="checkbox" name="email[]" id="sendmail" class="checkbox check" value="<?php  echo $res->email_id; ?>">
                              </td>
                               <td><?php  echo $res->email_id; ?></td>
                            </tr>
                       <?php $i++;  } ?> 
                       <div style="display: none;"> 
                        <input type="text" name="useremail[]"  class="demo" value="<?php echo $b; ?>"> </div>
                       <?php }?>
                     </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- end col -->
            </div>
            <!-- end row -->
         </div>
		   <!-- container -->
      </div>
     <!-- Page content Wrapper -->
   </div>
    <!-- Top Bar Start -->

       <div class="col-4 m-t-30">
        <!--  Modal content for the above example -->
        <div class="modal fade" id="addmodel" role="dialog" >
            <div class="modal-dialog">
               <!-- Modal content-->
               <div class="modal-content">
                   <div class="modal-header">
                      <h5 class="modal-title mt-0" id="myLargeModalLabel">Email Templates</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  </div>
               <div class="modal-body">
               <form method="post" action="<?php echo base_url();?>emailtemplate/send_email" >
            <select class="form-control" required="" name="email_temp_id" id="email_temp_id" style="margin-bottom:05%;" >
                  <option value="">Select Templates</option>
                    <?php foreach($email_tem as $temp){ ?>
                        <option value="<?php echo $temp->id; ?>"><?php echo $temp->template_name; ?></option>
                     <?php } ?>
                  </select>
                <input type="hidden" id="emails_id" name="usersemailid" class="form-control"/>
               
                  <div class="col-md-6 col-lg-6 col-xl-3">
                  <!--div class="mini-stat clearfix bg-primary"-->
                     <button type="submit" class="btn btn-primary waves-effect waves-light">
                      Send </button>
                    
                  <!--/div-->
              </div>
            </form>
                </div>
               </div>
            </div>
         </div>
    </div>

</div>
<!-- content -->
<script type="text/javascript">
 $(document).ready(function () {
   $('#checkAll:checkbox').change(function() {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
           // var selected_value=[]; // initialize empty array 
           // $('#sendmail:checked').each(function(){
           //  selected_value.push($(this).val());
           // });
           // console.log(selected_value);
            });
     });

 $(document).on("click", "#sendSelectedBtn", function () 
   {   
     if($('input[name="email[]"]:checked').length > 0) {
        var selected_value=[]; //initialize empty array 
        $('#sendmail:checked').each(function()
        {
         selected_value.push($(this).val());
        });
      $(".modal-body #emails_id").val(selected_value);
      // $('#addmodel').modal();

   }else{
         alert('Please select any one user');
         return false;
         }
   });

      $(document).on("click","#sendAll", function() 
       { 
           var all_value=[]; 
           $("input:text.demo").each(function()
           {
            //energy=all_value.toString($(this).val());
            all_value.push($(this).val());
           });
          $(".modal-body #emails_id").val(all_value);
      });
  
  function getstatename(cid) {
      //alert(cid);
      $.ajax({
         type: 'post',
         url: '<?php echo base_url(); ?>emailtemplate/get_city_name',
         data: {
             country_id:cid
         },
       dataType: "JSON",
       cache: false,
      success:function(test)
      {
         //alert(test);
         var len = test.length;
        //alert(len);
        var citynames='';
        if(test!='')
         {     //alert(len);
            for(var i=0; i<len; i++)
            {
            var cityid = test[i].id;
            var city_name = test[i].city_name;
            //alert(city_name);
            citynames +='<option value=' + cityid + '>' + city_name + '</option>';
            }
            $("#cityname").html(citynames).show();
            $("#msg").hide();
            }else{
            $("#msg").html('<p style="color: red;">City Name Not Found</p>').show();
            $("#cityname").hide();
           }
      }
    }); 
 }

</script>


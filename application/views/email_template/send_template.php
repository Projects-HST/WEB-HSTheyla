      <div class="page-content-wrapper">
         <div class="container">
           <h4 class="mt-0 header-title"> Send Email</h4>

          <form method="post" action="<?php echo base_url();?>emailtemplate/select_users" name="newsletterform" id="newsletterform" style="margin-bottom: 20px;">
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
                  <script language="JavaScript">document.newsletterform.countryid.value="<?php echo $res->country_id; ?>";</script>
                  <!--/div-->
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                  <select class="form-control" name="cityid" id="cityname" >
                     <?php foreach($city_list as $city){ ?>
                        <option value="<?php echo $city->id; ?>"><?php echo $city->city_name; ?></option>
                     <?php } ?>
                  </select>
                  <script language="JavaScript">document.newsletterform.cityid.value="<?php echo $res->city_id; ?>";</script>
                 <div id="msg"></div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                     <input class="form-control"  type="text" name="username" placeholder="Type User Name" id="example-text-input" value="<?php //echo $res->user_name; ?>">
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

                        <label id="user" style="width: 100%;"><input type="checkbox" class="checkbox" id="checkAll" style="display: inline;" />&nbsp; Select Current Page
                         <!--div class="text-center">
                            < Large modal-->
                             <button type="button" id="sendSelectedBtn" data-toggle="modal" data-target="#addmodel" class="btn btn-primary waves-effect waves-light" >Send To Selected</button>

                             <button type="button" style="float: right;" data-toggle="modal" id="sendAll" data-target="#addmodel" class="btn btn-primary waves-effect waves-light" >Send To All</button>
                        <!--/div-->
                      </label>
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th></th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                        </tr>
                     </thead>
                     <tbody>
<?php
                          $i=1;
                          if(empty($search_view))
                          {
                            $usr_id = [];
                           	foreach($view as $rows) {
								$usr_id[] = $rows->user_id;
								$a = implode(',',$usr_id);
?>
                            <tr>
                               <td><?php  echo $i; ?></td>
                               <td><input type="checkbox" name="users_id[]" id="sendnews" class="checkbox check" value="<?php  echo $rows->user_id; ?>"></td>
                               <td><?php  echo $rows->name; ?></td>
                                <td><?php  echo $rows->email_id; ?></td>
                                <td><?php  echo $rows->mobile_no; ?></td>
                            </tr>
                           <?php $i++;  } ?>
                           <div style="display: none;"><input type="text" name="userid[]"  class="demo" value="<?php echo $a; ?>"></div>
                           <?php  }else{

							$usr_id = [];
                             foreach($search_view as $res){
								 $usr_id[] = $res->user_id;
								 $b=implode(',',$usr_id); ?>
                            <tr>
                               <td><?php  echo $i; ?></td>
                               <td>
                                 <input type="checkbox" name="users_id[]" id="sendnews" class="checkbox check" value="<?php  echo $res->user_id; ?>">
                              </td>
                               <td><?php  echo $res->name; ?></td>
                               <td><?php  echo $res->email_id; ?></td>
                               <td><?php  echo $res->mobile_no; ?></td>
                            </tr>
                       <?php $i++;  } ?>
                       		<div style="display: none;"><input type="text" name="userid[]"  class="demo" value="<?php echo $b; ?>"></div>
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
               <!--<form method="post" action="<?php echo base_url();?>emailtemplate/send_email" >-->
               <form method="post" action="<?php echo base_url();?>emailtemplate/send_newsletter" >
                 <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Select Template</label>
                    <div class="col-sm-8">
                      <select class="form-control" required="" name="email_temp_id" id="email_temp_id" style="margin-bottom:05%;" >
                        <option value="">Select Templates</option>
                          <?php foreach($email_tem as $temp){ ?>
                              <option value="<?php echo $temp->id; ?>"><?php echo $temp->template_name; ?></option>
                           <?php } ?>
                        </select>
                    </div>
                 </div>
                 <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Send Via</label>
                    <div class="col-sm-8">
                      <input type="checkbox" name="email" value="email">Email</input>
  					          <input type="checkbox" name="sms" value="sms">SMS</input>
                      <input type="checkbox" name="notify" value="notify">Notification</input>
                      <input type="hidden" id="user_id" name="user_id" class="form-control"/>

                    </div>
                 </div>

                 <div class="form-group row">
                    <label class="col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                     <button type="submit" class="btn btn-primary waves-effect waves-light">Send</button>

                    </div>
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
           // $('#sendnews:checked').each(function(){
           //  selected_value.push($(this).val());
           // });
           // console.log(selected_value);
            });
     });

 $(document).on("click", "#sendSelectedBtn", function ()
   {
	$('#addmodel').modal('show');
     if($('input[name="users_id[]"]:checked').length > 0) {
        var selected_value=[]; //initialize empty array
        $('#sendnews:checked').each(function()
        {
         selected_value.push($(this).val());
        });
      $(".modal-body #user_id").val(selected_value);


   }else{
         	alert('Please select any one user');
        	$('#addmodel').modal('hide');
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
          $(".modal-body #user_id").val(all_value);
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

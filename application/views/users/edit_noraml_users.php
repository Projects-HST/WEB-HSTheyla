<style>
.label-value{
  font-size: 18px;
}
</style>

   <div class="page-content-wrapper ">
     <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">

                 <h4 class="mt-0 header-title"> Edit Users Details </h4>

                  <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert <?php $msg=$this->session->flashdata('msg');
                    if($msg=='Added Successfully' || $msg=='Updated Successfully'){ echo "alert-success"; }else{ echo "alert-danger"; } ?>">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>


                <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>users/update_user_details" name="usersform" id="usersform" onSubmit='return check();'>
<?php foreach($users_view AS $res){ } ?>
                        <div class="form-group row">

                          <label for="Category" class="col-sm-2 col-form-label">User Id / Name</label>
                            <div class="col-sm-4">
                            <p class="label-value"><?php echo $res->user_name; ?> </p>
                            <input class="form-control" type="hidden" name="umid" value="<?php echo $res->user_id; ?>">
                                <p id="msg2" style="color:red;"> </p>
                            </div>

                      </div>
                           <div class="form-group row">
                            <label for="Category" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-4">
                          <p class="label-value"><?php echo $res->name; ?></p>
                          <input class="form-control" type="hidden" name="uid" value="<?php echo $res->id; ?>">

                            </div>

                            <label for="Name" class="col-sm-2 col-form-label">Mobile Number</label>
                            <div class="col-sm-4">

                            <p class="label-value"><?php echo $res->mobile_no; ?></p>
                              <p id="msg1" style="color:red;"> </p>
                            </div>

                        </div>
                       <div class="form-group row">
                          <label for="Name" class="col-sm-2 col-form-label">Email Id</label>
                            <div class="col-sm-4">

                                <p class="label-value"><?php echo $res->email_id;?></p>
                                  <p id="msg" style="color:red;"> </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Venue" class="col-sm-2 col-form-label">DOB</label>
                            <div class="col-sm-4">
                              <div class="input-group">

                                <p class="label-value"><?php if($res->birthdate!='0000-00-00')
                                { //echo $res->birthdate;
                                   $date=date_create($res->birthdate); echo date_format($date,"m-d-Y"); }else{ echo date("m-d-Y"); } ?></p>
                            </div>
                            </div>
                             <label for="Address" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="gender" name="gender">
                                   <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <script type="text/javascript">document.usersform.gender.value="<?php echo $res->gender; ?>";</script>
                            </div>

                        </div>
                        <div class="form-group row">

                            <label for="Description" class="col-sm-2 col-form-label">Occupation</label>
                            <div class="col-sm-4">
                                <p class="label-value"><?php echo $res->occupation;?></p>

                            </div>

                             <label for="ecost" class="col-sm-2 col-form-label">Address1</label>
                            <div class="col-sm-4">

                                 <p class="label-value"><?php echo $res->address_line1;?></p>
                            </div>
                        </div>


                        <div class="form-group row">

                             <label for="country" class="col-sm-2 col-form-label">Select Country</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="country" id="country_id" onchange="getstatename(this.value)">
                              <option value="">Select Country Name</option>
                                     <?php foreach($country_list as $cntry){ ?>
                                        <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                </select>
                                 <script type="text/javascript">document.usersform.country.value="<?php echo $res->country_id; ?>";</script>
                            </div>

                        <label for="city" class="col-sm-2 col-form-label">Select State Name</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="statename" id="staname" onchange="getcityname(this.value)">
                                <?php $coid=$res->country_id;
                                 $sql="SELECT id,state_name,event_status FROM state_master WHERE event_status='Y' AND country_id='$coid' ORDER BY id ASC";
                                   $resu=$this->db->query($sql);
                                   $res1=$resu->result();
                                   foreach($res1 AS $res2){?>
                                 <option value="<?php echo $res2->id;?>"><?php echo $res2->state_name;?></option>
                                 <?php } ?>
                                </select>
                                <script type="text/javascript">document.usersform.statename.value="<?php echo $res->state_id; ?>";</script>
                                <div id="smsg"></div>
                                <div  id="st"></div>
                            </div>

                       </div>

                        <div class="form-group row">

                           <label for="city" class="col-sm-2 col-form-label">Select City</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="city" id="ctname">
                                <?php $stid=$res->state_id;
                                 $sql="SELECT id,city_name FROM city_master WHERE event_status='Y' AND state_id='$stid' ORDER BY id ASC";
                                   $resu=$this->db->query($sql);
                                   $res1=$resu->result();
                                   foreach($res1 AS $res2){?>
                                 <option value="<?php echo $res2->id;?>"><?php echo $res2->city_name;?></option>
                                 <?php } ?>

                                </select>
                                 <script type="text/javascript">document.usersform.city.value="<?php echo $res->city_id; ?>";</script>
                                <div id="cmsg"></div>
                            </div>

                            <label for="Colour" class="col-sm-2 col-form-label">zip</label>
                            <div class="col-sm-4">

                                <p class="label-value"><?php echo $res->zip;?></p>
                            </div>

                        </div>


                        <div class="form-group row">
                              <div class="col-sm-4">

                                 <input type="hidden" name="old_picture" class="form-control" value="<?php echo $res->user_picture; ?>" >
                                 <input type="hidden" name="userrole" class="form-control" value="<?php echo $res->user_role; ?>" >
                              </div>



                        </div>


                        <div class="form-group row">
                           <label for="Status" class="col-sm-2 col-form-label">Newsletter Status</label>
                            <div class="col-sm-4">
                               <select class="form-control"  name="status" id="status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                 <script type="text/javascript">document.usersform.status.value="<?php echo $res->status; ?>";</script>
                            </div>

                            <label for="Status" class="col-sm-2 col-form-label">Display Status</label>
                            <div class="col-sm-4">
                               <select class="form-control"  name="display_status" >
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                 <script type="text/javascript">document.usersform.display_status.value="<?php echo $res->newsletter_status; ?>";</script>
                            </div>

                        </div>


                        <div class="form-group row">
                          <label for="Status" class="col-sm-2 col-form-label">Current  Pic</label>
                         <div class="col-sm-4">
                         <img src="<?php echo base_url();?>/assets/users/<?php echo $res->user_picture; ?>" style="width:25%;" >
                         </div>
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-2">
                              <button type="submit" id="save" class="btn btn-primary waves-effect waves-light">
                              Submit </button></div>

                        </div>
                     </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
      </div><!-- container -->
   </div>
   <!-- Page content Wrapper -->
</div>
<!-- content -->

<script type="text/javascript">

  $('#viewuser').addClass("active");
  $('#users').addClass("has_sub active nav-active");

 $('#ctname').prop('disabled', 'disabled');
 $('#country_id').prop('disabled', 'disabled');
 $('#staname').prop('disabled', 'disabled');
 $('#gender').prop('disabled', 'disabled');

  function check(){
          var sname = document.getElementById("staname").value;
          if(sname=="Select State")
          {
            //$("#st").html('<p style="color:red;">Select State</p>').show();
            alert("Select State");
          }else{
           // $("#st").html('<p style="color:red;">Select State</p>').hide();
          }
       }
   $(document).ready(function () {

     $('#usersform').validate({
        rules: {
          username:{required:true,
            remote: {
                   url: "<?php echo base_url(); ?>users/username_checker_exist/<?php echo $res->id ?>",
                   type: "post"
                }
          },
          name:{required:true},
          mobile:{required:true,
            remote: {
                   url: "<?php echo base_url(); ?>users/mobile_checker_exist/<?php echo $res->id ?>",
                   type: "post"
                }
          },
          email:{required:true,
            remote: {
                   url: "<?php echo base_url(); ?>users/mail_checker_exist/<?php echo $res->id ?>",
                   type: "post"
                }
          },
          pwd:{required:true },
          dob:{required:true },
          gender:{required:true },
          occupation:{required:true },
          address1:{required:true },
          country:{required:true },
          statename:{required:true },
          city:{required:true },
          zip:{required:true },
          //user_picture:{required:true },
          status:{required:true },
          userrole:{required:true},
          display_status:{required:true}
         },

         messages: {
         username: { required:"Enter the Username ",remote:"Username Already Exists" },
         name:"Enter Name",
         mobile: { required:"Enter the Mobile Number ",remote:"Mobile Number Already Exists" },
         email: { required:"Enter the Email ",remote:"Email Already Exists" },
         pwd:"Enter Password",
         dob:"Select DOB",
         gender:"Select Gender",
         occupation:"Enter Occupation",
         address1:"Enter Address1",
         country:"Select Country Name",
         statename:"Select State Name",
         city:"Select City Name",
         zip:"Enter Zip",
         status:"Select Status",
         userrole:"Select User Role",
         display_status:"Select Display Status"
               },
          });
    });


  function getstatename(cuid)
  {
         //alert(cuid);
            $.ajax({
               type: 'post',
               url: '<?php echo base_url(); ?>users/get_state_name',
               data: {
                   country_id:cuid
               },
             dataType: "JSON",
             cache: false,
            success:function(test)
            {
              //alert(test);
              var len = test.length;
              //alert(len);
              var statename='';
              var title='<option>Select State</option>';
              if(test!='')
              {    //alert(len);
                  for(var i=0; i<len; i++)
                  {
                    var staid = test[i].id;
                    var state_name = test[i].state_name;
                    //alert(city_name);
                    statename +='<option value=' + staid + '> ' + state_name + ' </option>';
                  }
                  $("#staname").html(title+statename).show();
                  $("#smsg").hide();
                  $("#ctname").empty('');
                  $("#ctname").show();
                  $("#cmsg").hide();
              }else{
                  $("#smsg").html('<p style="color:red;">State Not Found</p>').show();
                  $("#staname").hide();
                  $("#ctname").hide("");
                 }
            }
          });
  }

 function getcityname(cid) {
           //alert(cid);
            $.ajax({
               type: 'post',
               url: '<?php echo base_url(); ?>users/get_city_name',
               data: {
                   sta_id:cid
               },
             dataType: "JSON",
             cache: false,
             success:function(test)
             {
              // alert(test);
              var len = test.length;
              //alert(len);
              var cityname='';
              var ctitle='<option>Select City</option>';
              if(test!='')
              {    //alert(len);
                for(var i=0; i<len; i++)
                {
                  var cityid = test[i].id;
                  var city_name = test[i].city_name;
                  //alert(city_name);
                  cityname +='<option value=' + cityid + '> ' + city_name + ' </option>';
                }
                  $("#ctname").html(ctitle+cityname).show();
                  $("#cmsg").hide();
                  }else{
                  $("#cmsg").html('<p style="color: red;">City Not Found</p>').show();
                  $("#ctname").hide();
                }
            }
          });
       }


</script>

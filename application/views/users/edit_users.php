<!--div class="content-page">

<!- Start content ->
<div class="content">
   <!- Top Bar Start ->
   <div class="topbar">
      <nav class="navbar-custom">
         <ul class="list-inline float-right mb-0">
            <!-li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <i class="ion-ios7-bell noti-icon"></i>
               <span class="badge badge-success noti-icon-badge">3</span>
               </a>
            </li!->
            <li class="list-inline-item dropdown notification-list">
               <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
               <img src="<?php echo base_url(); ?>assets/images/admin/admin.png" alt="user" class="rounded-circle">
               </a>
               <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                  <!-a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                  <a class="dropdown-item" href="#"><span class="badge badge-success pull-right">5</span><i class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                  <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a!->
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
               <h3 class="page-title">Edit Users Details</h3>
            </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
   </div-->
   <div class="page-content-wrapper ">
     <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">

                 <h4 class="mt-0 header-title"> Edit Users Details </h4>

                  <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>


                <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>users/update_user_details" name="usersform" id="usersform" onSubmit='return check();'>
                  <?php foreach($users_view AS $res){ }?>
                        <div class="form-group row">

                          <label for="Category" class="col-sm-2 col-form-label">User Id / Name</label>
                            <div class="col-sm-4">
                            <input class="form-control" type="text" name="username" value="<?php echo $res->user_name; ?>" onkeyup="checkusernamefun(this.value)">
                            <input class="form-control" type="hidden" name="umid" value="<?php echo $res->user_id; ?>">
                                <p id="msg2" style="color:red;"> </p>
                            </div>
                      </div>
                           <div class="form-group row">
                            <label for="Category" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-4">
                          <input class="form-control" type="text" name="name" value="<?php echo $res->name; ?>">
                          <input class="form-control" type="hidden" name="uid" value="<?php echo $res->id; ?>">

                            </div>

                            <label for="Name" class="col-sm-2 col-form-label">Mobile Number</label>
                            <div class="col-sm-4">
                            <input class="form-control" type="text" name="mobile" value="<?php echo $res->mobile_no;?>" onkeyup="checkmobilefun(this.value)">
                              <p id="msg1" style="color:red;"> </p>
                            </div>

                        </div>
                       <div class="form-group row">
                          <label for="Name" class="col-sm-2 col-form-label">Email Id</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" id="email" name="email" value="<?php echo $res->email_id;?>" onchange="checkemailfun()" >
                                  <p id="msg" style="color:red;"> </p>
                            </div>
                              <label for="Name" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-4">
                              <input class="form-control" type="text"  name="new_pwd" >
                              <input class="form-control" type="hidden"  name="old_pwd"  value="<?php echo $res->password;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Venue" class="col-sm-2 col-form-label">DOB</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                          <input type="text" class="form-control" name="dob" id="datepicker-autoclose" value="<?php if($res->birthdate!='0000-00-00')
                          { //echo $res->birthdate;
                             $date=date_create($res->birthdate); echo date_format($date,"m-d-Y"); }else{ echo date("m-d-Y"); } ?>">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>
                             <label for="Address" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-4">
                                <select class="form-control"  name="gender">
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
                               <input class="form-control" type="text" name="occupation" value="<?php echo $res->occupation;?>">
                            </div>

                             <label for="ecost" class="col-sm-2 col-form-label">Address1</label>
                            <div class="col-sm-4">
                                 <textarea id="textarea" name="address1" class="form-control" maxlength="100" rows="3"><?php echo $res->address_line1;?></textarea>
                            </div>
                        </div>
                       <div class="form-group row">

                            <label for="ecost" class="col-sm-2 col-form-label">Address2</label>
                            <div class="col-sm-4">
                                 <textarea id="textarea" name="address2"  class="form-control" maxlength="100" rows="3"><?php echo $res->address_line2;?></textarea>
                            </div>
                             <label for="ecost" class="col-sm-2 col-form-label">Address3</label>
                            <div class="col-sm-4">
                                 <textarea id="textarea" name="address3"  class="form-control" maxlength="100" rows="3"><?php echo $res->address_line3;?></textarea>
                            </div>

                        </div>

                        <div class="form-group row">

                             <label for="country" class="col-sm-2 col-form-label">Select Country</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="country" onchange="getstatename(this.value)">
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
                                <input class="form-control" type="text" name="zip" value="<?php echo $res->zip; ?>" >
                            </div>

                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">User Picture</label>
                              <div class="col-sm-4">
                                 <input type="file" name="user_picture" class="form-control" accept="image/*" >
                                 <input type="hidden" name="old_picture" class="form-control" value="<?php echo $res->user_picture; ?>" >
                              </div>

                              <label for="Status" class="col-sm-2 col-form-label">User Role</label>
                            <div class="col-sm-4">
                               <select class="form-control"  name="userrole">
                                    <option value="">Select User Role</option>
                                    <?php foreach ($users_role as $value) { ?>
                                     <option value="<?php echo $value->id; ?>"><?php echo $value->user_role_name; ?></option>
                                   <?php } ?>
                                </select>
                                <script type="text/javascript">document.usersform.userrole.value="<?php echo $res->user_role; ?>";</script>
                            </div>

                        </div>


                        <div class="form-group row">
                           <label for="Status" class="col-sm-2 col-form-label">Newsletter Status</label>
                            <div class="col-sm-4">
                               <select class="form-control"  name="status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                 <script type="text/javascript">document.usersform.status.value="<?php echo $res->status; ?>";</script>
                            </div>

                            <label for="Status" class="col-sm-2 col-form-label">Display Status</label>
                            <div class="col-sm-4">
                               <select class="form-control"  name="display_status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                                 <script type="text/javascript">document.usersform.display_status.value="<?php echo $res->newsletter_status; ?>";</script>
                            </div>

                        </div>


                        <div class="form-group row">
                             <label for="Status" class="col-sm-2 col-form-label">Old  Pic</label>
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
    $('#usersform').validate({ // initialize the plugin
       rules: {
         username:{required:true },
         name:{required:true},
         mobile:{required:true },
         email:{required:true,
         //   remote: {
         //   url: "<?php echo base_url(); ?>users/mail_checker",
         //   type: "post",
         //   data: {
         //     email: function() {
         //       return $( "#email" ).val();
         //     }
         //   }
         // }

          },
         pwd:{required:true },
         dob:{required:true },
         gender:{required:true },
         occupation:{required:true },
         address1:{required:true },
         //address2:{required:true },
         //address3:{required:true },
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
        username:"Enter UserName",
        name:"Enter Name",
        email: {
          required: "Email required"

        },
        mobile:"Enter Mobile Number",
        // email:"Enter Email Id",
        pwd:"Enter Password",
        dob:"Select DOB",
        gender:"Select Gender",
        occupation:"Enter Occupation",
        address1:"Enter Address1",
        //address2:"Enter Address2",
        //address3:"Enter Address3",
        country:"Select Country Name",
        statename:"Select State Name",
        city:"Select City Name",
        zip:"Enter Zip",
        //user_picture:"Select User Picture",
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
 function checkusernamefun(val)
  {
   $.ajax({
     type:'post',
     url:'<?php echo base_url(); ?>/users/username_checker',
     data:'uname='+val,
     success:function(test)
     {
       if(test=="UserName already Exit")
         {
           $("#msg2").html('<p style="color:red;"><b>UserName already Exit</b></p>');
           $("#save").hide();
           $("#save1").hide();
           //$("#mfun").hide();
           //$("#efun").hide();
          }else{
            $("#msg2").html('<p style="color:green;"><b>UserName Available</b></p>');
            $("#save").show();
            $("#save1").show();
           //$ ("#mfun").show();
           //$("#efun").show();
          }
      }
   });
  }

  function checkemailfun(val)
  {
   $.ajax({
     type:'post',
     url:'<?php echo base_url(); ?>/users/mail_checker',
     data:'email='+val,
     success:function(test)
      {
       if(test=="Email Id already Exit")
         {
            $("#msg").html('<p style="color:red;"><b>Email Id already Exit</b></p>');
            $("#save").hide();
            $("#save1").hide();
            //$("#mfun").hide();
            //$("#ufun").hide();
          }else{
            $("#msg").html('<p style="color:green;"><b>Email Id Available</b></p>');
            $("#save").show();
            $("#save1").show();
            //$("#mfun").show();
            //$("#ufun").show();
          }
      }
   });
  }

   function checkmobilefun(val)
   {
    $.ajax({
    type:'post',
    url:'<?php echo base_url(); ?>/users/mobile_checker',
    data:'cell='+val,
    success:function(test)
    {
      if(test=="Mobile Number already Exit")
        {
          $("#msg1").html('<p style="color:red;"><b>Mobile Number already Exit</b></p>');
          $("#save").hide();
          $("#save1").hide();
          //$("#efun").hide();
          //$("#ufun").hide();
          }else{
             $("#msg1").html('<p style="color:green;"><b>Mobile Number Available</b></p>');
             $("#save").show();
             $("#save1").show();
             //$("#efun").show();
            // $("#ufun").show();
          }
      }
   });
  }

</script>

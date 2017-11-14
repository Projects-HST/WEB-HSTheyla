<div class="content-page">
<!-- Footer Close-->
<!-- Start content -->
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
               <h3 class="page-title">Add Users Details</h3>
            </li>
         </ul>
         <div class="clearfix"></div>
      </nav>
   </div>
   <div class="page-content-wrapper ">
     <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">
                     
                 <h4 class="mt-0 header-title"></h4>

                  <?php if($this->session->flashdata('msg')): ?>
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                           ×</button> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <?php endif; ?>


                <form method="post" enctype="multipart/form-data" action="<?php echo base_url();?>users/add_user_details" name="usersform" id="usersform" onSubmit='return check();'>
                       
                        <div class="form-group row">
                            <label for="Category" class="col-sm-2 col-form-label">User Name</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="username" onkeyup="checkusernamefun(this.value)">
                                <p id="msg2" style="color:red;"> </p>
                            </div>
                        
                        <label for="Category" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="name">
                            </div>
                            </div>

                        <div class="form-group row">
                            <label for="Name" class="col-sm-2 col-form-label">Mobile Number</label>
                            <div class="col-sm-4">
                <input class="form-control" type="text"  name="mobile" id="mfun" onkeyup="checkmobilefun(this.value)">
                  <p id="msg1" style="color:red;"> </p>
                            </div>
                             <label for="Name" class="col-sm-2 col-form-label">Email Id</label>
                            <div class="col-sm-4">
                <input class="form-control" type="text" id="efun" name="email" onkeyup="checkemailfun(this.value)" >
                                 <p id="msg" style="color:red;"> </p>
                            </div>
               <!-- onkeyup="checkemailfun(this.value)" -->
                        </div>
                       <div class="form-group row">
                         
                              <label for="Name" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text"  name="pwd">
                            </div>
                            <label for="Venue" class="col-sm-2 col-form-label">DOB</label>
                            <div class="col-sm-4">
                              <div class="input-group">
                                <input type="text" class="form-control"  name="dob" id="datepicker-autoclose">
                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar"></i></span>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                             <label for="Address" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-4">
                                <select class="form-control"  name="gender">
                                   <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <label for="Description" class="col-sm-2 col-form-label">Occupation</label>
                            <div class="col-sm-4">
                               <input class="form-control" type="text"  name="occupation">
                            </div>

                        </div>
                        <div class="form-group row">
                             <label for="ecost" class="col-sm-2 col-form-label">Address1</label>
                            <div class="col-sm-4">
                                 <textarea id="textarea" name="address1"  class="form-control" maxlength="100" rows="3"></textarea>
                            </div>
                            <label for="ecost" class="col-sm-2 col-form-label">Address2</label>
                            <div class="col-sm-4">
                                 <textarea id="textarea" name="address2"  class="form-control" maxlength="100" rows="3"></textarea>
                            </div>
                        </div>
                       <div class="form-group row">

                             <label for="ecost" class="col-sm-2 col-form-label">Address3</label>
                            <div class="col-sm-4">
                                 <textarea id="textarea" name="address3"  class="form-control" maxlength="100" rows="3"></textarea>
                            </div>
                             <label for="country" class="col-sm-2 col-form-label">Select Country</label>
                            <div class="col-sm-4">
                              <select class="form-control" name="country" onchange="getstatename(this.value)">
                              <option value="">Select Country Name</option>
                                     <?php foreach($country_list as $cntry){ ?>
                                        <option value="<?php echo $cntry->id; ?>"><?php echo $cntry->country_name; ?></option>
                                     <?php } ?>
                                </select>
                            </div>
                            
                        </div>
                        
                        <div class="form-group row">

                        <label for="city" class="col-sm-2 col-form-label">Select State Name</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="statename" required="" id="staname" onchange="getcityname(this.value)">
                                 
                                </select>
                                <div id="smsg"></div>
                            </div>
                             <label for="city" class="col-sm-2 col-form-label">Select City</label>
                            <div class="col-sm-4">
                               <select class="form-control" name="city" id="ctname">
                                
                                </select>
                                <div id="cmsg"></div>
                            </div>

                       </div>

                        <div class="form-group row">
                            <label for="Colour" class="col-sm-2 col-form-label">zip</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="zip" >
                            </div>
                            <label class="col-sm-2 col-form-label">User Picture</label>
                              <div class="col-sm-4">
                                 <input type="file" name="user_picture" class="form-control" accept="image/*" >
                              </div> 

                        </div>

                        <div class="form-group row">
                          
                              <label for="Status" class="col-sm-2 col-form-label">User Role</label>
                            <div class="col-sm-4">
                               <select class="form-control"  name="userrole">
                                    <option value="">Select User Role</option>
                                    <?php foreach ($users_role as $value) { ?>
                                     <option value="<?php echo $value->id; ?>"><?php echo $value->user_role_name; ?></option>
                                   <?php } ?>
                                </select>
                            </div>
                              <label for="Status" class="col-sm-2 col-form-label">Newsletter Status</label>
                            <div class="col-sm-4">
                               <select class="form-control"  name="status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="Status" class="col-sm-2 col-form-label">Display Status</label>
                            <div class="col-sm-4">
                               <select class="form-control"  name="display_status">
                                    <option value="">Select Status</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </div>

                        </div>


                        <div class="form-group row">
                            
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-2">
                              <button type="submit" id="save" class="btn btn-primary waves-effect waves-light">
                              Submit </button></div>
                              <div class="col-sm-2">
                              <button type="reset" id="save1" class="btn btn-secondary waves-effect m-l-5">
                              Reset
                              </button></div>
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

   function check(){
          var sname = document.getElementById("staname").value;
          //alert(sname);
          if(sname=="Select State")
          {
            //$("#st").html('<p style="color:red;">Select State</p>').show(); 
            alert("Select State");
          }else{
            //$("#st").html('<p style="color:red;">Select State</p>').hide(); 
          }
       }

   $(document).ready(function () {
    $('#usersform').validate({ // initialize the plugin
       rules: {
         username:{required:true },
         name:{required:true},
         mobile:{required:true },
         email:{required:true },
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
        mobile:"Enter Mobile Number",
        email:"Enter Email Id",
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
                var len = test.length;
               //alert(len);
                var cityname='';
                var ctitle='<option>Select City</option>';
                if(test!='')
                 // alert(test);
                {   //alert(len);
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
                  //$("#ctname").val("");
                  $("#cmsg").html('<p style="color: red;">City Not Found</p>').show();
                  $("#ctname").hide();
                 }
            }
          }); 
       }



// function checkfun(val)
//   {
//    $.ajax({
//      type:'post',
//      url:'<?php echo base_url(); ?>/users/checker',
//      data:'valtext='+val,
//      success:function(test)
//      {
//        if(test=="Already Exit")
//          {
//            $("#msg3").html(test);
//            $("#save").hide();
//            $("#save1").hide();
//           }else{
//             $("#msg3").html(test);
//             $("#save").show();
//             $("#save1").show();
//           }
//       }
//    });
//   }


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
           $("#msg2").html(test);
           $("#save").hide();
           $("#save1").hide();
           $("#mfun").hide();
           $("#efun").hide();
          }else{
            $("#msg2").html(test);
            $("#save").show();
            $("#save1").show();
            $("#mfun").show();
           $("#efun").show();
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
            $("#msg").html(test);
            $("#save").hide();
            $("#save1").hide();
          }else{
            $("#msg").html(test);
            $("#save").show();
            $("#save1").show();
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
          $("#msg1").html(test);
          $("#save").hide();
          $("#save1").hide();
          $("#efun").hide();
          }else{
             $("#msg1").html(test);
             $("#save").show();
             $("#save1").show();
             $("#efun").show();
          }
      }
   });
  }
</script>



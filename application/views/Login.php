<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Admin Dashboard</title>
<meta content="Admin Dashboard" name="description" />
<meta content="ThemeDesign" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>assets/css/button.css" rel="stylesheet" type="text/css">
</head>

<body>
<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">
<div class="card">
<div class="card-block">
<h3 class="text-center mt-0 m-b-15">
    <a href="#" class="logo logo-admin">Login</a>
</h3>
<div class="p-3">
    <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
             ×</button> <?php echo $this->session->flashdata('msg'); ?>
         </div>
    <?php endif; ?>

<form class="form-horizontal m-t-20" method="post" action="<?php echo base_url(); ?>adminlogin/home" id="myform">
        <div class="form-group row">
            <div class="col-12">
                <input class="form-control" type="text" name="username" required="" placeholder="Username">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <input class="form-control" type="password" name="pwd"  required=""  placeholder="Password">
            </div>
        </div>
        <div class="form-group text-center row m-t-20">
            <div class="col-12">
                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
            </div>
        </div>
        <div class="form-group m-t-10 mb-0 row">
            <div class="col-sm-7 m-t-20">
                <a href="#" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
            </div>
            <div class="col-sm-5 m-t-20">
              <?php
             $this->load->library('googleplus');
             $CLIENT_ID = '56118066242-ndqa7sis300o0ce5otglegn629ktmjj5.apps.googleusercontent.com';
             $CLIENT_SECRET = 'QBjwPGP5PE6tzJt3bDekC4a1';
             $APPLICATION_NAME = "Heyla";
             $client = new Google_Client();
             $client->setApplicationName($APPLICATION_NAME);
             $client->setClientId($CLIENT_ID);
             $client->setClientSecret($CLIENT_SECRET);
             $client->setAccessType("offline");
             $client->setRedirectUri('http://localhost/heyla/adminlogin/glogin/');
             $client->setScopes('email');
             $objOAuthService = new Google_Service_Plus($client);

             $client->setScopes(array('https://www.googleapis.com/auth/userinfo.email','https://www.googleapis.com/auth/userinfo.profile'));
             $authUrl=$client->createAuthUrl();
             echo '<a class="loginBtn loginBtn--google" href="'.$authUrl.'">Login to google</a>';
             ?>
             <p>
               <button class="loginBtn loginBtn--facebook">
                 Login with Facebook
               </button>
            </div>
        </div>
    </form>
</div>

</div>
</div>
</div>

<!-- jQuery  -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detect.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
<!-- App js -->
<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
</body>
</html>

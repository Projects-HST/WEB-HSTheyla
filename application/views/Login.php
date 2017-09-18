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
        <!--div class="form-group row">
            <div class="col-12">
                <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                    <input type="checkbox" class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Remember me</span>
                </label>
            </div>
        </div-->
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
                <a href="#" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
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
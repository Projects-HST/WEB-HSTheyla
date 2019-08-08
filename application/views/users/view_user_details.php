<div class="page-content-wrapper ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-block">
                    <h4 class="mt-0 header-title">Profile </h4>
                    <?php foreach($users_view AS $res){ }
                    ?>
                        <div class="row">
                            <div class="col-md-3 bor"><p class="txt_label">User name</p></div>
                            <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->user_name; ?></p></div>
                            <div class="col-md-3 bor"><p class="txt_label">User Role</p></div>
                            <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->user_role_name; ?></p></div>
                            <div class="col-md-3 bor"><p class="txt_label">Full Name</p></div>
                            <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->name; ?></p></div>
                            <div class="col-md-3 bor"><p class="txt_label">Mobile Number</p></div>
                            <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->mobile_no;?></p></div>
                            <div class="col-md-3 bor"><p class="txt_label">Email</p></div>
                            <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->email_id;?></p></div>
                            <div class="col-md-3 bor"><p class="txt_label">Last login</p></div>
                            <div class="col-md-3 bor"><p class="txt_value"><?php echo $res->last_login;?></p></div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

</style>

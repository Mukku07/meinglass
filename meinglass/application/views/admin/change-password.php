<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>

        <div class="card card-login mx-auto mrgn">
            <div id="error_msg"></div>
            <div class="card-header">Change Password</div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('admin/doChangePassword'); ?>" id="common-form">
                    <div class="form-group">
                        <?php echo form_input(['name' => 'password', 'id' => 'password', 'type' => 'password', 'placeholder' => 'Password', 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input(['name' => 'newPassword', 'id' => 'newPassword', 'type' => 'password', 'placeholder' => 'New Password', 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_input(['name' => 'confirmPassword', 'id' => 'confirmPassword', 'type' => 'password', 'placeholder' => 'Confirm Password', 'class' => 'form-control']); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>   
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © Your Website 2019</span>
            </div>
        </div>
    </footer>

</div>
<!-- /.content-wrapper -->


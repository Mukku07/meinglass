<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login-Admin MeinGlass</title>

        <!-- Bootstrap core CSS-->
        <link href="<?php echo base_url('public/css/bootstrap.min.css'); ?>" rel="stylesheet">

        <!-- Custom fonts for this template-->
        <link href="<?php echo base_url('public/css/all.min.css'); ?>" rel="stylesheet" type="text/css">

        <!-- Custom styles for this template-->
        <link href="<?php echo base_url('public/css/sb-admin.css'); ?>" rel="stylesheet">

        <link href="<?php echo base_url('public/css/back-css.css'); ?>" rel="stylesheet">
    </head>

    <body class="bg-dark">

        <div class="container">
            
            <div class="card card-login mx-auto mrgn">
                <div id="error_msg"></div>
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="post" action="<?php echo base_url('admin/checkLogin'); ?>" id="common-form">
                        <div class="form-group">
                            <!--<div class="form-label-group">-->
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email address" autofocus="autofocus">
                                <!--<label for="inputEmail">Email address</label>-->
                            <!--</div>-->
                        </div>
                        <div class="form-group">
                            <!--<div class="form-label-group">-->
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                <!--<label for="inputPassword">Password</label>-->
                            <!--</div>-->
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>   
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo base_url('public/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('public/js/bootstrap.bundle.min.js'); ?>"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url('public/js/jquery.easing.min.js'); ?>"></script>
        
        <script src="<?php echo base_url('public/js/back-script.js'); ?>"></script>

    </body>

</html>

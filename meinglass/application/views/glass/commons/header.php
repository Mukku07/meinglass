<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Home - mein Glas nach Maß</title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url('public/image/icon.png'); ?>" rel="icon" type="icon/image">
        <link href="<?php echo base_url('public/css/bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/slick.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/hamburgers.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/slick-theme.css'); ?>" rel="stylesheet">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery.swipebox/1.4.4/css/swipebox.min.css'>
        <link href="<?php echo base_url('public/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/media.css'); ?>" rel="stylesheet">

    </head>

    <body>

        <!--for header-strip banner -->
        <div class="top_header boxs">
            <div class="container">
                <div class="left_menu">
                    <ul>
                        <li><a href="tel:+8001234567"><i class="fa fa-phone" aria-hidden="true"></i> +(800)1234567</a></li>
                    </ul>
                </div>
                <div class="right_menu">
                    <ul>
                        <li><a href="mailto:info@meinglass.com"><i class="fa fa-envelope"></i> info@meinglass.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--for header-strip banner end-->

        <div class="header boxs">

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button class="hamburger hamburger--squeeze" type="button" aria-label="Menu" aria-controls="navigation">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>

                    </div>
                    <div class="navbar-header">
                        <div class="container">
                            <div class="nav_cus boxs">
                                <ul>
                                    <li  class="logoli"><a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('public/image/MGNM.png'); ?>" alt="logo"></a>
                                    </li>
                                    <li class="searchli"><input type="text" placeholder="Search" class="addsearch hidden-xs"
                                               data-addsearch-field="true" autocomplete="off" style="cursor: auto;">
                                    </li>
                                  
                                    <?php $this->session->set_userdata('page_url', base_url(uri_string()));?>
                                    <?php if($this->session->userdata('client_id')) { ?>
                                    <!-- <span><b>Welcome: </b><?php echo $this->session->userdata('email'); ?></span> -->
                                    <li class="logoutli"><a class="cart_head" href="<?php echo base_url('client/logout');?>"><img src="<?php echo base_url('public/image/user/user_logout.png'); ?>" alt="logout" class="logout"></a>
                                    </li>
                                   
                                    <?php } else { ?>
                                    <li class="registerli"><a class="cart_head" href="#registeruser" data-toggle="modal" data-dismiss="modal"><img src="<?php echo base_url('public/image/user/register.png'); ?>" alt="register" class="register"></a>
                                    </li>
                                    <li class="lognli"><a class="cart_head" href="#loginuser" data-toggle="modal" data-dismiss="modal"><img src="<?php echo base_url('public/image/user/login.png'); ?>" alt="login" class="login"></a>
                                    </li>

                                    <?php } ?>
                                    <li class="cartli"><a class="cart_head" href="#"><img src="https://dgm.azureedge.net/shopping-cart.png" alt="shopping cart" class="cartimg"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <div class="container">
                            <ul class="nav navbar-nav">
                                <li class=" "><a href="<?php echo base_url(); ?>">Home</a></li>
                                <li class="dropbtn "><a href="<?php echo base_url('Konfigurator'); ?>">Konfigurator</a></li>
                                <li><a href="<?php echo base_url('home/gallery'); ?>">Gallerie / News</a></li>
                                <li><a href="<?php echo base_url('home/shop'); ?>">Shop</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="sidenav" id="mySidenav">
            <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url('public/image/logo.png'); ?>" alt="logo"></a>
            <a href="<?php echo base_url(); ?>">Home</a>
            <a href="<?php echo base_url('Konfigurator'); ?>">Konfigurator</a>
            <a href="<?php echo base_url('home/gallery'); ?>">Gallerie / News</a>
            <a href="<?php echo base_url('home/shop'); ?>">Shop</a>
        </div>

        <!-- Login Modal -->
        <div class="modal fade loginmodel" id="loginuser" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title text-center"><b>Login Panel</b></h4>
                      <div id="errors_msg"></div>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url('client/user_login');?>" method="post" name="user_login" id="user_login" >
                        <div class="form-group">
                          <label for="login_emailId">Email:</label>
                          <input type="email" class="form-control" id="login_emailId" placeholder="Enter email" name="login_emailId">
                        </div>
                        <div class="form-group">
                          <label for="login_password">Password:</label>
                          <input type="password" class="form-control" id="login_password" placeholder="Enter password" name="login_password">
                        </div>
                        <div class="checkbox">
                          <label><input type="checkbox" name="remember"> Remember me</label>
                        </div>
                        <div class="pull-right">
                            <label><a href="#forgotpass" data-toggle="modal" data-dismiss="modal">Forgot Password</a></label>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </form>
                    </div>
                    <!-- <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- register Modal -->
        <div class="modal fade loginmodel" id="registeruser" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title text-center"><b>Register Panel</b></h>
                        <div id="errors_msg"></div>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url('client/user_regiter');?>" method="post" name="user_register" id="user_register">
                        <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                        </div>
                        <div class="form-group">
                          <label for="emailId">Email:</label>
                          <input type="email" class="form-control" id="emailId" placeholder="Enter Email" name="emailId">
                        </div>
                        <div class="form-group">
                          <label for="phone">Phone Number:</label>
                          <input type="text" class="form-control" id="phone" placeholder="Enter Number" name="phone">
                        </div>
                        <div class="form-group">
                          <label for="password">Password:</label>
                          <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                        </div>
                        <div class="form-group">
                          <label for="cpassword">Confirm Password:</label>
                          <input type="password" class="form-control" id="cpassword" placeholder="Enter Confirm Password" name="cpassword">
                        </div>
                        <button type="submit" class="btn btn-success">Register</button>
                      </form>
                    </div>
                   <!--  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Login Modal -->
        <div class="modal fade loginmodel" id="forgotpass" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title text-center"><b>Forgot Password</b></h4>
                      <div id="errors_msg"></div>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo base_url('client/forgot_password');?>" method="post" name="forgot_password" id="forgot_password">
                        <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <button type="submit" class="btn btn-success">Continue</button>
                      </form>
                    </div>
                    <!-- <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> -->
                </div>
            </div>
        </div>
       
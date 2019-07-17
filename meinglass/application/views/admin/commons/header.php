<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title; ?></title>
       
        <!-- Bootstrap core CSS-->
        <link href="<?php echo base_url('public/css/bootstrap.min.css'); ?>" rel="stylesheet">

        <!-- Custom fonts for this template-->
        <link href="<?php echo base_url('public/css/all.min.css'); ?>" rel="stylesheet" type="text/css">

        <!-- Page level plugin CSS-->
        <link href="<?php echo base_url('public/css/dataTables.bootstrap4.css'); ?>" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="<?php echo base_url('public/css/sb-admin.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/style.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/back-css.css'); ?>" rel="stylesheet">
    </head>

    <body id="page-top">

        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

            <a class="navbar-brand mr-1" href="#">Mein Glass</a>

            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navbar Search -->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

            </div>

            <!-- Navbar -->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo base_url('admin/change-password'); ?>">Change Password</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                    </div>
                </li>
            </ul>

        </nav>

        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="sidebar navbar-nav">
                <li class="nav-item <?php if($title=='Dashboard'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('admin/dashboard'); ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
<!--                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Pages</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item" href="login.html">Login</a>
                    </div>
                </li>-->
                <li class="nav-item <?php if($title=='Products Details'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('products/'); ?>">
                        <i class="fa fa-hourglass-end" aria-hidden="true"></i>
                        <span>Product Details</span></a>
                </li>
                <li class="nav-item <?php if($title=='Term'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('term'); ?>">
                        <i class="fas fa-fw fa-circle"></i>
                        <span>Dimensional Term</span></a>
                </li>
                <li class="nav-item <?php if($title=='Corner'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('term/corner'); ?>">
                        <i class="fas fa-retweet"></i>
                        <span>Corner</span></a>
                </li>
                <li class="nav-item <?php if($title=='Shape'|$title=='Dimension'|$title=='Formula'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('shape'); ?>">
                        <i class="fas fa-fw fa-shapes"></i>
                        <span>Shapes</span></a>
                </li>
                <li class="nav-item <?php if($title=='Glass Type'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('term/glass-type'); ?>">
                       
                        <i class="fas fa-map"></i>
                        <span>Glass Type</span></a>
                </li>
                <li class="nav-item <?php if($title=='Thickness'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('thickness'); ?>">
                       
                        <i class="fas fa-square"></i>
                        <span>Thickness</span></a>
                </li>
                <li class="nav-item <?php if($title=='Material Type'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('material'); ?>">
                       
                        <i class="fas fa-snowflake"></i>
                        <span>Material</span></a>
                </li>
                <li class="nav-item <?php if($title=='Edge Element'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('edge/edge-element'); ?>">
                       
                        <i class="fa fa-circle-notch"></i>
                        <span>Edge Element</span></a>
                </li>
                <li class="nav-item <?php if($title=='Edge Processing'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('edge'); ?>">
                       
                        <i class="fas fa-cube"></i>
                        <span>Edge</span></a>
                </li>
                <li class="nav-item <?php if($title=='Surface Treatment'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('treatment'); ?>">
                        <i class="fas fa-cubes" aria-hidden="true"></i>
                        <span>Surface Treatment</span></a>
                </li>
                <li class="nav-item <?php if($title=='Shipping Cost'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('treatment/shipping_cost'); ?>">
                        <i class="fa fa-calculator" aria-hidden="true"></i>
                        <span>Shipping Cost</span></a>
                </li>
                <li class="nav-item <?php if($title=='Mass Density'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('treatment/mass_density'); ?>">
                        <i class="fa fa-podcast" aria-hidden="true"></i>
                        <span>Mass Density</span></a>
                </li>
                <li class="nav-item <?php if($title=='Price Calculate'){ echo 'active'; } ?>">
                    <a class="nav-link" href="<?php echo base_url('treatment/priceCalculate'); ?>">
                        <i class="fa fa-venus-mars" aria-hidden="true"></i>
                        <span>Price Calculate</span></a>
                </li>
<!--                <li class="nav-item dropdown <?php if($title=='Material Type'){ echo 'show'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Thickness</span>
                    </a>
                    <div class="dropdown-menu <?php if($title=='Material Type'){ echo 'show'; } ?>" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item <?php if($title=='Material Type'){ echo 'active'; } ?>" href="<?php echo base_url('thickness'); ?>">Material Type</a>
                    </div>
                    <div class="dropdown-menu <?php if($title=='Material Thickness'){ echo 'show'; } ?>" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item <?php if($title=='Material Thickness'){ echo 'active'; } ?>" href="<?php echo base_url('thickness/'); ?>">Material Type</a>
                    </div>
                    <div class="dropdown-menu <?php if($title=='Material Thickness'){ echo 'show'; } ?>" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item <?php if($title=='Material Thickness'){ echo 'active'; } ?>" href="<?php echo base_url('thickness/'); ?>">Material Type</a>
                    </div>
                </li>-->   
                <li class="nav-item dropdown <?php if($title=='Front View' || $title == 'Carousel' || $title == 'News' || $title == 'Gallerie' || $title=='Customer Review' || $title=='Contact View'){ echo 'show'; } ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Front View</span>
                    </a>
                     <div class="dropdown-menu <?php if($title=='Front View' || $title == 'Carousel' || $title == 'News' || $title == 'Gallerie' || $title=='Customer Review' || $title=='Contact View'){ echo 'show'; } ?>" aria-labelledby="pagesDropdown">
                        <a class="dropdown-item <?php if($title=='Carousel'){ echo 'active'; } ?>" href="<?php echo base_url('frontview/carousel'); ?>">Carousel</a>
                        <a class="dropdown-item <?php if($title=='News'){ echo 'active'; } ?>" href="<?php echo base_url('frontview/news'); ?>">News</a>
                        <a class="dropdown-item <?php if($title=='Gallerie'){ echo 'active'; } ?>" href="<?php echo base_url('frontview/gallerie'); ?>">Gallerie</a>
                        <a class="dropdown-item <?php if($title=='Customer Review'){ echo 'active'; } ?>" href="<?php echo base_url('frontview/review'); ?>">Customer Review</a>
                        <a class="dropdown-item <?php if($title=='Contact View'){ echo 'active'; } ?>" href="<?php echo base_url('frontview/contactData'); ?>">Contact</a>
                    </div>
                </li>
            </ul>
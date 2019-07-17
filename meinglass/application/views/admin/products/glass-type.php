<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $title; ?></li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Product
                <a href="<?php echo base_url('products/');?>" class="btn btn-outline-primary float-right">View Products</a>
            </div>
            
        </div>
           
        <div class="products boxs">
            <div class="container">
                <div class="product_headings boxs">
                    <ul>
                        <li><a href="javascript:vod(0)" class="active">SHAPE</a></li>
                        <li><a href="javascript:vod(0)" class="active">DIMENSIONS</a></li>
                        <li><a href="javascript:vod(0)" class="active">TYPE</a></li>
                        <li><a href="javascript:vod(0)">THICKNESS</a></li>
                        <li><a href="javascript:vod(0)">EDGEWORK</a></li>
                        <li><a href="javascript:vod(0)">SURFACE TREATMENT</a></li>
                        <li><a href="javascript:vod(0)">SUMMARY</a></li>
                        <!-- <li><a href="javascript:vod(0)">ORDER</a></li> -->
                    </ul>
                </div>
                <div class="glass_top boxs">
                    <h1 class="heading_top">Glass Type</h1>
                    <a href="<?php echo base_url('products/dimension/'.$products['product_id']); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('products/glassTypeCal/'.$products['product_id']); ?>" id="glass-type-continue" class="continue">Continue</a>
                </div>
                <div class="products_inner boxs">
                    <h5>We carry several different types of glass. Which one best fits your needs?</h5>

                    <?php

                    if(!empty($products['glass_type_id'])){ if($products['glass_type_id']){ $glass_type_id=$products['glass_type_id']; } }
                    if (!empty($glasses)) { 
                        $i=1;
                        foreach ($glasses as $glass) { 
                            ?>
                            <div class="col-sm-6 noleft">
                                <div class="tempred boxs">
                                    <div class="tempred_inner">
                                        <label for="<?php echo $glass['glass_type_id']; ?>">
                                            <img src="<?php echo base_url('uploads/type/' . $glass['image_url']); ?>" class="img-responsive" alt="tempered">
                                            <input type='radio' id='<?php echo $glass['glass_type_id']; ?>' name='glass_type_id' value='<?php echo $glass['glass_type_id']; ?>' <?php if(!empty($glass_type_id)){if($glass_type_id==$glass['glass_type_id']){ echo 'checked'; }} else if($i==1){ echo 'checked'; } ?>/> 
                                            <h3><?php echo $glass['name']; ?></h3>
                                            <p><?php echo $glass['description']; ?></p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
                <div class="bottom_p boxs">
                    <a href="<?php echo base_url('products/dimension/'.$products['product_id']); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('products/glassTypeCal/'.$products['product_id']); ?>" id="glass-type-continue" class="continue">Continue</a>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © Meinglass 2019</span>
            </div>
        </div>
    </footer>

</div>
<!-- /.content-wrapper -->
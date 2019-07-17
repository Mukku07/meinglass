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
                <a href="<?php echo base_url('products') ?>" class="btn btn-outline-primary float-right">View Products</a>
            </div>
            
        </div>
           
        <div class="products boxs">
            <div class="container">
                <div class="product_headings boxs">
                    <ul>
                        <li><a href="javascript:vod(0)" class="active">SHAPE</a></li>
                        <li><a href="javascript:vod(0)">DIMENSIONS</a></li>
                        <li><a href="javascript:vod(0)">TYPE</a></li>
                        <li><a href="javascript:vod(0)">THICKNESS</a></li>
                        <li><a href="javascript:vod(0)">EDGEWORK</a></li>
                        <li><a href="javascript:vod(0)">SURFACE TREATMENT</a></li>
                        <li><a href="javascript:vod(0)">SUMMARY</a></li>
                        <!-- <li><a href="javascript:vod(0)">ORDER</a></li> -->
                    </ul>
                </div>
                <div class="glass_top boxs">
                    <h1 class="heading_top">Glass Type</h1>
                    <a href="<?php if(!empty($products['product_id'])) { echo base_url('products/shapeCal/'.$products['product_id']); } else { echo base_url('products/shapeCal/'.$inserted);} ?>" id="shape-continue" class="continue">Continue</a>
                </div>
                <section class="shapes boxs">
                    <div class="shapes_inner boxs">
                        <p>Please choose the picture below that best describes the shape of your glass. The picture does
                            not have to match your piece exactly. In the next few steps, you will have a chance to tell us
                            more about your piece. What shape is your glass?
                        </p>
                        <?php if(!empty($shapes)){
                            $i=1;
                            foreach($shapes as $shape){
                        ?>
                        <div class="col-sm-4 col-xs-6 col-lg-2">
                            <div class="shapes_wrap boxs">
                                <a href="javascript:void(0)" class="mydata">
                                    <img src="<?php echo base_url('uploads/shape/'.$shape['image_url']); ?>" alt="<?php echo $shape['name']; ?>" class="img-responsive shapes_img">
                                </a>
                                <label> <input name="Shape" type="radio" value="<?php echo $shape['shape_id']; ?>" class="shape" <?php if(!empty($products['shape_id'])){ if($products['shape_id']==$shape['shape_id']){ echo 'checked'; } }else if($i==1){echo 'checked';} ?> ><?php echo $shape['name']; ?></label>
                            </div>
                        </div>
                        <?php
                        $i++;
                            }
                        } ?>
                    </div>

                </section>

                <div class="bottom_p boxs">
                    <a href="<?php if(!empty($products['product_id'])) { echo base_url('products/shapeCal/'.$products['product_id']); } else { echo base_url('products/shapeCal/'.$inserted);} ?>" id="shape-continue" class="continue">Continue</a>
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
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
                        <li><a href="javascript:vod(0)" class="active">THICKNESS</a></li>
                        <li><a href="javascript:vod(0)" class="active">EDGEWORK</a></li>
                        <li><a href="javascript:vod(0)">SURFACE TREATMENT</a></li>
                        <li><a href="javascript:vod(0)">SUMMARY</a></li>
                        <!-- <li><a href="javascript:vod(0)">ORDER</a></li> -->
                    </ul>
                </div>
                <div class="glass_top boxs">
                    <h1 class="heading_top">Edge Work</h1>
                    <a href="<?php echo base_url('products/thickness/'.$products['product_id']); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('products/edgeCal/'.$products['product_id']); ?>" id="edge-continue" class="continue">Continue</a>
                </div>
                <div class="products_inner boxs">
                    <div class="col-sm-3 noleft">
                        <label for="edge">Select Edge</label>
                        <?php echo form_dropdown(['name' => 'edge', 'id' => 'edge', 'class' => 'form-control', 'data-url' => base_url('konfigurator/getEdgeType/'.$products['product_id'])], $edge, isset($products['edge_id']) ? $products['edge_id'] : ''); ?>
                    </div>
                </div>
                <div id="edge-wrapper"></div>

                <div class="bottom_p boxs">
                    <a href="<?php echo base_url('products/thickness/'.$products['product_id']); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('products/edgeCal/'.$products['product_id']); ?>" id="edge-continue" class="continue">Continue</a>
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
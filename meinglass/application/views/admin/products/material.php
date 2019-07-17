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
                        <li><a href="javascript:vod(0)">EDGEWORK</a></li>
                        <li><a href="javascript:vod(0)">SURFACE TREATMENT</a></li>
                        <li><a href="javascript:vod(0)">SUMMARY</a></li>
                        <!-- <li><a href="javascript:vod(0)">ORDER</a></li> -->
                    </ul>
                </div>
                <div class="glass_top boxs">
                    <h1 class="heading_top">Thickness</h1>
                    <a href="<?php echo base_url('products/glass_type/'.$products['product_id']); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('products/thicknessCal/'.$products['product_id']); ?>" id="thickness-continue" class="continue">Continue</a>
                </div>
                <div class="products_inner boxs">
                    <h5>How thick is the piece of glass that you need? (Note that the graphics are representations only not the
                        actual thickness of glass.)</h5>
                    <div class="col-sm-3 noleft">
                        <label for="material">Select Material</label>
                        <?php echo form_dropdown(['name' => 'material', 'id' => 'material', 'class' => 'form-control', 'data-url' => base_url('products/getThickness/'.$products['product_id'])], $material,isset($products['material_id'])?$products['material_id']:''); ?>
                    </div>
                </div>
                <div id="thickness-wrapper"></div>
                <div class="bottom_p boxs">
                    <a href="<?php echo base_url('products/glass_type/'.$products['product_id']); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('products/thicknessCal/'.$products['product_id']); ?>" id="thickness-continue" class="continue">Continue</a>
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
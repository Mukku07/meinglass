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
                Add Shape
                <a href="<?php echo base_url('shape') ?>" class="btn btn-outline-primary float-right">View Shape</a>
            </div>
            <div class="card-body">
                <form method="post" action="<?php if(!empty($shape)){ echo base_url('shape/doEditShape/'.$shape['shape_id']);}else{ echo base_url('shape/doAddShape'); } ?>" id="image-form" enctype="multipart/form-data">
                    <div class="row form-group">
                        <div class="col-md-4 offset-2">
                            <?php echo form_label('Name', 'name') ?>
                            <?php echo form_input(['name' => 'name', 'id' => 'name', 'type' => 'text', 'class' => 'form-control'],isset($shape['name'])?$shape['name']:''); ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo form_label('Percentage', 'percentage') ?>
                            <?php echo form_input(['name' => 'percentage', 'id' => 'percentage', 'type' => 'text', 'class' => 'form-control'],isset($shape['percentage'])?$shape['percentage']:''); ?>
                        </div>
                    </div>
                     <div class="row form-group">
                        <div class="col-md-4 offset-2">
                            <?php echo form_label('Image', 'image_url') ?>
                            <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']); ?>
                            <?php if(!empty($shape)){
                            ?>
                            <img src="<?php echo base_url('uploads/shape/' . $shape['image_url']); ?>">
                            <?php
                            } ?>
                        </div>
                        <div class="col-md-4">
                            <?php echo form_label('Formula', 'formula') ?>
                            <?php echo form_input(['name' => 'formula', 'id' => 'formula', 'type' => 'text', 'class' => 'form-control'],isset($shape['formula'])?$shape['formula']:''); ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-1 offset-9">
                            <button type="submit" class="btn btn-primary">Submit</button>   
                        </div>
                    </div>
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


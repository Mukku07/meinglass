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
                Glass Type
                <a href="<?php echo base_url('term/glass_type') ?>" class="btn btn-outline-primary float-right">View Glass Type</a>
            </div>
            <div class="card-body">
                <form method="post" action="<?php if(!empty($type)){ echo base_url('term/doEditGlassType/'.$type['glass_type_id']);}else{ echo base_url('term/doAddGlassType'); } ?>" id="image-form" enctype="multipart/form-data">
                    <div class="row form-group">
                        <div class="col-md-4 offset-2">
                            <?php echo form_label('Name', 'name') ?>
                            <?php echo form_input(['name' => 'name', 'id' => 'name', 'type' => 'text', 'class' => 'form-control'],isset($type['name'])?$type['name']:''); ?>
                        </div>
                        <div class="col-md-4">
                        <?php echo form_label('Image', 'image_url') ?>
                            <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']); ?>
                            <br/>
                            <?php if(!empty($type)){
                            ?>
                            <img src="<?php echo base_url('uploads/type/' . $type['image_url']); ?>" height="150px" width="200px">
                            <?php
                            } ?>    
                        </div>
                    </div>
                     <div class="row form-group">
                        <div class="col-md-4 offset-2">
                            <?php echo form_label('Description', 'description') ?>
                            <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'type' => 'text', 'class' => 'form-control','rows'=>'5'],isset($type['description'])?$type['description']:''); ?>
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


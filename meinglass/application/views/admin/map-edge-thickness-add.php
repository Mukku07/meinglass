<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('edge'); ?>">Edge Processing</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('edge/map-edge-element/'.$edge_id); ?>">Map Edge Element</a>
            </li>
            <li class="breadcrumb-item active">Map Edge Thickness</li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Edge Thickness mapping
                <a href="<?php echo base_url('edge/map_edge_thickness/'.$edge_id.'/'.$edge_element_id) ?>" class="btn btn-outline-primary float-right">View list</a>
            </div>
            <div class="card-body">
                <form method="post" action="<?php if(!empty($mapping)){ echo base_url('edge/doEditEdgeThicknessMap/'.$mapping['mapping_id']);}else{ echo base_url('edge/doAddEdgeThicknessMap'); } ?>" id="common-form">
                    <div class="row form-group">
                        <div class="col-md-3 offset-1">
                            <?php echo form_label('Thickness', 'thickness_id') ?>
                            <?php echo form_dropdown(['name' => 'thickness_id', 'id' => 'thickness_id', 'type' => 'text', 'class' => 'form-control'],$thickness,isset($mapping['thickness_id'])?$mapping['thickness_id']:''); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo form_label('Edge Type', 'edge_type_id') ?>
                            <?php echo form_dropdown(['name' => 'edge_type_id', 'id' => 'edge_type_id', 'type' => 'text', 'class' => 'form-control','rows'=>'5'],$edge_type,isset($mapping['edge_type_id'])?$mapping['edge_type_id']:''); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo form_label('Price', 'price') ?>
                            <?php echo form_input(['name' => 'price', 'id' => 'price', 'type' => 'text', 'class' => 'form-control'],isset($mapping['price'])?$mapping['price']:''); ?>
                        </div>
                        <?php echo form_hidden('edge_id', $edge_id); ?>
                        <?php echo form_hidden('edge_element_id', $edge_element_id); ?>
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


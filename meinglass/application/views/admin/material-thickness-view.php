<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('material'); ?>">Material Type</a>
            </li>
            <li class="breadcrumb-item active">Material Thickness</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        <?php echo $material['material_name']; ?> Thickness List
                        <a href="<?php echo base_url('material') ?>" class="btn btn-outline-primary float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Material Thickness (mm)</th>
                                        <th>Cost(€/qm)</th>
                                        <th>MBF</th>
                                        <th>Additional (in %)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($material_thickness)) {
                                        $i = 1;
                                        foreach ($material_thickness as $m_thick) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $m_thick['thickness']; ?></td>
                                                <td><?php echo $m_thick['cost']; ?></td>
                                                <td><?php echo $m_thick['mbf']; ?></td>
                                                <td><?php echo $m_thick['additional']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('material/material_thickness/' .$material['id'].'/'. $m_thick['material_thickness_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Thickness"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('material/deleteThickness/' . $m_thick['thickness_id'].'/'.$material['id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Thickness"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Add Material Thickness
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($thick['material_thickness_id'])){ echo base_url('material/doEditMaterialThickness/'.$thick['material_thickness_id'].'/'.$material['id']); }else{ echo base_url('material/doAddMaterialThickness/'.$material['id']); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Material Thickness (mm)', 'thickness_id') ?>
                                    <?php echo form_dropdown(['name' => 'thickness_id', 'id' => 'thickness_id', 'type' => 'number', 'class' => 'form-control'],$thickness, isset($thick['thickness_id'])?$thick['thickness_id']:''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Cost (€/qm)', 'cost') ?>
                                    <?php echo form_input(['name' => 'cost', 'id' => 'cost', 'type' => 'text', 'class' => 'form-control'], isset($thick['cost'])?$thick['cost']:''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('MBF', 'mbf') ?>
                                    <?php echo form_input(['name' => 'mbf', 'id' => 'mbf', 'type' => 'text', 'class' => 'form-control'], isset($thick['mbf'])?$thick['mbf']:''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Additional (in %)', 'additional') ?>
                                    <?php echo form_input(['name' => 'additional', 'id' => 'additional', 'type' => 'text', 'class' => 'form-control'], isset($thick['additional'])?$thick['additional']:''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4 offset-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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


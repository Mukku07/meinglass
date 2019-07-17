<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Material Type</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Material Type List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($materials)) {
                                        $i = 1;
                                        foreach ($materials as $mat) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $mat['material_name']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('material/material_thickness/' . $mat['id']); ?>" data-toggle="tooltip" data-placement="top" title="Add Material Thickness"><i class="fa fa-circle"></i></a>
                                                    <a href="<?php echo base_url('material/index/' . $mat['id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Material"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('material/deleteMaterial/' . $mat['id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Material"><i class="fa fa-trash"></i></a>
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
                        <?php if(!empty($material)){ echo 'Edit'; }else{ echo 'Add'; } ?> Material
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($material)){ echo base_url('material/doEditMaterial/'.$material['id']); }else{ echo base_url('material/doAddMaterial'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Name', 'material_name') ?>
                                    <?php echo form_input(['name' => 'material_name', 'id' => 'material_name', 'type' => 'text', 'class' => 'form-control'], isset($material['material_name']) ? $material['material_name'] : ''); ?>
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


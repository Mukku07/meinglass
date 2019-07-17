<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">View Shape</li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Shapes List
                <a href="<?php echo base_url('shape/add-shape') ?>" class="btn btn-outline-primary float-right">Add Shape</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Percentage</th>
                                <th>Formula</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($shapes)) {
                                $i=1;
                                foreach ($shapes as $shape) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo base_url('uploads/shape/' . $shape['image_url']); ?>"></td>
                                        <td><?php echo $shape['name']; ?></td>
                                        <td><?php echo $shape['percentage'].'%'; ?></td>
                                        <td><?php echo $shape['formula']; ?></td>
                                        <td><?php echo $shape['is_active']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('shape/dimension/' . $shape['shape_id']); ?>" data-toggle="tooltip" data-placement="top" title="Add Dimension"><i class="fa fa-circle"></i></a>
                                            <a href="<?php echo base_url('shape/formula/' . $shape['shape_id']); ?>" data-toggle="tooltip" data-placement="top" title="Add Formula"><i class="fa fa-flask"></i></a>
                                            <a href="<?php echo base_url('shape/add-shape/' . $shape['shape_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Shape"><i class="fa fa-pen-square"></i></a>
                                            <a href="<?php echo base_url('shape/deleteShape/' . $shape['shape_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Shape"><i class="fa fa-trash"></i></a>
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


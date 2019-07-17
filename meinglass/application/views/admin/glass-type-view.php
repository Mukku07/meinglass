<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">View Glass Type</li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Glass Type List
                <a href="<?php echo base_url('term/add-glass-type') ?>" class="btn btn-outline-primary float-right">Add Glass Type</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($types)) {
                                $i=1;
                                foreach ($types as $type) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo base_url('uploads/type/' . $type['image_url']); ?>" height="150px" width="200px"></td>
                                        <td><?php echo $type['name']; ?></td>
                                        <td><?php echo $type['description']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('term/add-glass-type/' . $type['glass_type_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Glass Type"><i class="fa fa-pen-square"></i></a>
                                            <a href="<?php echo base_url('term/deleteGlassType/' . $type['glass_type_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Glass Type"><i class="fa fa-trash"></i></a>
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


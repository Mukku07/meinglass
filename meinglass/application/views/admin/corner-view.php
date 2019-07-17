<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Corner</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Corner List
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
                                    if (!empty($corners)) {
                                        $i=1;
                                        foreach ($corners as $corn) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $corn['type']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('term/corner/' . $corn['corner_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit corner"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('term/deleteCorner/' . $corn['corner_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete corner"><i class="fa fa-trash"></i></a>
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
                        <?php if(!empty($corner)){ echo 'Edit'; }else{ echo 'Add'; } ?> Corner
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($corner)){ echo base_url('term/doEditCorner/'.$corner['corner_id']); }else{ echo base_url('term/doAddCorner'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Type', 'type') ?>
                                    <?php echo form_input(['name' => 'type', 'id' => 'type', 'type' => 'text', 'class' => 'form-control'], isset($corner['type']) ? $corner['type'] : ''); ?>
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


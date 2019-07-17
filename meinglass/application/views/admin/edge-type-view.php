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
            <li class="breadcrumb-item active">Edge Type</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        <?php echo $edge['type'] ?> List
                        <a href="<?php echo base_url('edge') ?>" class="btn btn-outline-primary float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Type Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($edge_types)) {
                                        $i = 1;
                                        foreach ($edge_types as $edg) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $edg['edge_type_value']; ?></td>
                                                <td><a href="<?php echo base_url('edge/deleteEdgeType/' . $edg['edge_type_id'].'/'.$edge['edge_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Edge Type"><i class="fa fa-trash"></i></a>
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
                        Add Edge Type
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php echo base_url('edge/doAddEdgeType/'.$edge['edge_id']); ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Edge Type Value', 'edge_type_value') ?>
                                    <?php echo form_input(['name' => 'edge_type_value', 'id' => 'edge_type_value', 'type' => 'text', 'class' => 'form-control']); ?>
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


<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Edge Processing</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Edge Processing List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($edges)) {
                                        $i = 1;
                                        foreach ($edges as $edg) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $edg['type']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('edge/edge-type/' . $edg['edge_id']); ?>" data-toggle="tooltip" data-placement="top" title="Add Edge Type"><i class="fa fa-circle"></i></a>
                                                    <a href="<?php echo base_url('edge/map-edge-element/' . $edg['edge_id']); ?>" data-toggle="tooltip" data-placement="top" title="Map Edge Element"><i class="fa fa-circle-notch"></i></a>
                                                    <a href="<?php echo base_url('edge/index/' . $edg['edge_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Edge"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('edge/deleteEdge/' . $edg['edge_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Edge"><i class="fa fa-trash"></i></a>
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
                        <?php if(!empty($edge)){ echo 'Edit'; }else{ echo 'Add'; } ?> Edge
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($edge)){ echo base_url('edge/doEditEdge/'.$edge['edge_id']); }else{ echo base_url('edge/doAddEdge'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Type', 'type') ?>
                                    <?php echo form_input(['name' => 'type', 'id' => 'type', 'type' => 'text', 'class' => 'form-control'], isset($edge['type']) ? $edge['type'] : ''); ?>
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


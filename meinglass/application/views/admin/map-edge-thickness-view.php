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
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Edge Thickness mapping List
                        <a href="<?php echo base_url('edge/add-edge-thickness-map/'.$edge_id.'/'.$edge_element_id) ?>" class="btn btn-outline-primary float-right">Add Edge Thickness Mapping</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Edge Name</th>
                                        <th>Edge Element Name</th>
                                        <th>Edge type</th>
                                        <th>Thickness(In mm)</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($mappings)) {
                                        $i=1;
                                        foreach ($mappings as $map) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $map['type']; ?></td>
                                                <td><?php echo $map['edge_element_name']; ?></td>
                                                <td><?php echo $map['edge_type_value']; ?></td>
                                                <td><?php echo $map['thickness']; ?></td>
                                                <td><?php echo $map['price']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('edge/add-edge-thickness-map/'.$edge_id.'/'.$edge_element_id.'/'. $map['mapping_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Edge Thickness Mapping"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('edge/deleteEdgeThicknessMapping/'.$edge_id.'/'.$edge_element_id.'/' . $map['mapping_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Edge Thickness Mapping"><i class="fa fa-trash"></i></a>
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


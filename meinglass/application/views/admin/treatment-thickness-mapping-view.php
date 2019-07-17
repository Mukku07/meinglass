<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('treatment'); ?>">Surface Treatment</a>
            </li>
            <li class="breadcrumb-item active">Surface Treatment Mapping</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                       <?php echo '<b>'.$treatment['type'].'</b>'; ?> Surface Treatment Mapping List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Treatment Type</th>
                                        <th>Thickness</th>
                                        <th>MBF</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($mappings)) {
                                        $i = 1;
                                        foreach ($mappings as $mapping) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $mapping['type']; ?></td>
                                                <td><?php echo $mapping['thickness']; ?></td>
                                                <td><?php echo $mapping['mbf']; ?></td>
                                                <td><?php echo $mapping['price']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('treatment/treatment-thickness-mapping/' . $treatment['treatment_id'].'/'.$mapping['mapping_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Surface Treatment Mapping"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('treatment/deleteTreatmentMapping/'. $treatment['treatment_id'].'/' . $mapping['mapping_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Surface Treatment Mapping"><i class="fa fa-trash"></i></a>
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
                        <?php if(!empty($map)){ echo 'Edit'; }else{ echo 'Add'; }  ?>  Surface Treatment Mapping
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($map)){ echo base_url('treatment/doEditTreatmentMapping/'.$map['mapping_id']); }else{ echo base_url('treatment/doAddTreatmentMapping'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Thickness', 'thickness_id') ?>
                                    <?php echo form_dropdown(['name' => 'thickness_id', 'id' => 'thickness_id', 'class' => 'form-control'],$thickness, isset($map['thickness_id']) ? $map['thickness_id'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('MBF', 'mbf') ?>
                                    <?php echo form_input(['name' => 'mbf', 'id' => 'mbf', 'type' => 'text', 'class' => 'form-control'], isset($map['mbf']) ? $map['mbf'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Price', 'price') ?>
                                    <?php echo form_input(['name' => 'price', 'id' => 'price', 'type' => 'text', 'class' => 'form-control'], isset($map['price']) ? $map['price'] : ''); ?>
                                </div>
                                <?php echo form_hidden('treatment_id', $treatment['treatment_id']); ?>
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


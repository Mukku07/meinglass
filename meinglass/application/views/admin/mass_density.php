<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Mass Density</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Mass Density View
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> #Id</th>
                                        <th> Value kg/m<sup>3</sup></th>
                                        <!-- <th> Value g/cm<sup>3</sup></th>
                                        <th> Value g/mm<sup>3</sup></th>
                                        <th> Weight</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     if (!empty($mass_densitys)) {
                                        
                                         // foreach ($mass_densitys as $mass_density) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $mass_densitys['mass_density_id']; ?></td>
                                                <td><?php echo $mass_densitys['mvalue']; ?></td>
                                               <!--  <td><?php echo $mass_densitys['cmvalue']; ?></td>
                                                <td><?php echo $mass_densitys['mmvalue']; ?></td>
                                                <td><?php echo $mass_densitys['weight']; ?></td> -->
                                                <td>
                                                    
                                                    <a href="<?php echo base_url('treatment/mass_density/' . $mass_densitys['mass_density_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Shipping Cost"><i class="fa fa-pen-square"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            
                                        // }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($mass_density)){ ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        <?php if(!empty($mass_density)){ echo 'Edit'; }else{ echo 'Add'; } ?> Mass density
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($mass_density)){ echo base_url('treatment/doEditMassDensity/'.$mass_density['mass_density_id']); }else{ echo base_url('treatment/doAddMassDensity'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Value kg/m<sup>3</sup>', 'mvalue') ?>
                                    <?php echo form_input(['name' => 'mvalue', 'id' => 'mvalue', 'type' => 'text', 'class' => 'form-control'], isset($mass_density['mvalue']) ? $mass_density['mvalue'] : ''); ?>
                                </div>
                            </div>
                            <!--  <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Value g/cm<sup>3</sup>', 'cmvalue') ?>
                                    <?php echo form_input(['name' => 'cmvalue', 'id' => 'cmvalue', 'type' => 'text', 'class' => 'form-control'], isset($mass_density['cmvalue']) ? $mass_density['cmvalue'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Value g/mm<sup>3</sup>', 'mmvalue') ?>
                                    <?php echo form_input(['name' => 'mmvalue', 'id' => 'mmvalue', 'type' => 'text', 'class' => 'form-control'], isset($mass_density['mmvalue']) ? $mass_density['mmvalue'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Weight', 'weight') ?>
                                    <?php echo form_input(['name' => 'weight', 'id' => 'weight', 'type' => 'text', 'class' => 'form-control'], isset($mass_density['weight']) ? $mass_density['weight'] : ''); ?>
                                </div>
                            </div> -->
                            <div class="row form-group">
                                <div class="col-md-4 offset-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
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


<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Price Calculation</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Price Calculation View
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> #Id</th>
                                        <th> Gurtmaß Value </th>
                                        <th> Min Weight kg</th>
                                        <th> Max Weight kg</th>
                                        <th> Price €</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     if (!empty($priceData)) {
                                        
                                          foreach ($priceData as $pData) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $pData['id']; ?></td>
                                                <td><?php echo $pData['circumference']; ?></td>
                                                <td><?php echo $pData['minweight']; ?></td>
                                                <td><?php echo $pData['maxweight']; ?></td>
                                                <td><?php echo $pData['price']; ?></td>
                                                
                                                <td>
                                                    
                                                    <a href="<?php echo base_url('treatment/priceCalculate/' . $pData['id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Shipping Cost"><i class="fa fa-pen-square"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            
                                         }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php //if(!empty($priceDataById)){ ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        <?php if(!empty($mass_density)){ echo 'Edit'; }else{ echo 'Add'; } ?> Mass density
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($priceDataById)){ echo base_url('treatment/doEditFixedData/'.$priceDataById['id']); }else{ echo base_url('treatment/doAddFixedData'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Gurtmaß Value', 'circumference') ?>
                                    <?php echo form_input(['name' => 'circumference', 'id' => 'circumference', 'type' => 'text', 'class' => 'form-control'], isset($priceDataById['circumference']) ? $priceDataById['circumference'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Min Weight kg', 'minweight') ?>
                                    <?php echo form_input(['name' => 'minweight', 'id' => 'minweight', 'type' => 'text', 'class' => 'form-control'], isset($priceDataById['minweight']) ? $priceDataById['minweight'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Max Weight kg', 'maxweight') ?>
                                    <?php echo form_input(['name' => 'maxweight', 'id' => 'maxweight', 'type' => 'text', 'class' => 'form-control'], isset($priceDataById['maxweight']) ? $priceDataById['maxweight'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Price €', 'price') ?>
                                    <?php echo form_input(['name' => 'price', 'id' => 'price', 'type' => 'text', 'class' => 'form-control'], isset($priceDataById['price']) ? $priceDataById['price'] : ''); ?>
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
            <?php //} ?>
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


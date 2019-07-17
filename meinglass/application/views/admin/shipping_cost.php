<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Shipping Cost</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Shipping Cost View
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> Value of X1</th>
                                        <th> Value of X2</th>
                                        <th> Value of X3</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     if (!empty($shipping_costs)) { 
                                        
                                         // foreach ($shipping_costs as $shipping_cost) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $shipping_costs['value1']; ?></td>
                                                <td><?php echo $shipping_costs['value2']; ?></td>
                                                <td><?php echo $shipping_costs['value3']; ?></td>
                                                <td>
                                                    
                                                    <a href="<?php echo base_url('treatment/shipping_cost/' . $shipping_costs['shippingcost_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Shipping Cost"><i class="fa fa-pen-square"></i></a>
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
            <?php if(!empty($shipping_cost)){ ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header" >
                        <i class="fas fa-table"></i>
                        <?php if(!empty($shipping_cost)){ echo 'Edit'; }else{ echo 'Add'; } ?> Shipping Cost
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($shipping_cost)){ echo base_url('treatment/doEditShippingCost/'.$shipping_cost['shippingcost_id']); }else{ echo base_url('treatment/doAddShippingCost'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Value X1', 'value1') ?>
                                    <?php echo form_input(['name' => 'value1', 'id' => 'value1', 'type' => 'text', 'class' => 'form-control'], isset($shipping_cost['value1']) ? $shipping_cost['value1'] : ''); ?>
                                </div>
                            </div>
                             <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Value X2', 'value2') ?>
                                    <?php echo form_input(['name' => 'value2', 'id' => 'value2', 'type' => 'text', 'class' => 'form-control'], isset($shipping_cost['value2']) ? $shipping_cost['value2'] : ''); ?>
                                </div>
                            </div>
                             <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Value X3', 'value3') ?>
                                    <?php echo form_input(['name' => 'value3', 'id' => 'value3', 'type' => 'text', 'class' => 'form-control'], isset($shipping_cost['value3']) ? $shipping_cost['value3'] : ''); ?>
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


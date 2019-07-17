<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">View Products</li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Products List
                <a href="<?php echo site_url('products/addProduct/') ?>" class="btn btn-outline-primary float-right">Add Product</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Glass Type</th>
                                <th>Material</th>
                                <th>Thickness</th>
                                <th>Treatment</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($allProducts)) {
                                $i=1;
                                foreach ($allProducts as $allProduct) {  ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $allProduct['shape_data']['name']; ?></td>
                                       <!--  <td><img src="<?php echo base_url('uploads/shape/'.$allProduct['shape_data']['image_url']); ?>" height="100px" width="150px" class="img-thumbnail"></td> -->
                                        <td><img src="<?php echo base_url('uploads/type/'.$allProduct['glass_type']['image_url']); ?>" height="150px" width="200px" class="img-thumbnail"></td>
                                        <td><?php echo $allProduct['material']['material_name']; ?></td>
                                        <td><?php echo $allProduct['thickness']['thickness']; ?></td>
                                        <td><?php echo $allProduct['surface_treatment']['type']; ?></td>
                                        <td><?php echo $allProduct['product_price'].",00 €"; ?></td>
                                        <td>
                                            
                                        <?php if($allProduct['status']=='Active') { ?>
                                            <a href="<?php echo base_url('products/editstatus/' . $allProduct['product_id']."/Inactive"); ?>" data-toggle="tooltip" data-placement="top" title="Update Product Status" class="dispaly_status"><i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>
                                            </a>
                                                                                      
                                        <?php } else { ?>
                                            <a href="<?php echo base_url('products/editstatus/' . $allProduct['product_id']."/Active"); ?>" data-toggle="tooltip" data-placement="top" title="Update Product Status" class="dispaly_status"><i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>
                                            </a>
                                        <?php } ?>  
                                            <a href="<?php echo base_url('products/deleteproduct/' . $allProduct['product_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Product Record" ><i class="fa fa-trash"></i>
                                            </a>
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
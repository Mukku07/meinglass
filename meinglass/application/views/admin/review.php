<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Customer's Reviews</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Customer's Review List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Author Name</th>
                                        <th>Address</th>
                                        <th>Review</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($reviewData)) {
                                        $i=1;
                                        foreach ($reviewData as $review) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $review['author']; ?></td>
                                                <td><?php echo $review['author_address']; ?></td>
                                                <td><?php echo $review['author_review']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('frontview/review/' . $review['review_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Review"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('frontview/doDeleteReview/' . $review['review_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Review"><i class="fa fa-trash"></i></a>
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
                        <?php if(!empty($reviewById)){ echo 'Edit'; }else{ echo 'Add'; } ?> Customer's Review
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($reviewById)){ echo base_url('frontview/doEditReview/'.$reviewById['review_id']); }else{ echo base_url('frontview/doAddReview'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Author Name', 'author') ?>
                                    <?php echo form_input(['name' => 'author', 'id' => 'author', 'type' => 'text', 'class' => 'form-control'], isset($reviewById['author']) ? $reviewById['author'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Address', 'author_address') ?>
                                    <?php echo form_input(['name' => 'author_address', 'id' => 'author_address', 'type' => 'text', 'class' => 'form-control'], isset($reviewById['author_address']) ? $reviewById['author_address'] : ''); ?>
                                    
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                     <?php echo form_label('Review', 'author_review') ?>
                                     <?php echo form_textarea(['name' => 'author_review', 'id' => 'author_review', 'type' => 'text', 'class' => 'form-control','rows'=>'5'],isset($reviewById['author_review'])?$reviewById['author_review']:''); ?>
                       
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


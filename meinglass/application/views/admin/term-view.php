<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Terms</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Term List
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
                                    if (!empty($tems)) {
                                        $i=1;
                                        foreach ($tems as $tem) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $tem['term']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('term/index/' . $tem['id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit term"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('term/deleteTerm/' . $tem['id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete term"><i class="fa fa-trash"></i></a>
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
                        <?php if(!empty($term)){ echo 'Edit'; }else{ echo 'Add'; } ?> Term
                    </div>
                    <div class="card-body">
                        <form method="post" id="common-form" action="<?php if(!empty($term)){ echo base_url('term/doEditTerm/'.$term['id']); }else{ echo base_url('term/doAddTerm'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Term', 'term') ?>
                                    <?php echo form_input(['name' => 'term', 'id' => 'term', 'type' => 'text', 'class' => 'form-control'], isset($term['term']) ? $term['term'] : ''); ?>
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


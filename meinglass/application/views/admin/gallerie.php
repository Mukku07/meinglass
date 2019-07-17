<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Gallerie</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Gallerie List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Min Size Image</th>
                                        <th>Max Size Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($gallerieData)) {
                                        $i=1;
                                        foreach ($gallerieData as $gallerie) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><img src="<?php echo base_url('uploads/gallerie/'.$gallerie['min_size_url']); ?>" height="80px" width="120px" alt="Gallerie Image Not Found"></td>
                                                <td><img src="<?php echo base_url('uploads/gallerie/'.$gallerie['max_size_url']); ?>" height="80px" width="120px" alt="Gallerie Image Not Found"></td>
                                                <td>
                                                    <a href="<?php echo base_url('frontview/gallerie/' . $gallerie['gallerie_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Gallerie"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('frontview/doDeleteGallerie/' . $gallerie['gallerie_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Gallerie"><i class="fa fa-trash"></i></a>
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
                        <?php if(!empty($gallerieById)){ echo 'Edit'; }else{ echo 'Add'; } ?> Gallerie
                    </div>
                    <div class="card-body">
                        <form method="post" id="image-form" enctype="multipart/form-data" action="<?php if(!empty($gallerieById)){ echo base_url('frontview/doEditGallerie/'.$gallerieById['gallerie_id']); }else{ echo base_url('frontview/doAddgallerie'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Min Size Image', 'min_size_url') ?>
                                    <?php echo form_input(['name' => 'min_size_url', 'id' => 'min_size_url', 'type' => 'file', 'class' => 'form-control'], isset($gallerieById['min_size_url']) ? $gallerieById['min_size_url'] : ''); ?>
                                    <br/>
                                    <?php if(!empty($gallerieById)){  ?>
                                    <img src="<?php echo base_url('uploads/gallerie/'.$gallerieById['min_size_url']); ?>" height="80px" width="120px">
                                    <?php
                                    } ?> 
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Max Size Image', 'max_size_url') ?>
                                    <?php echo form_input(['name' => 'max_size_url', 'id' => 'max_size_url', 'type' => 'file', 'class' => 'form-control'], isset($gallerieById['max_size_url']) ? $gallerieById['max_size_url'] : ''); ?>
                                    <br/>
                                    <?php if(!empty($gallerieById)){  ?>
                                    <img src="<?php echo base_url('uploads/news/'.$gallerieById['max_size_url']); ?>" height="80px" width="120px">
                                    <?php
                                    } ?> 
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


<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Carousel</li>
        </ol>
        <div id="error_msg"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Carousel View
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th> #Id</th>
                                        <th> Name </th>
                                        <th> Title</th>
                                        <th> Content</th>
                                        <th> Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     if (!empty($crouselData)) {
                                          $i=1;
                                          foreach ($crouselData as $CData) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $CData['carousel_name']; ?></td>
                                                <td><?php echo $CData['carousel_title']; ?></td>
                                                <td><?php echo $CData['carousel_content']; ?></td>
                                                <td><img src="<?php echo base_url('uploads/carousel/'.$CData['carousel_image']);?>" alt="Image Not Here" height="80" width="120px"></td>
                                                
                                                <td>
                                                    <a href="<?php echo base_url('frontview/carousel/'.$CData['carousel_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit Carousel"><i class="fa fa-pen-square"></i></a>
                                                    <a href="<?php echo base_url('frontview/doDeleteCarouselData/'.$CData['carousel_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete Carousel"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            
                                        $i++; }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php //if(!empty($crouselById)){ ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        <?php if(!empty($crouselById)){ echo 'Edit'; }else{ echo 'Add'; } ?> Carousel Data
                    </div>
                    <div class="card-body">
                        <form method="post" id="image-form" action="<?php if(!empty($crouselById)){ echo base_url('frontview/doEditCarouselData/'.$crouselById['carousel_id']); }else{ echo base_url('frontview/doAddCarouselData'); } ?>">
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Name', 'carousel_name') ?>
                                    <?php echo form_input(['name' => 'carousel_name', 'id' => 'carousel_name', 'type' => 'text', 'class' => 'form-control'], isset($crouselById['carousel_name']) ? $crouselById['carousel_name'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Title', 'carousel_title') ?>
                                    <?php echo form_input(['name' => 'carousel_title', 'id' => 'carousel_title', 'type' => 'text', 'class' => 'form-control'], isset($crouselById['carousel_title']) ? $crouselById['carousel_title'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Content', 'carousel_content') ?>
                                    <?php echo form_input(['name' => 'carousel_content', 'id' => 'carousel_content', 'type' => 'text', 'class' => 'form-control'], isset($crouselById['carousel_content']) ? $crouselById['carousel_content'] : ''); ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-10 offset-1">
                                    <?php echo form_label('Image', 'carousel_image') ?>
                                    <?php echo form_input(['name' => 'carousel_image', 'id' => 'carousel_image', 'type' => 'file', 'class' => 'form-control'], isset($crouselById['carousel_image']) ? $crouselById['carousel_image'] : ''); ?>
                                    <?php if(!empty($crouselById['carousel_image'])) { ?><img src="<?php echo base_url('uploads/carousel/'.$crouselById['carousel_image']);?>" alt="Image Not Here" height="80" width="120px" style="margin-top:5px;"><?php } ?>
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


<div id="content-wrapper">
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Edit News</li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                News
                <a href="<?php echo base_url('frontview/news') ?>" class="btn btn-outline-primary float-right">View News</a>
            </div>
            <div class="card-body">
                <form method="post" action="<?php if(!empty($newsById)){ echo base_url('frontview/doEditNews/'.$newsById['news_id']);}else{ echo base_url('frontview/doAddNews/'); } ?>" id="image-form" enctype="multipart/form-data">
                    <div class="row form-group">
                        <div class="col-md-4 offset-2">
                            <?php echo form_label('Name', 'news_title') ?>
                            <?php echo form_input(['name' => 'news_title', 'id' => 'news_title', 'type' => 'text', 'class' => 'form-control'],isset($newsById['news_title'])?$newsById['news_title']:''); ?>
                        </div>
                        <div class="col-md-4">
                        <?php echo form_label('Image', 'image_url') ?>
                            <?php echo form_upload(['name' => 'image_url', 'id' => 'image_url', 'class' => 'form-control']); ?>
                            <br/>
                            <?php if(!empty($newsById)){  ?>
                            <img src="<?php echo base_url('uploads/news/'.$newsById['image_url']); ?>" height="80px" width="120px">
                            <?php
                            } ?>    
                        </div>
                    </div>
                     <div class="row form-group">
                        <div class="col-md-8 offset-2">
                            <?php echo form_label('Description', 'news_content') ?>
                            <?php echo form_textarea(['name' => 'news_content', 'id' => 'news_content', 'type' => 'text', 'class' => 'form-control ','rows'=>'10'],isset($newsById['news_content'])?$newsById['news_content']:''); ?>
                            <!--<textarea name="news_content" id="news_content" class ="form-control "><?php if(!empty($newsById['news_content'])){ echo $newsById['news_content']; } else { } ?></textarea>-->
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2 offset-9">
                            <button type="submit" class="btn btn-primary">Submit</button>   
                        </div>
                    </div>
                </form>
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


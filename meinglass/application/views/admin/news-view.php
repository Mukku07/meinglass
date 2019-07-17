<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">View News</li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                News List
                <!--<a href="<?php echo base_url('frontview/addnews') ?>" class="btn btn-outline-primary float-right">Add News</a>-->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Banner</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($allNews)) {
                                $i=1;
                                foreach ($allNews as $news) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo base_url('uploads/news/'.$news['image_url']); ?>" height="150px" width="200px"></td>
                                        <td><?php echo $news['news_title']; ?></td>
                                        <td><?php echo substr($news['news_content'], 0, 400); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('frontview/addnews/' . $news['news_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit News"><i class="fa fa-pen-square"></i></a>
                                            <!--<a href="<?php echo base_url('frontview/doDeleteNews/' . $news['news_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete News"><i class="fa fa-trash"></i></a>-->
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


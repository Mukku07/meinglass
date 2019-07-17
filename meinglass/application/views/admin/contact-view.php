<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">View Cantact</li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Contact List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
<!--                                <th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($contactData)) {
                                $i=1;
                                foreach ($contactData as $contact) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $contact['name']; ?></td>
                                        <td><?php echo $contact['email']; ?></td>
                                        <td><?php echo $contact['message']; ?></td>
<!--                                        <td class="text-center">
                                            <a href="<?php echo base_url('frontview/addnews/' . $news['news_id']); ?>" data-toggle="tooltip" data-placement="top" title="Edit News"><i class="fa fa-pen-square"></i></a>
                                            <a href="<?php echo base_url('frontview/doDeleteNews/' . $news['news_id']); ?>" class="delete" data-toggle="tooltip" data-placement="top" title="Delete News"><i class="fa fa-trash"></i></a>
                                        </td>-->
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


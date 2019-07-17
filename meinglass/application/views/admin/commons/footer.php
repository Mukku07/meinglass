</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url('admin/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('public/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('public/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('public/js/jquery.easing.min.js'); ?>"></script>
<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url('public/js/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('public/js/dataTables.bootstrap4.js'); ?>"></script>
<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('public/js/sb-admin.min.js'); ?>"></script>
<!-- Demo scripts for this page-->
<script src="<?php echo base_url('public/js/datatables-demo.js'); ?>"></script>

<?php if(!empty($editor)){ ?>
<script src="<?php echo base_url('public/ckeditor/ckeditor.js'); ?>" ></script>
<script> CKEDITOR.replace('formula');</script>
<script> CKEDITOR.replace('news_content');</script>
<?php } ?>

<script src="<?php echo base_url('public/js/back-script.js'); ?>"></script>

</body>
</html>

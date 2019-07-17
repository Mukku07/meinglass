<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('shape'); ?>">Shape</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $title; ?></li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Add Formula
                <a href="<?php echo base_url('shape') ?>" class="btn btn-outline-primary float-right">Back</a>
            </div>
            <div class="card-body">
                <?php if(empty($dimension['image_url']) & empty($mapping)){ 
                ?>   
                <div class="row form-group">
                    <div class="col-md-10 offset-3">
                        <h2>Please First Add The Dimension Details</h2>
                    </div>
                </div>
                <?php    
                }else{
                ?>
                <div class="row form-group">
                    <div class="col-md-5" style="border-right:1px solid grey;">
                        <div class="row form-group">
                            <div class="col-md-6 offset-3">
                                <?php echo '<b>' . $shape['name'] . '</b>'; ?><br/>
                                <img src="<?php if(!empty($dimension['image_url'])){echo base_url('uploads/dimension/' . $dimension['image_url']);}else{ echo base_url('public/image/noimage.png'); } ?>" alt="Image Not Available">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <form method="post" action="<?php echo base_url('shape/doAddFormula/'.$shape['shape_id']) ?>" id="add-formula">
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <h4>Dimensions : <?php $num_of_items=count($mapping); $num_count = 0; foreach($mapping as $map){ echo $terms[$map['term_id']].'('.$map['prefix'].')'; $num_count++; if ($num_count < $num_of_items) { echo ", "; } } ?></h4>
                                    <span class="error">*Note: Use Only Dimension Prefix In Formula.</span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="formula">Enter Formula</label>
                                    <textarea name="formula" id="formula" class="form-control editor" rows="5"><?php if(!empty($shape['formula'])){ echo $shape['formula']; } ?></textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-2 offset-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
                <?php
                } 
                ?>
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


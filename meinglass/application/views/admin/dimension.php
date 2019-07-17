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
                Describe Dimension
                <a href="<?php echo base_url('shape') ?>" class="btn btn-outline-primary float-right">Back</a>
            </div>
            <div class="card-body">
                <div class="row form-group" style="border-bottom:1px solid grey;">
                    <div class="col-md-6" style="border-right:1px solid grey;">
                        <form method="post" action="<?php echo base_url('shape/doAddDimensionImage/'.$shape['shape_id']); ?>" id="image-form" enctype="multipart/form-data">
                            <div class="row form-group">
                                <div class="col-md-6 offset-3">
                                    <img src="<?php if(!empty($dimension['image_url'])){echo base_url('uploads/dimension/' . $dimension['image_url']);}else{ echo base_url('public/image/noimage.png'); } ?>" alt="Image Not Available">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6 offset-2">
                                    <input type="file" name="image_url" required id="image_url" class="form-control"/>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-md-5 offset-1">
                        <?php echo '<b>' . $shape['name'] . '</b>'; ?><br/>
                        <img src="<?php echo base_url('uploads/shape/' . $shape['image_url']); ?>">
                    </div>
                </div>
                <form method="post" action="<?php echo base_url('shape/doUpdateDimension/'.$shape['shape_id']); ?>" id="common-form">
                    <div class="row form-group">
                        <div class="col-md-5 offset-1">
                            <?php echo form_label('Description','description'); ?>
                            <?php echo form_textarea(['name'=>'description','id'=>'description','class'=>'form-control','rows'=>3],isset($dimension['description'])?$dimension['description']:''); ?>
                        </div>
                        <div class="col-md-5">
                            <?php echo form_label('Special Note','special_note'); ?>
                            <?php echo form_textarea(['name'=>'special_note','id'=>'special_note','class'=>'form-control','rows'=>3],isset($dimension['special_note'])?$dimension['special_note']:''); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <div class="col-md-2 offset-1">
                            <?php echo form_label('Include Corner','is_corner'); ?>
                            <input type="checkbox" name="is_corner" id="is_corner" value="1" <?php if(!empty($dimension['is_corner'])){ echo 'checked';} ?> >
                        </div>
                        <div class="col-md-1">
                            <a href="#" class="corner_clone_add"><i class="fas fa-plus-square"></i></a>
                        </div>
                    </div>
                    <?php if(!empty($corners)){
                                $j=1;
                                foreach($corners as $corner){
                            ?>
                     <div class="row form-group corner_clone crn">
                        <input type="hidden" name="corner_id[]" id="corner_id" value="<?php echo $corner['id']; ?>" />
                        <div class="col-md-12 offset-1">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php echo form_input(['name'=>'corner_name[]','required'=>'required','placeholder'=>'Corner Name','id'=>'corner_name','class'=>'form-control'],$corner['corner_name']); ?>
                                </div>
                                <div class="col-md-1"  style="margin-top: 7px">
                                    <?php if($j!=1){
                                    ?>
                                    <span><a href="<?php echo base_url('shape/removeDimensionCorner'); ?>" class="remove_corner"><i class="fas fa-minus-square"></i></a></span>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                            $j++;    }
                            }else{
                            ?>
                    <div class="row form-group corner_clone crn">
                        <div class="col-md-12 offset-1">
                            <div class="row">
                                <div class="col-md-2">
                                    <?php echo form_input(['name'=>'corner_name[]','placeholder'=>'Corner Name','id'=>'corner_name','class'=>'form-control']); ?>
                                </div>
                                <div class="col-md-1"  style="margin-top: 7px"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                            } ?>
                    <hr>
                    <div class="row corner_row">
                        <div class="col-md-2 offset-1">
                            <?php echo form_label('Add Dimension','term_id'); ?>
                        </div>
                        <div class="col-md-1">
                            <span><a href="#" class="tr_clone_add"><i class="fas fa-plus-square"></i></a></span>
                        </div>
                    </div>
                    <?php 
                        if(!empty($mapping)){
                            $i=1;
                            foreach($mapping as $map){
                        ?>
                        <div class="row form-group tr_clone">
                            <input type="hidden" name="mapping_id[]" id="mapping_id" value="<?php echo $map['mapping_id']; ?>" />
                            <div class="col-md-2 offset-1">
                                <?php echo form_dropdown(['name'=>'term_id[]','required'=>'required','id'=>'term_id','class'=>'form-control add-term'],$terms,$map['term_id']); ?>
                            </div>
                            <div class="col-md-2">
                                <?php echo form_input(['name'=>'prefix[]','required'=>'required','placeholder'=>'Prefix','id'=>'prefix','class'=>'form-control'],$map['prefix']); ?>
                            </div>
                            <!-- <div class="col-md-2">
                                <?php //echo form_input(['type'=>'number','name'=>'min_size[]','required'=>'required','placeholder'=>'Min Size','id'=>'min_size','min'=>0,'class'=>'form-control'],$map['min_size']); ?>
                            </div>
                            <div class="col-md-2">
                                <?php //echo form_input(['type'=>'number','name'=>'max_size[]','required'=>'required','placeholder'=>'Max Size','id'=>'max_size','min'=>0,'class'=>'form-control'],$map['max_size']); ?>
                            </div> -->
                            <div class="col-md-1" style="margin-top: 7px">
                                <?php 
                                if($i!=1){
                                ?>
                                <span><a href="<?php echo base_url('shape/removeDimension'); ?>" class="remove_row"><i class="fas fa-minus-square"></i></a></span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php $i++;
                            }
                        }else{
                    ?>
                    <div class="row form-group tr_clone">
                        <div class="col-md-2 offset-1">
                            <?php echo form_dropdown(['name'=>'term_id[]','required'=>'required','id'=>'term_id','class'=>'form-control add-term'],$terms); ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo form_input(['name'=>'prefix[]','required'=>'required','placeholder'=>'Prefix','id'=>'prefix','class'=>'form-control']); ?>
                        </div>
                        <!-- <div class="col-md-2">
                            <?php //echo form_input(['type'=>'number','name'=>'min_size[]','required'=>'required','placeholder'=>'Min Size','id'=>'min_size','min'=>0,'class'=>'form-control']); ?>
                        </div>
                        <div class="col-md-2">
                            <?php //echo form_input(['type'=>'number','name'=>'max_size[]','required'=>'required','placeholder'=>'Max Size','id'=>'max_size','min'=>0,'class'=>'form-control']); ?>
                        </div> -->
                        <div class="col-md-1" style="margin-top: 7px">
                            
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="row clon_row">
                        <div class="col-md-2 offset-10">
                            <button type="submit" class="btn btn-success">Submit</button>
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


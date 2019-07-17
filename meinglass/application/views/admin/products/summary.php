<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $title; ?></li>
        </ol>
        <div id="error_msg"></div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Product
                <a href="<?php echo base_url('products/');?>" class="btn btn-outline-primary float-right">View Products</a>
            </div>
            
        </div>
           
        <div class="products boxs">
            <div class="container">
                <div class="product_headings boxs" >
                    <ul>
                        <li><a href="javascript:vod(0)" class="active">SHAPE</a></li>
                        <li><a href="javascript:vod(0)" class="active">DIMENSIONS</a></li>
                        <li><a href="javascript:vod(0)" class="active">TYPE</a></li>
                        <li><a href="javascript:vod(0)" class="active">THICKNESS</a></li>
                        <li><a href="javascript:vod(0)" class="active">EDGEWORK</a></li>
                        <li><a href="javascript:vod(0)" class="active">SURFACE TREATMENT</a></li>
                        <li><a href="javascript:vod(0)" class="active">SUMMARY</a></li>
                        <!-- <li><a href="javascript:vod(0)">ORDER</a></li> -->
                    </ul>
                </div>
                <div class="glass_top boxs">
                    <a href="<?php echo base_url('products/surface_treatment/'.$products['product_id']); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('products/submitPriceofProduct/'.$products['product_id']); ?>" id="summary-continue" class="continue">Submit</a>
                </div>

                <div class="products_inner boxs">
                    <div class="summary boxs">
                        <!--  <div class="container"></div> -->
                        <h1>Order Summary</h1>
                        
                                <table>
                                    <tr>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>Dimension</th>
                                        
                                    </tr>

                                    <tr>
                                        <td><?php echo "#"; ?></td>
                                        <td>
                                            <?php if ($glass_type['image_url']) { ?><span class="text-center"><img src="<?php echo base_url(); ?>uploads/type/<?php echo $glass_type['image_url']; ?>" alt="Items Missing here" class="img-thumbnail"></span><?php } ?>

                                            <?php if ($glass_type['name']) { ?><span class="text-center"> <strong><?php echo $glass_type['name']; ?></strong></span><?php } ?>

                                            <?php if ($shapes['name']) { ?><span><strong>Shape: </strong><?php echo $shapes['name']; ?></span><?php } ?>
                                           
                                            <?php if ($material['material_name']) { ?><span><strong>Material Name: </strong><?php echo $material['material_name']; ?></span><?php } ?>

                                            <?php if ($thickness['thickness']) { ?><span><strong>Thickness: </strong><?php echo $thickness['thickness']; ?></span><?php } ?>

                                            <?php if ($edge['type']) { ?><span><strong>Edge Name:</strong> <?php echo $edge['type']; ?></span><?php } ?>
 
                                            <?php if ($edge_element['edge_element_name']) { ?><span><strong>Edge Element: </strong><?php echo $edge_element['edge_element_name']; ?></span><?php } ?>

                                            <?php if ($edge_type['edge_type_value']) { ?><span><strong>Edge Type:</strong> <?php echo $edge_type['edge_type_value']; ?></span><?php } ?>

                                            <?php if ($surface_treatment['type']) { ?><span><strong>Surface Treatment: </strong><?php echo $surface_treatment['type']; ?></span><?php } ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (!empty($products['dimension_id'])) {
                                                $term_size = explode(',', $products['term_size']);
                                                $i = 0;
                                                foreach ($dimension_mapping as $tdm) {
                                                    echo $tdm['term'] . " (" . $tdm['prefix'] . '): ' . $term_size[$i] . '<br>';
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </td>
                                       
                                    </tr>
                                </table>


                        <?php if(!empty($shapeCircumferencewithPrice)) {  ?>
                            <div class="calculate boxs">
                                <div id="cal_ShippingCost" >
                                    <form name="price_form" id="price_form">
                                    <h4>Shipping Cost Details.</h4>
                                    <?php if(!empty($shapeCircumferencewithPrice)){ ?><span style="padding: 10px;"><?php echo "<b>Total price : </b>".$shapeCircumferencewithPrice;?></span>
                                    <input type="hidden" name="product_price" id="product_price" value="<?php echo $shapeCircumferencewithPrice; ?>" />
                                    <?php } ?>
                                    </from>
                                </div>
                            </div>
                        <?php  } ?>
                      
                    </div>
                </div>

                <div class="bottom_p boxs">
                    <a href="<?php echo base_url('products/surface_treatment/'.$products['product_id']); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('products/submitPriceofProduct/'.$products['product_id']); ?>" id="summary-continue" class="continue">Submit</a>
                </div>
            </div>
        </div>

       
    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © Meinglass 2019</span>
            </div>
        </div>
    </footer>

</div>
<!-- /.content-wrapper -->
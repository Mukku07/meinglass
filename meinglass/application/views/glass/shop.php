<section class='shop boxs'>
    <div class='container'>
        <div class='shop_inner boxs'>
            <div class="row">
                <?php if(!empty($allProducts)) { 
                    foreach ($allProducts as $product) {
                    //echo "<pre>"; print_r($product);
                   
                ?>
                <div class="col-sm-3">
                    <div class="product_box_inner product_box_inner1">
                        <div class='product_box_inner2'>
                            <a class="img_link" href="#"> <!-- <img src="<?php echo base_url('public/image/24inch-flat.png'); ?>" class="img-responsive" alt="product"> -->

                                <img src="<?php echo base_url('uploads/type/'.$product['glass_type']['image_url']); ?>"  class="img-responsive" alt="product">
                            </a>
                            <div class="discription_pro"><a class="pro_small_title" href="#"><?php echo $product['shape_data']['name']; ?></a>
                                <a href="#"><?php echo $product['material']['material_name']; ?>, <?php echo $product['thickness']['thickness']; ?>, <?php echo $product['surface_treatment']['type']; ?>
                                </a>
                            </div>
                            <div class="rating-box">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="product-price">
                                <div class="msrp"><?php echo "08".",00 €"; ?></div>
                                <div class="sales"><?php echo $product['product_price'].",00 €"; ?></div>
                            </div>
                        </div>
                        <div class=product_btn>
                            <button type="button" id="addto_cart">add to cart</button>
                        </div>
                    </div>
                </div>
                <?php  } } ?>
               
                <!-- <div class="col-sm-3">
                    <div class="product_box_inner product_box_inner1">
                        <div class='product_box_inner2'>
                            <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/24inch-flat.png'); ?>" class="img-responsive" alt="product">
                            </a>
                            <div class="discription_pro"><a class="pro_small_title" href="#"> Round Table Tops</a>
                                <a href="#">24" Round Glass Table Top, 1/4" Thick, Flat Polish Edge, Tempered Glass
                                </a>
                            </div>
                            <div class="rating-box">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="product-price">
                                <div class="msrp">$53.06</div>
                                <div class="sales">$45.95</div>
                            </div>
                        </div>
                        <div class=product_btn>
                            <button type="button">add to cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product_box_inner product_box_inner1">
                        <div class='product_box_inner2'>
                            <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/gym-mirror.jpg'); ?>" class="img-responsive" alt="product">
                            </a>
                            <div class="discription_pro"><a class="pro_small_title" href="#">Gym Mirrors</a>
                                <a href="#">24" Round Glass Table Top, 1/4" Thick, Flat Polish Edge, Tempered Glass
                                </a>
                            </div>
                            <div class="rating-box">
                                <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="product-price">
                                <div class="msrp">$53.06</div>
                                <div class="sales">$45.95</div>
                            </div>
                        </div>
                        <div class=product_btn>
                            <button type="button">add to cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product_box_inner product_box_inner1">
                        <div class='product_box_inner2'>
                            <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/bath-offers.png'); ?>" class="img-responsive" alt="product">
                            </a>
                            <div class="discription_pro"><a class="pro_small_title" href="#">Bathtub Screens</a>
                                <a href="#">24" Round Glass Table Top, 1/4" Thick, Flat Polish Edge, Tempered Glass
                                </a>
                            </div>
                            <div class="rating-box">
                                <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="product-price">
                                <div class="msrp">$53.06</div>
                                <div class="sales">$45.95</div>
                            </div>
                        </div>
                        <div class=product_btn>
                            <button type="button">add to cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product_box_inner product_box_inner1">
                        <div class='product_box_inner2'>
                            <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/glass-shelfs.png'); ?>" class="img-responsive" alt="product">
                            </a>
                            <div class="discription_pro"><a class="pro_small_title" href="#">Glass Shelves</a>
                                <a href="#">24" Round Glass Table Top, 1/4" Thick, Flat Polish Edge, Tempered Glass
                                </a>
                            </div>
                            <div class="rating-box">
                                <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="product-price">
                                <div class="msrp">$53.06</div>
                                <div class="sales">$45.95</div>
                            </div>
                        </div>
                        <div class=product_btn>
                            <button type="button">add to cart</button>
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- <div class="row">
                <div class="col-sm-3">
                    <div class="product_box_inner product_box_inner1">
                        <div class='product_box_inner2'>
                            <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/round-mirror.png'); ?>" class="img-responsive" alt="product">
                            </a>
                            <div class="discription_pro"><a class="pro_small_title" href="#">Round Mirrors</a>
                                <a href="#">24" Round Glass Table Top, 1/4" Thick, Flat Polish Edge, Tempered Glass
                                </a>
                            </div>
                            <div class="rating-box">
                                <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="product-price">
                                <div class="msrp">$53.06</div>
                                <div class="sales">$45.95</div>
                            </div>
                        </div>
                        <div class=product_btn>
                            <button type="button">add to cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product_box_inner product_box_inner1">
                        <div class='product_box_inner2'>
                            <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/round-mirror.png'); ?>" class="img-responsive"
                                                               alt="product">
                            </a>
                            <div class="discription_pro"><a class="pro_small_title" href="#">Rectangle Mirrors</a>
                                <a href="#">24" Round Glass Table Top, 1/4" Thick, Flat Polish Edge, Tempered Glass
                                </a>
                            </div>
                            <div class="rating-box">
                                <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="product-price">
                                <div class="msrp">$53.06</div>
                                <div class="sales">$45.95</div>
                            </div>
                        </div>
                        <div class=product_btn>
                            <button type="button">add to cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class='product_box_inner product_box_inner1'>
                        <div class="product_box_inner2">
                            <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/shower-sweeps.jpg'); ?>" class="img-responsive" alt="product">
                            </a>
                            <div class="discription_pro"><a class="pro_small_title" href="#">Shower Sweeps</a>
                                <a href="#">24" Round Glass Table Top, 1/4" Thick, Flat Polish Edge, Tempered Glass
                                </a>
                            </div>
                            <div class="rating-box">
                                <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="product-price">
                                <div class="msrp">$53.06</div>
                                <div class="sales">$45.95</div>
                            </div>
                        </div>
                        <div class=product_btn>
                            <button type="button">add to cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product_box_inner product_box_inner1">
                        <div class='product_box_inner2'>
                            <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/Fireplace.png'); ?>" class="img-responsive" alt="product">
                            </a>
                            <div class="discription_pro"><a class="pro_small_title" href="#">Fireplace Glass</a>
                                <a href="#">24" Round Glass Table Top, 1/4" Thick, Flat Polish Edge, Tempered Glass
                                </a>
                            </div>
                            <div class="rating-box">
                                <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i
                                    class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="product-price">
                                <div class="msrp">$53.06</div>
                                <div class="sales">$45.95</div>
                            </div>
                        </div>
                        <div class=product_btn>
                            <button type="button">add to cart</button>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
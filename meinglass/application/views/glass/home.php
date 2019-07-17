<!-- slider product banner-->
<div class="product_banner boxs">
    <div class="pro_items slick boxs">
        <?php if(!empty($carousels)) { foreach($carousels as $carousel) { ?>
        <div class="flexy boxs">
            <div class="col-sm-7 nopadding">
                <div class="content_pro content_pro1">
                    <div>
                        <h4><?php echo $carousel['carousel_name']; ?></h4>
                        <h2><?php echo $carousel['carousel_title']; ?></h2>
                        <p><?php echo $carousel['carousel_content']; ?></p>
                        <a href="<?php echo base_url('home/shop');?>">shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 nopadding">
                <div class="content_img">
                    <img src="<?php echo base_url('uploads/carousel/'.$carousel['carousel_image']); ?>" class="img-responsive" alt="product">
                </div>
            </div>
        </div>
        <?php } } ?>
    </div>
</div>

<!-- product sections-->
<div class="product_box product_box1 boxs">
    <h2>Popular Konfigure Products</h2>
    <div class="row">
        <div class="col-sm-4">
            <div class="product_box_inner">
                <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/low_iron.png'); ?>" class="img-responsive" alt="product">
                </a>
                <div class="discription_pro"><a class="pro_small_title" href="#">Low Iron Glass</a>
                    <a href="#">Gray glass accented with a decorative layer of clear glass and plated gun metal
                        details
                    </a>
                </div>

            </div>
        </div>

        <div class="col-sm-4">
            <div class="product_box_inner">
                <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/frosted.jpg'); ?>" class="img-responsive" alt="product">
                </a>
                <div class="discription_pro"><a class="pro_small_title" href="#">Frosted Glass</a>
                    <a href="#">Gray glass accented with a decorative layer of clear glass and plated gun metal
                        details
                    </a>
                </div>

            </div>
        </div>

        <div class="col-sm-4">
            <div class="product_box_inner">
                <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/gray_glass.jpg'); ?>" class="img-responsive" alt="product">
                </a>
                <div class="discription_pro"><a class="pro_small_title" href="#">Gray Glass</a>
                    <a href="#">Gray glass accented with a decorative layer of clear glass and plated gun metal
                        details
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<!--    product slider-->

<div class="product_box productBox_slides boxs">
    <h2>Popular Glass and Mirror Products</h2>
    <div class="slider">
        <div class="row">
            <div class="col-sm-3 col-xs-6">
                <div class="product_box_inner product_box_inner1">
                    <div class='product_box_inner2'>
                        <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/24inch-flat.png'); ?>" class="img-responsive" alt="product">
                        </a>
                        <div class="discription_pro"><a class="pro_small_title" href="#"> Round Table Tops</a>
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
            <div class="col-sm-3 col-xs-6">
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
            <div class="col-sm-3 col-xs-6">
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
            <div class="col-sm-3 col-xs-6">
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
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3 col-xs-6">
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
            <div class="col-sm-3 col-xs-6">
                <div class="product_box_inner product_box_inner1">
                    <div class='product_box_inner2'>
                        <a class="img_link" href="#"> <img src="<?php echo base_url('public/image/rectangle-mirror.png'); ?>" class="img-responsive"
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
            <div class="col-sm-3 col-xs-6">
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
            <div class="col-sm-3 col-xs-6">
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
        </div>
    </div>
</div>

<!--askfree-->
<div class="product_box askfree  boxs">
    <h2>Get Started or Ask for free Quote</h2>
    <p>Get Your Glass in as Little as One Day!</p>
    <ul>
        <li class="orderbtn"><a href="#">Order Now</a></li>
        <li class="quote"><a href="#">Get a Quote</a></li>
    </ul>
</div>

<!-- home gallery-->
<div class="product_box gallery boxs">
    <h2>Photos from our customers</h2>
    <div class="row">
        <?php if(!empty($galleries)) { foreach($galleries as $gallerie){ ?>
        <div class="col-sm-3 col-xs-6 nopadd">
            <div class="galleryimage boxs">
                <div class="top boxs">
                    <a href="<?php echo base_url('uploads/gallerie/'.$gallerie['max_size_url']); ?>" class="swipebox">
                        <img src="<?php echo base_url('uploads/gallerie/'.$gallerie['min_size_url']); ?>" alt="gallery" class="img-responsive img_1">
                    </a>
                </div>
            </div>
        </div>
        <?php } } ?>
    </div>
</div>

<!-- testimonial content -->
<section class="testimonial boxs">
    <div class="container">
        <div class="testouter boxs">
            <h2>Our Customer's Reviews</h2>
            <div class="slick2 boxs">
                <?php if(!empty($reviews)) { foreach($reviews as $review){?>
                <div class="testimonialinner boxs">
                    <div class="bottom boxs">
                        <div class="testidetail boxs">
                            <p><span>"</span><?php echo $review['author_review'];?><span>"</span></p>
                            <h6><?php echo $review['author'];?></h6>
                            <h5><?php echo $review['author_address'];?></h5>
                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div>
        </div>
    </div>
</section>
<!-- testimonial content -->

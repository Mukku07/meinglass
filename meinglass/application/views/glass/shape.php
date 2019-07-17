<div class="products boxs">
    <div class="container">
        <div class="product_headings boxs">
            <ul>
                <li><a href="javascript:vod(0)" class="active">SHAPE</a></li>
                <li><a href="javascript:vod(0)">DIMENSIONS</a></li>
                <li><a href="javascript:vod(0)">TYPE</a></li>
                <li><a href="javascript:vod(0)">THICKNESS</a></li>
                <li><a href="javascript:vod(0)">EDGEWORK</a></li>
                <li><a href="javascript:vod(0)">SURFACE TREATMENT</a></li>
                <li><a href="javascript:vod(0)">SUMMARY</a></li>
                <li><a href="javascript:vod(0)">ORDER</a></li>
            </ul>
        </div>
        <div class="glass_top boxs">
            <h1 class="heading_top">Glass Type</h1>
            <a href="<?php echo base_url('konfigurator/shapeCal'); ?>" id="shape-continue" class="continue">Continue</a>
        </div>
        <section class="shapes boxs">
            <div class="shapes_inner boxs">
                <p>Please choose the picture below that best describes the shape of your glass. The picture does
                    not have to match your piece exactly. In the next few steps, you will have a chance to tell us
                    more about your piece. What shape is your glass?
                </p>
                <?php if(!empty($shapes)){
                    $i=1;
                    foreach($shapes as $shape){
                ?>
                <div class="col-sm-4 col-xs-6 col-lg-2">
                    <div class="shapes_wrap boxs">
                        <a href="javascript:void(0)" class="mydata">
                            <img src="<?php echo base_url('uploads/shape/'.$shape['image_url']); ?>" alt="<?php echo $shape['name']; ?>" class="img-responsive shapes_img">
                        </a>
                        <label> <input name="Shape" type="radio" value="<?php echo $shape['shape_id']; ?>" class="shape" <?php if(!empty($user['shape_id'])){ if($user['shape_id']==$shape['shape_id']){ echo 'checked'; } }else if($i==1){echo 'checked';} ?> ><?php echo $shape['name']; ?></label>
                    </div>
                </div>
                <?php
                $i++;
                    }
                } ?>

            <!--    <div class="col-sm-4 col-lg-2 col-xs-6">
                    <div class="shapes_wrap boxs">
                        <a href="contact.html" class="mydata">
                            <img src="<?php echo base_url('public/image/irregular.jpg') ?>" alt="irregular" class="img-responsive shapes_img">

                            <label>Irregular/Any Other Shape</label></a>
                    </div>
                </div> -->

            </div>

        </section>

        <div class="bottom_p boxs">
            <a href="<?php echo base_url('konfigurator/shapeCal'); ?>" id="shape-continue" class="continue">Continue</a>
        </div>
    </div>
</div>

<!--product page end-->

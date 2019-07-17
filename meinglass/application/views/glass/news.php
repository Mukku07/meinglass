<section class='news boxs'>
    <img src="<?php echo base_url('public/image/blog.jpg'); ?>" alt='glass_img' class=img-responsive>
        <div class='container'>
            <div class='new_inner boxs'>
                <ul>
                    <li>Author <a href="#">webdoone</a> january 2, 2019</li>
                    <li><i class="fa fa-comments-o" aria-hidden="true"></i> 0 comments</li>
                    <li><i class="fa fa-eye"></i> view</li>
                </ul>
                <?php if(!empty($newss)) { ?>
                <h1><?php echo $newss['news_title'];?></h1>
                <p><?php echo $newss['news_content'];?></p>
                <?php } ?>
                <div class="product_box gallery boxs">
                    <h2>Photos from our customers</h2>
                    <div class="row">
                        <?php if(!empty($galleries)) { foreach($galleries as $gallerie){ ?>
                        <div class="col-sm-3 nopadd">
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
                <div class="blog_form boxs">
                    <form name="common-form" id="common-form" action="<?php echo base_url('home/doAddContact');?>" method="post">
                        <div class='form-group'>
                            <textarea class='form-control' name="message" id="message" placeholder="Leave a message"></textarea>
                        </div>
                        <div class='col-sm-6 noleft'>
                            <div class='form-group'>
                                <input type="text" name="name" id="name" class='form-control' placeholder="Name">
                            </div>
                        </div>
                        <div class='col-sm-6 noright'>
                            <div class='form-group'>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <br/>
                        <div id="error_msg"></div>
                        <button name="submit" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
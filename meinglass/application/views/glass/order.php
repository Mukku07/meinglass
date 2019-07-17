<!--order page start-->
        <div class="order boxs">
            <div class="product_headings boxs">
                <ul>
                    <li><a href="javascript:vod(0)" class="active">SHAPE</a></li>
                    <li><a href="javascript:vod(0)" class="active">DIMENSIONS</a></li>
                    <li><a href="javascript:vod(0)" class="active">TYPE</a></li>
                    <li><a href="javascript:vod(0)" class="active">THICKNESS</a></li>
                    <li><a href="javascript:vod(0)" class="active">EDGEWORK</a></li>
                    <li><a href="javascript:vod(0)" class="active">SURFACE TREATMENT</a></li>
                    <li><a href="javascript:vod(0)" class="active">SUMMARY</a></li>
                    <li><a href="javascript:vod(0)" class="active">ORDER</a></li>
                </ul>
            </div>
            <div class="container">
            <form method="post" action="<?php if(!empty($billingAddress && $shippingAddress )){ echo base_url('konfigurator/doEditAddress/'.$user['user_id']); ?>" id="address_form">    
                <div class="glass_top order_top boxs">
                    <div class="cart_items">
                    <h5><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php $qty = 0; if(!empty($productqty)) { foreach($productqty as $cartdata){ ?>
                        <span class="displayinline"><?php  $qty = $qty + $cartdata['productqty']['qty']; } echo $qty; } else { echo '0'; } ?> Items</span>
                    </h5>
                    </div>
                    <h1 class="heading_top">Billing & Shipping Address</h1>
                      
                    <a href="<?php echo base_url('konfigurator/summary'); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('konfigurator/doEditAddress'); ?>" id="order-continue" class="continue">Continue to Payment</a>
                </div>

                <div class="order_inner boxs">
                    <div class="col-sm-6 noleft">
                        <div class="billing boxs">
                            <h3>Billing Address</h3>
                        
                            <div class="billing_inner boxs" id="billing_address">

                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Company:<span>(Optional)</span></p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_comp_name" id="billing_comp_name" <?php if(!empty($billingAddress['comp_name'])) {?> value="<?php echo $billingAddress['comp_name']; }  ?>" >
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>First Name:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_first_name" id="billing_first_name" <?php if(!empty($billingAddress['first_name'])) {?> value="<?php echo $billingAddress['first_name']; }  ?>" >
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Last Name:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_last_name" id="billing_last_name" <?php if(!empty($billingAddress['last_name'])) {?> value="<?php echo $billingAddress['last_name']; }  ?>" >
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Email:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_email" id="billing_email" <?php if(!empty($billingAddress['email'])) {?> value="<?php echo $billingAddress['email']; }  ?>" >
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Confirm Email:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_conf_email" name="billing_conf_email" <?php if(!empty($billingAddress['email'])) {?> value="<?php echo $billingAddress['email']; }  ?>" >
                                    </div>
                                </div>

                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Country:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_country" id="billing_country" <?php if(!empty($billingAddress['country'])) {?> value="<?php echo $billingAddress['country']; }  ?>">
                                    </div>
                                    <!-- <div class="col-xs-9 noleft">
                                        <select name="billing_country" id="billing_country" >
                                            <option>United States</option>
                                            <option>Canada</option>
                                            <option>United Kingdom</option>
                                        </select>
                                    </div> -->
                                </div>

                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Address:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_address1" id="billing_address1" <?php if(!empty($billingAddress['address1'])) {?> value="<?php echo $billingAddress['address1']; }  ?>" >
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Address 2:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_address2" id="billing_address2" <?php if(!empty($billingAddress['address2'])) {?> value="<?php echo $billingAddress['address2']; }  ?>">
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Zip Code:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_zip_code" id="billing_zip_code" <?php if(!empty($billingAddress['zip'])) {?> value="<?php echo $billingAddress['zip']; }  ?>">
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>City:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_city" id="billing_city" <?php if(!empty($billingAddress['city'])) {?> value="<?php echo $billingAddress['city']; }  ?>">
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>State:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_state" id="billing_state" <?php if(!empty($billingAddress['state'])) {?> value="<?php echo $billingAddress['state']; }  ?>">
                                    </div>
                                    <!-- <div class="col-xs-9 noleft" name="billing_state" id="billing_state">
                                        <select>
                                            <option>--Select--</option>
                                            <option>Indiana</option>
                                            <option>Arizona</option>
                                            <option>D.C</option>
                                            <option>California</option>
                                            <option>Georgia</option>
                                            <option>Lowa</option>
                                            <option>Hawaii</option>
                                            <option>Kansas</option>
                                        </select>
                                    </div> -->
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Phone:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="billing_phone" id="billing_phone" <?php if(!empty($billingAddress['phone'])) {?> value="<?php echo $billingAddress['phone']; }  ?>" > 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 noright">
                        <div class="billing boxs">
                            <h3>Shipping Address</h3>
                            <div class="billing_inner boxs" id="shipping_address">
                                <div class="check boxs">
                                    <div class="col-xs-3">

                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="checkbox" name="same_address" id="same_address">
                                        <p>Use Billing Address</p>
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Company:<span>(Optional)</span></p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_comp_name" id="shipping_comp_name" <?php if(!empty($shippingAddress['comp_name'])) {?> value="<?php echo $shippingAddress['comp_name']; }  ?>">
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>First Name:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_first_name" id="shipping_first_name" <?php if(!empty($shippingAddress['first_name'])) {?> value="<?php echo $shippingAddress['first_name']; }  ?>" >
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Last Name:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_last_name" id="shipping_last_name" <?php if(!empty($shippingAddress['last_name'])) {?> value="<?php echo $shippingAddress['last_name']; }  ?>" >
                                    </div>
                                </div>



                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Country:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_country" id="shipping_country" <?php if(!empty($shippingAddress['country'])) {?> value="<?php echo $shippingAddress['country']; }  ?>">
                                    </div>
                                    <!-- <div class="col-xs-9 noleft">
                                        <select name="shipping_country" id="shipping_country">
                                            <option>United States</option>
                                            <option>Canada</option>
                                            <option>United Kingdom</option>
                                        </select>
                                    </div> -->
                                </div>

                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Address:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_address1" id="shipping_address1" <?php if(!empty($shippingAddress['address1'])) {?> value="<?php echo $shippingAddress['address1']; }  ?>">
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Address 2:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_address2" id="shipping_address2" <?php if(!empty($shippingAddress['address2'])) {?> value="<?php echo $shippingAddress['address2']; }  ?>">
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Zip Code:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_zip_code" id="shipping_zip_code" <?php if(!empty($shippingAddress['zip'])) {?> value="<?php echo $shippingAddress['zip']; }  ?>">
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>City:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_city_name" id="shipping_city_name" <?php if(!empty($shippingAddress['city'])) {?> value="<?php echo $shippingAddress['city']; }  ?>">
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>State:</p>
                                    </div>
                                    <!-- <div class="col-xs-9 noleft">
                                        <select name="shipping_state_name" id="shipping_state_name">
                                            <option>--Select--</option>
                                            <option>Indiana</option>
                                            <option>Arizona</option>
                                            <option>D.C</option>
                                            <option>California</option>
                                            <option>Georgia</option>
                                            <option>Lowa</option>
                                            <option>Hawaii</option>
                                            <option>Kansas</option>

                                        </select>
                                    </div> -->
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_state" id="shipping_state" <?php if(!empty($shippingAddress['state'])) {?> value="<?php echo $shippingAddress['state']; }  ?>">
                                    </div>
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Address Type</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="address_type" id="address_type" <?php if(!empty($shippingAddress['address_type'])) {?> value="<?php echo $shippingAddress['address_type']; }  ?>">
                                    </div>
                                    
                                    <!-- <div class="col-xs-9 noleft" name="address_type" id="address_type">
                                        <select>
                                            <option>Residentail</option>
                                            <option>Commercial</option>
                                        </select>
                                    </div> -->
                                </div>
                                <div class="boxs">
                                    <div class="col-xs-3">
                                        <p>Phone:</p>
                                    </div>
                                    <div class="col-xs-9 noleft">
                                        <input type="text" class="form-control" name="shipping_phone" id="shipping_phone" <?php if(!empty($shippingAddress['phone'])) {?> value="<?php echo $shippingAddress['phone']; }  ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="last boxs">
                        <a href="javascript:void(0)">Are delivery times guaranteed? When will my package arrive?</a>
                        <a href="javascript:void(0)">Can I pick up my order from your location?</a>
                        <a href="javascript:void(0)">Can you estimate FedEx Ground shipping times?</a>
                    </div>
                </div>
                <div class="bottom_p boxs">
                    <a href="<?php echo base_url('konfigurator/summary'); ?>" class="back">Back</a>
                    <a href="<?php echo base_url('konfigurator/doEditAddress'); ?>" id="order-continue" class="continue">Continue to Payment</a>
                </div>
            </div>
        <?php } ?>
            </form>
        </div>
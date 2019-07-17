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
                <li><a href="javascript:vod(0)">ORDER</a></li>
            </ul>
        </div>
        <div class="glass_top boxs">
            <a href="<?php echo base_url('konfigurator/surface-treatment'); ?>" class="back">Back</a>
            <a href="<?php echo base_url('konfigurator/doAddAddress'); ?>" id="summary-continue" class="continue">Continue</a>
        </div>

        <div class="products_inner boxs">
            <div class="summary boxs">
                <!--  <div class="container"></div> -->
                <h1>Order Summary</h1>

                <div class="cart_items">
                    <h5><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php $qty = 0; if(!empty($productqty)) { foreach($productqty as $cartdata){ ?>
                        <span class="displayinline"><?php  $qty = $qty + $cartdata['productqty']['qty']; } echo $qty; } else { echo '0'; } ?> Items</span>
                    </h5>
                </div>
                <?php
                if (!empty($allUserdata)) {    
                    $r = 1;
                    foreach ($allUserdata as $userdata) { 
                        ?>

                        <table>
                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Dimension</th>
                                <th>*Qty.</th>
                            </tr>

                            <tr>
                                <td><?php echo $r; ?></td>
                                <td>

                                    <?php if ($userdata['glass_type']['image_url']) { ?><span class="text-center"><img src="<?php echo base_url(); ?>uploads/type/<?php echo $userdata['glass_type']['image_url']; ?>" alt="Items Missing here" class="img-thumbnail"></span><?php } ?>
                                    <?php if ($userdata['glass_type']['name']) { ?><span class="text-center"> <strong><?php echo $userdata['glass_type']['name']; ?></strong></span><?php } ?>
                                    <?php if ($userdata['shape_data']['name']) { ?><span><strong>Shape: </strong><?php echo $userdata['shape_data']['name']; ?></span><?php } ?>
                                    <?php if ($userdata['thickness']['thickness']) { ?><span><strong>Thickness: </strong><?php echo $userdata['thickness']['thickness']; ?></span><?php } ?>
                                    <?php if ($userdata['material']['material_name']) { ?><span><strong>Material Name: </strong><?php echo $userdata['material']['material_name']; ?></span><?php } ?>
                                    <?php if ($userdata['edge']['type']) { ?><span><strong>Edge Type:</strong> <?php echo $userdata['edge']['type']; ?></span><?php } ?>
                                    <?php if ($userdata['edge_element']['edge_element_name']) { ?><span><strong>Edge Element:</strong><?php echo $userdata['edge_element']['edge_element_name']; ?></span><?php } ?>
                                    <?php if ($userdata['edge_type']['edge_type_value']) { ?><span><strong>Edge Type Value: </strong><?php echo $userdata['edge_type']['edge_type_value']; ?></span><?php } ?>
                                    <?php if ($userdata['surface_treatment']['type']) { ?><span><strong>Surface Treatment: </strong><?php echo $userdata['surface_treatment']['type']; ?></span><?php } ?>
                                    <div class="boxs">
<!--                                        <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>public/image/icon/icon_edit.png" class="img-responsive" alt="icon_edit">Edit</a>
                                        <a href="javascript:void(0)"><img src="<?php echo base_url(); ?>public/image/icon/icon_note.png" class="img-responsive" alt="icon_note">Copy</a>-->
                                        <a href="<?php echo base_url('konfigurator/updateCartData/'.$row_id.'/'.$userdata['user']['user_id']);?>"><img src="<?php echo base_url(); ?>public/image/icon/trash_can.gif" class="img-responsive" alt="trash_can" id="delete_item">Delete</a>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($userdata['user']['dimension_id'])) {
                                        $term_size = explode(',', $userdata['user']['term_size']);
                                        $i = 0;
                                        foreach ($userdata['dimension_mapping'] as $tdm) {
                                            echo $tdm['term'] . " (" . $tdm['prefix'] . '): ' . $term_size[$i] . '<br>';
                                            $i++;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    
                                    <select name="qty" id="qty" data-url="<?php echo base_url('konfigurator/updateCartData/'.$row_id.'/'.$userdata['user']['user_id']);?>" >
                                        <?php                                
                                        if(!empty($productqty)) { foreach($productqty as $cartdata){    
                                            if($userdata['user']['user_id'] === $cartdata['productqty']['user_id']) {
                                        ?>
                                        <option <?php if($cartdata['productqty']['qty'] == 1 ) { echo "selected";} ?> value="1">1</option>
                                        <option <?php if($cartdata['productqty']['qty'] == 2 ) { echo "selected";} ?> value="2">2</option>
                                        <option <?php if($cartdata['productqty']['qty'] == 3 ) { echo "selected";} ?> value="3">3</option>
                                        <option <?php if($cartdata['productqty']['qty'] == 4 ) { echo "selected";} ?> value="4">4</option>
                                        <option <?php if($cartdata['productqty']['qty'] == 5 ) { echo "selected";} ?> value="5">5</option>
                                        <option <?php if($cartdata['productqty']['qty'] == 6 ) { echo "selected";} ?> value="6">6</option>
                                        <option <?php if($cartdata['productqty']['qty'] == 7 ) { echo "selected";} ?> value="7">7</option>
                                        <option <?php if($cartdata['productqty']['qty'] == 8 ) { echo "selected";} ?> value="8">8</option>
                                        <option <?php if($cartdata['productqty']['qty'] == 9 ) { echo "selected";} ?> value="9">9</option>
                                        <option <?php if($cartdata['productqty']['qty'] == 10 ) { echo "selected";} ?> value="10">10</option>
                                        <?php  } } } ?>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <?php
                        $sr = 1;
                        if (!empty($productCalculation)) {
                            foreach ($productCalculation as $calculation) {
                                if ($sr == $r) {
                                    ?>
                                    <div class="calculate boxs">
                                        <div class="calculateShapeDimention">
                                            <h4>Calculate Details.</h4>
                                            <?php if ($calculation['materialThickCost']) { ?><span style="padding: 10px;"><?php echo "Material Thickness Cost : " . $calculation['materialThickCost']; ?></span><br><?php } ?>
                                            <?php if ($calculation['shapeDimension']) { ?><span style="padding: 10px;"><?php echo "Shape of Dimention : " . $calculation['shapeDimension']; ?></span><br><?php } ?>
                                            <?php if ($calculation['edgeProcessing']) { ?><span style="padding: 10px;"><?php echo "Adge processing Cost : " . $calculation['edgeProcessing']; ?></span><br><?php } ?>
                                            <?php if ($calculation['surfaceTreatment']) { ?><span style="padding: 10px;"><?php echo "Suraface Treatment Cost : " . $calculation['surfaceTreatment']; ?></span><br><?php } ?>
                                        </div>
                                    </div>
                                <?php } $sr++;
                            }
                        } ?>
                        <?php
                        $r++;
                    }
                }
                ?>
                <?php if(!empty($productqty)) {  ?>
                    <div class="calculate boxs">
                        <div id="cal_ShippingCost" >
                            <h4>Shipping Cost Details.</h4>
                            <span style="padding: 10px;"><b>Product Price : </b>
                            
                            <?php $p = 1;$price=0;
                                foreach($productqty as $cartdata){ 
                                    if($p === 1){
                                         
                                         $price = $price + $cartdata['productqty']['qty'] * str_replace(',00 €','', $cartdata['productqty']['price']);
                                         echo $cartdata['productqty']['qty']." * ".$cartdata['productqty']['price'];
                                    }
                                    else{
                                         $price = $price + $cartdata['productqty']['qty'] * str_replace(',00 €','', $cartdata['productqty']['price']);
                                         echo ' + '.$cartdata['productqty']['qty']." * ".$cartdata['productqty']['price'];
                                    } $p++;
                                }  
                                //$price = $price1+$price2;
                                
                            ?> 
                            </span>
                            <?php if(!empty($price)){ ?><span style="padding: 10px;"><br><?php echo "<b>Total price : </b>".$price.",00 €";?></span><?php } ?>
                        </div>
                    </div>
                <?php  } ?>
                <div class="calculate boxs">
                    <h4>Enter your Zip/Postal Code to calculate the price.</h4>
                    <form name="zip_postal_form" id="zip_postal_form" method="post" acction="<?php echo base_url('konfigurator/doAddAddress'); ?>">
                        <ul>
                            <li>Country
                                <input type="text" name="country" name="country" <?php if (!empty($address['country'])) { ?> value="<?php echo $address['country'];} ?>">
                                <span class="country"></span>
                            </li>
                            <li>Zip/Postal Code:
                                <input type="text" name="zip_code" name="zip_code" <?php if (!empty($address['zip'])) { ?> value="<?php echo $address['zip'];} ?>">
                                <span class="zip_code"></span>
                            </li>
                            <li>Address Type:
                                <input type="text" name="address_type" name="address_type" <?php if (!empty($address['address_type'])) { ?> value="<?php echo $address['address_type'];} ?>">
                                <span class="address_type"></span>
                            </li>
                            <li>&nbsp;<button name="calculate_total" id="calculate_total">Calculate Total</button>
                            </li>
                        </ul>
                    </form>
                </div>

                <div class="carts boxs">
                    <a href="<?php echo base_url('konfigurator/deleteCartItem/'); ?>" id="deleteCart" value="<?php echo $this->session->userdata('session_id'); ?>">Clear Cart</a>
                    <a href="javascript:void(0)">Print</a>
                    <div class="carts_right boxs">
                        <a href="javascript:void(0)">Save/Email Quote</a>
                        <a href="<?php echo base_url('konfigurator/addMoreItems'); ?>" class="add_more">Add More Items</a>
                        <?php if (!empty($this->session->userdata('client_id'))) { ?>
                            <a href="<?php echo base_url('konfigurator/doAddAddress'); ?>" class="checkout" id="summary-continue">Proceed to Checkout</a>
                        <?php } else { ?>
                            <a href="#" data-toggle="modal" class="checkout" id="summarycontinue">Proceed to Checkout</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="about_last boxs">
                    <a href="javascript:void(0)">Are delivery times guaranteed? When will my package arrive?</a>
                    <a href="javascript:void(0)">What does the shipping and handling include?</a>
                    <a href="javascript:void(0)">2018 Holiday Shipping Information</a>
                    <a href="javascript:void(0)">Should I select "Signature Required"?</a>
                </div>
            </div>
        </div>

        <div class="bottom_p boxs">
            <a href="<?php echo base_url('konfigurator/surface-treatment'); ?>" class="back">Back</a>
            <a href="<?php echo base_url('konfigurator/doAddAddress'); ?>" id="summary-continue" class="continue">Continue</a>
        </div>
    </div>
</div>

<!--product page end-->

<!-- Login Modal -->
<div class="modal fade loginmodel" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><img src="<?php echo base_url('public/image/user/MGNM.png'); ?>" alt="close"></center>

            </div>
            <div class="modal-body">
                <form >
                    <div class="form-group loginbtndiv">
                        <a href="#" class="btn btn-primary btn-md loginbtn"  id="loginuserbtn">Login</a>
                    </div>
                    <div class="form-group registerbtndiv">
                        <a href= "#" class="btn btn-primary btn-md registerbtn"  id="registeruserbtn">Register</a>
                    </div>
                    <!--<button type="submit" class="btn btn-success">Continue</button>-->
                </form>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>

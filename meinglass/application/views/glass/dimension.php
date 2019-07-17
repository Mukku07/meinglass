<div class="dimension_outer boxs">
    <div class="container">
        <div class="product_headings boxs">
            <ul>
                <li><a href="javascript:vod(0)" class="active">SHAPE</a></li>
                <li><a href="javascript:vod(0)" class="active">DIMENSIONS</a></li>
                <li><a href="javascript:vod(0)">TYPE</a></li>
                <li><a href="javascript:vod(0)">THICKNESS</a></li>
                <li><a href="javascript:vod(0)">EDGEWORK</a></li>
                <li><a href="javascript:vod(0)">SURFACE TREATMENT</a></li>
                <li><a href="javascript:vod(0)">SUMMARY</a></li>
                <li><a href="javascript:vod(0)">ORDER</a></li>
            </ul>
        </div>
        <div class="glass_top boxs">
            <h1 class="heading_top">Dimensions</h1>
            <a href="<?php echo base_url('konfigurator/shape'); ?>" class="back">Back</a>
            <a href="<?php echo base_url('konfigurator/dimensionCal'); ?>" id="dimension-continue" class="continue">Continue</a>
        </div>
        <div class="dimensions_inner boxs">
            <input type="hidden" name="dimension_id" value="<?php echo $dimension['dimension_id']; ?>" id="dimension_id"/>
            <p><?php echo $dimension['description']; ?></p>
            <div class="size boxs">
                <div class="col-sm-6 col-xs-6">
                    <img src="<?php echo base_url('uploads/dimension/' . $dimension['image_url']); ?>" class="img-responsive" alt="<?php echo $dimension['image_url']; ?>">
                </div>
                <div class="col-sm-6 col-xs-6">
                    <h4><?php echo $shape['name']; ?></h4>
                    <img src="<?php echo base_url('uploads/shape/' . $shape['image_url']); ?>" class="img-responsive" alt="<?php echo $shape['image_url']; ?>">
                </div>
            </div>
            <?php
            if (!empty($dimension['special_note'])) {
                echo '<p><b>Special Note:</b> ' . $dimension['special_note'] . '</p>';
            }
            ?>
            <h5>Note: Dimensions must be provided in mm.</h5>
            <h2><i>Cutting Tolerance is +/- 1/16</i></h2>
            <div class="row">
                <div class="col-md-3">
                    <table>
                        
                        <tr>
                            <th></th>
                            <th>Mm</th>
                        </tr>
                        <?php
                        if (!empty($user['term_size'])) {
                            if ($user['dimension_id'] == $dimension['dimension_id']) {
                                $term_size = explode(',', $user['term_size']);
                               
                            }
                        }
                        $t = 0;
                        foreach ($mappings as $mapping) {
                      ?>
                        <tr>
                                <td><?php echo $terms[$mapping['term_id']] . ' (' . $mapping['prefix'] . '):'; ?></td>
                                <td>
                                  <?php  echo form_input(['name'=>'term_size[]','required'=>'required','class'=>'form-control term_size','type'=>'number','min'=>0, 'style'=>'width: 100px'],isset($term_size[$t])? $term_size[$t]:''); ?>
                                </td>
                        </tr>    
                    <?php
                    $t++;
                }
                ?>
                    
                    </table>
                    <div class="errormsg text-danger"></div>
                </div>
			<?php
			if ($dimension['is_corner'] == '1') {
				if (!empty($user['corner'])) {
					if ($user['dimension_id'] == $dimension['dimension_id']) {
						$user_corner = explode(',', $user['corner']);
					}
				}
				?>
                    <div class="col-md-9">
                        <h3>Select the corner type</h3>
                        <div class="row">
                                <?php
                                $c = 0;
                                foreach ($dimension_corners as $corn) {
                                    if (!empty($user_corner)) {
                                        $corner = $corners[$user_corner[$c]];
                                    }
                                    ?>
                                <div class="col-md-3">
                                    <?php echo '<b>' . $corn['corner_name'] . '</b>'; ?>
                                    <?php echo form_dropdown(['name' => 'corner[]', 'id' => 'corner', 'class' => 'form-control corner'], $corners, isset($user_corner[$c]) ? $user_corner[$c] : ''); ?>
                                </div>
                            <?php
                            $c++;
                        }
                        ?>
                        </div>
                    </div>
            <?php } ?>
            </div>
        </div>
        <div class="bottom_p boxs">
            <a href="<?php echo base_url('konfigurator/shape'); ?>" class="back">Back</a>
            <a href="<?php echo base_url('konfigurator/dimensionCal'); ?>" id="dimension-continue" class="continue">Continue</a>
        </div>
    </div>
</div>

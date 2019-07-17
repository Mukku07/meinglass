<div class="sq_r boxs">
    <div class="size boxs">
        <div class="col-sm-8 nopadding">
            <div class="thickness inches boxs">
                <ul>
                    <?php if(!empty($thickness)){
                        $i=1;
                        foreach ($thickness as $thicknes){
                    ?>
                    <li>
                        <label for="<?php echo $thicknes['thickness_id']; ?>"><?php echo $thicknes['thickness']; ?>mm</label>
                        <input name="thickness" type="radio" value="<?php echo $thicknes['thickness_id']; ?>" id="<?php echo $thicknes['thickness_id']; ?>" <?php if(!empty($user['thickness_id'])){ if($user['thickness_id']==$thicknes['thickness_id']){ echo 'checked'; }}else { if($i==1){ echo 'checked'; } } ?>></li>
                    <?php
                    $i++;
                        }
                    } ?>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
    <a href="#" class="thick_weight">How much weight can my glass handle? </a>
</div>
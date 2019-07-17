<div class="products boxs">
    <div class="container">
        <div class="product_headings boxs">
            <ul>
                <li><a href="javascript:vod(0)" class="active">SHAPE</a></li>
                <li><a href="javascript:vod(0)" class="active">DIMENSIONS</a></li>
                <li><a href="javascript:vod(0)" class="active">TYPE</a></li>
                <li><a href="javascript:vod(0)" class="active">THICKNESS</a></li>
                <li><a href="javascript:vod(0)">EDGEWORK</a></li>
                <li><a href="javascript:vod(0)">SURFACE TREATMENT</a></li>
                <li><a href="javascript:vod(0)">SUMMARY</a></li>
                <li><a href="javascript:vod(0)">ORDER</a></li>
            </ul>
        </div>
        <div class="glass_top boxs">
            <h1 class="heading_top">Thickness</h1>
            <a href="<?php echo base_url('konfigurator/glass-type'); ?>" class="back">Back</a>
            <a href="<?php echo base_url('konfigurator/thicknessCal'); ?>" id="thickness-continue" class="continue">Continue</a>
        </div>
        <div class="products_inner boxs">
            <h5>How thick is the piece of glass that you need? (Note that the graphics are representations only not the
                actual thickness of glass.)</h5>
            <div class="col-sm-3 noleft">
                <label for="material">Select Material</label>
                <?php echo form_dropdown(['name' => 'material', 'id' => 'material', 'class' => 'form-control', 'data-url' => base_url('konfigurator/getThickness')], $material,isset($user['material_id'])?$user['material_id']:''); ?>
            </div>
        </div>
        <div id="thickness-wrapper"></div>
        <div class="bottom_p boxs">
            <a href="<?php echo base_url('konfigurator/glass-type'); ?>" class="back">Back</a>
            <a href="<?php echo base_url('konfigurator/thicknessCal'); ?>" id="thickness-continue" class="continue">Continue</a>
        </div>
    </div>
</div>

<!--product page end-->
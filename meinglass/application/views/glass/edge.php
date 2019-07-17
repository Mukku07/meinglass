<div class="products boxs">
    <div class="container">
        <div class="product_headings boxs">
            <ul>
                <li><a href="javascript:vod(0)" class="active">SHAPE</a></li>
                <li><a href="javascript:vod(0)" class="active">DIMENSIONS</a></li>
                <li><a href="javascript:vod(0)" class="active">TYPE</a></li>
                <li><a href="javascript:vod(0)" class="active">THICKNESS</a></li>
                <li><a href="javascript:vod(0)" class="active">EDGEWORK</a></li>
                <li><a href="javascript:vod(0)">SURFACE TREATMENT</a></li>
                <li><a href="javascript:vod(0)">SUMMARY</a></li>
                <li><a href="javascript:vod(0)">ORDER</a></li>
            </ul>
        </div>
        <div class="glass_top boxs">
            <h1 class="heading_top">Edge Work</h1>
            <a href="<?php echo base_url('konfigurator/thickness'); ?>" class="back">Back</a>
            <a href="<?php echo base_url('konfigurator/edgeCal'); ?>" id="edge-continue" class="continue">Continue</a>
        </div>
        <div class="products_inner boxs">
            <div class="col-sm-3 noleft">
                <label for="edge">Select Edge</label>
                <?php echo form_dropdown(['name' => 'edge', 'id' => 'edge', 'class' => 'form-control', 'data-url' => base_url('konfigurator/getEdgeType')], $edge, isset($user['edge_id']) ? $user['edge_id'] : ''); ?>
            </div>
        </div>
        <div id="edge-wrapper"></div>

        <div class="bottom_p boxs">
            <a href="<?php echo base_url('konfigurator/thickness'); ?>" class="back">Back</a>
            <a href="<?php echo base_url('konfigurator/edgeCal'); ?>" id="edge-continue" class="continue">Continue</a>
        </div>
    </div>
</div>

<!--product page end-->
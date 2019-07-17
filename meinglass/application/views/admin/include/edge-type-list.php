<div class="sq_r boxs">
    <div class="size boxs form-group">
        <div class="col-sm-3 nopadding">
            <?php if (!empty($edge_element)) {
                ?>
                <label for="edge_element_id">Select Edge Element</label>
                <?php echo form_dropdown(['name' => 'edge_element_id', 'id' => 'edge_element_id', 'class' => 'form-control'], $edge_element, isset($products['edge_element_id']) ? $products['edge_element_id'] : '') ?>
                <?php }
            ?>
        </div>
    </div>
    <div class="size boxs">
        <div class="col-sm-3 nopadding">
            <?php if (!empty($edge_type)) {
                ?>
                <label for="edge_type">Select Edge Type</label>
                <?php echo form_dropdown(['name' => 'edge_type', 'id' => 'edge_type', 'class' => 'form-control'], $edge_type, isset($products['edge_type_id']) ? $products['edge_type_id'] : '') ?>
                <?php }
            ?>
        </div>
    </div>
</div>
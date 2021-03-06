﻿
<div class="modal-content">
    <?php echo $this->getContent(); ?>
    <?php echo $this->tag->form("theme_creator/widget_create_copy/".$id) ?>
    <div class="modal-header">
        <h4 id="myModalLabel" class="semi-bold">Create New Widget.</h4>
        <p class="no-margin">Please provide all the required information. </p>
    </div>
    <div class="modal-body">
        <div class="row form-row">
            <div class="col-md-6">
                <label class="form-label">Widget Name</label>
                <?php echo $this->tag->textField(array("name", "class" => "form-control")) ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Target Theme</label>
                <select name="theme_id" class="form-control">
                    <?php foreach ($themes as $theme) { ?>
                    <option value="<?php echo $this->escaper->escapeHtml($theme->id); ?>"><?php echo $this->escaper->escapeHtml($theme->name); ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-blue">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <?php echo $this->tag->submitButton(array("Save","class"=>"btn btn-dark")) ?>
    </div>
    </form>
</div>

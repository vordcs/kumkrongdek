<div class="row">
    <div class="page-header">
        <h1>
            <?= $title ?>
        </h1>
    </div>
</div>
<div class="row content" > 
    <?php echo $form['form']; ?>
    <div class="form-group <?= (form_error('kindness_title')) ? 'has-error' : '' ?>">
        <label class="col-sm-3 control-label">ชื่อเรื่องหลัก</label>
        <div class="col-sm-5">
            <?php echo $form['kindness_title']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('kindness_title', '<font color="error">', '</font>'); ?>
        </div>
    </div> 
    <div class="form-group <?= (form_error('kindness_content')) ? 'has-error' : '' ?>">
        <label class="col-sm-3 control-label">เนื่อหา</label>
        <div class="col-sm-5">
            <?php echo $form['kindness_content']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('kindness_content', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <div class="form-group <?= (form_error('kindness_img')) ? 'has-error' : '' ?>">
        <label class="col-sm-3 control-label">รูปภาพ</label>
        <div class="col-sm-5">
            <?php echo $form['kindness_img']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('kindness_img', '<font color="error">', '</font>'); ?>
        </div>
    </div>

    <div class="form-group <?= (form_error('kindness_highlight')) ? 'has-error' : '' ?>">
        <label class="col-sm-3 control-label">ความสำคัญ</label>
        <div class="col-sm-4">
            <?php echo $form['kindness_highlight']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('kindness_highlight', '<font color="error">', '</font>'); ?>
        </div>
    </div>

    <div class="form-group <?= (form_error('kindness_status')) ? 'has-error' : '' ?>">
        <label class="col-sm-3 control-label">สถานะ</label>
        <div class="col-sm-4">
            <?php echo $form['kindness_status']; ?>                 
        </div>        
        <div class="col-sm-4" id="error">                
            <?php echo form_error('kindness_status', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <div class="form-group <?= (form_error('publish_date')) ? 'has-error' : '' ?>">
        <label class="col-sm-3 control-label">วันเผยแพร่</label>
        <div class="col-sm-3">
            <?php echo $form['publish_date']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('publish_date', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <hr>
    <div class="form-group">            
        <div class="text-center">
            <input type="submit" class="btn btn-success btn-lg" name="save" value="บันทึก" >
            <?= anchor('Kindness_ad', 'ยกเลิก', 'class="btn btn-danger btn-lg"'); ?>   
        </div>
    </div>

    <?= form_close() ?>
</div>

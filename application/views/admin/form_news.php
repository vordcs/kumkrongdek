<div class="row">
    <div class="page-header">
        <h1>
            <?= $title ?>
        </h1>
    </div>
</div>
<div class="row content" > 
    <?php echo $form['form']; ?>
    <div class="form-group <?= (form_error('news_title')) ? 'has-error' : 'news_title' ?>">
            <label class="col-sm-3 control-label">ชื่อเรื่องหลัก</label>
            <div class="col-sm-5">
                <?php echo $form['news_title']; ?>                 
            </div>
            <div class="col-sm-4" id="error">                
                <?php echo form_error('news_title', '<font color="error">', '</font>'); ?>
            </div>
        </div>
    
    <div class="form-group <?= (form_error('')) ? 'has-error' : 'news_content' ?>">
            <label class="col-sm-3 control-label">เนื้อหา</label>
            <div class="col-sm-5">
                <?php echo $form['news_content']; ?>                 
            </div>
            <div class="col-sm-4" id="error">                
                <?php echo form_error('news_content', '<font color="error">', '</font>'); ?>
            </div>
        </div>
    
    <div class="form-group <?= (form_error('news_img')) ? 'has-error' : 'news_img' ?>">
            <label class="col-sm-3 control-label">รูปภาพ</label>
            <div class="col-sm-4">
                <?php echo $form['news_img']; ?>                 
            </div>
            <div class="col-sm-4" id="error">                
                <?php echo form_error('news_img', '<font color="error">', '</font>'); ?>
            </div>
        </div>
    
    
      <div class="form-group <?= (form_error('news_highlight')) ? 'has-error' : 'news_highlight' ?>">
            <label class="col-sm-3 control-label">ความสำคัญ</label>
            <div class="col-sm-4">
                <?php echo $form['news_highlight']; ?>                 
            </div>
            <div class="col-sm-4" id="error">                
                <?php echo form_error('news_highlight', '<font color="error">', '</font>'); ?>
            </div>
        </div>
    
    <div class="form-group <?= (form_error('news_status')) ? 'has-error' : 'news_status' ?>">
            <label class="col-sm-3 control-label">สถานะ</label>
            <div class="col-sm-4">
                <?php echo $form['news_status']; ?>                 
            </div>
            <div class="col-sm-4" id="error">                
                <?php echo form_error('news_status', '<font color="error">', '</font>'); ?>
            </div>
        </div>
    
    <div class="form-group <?= (form_error('public_date')) ? 'has-error' : 'public_date' ?>">
            <label class="col-sm-3 control-label">วันเผยแพร่</label>
            <div class="col-sm-3">
                <?php echo $form['public_date']; ?>                 
            </div>
            <div class="col-sm-4" id="error">                
                <?php echo form_error('public_date', '<font color="error">', '</font>'); ?>
            </div>
        </div>
    
     <div class="form-group">            
        <div class="text-center">
            <input type="submit" class="btn btn-success btn-lg" name="save" value="บันทึก" >
            <?= anchor('News_ad', 'ยกเลิก', 'class="btn btn-danger btn-lg"'); ?>   
        </div>
    </div> 
    
    <?= form_close() ?>
</div>
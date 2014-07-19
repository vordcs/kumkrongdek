<div class="row">
    <div class="col-lg-12">
        <h1><?= $title ?></h1>
    </div>
</div>
<div class="row content">
    <form class="form-horizontal" role="form">  
        <div class="form-group <?= (form_error('activity_title')) ? 'has-error' : '' ?>" id="img_add">
            <label class="col-sm-3 control-label">ชื่อเรื่องกิจกรรม</label>
            <div class="col-sm-4">
                <?php echo $form['activity_title']; ?>                 
            </div>
            <div class="col-sm-4" id="error">                
                <?php echo form_error('activity_title', '<font color="error">', '</font>'); ?>
            </div>
        </div>
        <div class="form-group <?= (form_error('activity_content')) ? 'has-error' : '' ?>" id="img_add">
            <label class="col-sm-3 control-label">รายละเอียด</label>
            <div class="col-sm-4">
                <?php echo $form['activity_content']; ?>                 
            </div>
            <div class="col-sm-4" id="error">                
                <?php echo form_error('activity_content', '<font color="error">', '</font>'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-3 control-label">ประเภทกิจกรรม</label>
            <div class="col-sm-3">
                <?= $form['activity_type'] ?>
                <!--<input type="text" class="form-control" id="" placeholder="">-->
            </div>
        </div>
        <div class="form-group <?= (form_error('activity_img')) ? 'has-error' : '' ?>" id="img_add">
            <label class="col-sm-3 control-label">รูปภาพ</label>
            <div class="col-sm-4">
                <?php echo $form['activity_img']; ?>                 
            </div>
            <div class="col-sm-4" id="error">                
                <?php echo form_error('activity_img', '<font color="error">', '</font>'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-3 control-label">ความสำคัญ</label>
            <div class="col-sm-3">
                <?= $form['actity_highlight'] ?>
                <!--<input type="text" class="form-control" id="" placeholder="">-->
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-3 control-label">สถานะ</label>
            <div class="col-sm-3">
                <?= $form['actity_status'] ?>
                <!--<input type="text" class="form-control" id="" placeholder="">-->
            </div>
        </div>
        <hr>
        <div class="form-group">            
            <div class="text-center">
                <input type="submit" class="btn btn-success btn-lg" name="save" value="บันทึก" >
                <?= anchor('Journals', 'ยกเลิก', 'class="btn btn-danger btn-lg"'); ?>   
            </div>
        </div>
        <?= form_close() ?>  

    </form>
</div>


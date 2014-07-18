<div class="row">
    <div class="page-header">
        <h1>
            <?= $title ?>
        </h1>
    </div>
</div>
<div class="row content" >   
    <?= $form['form'] ?>   
    <div class="form-group<?= (form_error('journal_year')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">ปีที่</label>
        <div class="col-sm-2">
            <?= $form['journal_year'] ?>
            <!--<input type="text" class="form-control" id="" placeholder="">-->
        </div>
    </div>
    <div class="form-group<?= (form_error('journal_issue')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">ฉบับที่</label>
        <div class="col-sm-2">
            <?= $form['journal_issue'] ?>
            <!--<input type="text" class="form-control" id="" placeholder="">-->
        </div>
    </div>
    <div class="form-group<?= (form_error('publish_date')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">ประจำเดือน</label>
        <div class="col-sm-4">
            <?= $form['publish_date'] ?>
            <!--<input type="text" class="form-control" id="date" placeholder="">-->
        </div>
    </div>
    <div class="form-group<?= (form_error('adviser')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label"></label>
        <div class="col-sm-4">
            <?= $form['adviser'] ?>
            <!--<input type="text" class="form-control" placeholder="">-->
        </div>
    </div>
    <div class="form-group<?= (form_error('editor')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label"></label>
        <div class="col-sm-4">
            <?= $form['editor'] ?>
            <!--<input type="text" class="form-control" placeholder="">-->
        </div>
    </div>
    <div class="form-group<?= (form_error('prepared_by')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label"></label>
        <div class="col-sm-4">
            <?= $form['prepared_by'] ?>
            <!--<input type="text" class="form-control" placeholder="">-->
        </div>
    </div>

    <div class="form-group<?= (form_error('journal_file')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">เอกสาร</label>
        <div class="col-sm-4">
            <?= $form['journal_file'] ?>
            <span class="help-block">เฉพาะไฟล์ .pdf เท่านั่น</span>
            <!--<input type='text' class="form-control"/>-->                    
        </div>
    </div>

    <div class="form-group">
        <label for="" class="col-sm-4 control-label">ความสำคัญ</label>
        <div class="col-sm-3">
            <?= $form['journals_highlight'] ?>
            <!--<input type="text" class="form-control" id="" placeholder="">-->
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-4 control-label">สถานะ</label>
        <div class="col-sm-3">
            <?= $form['journal_status'] ?>
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
</div>
<script>
    $(document).ready(function() {
        $('#publish_date').datepicker({
            language: 'th-th',
            format: ' MM yyyy'
        });

    });
</script>  

<div class="row">
    <div class="page-header">
        <h1>
            <?= $title ?>
        </h1>
    </div>
</div>

<div class="row content" >   
    <?= $form['form'] ?>   
    <div class="form-group<?= (form_error('journal_year_no')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">ปีที่</label>
        <div class="col-sm-2">
            <?= $form['journal_year_no'] ?>
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

    <div class="form-group<?= (form_error('journal_mounth')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">ประจำเดือน</label>
        <div class="col-sm-8">
            <div class="col-sm-3">
                <?= $form['journal_mounth'] ?>
            </div>            
            <div class="col-sm-3">               
                <div class="input-group">
                    <div class="input-group-addon">ปี</div>
                    <?= $form['journal_year'] ?>
                </div>

            </div>

<!--<input type="text" class="form-control" id="date" placeholder="">-->
        </div>
    </div>
    <div class="form-group<?= (form_error('adviser')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">ที่ปรึกษา</label>
        <div class="col-sm-4">
            <?= $form['adviser'] ?>
            <!--<input type="text" class="form-control" placeholder="">-->
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('adviser', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <div class="form-group<?= (form_error('editor')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">บรรณาธิการ</label>
        <div class="col-sm-4">
            <?= $form['editor'] ?>
            <!--<input type="text" class="form-control" placeholder="">-->
        </div>
    </div>
    <div class="form-group<?= (form_error('prepared_by')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">ผู้จัดทำ</label>
        <div class="col-sm-4">
            <?= $form['prepared_by'] ?>
            <!--<input type="text" class="form-control" placeholder="">-->
        </div>
    </div>

    <div id="file_add" class="form-group<?= (form_error('journal_file')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">เอกสาร</label>
        <div class="col-sm-4">
            <!--<? $form['journal_file'] ?>-->
            <input type="file" name="journal_file" size="20" />
            <span class="help-block">เฉพาะไฟล์ .pdf เท่านั่น</span>
            <!--<input type='text' class="form-control"/>-->                    
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('journal_file', '<font color="error">', '</font>'); ?>
        </div>
    </div> 
    
    <div class="form-group <?= (form_error('publish_date')) ? ' has-error' : '' ?>">
        <label for="" class="col-sm-4 control-label">วันเผยเเพร่</label>
        <div class="col-sm-4">
            <?= $form['publish_date'] ?>
            <!--<input type="text" class="form-control" id="date" placeholder="">-->
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('publish_date', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    

    <div class="form-group">
        <label for="" class="col-sm-4 control-label">ความสำคัญ</label>
        <div class="col-sm-4">
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
    <div id="file_show" class="row" style="margin-bottom: 5%">    
        <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
                <h3>
                    เอกสาร  
                    <p class="pull-right">
                        <button id="del_file" class="btn btn-danger btn-circle"><i class="fa fa-times fa-lg"></i></button>
                    </p>               
                </h3>

            </div>

            <div id="pdf" class="row">
            </div>
        </div>        
    </div>
</div>

<script>
    $(document).ready(function() {

  

        var file = '<?= $form['file'] ?>';
        if (file != '') {
            $('#file_add').hide();
            var success = new PDFObject({url: "<?= upload_url() ?>" + file}).embed("pdf");
        } else {
            $('#file_show').hide(true);
        }
        $("#del_file").click(function() {
//            alert("delete");
            $('#file_add').show();
            $('#file_show').hide(true);
        });

        bkLib.onDomLoaded(function() {
            new nicEditor({buttonList: ['ol', 'ul', 'html']}).panelInstance('adviser');
        });

    });
</script>  

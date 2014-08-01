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
    <div class="form-group <?= (form_error('kindness_subtitle')) ? 'has-error' : '' ?>">
        <label class="col-sm-3 control-label">ชื่อเรื่องรอง</label>
        <div class="col-sm-5">
            <?php echo $form['kindness_subtitle']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('kindness_title', '<font color="error">', '</font>'); ?>
        </div>
    </div> 
    <div class="form-group <?= (form_error('kindness_content')) ? 'has-error' : '' ?>">
        <label class="col-sm-3 control-label">เนื่อหา</label>
        <div class="col-sm-6">
            <?php echo $form['kindness_content']; ?>                 
        </div>
        <div class="col-sm-3" id="error">                
            <?php echo form_error('kindness_content', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <div class="form-group <?= (form_error('kindness_img')) ? 'has-error' : '' ?>" id="img_add">
        <label class="col-sm-3 control-label">รูปภาพ</label>
        <div class="col-sm-5">
            <?php echo $form['kindness_img']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('kindness_img', '<font color="error">', '</font>'); ?>
        </div>
    </div>

    <div class="form-group" id="img_show">
        <label class="col-sm-3 control-label">รูปภาพ</label>        
        <div class="col-sm-4">
            <div class="pull-right">                     
                <button type="button" class="btn btn-outline btn-circle btn-danger btn-xs" id="del_img" ><i class="fa fa-times fa-lg" ></i></button>                             
            </div>
            <?= img($form['image'], array('class' => 'img-responsive thumbnail', 'width' => '200px', 'height' => '200px')) ?>                
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
    <div class="form-group hidden">
        <label class="col-sm-3 control-label">
            รูปภาพอื่นๆ
        </label>
        <div class="col-sm-9" id="file">
            <div id="r"></div>
            <div class="row" id="row_file" >               
                <div class="col-sm-3" >
                    <input type="file" name="file[]" accept="image/gif,image/png,image/jpeg,image/jpg">
                </div>
            </div>
        </div>        
    </div>
    <div class="form-group hidden">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-6">
            <div class="col-sm-10 col-sm-offset-1" >
                <button class="btn btn-default icon" type="button" onclick="JavaScript:addInputFile()">
                    <i class="fa fa-plus fa-lg"></i>
                </button>
                <button class="btn btn-default" type="button" onclick="JavaScript:delInputFile()">
                    <i class="fa fa-minus fa-lg"></i> 
                </button>
            </div>
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
<script>
    $(document).ready(function() {

        //<![CDATA[
        bkLib.onDomLoaded(function() {
            new nicEditor().panelInstance('content');
        });



        var img = '<?= $form['image'] ?>';
        if (img != '') {
            $('#img_add').hide();
        } else {
            $('#img_show').hide(true);
        }
        $("#del_img").click(function() {
//            alert("delete");
            $('#img_add').show();
            $('#img_show').hide(true);
        });

    });
    function addInputFile() {

        var num = $('#file .row').length;
        if (num < 5) {
            var row = document.getElementById('file');

            //create div class = row        
            var row_file = document.createElement('div');
            row_file.setAttribute('style', 'padding-top:10px;');
            row_file.setAttribute('class', 'row');
            row_file.setAttribute('id', 'row_file' + num);
            row.appendChild(row_file);
            var div_row = document.getElementById('row_file' + num);

            //create div class col-sm-3 foe input file
            var div_3 = document.createElement('div');
            div_3.setAttribute('class', 'col-sm-3');
            div_3.setAttribute('id', 'div_file' + num);
            div_row.appendChild(div_3);
            var div_file = document.getElementById('div_file' + num);


            var file = document.createElement('input');
            file.setAttribute('type', "file");
//        title.setAttribute('class', "form-control");
            file.setAttribute('name', "file[]");
            file.setAttribute('id', "file" + num);
            file.setAttribute('accept', 'image/gif,image/png,image/jpeg,image/jpg');
            file.setAttribute('required', 'true');
            div_file.appendChild(file);
        }

////        alert('add :' + num);
    }

    function delInputFile() {


        var num = $('#file .row').length;
        num = num - 1;
//        alert('#row_file'+num);
        var id = '#row_file' + num;
        id.toString();
        if (num > 0) {
            $(id).each(function() {
                $(this).remove();
            });
        }

    }
</script> 

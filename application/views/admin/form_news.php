<div class="row">
    <div class="page-header">
        <h1>
            <?= $title ?>
        </h1>
    </div>
</div>
<div class="row content" > 
    <?php echo $form['form']; ?>
    <div class="form-group <?= (form_error('news_type')) ? 'has-error' : 'news_status' ?>">
        <label class="col-sm-3 control-label">ประเภท</label>
        <div class="col-sm-4">
            <?php echo $form['news_type']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('news_type', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <div class="form-group <?= (form_error('news_title')) ? 'has-error' : 'news_title' ?>">
        <label class="col-sm-3 control-label">ชื่อเรื่องหลัก</label>
        <div class="col-sm-5">
            <?php echo $form['news_title']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('news_title', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <div class="form-group <?= (form_error('news_subtitle')) ? 'has-error' : 'news_subtitle' ?>">
        <label class="col-sm-3 control-label">ชื่อเรื่องรอง</label>
        <div class="col-sm-5">
            <?php echo $form['news_subtitle']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('news_subtitle', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <div class="form-group <?= (form_error('news_content')) ? 'has-error' : 'news_content' ?>">
        <label class="col-sm-3 control-label">เนื้อหา</label>
        <div class="col-sm-5">
            <?php echo $form['news_content']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('news_content', '<font color="error">', '</font>'); ?>
        </div>
    </div>


    <div class="form-group <?= (form_error('news_img')) ? 'has-error' : 'news_img' ?>" id="img_add">
        <label class="col-sm-3 control-label">รูปภาพ</label>
        <div class="col-sm-4">
            <?php echo $form['news_img']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('news_img', '<font color="error">', '</font>'); ?>
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

    <div class="form-group">
        <label class="col-sm-3 control-label">
            เอกสาร
        </label>
        <div class="col-sm-9" id="file">
            <div id="r"></div>
            <div class="row" id="row_file" >
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="txtTitle[]">
                </div>
                <div class="col-sm-3" >
                    <input type="file" name="file[]">
                </div>
            </div>
        </div>        
    </div>
    <div class="form-group">
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

    <div class="form-group <?= (form_error('news_highlight')) ? 'has-error' : 'news_highlight' ?>">
        <label class="col-sm-3 control-label">ความสำคัญ</label>
        <div class="col-sm-4">
            <?php echo $form['news_highlight']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('news_highlight', '<font color="error">', '</font>'); ?>
        </div>
    </div>

    <div class="form-group <?= (form_error('publish_date')) ? 'has-error' : 'public_date' ?>">
        <label class="col-sm-3 control-label">วันเผยแพร่</label>
        <div class="col-sm-3">
            <?php echo $form['publish_date']; ?>                 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('publish_date', '<font color="error">', '</font>'); ?>
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

<script language="javascript">
    $(document).ready(function() {

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

        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel: true}).panelInstance('content');
        });
    });
    function addInputFile() {

        var num = $('#file .row').length;

        var row = document.getElementById('file');

        //create div class = row        
        var row_file = document.createElement('div');
        row_file.setAttribute('style', 'padding-top:10px;');
        row_file.setAttribute('class', 'row');
        row_file.setAttribute('id', 'row_file' + num);
        row.appendChild(row_file);
        var div_row = document.getElementById('row_file' + num);

        //create div class  col-sm-6 for input title
        var div_6 = document.createElement('div');
        div_6.setAttribute('class', 'col-sm-6');
        div_6.setAttribute('id', 'div_title' + num);
        div_row.appendChild(div_6);
        var div_title = document.getElementById('div_title' + num);

        // Create input text
        var title = document.createElement('input');
        title.setAttribute('type', "text");
        title.setAttribute('class', "form-control");
        title.setAttribute('name', "txtTitle[]");
        title.setAttribute('id', "txt" + num);
        div_title.appendChild(title);

        //create div class col-sm-3 foe input file
        var div_3 = document.createElement('div');
        div_3.setAttribute('class', 'col-sm-3');
        div_3.setAttribute('id', 'div_file' + num);
        div_3.setAttribute('required', 'true');
        div_row.appendChild(div_3);
        var div_file = document.getElementById('div_file' + num);


        var file = document.createElement('input');
        file.setAttribute('type', "file");
//        title.setAttribute('class', "form-control");
        file.setAttribute('name', "file[]");
        file.setAttribute('id', "file" + num);
        div_file.appendChild(file);


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
//            var div_3 = document.getElementById('div_file' + num);
////            //remove file input
//            var file = document.getElementById("file" + num);
//            div_3.removeChild(file);
//            $('#row_file' + num).each(function() {
//                $(this).remove();
//            });
//            alert('#row_file' + num);
//            var row_file = document.getElementById('row_file' + num);

//            row.removeChild(row_file);

//



        //remove div class col-sm-3 foe input file


        // Create input text


        //remove div class = row        


        //create div class  col-sm-6 for input title

//        }




    }


    function fncDeleteElement() {

        var mySpan = document.getElementById('mySpan');
        var myLine = document.getElementById('hdnLine');
        if (myLine.value > 1)
        {

            // Remove input text
            var deleteFile = document.getElementById("txt" + myLine.value);
            mySpan.removeChild(deleteFile);
            // Remove input file
            var deleteFile = document.getElementById("fil" + myLine.value);
            mySpan.removeChild(deleteFile);
            // Remove <br>
            var deleteBr = document.getElementById("br" + myLine.value);
            mySpan.removeChild(deleteBr);
            myLine.value--;
        }
    }
</script>
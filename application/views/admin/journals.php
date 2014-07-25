
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <?= $title; ?>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row"> 
    <?= anchor('Journals/add', '<i class="fa fa-plus fa-lg"></i>&nbsp;เพิ่มจดหมายข่าว', 'type="button" class="btn btn-success pull-right btn-lg"') ?>
</div>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-xs-12 well" style="padding: 2%">  

        <?php echo $form['form']; ?>
        <!--        <div class="form-group">   
                    <div class="col-md-4 col-md-offset-4">
                        <? $form['status'] ?> 
                    </div>
        
                </div>-->
        <div class="form-group">            
            <div class="row">
                <div class="col-sm-10 col-md-offset-1">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">ปีที่</label>
                            <?php echo $form['year_no']; ?>
                        </div>
                    </div>
                    <div class="col-md-2">                        
                        <div class="form-group">
                            <label for="">ฉบับที่</label>
                            <?php echo $form['issue']; ?>
                        </div>                        
                    </div>
                    <div class="col-md-5">
                        <label for="">เดือน</label>
                        <?php echo $form['month']; ?>
                    </div>
                    <div class="col-md-3">
                        <label for="">ปี</label>
                        <?php echo $form['year'] ?>
                    </div>
                </div>
            </div>
            <div class="text-center" style="padding: 1%;"> 
                <button type="submit" name="btn_search" class="btn btn-default btn-lg"><i class="fa fa-search"></i>&nbsp;&nbsp;ค้นหา</button>
            </div>



            <?php echo form_close() ?>
        </div>
    </div> 
</div>
<?php
if ($strtitle != NULL) {
    ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
            <div class="lead" style="margin: 0;">           
                <?= $strtitle ?>           
            </div>
        </div>
    </div> 
    <?php
}
?>
<div class="row content">

    <?php
//    for ($i = 0; $i < 15; $i++) {
    if (count($journals) <= 0) {
        ?>
        <div class="col-md-8 col-md-offset-2 col-sm-12 well">        
            <h3>
                <p class="text-center" style="padding: 2% ;">
                    ไม่พบข้อมูล
                </p>
            </h3>        
        </div>
        <?php
    } else {
        foreach ($journals as $row) {
            $name = ' ปีที่ ' . $row['journal_year_no'];
            $name .= '  ฉบับที่ ' . $row['journal_issue'];
            $name .= ' ประจำเดือน ' . $this->m_datetime->getMonthThai($row['journal_mounth']);
            $name .= ' ' . $row['journal_year'];

            $date = $this->m_datetime->DateThai($row['publish_date']);

            $status = $row['journal_status'];
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
            ?>
            <div class="col-md-8 col-md-offset-2 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row" style="padding-bottom: 2%">
                            <div class="pull-right"> 
                                <?php
                                $delete = array(
                                    'type' => "button",
                                    'class' => "btn btn-danger",
                                    'data-id' => "2",
                                    'data-title' => "ลบจดหมายข่าว",
                                    'data-info' => $name,
                                    'data-toggle' => "modal",
                                    'data-target' => "#confirm",
                                    'data-href' => 'Journals/delete/' . $row['journal_id'],
                                );
                                ?>
                                <span class="icon">
                                    <?php echo anchor('Journals/edit/' . $row['journal_id'], '<i class="fa fa-pencil fa-lg"></i>&nbsp;แก้ไข', 'type="button" class="btn btn-info"'); ?>
                                </span>
                                <span class="icon">
                                    <?php echo anchor('#', '<i class="fa fa-trash-o fa-lg"></i>&nbsp;ลบ', $delete); ?>
                                </span>
                            </div>

                        </div>
                        <div class="row">                                             
                            <div class="col-sm-12 col-xs-12">
                                <div class="content">
                                    <div class="name"><?= $name; ?></div>
                                    <p class="description"></p>
                                    <dl class="dl-horizontal">
                                        <dt class="des-ul">ที่ปรึกษา</dt>
                                        <dd><?= $row['adviser'] ?></dd>
                                        <dt>บรรณาธิการ</dt>
                                        <dd><?= $row['editor'] ?></dd>
                                        <dt>ผู้จัดทำ</dt>
                                        <dd><?= $row['prepared_by'] ?></dd>
                                        <dt>วันเผยแพร่</dt>
                                        <dd><?= $date ?></dd>
                                    </dl>
                                </div>
                                <div>
                                    <p class="pull-right">                                    
                                        <a  href="#" data-toggle="modal" data-target="#view_pdf" data-title="<?= $name ?>" data-file="<?= $row['file_name'] ?>" >ดูเอกสาร..</a>                                      
                                    </p>                                     
                                </div>



                            </div>  



                        </div>

                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="pull-right">
                                <?php
                                echo $update . $create;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }
    }
    ?>
</div>
<div class="modal fade bs-example-modal-lg" id="view_pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="title-pdf"></h4>
            </div>
            <div class="modal-body" >
                <div id="pdf">

                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $('#view_pdf').on('shown.bs.modal', function(e) {
        var title = $(e.relatedTarget).data('title');
        var file = $(e.relatedTarget).data('file');

        $('#title-pdf').html(title);

        var success = new PDFObject({url: "<?= upload_url() ?>" + file}).embed("pdf");
    });

</script>
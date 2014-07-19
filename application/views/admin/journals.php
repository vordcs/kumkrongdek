
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
<div class="row content">

    <?php
    $month_th = Array("", "มกราคม.", "กุมภาพันธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

    function DateThai($strDate) {
        if ($strDate == NULL) {
            return '-';
        } else {
            $date = new DateTime($strDate);
            $strYear = date("Y", strtotime($strDate)) + 543;
            $strMonth = date("n", strtotime($strDate));
            $strDay = date("j", strtotime($strDate));
            $strHour = date("H", strtotime($strDate));
            $strMinute = date("i", strtotime($strDate));
            $strSeconds = date("s", strtotime($strDate));
            $strMonthCut = Array("", "มกราคม.", "กุมภาพัธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $strMonthThai = $strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear";
        }
    }

//    for ($i = 0; $i < 15; $i++) {
    foreach ($journals as $row) {
        $name = ' ปีที่ ' . $row['journal_year_no'];
        $name .= '  ฉบับที่ ' . $row['journal_issue'];
        $name .= ' ประจำเดือน ' . $month_th[$row['journal_mounth']];
        $name .= ' ' . $row['journal_year'];
        ?>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row" style="padding-bottom: 2%">
                        <div class="pull-right"> 
                            <?php
                            $delete = array(
                                'type' => "button",
                                'class' => "btn btn-danger btn-xs",
                                'data-id' => "2",
                                'data-title' => "ลบจดหมายข่าว",
                                'data-info' => $name,
                                'data-toggle' => "modal",
                                'data-target' => "#confirm",
                                'data-href' => 'Journals/delete/' . $row['journal_id'],
                            );
                            ?>
                            <span class="icon">
                                <?php echo anchor('Journals/edit/' . $row['journal_id'], '<i class="fa fa-pencil fa-lg"></i>&nbsp;แก้ไข', 'type="button" class="btn btn-info btn-xs"'); ?>
                            </span>
                            <span class="icon">
                                <?php echo anchor('#', '<i class="fa fa-trash-o fa-lg"></i>&nbsp;ลบ', $delete); ?>
                            </span>
                        </div>

                    </div>
                    <div class="row">
                        <div class="media">  
                            <a class="pull-left" href="#" data-toggle="modal" data-target="#view_pdf" data-title="<?= $name ?>" data-file="<?= $row['file_name'] ?>" >
                                <img class="media-object"  data-src="holder.js/100x100/vine/text:view" alt="<?= $month_th[$row['journal_mounth']] ?>">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?php
                                    echo $name;
                                    ?>
                                </h4>                               
                                <dl class="dl-horizontal">
                                    <dt class="des-ul">ที่ปรึกษา</dt>
                                    <dd><?= $row['adviser'] ?></dd>
                                    <dt>บรรณาธิการ</dt>
                                    <dd><?= $row['editor'] ?></dd>
                                    <dt>ผู้จัดทำ</dt>
                                    <dd><?= $row['prepared_by'] ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="pull-right">
                            <?php
                            $crate = '  | สร้าง : ' . DateThai($row['create_date']) . ' โดย: ' . $row['create_by'];
                            $update = 'แก้ไข : ' . DateThai($row['update_date']) . ' โดย: ' . $row['update_by'];
                            echo $update . $crate;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php } ?>
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
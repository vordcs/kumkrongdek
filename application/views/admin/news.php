
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <?= $title; ?>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row"> 
    <?= anchor('News_ad/add', '<i class="fa fa-plus fa-lg"></i>&nbsp;สร้างข่าว', 'type="button" class="btn btn-success pull-right btn-lg"') ?>
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

    function DateTimeThai($strDate) {
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
            return "$strDay $strMonthThai $strYear " . " เวลา $strHour:$strMinute ";
        }
    }
    ?>

    <?php if (count($news) <= 0) { ?>
        <div class="well">        
            <h3>
                <p class="text-center" style="padding: 2% ;">
                    ไม่พบข่าว
                </p>
            </h3>        
        </div>
    <?php
    } else {
        //    for ($i = 0; $i < 5; $i++) {
        foreach ($news as $row) {
            $controller = "News_ad";
            $id = $row['news_id'];
            $title = $row['news_title'];
            $content = $row['news_content'];
            $status = $row['news_status'];
            ?>
            <div class="col-md-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row">                            
                                    <?php echo $title; ?>
                                <p class="pull-right">
                                    <?php
                                    $edit = array(
                                        'type' => "button",
                                        'class' => "btn btn-info btn-xs",
                                    );
                                    $delete = array(
                                        'type' => "button",
                                        'class' => "btn btn-danger btn-xs",
                                        'data-id' => "2",
                                        'data-title' => "ลบกิจกรรม",
                                        'data-info' => $title,
                                        'data-toggle' => "modal",
                                        'data-target' => "#confirm",
                                        'data-href' => $controller . '/delete/' . $id,
                                    );
                                    $cancle = array(
                                        'type' => "button",
                                        'class' => "btn btn-warning btn-xs",
                                        'data-id' => "3",
                                        'data-title' => "ยกเลิกกิจกรรม",
                                        'data-info' => $title,
                                        'data-toggle' => "modal",
                                        'data-target' => "#confirm",
                                        'data-href' => $controller . '/unactive/' . $id,
                                    );
                                    $active = array(
                                        'type' => "button",
                                        'class' => "btn btn-success btn-xs",
                                        'data-id' => "4",
                                        'data-title' => "ใช้งานกิจกรรม",
                                        'data-info' => $title,
                                        'data-toggle' => "modal",
                                        'data-target' => "#confirm",
                                        'data-href' => $controller . '/active/' . $id,
                                    );

                                    echo '<span class="icon">' . anchor($controller . '/edit/' . $id, '<i class="fa fa-pencil fa-lg"></i>&nbsp;แก้ไข', $edit) . '</span>';
                                    if ($status == 'active') {
                                        echo '<span class="icon">' . anchor('#', '<i class="fa fa-times fa-lg"></i>&nbsp;ยกเลิก', $cancle) . '</span>';
                                    } else {

                                        echo '<span class="icon">' . anchor('#', '<i class="fa fa-refresh fa-lg fa-spin"></i>&nbsp;ใช้งาน', $active) . '</span>';
                                        echo '<span class="icon">' . anchor('#', '<i class="fa fa-trash-o fa-lg"></i>&nbsp;ลบ', $delete) . '</span>';
                                    }
                                    ?>
                                </p>
                            </div> 
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="media">
                            <a class="pull-left" href="#">
        <?= img($row['image_small'], array('class' => 'img-responsive', 'width' => '200px', 'height' => '200px')); ?>
                            </a>
                            <div class="media-body">
                                <div class="text">
        <?php echo $content; ?> 
                                </div> 
                                <br>
                                <p class="text-center"><?php echo 'เผยแพร่วันที่ ' . DateThai($row['publish_date']); ?> </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="pull-right">
                                <?php
                                $crate = '  | สร้าง : ' . DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
                                $update = 'แก้ไข : ' . DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
                                echo $update . $crate;
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

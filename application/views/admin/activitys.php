
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>
                <?= $title; ?>   
            </h1>

        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row"> 
    <?= anchor('Activitys_ad/add', '<i class="fa fa-plus fa-lg"></i>&nbsp;เพิ่มกิจกรรม', 'type="button" class="btn btn-success pull-right btn-lg"') ?>
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

    if (count($activitys) <= 0) {
        ?>
        <div class="well">        
            <h3>
                <p class="text-center" style="padding: 2% ;">
                    ไม่พบข้อมูล
                </p>
            </h3>        
        </div>
        <?php
    } else {
//    for ($i = 0; $i < 5; $i++) {
        foreach ($activitys as $row) {
            $controller = "Activitys_ad";
            $id = $row['activity_id'];
            $title = $row['activity_title'];
            $subtitle = $row['activity_subtitle'];
            $content = $row['activity_content'];
            $date = DateThai($row['publish_date']);
            $status = $row['activity_status'];
            ?>
            <div class="col-md-8 col-md-offset-2 col-xs-12">                
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">   
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
                                    'data-title' => "ลบข่าว",
                                    'data-info' => $title,
                                    'data-toggle' => "modal",
                                    'data-target' => "#confirm",
                                    'data-href' => $controller . '/delete/' . $id,
                                );
                                $cancle = array(
                                    'type' => "button",
                                    'class' => "btn btn-warning btn-xs",
                                    'data-id' => "3",
                                    'data-title' => "ยกเลิกข่าว",
                                    'data-info' => $title,
                                    'data-toggle' => "modal",
                                    'data-target' => "#confirm",
                                    'data-href' => $controller . '/unactive/' . $id,
                                );
                                $active = array(
                                    'type' => "button",
                                    'class' => "btn btn-success btn-xs",
                                    'data-id' => "4",
                                    'data-title' => "ใช้งานข่าว",
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
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <a class="text-center" href="#">
                                    <?= img($row['image_small'], array('class' => 'img-responsive', 'width' => '100%')); ?>
                                </a>
                            </div>  
                            <div class="col-xs-12 col-md-8">
                                <div class="row">
                                    <h3>
                                        <?= $title ?>
                                        <div class="text-muted"><small><?= $date ?></small></div>
                                    </h3> 
                                    <div class="description">                                   
                                        <p>
                                            <?= $subtitle ?>  
                                            <!-- Button trigger modal -->
                                            <button class="btn btn-link pull-right" 
                                                    style="font-size: 0.91em;"
                                                    data-toggle="modal" 
                                                    data-target="#modal_content" 
                                                    data-title="<?= $title ?>" 
                                                    data-info="<?= $content ?>"
                                                    data-date="<?= $date ?>"
                                                    >
                                                อ่านเพิ่ม... 
                                            </button>
                                        </p>  
                                    </div>
                                    <div class="text-center">
                                        <?php
                                        for ($i = 0; $i < 20; $i++) {
                                            ?>
                                        <img data-src='holder.js/50x50' style="padding-top: 3px;">
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>                            
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


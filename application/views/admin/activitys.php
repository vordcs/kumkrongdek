
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

    <div class="col-md-4 col-md-offset-4 col-xs-12">         
        <!--<form role="form" class="form-horizontal center-block" action="">-->  
        <?php echo $form['form']; ?>
        <div class="form-group">
            <label class="control-label col-sm-3" for="inputSuccess3">ค้นหา</label>
            <div class="col-sm-9">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control date-search" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>

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
            $images_ = array();
            if (count($images_activity) > 0) {
                foreach ($images_activity as $img) {
                    if ($img['activity_id'] == $id) {
                        $temp = array(
                            'image_name' => $img['image_name'],
                            'image_small' => $img['image_small'],
                            'image_full' => $img['image_full'],
                            'image_path' => $img['image_path']
                        );
                        array_push($images_, $temp);
                    }
                }
            }
            $create = '  | สร้าง : ' . DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
            ?>
            <div class="col-md-8 col-md-offset-2 col-xs-12">                
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">   
                            <p class="pull-right">
                                <?php
                                $edit = array(
                                    'type' => "button",
                                    'class' => "btn btn-info",
                                );
                                $delete = array(
                                    'type' => "button",
                                    'class' => "btn btn-danger",
                                    'data-id' => "2",
                                    'data-title' => "ลบข่าว",
                                    'data-info' => $title,
                                    'data-toggle' => "modal",
                                    'data-target' => "#confirm",
                                    'data-href' => $controller . '/delete/' . $id,
                                );
                                $cancle = array(
                                    'type' => "button",
                                    'class' => "btn btn-warning",
                                    'data-id' => "3",
                                    'data-title' => "ยกเลิกข่าว",
                                    'data-info' => $title,
                                    'data-toggle' => "modal",
                                    'data-target' => "#confirm",
                                    'data-href' => $controller . '/unactive/' . $id,
                                );
                                $active = array(
                                    'type' => "button",
                                    'class' => "btn btn-success",
                                    'data-id' => "4",
                                    'data-title' => "ใช้งานข่าว",
                                    'data-info' => $title,
                                    'data-toggle' => "modal",
                                    'data-target' => "#confirm",
                                    'data-href' => $controller . '/active/' . $id,
                                );

                                $view_more = array(
                                    'type' => "button",
                                    'class' => "btn btn-link pull-right",
                                    'style' => "font-size: 0.91em;",
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
                                            <?= anchor($controller . '/view_more/' . $id, 'อ่านเพิ่ม... ', $view_more) ?>                                           
                                        </p>  
                                    </div>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $id ?>">
                                        รูปภาพ
                                    </a>
                                    <div id="collapse<?= $id ?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <!--<div class="row" id="gallery"   style="margin-top: 3%;">--> 
                                            <div class="ui small images">
                                                <?php
                                                if (count($images_) > 0) {
                                                    foreach ($images_ as $row_img) {
                                                        echo '<a class="fancybox" rel="gallery' . $id . '" href="' . img_url() . $row_img['image_full'] . '"><img src="' . img_url() . $row_img['image_full'] . '"alt="..." class="ui image" ></a>';
                                                    }
                                                }
                                                ?>  
                                            </div>
                                        </div>
                                    </div>
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


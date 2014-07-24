<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <?= $title; ?>
        </h1>
    </div>
</div>
<div class="row"> 
    <?= anchor('Kindness_ad/add', '<i class="fa fa-plus fa-lg"></i>&nbsp;เพิ่มผู้ใหญ่ใจดี', 'type="button" class="btn btn-success pull-right btn-lg"') ?>
</div>
<div class="row">

    <div class="col-sm-4 col-sm-offset-4 col-xs-12">         
        <!--<form role="form" class="form-horizontal center-block" action="">-->  
        <?php echo $form['form']; ?>
        <div class="row">            
            <?= $form['status'] ?>
        </div>
        <div class="row">             
            <div class="input-group custom-search-form">
                <input type="text" class="form-control date-search" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default">
                        <i class="fa fa-calendar fa-lg"></i>
                    </button>
                    <?= $form['date'] ?>
                </span>
               
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</div>

<div class="row content">
    <?php
    function DateThai($strDate) {
        if ($strDate == NULL) {
            return '-';
        } else {
            $date = new DateTime($strDate);
            $strYear = date("Y", strtotime($strDate));
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

    //    for ($i = 0; $i < 5; $i++) {
    foreach ($kindness as $row) {
        $controller = "Kindness_ad";
        $id = $row['kindness_id'];
        $title = $row['kindness_title'];
        $subtitle = $row['kindness_subtitle'];
        $content = $row['kindness_content'];
        $date = DateThai($row['publish_date']);
        $img = $row['image_small'];
        $status = $row['kindness_status'];
        $create = '  | สร้าง : ' . DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
        $update = 'แก้ไข : ' . DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
        ?>
        <div class="col-md-10 col-md-offset-1 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
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
                                    'data-title' => "ลบกิจกรรม",
                                    'data-info' => $title,
                                    'data-toggle' => "modal",
                                    'data-target' => "#confirm",
                                    'data-href' => $controller . '/delete/' . $id,
                                );
                                $cancle = array(
                                    'type' => "button",
                                    'class' => "btn btn-warning",
                                    'data-id' => "3",
                                    'data-title' => "ยกเลิกกิจกรรม",
                                    'data-info' => $title,
                                    'data-toggle' => "modal",
                                    'data-target' => "#confirm",
                                    'data-href' => $controller . '/unactive/' . $id,
                                );
                                $active = array(
                                    'type' => "button",
                                    'class' => "btn btn-success",
                                    'data-id' => "4",
                                    'data-title' => "ใช้งานกิจกรรม",
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
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <a class="pull-left" href="#">
                                <?= img($img, array('class' => 'img-responsive', 'width' => '100%')); ?>
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
                            </div>
                            <div class="row" style="margin: 0px;padding: 0px">


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
    <?php } ?>
</div>

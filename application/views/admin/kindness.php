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
    <div class="col-sm-4 col-sm-offset-4 col-xs-12" style="padding: 3%">  
        <div class="text-center">        
            <?php echo $form['form']; ?>
            <div class="form-group">            
                <?= $form['status'] ?>
            </div>     

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></div>
                    <?= $form['date'] ?>
                </div>
            </div>

            <button type="submit" class="btn btn-default"><h3 style="margin: 0px"><i class="fa fa-search"></i>&nbsp;&nbsp;ค้นหา</h3></button>

            <?php echo form_close() ?>
        </div>
    </div> 
</div>
<?php
if ($strtitle != NULL) {
    ?>
    <div class="row">
        <div class="lead">           
            <?= $strtitle ?>           
        </div>
    </div> 
    <?php
}
?>
<div class="row">
    <?php
    if (count($kindness) <= 0) {
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
        foreach ($kindness as $row) {
            $controller = "Kindness_ad";
            $id = $row['kindness_id'];
            $title = $row['kindness_title'];
            $subtitle = $row['kindness_subtitle'];
            $content = $row['kindness_content'];
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $img = $row['image_small'];
            $highlight = $row['kindness_highlight'];
            $status = $row['kindness_status'];
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
            ?>
            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row">                           
                                <?php
                                if ($highlight == 0) {
                                    echo '<span class="icon"><i class="fa fa-bookmark-o fa-2x"></i></span>';
                                } else {
                                    echo '<span class="icon"><i class="fa fa-bookmark fa-2x"></i></span>';
                                }
//                                echo $status;
                                ?>
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
//
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
                                <a class="text-center" href="#">
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

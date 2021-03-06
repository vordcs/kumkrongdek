
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>
                <?= $title; ?>   
            </h1>

        </div>
        <?= anchor('Activitys_ad/add', '<i class="fa fa-plus fa-lg"></i>&nbsp;เพิ่มกิจกรรม', 'type="button" class="btn btn-success pull-right btn-lg"') ?>     
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4 col-xs-12 well" style="padding: 3%"> 
        <?php echo $form['form']; ?>
        <div class="form-group">  
            <label for="">สถานะ</label>
            <?= $form['status'] ?>
        </div>  
        <div class="form-group">  
            <label for="">ประเภทกิจกรรม</label>
            <?= $form['type'] ?>
        </div>  

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></div>
                <?= $form['date'] ?>
            </div>
        </div>
        <div class="pull-right">    
            <button type="submit" class="btn btn-default"><h3 style="margin: 0px"><i class="fa fa-search"></i>&nbsp;&nbsp;ค้นหา</h3></button>
        </div> 
        <?php echo form_close() ?>
    </div>

</div>
<?php
if ($strtitle != NULL) {
    ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-12 well">
            <div class="lead text-center" style="margin: 0;"> 
                <?= $strtitle ?>           
            </div>
        </div>
    </div> 
    <?php
}
?>
<div class="row content">
    <?php
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
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $highlight = $row['activity_highlight'];
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
            foreach ($activity_types as $t) {
                if ($t['activity_type_id'] == $row['activity_type']) {
                    $type = $t['activity_type_name'];
                }
            }
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
            ?>
            <div class="col-md-10 col-md-offset-1 col-xs-12">                
                <div class="panel panel-default">

                    <div class="panel-body"> 
                        <div class="ui ribbon pink label">
                            <h3 style="margin: 0px;padding: 0px"><?= $type ?></h3>                                
                        </div>
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
                            <?php
                            if ($highlight == 0) {
                                echo '<span class="icon"><i class="fa fa-bookmark-o fa-lg"></i> <?= $highlight </span>';
                            } else {
                                echo '<span class="icon"><i class="fa fa-bookmark fa-lg"></i> <?= $highlight</span>';
                            }
                            ?>
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


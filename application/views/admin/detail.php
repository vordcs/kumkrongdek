
<div class="row content">
    <div class="col-xs-12 col-md-10 col-md-offset-1">                
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">   
                    <p class="pull-right">
                        <?php
                        $close = array(
                            'type' => "button",
                            'class' => "btn btn-success",
                        );
                        $edit = array(
                            'type' => "button",
                            'class' => "btn btn-info",
                        );
                        $delete = array(
                            'type' => "button",
                            'class' => "btn btn-danger",
                            'data-id' => "2",
                            'data-title' => "ลบ",
                            'data-info' => $title,
                            'data-toggle' => "modal",
                            'data-target' => "#confirm",
                            'data-href' => $controller . '/delete/' . $id,
                        );
                        $cancle = array(
                            'type' => "button",
                            'class' => "btn btn-warning",
                            'data-id' => "3",
                            'data-title' => "ยกเลิก",
                            'data-info' => $title,
                            'data-toggle' => "modal",
                            'data-target' => "#confirm",
                            'data-href' => $controller . '/unactive/' . $id,
                        );
                        $active = array(
                            'type' => "button",
                            'class' => "btn btn-success",
                            'data-id' => "4",
                            'data-title' => "ใช้งาน",
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
                        echo '<span class="icon">' . '<span class="icon">' . anchor($controller, 'ปิด', $close) . '</span>';
                        ?>
                    </p>
                </div> 

                <div class="row"> 
                    <div>
                        <!--<img class="ui small left floated image" data-src="holder.js/100x100/sky" width="100px" height="100px">-->                        
                        <a class="fancybox" rel="gallery<?= $id ?>" href="<?= img_url() . $img ?>">
                            <?= img($img, array('class' => 'img-responsive ui small left floated image')); ?>
                        </a>
                        <div style="font-size: 1.5em;"><?= $title ?></div>
                        <div class="text-muted"><small><?= $date ?></small></div>                    
                    </div>
                    <div class="description">                                   
                        <p>
                            <?= $content ?>                                 
                        </p>  
                    </div>
                </div>  
                <?php
                if (count($images) > 0) {
                    ?>
                    <div class="row" id="gallery" style="margin-top: 3%;" > 
                        <h3><strong>รูปภาพอื่นๆ</strong></h3>
                        <?php
                        foreach ($images as $row_img) {
                            echo '<a class="fancybox" rel="gallery' . $id . '" href="' . img_url() . $row_img['image_full'] . '"><img src="' . img_url() . $row_img['image_full'] . '"alt="..." width="100%" ></a>';
                        }
                        ?>  
                    </div>
                <?php } ?>
                <div class="row" style="padding-top: 2%;">
                    <div class="pull-right">
                        <?php
                        echo $update . $create;
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <p class="text-center">     
                    <?php
                    echo '<span class="icon">' . anchor($controller, 'ปิด', $close) . '</span>';
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>


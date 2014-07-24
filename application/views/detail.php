<?php
$close = array(
    'type' => "button",
    'class' => "btn btn-success",
);

$view_more = array(
    'type' => "button",
    'class' => "btn btn-link pull-right",
    'style' => "font-size: 0.91em;",
);
?>  
<div class="row content">
    <div class="col-xs-12 col-md-8 col-md-offset-2" style="padding: 2%">   
        <div class="col-sm-4">
            <a class="fancybox" rel="gallery<?= $id ?>" href="<?= img_url() . $img ?>">
                <?= img($img, array('class' => 'img-responsive ui large left floated image')); ?>
            </a> 
        </div>
        <div class="col-sm-8">
            <div class="row"> 

     <!--<img class="ui small left floated image" data-src="holder.js/100x100/sky" width="100px" height="100px">-->                        

                <div style="font-size: 1.5em;"><?= $title ?></div>
                <div class="text-muted"><small><?= $date ?></small></div>                    
                <div class="description">                                   
                    <p>
                        <?= $content ?>                                 
                    </p>  
                </div>
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
        <div class="panel panel-default">  
            <div class="panel-body"> 

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



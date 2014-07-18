
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <?= $title; ?>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row"> 
    <?= anchor('Slides/add', '<i class="fa fa-plus fa-lg"></i>&nbsp;สร้างสไลด์', 'type="button" class="btn btn-success pull-right btn-lg"') ?>
</div>
<div class="row content">
    <?php
//    for ($i = 0; $i < 5; $i++) { 
    foreach ($slides as $row) {
        ?>
        <div id="itemp-slide" class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <?= img($row['image_small'], array('class' => 'img-responsive', 'width' => '100%')); ?>
                <!--<img data-src="holder.js/900x500/auto/vine" alt="..." width="100%" class="img-responsive">-->
                <div class="slide-link">
                    <span><i class="fa fa-link fa-2x"></i></span> 
                </div>                
                <div class="caption">                    
                    <h4>Thumbnail label</h4>                    
                    <div class="description">
                        <p>เน้อหา ต่างๆ</p> 
                    </div>                   

    <?php
//                    $delete = array(
//                        'type' => "button",
//                        'class' => "btn btn-danger btn-xs",
//                        'data-id' => "2",
//                        'data-title' => "ลบ",
//                        'data-info' => unserialize($row['title'])['thai'],
//                        'data-toggle' => "modal",
//                        'data-target' => "#confirm",
//                        'data-href' => 'Gallery/delete/' . $row['id'],
//                    );
//                    $cancle = array(
//                        'type' => "button",
//                        'class' => "btn btn-warning btn-xs",
//                        'data-id' => "3",
//                        'data-title' => "ยกเลิกการ",
//                        'data-info' => unserialize($row['title'])['thai'],
//                        'data-toggle' => "modal",
//                        'data-target' => "#confirm",
//                        'data-href' => 'Gallery/cancle/' . $row['id'],
//                    );
//                    $active = array(
//                        'type' => "button",
//                        'class' => "btn btn-success btn-xs",
//                        'data-id' => "4",
//                        'data-title' => "",
//                        'data-info' => unserialize($row['title'])['thai'],
//                        'data-toggle' => "modal",
//                        'data-target' => "#confirm",
//                        'data-href' => 'Gallery/active/' . $row['id'],
//                    );
    ?>
                    <p class="text-center">
                        <a href="#" class="btn btn-primary btn-xs" role="button">Button</a>
                        <a href="#" class="btn btn-default btn-xs" role="button">Button</a>
                        <a href="#" class="btn btn-default btn-xs" role="button">Button</a>
                    </p>
                </div>
            </div>
        </div>
<?php } ?>
</div>



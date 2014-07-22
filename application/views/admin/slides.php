
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
<div class="row">

    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <form method="post" action="" name="myform" >
            <?= $status ?>
        </form>
    </div>
    <div class="col-sm-4"></div>

</div>
<div class="row content">
    <?php
    if (count($slides) <= 0) {
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
        foreach ($slides as $row) {
            ?>
            <div id="itemp-slide" class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <?= img($row['image_small'], array('class' => 'img-responsive', 'width' => '100%', 'height' => '200px')); ?>
                    <!--<img data-src="holder.js/900x500/auto/vine" alt="..." width="100%" class="img-responsive">-->

                    <div class="caption">  
                        <span class="pull-right"><?= ($row['slide_link'] == NULL) ? $row['slide_link'] : anchor($row['slide_link'], '<i class="fa fa-link fa-2x"></i>', ''); ?></span> 
                        <h4><?= $row['slide_title'] ?></h4>                    
                        <div class="description">
                            <p>
                                <?= $row['slide_subtitle'] ?>
                            </p> 
                        </div>                   

                        <?php
                        $delete = array(
                            'type' => "button",
                            'class' => "btn btn-danger btn-xs",
                            'data-id' => "2",
                            'data-title' => "ลบสไลด์",
                            'data-info' => $row['slide_title'],
                            'data-toggle' => "modal",
                            'data-target' => "#confirm",
                            'data-href' => 'Slides/delete/' . $row['slide_id'],
                        );
                        $cancle = array(
                            'type' => "button",
                            'class' => "btn btn-warning btn-xs",
                            'data-id' => "3",
                            'data-title' => "ยกเลิกสไลด์",
                            'data-info' => $row['slide_title'],
                            'data-toggle' => "modal",
                            'data-target' => "#confirm",
                            'data-href' => 'Slides/unactive/' . $row['slide_id'],
                        );
                        $active = array(
                            'type' => "button",
                            'class' => "btn btn-success btn-xs",
                            'data-id' => "4",
                            'data-title' => "ใช้งานสไลด์",
                            'data-info' => $row['slide_title'],
                            'data-toggle' => "modal",
                            'data-target' => "#confirm",
                            'data-href' => 'Slides/active/' . $row['slide_id'],
                        );
                        echo '<p class="text-center">';
                        echo anchor('Slides/edit/' . $row['slide_id'], '<i class="fa fa-pencil fa-lg"></i>&nbsp;แก้ไข', 'type="button" class="btn btn-info btn-xs"') . '&nbsp;&nbsp';
                        if ($row['slide_status'] == 'active') {
                            echo anchor('#', '<i class="fa fa-minus fa-lg"></i>&nbsp;ยกเลิก', $cancle);
                        } else {
                            echo anchor('#', '<i class="fa fa-refresh fa-lg fa-spin"></i>&nbsp;ใช้งาน', $active) . '&nbsp;&nbsp';
                            echo anchor('#', '<i class="fa fa-trash-o fa-lg"></i>&nbsp;ลบ', $delete);
                        }
                        echo '</p>';
                        ?>                  
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>



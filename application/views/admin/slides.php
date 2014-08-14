
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
        ?>

        <?php
//    for ($i = 0; $i < 5; $i++) { 
        foreach ($slides as $row) {
            $controller = "Slides";
            $id = $row['slide_id'];
            $title = $row['slide_title'];
            $subtitle = $row['slide_subtitle'];
            $img = $row['image_small'];
            $status = $row['slide_status'];

            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];


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
            ?>
            <div class="col-xs-12 col-md-10 col-md-offset-1 ">
                <div class="ui segment ">
                    <div class="ui inverted relaxed divided list">
                        <div class="item">
                            <div class="pull-right">    
                                <?php
                                echo anchor('Slides/edit/' . $row['slide_id'], '<i class="fa fa-pencil fa-lg"></i>&nbsp;แก้ไข', 'type="button" class="btn btn-info"') . '&nbsp;&nbsp';
                                if ($status == 'active') {
                                    echo anchor('#', '<i class="fa fa-times fa-lg"></i>&nbsp;ยกเลิก', $cancle);
                                } else {
                                    echo anchor('#', '<i class="fa fa-refresh fa-lg fa-spin"></i>&nbsp;ใช้งาน', $active) . '&nbsp;&nbsp';
                                    echo anchor('#', '<i class="fa fa-trash-o fa-lg"></i>&nbsp;ลบ', $delete);
                                }
                                ?>

                            </div>
                            <div class="image">
                                <a class="fancybox" rel="gallery<?= $id ?>" href="<?= img_url() . $img ?>">
                                    <?= img($img, array('class' => 'ui small left floated image img-responsive', 'width' => '100%', 'height' => '200px')); ?>
                                </a>
                                <!--<img class="ui small left floated image" src="/images/demo/photo.jpg">-->
                            </div>     
                            <div class="content">
                                <div class="header"><?= $title ?></div>
                                <?= $subtitle ?>
                            </div>
                        </div>
                        <div class="row">
                            <p class=""><?= ($row['slide_link'] == NULL) ? $row['slide_link'] : anchor($row['slide_link'], '<i class="fa fa-link fa-fw"></i>', ''); ?></p>
                            <div class="pull-right">
                                <p class="text-muted">
                                    <small>
                                        <?= $update ?>
                                    </small>   
                                    <small>
                                        <?= $create ?>
                                    </small>                                
                                </p>
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





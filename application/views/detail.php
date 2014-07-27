<?php
$close = array(
    'type' => "button",
    'class' => "btn btn-success",
);
?>  

<div id="mainContent">
    <div id="top-title">
        <div class="title_bg">
            <div class="container">
                <div class="title_top">
                    <a href="<?= base_url('/' . $controller) ?>">
                        <h2><?= $page_title ?></h2>  
                    </a>              
                </div>
            </div>
        </div>  
    </div>


    <div class="row content">
        <div class="container" >
            <div class="row" style="padding-top: 1%">               
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="ui raised segment">
                        <?php if ($type != NULL) { ?>
                            <div class="ui ribbon green label" style="padding-right: 20%">
                                <h2 style="margin: 0;"> 
                                    <?= $type ?>
                                </h2>                
                            </div>  
                        <?php } ?>
                        <div class="row">
                            <?php if ($img != NULL) { ?>
                                <a class="fancybox" rel="gallery<?= $id ?>" href="<?= img_url() . $img ?>">
                                    <?= img($img, array('class' => 'img-responsive ui small right floated image')); ?>
                                </a> 
                            <?php } ?>
                            <div class="content">
                                <h1 class="ui header">   
                                    <span class="name"><?= $title_article ?></span>                        
                                    <div class="text-muted"><?= $date ?></div> 
                                </h1> 
                                <p class="description text">
                                    <?= $content ?> 
                                </p>



                            </div>  
                        </div>              

                        <?php
                        if (count($file) > 0) {
                            ?>
                            <div class="row">     
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="ui raised segment">
                                            <div class="ui ribbon green label" style="padding-right: 10%;">
                                                <h3 style="margin: 0;">                                    
                                                    เอกสาร
                                                </h3>  
                                            </div>
                                            <div class="row" style="margin-top: 3%;">
                                                <dl class="dl-horizontal">
                                                    <?php
                                                    foreach ($file as $f) {
                                                        ?>
                                                        <dt class="des-ul">
                                                        <?= $f['title'] ?>
                                                        </dt>
                                                        <dd>
                                                            <a href="<?= upload_url() . $f['file_name'] ?>">
                                                                <i class="fa fa-download fa-lg"></i> 
                                                            </a>
                                                        </dd>
                                                        <?php
                                                    }
                                                    ?>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        if (count($images) > 0) {
                            ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="ui raised segment">
                                        <div class="ui ribbon green label" style="padding-right: 10%;">
                                            <h3 style="margin: 0;">                                    
                                                รูปภาพ
                                            </h3>
                                        </div>
                                        <div class="row" id="gallery" style="margin-top: 3%;">
                                            <?php
                                            foreach ($images as $row_img) {
                                                echo '<a class="fancybox" rel="gallery' . $id . '" href="' . img_url() . $row_img['image_full'] . '"><img src="' . img_url() . $row_img['image_full'] . '"alt="..." width="100%" ></a>';
                                            }
                                            ?> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container hidden-xs">
        <div class="ui raised segment">            
            <div class="ui four items">
                <?php
                if (count($relate) > 0) {
                    foreach ($relate as $row) {
                        ?>              
                        <div class="item">
                            <div class="content">
                                <div class="meta"><?= $row['date'] ?></div>
                                <div class="name"><?= $row['title_article'] ?></div>
                                <p class="description">
                                    <?= $row['subtitle'] ?>
                                </p>
                            </div>
                            <div class="extra">
                                <a href="<?= base_url($row['controller'] . '/view_more/' . $row['id']) ?>">
                                    อ่าน...
                                </a>

                            </div>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>

</div>




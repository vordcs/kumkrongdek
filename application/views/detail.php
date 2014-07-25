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
                    <a href="<?=  base_url('/'.$controller)?>">
                        <h2><?= $page_title ?></h2>  
                    </a>              
                </div>
            </div>
        </div>  
    </div>


    <div class="row content">
        <div class="container" >
            <div class="row" style="padding-top: 4%">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="row">
                        <a class="fancybox" rel="gallery<?= $id ?>" href="<?= img_url() . $img ?>">
                            <?= img($img, array('class' => 'img-responsive ui small right floated image')); ?>
                        </a> 

                        <div class="content">
                            <h1 class="ui header">   
                                <span class="name"><?= $title ?></span>                        
                                <div class="text-muted"><?= $date ?></div> 
                            </h1>  
                            <div class="description text">
                                <?= $content ?>    
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
                    <?php }
                    ?>
                </div>
                <div class="col-sm-2"></div>        
            </div>
        </div>
    </div>





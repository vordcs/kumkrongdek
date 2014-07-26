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
            <div class="row" style="padding-top: 4%">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10">
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
                    <div class="ui raised segment">
                        <div class="ui ribbon green label"><h3>รูป</h3>
                        </div>
                        <p>fdsfsfsdfsf</p>
                    </div>


                    <div class="ui raised segment">
                        <div class="ui ribbon green label"><h3>เอกสาร</h3>
                        </div>
                        <p>fsdfsf</p>
                    </div>
                </div>
                <div class="col-sm-1">

                </div>        
            </div>
        </div>
    </div>
    <div class="container hidden-xs">
        <div class="ui raised segment">
            <div class="ui ribbon green label"><h3>ข่าวประชาสัมพันธ์</h3></div>
            <div class="ui five items">
                <div class="item">
                    <div class="content">
                        <div class="meta">2 days ago</div>
                        <div class="name">Cute Dog</div>
                        <p class="description">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
                    </div>
                    <div class="extra">
                        199 votes
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="meta">5 days ago</div>
                        <div class="name">Faithful Dog</div>
                        <p class="description">Sometimes its more important to have a dog you know you can trust. But not every dog is trustworthy, you can tell by looking at its smile.</p>
                    </div>
                    <div class="extra">
                        311 votes
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="meta">1 week ago</div>
                        <div class="name">Silly Dog</div>
                        <p class="description">Silly dogs can be quite fun to have as companions. You never know what kind of ridiculous thing they will do.</p>
                    </div>
                    <div class="extra">
                        522 votes
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="meta">1 week ago</div>
                        <div class="name">Silly Dog</div>
                        <p class="description">Silly dogs can be quite fun to have as companions. You never know what kind of ridiculous thing they will do.</p>
                    </div>
                    <div class="extra">
                        522 votes
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="meta">1 week ago</div>
                        <div class="name">Silly Dog</div>
                        <p class="description">Silly dogs can be quite fun to have as companions. You never know what kind of ridiculous thing they will do.</p>
                    </div>
                    <div class="extra">
                        522 votes
                    </div>
                </div>
            </div>
        </div>
    </div>






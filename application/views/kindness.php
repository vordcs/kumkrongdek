<div id="mainContent">
    <div id="top-title">
        <div class="title_bg">
            <div class="container">
                <div class="title_top">
                    <a href="<?= base_url('Kindness') ?>">
                        <h2>ผู้ใหญ่ใจดี</h2>
                    </a>
                </div>                
            </div>
        </div>  
    </div>

    <div id="content" class="container"> 
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
                    $controller = "Kindness";
                    $id = $row['kindness_id'];
                    $title = $row['kindness_title'];
                    $subtitle = $row['kindness_subtitle'];
                    $content = $row['kindness_content'];
                    $date = $this->m_datetime->DateThai($row['publish_date']);
                    $img = $row['image_small'];
                    $status = $row['kindness_status'];

                    $view_more = array(
                        'type' => "button",
                        'class' => "btn btn-link pull-right",
                        'style' => "font-size: 0.91em;",
                    );
                    if (true) {
                        
                    }
                    ?>
                    <div class="col-md-6 col-xs-12">
                        <div class="caption" >
                            <div class="ui raised segment">
                                <div class="ui ribbon green label"><h3 style="margin: 0;"><?= $date ?></h3></div><br>
                                <br>  
                                <div class="row">                        
                                    <div class="col-xs-12 col-md-4">
                                        <a class="text-center" href="#">
                                            <?= img($img, array('class' => 'img-responsive', 'width' => '100%')); ?>
                                        </a>
                                    </div> 
                                    <div class="col-xs-12 col-md-8">
                                        <div class="content">
                                            <div class="name"><?=$title?></div>
                                            <p class="description">
                                                <?=$subtitle?>
                                            </p>
                                            <p><?= anchor($controller . '/view_more/' . $id, 'อ่านเพิ่ม... ', $view_more) ?>  </p>
                                        </div>
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
        <div class="row hidden" id="gallery" style="margin-top: 3%;" > 
            <h3><strong>รูปภาพอื่นๆ</strong></h3>
            <img src="holder.js/300x400"alt="..." width="100%" >
            <?php
            for ($i = 0; $i < 0; $i++) {
                ?>
                <a class="fancybox" rel="gallery" href=""><img src="holder.js/300x300/vine" alt="..." width="100%" ></a>
                <?php
            }
            ?>  
            <a class="fancybox" rel="gallery" href=""><img src="holder.js/300x600"alt="..." width="100%" ></a>
        </div>
    </div>
    
      <section id="hightlight" >
        <div class="container">  
            <div class="box effect2">
                <div id="owl-hightlight" class="owl-carousel">   
                    <!--<div class="ui ten items">-->
                    <?php
                    if (count($highlight) > 0) {
                        foreach ($highlight as $row) {
                            $controller = $row['controller'];
                            $id = $row['id'];
                            $title_ = $row['title'];
                            $subtitle = $row['subtitle'];
                            $img = $row['image'];
                            $type = $row['type'];
                            $date = $row['date'];
                            ?>
                            <div class="ui one items" style="margin: 3%">
                                <div class="item">
                                    <div class="ui ribbon blue label" style="padding-right: 5%">
                                        <h4 style="margin: 0"><?= $type ?></h4>
                                    </div>
                                    <div class="content">
                                        <div class="meta"><?= $date ?></div>
                                        <div class="name"><?= $title_ ?></div>
                                        <p class="description">
                                            <?= $subtitle ?>
                                        </p>

                                    </div>
                                    <?php ?>                                
                                    <div class="image" style="margin: 10%">
                                        <!--<img src="/images/demo/photo.jpg">-->
                                        <?= img($img) ?>
                                        <a class="like ui corner label">                                        
                                            <div class="text">ใหม่</div>
                                        </a>                                    
                                    </div>
                                    <?php ?>
                                    <div class="extra">
                                        <a href="<?= base_url($controller . '/view_more/' . $id) ?>">
                                            ดูเพิ่ม...
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>              
                    <!--</div>-->
                </div>           

            </div>  
        </div>
    </section>
    
</div>



<div id="mainContent">
    <section id="slide">
        <div class="container">
            <div id="owl-1" class="owl-carousel">
                <?php
                foreach ($slides as $slide) {
                    $title = $slide['slide_title'];
                    $subtitle = $slide['slide_subtitle'];
                    $img = $slide['image_small'];
                    ?>
                    <div class="slide-item">
                        <!--<img data-src="holder.js/900x400/auto/sky" width="100%" alt="...">-->
                        <?= img($img, array('alt' => 'Image slide')); ?>                        
                        <div class="title-slide">
                            <h3><?= $title ?></h3>
                            <?= $subtitle ?>
                        </div>    
                        <div class="read_more_slide">
                            <a href="#" class="btn btn-link">อ่านเพิ่ม..</a>
                        </div>
                    </div>
                <?php } ?>
                <?php
                for ($i = 0; $i < 0; $i++) {
                    if ($i % 2 == 0) {
                        ?>
                        <div class="item" >
                            <img data-src="holder.js/900x400/auto/sky" class="img-responsive" width="100%" alt="Generic placeholder thumbnail">
                            <div class="carousel-caption" >
                                <h3>TITLE <?= $i ?></h3>
                                <p>Aaaaaaaaaaaaaaasdfghjkl;dfghjkl;</p>
                            </div>
                        </div>   
                    <?php } else {
                        ?>
                        <div class="item">
                            <img data-src="holder.js/900x400/auto/vine" class="img-responsive" width="100%" alt="Generic placeholder thumbnail">
                        </div>   
                        <?php
                    }
                }
                ?> 

            </div>
        </div>
    </section>
    <section id="hightlight">
        <div class="container">  
            <div id="owl-hightlight" class="owl-carousel">   
                <!--<div class="ui ten items">-->
                <?php
                for ($i = 0; $i < 10; $i++) {
                    if ($i % 2 == 0) {
                        ?>
                        <div class="ui one items" style="padding: 1%">
                            <div class="item">
                                <!--                                <div class="image">
                                                                    <img data-src="holder.js/900x400/auto/sky" class="img-responsive"  alt="Generic placeholder thumbnail">
                                                                    <a class="star ui corner label">
                                                                        <i class="star icon"></i>
                                                                    </a>
                                                                </div>-->
                                <div class="content">
                                    <div class="name">Cute Dog</div>
                                    <p class="description hidden-xs">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
                                </div>
                            </div>
                        </div>
                    <?php } else {
                        ?>
                        <div class="ui one items" style="margin:  3%">
                            <div class="item">
                                <div class="image">
                                    <img data-src="holder.js/900x400/auto/vine" class="img-responsive"  alt="Generic placeholder thumbnail">
                                    <a class="star ui corner label">
                                        <i class="star icon"></i>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="name">Cute Dog</div>
                                    <p class="description hidden-xs">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
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
        <script>
            $(document).ready(function() {


            });
        </script>
    </section>

    <section id="news" class="main_bg" >
        <div class="title_bg">
            <div class="container">
                <div class="title_top">
                    <h2>ข่าว</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="main">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="row" id="">
                            <div class="caption" >
                                <div class="ui raised segment">
                                    <div class="ui ribbon green label"><h3>ข่าวประชาสัมพันธ์</h3></div>
                                    <br>
                                    <br>
                                    <div class="item">                       
                                        <div class="content">
                                            <div class="date pull-right">
                                                3 days ago
                                            </div>
                                            <img class="ui small left floated image" data-src="holder.js/300x300/auto/vine">
                                            <div class="name">Cute Dog 1</div>
                                            <p class="description hidden-xs">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="item">                       
                                        <div class="content">
                                            <div class="date pull-right">
                                                3 days ago
                                            </div>
                                            <!--<img class="ui small left floated image" data-src="holder.js/300x300/auto/vine">-->
                                            <div class="name">Cute Dog 1</div>
                                            <p class="description hidden-xs">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row"> 
                            <div class="ui compact menu">
                                <a class="item">
                                    <i class="icon mail"></i> Messages
                                    <div class="floating ui red label">22</div>
                                </a>
                                <a class="item">
                                    <i class="icon users"></i> Friends
                                    <div class="floating ui teal label">22</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

    </section>

    <section id="activety">
        <div class="title_bg">
            <div class="container">
                <div class="title_top">
                    <h2>กิจกรรม</h2>
                </div>
            </div>
        </div>  
        <div class="container">
            <div class="main">
                <div class="row">
                    <?php
                    foreach ($activity_types as $type) {
                        if ($type['activity_type_id'] != 0) {
                            $type_id = $type['activity_type_id'];
                            $type_name = $type['activity_type_name'];
                            ?>
                            <div class="col-sm-6">
                                <div class="ui raised segment">
                                    <div class="ui ribbon green label"><h2><?= $type_name ?></h2>
                                    </div>

                                    <div class="demo5 demof">
                                        <ul>
                                            <?php
                                            foreach ($activitys as $row) {
                                                $controller = "Activitys";
                                                $id = $row['activity_id'];
                                                $title = $row['activity_title'];
                                                $subtitle = $row['activity_subtitle'];
                                                $img = $row['image_small'];
                                                $date = $this->m_datetime->DateThai($row['publish_date']);
                                                if ($row['activity_type'] == $type_id && $i != 5) {
                                                    ?>
                                                    <li>
                                                        <!--<img data-src="holder.js/100x100/sky">-->
                                                        <?= img($img, array('class' => 'img-responsive')); ?>
                                                        <a href="<?= base_url('Activitys/view_more/' . $id) ?>">
                                                            <?= $title ?>
                                                        </a>
                                                        <p><?= $subtitle ?></p>
                                                    </li>                                         
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>  
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="pull-right">               
                    <a href="<?= base_url('Activitys/') ?>" class="btn btn-link"><h3>ดูกิจกรรมทั้งหมด...</h3></a>
                </div>
            </div>
        </div>

    </section>

    <section id="kindness" class="main_bg">
        <div class="title_bg">
            <div class="container">
                <div class="title_top">
                    <h2>ผู้ใหญ่ใจดี</h2>
                </div>
            </div>
        </div>  
        <div class="container">            
            <div class="main">
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
                        $i = 0;
                        foreach ($kindness as $row) {
                            $controller = "Kindness";
                            $id_ = $row['kindness_id'];
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
                            if ($i < 4) {
                                ?>
                                <div class="col-md-3 col-sm-6 col-xs-6" style="padding: 0;">
                                    <div class="" >
                                        <div class="ui raised segment">
                                            <div class="ui ribbon green label"><h3 style="margin: 0;"><?= $date ?></h3></div><br>
                                            <br>                                            
                                            <?= img($img, array('width' => '100%',)); ?>

                                            <div class="content">
                                                <div class="name">Faithful Dog</div>
                                                <p class="description hidden-xs">Sometimes its more important to have a dog you know you can trust. But not every dog is trustworthy, you can tell by looking at its smile.</p>
                                                <p><?= anchor($controller . '/view_more/' . $id_, 'ดู... ', $view_more) ?>  </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $i++;
                            }
                        }
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="pull-right">               
                        <a href="<?= base_url('Activitys/') ?>" class="btn btn-link"><h3>ดูผู้ใหญ่ใจดีทั้งหมด...</h3></a>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section id="test">
        <div class="title_bg">
            <div class="container">
                <div class="title_top">
                    <h2>เกี่ยวกับเรา</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <br>
            <br>
            <br>
            <section id="fb">
                <div class="fb-like-box hidden-xs" data-href="https://www.facebook.com/pages/&#xe2a;&#xe16;&#xe32;&#xe19;&#xe04;&#xe38;&#xe49;&#xe21;&#xe04;&#xe23;&#xe2d;&#xe07;&#xe2a;&#xe27;&#xe31;&#xe2a;&#xe14;&#xe34;&#xe20;&#xe32;&#xe1e;&#xe40;&#xe14;&#xe47;&#xe01;&#xe20;&#xe32;&#xe04;&#xe15;&#xe30;&#xe27;&#xe31;&#xe19;&#xe2d;&#xe2d;&#xe01;&#xe40;&#xe09;&#xe35;&#xe22;&#xe07;&#xe40;&#xe2b;&#xe19;&#xe37;&#xe2d;/772339976138959" data-width="1150" data-height="500" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="false"></div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
            </section>
            <div class="main">
                <div class="row">
                    <div class="col-md-3" >
                        <div class="ui one items">
                            <div class="item">
                                <div class="image">
                                    <img src="/images/demo/highres4.jpg">
                                    <a class="star ui corner label">
                                        <i class="star icon"></i>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="name">Cute Dog</div>
                                    <p class="description hidden-xs">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" >
                        <div class="ui one items">
                            <div class="item">
                                <div class="image">
                                    <img src="/images/demo/highres4.jpg">
                                    <a class="star ui corner label">
                                        <i class="star icon"></i>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="name">Cute Dog</div>
                                    <p class="description hidden-xs">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="ui six connected items">-->                
                <div class="row feed">

                    <div class="event">
                        <div class="item">                       
                            <div class="content">
                                <div class="date pull-right">
                                    3 days ago
                                </div>
                                <img class="ui small left floated image" src="/images/demo/photo.jpg">
                                <div class="name">Cute Dog</div>
                                <p class="description hidden-xs">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
                            </div>
                        </div>
                    </div>
                    <div class="ui feed segment">
                        <div class="event">
                            <div class="ui large image label">
                                <img data-src="holder.js/200x200/vine">
                            </div>
                            <div class="content">
                                <div class="date">
                                    3 days ago
                                </div>
                                <div class="name">Schnoodle</div>
                                <div class="description hidden-xs">Im so glad you chose to bring me home from the shelter...</div>
                                <div class="summary">
                                    <a>Sally Poodle</a> added you as a friend
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="item" style="padding-bottom: 2%">
                        <div class="content">
                            <div class="name">Faithful Dog</div>
                            <p class="description hidden-xs">Sometimes its more important to have a dog you know you can trust. But not every dog is trustworthy, you can tell by looking at its smile.</p>
                            <div class="summary">
                                <a>Sally Poodle</a> added you as a friend
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div class="name">Silly Dog</div>
                            <p class="description hidden-xs">Silly dogs can be quite fun to have as companions. You never know what kind of ridiculous thing they will do.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div class="name">Cute Dog</div>
                            <p class="description hidden-xs">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div class="name">Faithful Dog</div>
                            <p class="description hidden-xs">Sometimes its more important to have a dog you know you can trust. But not every dog is trustworthy, you can tell by looking at its smile.</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="content">
                            <div class="name">Silly Dog</div>
                            <p class="description hidden-xs">Silly dogs can be quite fun to have as companions. You never know what kind of ridiculous thing they will do.</p>
                        </div>
                    </div>
                </div>
                <!--</div>-->
            </div>
        </div>
    </section>

</div>
<script>
    $(document).ready(function() {
        $("#owl-1").owlCarousel({
            autoPlay: 5000,
            stopOnHover: true,
            navigation: true,
            paginationSpeed: 1000,
            goToFirstSpeed: 2000,
            singleItem: true,
            //            autoHeight: true,
            transitionStyle: "fade"
        });
        $("#owl-hightlight").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds

            items: 4,
            stopOnHover: true,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [979, 4]
        });
        $('.demo5').easyTicker({
            direction: 'up',
            easing: 'swing',
            speed: 'slow',
            interval: 3000,
            height: 'auto',
            visible: 0,
            mousePause: 1,
        });
    });
</script>








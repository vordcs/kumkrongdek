<div id="mainContent">

    <section id="top_slide"> 
        <!-- Carousel
     ================================================== -->
        <div id="banner_slide" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <!--<li data-target="#banner_slide" data-slide-to="0" class="active"></li>-->
                <?php
                $flag_slide = TRUE;
                foreach ($slides as $row) {
                    if ($flag_slide) {
                        echo '<li data-target="#banner_slide" data-slide-to="' . $row['slide_id'] . '" class="active"></li>';
                        $flag_slide = FALSE;
                    } else {
                        echo '<li data-target="#banner_slide" data-slide-to="' . $row['slide_id'] . '"></li>';
                    }
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $flag_slide = TRUE;
                foreach ($slides as $row) {
                    if ($flag_slide) {
                        echo '<div class="item active">';
                        $flag_slide = FALSE;
                    } else {
                        echo '<div class="item">';
                    }

                    echo img($row['image_small']);
                    echo '<div class="container"><div class="carousel-caption">';
                    echo '<h2>' . $row['slide_title'] . '</h2>';
                    echo '<p>' . $row['slide_subtitle'] . '</p>';
                    if ($row['slide_link'] != NULL || $row['slide_link'] != '') {
                        echo '<div class="read_more_slide pull-right" ><a  href="' . $row['slide_link'] . '" role="button">รายละเอียด</a></div>';
                    }
                    echo '</div></div>';

                    //End item
                    echo '</div>';
                }
                ?>
            </div>
            <a class="left carousel-control" href="#banner_slide" data-slide="prev"><span class=""></span></a>
            <a class="right carousel-control" href="#banner_slide" data-slide="next"><span class="glyphicon"></span></a>
        </div><!-- /.carousel -->

    </section>

    <section id="hightlight">
        <div class="container">  
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
                                <div class="ui ribbon green label" style="padding-right: 5%">
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
                    <div class="col-sm-12 col-sm-offset-0">
                        <?php
                        foreach ($news_type as $type) {
                            ?>                           
                            <div class="caption" >
                                <div class="ui raised segment">
                                    <div class="ui ribbon green label" style="padding-right: 5%;">
                                        <a href="<?= base_url('News/#type' . $type['news_type_id']) ?>" >
                                            <h3><?= $type['news_type_name'] ?></h3>
                                        </a>
                                    </div>
                                    <div class="row" style="padding: 2% 5%">
                                        <div class="ui animated list">
                                            <?php
                                            $i = 0;
                                            foreach ($news as $row) {
                                                $controller = "News";
                                                $id = $row['news_id'];
                                                $title = $row['news_title'];
                                                $subtitle = $row['news_subtitle'];
                                                $content = $row['news_content'];
                                                $type_id = $row['news_type'];
                                                $date = $this->m_datetime->DateThai($row['publish_date']);
                                                $highlight = $row['news_highlight'];
                                                $status = $row['news_status'];
                                                $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
                                                $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];

                                                if ($type_id == $type['news_type_id'] && $i < 5 && $row['publish_date'] <= $this->m_datetime->getDateTodayTH()) {
                                                    ?>
                                                    <div class="item">
                                                        <a href="<?= base_url($controller . '/view_more/' . $id) ?>">
                                                            <i class="fa fa-caret-right"></i>
                                                            <?= $title ?>
                                                        </a>
                                                        <div class="pull-right">
                                                            <small>
                                                                <?= $date ?>  
                                                            </small>                                                            
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>                            
                            </div>                        
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="pull-right">               
                        <a href="<?= base_url('News/') ?>" class="btn btn-link"><h3>ดูข่าวทั้งหมด...</h3></a>
                    </div>
                </div>      
            </div>

    </section>
    <section id="kindness">
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
                    <div class="col-sm-12">
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
                            ?>
                            <div class="ui stackable four items">
                                <?php
//                                for ($j = 0; $j < 5; $j++) {
                                $i = 0;
                                foreach ($kindness as $row) {
                                    $controller = "Kindness";
                                    $id = $row['kindness_id'];
                                    $title_ = $row['kindness_title'];
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
                                        <div class="item">
                                            <div class="image" style="margin: 5%">
                                                <!--<img src="/images/demo/highres5.jpg">-->  
                                                <?= img($img) ?>
                                            </div>
                                            <div class="content">
                                                <div class="name"><?= $title_ ?></div>
                                                <p class="description">
                                                    <?= $subtitle ?>
                                                </p>
                                                <div class="extra">
                                                    <a href="<?= base_url($controller . '/view_more/' . $id) ?>">
                                                        ดูเพิ่ม...
                                                    </a>
                                                </div>
                                                <div class="ui ribbon green label" style="padding-right: 5%">
                                                    <h4 style="margin: 0"><?= $date ?></h4>
                                                </div>
                                            </div>
                                        </div>                                      

                                        <?php
                                        $i++;
                                    }
                                }
                            }
//                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="pull-right">               
                        <a href="<?= base_url('Activitys/') ?>" class="btn btn-link"><h3>ดูผู้ใหญ่ใจดีทั้งหมด...</h3></a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="activety" class="main_bg">
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
                        if ($type['activity_type_id'] != 1) {
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




    <section id="social"> 
        <div class="main">
            <div class="container">
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


            </div>
        </div>
    </section>

</div>
<script>
    $(document).ready(function() {
        $("#owl-1").owlCarousel({
//            items: 1,
            autoPlay: 5000,
            stopOnHover: true,
            navigation: false,
            paginationSpeed: 1000,
            goToFirstSpeed: 2000,
            singleItem: true,
//            autoHeight: true,
            transitionStyle: "fade"
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

        $(window).scroll(function() {
            var pt_scroll = $(this).scrollTop() + 80;
            if (pt_scroll >= $('#mainContent').offset().top) {
                $('#nav_fix_top').removeClass('hidden');
                $('#nav_fix_top').fadeIn();

            } else {
                $('#nav_fix_top').fadeOut();
                $('#nav_fix_top').addClass('hidden');
            }
        });

    });
</script>








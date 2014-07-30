<script type="text/javascript">
    $(document).ready(function() {
        $(".scroll-area").scrollspy({target: "#menu_side"});
        $("#menu_side").on("activate.bs.scrollspy", function() {
            var currentItem = $(".nav li.active > a").text();
            $("#info").empty().html("Currently " + currentItem);
        });

    });
</script>
<div id="mainContent">
    <div id="top-title">
        <div class="title_bg">
            <div class="container">
                <div class="title_top">
                    <a href="<?= base_url('Activitys') ?>">
                        <h2>กิจกรรม</h2>
                    </a>

                </div>                
            </div>
        </div>  
    </div>

    <div id="content" class="container">  
        <div class="row">
            <div class="col-md-3">           
                <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
                    <ul class="nav bs-docs-sidenav list-group" id="menu_side">
                        <?php
                        foreach ($activity_types as $type) {
                            if ($type['activity_type_id'] != 0) {
                                $type_id = $type['activity_type_id'];
                                $type_name = $type['activity_type_name'];
                                ?>
                                <li><a href="#type<?= $type_id ?>" class="list-group-item"><?= $type_name ?></a></li> 
                                <?php
                            }
                        }
                        ?>

                    </ul>
                    <!--<h4 id="info" class="text-info">Currently you are viewing - Section 1</h4>-->
                </div>

            </div>

            <div class="col-md-9 scroll-area" data-spy="scroll" data-offset="0" id="main">      
                <?php
                if (count($activitys) <= 0) {
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
                    foreach ($activity_types as $type) {
                        if ($type['activity_type_id'] != 0) {
                            $type_id = $type['activity_type_id'];
                            $type_name = $type['activity_type_name'];
                            ?>

                            <section id="type<?= $type_id ?>">                                
                                <!--                                    <div class="caption" >-->
                                <div class="ui raised segment">
                                    <div class="ui ribbon pink label" style="padding-right: 40%;"><h2><?= $type_name ?></h2></div>
                                    <br>
                                    <div>
                                        <?php
                                        foreach ($activitys as $row) {
                                            $controller = "Activitys";
                                            $id = $row['activity_id'];
                                            $type = $row['activity_type'];
                                            $title = $row['activity_title'];
                                            $subtitle = $row['activity_subtitle'];
                                            $content = $row['activity_content'];
                                            $image = $row['image_small'];
                                            $date = $this->m_datetime->DateThai($row['publish_date']);
                                            $status = $row['activity_status'];
                                            $images_ = array();
                                            if (count($images_activity) > 0) {
                                                foreach ($images_activity as $img) {
                                                    if ($img['activity_id'] == $id) {
                                                        $temp = array(
                                                            'image_name' => $img['image_name'],
                                                            'image_small' => $img['image_small'],
                                                            'image_full' => $img['image_full'],
                                                            'image_path' => $img['image_path']
                                                        );
                                                        array_push($images_, $temp);
                                                    }
                                                }
                                            }

                                            $view_more = array(
                                                'type' => "button",
                                                'class' => "btn btn-link pull-right",
                                                'style' => "font-size: 0.91em;",
                                            );

                                            if ($type_id == $type) {
                                                ?>
                                                <div class="ui raised segment">
                                                    <div class="ui ribbon gray-light label"><h4><?= $date ?></h4></div>
                                                    <br><br>
                                                    <!--<img class="ui small left floated image" data-src="holder.js/100x100/sky" >-->  
                                                    <?= img($image, array('class' => 'ui small left floated image img-responsive', 'width' => '100%')); ?>

                                                    <div class="name"><?= $title ?></div>
                                                    <div class="description">
                                                        <?= $subtitle ?>


                                                    </div>
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $id ?>">
                                                        รูปภาพ
                                                    </a>
                                                    <div id="collapse<?= $id ?>" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="ui small images">
                                                                <?php
                                                                if (count($images_) > 0) {
                                                                    foreach ($images_ as $row_img) {
                                                                        echo '<a class="fancybox" rel="gallery' . $id . '" href="' . img_url() . $row_img['image_full'] . '"><img src="' . img_url() . $row_img['image_full'] . '"alt="..." class="ui image" ></a>';
                                                                    }
                                                                }
                                                                ?>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ui bottom right attached label">
                                                        <h3 style="margin: 0;">
                                                            <?= anchor($controller . '/view_more/' . $id, 'อ่านเพิ่ม... ', $view_more) ?>  
                                                        </h3>

                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>


                                <!--</div>-->

                            </section>

                            <?php
                        }
                    }
                }
                ?>
            </div>


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
<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            var pt_scroll = $(this).scrollTop() + 80;
            if (pt_scroll >= $('#mainContent').offset().top) {
                $('body').css('padding-top', '60px')
                $('#nav_fix_top').addClass('visible-xs');
                $('#nav_fix_top').removeClass('hidden');
                $('#nav_fix_top').fadeIn();

            } else {
                $('body').css('padding-top', '0px')
                $('#nav_fix_top').fadeOut();
                $('#nav_fix_top').addClass('visible-xs');
                $('#nav_fix_top').addClass('hidden');
            }
        });

    });
</script>






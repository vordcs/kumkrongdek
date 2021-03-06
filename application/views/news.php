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
                    <h2><?= $title ?></h2>
                </div>                
            </div>
        </div>  
    </div>

    <div id="content" class="container" style="min-height: 1000px">  
        <div class="row">
            <div class="col-md-3"> 

                <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
                    <div class="row">
                        <ul class="nav bs-docs-sidenav list-group" id="menu_side">
                            <?php foreach ($news_type_all as $type) { ?>
                                <li><a href="#type<?= $type['news_type_id'] ?>" class="list-group-item"><?= $type['news_type_name'] ?></a></li>  
                            <?php } ?>
                        </ul>
                        <!--<h4 id="info" class="text-info">Currently you are viewing - Section 1</h4>-->
                    </div>
                    <div class="row" style="padding-top: 3%;">

                        <?php echo $form['form']; ?>
                        <div class="form-group">   
                            <?php echo $form['type']; ?>    
                        </div>                         
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></div>
                                <?= $form['date'] ?>
                            </div>
                        </div>
                        <div class="pull-right"> 
                            <button type="submit" name="btn_search" class="btn btn-default"><h3 style="margin: 0px"><i class="fa fa-search"></i>&nbsp;&nbsp;ค้นหา</h3></button>
                        </div>
                        <?php echo form_close() ?>

                    </div>
                </div>

                <div class="row visible-xs" style="padding-top: 3%;">
                    <div class="col-xs-10 col-xs-offset-1">
                        <?php echo $form['form']; ?>
                        <div class="form-group">   
                            <?php echo $form['type']; ?>    
                        </div>                         
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></div>
                                <?= $form['date'] ?>
                            </div>
                        </div>
                        <div class="pull-right"> 
                            <button type="submit" name="btn_search" class="btn btn-default"><h3 style="margin: 0px"><i class="fa fa-search"></i>&nbsp;&nbsp;ค้นหา</h3></button>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>


            </div>
            <div class="col-md-9 scroll-area" data-spy="scroll" data-offset="0" id="main"> 
                <?php if (count($news) <= 0) { ?>
                    <div class="well">        
                        <h3>
                            <p class="text-center" style="padding: 2% ;">
                                ไม่พบข่าว
                            </p>
                        </h3>        
                    </div>
                    <?php
                } else {
                    foreach ($news_type as $t) {
                        $type_name = $t['news_type_name'];
                        $type_id = $t['news_type_id'];
                        ?>
                        <section id="type<?= $type_id ?>">  
                            <!--<div class="col-sm-10 col-sm-offset-1">-->
                            <div class="ui raised segment">
                                <div class="ui ribbon pink label" style="padding-right: 40%;"><h2><?= $type_name ?></h2>
                                </div>
                                <div class="row">
                                    <div class="ui raised segment">
                                        <?php
                                        foreach ($news as $row) {
                                            $controller = "News";
                                            $id = $row['news_id'];
                                            $title = $row['news_title'];
                                            $subtitle = $row['news_subtitle'];
                                            $content = $row['news_content'];
                                            $date = $this->m_datetime->DateThai($row['publish_date']);
                                            $status = $row['news_status'];

                                            if ($row['news_type'] == $type_id) {
                                                ?>                                      

                                                <div class="ui ribbon gray-light label">
                                                    <h3 style="margin: 0;"><?= $date ?></h3>
                                                </div>                                           
                                                <div class="ui animated list">
                                                    <div class="item">
                                                        <?php
                                                        if ($row['image_small'] != NULL) {
                                                            ?>
                                                                                                        <!--<img class="ui image img-rounded img-responsive" data-src="holder.js/100x100/auto/vine">-->
                                                            <?= img($row['image_small'], array('class' => 'ui image img-rounded img-responsive img-responsive', 'width' => '100px', 'height' => '100px')); ?>
                                                        <?php } ?>
                                                        <div class="content" style="width:75%">
                                                            <div class="header"><?= $title ?></div>
                                                            <?= $subtitle ?>
                                                            <br>
                                                            <?php
//                                                            echo $row['publish_date'] . '   ' . $this->m_datetime->getDateTodayTH();
                                                            ?>
                                                            <p class="pull-right">
                                                                <a href="<?= base_url($controller . '/view_more/' . $id) ?>">
                                                                    อ่าน... 
                                                                </a>                                                            
                                                            </p>
                                                        </div>
                                                    </div>                                                                   
                                                </div>  

                                                <?php
                                            }
                                        }
                                        ?>
                                    </div> 
                                </div>       
                        </section>

                        <?php
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


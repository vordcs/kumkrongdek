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
                    <h2>กิจกรรม</h2>
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
                                <li><a href="#type <?= $type_id ?>" class="list-group-item"><?= $type_name ?></a></li> 
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <h4 id="info" class="text-info">Currently you are viewing - Section 1</h4>
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
                    //    for ($i = 0; $i < 5; $i++) {
                    foreach ($activity_types as $type) {
                        if ($type['activity_type_id'] != 0) {
                            $type_id = $type['activity_type_id'];
                            $type_name = $type['activity_type_name'];
                            ?>
                            <section id="type <?= $type_id ?>">
                                <h2 class="ui red color label"><?= $type_name ?></h2>
                                <?php
                                foreach ($activitys as $row) {
                                    $controller = "Activitys";
                                    $id = $row['activity_id'];
                                    $title = $row['activity_title'];
                                    $subtitle = $row['activity_subtitle'];
                                    $content = $row['activity_content'];
                                    $date = $this->m_datetime->DateThai($row['publish_date']);
                                    $img = $row['image_small'];
                                    $status = $row['activity_status'];

                                    $view_more = array(
                                        'type' => "button",
                                        'class' => "btn btn-link pull-right",
                                        'style' => "font-size: 0.91em;",
                                    );

                                    if ($row['activity_type'] == $type_id) {
                                        ?>
                                        <div class="col-md-12 col-xs-12">
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
                                                                <div class="name">Faithful Dog</div>
                                                                <p class="description">Sometimes its more important to have a dog you know you can trust. But not every dog is trustworthy, you can tell by looking at its smile.</p>
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
                            </section>
                            <?php
                        }
                    }
                }
                ?>
            </div>

        </div>      
    </div>
</div>





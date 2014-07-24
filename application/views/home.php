<?php

function DateThai($strDate) {
    if ($strDate == NULL) {
        return '-';
    } else {
        $date = new DateTime($strDate);
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "มกราคม.", "กุมภาพันธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }
}
?>

<div id="mainContent">
    <section id="slide">
        <div class="container">
            <div id="owl-1" class="owl-carousel">
                <?php
                foreach ($slides as $slide) {
                    $title = $slide['slide_title'];
                    $img = $slide['image_small'];
                    ?>
                    <div class="slide-item">
                        <!--<img data-src="holder.js/900x400/auto/sky" width="100%" alt="...">-->
                        <?= img($img, array('alt' => 'Image slide')); ?>                        
                        <div class="title-slide">
                            <h3><?= $title ?></h3>
                            Aaaaaaaaaaaaaaasdfghjkl;dfghjkl;  
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
            <div id="owl-demo" class="owl-carousel">   
                <?php
                for ($i = 0; $i < 10; $i++) {
                    if ($i % 2 == 0) {
                        ?>
                        <div class="item" >
                            <div class="image">
                                <img data-src="holder.js/900x400/auto/sky" class="img-responsive"  alt="Generic placeholder thumbnail">   
                                <!--                                <a class="like ui corner label">
                                                                    <i class="like icon"></i>
                                                                </a>-->
                            </div>
                            <div class="content">
                                <div class="name">Cute Dog</div>                               
                                <div class="pull-right">
                                    <a href="#" class="btn btn-link">
                                        199 votes
                                    </a>

                                </div>
                            </div>
                        </div>   
                    <?php } else {
                        ?>
                        <div class="item">
                        <div class="image">
                            <img data-src="holder.js/900x400/auto/vine" class="img-responsive"  alt="Generic placeholder thumbnail">
                        </div>
                        <div class="content">
                            <div class="name">Cute Dog</div>                               
                            <div class="pull-right">
                                <a href="#" class="btn btn-link">
                                    100 votes
                                </a>
                            </div>
                        </div>
                        </div>

                            
                    <?php
                }
            }
            ?> 

        </div>           
</div>
<script>
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds

            items: 5,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [979, 4]
        });

    });
</script>
</section>

<section id="news">

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
        <div class="row">
            <?php
            foreach ($activity_types as $type) {
                if ($type['activity_type_id'] != 0) {
                    $type_id = $type['activity_type_id'];
                    $type_name = $type['activity_type_name'];
                    ?>
                    <div class="col-sm-6">
                        <h2><?= $type_name ?></h2>
                        <div class="ticker">
                            <ul>
                                <?php
                                foreach ($activitys as $row) {
                                    $controller = "Activitys";
                                    $id = $row['activity_id'];
                                    $title = $row['activity_title'];
                                    $subtitle = $row['activity_subtitle'];
                                    $img = $row['image_small'];
                                    $date = DateThai($row['publish_date']);
                                    if ($row['activity_type'] == $type_id && $i != 5) {
                                        ?>

                                        <li>
                                            <!--<img data-src="holder.js/100x100/sky">-->
                                            <?= img($img, array('class' => 'img-responsive')); ?>
                                            <h3><?= $title ?></h3>
                                            <p><?= $subtitle ?></p>
                                            <a href="#">ดู..</a>
                                        </li>                                         
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>  
                            </ul>
                        </div>
                    </div>

                    <?php
                }
            }
            ?>
        </div>
        <div class="row">
            <div class="pull-right">               
                <a href="#" class="btn btn-link"><h3>ดูกิจกรรมทั้งหมด...</h3></a>
            </div>
        </div>
    </div>      
</section>
<section id="kindness">
</section>



<section id="test">
    <div class="title_bg">
        <div class="container">
            <div class="title_top">
                <h2>เกี่ยวกับเรา</h2>
            </div>
        </div>
    </div>
</section>

</div>
<script>
    $(document).ready(function() {
        $("#owl-1").owlCarousel({
            autoPlay: 3000,
            stopOnHover: true,
            navigation: true,
            paginationSpeed: 1000,
            goToFirstSpeed: 2000,
            singleItem: true,
            //            autoHeight: true,
            transitionStyle: "fade"
        });
        $('.ticker').easyTicker({
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








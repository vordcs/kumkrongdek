<div id="mainContent">
    <div id="top-title">
        <div class="title_bg">
            <div class="container">
                <div class="title_top">
                    <h2>บุคลากร</h2>
                </div>
            </div>
        </div>  
    </div>

    <div id="content" class="container">
        <div class="row">
            <div class="col-md-3 hidden-xs">           
                <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
                    <ul class="nav bs-docs-sidenav list-group" id="menu_side">
                        <li><a href="#per" class="list-group-item">บุคลากร</a></li>
                        <li><a href="#all" class="list-group-item">ฝ่ายบริหาร</a></li>
                        <li><a href="#a" class="list-group-item">ฝ่ายสวัสดิการสงเคราะห์</a></li>
                        <li><a href="#b" class="list-group-item">ฝ่ายแผนงานและโครงการ</a></li>
                        <li><a href="#c" class="list-group-item">ฝ่ายบริหารงานสงเคราะห์</a></li>
                    </ul>
                    <!--<h4 id="info" class="text-info">Currently you are viewing - Section 1</h4>-->
                </div>

            </div>
            <div class="col-md-7 col-xs-12 scroll-area" data-spy="scroll" data-offset="0" id="main">   

                <div class="main_bg" >
                    <section id="per">
                        <?php
                        $img_propr = array(
                            'class' => 'img-responsive',
                            'width' => '100%'
                                )
                        ?>
                        <?= img('per.png', $img_propr); ?>
                    </section>
                </div>

                <div class="main_bg" >
                    <section id="all">
                        <?php
                        $img_propr = array(
                            'class' => 'img-responsive',
                            'width' => '100%'
                                )
                        ?>
                        <?= img('all.png', $img_propr); ?>
                    </section>
                </div>

                <div class="main_bg" >
                    <section id="a">
                        <?php
                        $img_propr = array(
                            'class' => 'img-responsive',
                            'width' => '100%'
                                )
                        ?>
                        <?= img('a.png', $img_propr); ?>
                    </section>
                </div>

                <div class="main_bg" >    
                    <section id="b">
                        <?php
                        $img_propr = array(
                            'class' => 'img-responsive',
                            'width' => '100%'
                                )
                        ?>
                        <?= img('b.png', $img_propr); ?>
                    </section>
                </div>

                <div class="main_bg" >    
                    <section id="c">
                        <?php
                        $img_propr = array(
                            'class' => 'img-responsive',
                            'width' => '100%'
                                )
                        ?>
                        <?= img('c.png', $img_propr); ?>
                    </section>
                </div>    

            </div>
            <div class="col-md-2 hidden-xs">
                <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab" height="140" width="130"><param name="movie" value="http://www.thlive.com/wp-content/uploads/file/clockcalendarwhite.swf" /><param name="quality" value="high" /><embed height="140" pluginspage="http://www.macromedia.com/go/getflashplayer" quality="high" src="http://www.thlive.com/wp-content/uploads/file/clockcalendarwhite.swf" type="application/x-shockwave-flash" width="130"></embed></object><br/><a href="http://www.thlive.com/code" target="_blank"></a>
                <h2>ลิงค์ภายใน</h2>
                <div class="">
                    <a href="http://www.m-society.go.th/" >
                        <?php
                        $img_propr = array(
                            'class' => 'img-responsive',
                            'width' => '100%'
                                )
                        ?>
                        <?= img('/foot_logo/l13.gif', $img_propr); ?>

                    </a>
                </div>

                <div class="">
                    <a href="http://www.bsws.go.th/index.php" >
                        <?php
                        $img_propr = array(
                            'class' => 'img-responsive',
                            'width' => '100%'
                                )
                        ?>
                        <?= img('/foot_logo/l14.gif', $img_propr); ?>

                    </a>
                </div>

                <div class="">
                    <a href="http://www.wandc.dsdw.go.th/home.html" >
                        <?php
                        $img_propr = array(
                            'class' => 'img-responsive',
                            'width' => '100%'
                                )
                        ?>
                        <?= img('/foot_logo/l15.gif', $img_propr); ?>

                    </a>
                </div>

                <div class="">
                    <a href="http://www.osccthailand.go.th/Front/" >
                        <?php
                        $img_propr = array(
                            'class' => 'img-responsive',
                            'width' => '100%'
                                )
                        ?>
                        <?= img('/link/logo4.gif', $img_propr); ?>

                    </a>
                </div>



            </div>
        </div>
    </div>
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
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
            <div class="col-md-3">           
                <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
                    <ul class="nav bs-docs-sidenav list-group" id="menu_side">
                        <li><a href="#per" class="list-group-item">บุคลากร</a></li>
                        <li><a href="#all" class="list-group-item">ฝ่ายบริหาร</a></li>
                        <li><a href="#a" class="list-group-item">ฝ่ายสวัสดิการสงเคราะห์</a></li>
                        <li><a href="#b" class="list-group-item">ฝ่ายแผนงานและโครงการ</a></li>
                        <li><a href="#c" class="list-group-item">ฝ่ายบริหารงานสงเคราะห์</a></li>
                    </ul>
                    <h4 id="info" class="text-info">Currently you are viewing - Section 1</h4>
                </div>

            </div>
            <div class="col-md-7 scroll-area" data-spy="scroll" data-offset="0" id="main">   

                <div class="main_bg" >
                    <section id="per">
                    <?php 
                    $img_propr = array(
                        'class'=>'img-responsive',
                        'width'=>'100%'
                    )
                    ?>
                    <?=  img('per.png',$img_propr); ?>
                </section>
                </div>
                
                <div class="main_bg" >
                <section id="all">
                    <?php 
                    $img_propr = array(
                        'class'=>'img-responsive',
                        'width'=>'100%'
                    )
                    ?>
                    <?=  img('all.png',$img_propr); ?>
                </section>
                </div>
                
                <div class="main_bg" >
                <section id="a">
                    <?php 
                    $img_propr = array(
                        'class'=>'img-responsive',
                        'width'=>'100%'
                    )
                    ?>
                     <?=  img('a.png',$img_propr); ?>
                </section>
                </div>
                
                <div class="main_bg" >    
                <section id="b">
                    <?php 
                    $img_propr = array(
                        'class'=>'img-responsive',
                        'width'=>'100%'
                    )
                    ?>
                     <?=  img('b.png',$img_propr); ?>
                </section>
                </div>
                
                <div class="main_bg" >    
                <section id="c">
                    <?php 
                    $img_propr = array(
                        'class'=>'img-responsive',
                        'width'=>'100%'
                    )
                    ?>
                      <?=  img('c.png',$img_propr); ?>
                </section>
                </div>    
                
            </div>
            

            
        </div>
    </div>
</div>

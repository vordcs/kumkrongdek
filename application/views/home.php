<div id="mainContent">
    <section id="slide">
        <div class="container">
            <div id="owl-1" class="owl-carousel owl-theme">
                <div class="item">
                    <img data-src="holder.js/900x400/auto/sky" width="100%" alt="...">
                    <div class="carousel-caption">
                        <h3>TITLE</h3>
                        <p>Aaaaaaaaaaaaaaasdfghjkl;dfghjkl;</p>
                    </div>
                </div>
                <?php
                for ($i = 0; $i < 2; $i++) {
                    if ($i % 2 == 0) {
                        ?>
                        <div class="item">
                            <img data-src="holder.js/900x400/auto/sky" class="img-responsive" width="100%" alt="Generic placeholder thumbnail">
                            <div class="carousel-caption">
                                <h3>TITLE <?=$i?></h3>
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

    </section>

    <section id="news">

    </section>

    <section id="activety">

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
        <div id="content" class="container">

        </div>

    </section>

</div>









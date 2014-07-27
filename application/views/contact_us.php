<div id="mainContent">
    <div id="top-title">
        <div class="title_bg">
            <div class="container">
                <div class="title_top">
                    <h2>ติดต่อเรา</h2>
                </div>
            </div>
        </div>  
    </div>

    <div id="content" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="height: 400px">

                <section id="info" class="box-contact_us">
                    <div class="col-md-6">
                        <address>
                            <strong><h3>สถานคุ้มครองสวัสดิภาพเด็กฯ<br>จังหวัดขอนแก่น</h3></strong>
                            <br>36 หมู่ 9 ตำบลโคกสูง   อำเภออุบลรัตน์    
                            <br>จังหวัดขอนแก่น  40250
                            <br>
                            <abbr title="Phone"><i class="fa fa-phone"></i></abbr> 043-421251 <br>
                            <abbr title="Fax"><i class="fa fa-fax"></i></abbr> 043-421200 
                        </address>
                        <address>
                            <strong>E-Mail</strong><br>
                            <a href="mailto:#">Security8899@hotmail.com</a>
                        </address>
                    </div>
                    <div class="col-md-2">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3850.1267029153164!2d102.70644945498965!3d16.680972682091138!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31225a23daf013a3%3A0x5ac8ff633b774b1c!2z4Liq4LiW4Liy4LiZ4LiE4Li44LmJ4Lih4LiE4Lij4Lit4LiH4Liq4Lin4Lix4Liq4LiU4Li04Lig4Liy4Lie4LmA4LiU4LmH4LiB4Lig4Liy4LiE4LiV4Liw4Lin4Lix4LiZ4Lit4Lit4LiB4LmA4LiJ4Li14Lii4LiH4LmA4Lir4LiZ4Li34Lit!5e1!3m2!1sth!2sth!4v1406205313414" width="300" height="300" frameborder="0" style="border:0"></iframe>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <section id="fb" class="box-contact_us">
                    <div class="fb-like-box" data-href="https://www.facebook.com/pages/&#xe2a;&#xe16;&#xe32;&#xe19;&#xe04;&#xe38;&#xe49;&#xe21;&#xe04;&#xe23;&#xe2d;&#xe07;&#xe2a;&#xe27;&#xe31;&#xe2a;&#xe14;&#xe34;&#xe20;&#xe32;&#xe1e;&#xe40;&#xe14;&#xe47;&#xe01;&#xe20;&#xe32;&#xe04;&#xe15;&#xe30;&#xe27;&#xe31;&#xe19;&#xe2d;&#xe2d;&#xe01;&#xe40;&#xe09;&#xe35;&#xe22;&#xe07;&#xe40;&#xe2b;&#xe19;&#xe37;&#xe2d;/772339976138959" data-width="650" data-height="600" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="false"></div>
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

            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            var pt_scroll = $(this).scrollTop() + 80;
            if (pt_scroll >= $('#mainContent').offset().top) {
//            $('body').css('padding-top', '60px')
                $('#nav_fix_top').removeClass('hidden');
                $('#nav_fix_top').fadeIn();

            } else {
//            $('body').css('padding-top', '0px')
                $('#nav_fix_top').fadeOut();
                $('#nav_fix_top').addClass('hidden');
            }
        });

    });
</script>

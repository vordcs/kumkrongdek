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
                    <h2>เกี่ยวกับเรา</h2>
                </div>                
            </div>
        </div>  
    </div>

    <div id="content" class="container">  
        <div class="row">
            <div class="col-md-3">           
                <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
                    <ul class="nav bs-docs-sidenav list-group" id="menu_side">
                        <li><a href="#history" class="list-group-item">ประวัติความเป็นมา</a></li>
                        <li><a href="#vison" class="list-group-item">วิสัยทัศน์</a></li>
                        <li><a href="#popularity" class="list-group-item">ค่านิยม</a></li>
                        <li><a href="#culture" class="list-group-item">วัฒนธรรม</a></li>
                        <li><a href="#philosophy" class="list-group-item">ปรัชญา</a></li>
                        <li><a href="#objective" class="list-group-item">วัตถุประสงค์</a></li>
                        <li><a href="#relate" class="list-group-item">การดำเนินงาน</a></li>
                        <li><a href="#t1" class="list-group-item">เด็กที่ได้รับการสงเคราะห์</a></li>
                        <li><a href="#t2" class="list-group-item">การนำเด็กเข้ารับการสงเคราะห์</a></li>
                    </ul>
                    <h4 id="info" class="text-info">Currently you are viewing - Section 1</h4>
                </div>

            </div>
            <div class="col-md-7 col-sm-9 scroll-area " data-spy="scroll" data-offset="0" id="main">      
                <div class="row" id="history">
                    <div class="caption" >
                        <div class="ui raised segment">
                            <div class="ui ribbon pink label"><h2>ประวัติความเป็นมา</h2></div><br>
                            <br>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานคุ้มครองสวัสดิภาพเด็กภาคตะวันออกเฉียงเหนือ จังหวัดขอนแก่น สังกัดสำนักคุ้มครองสวัสดิภาพหญิงและเด็ก กรมพัฒนาสังคมและสวัสดิการ  กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์   จัดตั้งขึ้นตามประกาศคณะปฏิวัติ  ฉบับที่ 294  ลงวันที่  27  พฤศจิกายน  2515  เพื่อคุ้มครองสวัสดิภาพเด็ก ที่มีความประพฤติที่ไม่สมควรแก่วัย เช่นเร่ร่อนขอทาน  เด็กที่ได้รับการเลี้ยงดูไม่เหมาะสม ถูกทารุณทำร้าย ทั้งร่างกายและจิตใจ สถานคุ้มครองสวัสดิภาพเด็กภาคตะวันออกเฉียงเหนือ  จังหวัดขอนแก่น  เปิดดำเนินการเมื่อวันที่  19  มิถุนายน  2518  สังกัดกองสงเคราะห์เด็กและบุคคลวัยรุ่น กรมประชาสงเคราะห์   บนเนื้อที่  65  ไร่  ห่างจากตัวจังหวัดขอนแก่น  36  กิโลเมตร และปัจจุบันสถานคุ้มครองสวัสดิภาพเด็กภาคตะวันออกเฉียงเหนือ จังหวัดขอนแก่น  ดำเนินงานโดยยึดถือพระราชบัญญัติคุ้มครองเด็ก พ.ศ. 2546 เป็นแนวทางการปฏิบัติงาน
                            </p>
                        </div>
                    </div>
                </div>  


                <div class="row" id="vison">
                    <div class="caption" >
                        <div class="ui raised segment">
                            <div class="ui ribbon pink label"><h2>วิสัยทัศน์</h2></div><br>
                            <br>
                            <p align="center">เป็นหน่วยงานที่ให้การคุ้มครองสวัสดิภาพและบริการ</p>
                            <p align="center">สวัสดิการทางสังคมแก่กลุ่มเป้าหมายที่ได้มาตรฐาน</p>
                            <p align="center">โดยทำงานเชิงบูรณาการร่วมกับภาคีเครือข่าย</p>
                            <p align="center">และเป็นศูนย์การเรียนรู้สู่ชุมชน</p>
                        </div>
                    </div>
                </div>

                <div class="row" id="popularity">
                    <div class="caption" >
                        <div class="ui raised segment">
                            <div class="ui ribbon pink label"><h2>ค่านิยม</h2></div><br>
                            <br>
                            <p align="center">เสียสละ สามัคคี มีวินีย ใฝ่คุณธรรม นำพัฒนา</p>
                        </div>
                    </div>
                </div>

                <div class="row" id="culture">
                    <div class="caption" >
                        <div class="ui raised segment">
                            <div class="ui ribbon pink label"><h2>วัฒนธรรม</h2></div><br>
                            <br>
                            <p align="center">จิตมุ่งบริการ วาจาไพเราะ แต่งกายสุภาพ</p>
                        </div>
                    </div>
                </div>

                <div class="row" id="philosophy">
                    <div class="caption" >
                        <div class="ui raised segment">
                            <div class="ui ribbon pink label"><h2>ปรัชญา</h2></div>
                            <br><br>
                            <p align="center">รักเหมือนลูก ผูกสัมพันธ์</p>
                        </div>
                    </div>
                </div>

                <div class="row" id="objective">
                    <div class="caption" >
                        <div class="ui raised segment">
                            <div class="ui ribbon pink label"><h2>วัตถุประสงค์</h2></div>
                            <br><br>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. เพื่อให้การสงเคราะห์และคุ้มครองสวัสดิภาพแก่เด็กชายอายุ  6-18  ปี  ที่ประสบปัญหาครอบครัว ปัญหาความประพฤติ  ปัญหาที่เกิดจากการเปลี่ยนแปลงของสังคม  เช่น  เร่ร่อน  พลัดหลง  ถูกทารุณกรรมทั้งร่างกายและจิตใจ เด็กที่ได้รับการเลี้ยงดูไม่เหมาะสม  ถูกปล่อยปละละเลย  เด็กที่เสี่ยงต่อการกระทำผิดและเด็กที่อยู่ในสภาพที่จะต้องได้รับการคุ้มครองสวัสดิภาพ   ตามพระราชบัญญัติคุ้มครองสวัสดิภาพเด็ก  พ.ศ.2546 </p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. เพื่อส่งเสริมให้เด็กได้รับการศึกษา  อบรม  เพื่อแก้ไขความประพฤติ  รวมทั้งบำบัดรักษาและฟื้นฟูสมรรถภาพทั้งทางร่างกายและจิตใจ</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. เพื่อส่งเสริมให้เด็กมีวิชาชีพ  ได้รับการฝึกวิชาชีพตามความสามารถ ความถนัด  เรียนรู้การประกอบอาชีพสุจริต  มีนิสัยรักการทำงาน  และเตรียมความพร้อมที่จะใช้ชีวิตในสังคมได้และประสบความสำเร็จภายหลังพ้นจากการอุปการะแล้ว</p>
                        </div>
                    </div>
                </div>

                <div class="row" id="relate">
                    <div class="caption" >
                        <div class="ui raised segment">
                            <div class="ui ribbon pink label"><h2>การดำเนินงาน</h2></div>
                            <br><br>
                            <p>1. บริการด้านการเลี้ยงดู</p>
                            <ul>
                                <p>1.1  จัดที่อยู่อาศัย  อาหาร  เครื่องนุ่งห่ม  ยารักษาโรคและเครื่องใช้จำเป็นแก่เด็ก โดยมีพ่อบ้านประจำอาคารพัก  1   คน  ต่อเด็ก  20  คน  ทำหน้าที่ดูแลอย่างใกล้ชิด  ให้ความรักความอบอุ่น  ให้คำปรึกษาแนะนำแก่เด็กเหมือนบิดามารดาจริง1.1  จัดที่อยู่อาศัย  อาหาร  เครื่องนุ่งห่ม  ยารักษาโรคและเครื่องใช้จำเป็นแก่เด็ก โดยมีพ่อบ้านประจำอาคารพัก  1   คน  ต่อเด็ก  20  คน  ทำหน้าที่ดูแลอย่างใกล้ชิด  ให้ความรักความอบอุ่น  ให้คำปรึกษาแนะนำแก่เด็กเหมือนบิดามารดาจริง</p>
                                <p>1.2  จัดเลี้ยงอาหารวันละ  3  เวลา</p>
                            </ul>
                            <p>2.  บริการด้านการรักษาพยาบาลและอนามัย</p>
                            <ul>
                                <p>2.1  ตรวจสุขภาพเป็นประจำทุกเดือน </p>
                                <p>2.2  สร้างภูมิคุ้มกันโรค  โดยฉีดวัคซีนป้องกันโรคระบาดต่าง ๆ</p>
                                <p>2.3  ให้ความรู้ด้านสุขศึกษาและอนามัย</p>
                                <p>2.4  รักษาพยาบาลเมื่อเด็กเจ็บป่วยและประสานงานกับทางโรงพยาบาล</p>
                            </ul>
                            <p>3.  บริการด้านการศึกษาวิชาสามัญ</p>
                            <ul>
                                <p>3.1  เรียนภายนอกสถานสงเคราะห์</p>
                                <ul>
                                    <p>3.1.1  ให้การศึกษาสายสามัญภาคบังคับ  ชั้น ป.1 – ม. 3</p>
                                    <p>3.1.2  ส่งเสริมให้เด็กที่มีความประพฤติดีและอยู่ในเกณฑ์การเรียนดี  ไปศึกษาต่อในระดับที่สูงขึ้น</p>	
                                    <p>3.1.3  จัดหาทุนการศึกษาให้แก่เด็กที่มีความประพฤติดีและเรียนดี</p>
                                </ul>
                                <p>3.2  เรียนภายในสถานสงเคราะห์</p>
                                <ul>
                                    <p>3.2.1  ให้การศึกษาทบทวนความรู้ระดับประถมแก่เด็กที่ไม่รู้หนังสือ หรือ เด็กที่ไม่จบ   การศึกษาภาคบังคับ</p>
                                </ul>
                                <p>3.3  การศึกษาภายนอกโรงเรียน</p>
                            </ul>
                            <p>4. บริการฝึกอบรมวิชาชีพจัดให้มีการฝึกวิชาชีพเพื่อให้เด็กมีวิชาชีพพื้นฐาน  และเพื่อปรับเปลี่ยนพฤติกรรมและพัฒนานิสัยการทำงานที่ดี รวม  7  สาขา   ได้แก่   ช่างไม้   ช่างโลหะ   ช่างไฟฟ้า   ช่างซ่อมเครื่องยนต์   ช่างตัดเย็บเสื้อผ้าชาย  ช่างตัดผมชาย  และเกษตรกรรม   จัดให้มีการศึกษาดูงานและฝึกงานภายนอก  เพื่อเพิ่มทักษะและประสบการณ์</p>
                            <p>5. บริการด้านสังคมสงเคราะห์และจิตวิทยา</p>
                            <p>ดำเนินการตามหลักวิชาการสังคมสงเคราะห์และจิตวิทยา  วิเคราะห์ปัญหา  แนวทางแก้ไข  และพัฒนาปรับเปลี่ยนพฤติกรรม  เช่น  จัดประชุมกลุ่มเด็ก (Group Meeting)  หรือ  ประชุมผู้เกี่ยวข้อง  เพื่อพิจารณาแก้ไขปัญหาเด็ก (Case Conference)</p>
                            <p>6. บริการด้านนันทนาการ</p>
                            <ul>
                                <p>จัดกิจกรรมเพื่อให้เกิดความสนุกสนานเพลิดเพลิน  ใช้เวลาว่างให้เป็นประโยชน์  ผ่อนคลายความเครียด  พักผ่อนด้านจิตใจ  เช่น  ดนตรี  กีฬา  ศิลปะ  ทัศนศึกษา  ค่ายพักแรม ฯลฯ</p>
                            </ul>
                            <p>7. บริการด้านพัฒนาจิตใจและวินัย</p>
                            <ul>
                                <p>7.1  จัดกิจกรรมส่งเสริมพุทธศาสนา  จริยธรรม  ประเพณีและวัฒนธรรมไทย  การอบรมระเบียบวินัย</p>
                                <p>7.2  จัดเจ้าหน้าที่ผู้มีความเหมาะสมจากทุกฝ่ายอบรมประจำสัปดาห์</p>
                            </ul>
                            <p>8.บริการจัดหางาน</p>
                            <ul>
                                <p>8.1  เตรียมความพร้อมแก่เด็กที่สำเร็จหลักสูตรแนะแนวการประกอบอาชีพ</p>
                                <p>8.2  ติดต่อหางานให้เด็กที่สำเร็จหลักสูตรแล้ว</p>
                            </ul>
                            <p>9.  บริการติดตามผล</p>
                            <ul>
                                <p>หลังจากที่เด็กพ้นการสงเคราะห์ไปแล้ว  จะติดตามผลโดยการเยี่ยมบ้าน  ในกรณีที่ภูมิลำเนาของเด็กอยู่ในเขตใกล้เคียง  เพื่อทราบข้อมูลเกี่ยวกับการประกอบอาชีพ  รายได้  ปัญหา  สภาพความเป็นอยู่ทั่ว ๆ ไป</p>
                            </ul>
                            <p>10. บริการด้านการคุ้มครองสวัสดิภาพเด็ก</p>
                            <ul>
                                <p>รณรงค์ป้องกันปัญหาเด็ก  เสริมสร้างประสบการณ์ชีวิตให้แก่เด็กด้อยโอกาสและเด็กกลุ่มเสี่ยง  โดยให้คำแนะนำ   ปรึกษาปัญหาเด็กและครอบครัว   ประสานงานในรูปของเครือข่าย  องค์กร  เพื่อเด็กและเยาวชน  </p>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row" id="t1">
                    <div class="caption" >
                        <div class="ui raised segment">
                            <div class="ui ribbon pink label"><h2>เด็กที่ได้รับการสงเคราะห์ และคุ้มครองสวัสดิภาพ</h2></div>
                            <br><br>
                            <p>เป็นเด็กชาย อายุ 7-18 ปี ที่มีลักษณะดังนี้</p>
                            <ul>
                                <p>1. เด็กที่มีปัญหาความประพฤติ</p>
                                <p>2. เด็กที่ประพฤติตนไม่เหมาะสมแก่วัย</p>
                                <p>3. เด็กที่ได้รับการเลี้ยงดูที่ไม่เหมาะสม เช่น ถูกทำร้ายทารุณทั้งร่างกาย จิตใจและทางเพศ ใช้แรงงานเด็ก หรือแสวงหาผลประโยชน์</p>
                                <p>4. เด็กที่ประสบปัญหายากจนและขาดแคลน</p>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row" id="t2">
                    <div class="caption" >
                        <div class="ui raised segment">
                            <div class="ui ribbon pink label"><h2>การนำเด็กเข้ารับการสงเคราะห์หรือคุ้มครองสวัสดิภาพ</h2></div>
                            <<br><br>
                            <p>1. กรุงเทพมหานคร ติดต่อที่สำนักงานคุ้มครองสวัสดิภาพหญิงและเด็ก</p>
                            <p>2. สถานคุ้มครองสวัสดิภาพเด็กภาคตะวันออกเฉียงเหนือจังหวัดขอนแก่น เลขที่ 36 หมู่ที่ 9 ตำบลโคกสูง อำเภออุบลรัตน์ จังหวัดขอนแก่น 40250 โทร 043-421251</p>
                            <p>3. ต่างจังหวัด ติดต่อสำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด ทุกจังหวัด</p>
                            <p>4. หลักฐานเกี่ยวกับเด็ก เพื่อความสะดวกในการติดต่อกรุณานำหลักฐานเกี่ยวกับตัวเด็ก เช่น สำเนาทะเบียนบ้าน รูปถ่าย ใบแสดงผลการเรียนเป็นต้น</p>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-2 visible-lg">
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

            <br>

        </div>

    </div>

    <div class="container" data-spy="scroll" data-offset="0" hidden>
        <div class="row">
            <div class="ui four items">
                <div class="item">
                    <div class="content">
                        <div class="meta">2 days ago</div>
                        <div class="name">Cute Dog</div>
                        <p class="description">This dog has some things going for it. Its pretty cute and looks like it'd be fun to cuddle up with.</p>
                    </div>
                    <div class="extra">
                        199 votes
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="meta">5 days ago</div>
                        <div class="name">Faithful Dog</div>
                        <p class="description">Sometimes its more important to have a dog you know you can trust. But not every dog is trustworthy, you can tell by looking at its smile.</p>
                    </div>
                    <div class="extra">
                        311 votes
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="meta">1 week ago</div>
                        <div class="name">Silly Dog</div>
                        <p class="description">Silly dogs can be quite fun to have as companions. You never know what kind of ridiculous thing they will do.</p>
                    </div>
                    <div class="extra">
                        522 votes
                    </div>
                </div>
                <div class="item">
                    <div class="content">
                        <div class="meta">1 week ago</div>
                        <div class="name">Silly Dog</div>
                        <p class="description">Silly dogs can be quite fun to have as companions. You never know what kind of ridiculous thing they will do.</p>
                    </div>
                    <div class="extra">
                        522 votes
                    </div>
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

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
                    <h2>จดหมายข่าว</h2>
                </div>                
            </div>
        </div>  
    </div>


    <div id="content" class="container"> 

        <div class="row">
            <div class="col-md-3">           
                <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix-top" role="complementary">
                    <div class="ui raised segment">
                        <div class="row" style="margin-left:-40px;">
                            <?= $form['form'] ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form['year_no']; ?>
                                </div>
                            </div>
                            <div class="col-md-6">                        
                                <div class="form-group">

                                    <?php echo $form['issue']; ?>
                                </div>                        
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo $form['month']; ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo $form['year'] ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="text-center"> 
                                        <button type="submit" name="btn_search" class="btn btn-default btn-lg"><i></i>ค้นหา</button>
                                    </div>
                                </div>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                    <ul class="nav bs-docs-sidenav list-group" id="menu_side">

                        <?php
                        $month_th = Array("", "มกราคม.", "กุมภาพันธ์.", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

//                        for ($i = 0; $i < 10; $i++) { 
                        $i = 0;
                        echo '<li><a href="#search" class="list-group-item"><i class="fa fa-search"></i>&nbsp;&nbsp;ค้นหา</a></li> ';
                        foreach ($newsletters as $row) {
                            $name = ' ปีที่ ' . $row['journal_year_no'];
                            $name .= '  ฉบับที่ ' . $row['journal_issue'];
                            $name .= ' ประจำเดือน ' . $month_th[$row['journal_mounth']];
                            $name .= ' ' . $row['journal_year'];
                            ?>
                            <li><a href="#<?= $i ?>" class="list-group-item"><?= $name ?> </a></li>                            
                            <?php
                            $i++;
                        }
                        ?>
                    </ul>
                    <!--<h4 id="info" class="text-info">Currently you are viewing - Section 1</h4>-->

                </div>
            </div>
            <div class="col-md-9 scroll-area" data-spy="scroll" data-offset="0" id="main" style="min-height: 1000px;">      
                <div class="row" style="padding: 2%;" id="search" >
                    <div class="col-sm-12" >
                        <?php echo $form['form']; ?>        
                        <div class="form-group visible-xs col-xm-4 col-xs-12">
                            <div class="row">
                                <div class="col-sm-10 col-md-offset-1">                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">ปีที่</label>
                                            <?php echo $form['year_no']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2">                        
                                        <div class="form-group">
                                            <label for="">ฉบับที่</label>
                                            <?php echo $form['issue']; ?>
                                        </div>                        
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">เดือน</label>
                                            <?php echo $form['month']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">ปี</label>
                                            <?php echo $form['year'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center" style="padding: 1%;"> 
                                <button type="submit" name="btn_search" class="btn btn-default btn-lg"><i class="fa fa-search"></i>&nbsp;&nbsp;ค้นหา</button>
                            </div>

                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
                <?php
                if ($strtitle != NULL) {
                    ?>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-12">
                            <div class="lead" style="margin: 0;">           
                                <?= $strtitle ?>           
                            </div>
                        </div>
                    </div> 
                    <?php
                }
                ?>
                <?php
                $i = 0;
//                for ($i = 0; $i < 10; $i++) {
                foreach ($newsletters as $row) {
                    $controller = "Newsletters";
                    $name = ' ปีที่ ' . $row['journal_year_no'];
                    $name .= '  ฉบับที่ ' . $row['journal_issue'];
                    $name .= ' ประจำเดือน ' . $this->m_datetime->getMonthThai($row['journal_mounth']);
                    $name .= ' ' . $row['journal_year'];
                    $date = $this->m_datetime->DateThai($row['publish_date']);
                    ?>
                    <div id="<?= $i ?>" class="col-xs-12">
                        <div class="caption" >
                            <div class="ui raised segment">
                                <div class="ui ribbon green label"><h3 style="margin: 0;"><?= $name ?></h3></div><br>
                                <br>  
                                <div class="row"> 
                                    <div class="col-xs-12">
                                        <div class="content">
                                            <dl class="dl-horizontal">
                                                <dt class="des-ul">ที่ปรึกษา</dt>
                                                <dd><?= $row['adviser'] ?></dd>
                                                <dt>บรรณาธิการ</dt>
                                                <dd><?= $row['editor'] ?></dd>
                                                <dt>ผู้จัดทำ</dt>
                                                <dd><?= $row['prepared_by'] ?></dd>
                                            </dl>
                                            <a class="btn btn-link btn-lg pull-left" href="#" 
                                               data-toggle="modal"
                                               data-target="#view_pdf" 
                                               data-title="<?= $name ?>" 
                                               data-file="<?= $row['file_name'] ?>" 
                                               >
                                                <!--<img class="media-object"  data-src="holder.js/100x100/vine/text:view" alt="<? $month_th[$row['journal_mounth']] ?>">-->
                                                <i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;ดูจดหมายข่าว 
                                            </a>
                                                            <!--<p><? anchor($controller . '/view_more/' . $id, 'อ่านเพิ่ม... ', $view_more) ?>  </p>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="ui bottom right attached label">
                                    <h4 style="margin: 0">
                                        <?= $date ?>
                                    </h4>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>


        </div>

    </div>


</div>

</div>
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="view_pdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="title-pdf"></h4>
            </div>
            <div class="modal-body" >
                <div id="pdf">

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

    $('#view_pdf').on('shown.bs.modal', function(e) {
        var title = $(e.relatedTarget).data('title');
        var file = $(e.relatedTarget).data('file');

        $('#title-pdf').html(title);

        var success = new PDFObject({url: "<?= upload_url() ?>" + file}).embed("pdf");
    });

</script>



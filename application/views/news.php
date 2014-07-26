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
                            <?php foreach ($news_type as $type) { ?>
                                <li><a href="#type<?=$type['news_type_id']?>" class="list-group-item"><?=$type['news_type_name']?></a></li>  
                            <?php } ?>
                        </ul>
                        <h4 id="info" class="text-info">Currently you are viewing - Section 1</h4>
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
                <div class="row" id="history">
                </div>
            </div>

        </div>

    </div>

</div>








<div class="row hidden">
    <div class="col-sm-4 col-sm-offset-4 col-xs-12 well" style="padding: 3%">  

        <?php echo $form['form']; ?>
        <div class="form-group">   
            <?php echo $form['type']; ?>    
        </div>
        <div class="form-group">            
            <?= $form['status'] ?>
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
<?php
if ($strtitle != NULL) {
    ?>
    <div class="row">
        <div class="lead" style="margin: 0;">           
            <?= $strtitle ?>           
        </div>
    </div> 
    <?php
}
?>

<div class="row content hidden">   

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
        //    for ($i = 0; $i < 5; $i++) {
        foreach ($news as $row) {
            $controller = "News_ad";
            $id = $row['news_id'];
            $title = $row['news_title'];
            $subtitle = $row['news_subtitle'];
            $content = $row['news_content'];
            $date = $this->m_datetime->DateThai($row['publish_date']);
            $highlight = $row['news_highlight'];
            $status = $row['news_status'];
            $create = '  | สร้าง : ' . $this->m_datetime->DateTimeThai($row['create_date']) . ' โดย: ' . $row['create_by'];
            $update = 'แก้ไข : ' . $this->m_datetime->DateTimeThai($row['update_date']) . ' โดย: ' . $row['update_by'];
            $type = '';
            foreach ($news_type as $t) {
                if ($t['news_type_id'] == $row['news_type']) {
                    $type = $t['news_type_name'];
                }
            }
            ?>
            <div class="col-md-8 col-md-offset-2 col-xs-12">                
                <div class="panel panel-default">                  
                    <div class="panel-body">

                        <div class="row"> 
                            <?php
                            $edit = array(
                                'type' => "button",
                                'class' => "btn btn-info",
                            );
                            $delete = array(
                                'type' => "button",
                                'class' => "btn btn-danger",
                                'data-id' => "2",
                                'data-title' => "ลบข่าว",
                                'data-info' => $title,
                                'data-toggle' => "modal",
                                'data-target' => "#confirm",
                                'data-href' => $controller . '/delete/' . $id,
                            );
                            $cancle = array(
                                'type' => "button",
                                'class' => "btn btn-warning",
                                'data-id' => "3",
                                'data-title' => "ยกเลิกข่าว",
                                'data-info' => $title,
                                'data-toggle' => "modal",
                                'data-target' => "#confirm",
                                'data-href' => $controller . '/unactive/' . $id,
                            );
                            $active = array(
                                'type' => "button",
                                'class' => "btn btn-success",
                                'data-id' => "4",
                                'data-title' => "ใช้งานข่าว",
                                'data-info' => $title,
                                'data-toggle' => "modal",
                                'data-target' => "#confirm",
                                'data-href' => $controller . '/active/' . $id,
                            );
                            $view_more = array(
                                'type' => "button",
                                'class' => "btn btn-link pull-right",
                                'style' => "font-size: 0.91em;",
                            );
                            ?>

                            <div class="ui ribbon green label" style="padding-right: 5%">
                                <h3 style="margin: 0px;padding: 0px"><?= $type ?></h3>                                
                            </div>
                            <p class="pull-right">
                                <?php
                                echo '<span class="icon">' . anchor($controller . '/edit/' . $id, '<i class="fa fa-pencil fa-lg"></i>&nbsp;แก้ไข', $edit) . '</span>';
                                if ($status == 'active') {
                                    echo '<span class="icon">' . anchor('#', '<i class="fa fa-times fa-lg"></i>&nbsp;ยกเลิก', $cancle) . '</span>';
                                } else {

                                    echo '<span class="icon">' . anchor('#', '<i class="fa fa-refresh fa-lg fa-spin"></i>&nbsp;ใช้งาน', $active) . '</span>';
                                    echo '<span class="icon">' . anchor('#', '<i class="fa fa-trash-o fa-lg"></i>&nbsp;ลบ', $delete) . '</span>';
                                }
                                ?>
                            </p>                            
                        </div> 
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <a class="pull-left" href="#">
                                    <?= img($row['image_small'], array('class' => 'img-responsive', 'width' => '100%')); ?>
                                </a>
                            </div>  
                            <div class="col-xs-12 col-md-8">
                                <div class="row">                                    
                                    <h3>
                                        <?= $title ?>
                                        <div class="text-muted"><small><?= $date ?></small></div>
                                    </h3> 
                                    <div class="description">                                         
                                        <p>
                                            <?= $subtitle ?> 
                                            <?= anchor($controller . '/view_more/' . $id, 'อ่านเพิ่ม... ', $view_more) ?>                                           
                                        </p>                                       
                                        <dl class="dl-horizontal">
                                            <dt class="des-ul">เอกสาร :</dt>
                                            <dd>
                                                <?php
                                                foreach ($file as $f) {
                                                    if ($f['news_id'] == $id) {
                                                        ?>
                                                        <div class="row">
                                                            <?= $f['title'] ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </dd>
                                        </dl> 
                                    </div>   
                                </div>
                                <div class="row" >
                                    <div class="ui top right attached label">

                                    </div> 
                                </div>
                            </div>
                        </div>                         
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <?php
                            if ($highlight == 0) {
                                echo '<span class="icon"><i class="fa fa-bookmark-o fa-lg"></i> <?= $highlight </span>';
                            } else {
                                echo '<span class="icon"><i class="fa fa-bookmark fa-lg"></i> <?= $highlight</span>';
                            }
                            ?>
                            <div class="pull-right">
                                <?php
                                echo $update . $create;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>

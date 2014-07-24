
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <?= $title; ?>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row"> 
    <?= anchor('News_ad/add', '<i class="fa fa-plus fa-lg"></i>&nbsp;สร้างข่าว', 'type="button" class="btn btn-success pull-right btn-lg"') ?>
</div>

<div class="row">
    <div class="col-sm-4 col-sm-offset-4 col-xs-12" style="padding: 3%">  
        <div class="text-center">        
            <?php echo $form['form']; ?>
            <div class="form-group">            
                <?= $form['status'] ?>
            </div>    
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></div>
                    <?= $form['date'] ?>
                </div>
            </div>
            <button type="submit" name="btn_search" class="btn btn-default"><h3 style="margin: 0px"><i class="fa fa-search"></i>&nbsp;&nbsp;ค้นหา</h3></button>

            <?php echo form_close() ?>
        </div>
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

<div class="row content">   

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
                            
                            if ($highlight ==0) {
                                echo '<span class="icon"><i class="fa fa-bookmark-o fa-lg"></i> <?= $highlight ?></span>';
                            }  else {
                                echo '<span class="icon"><i class="fa fa-bookmark fa-lg"></i> <?= $highlight ?></span>';
                            }
                            ?>
                            
                            
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
                                <div class="row" style="margin: 0px;padding: 0px">


                                </div>

                            </div>
                        </div> 

                    </div>
                    <div class="panel-footer">
                        <div class="row">
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

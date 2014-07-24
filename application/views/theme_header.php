<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Site of Kum Krong Dek KhonKean">
        <meta name="author" content="VoRDcs">
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/favicon.png'; ?>">
        <?php echo css('bootstrap.min.css'); ?>
        <?php echo css('bootstrap-theme.css'); ?>
        <?php echo css('font-awesome.css'); ?>
        <?php // echo css('docs.min.css'); ?> 

        <?php echo css('style.css'); ?>

        <!-- Owl Carousel Assets -->        
        <?php echo css('owl.carousel.css'); ?>


        <?php echo js('jquery.js'); ?>
        <?php echo js('bootstrap.js'); ?>    
        <?php echo js('docs.min.js'); ?>  
        
        <?php echo js('jquery.easy-ticker.min.js'); ?>  

    </head>
    <body>
        <?php echo js('customize-js.js'); ?> 
        <!-- Fixed navbar -->
        <div id="nav_fix_top" class="navbar navbar-default navbar-fixed-top hidden" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project name</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../navbar/">Default</a></li>
                        <li><a href="../navbar-static-top/">Static top</a></li>
                        <li class="active"><a href="./">Fixed top</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <header class="masthead">
            <div class="container">
                <?php
                $img_propr = array(
                    'class' => 'img-responsive',
                    'width' => '100%'
                        )
                ?>
                <?= img('head.png', $img_propr); ?>
                <!--
                <div class="row">
                    <h2><a href="#" title="Bootstrap Template">สถานคุ้มครองสวัสดิภาพเด็ก</a>
                        <p class="lead">{A Bootstrap Template}</p></h2>
                </div>
                -->
            </div>
        </header>

        <!--Fixed navbar id="nav" class="navbar navbar-default" role="navigation" data-spy="affix" data-offset-top="100"--> 
        <nav id="nav-static" class="navbar navbar-default navbar-static-side"  role="navigation">
            <div class="container">
                <!--Brand and toggle get grouped for better mobile display--> 
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand visible-xs">Vord</a>
                </div>

                <!--Collect the nav links, forms, and other content for toggling--> 
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= base_url('') ?>"><i class="fa fa-home fa-lg"></i>&nbsp;หน้าเเรก</a></li>
                        <li><a href="<?= base_url('') ?>">&nbsp;ข่าวสาร&nbsp;</a></li>
                        <li class="dropdown" >
                            <a href="<?= base_url('AboutUs/') ?>" class="dropdown-toggle" data-toggle="dropdown">&nbsp;เกี่ยวกับเรา&nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu multi-column">    
                                <li><a href="<?= base_url('AboutUs/') ?>">ประวัติความเป็นมา</a></li>
                                <li><a href="<?= base_url('AboutUs/#vison') ?>">วิสัยทัศน์</a></li>
                                <li><a href="#">ค่านิยม</a></li>
                                <li><a href="#">วัฒนธรรม</a></li>
                                <li><a href="#">ปรัชญา</a></li>
                                <li><a href="#">วัตถุประสงค์</a></li> 
                                <li><a href="#">การดำเนินงาน</a></li>
                                <li><a href="#">เด็กที่ได้รับการสงเคราะห์และคุ้มครองสวัสดิภาพ</a></li>
                                <li><a href="#">การนำเด็กเข้ารับการสงเคาราะห์หรือคุ้มครองสวัสดิภาพ</a></li>
                                <li><a href="#">กระบวนการรับเด็ก</a></li>

                            </ul>
                        </li>
                        <li><a href="<?= base_url('Personnel/') ?>">&nbsp;บุคลากร&nbsp;</a></li>
                        <li><a href="<?= base_url('Activety/') ?>">&nbsp;กิจกรรม&nbsp;</a></li>
                        <li><a href="<?= base_url('') ?>">&nbsp;ผู้ใหญ่ใจดี&nbsp;</a></li>
                        <li><a href="<?= base_url('') ?>">&nbsp;จดหมายข่าว&nbsp;</a></li>
                        <li><a href="<?= base_url('ContactUs/') ?>">&nbsp;ติดต่อเรา&nbsp;</a></li>   
                    </ul>                    
                </div> 
                <!--navbar-collapse--> 
            </div>
        </nav>
        <!--navbar--> 


        <div class="container">
            <?php
            if (isset($debug)) {
                print '<pre>';
                print_r($debug);
                print '</pre>';
            }
            ?>
            <?php
            if (isset($alert))
                echo $alert;
            ?>
        </div>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="VoRDcs">
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/favicon.jpg'; ?>">
        <title>ระบบจัดการหน้าเว็ปไซต์</title>

        <!-- Core CSS - Include with every page --> 
        <?php echo css('bootstrap.min.css'); ?>        
        <?php echo css('font-awesome.css'); ?>

        <?php echo css('admin-style.css'); ?>        



        <!-- SB Admin CSS - Include with every page -->        
        <?php echo css('sb-admin.css'); ?>
        <?php echo js('jquery.js'); ?>
        <?php echo js('bootstrap.min.js'); ?>    
        <?php echo js('docs.min.js'); ?>  

        <!--datetime picker-->    
        <?php echo css('datepicker.css'); ?>  
        <?php echo js('bootstrap-datepicker.js'); ?>  
        <?php echo js('bootstrap-datepicker-thai.js'); ?>  
        <?php echo js('/locales/bootstrap-datepicker.th.js'); ?>  

        <!--edittor-->        
        <?php echo js('nicEdit-latest.js'); ?>  
        <!--pdf view-->
        <?php echo js('pdfobject.js'); ?> 

    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;width: 100%">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">ระบบจัดการหน้าเว็ปไซต์</a>
                </div>
                <!-- /.navbar-header -->


                <!-- /.navbar-top-links -->

                <div class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <!-- Slides -->                            
                            <li>
                                <?= anchor('Slides', '<i class="fa fa-play fa-fw"></i>&nbsp;สไลด์') ?>
                            </li>
                            <!--Activity--> 
                            <li>
                                <a href="#"><i class="fa fa-expand fa-fw"></i>&nbsp;กิจกรรม<span class="fa arrow"></span></a> 
                                <ul class="nav nav-second-level">
                                    <li>
                                        <?= anchor('Activity_ad/add', '<i class="fa fa-plus-circle fa-fw"></i>&nbsp;เพิ่มกิจกรรม'); ?>                                        
                                    </li>
                                    <li>
                                        <?= anchor('Activity_ad', '<i class="fa fa-file-text-o fa-fw"></i>&nbsp;กิจกรรมทั้งหมด') ?>                           
                                    </li>

                                </ul>

                            </li>
                            <!--Newsletter-->
                            <li>
                                <a href="#"><i class="fa fa-file-pdf-o fa-fw"></i>&nbsp;จดหมายข่าว<span class="fa arrow"></span></a> 
                                <ul class="nav nav-second-level">
                                    <li>
                                        <?= anchor('Journals/add', '<i class="fa fa-plus-circle fa-fw"></i>&nbsp;เพิ่มจดหมายข่าว'); ?>                                        
                                    </li>
                                    <li>
                                        <?= anchor('Journals', '<i class="fa fa-file-pdf-o fa-fw"></i>&nbsp;จดหมายข่าวทั้งหมด') ?>                           
                                    </li>

                                </ul>

                            </li>
                            <!-- User -->
                            <li>
                                <a href="#"><i class="fa fa-user fa-fw"></i>&nbsp;ผู้ดูแลระบบ<span class="fa arrow"></span></a>    
                                <ul class="nav nav-second-level">
                                    <li>
                                        <?= anchor('Users/add', '<i class="fa fa-plus-circle fa-fw"></i>&nbsp;เพิ่มผู้ดูแลระบบ'); ?>                                        
                                    </li>
                                    <li>
                                        <?= anchor('Users', '<i class="fa fa-users fa-fm "></i>&nbsp;ผู้ดูแลระบบทั้งหมด'); ?>                                        
                                    </li>                                    
                                </ul>
                            </li>

                        </ul>
                        <!-- /#side-menu -->
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div  id="page-wrapper">

                <?php
                if (isset($debug)) {
                    print '<pre>';
                    print_r($debug);
                    print '</pre>';
                }
                ?>
                <?php if (isset($alert)) echo $alert; ?>





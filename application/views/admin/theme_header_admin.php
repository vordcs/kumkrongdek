<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="VoRDcs">
        <base href="<?php echo base_url(); ?>"> 
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/favicon.png'; ?>">
        <title>ระบบจัดการหน้าเว็ปไซต์</title>

        <!-- Core CSS - Include with every page --> 
        <?php echo css('bootstrap.min.css'); ?>        
        <?php echo css('font-awesome.css'); ?>

        <?php echo css('admin-style.css'); ?>        

        <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
        <?= css('jquery.fileupload.css') ?>
        <?= css('jquery.fileupload-ui.css') ?>

        <!-- SB Admin CSS - Include with every page -->        
        <?php echo css('sb-admin.css'); ?>
        <?php echo js('jquery.js'); ?>
        <?php echo js('bootstrap.min.js'); ?>    
        <?php echo js('docs.min.js'); ?>  

        <!--fancybox-->
        <?php echo css('jquery.fancybox.css'); ?>
        <?php echo js('jquery.fancybox.pack.js'); ?>

        <!--semantic-->
        <?php echo css('semantic.css'); ?>
        <?php echo js('semantic.min.js'); ?>  

        <!--datetime picker-->    
        <?php echo css('datepicker.css'); ?>  
        <?php echo js('bootstrap-datepicker.js'); ?>  
        <?php echo js('bootstrap-datepicker-thai.js'); ?>  
        <?php echo js('/locales/bootstrap-datepicker.th.js'); ?>  

        <!--edittor-->        
        <?php echo js('nicEdit-latest.js'); ?>  
        <!--pdf view-->
        <?php echo js('pdfobject.js'); ?> 

        <!--upload multi-->    
        <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
        <?= js('fileupload/vendor/jquery.ui.widget.js') ?>
        <!-- The Templates plugin is included to render the upload/download listings -->
        <?= js('fileupload/tmpl.min.js') ?>
        <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
        <?= js('fileupload/load-image.min.js') ?>
        <!-- The Canvas to Blob plugin is included for image resizing functionality -->
        <?= js('fileupload/canvas-to-blob.min.js') ?>
        <!-- blueimp Gallery script -->
        <?= js('fileupload/jquery.blueimp-gallery.min.js') ?>
        <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
        <?= js('fileupload/jquery.iframe-transport.js') ?>
        <!-- The basic File Upload plugin -->
        <?= js('fileupload/jquery.fileupload.js') ?>
        <!-- The File Upload processing plugin -->
        <?= js('fileupload/jquery.fileupload-process.js') ?>
        <!-- The File Upload image preview & resize plugin -->
        <?= js('fileupload/jquery.fileupload-image.js') ?>
        <!-- The File Upload validation plugin -->
        <?= js('fileupload/jquery.fileupload-validate.js') ?>
        <!-- The File Upload user interface plugin -->
        <?= js('fileupload/jquery.fileupload-ui.js') ?>
        <!-- The main application script -->
        <?= js('fileupload/main.js') ?>
        <!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
        <!--[if (gte IE 8)&(lt IE 10)]>
        <?= js('fileupload/jquery.xdr-transport.js') ?>
        <![endif]-->

        <script>
            $(document).ready(function() {
                $(window).scroll(function() {
                    var pt_scroll = $(this).scrollTop() + 80;
                    if (pt_scroll >= $('.content').offset().top) {
                        $('#scroll-top').removeClass('hidden');
//                        $('#scroll-top').fadeIn();
                    } else {
                        $('#scroll-top').addClass('hidden');
//                        $('#scroll-top').fadeOut();
                    }
                });
                $('#scroll-top').click(function() {
                    $("html, body").animate({
                        scrollTop: 0
                    }, 600);
                    return false;
                });
            });
        </script>

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
                <ul class="nav navbar-top-links navbar-right visible-md visible-lg">                     
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <?php
                        $f_name = $this->session->userdata('first_name');
                        $f_last = $this->session->userdata('last_name');
                        ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">                            
                            <i class="fa fa-user fa-fw"></i>&nbsp;&nbsp; <?= $f_name . '  ' . $f_last ?> &nbsp;&nbsp;<i class="fa fa-caret-down"></i> 
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <?= anchor('admin/logout', '<i class="fa fa-sign-out fa-fw"></i>&nbsp;ออกจากระบบ'); ?> 
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>


                <!-- /.navbar-top-links -->

                <div class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <!--                                <div class="input-group custom-search-form">
                                                                    <input type="text" class="form-control" placeholder="Search...">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="button">
                                                                            <i class="fa fa-search"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>-->
                                <!-- /input-group -->
                            </li>  
                            <!-- Slides -->                            
                            <li>
                                <?= anchor('Slides', '<i class="fa fa-play fa-fw"></i>&nbsp;สไลด์') ?>
                            </li>
                            <!--News-->
                            <li>
                                <a href="#"><i class="fa fa-bullhorn fa-fw"></i>&nbsp;ข่าว<span class="fa arrow"></span></a> 
                                <ul class="nav nav-second-level">
                                    <li>
                                        <?= anchor('News_ad/add', '<i class="fa fa-pencil-square-o fa-fw"></i>&nbsp;เพิ่มข่าว'); ?>                                        
                                    </li>
                                    <li>
                                        <?= anchor('News_ad/highlight', '<i class="fa fa fa-bookmark fa-fw"></i>&nbsp;ข่าวเด่น') ?>                           
                                    </li>
                                    <li>
                                        <?= anchor('News_ad', '<i class="fa fa-list fa-fw"></i>&nbsp;ข่าวทั้งหมด') ?>                           
                                    </li>


                                </ul>

                            </li>


                            <!--Activity--> 
                            <li>
                                <a href="#"><i class="fa fa-expand fa-fw"></i>&nbsp;กิจกรรม<span class="fa arrow"></span></a> 
                                <ul class="nav nav-second-level">
                                    <li>
                                        <?= anchor('Activitys_ad/add', '<i class="fa fa-pencil-square-o fa-fw"></i>&nbsp;เพิ่มกิจกรรม'); ?>                                        
                                    </li>
                                    <li>
                                        <?= anchor('Activitys_ad', '<i class="fa fa-list fa-fw"></i>&nbsp;กิจกรรมทั้งหมด') ?>                           
                                    </li>

                                </ul>

                            </li>
                            <!--Kindness-->
                            <li>  
                                <?= anchor('Kindness_ad', '<i class="fa fa-play fa-fw"></i>&nbsp;ผู้ใหญ่ใจดี') ?>
                            </li>
                            <!--Newsletter-->
                            <li>
                                <a href="#"><i class="fa fa-envelope-o fa-fw"></i>&nbsp;จดหมายข่าว<span class="fa arrow"></span></a> 
                                <ul class="nav nav-second-level">
                                    <li>
                                        <?= anchor('Journals/add', '<i class="fa fa-pencil-square-o fa-fw"></i>&nbsp;เพิ่มจดหมายข่าว'); ?>                                        
                                    </li>
                                    <li>
                                        <?= anchor('Journals', '<i class="fa fa-list fa-fw"></i>&nbsp;จดหมายข่าวทั้งหมด') ?>                           
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
                            <!--Logout-->
                            <li class="visible-xs visible-sm">  
                                <?= anchor('', '<i class="fa fa-sign-out fa-fw"></i>&nbsp;ออกจากระบบ'); ?>                             
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





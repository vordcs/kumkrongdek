<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Site of Kum Krong Dek KhonKean">
        <meta name="author" content="VoRDcs">

        <?php echo css('bootstrap.css'); ?>
        <?php echo css('bootstrap-theme.css'); ?>
        <?php echo css('font-awesome.css'); ?>

        <?php echo css('style.css'); ?>

        <!-- Owl Carousel Assets -->        
        <?php echo css('owl.carousel.css'); ?>


        <?php echo js('jquery.js'); ?>
        <?php echo js('bootstrap.js'); ?>    
        <?php echo js('docs.min.js'); ?>  

    </head>
    <body>
        <?php echo js('customize-js.js'); ?> 
        <header class="masthead">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h1><a href="#" title="Bootstrap Template">Happy Scroll</a>
                            <p class="lead">{A Bootstrap Template}</p></h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right  hidden-xs">    
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><h3><i class="glyphicon glyphicon-cog"></i></h3></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="glyphicon glyphicon-chevron-right"></i> Link</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-user"></i> Link</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-lock"></i> Link</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!--Fixed navbar--> 
        <nav id="nav" class="navbar navbar-default" role="navigation" data-spy="affix" data-offset-top="100">
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
                        <li><a href="#"><span class="fa fa-home fa-2x"></span></a></li>
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-android fa-lg"></i>&nbsp;Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
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
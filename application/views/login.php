<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/favicon.png'; ?>">
        <meta name="author" content="VoRDcs">
        <title>ระบบจัดการเว็ปไซต์สถานคุ้มครองสวัสดิภาพเด็ก&nbsp;ขอนแก่น</title>

         <!--Core CSS - Include with every page-->        
        <?php echo css('bootstrap.css'); ?>
        <?php echo css('font-awesome.css'); ?>

         <!--SB Admin CSS - Include with every page-->        
        <?php echo css('sb-admin.css'); ?>

    </head>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <!--<?  print_r($data)?>-->
                    <?php
                    echo form_error();
                    ?>
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i></i> เข้าสู่ระบบ</h3>
                        </div>
                        <div class="panel-body">
                            <?= form_open('admin/', array('class' => 'form-signin', 'id' => 'form-signin')) ?>
                            <fieldset>
                                <div class="form-group  <?= (form_error('username')) ? 'has-error' : '' ?>">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                        <!--<?$form['username']?>-->
                                    </div>
                                    <?php echo form_error('username','<font color="error">', '</font>'); ?>
                                </div>
                                <div class="form-group <?= (form_error('password')) ? 'has-error' : '' ?>">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-unlock"></i></div>
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                        <!--<?$form['password']?>-->
                                    </div>
                                    <?php echo form_error('password','<font color="error">', '</font>'); ?>
                                </div>                                   
                                <!-- Change this to a button or input when using this as a form -->                                    
                                <input type="submit"  class="btn btn-lg btn-success btn-block" value="เข้าสู่ระบบ">
                            </fieldset>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>


<div class="row">
    <div class="page-header">
        <h1>
            <?= $title ?>
        </h1>
    </div>
</div>
<div class="row content" > 
    <?php echo $form['form']; ?>

    <div class="form-group<?= (form_error('first_name')) ? ' has-error' : '' ?>">
        <label class="col-sm-2 control-label">ชื่อ</label>
        <div class="col-sm-5">
            <?php echo $form['first_name']; ?> 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('first_name', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <div class="form-group<?= (form_error('first_name')) ? ' has-error' : '' ?>">
        <label class="col-sm-2 control-label">นามสกุล</label>
        <div class="col-sm-5">
            <?php echo $form['last_name']; ?> 
        </div>
        <div class="col-sm-4" id="error">                
            <?php echo form_error('last_name', '<font color="error">', '</font>'); ?>
        </div>
    </div>

    <div class="form-group<?= (form_error('username')) ? ' has-error' : '' ?>">
        <label class="col-sm-2 control-label">ชื่อเข้าใช้ระบบ</label>
        <div class="col-sm-4">
            <?php echo $form['username']; ?> 
            <?php echo $form['old_username']; ?> 
        </div> 
        <div class="col-sm-4" id="error">
            <?php echo form_error('username', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <?php if ($form['oldpass'] != NULL) { ?>
        <div class="form-group<?= (form_error('oldpass')) ? ' has-error' : '' ?>">
            <label class="col-sm-2 control-label "  >รหัสผ่านเดิม</label>
            <div class="col-sm-4">
                <?php echo $form['oldpass']; ?> 
            </div>
            <div class="col-sm-4">   
                <?php echo form_error('oldpass', '<font color="error">', '</font>'); ?>
            </div>
        </div>
    <?php } ?>
    <div class="form-group<?= (form_error('password')) ? ' has-error' : '' ?>">
        <label class="col-sm-2 control-label">รหัสผ่าน</label>
        <div class="col-sm-4">
            <?php echo $form['password']; ?> 
        </div>
        <div class="col-sm-4" id="error"> 
            <?php echo form_error('password', '<font color="error">', '</font>'); ?>
        </div>
    </div>  
    <div class="form-group<?= (form_error('conpass')) ? ' has-error' : '' ?>">
        <label class="col-sm-2 control-label">ยืนยันรหัสผ่าน</label>
        <div class="col-sm-4">
            <?php echo $form['conpass']; ?> 
        </div>
        <div class="col-sm-4" id="error">   
            <?php echo form_error('conpass', '<font color="error">', '</font>'); ?>
        </div>
    </div>
    <hr>
    <div class="form-group" >
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-4" align="center">
            <input type="submit"  class="btn btn-success btn-lg" name="save" id="save" value="บันทึก" >
            <?= anchor('Users', 'ยกเลิก', 'class="btn btn-danger btn-lg"') ?> 
        </div>
    </div>
    <?= form_close() ?>

</div>


<script>
    $(document).ready(function() {

    });


</script>   


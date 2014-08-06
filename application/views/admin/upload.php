
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <? $title; ?>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row content">    
    <?php echo form_open_multipart('upload_test/upload_multi_image'); ?>

    <h1>Upload File</h1>
    <!--<form method="post"  action="" id="upload_file">-->
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="" />

        <label for="userfile">File</label>
        <input type="file" name="userfile[]" id="userfile" multiple size="20" />
        <!--<input type="file" name="userfile" id="userfile" size="20" />-->

        <input type="submit" name="submit" id="submit" />
    </form>
    <h2>Files</h2>
    <div id="files"></div>

    <?php echo form_close(); ?> 
</div>
<script>
    $(document).ready(function() {
        $('#upload_file').submit(function(e) {
            e.preventDefault();
            $.ajaxFileUpload({
                url: '<?=  base_url()?>/upload_test/upload_file/',
                secureuri: false,
                fileElementId: 'userfile',
                dataType: 'json',
                data: {
                    'title': $('#title').val()
                },
                success: function(data, status)
                {
                    if (data.status != 'error')
                    {
                        $('#files').html('<p>Reloading files...</p>');
                        refresh_files();
                        $('#title').val('');
                    }
                    alert(data.msg);
                }
            });
            return false;
        });
    });

</script>
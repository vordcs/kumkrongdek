
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <? $title; ?>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row content">
    <?php echo form_open_multipart($this->uri->uri_string); ?>
    <p>
        <label for="title">Title <br />
            <input type="text" name="title" id="title" >
        </label>
    </p>
    <p>Select the photos you would like to add to the gallery<br />
        <input type="file" name="file_upload" id="file_upload" />
    </p>

    <?php echo form_close(); ?> 
</div>
<script>
    $(document).ready(function() {
        $("#file_upload").uploadify({
            'multi': true,
            'swf': "<?php echo base_url('asset/uploadify/uploadify.swf'); ?>",
            'uploader': "<?php echo base_url("/Upload/do_upload") ?>"
        });
    });
</script>
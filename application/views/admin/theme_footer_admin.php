<div class="footer">

</div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<div class="modal fade bs-example-modal-sm" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modal-title">Confirm</h4>
            </div>

            <div class="modal-body" id="modal-body">
<!--                <p>You are about to delete one track url, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
                <p class="debug-id"></p>-->
            </div>

            <div class="modal-footer" align="center">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_no"><i class="fa fa-times fa-lg"></i>&nbsp;ไม่</button>
                <a href="#" class="btn btn-danger danger" id="btn_delete" ><i class="fa fa-trash-o fa-lg"></i>&nbsp;ลบ</a>
                <a href="#" class="btn btn-primary yes " id="btn_yes" ><i class="fa fa-check fa-lg"></i>&nbsp;ใช่</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
//            language: 'th-th', 
            format: 'yyyy-m-d',
        });
    });
    $('#confirm').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).data('id');
        var title = $(e.relatedTarget).data('title');
        var info = $(e.relatedTarget).data('info');

        $('.modal-title').html('<i class="fa fa-info-circle fa-lg"></i> คุณต้องการ <strong>' + title + '</strong>');
        $('.modal-body').html('<strong>' + title + '</strong> : ' + info + '');

        if (id == 1) //edit
        {
            $('#btn_yes').show();
            $('#btn_delete').hide();
            $(this).find('.yes').attr('href', $(e.relatedTarget).data('href'));

        } else if (id == 2) //delete 
        {
            $('#btn_yes').hide();
            $('#btn_delete').show();
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));

        }
        else if (id == 3) //cancle
        {
            $('#btn_yes').show();
            $('#btn_delete').hide();
            $(this).find('.yes').attr('href', $(e.relatedTarget).data('href'));

        } else if (id == 4) //active
        {
            $('#btn_yes').show();
            $('#btn_delete').hide();
            $(this).find('.yes').attr('href', $(e.relatedTarget).data('href'));

        }

    });

</script>


<!-- Core Scripts - Include with every page -->    
<?php echo js('plugins/metisMenu/jquery.metisMenu.js'); ?>   
<!-- SB Admin Scripts - Include with every page -->
<?php echo js('sb-admin.js'); ?>  


</body>

</html>

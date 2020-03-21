<!-- USER LOGGED IN MODAL ----->
<div class="modal fade" id="modal_user_forget_password">
    <div class="modal-dialog">
        <form action="" id="user_recover_process" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Recover Password</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible" id="op_alert_sec" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <span id="op_message"></span>
                    </div>
                    <div class="alert alert-success" id="success_sec" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Success!</h4>
                        <span id="success_message"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        <span class="help-block"></span>
                    </div>

                </div>
                <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="user_recover_password_process();">Submit</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </form>
        <!-- /Form-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
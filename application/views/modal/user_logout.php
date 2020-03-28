<!-- USER LOGGED IN MODAL ----->
<div class="modal fade preview-modal" data-backdrop="" id="modal_user_logout" role="dialog" aria-labelledby="preview-modal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" id="userlogout" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger" style="background-color: red;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Logout</h4>
                </div>
                <div class="modal-body">
                    <p><b>Are you sure, you want to logout?</b></p>
                </div>
                <div class="modal-footer bg-danger">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline" onclick="confirm_userlogged_out();">Confirm</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
        <!-- /Form-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
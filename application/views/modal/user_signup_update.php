<!-- SIGNUP MODAL ----->
<div class="modal fade" id="update_signup">
    <div class="modal-dialog">
        <form action="" id="user_profile_update" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <!--all flash message show view-->
                        <?php $this->load->view ('dashboard/message_view_page');  ?>
                        <!--End all flash message show view-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">User Profile Update</h4>
                </div>
                <span id="profile_update_modal_body"></span>                
                <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="user_profile_update();">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
        <!-- /Form-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    $('#e_invitation_data_table_id').DataTable();
    $('#admin_all_users_list').DataTable();
    $("#start_date").datepicker({
        dateFormat: "yy-mm-dd"
    });
    $("#end_date").datepicker({
        dateFormat: "yy-mm-dd"
    });
    if($('#exhibition_details').length ){
        CKEDITOR.replace( 'exhibition_details' ); 
    }
});

function login_as_artist_process(login_as_user_id){
    swal({
        title: 'Are you sure?',
        text: "You want to login as this artist",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.value) {
          var url       =   base_url_addr+"admin/dashboard/login_as_artist_process";
          $.ajax({
                url         :url,
                type        :"POST",
                dataType    :"json",
                data        :"artist_id="+login_as_user_id,
                success:function(response){
                    if(response.status   ==  'success'){
                        swal("Logged in", response.message, "success");
                        setTimeout(function () {
                            var lggin_as_location = base_url_addr+"welcome/user_profile";
                            window.open(lggin_as_location, '_blank');
                        }, 3000);
                    }
                }
            });
        }
      })
}

function loadConfirmDeleteAlert(deleteId, tableName,){
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          var url       =   base_url_addr+"admin/exhibition/executeDeleteOperation";
          var type      =   "POST";
          var dataType  =   "json";
          var data      ="delete_id="+deleteId+"&table="+tableName;
          processDeleteOperation(url, type, dataType, data);
          $("#related_image_id_"+deleteId).hide();
        }
      })
}


function processDeleteOperation(url,type,dataType,data){
    var ajaxResponse;
    $.ajax({
        url:url,
        type:type,
        dataType:dataType,
        data:data,
        success:function(response){
            ajaxResponse    =   response;
        }
    });
    return ajaxResponse;
}
function updateArtworkAuthentication(url,type,dataType,data){    
    $.ajax({
        url         :base_url_addr+"admin/dashboard/executeArtworkAuthenticationUpdate",
        type        :"POST",
        dataType    :"json",
        data:$("#pending_artwork_list").serialize(),
        success:function(response){
            if(response.status   ==  'success'){
                swal("Update completed", "Data have been successfully updated!", "success");
                setTimeout(function () {
                    window.location = base_url_addr+"admin/dashboard/pending_artwork_list";
                }, 3000);
            }
        }
    });
}
function deleteDataByIdAndTable(id, table, redirect_url = '') {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: base_url_addr + "welcome/deleteDataByIdAndTable",
                type: 'POST',
                dataType: 'json',
                data: 'id=' + id + '&table=' + table,
                success: function (response) {
                    if (response.status == 'success') //if success close modal and reload ajax table
                    {
                        swal("Deleted", "Artwork have been successfully deleted!", "success");
                        setTimeout(function () {
                            if (redirect_url) {
                                window.location = redirect_url;
                            } else {
                                window.location = response.redirect_url;
                            }
                        }, 2000);
                    }
                }
            });
        }
    })
}

function confirm_exhibition_delete_process(delete_id) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            var delete_param = {
                delete_id: delete_id
            };
            $.ajax({
                url: base_url_addr + "admin/dashboard/exhibition_delete_process",
                type: 'POST',
                dataType: 'json',
                data: delete_param,
                success: function (data) {
                    if (data.status == 'success') {
                        swal("Deleted!","Data have been successfully deleted", 'success');
                        setTimeout(function () {
                            location.reload(true);
                        }, 2000);
                    }
                }
            });
        }
    })
}

function confirm_events_delete_process(delete_id) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            var delete_param = {
                delete_id: delete_id
            };
            $.ajax({
                url: base_url_addr + "admin/dashboard/event_delete_process",
                type: 'POST',
                dataType: 'json',
                data: delete_param,
                success: function (data) {
                    if (data.status == 'success') {
                        swal("Deleted!","Data have been successfully deleted", 'success');
                        setTimeout(function () {
                            location.reload(true);
                        }, 2000);
                    }
                }
            });
        }
    })
}

function confirm_faq_delete_process(delete_id) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            var delete_param = {
                delete_id: delete_id
            };
            $.ajax({
                url: base_url_addr + "admin/dashboard/faq_delete_process",
                type: 'POST',
                dataType: 'json',
                data: delete_param,
                success: function (data) {
                    if (data.status == 'success') {
                        swal("Deleted!","Data have been successfully deleted", 'success');
                        setTimeout(function () {
                            location.reload(true);
                        }, 2000);
                    }
                }
            });
        }
    })
}
function confirm_delete_operation(delete_id, table) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            var delete_param = {
                delete_id   : delete_id,
                table       : table
            };
            $.ajax({
                url: base_url_addr + "admin/dashboard/confirm_delete_operation",
                type: 'POST',
                dataType: 'json',
                data: delete_param,
                success: function (data) {
                    if (data.status == 'success') {
                        swal("Deleted!","Data have been successfully deleted", 'success');
                        setTimeout(function () {
                            location.reload(true);
                        }, 2000);
                    }
                }
            });
        }
    })
}
function processInvitation(){
    swal({
        title: "Invitation in progress.",
        text: "Please wait to complete the process.",
        type: "warning",
        showCancelButton: false, // There won't be any cancel button
        showConfirmButton: false // There won't be any confirm button
      });
    setTimeout(function () {
        $.ajax({
            url         :base_url_addr+"admin/invitation/send_invitation",
            type        : 'GET',
            dataType    : 'json',
            success: function (response) {
                if(response.status == 'success'){
                    swal({
                        title: "Invitation Success.",
                        text: "All invitation process have been successfully done.",
                        type: "success",
                        showCancelButton: false,
                        closeOnConfirm: false,
                        closeOnCancel: false
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            },
            async: false // <- this turns it into synchronous
        });
    }, 2000);
}
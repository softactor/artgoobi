/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function employee_create() {
    var formData;
    formData = {
        first_name:$("#first_name").val(),
        last_name:$("#last_name").val(),
        initials:$("#initials").val(),
        emp_id:$("#emp_id").val(),
        position_id:$("#position_id").val(),
        phone_no:$("#phone_no").val(),
        email:$("#email").val(),
        group_id:$("#group_id").val()
    };
    $.ajax({
        url:base_url_addr+"dashboard/employee_create",
        type:'POST',
        dataType:'json',
        data: formData,
        success: function(data) {
            if(data.status=='success'){
                $('#modal-default').modal('hide');
                $('#operation_message_box').show();
                $('#operation_message_txt').html('Added');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);                
            }
        }
    });
}

function employee_edit() {
    var formData;
    formData = {
        user_id:$("#edit_id").val(),
        first_name:$("#first_name").val(),
        last_name:$("#last_name").val(),
        initials:$("#initials").val(),
        emp_id:$("#emp_id").val(),
        position_id:$("#position_id").val(),
        phone_no:$("#phone_no").val(),
        email:$("#email").val(),
        group_id:$("#group_id").val()
    };
    $.ajax({
        url:base_url_addr+"dashboard/employee_panel_edit_process",
        type:'POST',
        dataType:'json',
        data: formData,
        success: function(data) {
            if(data.status=='success'){
                $('#operation_message_box').show();
            }
        }
    });
}

function confirm_employee_delete(delete_id){
    $("#confirm_delete_modal").modal();
    $("#delete_user_id").val(delete_id);
}

function confirm_employee_delete_process(){
    var delete_param = {
       delete_id:$("#delete_user_id").val()
    };
    $.ajax({
        url:base_url_addr+"dashboard/employee_panel_delete_process",
        type:'POST',
        dataType:'json',
        data: delete_param,
        success: function(data) {
            if(data.status=='success'){
                $('#confirm_delete_modal').modal('hide');
                $('#operation_message_box').show();
                $('#operation_message_txt').html('Deleted');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
            }
        }
    });
}



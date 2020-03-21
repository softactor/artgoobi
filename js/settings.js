/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function custom_group_create() {
    var formData = $("#custom_group_form").serializeArray();    
    formData = {
        form_data:formData
    };
    $.ajax({
        url:base_url_addr+"settings/custom_group_create",
        type:'POST',
        dataType:'json',
        data: formData,
        success: function(data) {
            if(data.status=='success'){
                $('#custom_group_add_form').modal('hide');
                $('#operation_message_box').show();
                $('#operation_message_txt').html('Added');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);                
            }
        }
    });
}
function confirm_custom_group_delete(delete_id){
    $("#confirm_delete_modal").modal();
    $("#delete_user_id").val(delete_id);
}
function confirm_group_delete_process(){
    var delete_param = {
       delete_id:$("#delete_user_id").val()
    };
    $.ajax({
        url:base_url_addr+"settings/custom_group_delete_process",
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

function group_create() {
    var formData = $("#custom_group_form").serialize();    
    formData = {
        name:$("#name").val()
    };
    $.ajax({
        url:base_url_addr+"settings/group_create",
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
function group_edit() {
    var formData;
    formData = {
        user_id:$("#edit_id").val(),
        name:$("#name").val()
    };
    $.ajax({
        url:base_url_addr+"settings/group_edit_process",
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
function confirm_group_delete(delete_id){
    $("#confirm_delete_modal").modal();
    $("#delete_user_id").val(delete_id);
}
function confirm_group_delete_process(){
    var delete_param = {
       delete_id:$("#delete_user_id").val()
    };
    $.ajax({
        url:base_url_addr+"settings/group_delete_process",
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

function position_create() {
    var formData;
    formData = {
        name:$("#name").val()
    };
    $.ajax({
        url:base_url_addr+"settings/position_create",
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
function position_edit() {
    var formData;
    formData = {
        user_id:$("#edit_id").val(),
        name:$("#name").val()
    };
    $.ajax({
        url:base_url_addr+"settings/position_edit_process",
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
function confirm_position_delete(delete_id){
    $("#confirm_delete_modal").modal();
    $("#delete_user_id").val(delete_id);
}
function confirm_position_delete_process(){
    var delete_param = {
       delete_id:$("#delete_user_id").val()
    };
    $.ajax({
        url:base_url_addr+"settings/position_delete_process",
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

function toggleCustomGroupActionType(type_id){
    if(type_id==1){
        $("#type_pos").show('slow');
        $("#type_grp").hide();
        $("#type_emp").hide();
        $("#filterEmp").hide();
        $("#filterEmp").empty();
        $('#type_emp').find('input[type=checkbox]:checked').prop('checked', false);
        $('#type_grp').find('input[type=checkbox]:checked').prop('checked', false);
    }
    if(type_id==2){
        $("#type_pos").hide();
        $("#type_grp").show('slow');
        $("#type_emp").hide();
        $("#filterEmp").hide();
        $("#filterEmp").empty();
        $('#type_emp').find('input[type=checkbox]:checked').prop('checked', false);
        $('#type_pos').find('input[type=checkbox]:checked').prop('checked', false);
    }
    if(type_id==3){
        $("#filterEmp").show('slow');
        $("#type_pos").hide();
        $("#type_grp").hide();
        $("#type_emp").show('slow');
        $('#type_pos').find('input[type=checkbox]:checked').prop('checked', false);
        $('#type_grp').find('input[type=checkbox]:checked').prop('checked', false);
    }
}
function toggleActionType(type_id){
    if(type_id==1){
        $("#position_id option:selected").prop("selected", false);
        $('#position_id').prop('disabled', 'disabled');
        $('#group_id').prop('disabled', false);
    }
    if(type_id==2){
        $("#group_id option:selected").prop("selected", false);
        $('#position_id').prop('disabled', false);
        $('#group_id').prop('disabled', 'disabled');
    }
    if(type_id==0){
        $("#group_id option:selected").prop("selected", false);
        $("#position_id option:selected").prop("selected", false);
        $('#position_id').prop('disabled', 'disabled');
        $('#group_id').prop('disabled', 'disabled');
    }
}
function pre_sms_create() {
    var formData;
    formData = {
        is_general:$("input[name='is_general']:checked").val(),
        position_id:$("#position_id").val(),
        group_id:$("#group_id").val(),
        template_id:$("#template_id").val(),
        descriptions:$("#descriptions").val(),
    };
    $.ajax({
        url:base_url_addr+"settings/pre_sms_template_create",
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
function pre_sms_edit() {
    var formData;
    formData = {
        user_id:$("#edit_id").val(),
        is_general:$("input[name='is_general']:checked").val(),
        position_id:$("#position_id").val(),
        group_id:$("#group_id").val(),
        template_id:$("#template_id").val(),
        descriptions:$("#descriptions").val(),
    };
    $.ajax({
        url:base_url_addr+"settings/pre_sms_template_edit_process",
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
function confirm_pre_sms_delete(delete_id){
    $("#confirm_delete_modal").modal();
    $("#delete_user_id").val(delete_id);
}
function confirm_pre_sms_delete_process(){
    var delete_param = {
       delete_id:$("#delete_user_id").val()
    };
    $.ajax({
        url:base_url_addr+"settings/pre_sms_template_delete_process",
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

function getRoleDetailsByuserType(){
    var formData = {
        user_type:$("#user_type").val()
    };
    $.ajax({
        url:base_url_addr+"settings/get_role_details_by_user_id",
        type:'POST',
        dataType:'html',
        data: formData,
        success: function(data) {
            $('#type_wise_role').html(data);
        }
    });
}
//***************custom group employee search*************
    $("#employee").select2();
    function createFilterEmployee(id,op_type){        
        var name = $("#employee option:selected").text();
        var customInput="";
        if(id){
            customInput+='<div class="form-group">';
            customInput+='<div class="checkbox">';
            customInput+='<label>';
            if(op_type=='add'){
                customInput+="<input type='checkbox' name='filter_emp' value='"+id+"'>"+name;
            }
            if(op_type=='edit'){
               customInput+="<input type='checkbox' name='filter_emp[]' value='"+id+"'>"+name; 
            }
            customInput+='</label>';
            customInput+='</div></div>';
            $("#filterEmp").append(customInput)
        }
    }
//***************custom group employee search*************// 

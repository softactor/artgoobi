/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function user_create() {
    var formData;
    formData = {
        name:$("#user_name").val(),
        user_type:$("#user_type").val(),
        user_email:$("#user_email").val(),
        user_pass:$("#user_pass").val(),
        ip_addr_from:$("#ip_addr_from").val(),
        ip_addr_to:$("#ip_addr_to").val(),
        is_ip_checked:$("input[name='is_ip_address_check']:checked").val()
    };
    $.ajax({
        url:base_url_addr+"dashboard/user_create",
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

function user_edit() {
    var formData;
    formData = {
        user_id:$("#edit_id").val(),
        name:$("#user_name").val(),
        user_type:$("#user_type").val(),
        user_email:$("#user_email").val(),
        user_pass:$("#user_pass").val(),
        ip_addr_from:$("#ip_addr_from").val(),
        ip_addr_to:$("#ip_addr_to").val(),
        is_ip_checked:$("input[name='is_ip_address_check']:checked").val()
    };
    $.ajax({
        url:base_url_addr+"dashboard/user_panel_edit_process",
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
function confirm_user_delete_process(delete_id) {
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
                url: base_url_addr + "admin/dashboard/user_panel_delete_process",
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

function getProfileInfoById(id){
    $.ajax({
        url:base_url_addr+"admin/dashboard/get_profile_info_by_id",
        type:'POST',
        dataType:'json',
        data: 'id='+id,
        success: function(data) {
            console.log(data);
            $("#update_id").val(data.user_id);
            $("input[name=signup_type][value='"+data.user_type+"'").prop("checked",true);
            $("input[name=gender][value='"+data.gender+"'").prop("checked",true);
            $("input[name='first_name']").val(data.first_name);
            $("input[name='last_name']").val(data.last_name);
            $("input[name='email']").val(data.user_email);
            $("input[name='phone']").val(data.phone_no);
            $("input[name='zip_code']").val(data.zip_code);
            $("#country_id").val(data.country_id);
            $("#status").val(data.status);
        }
    });
}
//signup_process_update

function user_profile_update() {
    $.ajax({
        url:base_url_addr+"welcome/user_profile_update",
        type:'POST',
        dataType:'json',
        data: $("#user_profile_update").serialize(),
        success: function(data) {
            if(data.status=='success') //if success close modal and reload ajax table
            {
                $('#op_message').html(data.message);
                $('#update_signup').modal('hide');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
        }
    });
}

function featuredImageUpload(){
    console.log("Hello Data");
//    var file_data = $('#file').prop('files')[0];
//    var form_data = new FormData();
//    form_data.append('file', file_data);
//    console.log(form_data);
    //$("#exhibition").submit(function(e) {
        //prevent Default functionality
        //e.preventDefault();
        $.ajax({
            url: base_url_addr+"admin/exhibition/process_exhibition", // point to server-side PHP script 
            dataType: 'json', // what to expect back from the PHP script
            data: $("#exhibition").serialize(),
            type: 'POST',
            success: function (response) {
                $('#msg').html(response); // display success response from the PHP script
            },
            error: function (response) {
                $('#msg').html(response); // display error response from the PHP script
            }
        });
    //})
}

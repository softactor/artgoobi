/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function signup_process() {
    $.ajax({
        url:base_url_addr+"welcome/signup_process",
        // url:"http://testing.local/welcome/signup_process",
        type:'POST',
        dataType:'json',
        data: $("#signup").serialize(),
        success: function(data) {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_signup').modal('hide');
                swal("Registeration complete", "Registeration have been successfully done!", "success");
                setTimeout(function () {
                    window.location = data.redirect_url;
                }, 3000);
            }
            else
            {
                $('.help-block').html('');
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
        }
    });
}

function invited_signup_process() {
    var redirect_url    =   "";
    redirect_url    =   base_url_addr;
    $.ajax({
        url:base_url_addr+"welcome/signup_process",
        // url:"http://testing.local/welcome/signup_process",
        type:'POST',
        dataType:'json',
        data: $("#invited_signup").serialize(),
        success: function(data) {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_signup').modal('hide');
                swal("Registeration complete", "Registeration have been successfully done!", "success");
                setTimeout(function () {
                    window.location = redirect_url;
                }, 3000);
            }
            else
            {
                $('.help-block').html('');
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
        }
    });
}

function user_login_process() {
    $.ajax({
        url:base_url_addr+"welcome/user_login_process",
        type:'POST',
        dataType:'json',
        data: $("#userlogin").serialize(),
        success: function(data) {
            $("#op_alert_sec").hide();
            if(data.status && data.status==true){
                $('#modal_userloggin').modal('hide');
                setTimeout(function () {
                    location.reload(true);
                }, 2000);
            }else if(!data.status){                
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }else if(data.status=='error'){
                $("#op_alert_sec").show('slow');
                $("#op_message").html(data.message);                
            }
        }
    });
}
function user_forget_password() {
    $('#modal_userloggin').modal('hide');
    $('#modal_user_forget_password').modal('show');
}
function user_recover_password_process() {

    $.ajax({
        // url:"http://testing.local/welcome/password_recover_process",
        url:base_url_addr+"welcome/password_recover_process",
        type:'POST',
        dataType:'json',
        data: $("#user_recover_process").serialize(),

        success: function(data) {
            console.log(data);
            $("#op_alert_sec").hide();
            if(data.status && data.status=='success'){
                $("#success_sec").show('slow');
                $("#success_message").html(data.message);
                setTimeout(function () {
                    location.reload(true);
                }, 4000);
            }else if(data.status=='error'){
                $("#op_alert_sec").show('slow');
                $("#op_message").html(data.message);
                setTimeout(function () {
                    location.reload(true);
                }, 4000);
            }
        }
    });
}
function confirm_userlogged_out(){
    $.ajax({
        url:base_url_addr+"welcome/signout_process",
        type:'POST',
        dataType:'json',
        data: $("#userlogin").serialize(),
        success: function(data) {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_user_logout').modal('hide');
                setTimeout(function () {
                    var redirect_url =  base_url_addr;
                    window.location = redirect_url;
                }, 2000);
            }
        }
    });
}

function get_subtype_artwork(id){
    if(id){        
        $.ajax({
            url:base_url_addr+"welcome/get_subtype_artwork",
            type:'POST',
            dataType:'json',
            data:'id='+$("#type_of_art_id").val(),
            success: function(response) {
                $('.alert').hide();
                $('.alert-danger').hide();
                var boxText =   $('#type_of_art_id').find(":selected").text();
                switch(boxText){
                    case 'Installation':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Painting':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Craft':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Design':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Performance':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Photography':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Print':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Project':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Sclupture':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Site_specific':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    case 'Video':
                        $('.dyna_type_of_art').hide();
                        $('#dyna_type_of_art_'+boxText).show();
                        break;
                    default:
                        $('.dyna_type_of_art').hide();
                }
                $("#dyna_load_form_section").html("");
                $("#dyna_load_form_section").html(response.data);
            }
        });
    }
}

function toggle_artist_name_change(val){
    if(val==1){
        $("#arits_name").val($("#hidden_artist_name").val());
    }else if(val==2){
        $("#arits_name").val("");
    }
}

function calculateActualPrice(){
    var price = parseFloat($("#price").val());
    var sarCharge = 0.0;
    var vatCharge = parseFloat(((price*85)/100));
    var actualPrice = parseFloat(vatCharge).toFixed(2);;
    $("#actual_price").val(actualPrice);
    $("#actual_price_hidden").val(actualPrice);
}

function togglePriceShowhide(){
    if($("#not_for_sale").is(':checked')){
        $("#collector_name_form").show();
        $("#price").val("");
        $("#actual_price").val("");
        $("#price").prop('disabled', true);
        $("#actual_price").prop('disabled', true);
    }else{
        $("#collector_name_form").hide();
        $("#price").prop('disabled', false);
        $("#actual_price").prop('disabled', false);
    }
}

function deleteConfirmationModal(table,delete_id){
    /*
     * In this method we need
     * table and delete_id
     * cause when confirm modal click
     * we nedd this again to complete 
     * the delete process
     */
    $.ajax({
        url:base_url_addr+"welcome/delete_confirmation_modal",
        type:'POST',
        dataType:'html',
        success: function(data) {
            $("#modal_open_area").html(data);
            // assign table name into a hidden field
            $("#delete_table_name").val(table);
            // assign delete id into a hidden field
            $("#delete_id").val(delete_id);
            $("#modal-warning").modal('show');
            
        }
    });
}

function deleteConfirmationProcess(){
    var dataParam = {
        table:$("#delete_table_name").val(),
        delete_id:$("#delete_id").val()
    };
    $.ajax({
        url:base_url_addr+"welcome/delete_confirmation_process",
        type:'POST',
        dataType:'json',
        data:dataParam,
        success: function(data) {
            $("#modal-warning").modal('hide');
            if(data.status=='success'){
                $("#upload_image_id_"+$("#delete_id").val()).hide('slow');
                $("#success_message").show();
                $("#message").html(data.message);
                $("#error_message").hide();
            }else{
                $("#error_message").show();
                $("#message").html(data.message);
                $("#error_message").hide();
            }
            setTimeout(function () {
                location.reload(true);
            }, 2000);
        }
    });
}

function showSignupFormFields(userType){
    $('#artwork_signup_option_artist').hide();
    $('#artwork_signup_option_collector').hide();
    $('#artwork_signup_option_visitor').hide();
    switch(userType){
        case 'artist':
            var userTypeId  =   6;
            var signup_welcome  =   "Welcome to artgoobi as Artist";
            break;
        case 'collector':
            var userTypeId  =   8;
            var signup_welcome  =   "Welcome to artgoobi as Collector";
            break;
        case 'visitor':
            var userTypeId  =   7;
            var signup_welcome  =   "Welcome to artgoobi as Visitor";
            break;
        default:
            var userTypeId  =   6;
            var signup_welcome  =   "Welcome to artgoobi as Artist";
            
    }
    $('#artwork_signup_option_'+userType).show('slow');
    $('#signup_welcome').html(signup_welcome);
    $('#push_signup_type').val(userTypeId);
}
function check_profile_name_availability(profile_name){
    $.ajax({
        url:base_url_addr+"welcome/check_profile_name_availability",
        type:'POST',
        dataType:'json',
        data:'profile_name='+profile_name,
        success: function(response) {
            if(response.status == "success"){
                $("#profile_link_name_status").html(response.message);
            }else{
                $("#profile_link_name_id").val("")
                $("#profile_link_name_status").html(response.message);
            }
        }
    });
}
//Add Dynamic Work Place:
function addWorkExperience(){
    $("#add_work_experience").hide("slow");
    $("#add_work_experience_form").show("slow");
}

function saveWorkExperience(opType,form_id){
    var formData;
    if(opType=='insert'){
        formData = $('#profile_work_experience').serialize();
    }else if(opType=='update'){
        formData = $('#profile_work_history_update_'+form_id).serialize();
    }
    
    var cchchc  =   $('#' + 'experience_description').html( tinymce.get('experience_description').getContent() );
    console.log("Hello Data");
    console.log(cchchc);
    
    $.ajax({
        url:base_url_addr+"welcome/save_user_profile_work_experience",
        type:'POST',
        dataType:'json',
        data: formData,
        success: function(data) {
            if(opType=='insert'){
                if(data.status=='success'){
                    $("#add_work_place").show("slow");
                    $("#add_work_place_form").hide();
                    $('#works_details').prepend(data.data);
                }
            }else{
                $("#work_update_form_area_"+form_id).html("");
                $("#work_details_area_"+form_id).html("");
                $("#work_details_area_"+form_id).show();
                $("#work_details_area_"+form_id).html(data.data);
            }
        }
    });
}

//Add Dynamic Work Place:
function addWorkPlace(){
    $("#add_work_place").hide("slow");
    $("#add_work_place_form").show("slow");
}
function saveWorkHistory(opType,form_id){
    var formData;
    if(opType=='insert'){
        formData = $('#profile_work_history').serialize();
    }else if(opType=='update'){
        formData = $('#profile_work_history_update_'+form_id).serialize();
    }
    $.ajax({
        url:base_url_addr+"welcome/save_user_profile_work_history",
        type:'POST',
        dataType:'json',
        data: formData,
        success: function(data) {
            if(opType=='insert'){
                if(data.status=='success'){
                    $("#add_work_place").show("slow");
                    $("#add_work_place_form").hide();
                    $('#works_details').prepend(data.data);
                }
            }else{
                $("#work_update_form_area_"+form_id).html("");
                $("#work_details_area_"+form_id).html("");
                $("#work_details_area_"+form_id).show();
                $("#work_details_area_"+form_id).html(data.data);
            }
        }
    });
}

function editWorkPlace(id){
    $("#work_details_area_"+id).hide();
    $("#work_update_form_area_"+id).show();
    $.ajax({
        url:base_url_addr+"welcome/get_work_update_form",
        type:'POST',
        dataType:'json',
        data: 'id='+id,
        success: function(data) {
            if(data.status=='success'){
                $("#work_update_form_area_"+id).html(data.data);
            }
        }
    });
}

function cancelUpdateWorkHistory(id){
    $("#work_details_area_"+id).show();
    $("#work_update_form_area_"+id).hide();
}

//Add Dynamic Education:
function addEducationDetails(){
    $("#add_education_details").hide("slow");
    $("#add_education_details_form").show("slow");
}

function saveEducationHistory(opType,form_id){
    var formData;
    if(opType=='insert'){
        formData = $('#profile_education_history').serialize();
    }else if(opType=='update'){
        formData = $('#profile_education_history_update_'+form_id).serialize();
    }
    $.ajax({
        url:base_url_addr+"welcome/save_user_profile_education_history",
        type:'POST',
        dataType:'json',
        data: formData,
        success: function(data) {
            if(opType=='insert'){
                if(data.status=='success'){
                    $("#add_education_details").show("slow");
                    $("#add_education_details_form").hide();
                    $('#education_details').prepend(data.data);
                }
            }else{
                $("#education_update_form_area_"+form_id).html("");
                $("#educauion_details_area_"+form_id).html("");
                $("#educauion_details_area_"+form_id).show();
                $("#educauion_details_area_"+form_id).html(data.data);
            }
        }
    });
}

// Edit Education details:
function editEducationDetails(id){
    $("#educauion_details_area_"+id).hide();
    $("#education_update_form_area_"+id).show();
    $.ajax({
        url:base_url_addr+"welcome/get_education_update_form",
        type:'POST',
        dataType:'json',
        data: 'id='+id,
        success: function(data) {
            if(data.status=='success'){
                $("#education_update_form_area_"+id).html(data.data);
            }
        }
    });
}

function cancelUpdateEducationHistory(id){
    $("#educauion_details_area_"+id).show();
    $("#education_update_form_area_"+id).hide();
}

function getProfileInfoById(id){
    $.ajax({
        url:base_url_addr+"welcome/get_profile_info_by_id",
        type:'POST',
        dataType:'json',
        data: 'id='+id,
        success: function(data) {
            $("#update_id").val(data.user_id);
            $("#profile_update_modal_body").html(data.data);
        }
    });
}

function user_profile_update() {
    $.ajax({
        url:base_url_addr+"welcome/user_profile_update",
        type:'POST',
        dataType:'json',
        data: $("#user_profile_update").serialize(),
        success: function(data) {
            if(data.status=='success') //if success close modal and reload ajax table
            {
                swal("Profile Updated", "Profile has been successfully updated!", "success");
                $('#update_signup').modal('hide');
                $('#op_message').html(data.message);
                setTimeout(function () {
                    location.reload(true);
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

function getUserCreatedEvenData(event_id){
    $.ajax({
        url:base_url_addr+"welcome/get_user_event_data",
        type:'POST',
        dataType:'json',
        data: 'event_id='+event_id,
        success: function(response) {
            if(response.status=='success'){
                $('#userEventUpdateModal').modal('show');
                $('#userEventUpdateModaData').html(response.data);
            }
        }
    });
}

function deleteDataByIdAndTable(id, table, redirect_url = '') {
    swal({
        title: "Are you sure?",
        text: "Your will not be able to recover this file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Confirm",
        closeOnConfirm: false
    },
            function () {
                $.ajax({
                    url: base_url_addr + "welcome/deleteDataByIdAndTable",
                    type: 'POST',
                    dataType: 'json',
                    data: 'id='+id+'&table='+table+'&redirect_url='+redirect_url,
                    success: function (response) {
                        if (response.status == 'success') //if success close modal and reload ajax table
                        {
                            swal("Deleted", "Event have been successfully deleted!", "success");
                            setTimeout(function () {
                                if(redirect_url){
                                    window.location = response.redirect_url;
                                }else{
                                    window.location = response.redirect_url;
                                }
                            }, 2000);
                        }
                    }
                });
            });
}

function artworkFilevalidate(file){
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();      
    var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];

    if (arrayExtensions.lastIndexOf(ext) == -1) {
        $("#image").val("");
        swal("Warning", "Wrong extension type! Only image is allowed.", "error");
    }
}

$("#price").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
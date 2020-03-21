function searchArtistArtworks() {
    var searchItem = $("#artworksearching").val();
    $.ajax({
        url: base_url_addr + "welcome/get_artwork_search_result",
        type: "POST",
        dataType: "json",
        data: 'search_string=' + searchItem,
        success: function (response) {
            if (response.status == 'success') {
                $('#page_artgoobi_content_area').fadeOut("slow");
                $("#dynamic_search_impose").html(response.data);
            } else {
                $('#dynamic_search_impose').html('');
                $('#page_artgoobi_content_area').show('slow');
            }
        }
    });
}

function openAdvanceCustomSearch() {
    $('#advance_search_modal').modal('show');
}

function artwork_advance_search_process() {
    $.ajax({
        url: base_url_addr + "welcome/get_artwork_advance_search_result",
        type: "POST",
        dataType: "json",
        data: $('#advance_search_form').serialize(),
        success: function (response) {
            $('#advance_search_modal').modal('hide');
            if (response.status == 'success') {
                $('#page_artgoobi_content_area').fadeOut("slow");
                $("#dynamic_search_impose").html(response.data);
            } else {
                $('#dynamic_search_impose').html('');
                $('#page_artgoobi_content_area').show('slow');
            }
        }
    });
}

function getTypeWiswMedia(type_id) {
    if (type_id) {
        $.ajax({
            url         : base_url_addr + "welcome/get_type_wise_media",
            type        : "POST",
            dataType    : "json",
            data        : 'type_id='+type_id,
            success     : function (response) {
                if (response.status == 'success') {
                    $("#media_selector").html(response.data);
                }
            }
        });
    }
}
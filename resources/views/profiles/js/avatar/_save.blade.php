$(document).on('click', '#saveAvatar', function() {

    var formData = new FormData(avatarForm[0]);
    formData.append('_method', 'PUT');

    $.ajax({
        url : avatarUrl,
        type : "POST",
        data : formData,
        contentType: false,
        processData: false,
        success: function(response)
        {
            $('#profileAvatar').load(location.href + ' #profileAvatar');
            // $('#authAvatar').load(location.href + ' #authAvatar')

            successResponse(avatarModal, response.message);
        },
        error: function(response)
        {
            errorResponse(avatarModal, jsonErrors(response));
        }
    });
});
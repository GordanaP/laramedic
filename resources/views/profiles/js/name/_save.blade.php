$(document).on('click', '#saveProfile', function() {

    var data = {
        title : title.val(),
        first_name : firstName.val(),
        last_name : lastName.val(),
    }

    $.ajax({
        url: showProfileUrl,
        type: "PUT",
        data: data,
        success: function(response) {

            $('#profileName').load(location.href + ' #profileName')
            // $('#authProfileName').load(location.href + ' #authProfileName')

            successResponse(profileNameModal, response.message)
        },
        error: function(response) {
            errorResponse(profileNameModal, jsonErrors(response))
        }
    });
});
$(document).on('click', '#saveLanguages', function(){

    var profileLanguages = $('#languages').val();

    $.ajax({
        url: profileUrl,
        type: 'PATCH',
        data: {
            languages : profileLanguages
        },
        success: function(response) {

            $('#profileLanguages').load(location.href + ' #profileLanguages')

            successResponse(languagesModal, response.message)
        },
        error: function(response) {
            errorResponse(languagesModal, jsonErrors(response))
        }
    });
});
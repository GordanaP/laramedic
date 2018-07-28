$(document).on('click', '#saveEducation', function(){

    var profileEducation = education.val();

    $.ajax({
        url: profileUrl,
        type: 'PATCH',
        data: {
            education : profileEducation
        },
        success: function(response) {

            $('#profileEducation').load(location.href + ' #profileEducation')

            successResponse(educationModal, response.message)
        },
        error: function(response) {
            errorResponse(educationModal, jsonErrors(response))
        }
    });
});
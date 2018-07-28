$(document).on('click', '#saveSpecialty', function() {

    var profileSpecialty = $('#specialty').val();

    $.ajax({
        url: profileUrl,
        type: 'PATCH',
        data: {
            specialty : profileSpecialty
        },
        success: function(response) {

            $('#specialtyDetails').load(location.href + ' #specialtyDetails')

            successResponse(specialtyModal, response.message)
        },
        error: function(response) {
            errorResponse(specialtyModal, jsonErrors(response))
        }
    });
});
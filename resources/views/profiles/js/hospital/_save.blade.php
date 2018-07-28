$(document).on('click', '#saveHospital', function(){

    var profileHospital = hospital.val();

    $.ajax({
        url: profileUrl,
        type: 'PATCH',
        data: {
            hospital : profileHospital
        },
        success: function(response) {

            $('#profileHospital').load(location.href + ' #profileHospital')

            successResponse(hospitalModal, response.message)
        },
        error: function(response) {
            errorResponse(hospitalModal, jsonErrors(response))
        }
    });
});

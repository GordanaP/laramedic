$(document).on('click', '#saveAchievements', function(){

    var profileAchievements = $('#achievements').val();

    $.ajax({
        url: profileUrl,
        type: 'PATCH',
        data: {
            achievements : profileAchievements
        },
        success: function(response) {

            $('#profileAchievements').load(location.href + ' #profileAchievements')

            successResponse(achievementsModal, response.message)
        },
        error: function(response) {
            errorResponse(achievementsModal, jsonErrors(response))
        }
    });
});
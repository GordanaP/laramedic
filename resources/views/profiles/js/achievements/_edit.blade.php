$(document).on('click', '#changeAchievements', function() {

   achievementsModal.modal('show');

    $.ajax({
        url: profileUrl,
        type: "GET",
        success: function(response)
        {
            var profile = response.profile;

            $('#achievements').val(profile.achievements);
        }
    });
});
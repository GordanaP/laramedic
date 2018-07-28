$(document).on('click', '#changeLanguages', function(e){

   languagesModal.modal('show');

    $.ajax({
        url: profileUrl,
        type: "GET",
        success: function(response)
        {
            var profile = response.profile;

            $('#languages').val(profile.languages);
        }
    });
});
$(document).on('click', '#changeSpecialty', function(e) {

   specialtyModal.modal('show');

    $.ajax({
        url: profileUrl,
        type: "GET",
        success: function(response)
        {
            var profile = response.profile;

            $('#specialty').val(profile.specialty);
        }
    });
});
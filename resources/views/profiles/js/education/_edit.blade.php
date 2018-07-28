$(document).on('click', '#changeEducation', function(e){

   educationModal.modal('show');

    $.ajax({
        url: profileUrl,
        type: "GET",
        success: function(response)
        {
            var profile = response.profile;

            education.val(profile.education);
        }
    });
});
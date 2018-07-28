$(document).on('click', '#changeHospital', function(e){

   hospitalModal.modal('show');

    $.ajax({
        url: profileUrl,
        type: "GET",
        success: function(response)
        {
            var profile = response.profile;

            hospital.val(profile.hospital);
        }
    });
});

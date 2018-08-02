$(document).on('click', '#changeAvatar', function() {

    avatarModal.modal('show');
    avatarModal.find('.modal-title span').text('Change avatar');

    $.ajax({
        url: showProfileUrl,
        type: "GET",
        success: function(response)
        {
            var avatar = response.profile.avatar;
            var filename = avatar ? avatar.filename : 'default.jpg';

            avatarModal.find('#displayAvatar').html(setAvatar(filename, 'image img-responsive rounded-circle'));
        }
    });
});
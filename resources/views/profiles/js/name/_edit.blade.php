$(document).on('click', '#editProfileName', function(){

    profileNameModal.modal('show');

    $.ajax({
        url: showProfileUrl,
        type: "GET",
        success: function(response) {

            var profile = response.profile;
            var roles = response.profile.user.roles;
            var roleIds = getUserRoles(roles);

            var roleToRemove = 3;
            var nonAdminRoleId = getFirstRoleId(roleIds, roleToRemove);
            var options = getRoleTitlesOptions(roles, nonAdminRoleId);

            title.empty().append(options);

            roleId.val(roleIds).trigger("change");
            title.val(profile.title);
            firstName.val(profile.first_name);
            lastName.val(profile.last_name);
        }
    });
});
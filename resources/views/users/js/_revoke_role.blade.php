$(document).on('click', '#revokeRole', function(){

    var adminRoleId = $(this).attr('data-role')
    var user = $(this).attr('data-user')
    var revokeRoleUrl = '/admin/revoke-role/' + user

    swal({
        title: 'Are you sure you want to revoke the role?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Revoke',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if(result.value == true)
        {
            $.ajax({
                url: revokeRoleUrl,
                type: 'DELETE',
                data: {
                    role_id : adminRoleId
                },
                success: function(response)
                {
                    datatable ? datatable.ajax.reload() : ''
                    successResponse(createAccountModal, response.message)
                }
            });
        }
    });
});
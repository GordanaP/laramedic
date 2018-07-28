$(document).on('click', '#deleteAchievements', function(){

    swal({
        title: 'Are you sure you want to delete the professional achievements?',
        text: 'Once the achievements have been deleted you will not be able to recover them!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if(result.value == true)
        {
            $.ajax({
                url: profileUrl,
                type: 'DELETE',
                data: {
                    attribute: 'achievements'
                },
                success: function(response)
                {
                    $('#profileAchievements').load(location.href + ' #profileAchievements')

                    successResponse(achievementsModal, response.message)
                }
            })
        }
    });
});
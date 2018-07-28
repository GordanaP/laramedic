$(document).on('click', '#deleteEducation', function(){

    swal({
        title: 'Are you sure you want to delete the education?',
        text: 'Once the educaton has been deleted you will not be able to recover it!',
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
                    attribute: 'education'
                },
                success: function(response)
                {
                    $('#profileEducation').load(location.href + ' #profileEducation')

                    successResponse(educationModal, response.message)
                }
            })
        }
    });
});
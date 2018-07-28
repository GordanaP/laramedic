$(document).on('click', '#deleteSpecialty', function(){

    swal({
        title: 'Are you sure you want to delete the specialty?',
        text: 'Once the specialty has been deleted you will not be able to recover it!',
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
                    attribute: 'specialty'
                },
                success: function(response)
                {
                    $('#specialtyDetails').load(location.href + ' #specialtyDetails')

                    successResponse(specialtyModal, response.message)
                }
            })
        }
    });
});
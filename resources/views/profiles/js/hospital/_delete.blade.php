$(document).on('click', '#deleteHospital', function(){

    swal({
        title: 'Are you sure you want to delete the hospital affiliation?',
        text: 'Once the hospital affiliation has been deleted you will not be able to recover it!',
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
                    attribute: 'hospital'
                },
                success: function(response)
                {
                    $('#profileHospital').load(location.href + ' #profileHospital')

                    successResponse(hospitalModal, response.message)
                }
            })
        }
    });
});
$(document).on('click', '#deleteLanguages', function(){

    swal({
        title: 'Are you sure you want to delete the languages?',
        text: 'Once the content has been deleted you will not be able to recover it!',
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
                    attribute: 'languages'
                },
                success: function(response)
                {
                    $('#profileLanguages').load(location.href + ' #profileLanguages')

                    successResponse(languagesModal, response.message)
                }
            })
        }
    });
});
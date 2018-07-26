$(document).on('click', '#saveSchedule', function() {

    var day = getSelectsValues('day_id');
    var start = getInputsValues('start_at');
    var end = getInputsValues('end_at');

    $.ajax({
        url: scheduleUrl,
        type: "PUT",
        data: {
            day: day,
            start: start,
            end: end
        },
        success: function(response)
        {
            $('#displaySchedule').load(location.href + ' #displaySchedule')
            $('.btn-schedule').attr('id', 'editSchedule').text('Change')

            successResponse(scheduleModal, response.message)
        },
        error: function(response)
        {
            var errors = getJsonErrors(response);

            formattedErrorResponse(errors);
        }
    });
});
$(document).on('click', '.btn-schedule', function(){

    var arrayName = 'day';
    var chunkSize = 3;
    var chunks = getChunks(arrayName, chunkSize);
    var days = [];

    for (var i = 0; i < chunks.length; i++) {

        days[i] = {
            "day_id": chunks[i][0],
            "start_at": chunks[i][1],
            "end_at": chunks[i][2],
        }
    }

    $.ajax({
        url: updateProfileUrl,
        type: "PUT",
        data: {
            days : days
        },
        success: function(response) {

            successResponse(scheduleModal, response.message);

            $('#profileSchedule').load(location.href + ' #profileSchedule')
        }
    });
});
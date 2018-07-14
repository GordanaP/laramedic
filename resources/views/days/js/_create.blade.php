$(document).on('click', '#createSchedule', function() {

    scheduleModal.modal('show');
    template.appendTo(templateHolder);

    $('.modal-title').text('Create schedule');
    $('.btn-schedule').attr('id', 'storeSchedule');
});
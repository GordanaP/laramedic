$(document).on('click', '#createSchedule', function() {

    scheduleModal.modal('show');
    avatarModal.find('.modal-title span').text('Create schedule');

    template.find('.invalid-feedback').text("").end().appendTo(container);
});
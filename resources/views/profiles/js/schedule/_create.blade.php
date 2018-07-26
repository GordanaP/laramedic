$(document).on('click', '#createSchedule', function() {

    scheduleModal.modal('show');

    template.find('.invalid-feedback').text("").end().appendTo(container);
    modalTitle.text('Create schedule');
});
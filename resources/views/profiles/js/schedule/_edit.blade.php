$(document).on('click', '#editSchedule', function() {

    scheduleModal.modal('show');
    scheduleModal.find('.modal-title span').text('Edit schedule');

    template.remove();

    $.ajax({
        url : showProfileUrl,
        type: "GET",
        success: function(response) {

            var days = response.profile.days;

            for (var i = 0; i < days.length; i++) {

                var btnId = i == 0 ? 'addRow' : '';
                var btnRemove = i == 0 ? '' : 'btn-remove';
                var faClass = i == 0 ? 'fa-plus' : 'fa-remove';

                cloneTemplate(template, container, i)
                    .find('button').attr('id', btnId).addClass(btnRemove).end()
                    .find($(".fa")).removeClass('fa-plus').addClass(faClass);

                $("select")[i].selectedIndex = days[i].id;
                $("input[name*='start_at")[i].value = days[i].work.start_at;
                $("input[name*='end_at")[i].value = days[i].work.end_at;
            }
        }
    });
});
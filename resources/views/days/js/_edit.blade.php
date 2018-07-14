$(document).on('click', '#editSchedule', function() {

    scheduleModal.modal('show');
    $('.modal-title').text('Edit schedule');

    $.ajax({
        url : showProfileUrl,
        type: "GET",
        success: function(response) {

            var days = response.profile.days;

            for (var i = 0; i < days.length; i++) {

                var field = i == 0 ? '' : 'field';
                var btnId = i == 0 ? 'addMore' : '';
                var btnRemove = i == 0 ? '' : 'btn-remove';
                var faClass = i == 0 ? 'fa-plus' : 'fa-remove';

                cloneScheduleTemplate(template, templateHolder, i)
                    .find('button').attr('id', btnId).addClass(btnRemove).end()
                    .find($(".fa")).removeClass('fa-plus').addClass(faClass);

                $("select")[i].selectedIndex = days[i].id;
                $("input[name='day[" + i + "][start_at]']").val(days[i].work.start_at);
                $("input[name='day[" + i + "][end_at]']").val(days[i].work.end_at);
            }
        }
    });
});

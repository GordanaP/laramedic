/**
 * Get the event start time.
 *
 * @param  {string} view
 * @param  {string} momentDate
 * @param  {string} timeFormat
 * @param  {number} hour
 * @return {string}
 */
function formatMomentTime(view, momentDate, timeFormat, hour=9)
{
    return view.name == "month" ? momentDate.set('hour', hour).format(timeFormat)
                                : momentDate.format(timeFormat)
}

/**
 * Get the event time.
 *
 * @param  {string} momentDate
 * @param  {string} dateFormat
 * @return {string}
 */
function formatMomentDate(momentDate, dateFormat)
{
    return momentDate.format(dateFormat)
}

/**
 * Determine if the date is in the past.
 *
 * @param  {string}  momentDate
 * @param  {string}  dateFormat
 * @return {Boolean}
 */
function isPast(momentDate, dateFormat)
{
    var selectedDate = momentDate.format(dateFormat);
    var today = moment().format(dateFormat);

    return selectedDate < today
}

/**
 * Determine if the business is open
 *
 * @param  {string}  momentDate
 * @param  {string}  timeFormat
 * @param  {string}  businessOpen
 * @param  {string}  businessClose
 * @return {boolean}
 */
function isNotBusinessHour(momentDate, timeFormat, businessOpen, businessClose)
{
    return timeFormatted(momentDate, timeFormat) < businessOpen || timeFormatted(momentDate, timeFormat) >= businessClose
}

function timeFormatted(momentDate, format)
{
    return momentDate.format(format)
}

/**
 * Get the calendar time interval for the specified profile.
 *
 * @param  {int} profileId
 * @param  {array} profilesInt
 * @param  {int} intervalMins
 * @return {string}
 */
function slotDuration(profileId, profilesInt, intervalMins)
{
    return $.inArray(profileId, profilesInt) !== -1 ? slotDurationFormatted(intervalMins) : slotDurationFormatted()
}

/**
 * Get the fullcalendar time interval formatted.
 *
 * @param  {int} intervalMins
 * @return {string}
 */
function slotDurationFormatted(intervalMins=30)
{
    return '00:'+intervalMins+':00'
}


function timeTimestamp(time)
{
    return time+':00'
}

/**
 * Determin if the day is not Sunday
 *
 * @param  {string}  momentDate
 * @return {boolean}
 */
function isSunday(momentDate)
{
    return getDay(momentDate) == 0
}

function getDay(momentDate)
{
    return momentDate.day()
}

function disableInvalidDateOrTime(momentDate, dateFormat, timeFormat, businessOpen, businessClose, modal)
{
    if(isPast(momentDate, dateFormat))
    {
        alert('Invalid date')
    }
    else if (isSunday(momentDate))
    {
        alert('Sunday is not a work day')
    }
    else if (getDay(momentDate) == 6 && isNotBusinessHour(momentDate, timeFormat, businessOpen, businessClose))
    {
        alert('Time must be inside business operating hours')
    }
    else
    {
        modal.open()
    }
}

function getFullName(firstName, lastName)
{
  return firstName + ' ' + lastName;
}

/**
 * Determine business hours.
 *
 * @param  {array} days
 * @return {array}
 */
function businessHours(days)
{
    let tempArray = [];

    for (var i = 0; i < days.length; i++) {

        tempArray.push(days[i].id, days[i].work.start_at, days[i].work.end_at);
    }

    var chunks = chunkArray(tempArray, 3);

    var hours = [];

    for (var i = 0; i < chunks.length; i++) {

        hours[i] = {
            'dow': [chunks[i][0]],
            'start': chunks[i][1],
            'end': chunks[i][2],
        }
    }

    return hours;
}

/**
 * Determine if the selected hour is a valid business hour.
 *
 * @param  {array}  profileBusinessHours  [multidimensional array]
 * @param  {string}  momentDate           [moment date]
 * @param  {string}  timeFormat           [i.e. 00:00]
 * @return {Boolean}
 */
function isValidBusinessHour(profileBusinessHours, momentDate, dateFormat, timeFormat)
{
    var validDate = !isPast(momentDate, dateFormat);
    var day = momentDate.day();
    var time = momentDate.format(timeFormat);
    var alertText = 'You selected the past date!';

    for (var i = 0; i < profileBusinessHours.length; i++) {

        var dow = profileBusinessHours[i].dow;
        var validHour = dow.indexOf(day) == 0 && time >= profileBusinessHours[i].start && time < profileBusinessHours[i].end;

        if(validHour)
        {
            return validDate ? true : alert(alertText);
        }
    }
}

function openScheduleAppModal(modal, disabledFields)
{
    modal.modal('show');
    modal.find('.modal-title .icon').removeClass('icon-event').addClass('icon-calendar');
    modal.find('.modal-title span').text('New appointment');
    modal.find('.app-button').text('Schedule appointment').attr('id', 'storeApp');
    modal.find('.delete-app-button').hide();
    removeAttribute(disabledFields, 'disabled');
}

function openRescheduleAppModal(modal, disabledFields, appointmentId)
{
    modal.modal('show');
    modal.find('.modal-title .icon').removeClass('icon-calendar').addClass('icon-event');
    modal.find('.modal-title span').text('Edit appointment');
    modal.find('.app-button').text('Reschedule appointment').attr('id', 'updateApp').val(appointmentId);
    modal.find('.delete-app-button').show().val(appointmentId);
    addAttribute(disabledFields, 'disabled');

}
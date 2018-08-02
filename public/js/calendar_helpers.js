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


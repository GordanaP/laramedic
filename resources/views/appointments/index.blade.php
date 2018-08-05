@extends('layouts.app')

@section('title', '| Admin | Calendar')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar-3.9.0/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar-3.9.0/fullcalendar.print.min.css') }}" type="media" >
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.css') }}">

    <style>
        .fc-view-container { background: #fff }
    </style>
@endsection

@section('content')

    <div class="container" id="appContainer">
        <div class="row">
            <div class="col-md-2">
                @foreach ($doctors as $doctor)
                    <p>
                        <a href="{{ route('admin.appointments.index', $doctor) }}">
                            Dr {{$doctor->full_name}}
                        </a>
                    </p>
                @endforeach
            </div>

            <div class="col-md-10">
                <div id="appCalendar"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="appModal">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="icon mr-1"></i>
                            <span class="ls-1"></span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-uppercase mb-3">Appointment details</p>

                        <form id="appForm">

                            <!-- Doctor -->
                            <div class="form-group">
                                <label for="doctor">Doctor</label>
                                <input type="text" name="doctor" id="doctor" class="form-control rounded-none" />
                            </div>

                            <div class="row">
                                <!-- App date -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="app_date">Date</label>
                                        <input type="text" name="app_date" id="app_date" class="form-control rounded-none" placeholder="yyyy-mm-dd" />

                                        <span class="invalid-feedback date"></span>
                                    </div>
                                </div>

                                <!-- App time -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="app_start">Time: <span id="app-time-label"></span></label>
                                        <input type="text" name="app_start" id="app_start" class="form-control rounded-none" placeholder="hh:mm" />

                                        <span class="invalid-feedback start_at"></span>
                                    </div>
                                </div>
                            </div>

                            <p class="mb-3 mt-4 text-uppercase">Patient details</p>

                            <div class="row">
                                <!-- First name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="f_name">First name</label>
                                        <input type="text" name="f_name" id="f_name" class="form-control rounded-none" placeholder="Enter first name" />

                                        <span class="invalid-feedback first_name"></span>
                                    </div>
                                </div>

                                <!-- Last name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="l_name">Last name</label>
                                        <input type="text" name="l_name" id="l_name" class="form-control rounded-none" placeholder="Enter last name" />

                                        <span class="invalid-feedback last_name"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Birthday -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        <input type="text" name="birthday" id="birthday" class="form-control rounded-none" placeholder="yyyy-mm-dd" />

                                        <span class="invalid-feedback birthday"></span>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone number</label>
                                        <input type="text" name="phone" id="phone" class="form-control rounded-none" placeholder="Enter phone number" />

                                        <span class="invalid-feedback phone"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer flex justify-between">
                        <div>
                            <button type="button" class="btn btn-danger delete-app-button" data-dismiss="modal" id="deleteApp">Delete</button>
                        </div>
                        <div>
                            <button type="button" class="btn app-button bg-indigo-dark text-white"></button>
                            <button type="button" class="btn close-button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.17/moment-timezone-with-data.min.js"></script>
    <script src="{{ asset('vendor/fullcalendar-3.9.0/fullcalendar.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar-3.9.0/gcal.js') }}"></script>
    <script src="{{ asset('vendor/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/timepicker-1.6.3/timepicker-addon.js') }}"></script>

    <script>

        // Calendar variables
        var calendar = $('#appCalendar');
        var defaultView = "{{ $profile ? 'agendaWeek' : 'month' }}";
        var timezone = "{{ config('app.timezone') }}";
        var dateFormat = "YYYY-MM-DD";
        var timeFormat = "HH:mm";
        var firstDay = 1;
        var businessOpen = '09:00';
        var businessClose = '20:00';
        var slotDuration = '00:20:00';
        var profileBusinessDaysIds = "{{ optional($profile->days)->pluck('id') }}";
        var profileBusinessDays = @json($profile->days);
        var profileBusinessHours = businessHours(profileBusinessDays);


        // App variables
        var appointmentsUrl = "{{ route('admin.appointments.index', $profile) }}";
        var profileName = "{{ $profile->full_name }}";
        var appModal = $('#appModal');

        var doctor = $('#doctor');
        var app_date = $('#app_date');
        var app_start = $('#app_start');
        var f_name = $('#f_name');
        var l_name = $('#l_name');
        var birthday = $('#birthday');
        var phone = $('#phone');
        var disabledFields = [ f_name, l_name, birthday, phone ];
        var invalidFeedbackFields = ['date', 'start_at', 'first_name', 'last_name', 'birthday', 'phone' ];

        appModal.setAutofocus('#app_date');
        appModal.emptyModal(invalidFeedbackFields);

        // Calendar
        calendar.fullCalendar({
            header: {
                left: 'prev, next, today',
                right: 'month, agendaWeek, agendaDay, list',
                center: 'title',
            },
            navLinks: true,
            defaultView: defaultView,
            fixedWeekCount:false,
            handleWindowResize: true,
            displayEventTime: false,
            showNonCurrentDates: true,
            timezone: timezone,
            timeFormat: timeFormat,
            allDaySlot:false,
            slotLabelFormat: timeFormat, // 16:00
            slotDuration: slotDuration,
            firstDay: firstDay,
            businessHours: profileBusinessHours,
            minTime: businessOpen,
            maxTime: businessClose,
            editable: true,
            selectable: true,
            defaultTimedEventDuration: slotDuration,
            events: appointmentsUrl,
            eventDataTransform: function(event) {

                event.title = getFullName(event.patient.first_name, event.patient.last_name);
                event.start = event.start_at;
                event.color = 'yellow';

                return event;
            },
            select: function(start, end, jsEvent, view)
            {
                // Modal
                isValidBusinessHour(profileBusinessHours, start, dateFormat, timeFormat)
                    ? openScheduleAppModal(appModal,disabledFields) : '';

                // Form
                var appDate = formatMomentDate(start, dateFormat)
                var appStart = formatMomentTime(view, start, timeFormat)

                doctor.val(profileName).attr('disabled', true);
                app_date.val(appDate);
                app_start.val(appStart);
            },
            eventClick: function(event, jsEvent, view) {

                // Modal
                openRescheduleAppModal(appModal,disabledFields, event.id)

                // Form
                var patient = event.patient;
                var appDate = formatMomentDate(event.start, dateFormat);
                var appStart = formatMomentTime(view, event.start, timeFormat);
                var patBirthday = formatMomentDate(moment(patient.birthday), dateFormat);

                doctor.val(profileName).attr('disabled', true);
                f_name.val(patient.first_name);
                l_name.val(patient.last_name);
                birthday.val(patBirthday);
                phone.val(patient.phone);
                app_date.val(appDate);
                app_start.val(appStart);
            },
        });

        // Store app
        $(document).on('click', '#storeApp', function(){

            var data = {
                date : app_date.val(),
                start_at: app_start.val(),
                first_name: f_name.val(),
                last_name: l_name.val(),
                birthday: birthday.val(),
                phone: phone.val(),
            }

            $.ajax({
                url: appointmentsUrl,
                type: "POST",
                data: data,
                success: function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    successResponse(appModal, response.message);
                },
                error: function(response)
                {
                    errorResponse(appModal, jsonErrors(response))
                }
            });
        });

        // Update app
        $(document).on('click', '#updateApp', function(){

            var data = {
                app_id : $(this).val(),
                date : app_date.val(),
                start_at: app_start.val(),
            }

            $.ajax({
                url: appointmentsUrl,
                type: "PUT",
                data: data,
                success: function(response)
                {
                    console.log(response)
                    calendar.fullCalendar('refetchEvents');
                    successResponse(appModal, response.message);
                },
                error: function(response)
                {
                    errorResponse(appModal, jsonErrors(response))
                }
            });
        });

        // Delete app
        $(document).on('click', '#deleteApp', function(){
            var data = {
                app_id : $(this).val(),
            }

            $.ajax({
                url: appointmentsUrl,
                type: "DELETE",
                data: data,
                success: function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    successResponse(appModal, response.message);
                }
            });
        });

    </script>

@endsection
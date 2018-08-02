@extends('layouts.admin')

@section('title', ' | Admin | Test')


@section('content')

    <div class="modal fade" tabindex="-1" role="dialog" id="appModal">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="icon icon-event mr-1"></i>
                            <span class="ls-1"></span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-uppercase mb-3">Appointment details</p>

                        <form id="appForm">

                            <!-- Doctor -->
                            <div class="form-group">
                                <label for="profile_id">Doctor</label>
                                <input type="text" name="profile_id" id="profile_id" class="form-control rounded-none" />

                                <span class="invalid-feedback profile_id"></span>
                            </div>

                            <div class="row">
                                <!-- App date -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="app_date">Date</label>
                                        <input type="text" name="app_date" id="app_date" class="form-control rounded-none" placeholder="yyyy-mm-dd" />

                                        <span class="invalid-feedback app_date"></span>
                                    </div>
                                </div>

                                <!-- App time -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="app_start">Time: <span id="app-time-label"></span></label>
                                        <input type="text" name="app_start" id="app_start" class="form-control rounded-none" placeholder="hh:mm" />

                                        <span class="invalid-feedback app_start"></span>
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

                                        <span class="invalid-feedback f_name"></span>
                                    </div>
                                </div>

                                <!-- Last name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="l_name">Last name</label>
                                        <input type="text" name="l_name" id="l_name" class="form-control rounded-none" placeholder="Enter last name" />

                                        <span class="invalid-feedback l_name"></span>
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

                                        <span class="invalid-feedback name phone"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer flex justify-between">
                        <div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteApp">Delete</button>
                        </div>
                        <div>
                            <button type="button" class="btn app-button"></button>
                            <button type="button" class="btn close-button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


@endsection

@section('scripts')
    <script>
        var calendar = $('#appointmentsCalendar'),
            timezone = "{{ config('app.timezone') }}",
            standardBusinessOpen = '09:00',
            standardBusinessClose = '20:00',
            satBusinessOpen = '10:00',
            satBusinessClose = '15:00',
            appointmentsUrl = "{{ route('admin.appointments.index', $profile) }}",
            appModal = $("#appModal"),
            appModalTitle = $(".modal-title span"),
            profileName = "{{ $profile->full_name }}",
            profile_id = $("#profile_id"),
            app_date = $("#app_date"),
            app_start = $("#app_start"),
            f_name = $("#f_name"),
            l_name = $("#l_name"),
            birthday = $("#birthday"),
            phone = $("#phone"),
            appButton = $(".app-button"),
            deleteButton = $("#deleteApp"),
            dateFormat = "YYYY-MM-DD",
            timeFormat = "HH:mm"

            var appFormFields = ['profile_id','app_date', 'app_start', 'first_name', 'last_name', 'birthday', 'phone']
            var disabledFields = [ f_name, l_name, birthday, phone ]
            var standardBusinessDays = [1, 2, 3, 4, 5]
            var saturday = [ 6 ]

        calendar.fullCalendar({
            header: {
                left: 'prev, next, today',
                right: 'month, agendaWeek, agendaDay, list',
                center: 'title',
            },
            defaultView: "{{ $profile ? 'agendaWeek' : 'month' }}",
            fixedWeekCount:false,
            handleWindowResize: true,
            displayEventTime: false,
            showNonCurrentDates: true,
            allDaySlot:true,
            slotLabelFormat: timeFormat, // 16:00
            firstDay: 1,
            navLinks: true,
            selectHelper: true,
            editable: true,
            selectable: true,
            businessHours: [
                {
                    dow : [1,2,3,4,5],
                    start: standardBusinessOpen,
                    end: standardBusinessClose,
                },
                {
                    dow: saturday,
                    start: satBusinessOpen,
                    end: satBusinessClose
                }
            ],
            minTime: standardBusinessOpen,
            maxTime: standardBusinessClose,
            eventLimit: true,
            timezone: timezone,
            events:  {
                url: appointmentsUrl,
                textColor: 'black',
                timeFormat: timeFormat
            },
            //transform event attributes into event object attributes
            eventDataTransform: function(event) {

                event.title = 'Goca'

                return event;
            },
            select: function(start, end, jsEvent, view) {

                // Manage modal
                appModal.modal('show');

                appModalTitle.text('New appointment')
                appButton.addClass('bg-indigo-dark text-white').text('Schedule appointment').attr('id', 'storeApp')
                deleteButton.hide()

                // Manage form
                var appDate = eventDate(start, dateFormat)
                var appStart = eventStart(view, start, timeFormat)

                profile_id.val(profileName).attr('disabled', true)
                app_date.val(appDate)
                app_start.val(appStart)
                // removeAttribute(disabledFields, 'disabled')
            },
        });


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
                    console.log(response)
                    successResponse(appModal, response.message);
                }
            });
        });

    </script>

@endsection
@extends('layouts.admin')

@section('title', ' | About')

@section('content')

    @admcontent
        @slot('card')

            <!-- Title -->
            <div class="card-header admin-card-header p-3 flex align-center">
                <h1 class="font-medium text-4xl ml-3 mb-0">
                    {{ $profile->title_name }} {{ $profile->full_name }}
                </h1>

                <button type="button" class="btn btn-success btn-lg ml-3" id="#">
                    Change
                </button>
            </div>

            <div class="card-body mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card admin">

                            <!-- Avatar -->
                            @include('profiles.html._avatar')

                            <!-- Schedule -->
                            @include('profiles.html._schedule')

                        </div>
                    </div>

                    <div class="col-md-8 pl-3">

                        <!-- Details -->
                        @include('profiles.html._details')

                    </div>
                </div>
            </div>
        @endslot
    @endadmcontent

    @include('profiles.modals._schedule')
@endsection

@section('scripts')
    <script>

        // Profile
        var showProfileUrl = "{{ route('admin.profiles.show', $profile) }}";

        // Schedule
        var scheduleUrl = "{{ route('admin.schedule.update', $profile) }}";
        var scheduleModal = $('.schedule-modal');
        var modalTitle = $('.modal-title');
        var days = @json($days);

        var container = $('section#days');
        var rows = container.children();
        var template = rows.first();
        var counter = 0;

        scheduleModal.emptyModal();
        scheduleModal.on('hidden.bs.modal', function() {
            container.empty();
        });

        // Create schedule
        $(document).on('click', '#createSchedule', function() {

            scheduleModal.modal('show');

            template.find('.invalid-feedback').text("").end().appendTo(container);
            modalTitle.text('Create schedule');
        });

        // Add rows
        $(document).on('click', '#addRow', function(){

            var rows = container.children();
            var totalRows = rows.length;
            var maxRows = days.length;

            if(totalRows < maxRows)
            {
                addRow(container, counter)
                    .find('button').removeAttr('id').addClass('btn-remove').end()
                    .find('.fa').removeClass('fa-plus').addClass('fa-remove');
            }
        });

        //Remove rows
        $(document).on('click', '.btn-remove', function() {
            removeRow($(this));
        });

        // Save schedule
        $(document).on('click', '#saveSchedule', function() {

            var day = getSelectsValues('day_id');
            var start = getInputsValues('start_at');
            var end = getInputsValues('end_at');

            $.ajax({
                url: scheduleUrl,
                type: "PUT",
                data: {
                    day: day,
                    start: start,
                    end: end
                },
                success: function(response)
                {
                    $('#displaySchedule').load(location.href + ' #displaySchedule')
                    $('.btn-schedule').attr('id', 'editSchedule').text('Change')

                    successResponse(scheduleModal, response.message)
                },
                error: function(response)
                {
                    var errors = getJsonErrors(response);

                    formattedErrorResponse(errors);
                }
            });
        });

        // Edit schedule
        $(document).on('click', '#editSchedule', function() {

            scheduleModal.modal('show');

            template.remove();
            modalTitle.text('Edit schedule');

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

    </script>
@endsection
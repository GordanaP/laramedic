@extends('layouts.admin')

@section('title', ' | Admin | Test')

@section('content')

    @php
        $profile = \App\Profile::first();
        // $profile = \App\Profile::find(2);
    @endphp

    <div class="container">
        <h1>Test Page</h1>

        <button type="button" id="{{ $profile->hasSchedule() ? 'editSchedule' : 'createSchedule' }}">
            {{ $profile->hasSchedule() ? 'Edit' : 'Add' }} schedule
        </button>
    </div>

    <div class="modal schedule-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-calendar mr-2"></i> Create schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="scheduleForm">
                    <div class="modal-body">
                        <section id="days">
                            <fieldset id="0">
                                <div class="flex">
                                    <div class="flex">
                                        <div class="form-group flex-1 mr-1">
                                            <label class="day">Day #1</label>
                                            <select name="day[]" class="form-control">
                                                <option value="">Select a day</option>
                                                @foreach ($days as $day)
                                                    <option value="{{ $day->id }}">{{ $day->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback day day-0"></span>
                                        </div>

                                        <div class="form-group flex-1 mr-1">
                                            <label>Start</label>
                                            <input type="text" name="start[]" class="form-control" placeholder="00:00" />
                                            <span class="invalid-feedback start start-0"></span>
                                        </div>

                                        <div class="form-group flex-1 mr-1">
                                            <label>End</label>
                                            <input type="text" name="end[]" class="form-control" placeholder="00:00">
                                            <span class="invalid-feedback end end-0"></span>
                                        </div>
                                    </div>
                                    <div style="margin-top: 26px">
                                        <button type="button" class="btn btn-primary" id="addRow"><i class="fa fa-plus" ></i></button>
                                    </div>
                                </div>
                            </fieldset>
                        </section>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="storeSchedule">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </form>

            </div>
        </div>
    </div>



@endsection


@section('scripts')
<script>

    // Profile
    var showProfileUrl = "{{ route('admin.profiles.show', $profile) }}";

    // Schedule
    var scheduleUrl = "{{ route('admin.schedule.update', $profile) }}";
    var scheduleModal = $('.schedule-modal');
    var counter = 0;

    scheduleModal.emptyModal();
    scheduleModal.on('hidden.bs.modal',function() {
        $('fieldset:not(:first)').detach()
    });

    // Add rows
    $(document).on('click', '#addRow', function() {

        var container = $('#days');
        var maxRows = @json($days).length;

        addRow(container, counter, maxRows)
            .find('button').removeAttr('id').addClass('btn-remove').end()
            .find($(".fa")).removeClass('fa-plus').addClass('fa-remove');
    });

    // Remove rows
    $(document).on('click', '.btn-remove', function() {
        removeRow($(this));
    });

    // Create schedule
    $(document).on('click', '#createSchedule', function() {
        scheduleModal.modal('show');
    })

    // Store schedule
    $(document).on('click', '#storeSchedule', function(){

        var days = $( "select[name*='day']" );
        var starts = $( "input[name*='start']" );
        var ends = $( "input[name*='end']" );

        var day = makeArray(days);
        var start = makeArray(starts);
        var end = makeArray(ends);

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
                var errors = response.responseJSON.errors;

                for(error in errors) {

                    var formattedError = error.replace(/\./g , "-");

                    $('span.'+formattedError).text(errors[error][0]).show()
                }

                removeErrorOnNewInput()
            }
        });
    });

</script>
@endsection
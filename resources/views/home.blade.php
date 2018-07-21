@extends('layouts.app')

@section('title', '| Home')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @php
                    $profile = \App\Profile::first();
                    $days = \App\Day::all();
                @endphp

                <button type="button" class="btn btn-success" id="createSchedule">Add schedule</button>

            </div>
        </div>
    </div>

    <div class="modal schedule-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('_form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveSchedule">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        var scheduleUrl = "{{ route('admin.schedule.update', $profile) }}";
        var scheduleModal = $(".schedule-modal");
        var container = $('section#days');
        var template = $('fieldset.day:first');
        var counter = 0;

        scheduleModal.emptyModal();
        scheduleModal.on('hidden.bs.modal',function() {
            $("fieldset.day:not(:first)").remove();
        });

        $(document).on('click', '#createSchedule', function(){

            scheduleModal.modal('show');
        });

        $(document).on('click', '#addRow', function(){

            var rows = $('fieldset.day');
            var totalRows = rows.length;
            var maxRows = @json($days).length;
            counter++;

            var fields = $('.dynamic');
            var dinamicFields = makeNewArray(fields);
            var index = findMissingValue(dinamicFields);


            // console.log(missing)

            if (totalRows < maxRows) {

                template.clone()
                    .attr('data-order', missing)
                    .find('input').val("").end()
                    .find('span.invalid-feedback').text("").end()
                    .find('button').removeAttr('id').addClass('btn-remove').end()
                    .find('.fa').removeClass('fa-plus').addClass('fa-remove').end()
                    .find('span.day').removeClass('day-0').addClass('day-'+missing).end()
                    .find('span.start').removeClass('start-0').addClass('start-'+missing).end()
                    .find('span.end').removeClass('end-0').addClass('end-'+missing).end()
                    .appendTo(container)

                    //container.find('fieldset.day').sort(sortEm).appendTo(container);
            }
        });

        $(document).on('click', '.btn-remove', function() {
            $(this).parents().eq(3).remove();

            $('fieldset.day').each(function(i) {
                $(this).attr('data-order', i)
                .find('.day').removeClass('day-'+(i+1)).addClass('day-'+ i).end()
                .find('.start').removeClass('start-'+ (i+1)).addClass('start-'+ i).end()
                .find('.end').removeClass('end-'+ (i+1)).addClass('end-'+ i)
            });
        });

        $(document).on('click', '#saveSchedule', function(){

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
                success: function(response) {
                    successResponse(scheduleModal, response.message);
                },
                error: function(response) {

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
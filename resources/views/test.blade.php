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
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="scheduleForm">
                    <div class="modal-body">
                        <div id="sections">
                            <div class="form-group section">
                                <label for="">Day 1</label>
                                <div class="flex" id="0">
                                    <select name="day[0][day_id]" class="form-control mr-1">
                                        <option value="">Select a day</option>
                                        @foreach (\App\Day::all() as $day)
                                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                                        @endforeach
                                    </select>
                                    <input name="day[0][start_at]" type="text" class="form-control mr-1" />
                                    <input name="day[0][end_at]"type="text" class="form-control mr-1" />
                                    <button type="button" class="btn btn-info" id="addMore">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- dynamic sections here -->
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-schedule">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script>

    var showProfileUrl = "{{ route('admin.profiles.show', $profile) }}";
    var scheduleModal = $('.schedule-modal');
    var template = $('#sections .section:first').detach()
    var templateHolder = $('#sections');
    var sectionsCount = 0;

    scheduleModal.emptyModal();
    scheduleModal.on('hidden.bs.modal',function() {
        $('#sections .section:first').detach();
        $('.field').parent().remove();
    });

    $(document).on('click', '#addMore', function() {

        var sections = $('.section');
        var totalSections = sections.length;
        var maxSections = @json($days).length;
        var fields = $('.field')
        var dinamicFields = makeNewArray(fields)
        var index = findMissingValue(dinamicFields)

        sectionsCount++;

        if (totalSections < maxSections) {

            cloneScheduleTemplate(template, templateHolder, index)
                .find('button').removeAttr('id').addClass('btn-remove').end()
                .find($(".fa")).removeClass('fa-plus').addClass('fa-remove');
        }
    });

    $(document).on('click', '.btn-remove', function(){
        $(this).parents().eq(1).remove()
    });

    $(document).on('click', '#createSchedule', function() {

        scheduleModal.modal('show');
        template.appendTo('#sections')

        $('.modal-title').text('Create schedule')

    })

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

</script>
@endsection
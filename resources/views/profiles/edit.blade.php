@extends('layouts.admin')

@section('title', ' | Admin | Profile')

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

        var scheduleModal = $('#scheduleModal');
        var scheduleSection = $('#scheduleSection');
        var addRow = $('#addRow');
        var row = $('.day-row');
        var rowLast = $('.day-row:last');
        var dynRow = $('.dynamic')
        var totalRows = dynRow.length
        var maxRows = 4

        $(document).on('click', '#addSchedule', function(){
            scheduleModal.modal('show')
        })

        var i = 0;

        addRow.on('click', function() {

            var rows = $('.dynamic')
            var totalRows = rows.length
            var maxRows = 3

            if (totalRows < maxRows) {

                i ++;

                var html = '<div class="form-group dynamic"><label>Day #1</label><div class="flex day-row" id="field-0"><select type="text" class="form-control mr-1" name="day[0][day_id]"><option value="">Select a day</option></select><input type="text" class="form-control mr-1" placeholder="00:00" name="day[0][start_at]"><input type="text" class="form-control mr-1" placeholder="00:00" name="day[0][end_at]"><button type="button" class="btn btn-default bg-grey btn-schedule" id="addRow"><i class="fa fa-plus"></i></button></div></div>';
            }


            $('#scheduleSection').append(html);


        });

    </script>
@endsection
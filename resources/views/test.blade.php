@extends('layouts.admin')

@section('title', ' | Admin | Test')

@section('content')

    @php
        // $profile = \App\Profile::first();
        $profile = \App\Profile::find(2);
    @endphp

    <div class="container">
        <h1>Test Page</h1>

        <div class="card-body" id="profileSchedule">
            @forelse ($profile->days as $day)
                <p>
                    {{ $day->name }} <span>{{ $day->work->start_at }}</span> - <span>{{ $day->work->end_at }}</span>
                </p>
            @empty
                No days at present.
            @endforelse

            <div class="row">
                <div class="col-md-12">
                    <button type="button"  class="btn btn-warning btn-sm" id="{{ $profile->hasSchedule() ? 'editSchedule' : 'createSchedule' }}">
                        {{ $profile->hasSchedule() ? 'Edit' : 'Add' }} schedule
                    </button>
                </div>
            </div>
        </div>

    </div>

    @include('days.modals._save')

@endsection


@section('scripts')
<script>

    var showProfileUrl = "{{ route('admin.profiles.show', $profile) }}";
    var updateProfileUrl = "{{ route('admin.profiles.update', $profile) }}";
    var scheduleModal = $('.schedule-modal');
    var template = $('#sections .section:first').detach()
    var templateHolder = $('#sections');
    var sectionsCount = 0;

    scheduleModal.emptyModal();
    scheduleModal.on('hidden.bs.modal',function() {
        $('#sections .section:first').detach();
        $('.field').parent().remove();
    });

    // Add/remove fields dynamically
    @include('days.js._dynamic_fields')

    // Create schedule
    @include('days.js._create')

    // Edit schedule
    @include('days.js._edit')

    // Save schedule
    @include('days.js._save')

</script>
@endsection
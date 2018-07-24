<div id="displaySchedule">
    <div class="card-body mt-3 pb-2 pl-3">
        <p class="card-title flex items-center justify-between mb-0" >
            <span class="mr-2 uppercase tracking-wide font-semibold">
                Schedule
            </span>

            <button type="button" class="btn btn-warning btn-schedule btn-link tracking-wide pull-right py-1 px-2" id="{{ $profile->hasSchedule() ? 'editSchedule' : 'createSchedule' }}">
                {{ $profile->hasSchedule() ? 'Change' : 'Add' }}
            </button>
        </p>
    </div>

    <ul class="list-group">
        @foreach ($profile->days as $day)
            <li class="list-group-item">
                {{ $day->name }}
                <span class="pull-right">{{ $day->work->start_at }} - {{ $day->work->end_at }}</span>
            </li>
        @endforeach
    </ul>
</div>
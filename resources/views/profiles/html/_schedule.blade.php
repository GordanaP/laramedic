<div class="card-body mt-3 pb-2 pl-3">
    <p class="card-title flex items-center justify-between mb-0" >
        <span class="mr-2 uppercase tracking-wide font-semibold">
            Schedule
        </span>

        <button class="btn btn-warning btn-link tracking-wide pull-right py-1 px-2" id="{{ $profile->hasSchedule() ? 'editSchedule' : 'addSchedule' }}" value="{{ $profile->slug }}">
            {{ $profile->hasSchedule() ? 'Change' : 'Add' }}
        </button>
    </p>
</div>

<ul class="list-group" id="displayProfileSchedule">
    <li class="list-group-item">
        Monday
        <span class="pull-right">10:00 - 12:00</span>
    </li>
    <li class="list-group-item">
        Friday
        <span class="pull-right">15:00 - 20:00</span>
    </li>
</ul>
// Variables
var scheduleUrl = "{{ route('admin.schedule.update', $profile) }}";
var scheduleModal = $('#scheduleModal');
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
@include('profiles.js.schedule._create');

// Add & remove rows
@include('profiles.js.schedule._dynamic_rows');

// Save schedule
@include('profiles.js.schedule._save');

// Edit schedule
@include('profiles.js.schedule._edit');

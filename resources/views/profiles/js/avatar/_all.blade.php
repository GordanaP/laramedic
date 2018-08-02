// Variables
var avatarUrl = "{{ route('admin.avatars.update', $profile) }}";
var avatarModal = $('#avatarModal');
var avatarForm = $('#avatarForm');
var avatarFields = ['avatar_options', 'avatar'];


avatarModal.setAutofocus('avatar_options');
avatarModal.emptyModal(avatarFields);

// Change avatar
@include('profiles.js.avatar._change');

// Save avatar
@include('profiles.js.avatar._save');

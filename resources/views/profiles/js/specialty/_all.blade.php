// Variables
var specialtyModal = $('#profileSpecialtyModal');
var specialtyFields = ['specialty'];

specialtyModal.setAutofocus('specialty');
specialtyModal.emptyModal(specialtyFields);

// Edit specialty
@include('profiles.js.specialty._edit');

// Save specialty
@include('profiles.js.specialty._save');

// Delete specialty
@include('profiles.js.specialty._delete');

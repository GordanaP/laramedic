// Variables
var educationModal = $('#profileEducationModal');
var educationFields = ['education'];

educationModal.setAutofocus('education');
educationModal.emptyModal(educationFields);

var education = $('#education');

// Edit roles
@include('profiles.js.education._edit');

// Save roles
@include('profiles.js.education._save');

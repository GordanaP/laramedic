// Variables
var educationModal = $('#profileEducationModal');
var educationFields = ['education'];

educationModal.setAutofocus('education');
educationModal.emptyModal(educationFields);

// Edit education
@include('profiles.js.education._edit');

// Save education
@include('profiles.js.education._save');

// Delete education
@include('profiles.js.education._delete');

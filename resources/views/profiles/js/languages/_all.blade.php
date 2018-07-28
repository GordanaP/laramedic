// Variables
var languagesModal = $('#profileLanguagesModal');
var languagesFields = ['languages'];

languagesModal.setAutofocus('languages');
languagesModal.emptyModal(languagesFields);

// Edit languages
@include('profiles.js.languages._edit');

// Save languages
@include('profiles.js.languages._save');

// Delete languages
@include('profiles.js.languages._delete');

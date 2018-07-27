// Variables
var profileNameModal = $('#profileNameModal');
var selectRoles = $('select.role_id');
var roleId = $("#roleId");
var title = $('#title');
var firstName = $("#first_name");
var lastName = $("#last_name");
var profileNameFields = ['title', 'first_name', 'last_name'];

profileNameModal.setAutofocus('title');
profileNameModal.emptyModal(profileNameFields);

selectRoles.select2({
    placeholder:'Select roles',
    maximumSelectionLength: 2,
    width: "100%",
    allowClear: true
});

// Edit name
@include('profiles.js.name._edit');

// Save name
@include('profiles.js.name._save');
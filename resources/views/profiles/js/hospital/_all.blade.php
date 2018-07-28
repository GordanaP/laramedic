var hospitalModal = $('#profileHospitalModal');
var hospitalFields = ['hospital'];

hospitalModal.setAutofocus('hospital');
hospitalModal.emptyModal(hospitalFields);

var hospital = $('#hospital');

// Edit hospital
@include('profiles.js.hospital._edit')

// Save hospital
@include('profiles.js.hospital._save')

// Delete hospital
@include('profiles.js.hospital._delete')

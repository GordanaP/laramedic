// Variables
var achievementsModal = $('#profileAchievementsModal');
var achievementsFields = ['achievements'];

achievementsModal.setAutofocus('achievements');
achievementsModal.emptyModal(achievementsFields);

// Edit achievements
@include('profiles.js.achievements._edit');

// Save achievements
@include('profiles.js.achievements._save');

// Delete achievements
@include('profiles.js.achievements._delete');

$form = $('form');
const key = 'Contacts';
const emptyContactMessage =
    '<span class="text-danger">Tous les champs du formulaire doivent etre remplis</span>';
$formUpdateState = false;
$contactListDiv = $('#js-contact-list');
$showFormButton = $('#js-form-visible');
$contactList = $('#js-contact-list');
$initialAppMessage = '<p class="text-danger mt-10">No contacts yet</p>';
$dataAttrName = 'data-contact';
$deleteContactBtn = Array.from($('.delete-contact'));

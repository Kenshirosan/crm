function showContactsOrMessage() {
    $contacts = getFromLocalStorage(key);

    if ($contacts === null || $contacts.length === 0) {
        return $contactListDiv.html($initialAppMessage);
    }
    createContactList($contacts);

    return addEventAndTextToCreatedContacts();
}

function insertNewContact(contact) {
    let contacts = [];
    if (getFromLocalStorage(key) !== null) {
        contacts = getFromLocalStorage(key);
    }

    contacts.push(contact);
    addToLocalStorage(key, contacts);
    $formUpdateState = false;
    generateHTML(contact, contacts.length - 1);

    $form.trigger('reset');
    $form.hide('slow');
    setShowFormButtonText();
}

function updateContact() {
    $formUpdateState = true;
    $form.show('slow');

    $index = $(this)
        .parent()
        .attr($dataAttrName);

    $contacts = getFromLocalStorage(key);

    for (let field of $contacts[$index]) {
        $(`input[name=${field.name}]`).val(field.value);
    }

    $form.attr($dataAttrName, $index);
}

function persistUpdate(contact, index) {
    $contacts = getFromLocalStorage(key);
    $contacts[index] = contact;

    addToLocalStorage(key, $contacts);

    $uls = Array.from($('ul'));

    updateHTML($uls, index, contact);

    $form.trigger('reset');
    $form.hide('slow');
    $formUpdateState = false;
    setShowFormButtonText();
}

function updateHTML(uls, index, contact) {
    uls.forEach(function(ul) {
        if ($(ul).attr($dataAttrName) == index) {
            updateList(ul, contact);
        }
    });
}

function updateList(ul, contact) {
    $lis = Array.from($(ul).children());
    $lis.forEach(function(li) {
        updateMatchingListFields(li, contact);
    });
}

function updateMatchingListFields(li, contact) {
    for (let field of contact) {
        if (field.name == $(li).data(field.name)) {
            return $(li).html(`<strong>${field.name}:</strong> ${field.value}`);
        }
    }
}

function deleteContact() {
    $index = $(this)
        .parent()
        .parent()
        .attr($dataAttrName);

    $contacts = getFromLocalStorage(key);

    $contacts.splice($index, 1);

    addToLocalStorage(key, $contacts);
    $(this)
        .parent()
        .parent()
        .remove();

    resetListsDataAttr();

    if ($('ul').length == 0) {
        $contactList.html($initialAppMessage);
    }
}

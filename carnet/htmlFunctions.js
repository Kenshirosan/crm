function createContactList(contacts) {
    contacts.forEach(function(contact, index) {
        generateHTML(contact, index);
    });
}

function generateHTML(contact, index) {
    const ul = document.createElement('ul');

    ul.classList.add(
        'list-group',
        'col-md-4',
        'contact-list',
        'mb-10',
        'mt-10'
    );

    $(ul).attr($dataAttrName, index);

    for (let field of contact) {
        ul.innerHTML += `
            <li class="list-group-item" data-${field.name}="${field.name}">
                <strong>${field.name}:</strong> ${field.value}
            </li>
        `;
    }

    if ($contactList.html() == $initialAppMessage) {
        $('.text-danger').remove();
    }

    ul.appendChild(addDeletebutton());

    $contactList.append(ul);
    addEventAndTextToCreatedContacts();
}

function addEventAndTextToCreatedContacts() {
    $('li:first-child').on('click', updateContact);
}

function setShowFormButtonText() {
    $showFormButton.text('Ajouter un contact');
}

function addDeletebutton() {
    const li = document.createElement('li');
    const button = document.createElement('button');
    li.classList.add('list-group-item');
    button.classList.add('btn', 'btn-xs', 'btn-danger', 'delete-contact');
    button.innerText = 'Effacer';
    li.append(button);
    $(button).on('click', deleteContact);
    return li;
}

function resetListsDataAttr() {
    $contacts = getFromLocalStorage(key);

    let uls = Array.from($('ul'));

    for (let i = 0; i < $contacts.length; i++) {
        $(uls[i]).attr($dataAttrName, i);
    }
}

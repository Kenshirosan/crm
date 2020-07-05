function addToLocalStorage(key, items) {
    return localStorage.setItem(key, JSON.stringify(items));
}

function getFromLocalStorage(key) {
    return JSON.parse(localStorage.getItem(key));
}

function deleteContactFromLocalStorage(key) {
    return localStorage.removeItem(key);
}

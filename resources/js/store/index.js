import axios from 'axios';

export default {
    state: {
        contacts: [],
        userCount: Number,
        contact: {},
        contactsExist: false,
    },

    getters: {
        getContacts: state => async () => {
            await axios.get('/users')
                .then(res =>  {
                    state.contacts = res.data.users;
                    state.userCount = res.data.count;
                })
                .catch(e => console.log(e.message));

        },
    },

    actions: {
        setHasContacts({ commit }) {
            commit('setContactStatus');
        },

        deleteContacts({ commit }) {
            commit('deleteContactsFromLocalStorage');
        },

        editContact(context, { index }) {
            context.state.contact = context.state.contacts[index];
        },
    },

    mutations: {
        getInitialContact(state) {
            state.contact = {
                email: '',
                address: '',
                city: '',
                zipcode: '',
                created_at: new Date(),
                updated_at: '',
            };
        },

        setContactStatus(state) {
            return (state.contactsExist = state.contacts.length > 0);
        },

        addContact: ({ contacts }, { contact }) => {
            contacts.push(contact);
        },

        persistUpdate({ contacts }) {
        },

        deleteOneContact({ contacts }, { index }) {
            contacts.splice(index, 1);

            return localStorage.setItem(key, JSON.stringify(contacts));
        },

        deleteContactsFromLocalStorage({ contacts }) {
            contacts.length = 0;

        },
    },
};

import axios from 'axios';

export default {
    state: {
        contacts: [],
        contact: {},
        addresses: [],
        countries: [],
        cities: [],
        states: [],
        userCount: Number,
        contactsExist: false,
    },

    getters: {
        getContacts: state => async () => {
            await axios.get('/users')
                .then(res =>  {
                    state.contacts = res.data.users;
                })
                .catch(e => console.log(e.message));
        },

        getContact: state => async ({id}) => {
            await axios.get(`/user/${id}`)
                .then(res =>  {
                    state.contact = res.data.user;
                    state.addresses = res.data.user.addresses;
                })
                .catch(e => console.log(e.message));
        },

        getCountries: state => async () => {
            await axios.get(`/countries`)
                .then(res =>  {
                    state.countries = res.data;
                })
                .catch(e => console.log(e.message));
        },

    },

    actions: {
        setHasContacts({ commit }) {
            commit('setContactStatus');
        },

        initStatesAndCities({ commit }) {
            commit('initStatesAndCitiesTest');
        },

        getStates({ commit }, { id }) {
            commit('getStatesTest', id);
        },

        getCities({ commit }, { id }) {
            commit('getCitiesTest', id);
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
                country: '',
                state: '',
                city: '',
                zipcode: '',
                created_at: new Date(),
                updated_at: '',
            };
        },

        initStatesAndCitiesTest({ states, cities }) {
            states.length = 0;
            cities.length = 0;
        },

         async getStatesTest(state, id) {
            await axios.get(`/states/${id}`)
                .then(res =>  {
                    state.states = res.data;
                })
                .catch(e => console.log(e.message));
        },

        async getCitiesTest(state, id) {
            await axios.get(`/cities/${id}`)
                .then(res =>  {
                    state.cities = res.data;
                })
                .catch(e => console.log(e.message));
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

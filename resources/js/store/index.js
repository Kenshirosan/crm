import axios from 'axios';

export default {
    state: {
        contacts: [],
        contact: {},
        address: {},
        message: '',
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
        getInitialAddress(state) {
            state.address = {
                user_id: '',
                address_1: '',
                address_2: '',
                country: '',
                state: '',
                city: '',
                zipcode: ''
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

        async addAddress(state, address) {
            // TODO: Fix the await thing;
            await axios.post('/create/address', address )
                .then(res => {
                    console.log(res.data.message);
                    state.message = res.data.message;
                })
                .catch(err => console.error(`${err}`));
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

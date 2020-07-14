import axios from 'axios';

export default {
    state: {
        contacts: [],
        contact: {},
        address: {},
        message: {
            message: '',
            level: '',
        },
        addresses: [],
        countries: [],
        cities: [],
        states: [],
        userCount: Number,
        contactsExist: false,
    },

    getters: {
        getContacts: state => async () => {
            const res = await axios.get('/users');
            return (state.contacts = res.data.users);
        },

        getContact: state => async ({ id }) => {
            const res = await axios.get(`/user/${id}`);

            state.contact = res.data.user;
            return (state.addresses = res.data.user.addresses);
        },

        getCountries: state => async () => {
            const res = await axios.get(`/countries`);
            return (state.countries = res.data);
        },
    },

    actions: {
        addAddress({ commit }, address) {
            commit('addAddresstest', address);
        },

        addAddressUserId({ commit }, { id }) {
            commit('setAddressUserId', id);
        },

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
                user_id: '0',
                address_1: 'test',
                address_2: 'test',
                country: '',
                state: '',
                city: 'Marseille',
                zipcode: '12312',
            };
        },

        setAddressUserId(state, id) {
            return (state.address.user_id = id);
        },

        initStatesAndCitiesTest({ states, cities }) {
            states.length = 0;
            cities.length = 0;
        },

        async getStatesTest(state, id) {
            const res = await axios.get(`/states/${id}`);
            return (state.states = res.data);
        },

        async getCitiesTest(state, id) {
            const res = await axios.get(`/cities/${id}`);
            state.cities = res.data;
        },

        setContactStatus(state) {
            return (state.contactsExist = state.contacts.length > 0);
        },

        addAddresstest(state, address) {
            axios
                .post('/create/address', address)
                .then(res => {
                    state.message.message = res.data.message;
                    state.message.level = 'success';
                })
                .catch(e => {
                    state.message.message = e;
                    state.message.level = 'danger';
                });
        },

        persistUpdate({ contacts }) {},

        deleteOneContact({ contacts }, { index }) {
            contacts.splice(index, 1);

            return localStorage.setItem(key, JSON.stringify(contacts));
        },

        deleteContactsFromLocalStorage({ contacts }) {
            contacts.length = 0;
        },
    },
};

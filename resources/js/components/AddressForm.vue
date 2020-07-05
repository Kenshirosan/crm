<template>
    <div>
        <button class="button is-primary mb-10" @click="toggleFormView">Ajouter une addresse pour {{
                                                                                   user.name }}</button>
        <form
            class="is-child address"
            @submit.prevent="createAddress"
            v-show="this.is_visible || this.is_edit_mode">
            <div class="field">
                <label class="label is-medium" for="address_1">Address</label>
                <p class="control has-icons-left">
                    <input
                        type="text"
                        class="input is-medium"
                        id="address_1"
                        name="address_1"
                        placeholder="1234 Main St"
                        v-model="address.address_1"
                    />
                    <span class="icon is-small is-left">
                        <font-awesome-icon :icon="['fa', 'address-book']" />
                    </span>
                </p>
            </div>
            <div class="field">
                <label class="label is-medium" for="address_2">Address 2</label>
                <p class="control has-icons-left">
                    <input
                        type="text"
                        class="input is-medium"
                        id="address_2"
                        name="address_2"
                        placeholder="1234 Main St"
                        v-model="address.address_2"
                    />
                    <span class="icon is-small is-left">
                        <font-awesome-icon :icon="['fa', 'address-book']" />
                    </span>
                </p>
            </div>
            <div class="field">
                <label class="label is-medium" for="country">Country</label>
                <div class="control">
                    <select id="country" name="country" required v-model="address.country">
                        <option selected value="" class="black-text reset" disabled>Pick your country</option>
                        <option name="country"
                                v-for="country in countries"
                                v-text="country.name"
                                v-bind:value="country"
                                class="black-text"
                        ></option>
                    </select>
                </div>
            </div>
            <div class="field" v-if="this.country">
                <label class="label is-medium" for="states">State</label>
                <div class="control">
                    <select id="states" name="state" required v-model="address.state">
                        <option selected value="" class="black-text reset" disabled>Pick your state</option>
                        <option name="state"
                                v-for="state in states"
                                v-text="state.name"
                                v-bind:value="state"
                                class="black-text"
                        ></option>
                    </select>
                </div>
            </div>
            <div class="field" v-if="this.state">
                <label class="label is-medium" for="city">City</label>
                <div class="control">
                    <select id="city" name="city" required v-model="address.city">
                        <option selected value="" class="black-text reset" disabled>Pick your city</option>
                        <option name="city"
                                v-for="city in cities"
                                v-text="city.name"
                                v-bind:value="city.name"
                                class="black-text"
                        ></option>
                    </select>
                </div>
            </div>

            <div class="field">
                <label class="label is-medium" for="zipcode">Zip</label>
                <div class="control">
                    <input
                        type="text"
                        name="zipcode"
                        class="input is-medium"
                        id="zipcode"
                        v-model="address.zipcode"
                    />
                </div>
            </div>
            <div class="field is-grouped">
                <div class="control">
                    <button type="submit"
                            class="button is-link">Submit
                    </button>
                </div>
                <div class="control">
                    <button
                        type="button"
                        @click="toggleFormView"
                        id="cancel"
                        class="button is-link is-light">Cancel
                    </button>
                </div>
            </div>
        </form>

        <div class="columns is-multiline">
            <div v-if="user.addresses" v-for="address in user.addresses" class="column is-half-fullhd">
                <addressCard :address="address"
                             :country="JSON.parse(address.country)"
                             :user="user"
                             @updating="editAddressLine"
                             @editing="editAddress"></addressCard>
            </div>
        </div>
        <!-- /.columns -->
    </div>
</template>

<script>
    import addressCard from './Address';

    export default {
        components: {
            addressCard
        },

        data() {
            return {
                is_edit_mode: false,
                is_visible: false,
                address: {},
                countries: [],
                states: [],
                cities: [],
                user: {},
                error: String
            }
        },

        methods: {
            createAddress() {
                const method = this.is_edit_mode ? 'patch' : 'post';
                const uri = this.is_edit_mode ? '/update/address' : '/create/address';

                axios[method](uri, this.$data.address)
                    .then(res => console.log('Address added'))
                    .catch(err => this.error = err.message);
            },

            toggleFormView() {
                this.is_edit_mode = false;
                this.address = this.getInitialAddress();
                return this.is_visible = !this.is_visible;
            },

            editAddress(address) {
                this.is_edit_mode = true;
                this.address = address;
                this.address.user_id = this.user.id;

                return this.is_visible = !this.is_visible;
            },

            editAddressLine(address) {
                this.address.user_id = this.user.id;
                this.address.id = Object.values(address)[0];
                const name = Object.keys(address)[1];
                this.address[name] = Object.values(address)[1];

                axios.patch('update/address', this.$data.address)
                    .then(res => console.log('Address updated'))
                    .catch(err => this.error = err.message);
            },

            getCountriesStatesAndCities() {
                axios.get('/countries')
                    .then(res => this.countries = res.data)
                    .catch(err => console.log(err));
            },

            getUser() {
                axios.get(this.$route.path)
                    .then(res => {
                        this.user = res.data;
                    })
                    .catch(err => console.log(err));
            },

            getInitialAddress() {
                return this.address = {
                    user_id: this.user.id,
                    address_1: '',
                    address_2: '',
                    country: '',
                    state: '',
                    city: '',
                    zipcode: '',
                };
            }
        },

        computed: {
            country() {
                return this.address.country
            },

            state() {
                return this.address.state
            }

        },

        watch: {
            country: function() {
                if(this.$data.address.country.id) {
                    axios.get(`/states/${this.$data.address.country.id}`)
                        .then(res => this.states = res.data)
                        .catch(err => console.log(err));
                }
            },

            state: function() {
                if(this.$data.address.state.id) {
                    axios.get(`/cities/${this.$data.address.state.id}`)
                        .then(res => this.cities = res.data)
                        .catch(err => console.log(err));
                }
            }
        },

        mounted() {
            this.getCountriesStatesAndCities();
            this.getUser();
        }
    }
</script>

<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <button
                    type="button"
                    id="js-form-visible"
                    @click.prevent="showForm"
                    class="btn btn-xs btn-primary mb-10"
                >
                    {{ btnText }}
                </button>
            </div>
        </div>
        <div class="form-container" :class="classes">
            <h3 :class="classes" v-if="! editMode">Ajouter un contact</h3>
            <h3 :class="classes" v-if="editMode">Edition</h3>
            <form
                :class="classes"
                @submit.prevent="submitContact"
                @keydown="resetError"
            >
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address_1">Address</label>
                        <input
                            type="text"
                            class="form-control form-control-lg"
                            :class="classes"
                            id="address_1"
                            name="address_1"
                            v-model="address.address_1"
                            placeholder="1234 Main St"
                        />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="address_2">Complement Address</label>
                        <input
                            type="text"
                            class="form-control form-control-lg"
                            :class="classes"
                            id="address_2"
                            name="address_2"
                            v-model="address.address_2"
                            placeholder="Bat, etage ..."
                        />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="country">Country</label>
                        <select
                            class="form-control form-control-lg"
                            :class="classes"
                            name="country"
                            v-model="address.country"
                            id="country">
                            <option value="">Votre Pays</option>
                            <option v-bind:value="address.country" v-for="country in countries" :value="country"
                                    v-html="country.name"></option>
                        </select>
                    </div>
                    <div class="form-group col-md-6" v-if="states.length > 0">
                        <label for="state">City</label>
                        <select
                            class="form-control form-control-lg"
                            :class="classes"
                            name="state"
                            v-model="address.state"
                            id="state">
                            <option value="">Votre Region</option>
                            <option v-bind:value="address.state" v-for="state in states" :value="state"
                                    v-html="state.name"></option>
                        </select>
                    </div>
                    <div class="form-group col-md-6" v-if="cities.length > 0">
                        <label for="city">City</label>
                        <select
                            class="form-control form-control-lg"
                            :class="classes"
                            name="city"
                            v-model="address.city"
                            id="city">
                            <option value="">Votre Ville</option>
                            <option v-bind:value="address.city.name" v-for="city in cities" :value="city.name"
                                    v-html="city.name"></option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="zipcode">Zip</label>
                        <input
                            type="text"
                            name="zipcode"
                            class="form-control form-control-lg"
                            :class="classes"
                            v-model="address.zipcode"
                            id="zipcode"
                            placeholder="12345"
                        />
                    </div>
                </div>
                <div class="form-control-lg mt-10">
                    <button type="submit" class="btn btn-success">
                        Enregister
                    </button>
                    <button
                        type="button"
                        id="cancel"
                        class="btn btn-warning"
                        @click="resetForm"
                    >
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { mapMutations, mapState, mapGetters } from 'vuex';
    import events from '../events';

    export default {
        mixins: [events],

        name: 'AddressForm',

        data() {
            return {
                error: '',
                editMode: false,
                isVisible: false,
                isValidForm: false,
                btnText: 'Ajouter un contact',
            };
        },

        computed: {
            ...mapState(['contactsExist', 'address', 'countries', 'states', 'cities', 'message']),
            ...mapGetters(['getCountries', 'getCountries', 'getContact']),

            classes() {
                return this.isVisible ? `is-active` : ``;
            }
        },

        created() {
            window.events.$on('editing', payload => {
                this.isVisible = true;
                this.$store.dispatch('editContact', { index: payload.index });
                this.btnText = 'Annuler';
                this.editMode = true;
            });
        },

        mounted() {
            this.getInitialAddress();
            this.getCountries();
        },

        watch: {
            address: {
                handler(payload) {
                    if(payload.country) {
                        this.$store.dispatch('getStates', { id: payload.country.id });
                    }
                    if(payload.state) {
                        this.$store.dispatch('getCities', { id: payload.state.id });
                    }
                },
                deep: true,
            }
        },

        methods: {
            ...mapMutations([
                'addAddress',
                'getInitialAddress',
                'persistUpdate',
            ]),

            showForm() {
                if(this.editMode) {
                    return this.resetForm();
                }

                this.btnText =
                    this.btnText === 'Ajouter un contact'
                        ? 'Annuler'
                        : 'Ajouter un contact';

                this.isVisible = !this.isVisible;

                this.$store.dispatch('initStatesAndCities');

                return this.getInitialAddress();
            },

            submitContact() {
                this.address.user_id = this.$route.params.id;
                this.checkFormFields(this.address);

                if (this.isValidForm) {
                    this.persistForm(this.address);
                }
            },

            async persistForm(address) {
                let message = 'Contact successfully updated';

                if (this.editMode) {
                    this.persistUpdate();

                } else {
                    await this.addAddress(address);

                    this.$store.dispatch('setHasContacts');

                    message = 'Contact successfully created';
                }

                this.getContact({id: this.$route.params.id});
                //TODO: Fix the message issue;
                this.flash(this.message);
                this.resetForm();
            },

            deleteContacts() {
                this.$store.dispatch('deleteContacts');

                this.$store.dispatch('setHasContacts');

                this.flash('Contacts successfully deleted', 'primary');
            },

            checkFormFields(address) {
                for (let field in address) {
                    if (address[field] === '') {
                        this.isValidForm = false;
                        return this.createErrorMessage(field);
                    }

                    this.isValidForm = true;
                }
            },

            createErrorMessage(field) {
                const element = document.getElementById(field);
                const error = document.createElement('div');
                error.setAttribute('id', 'error-message');
                error.classList.add('alert', 'alert-danger');
                const emptyContactMessage =
                    '<span class="text-danger">Tous les champs du formulaire doivent etre remplis</span>';
                this.error = `${field} est vide : ${emptyContactMessage}`;
                error.innerHTML = this.error;
                element.parentNode.insertBefore(error, element.nextSibling);
            },

            resetForm() {
                this.getInitialAddress();
                this.editMode = false;
                this.isVisible = false;
                this.btnText = 'Ajouter un contact';
            },

            resetError() {
                if (this.error) {
                    this.error = '';
                    document.getElementById('error-message').remove();
                }
            },
        },
    };
</script>

<style scoped>
    .form-container {
        overflow: hidden;
        background-color: rgba(24, 28, 58, 0.8);
        border-radius: 20px;
        z-index: 100;
        width: 50vw;
        height: 70vh;
        position: absolute;
        top: calc(0%);
        left: calc(50% - 479.5px);
    }
    .form-container h3 {
        position: relative;
        top: 40px;
        text-align: center;
        color: white;
        transition: all 500ms cubic-bezier(0, 0.6, 0.35, 1.4);
    }

    .form-container, form {
        overflow: hidden;
        transform-origin: center;
        opacity: 0;
        transform: rotate(90deg) scale(0.5) translate(100px, -300px);
        transition: all 500ms cubic-bezier(0, 0.6, 0.35, 1.4);

    }

    form {
        height: 100%;
        position: relative;
        top: calc(50% - 240px);
        left: calc(50% - 235px);
        z-index: 1000;
    }

    .form-container.is-active, form.is-active, form.is-active h3 {
        z-index: 1000;
        opacity: 1;
        transform: rotate(0deg) scale(1);
    }

    input {
        transform: rotateY(90deg);
        transition: all 500ms ease-in-out 250ms;
        transform-origin: left;
        opacity: 0;
    }

    input.is-active {
        opacity: 1;
        transform: rotate(0deg) scale(1);
    }
</style>

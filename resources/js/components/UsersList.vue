<template>
    <div class="app">
        <div class="container mt-10">
            <section class="form">
                <AddressForm ref="contactForm"></AddressForm>
            </section>

            <section v-if="contactsExist">
                <h2>{{ userCount }} utilisateurs</h2>
                <Table
                    :contacts="contacts"
                ></Table>
            </section>

            <section class="row" v-else>
                <h2>Pas de contacts</h2>
            </section>
            <flash></flash>
        </div>
    </div>
</template>

<script>
    import { mapState, mapGetters, mapActions } from 'vuex';
    import events from '../events';
    import AddressForm from './AddressForm';
    import Table from './Table.vue';
    import flash from './Flash';

    export default {
        name: 'App',

        mixins: [events],

        components: {
            AddressForm,
            Table,
            flash,
        },

        computed: {
            ...mapState(['contacts', 'userCount', 'contactsExist']),
            ...mapGetters(['getContacts']),
        },

        async mounted() {
            await this.getContacts();

            this.$store.dispatch('setHasContacts');

            setTimeout(() => {
                this.$el.classList.add('is-active');
            }, 1000);
        },

    };
</script>

<style>
    body {
        background-color: #2c3e50;
        /*overflow: hidden;*/
    }
    .app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #2c3e50;
        transition: all 250ms ease-in;
        margin-top: 200px;
        opacity: 0;
    }
    .app.is-active {
        opacity: 1;
        margin-top: 0;
    }
    .mb-10 {
        margin-bottom: 10px;
    }

    .mb-5-percent {
        margin-bottom: 5%;
    }

    .mt-10 {
        margin-top: 10px;
    }

    h3, h2 {
        margin: 40px 0 0;
        color: white;
    }

    #js-contact-list {
        width: 100%;
    }
</style>

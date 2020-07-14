<template>
    <div class="app is-active">
        <div class="container mt-10">
            <section v-if="contactsExist">
                <h2>{{ userCount }} utilisateurs</h2>
                <Table :contacts="contacts"></Table>
            </section>

            <section class="row" v-else>
                <h2>Pas de contacts</h2>
            </section>
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

            userCount() {
                return this.contacts.length;
            },
        },

        async mounted() {
            await this.getContacts();

            this.$store.dispatch('setHasContacts');
        },
    };
</script>

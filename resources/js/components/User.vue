<template>
    <div>
        <div class="row">
            <section class="form">
                <AddressForm ref="contactForm"></AddressForm>
            </section>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2>User</h2>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr class="table-primary">
                            <th>User Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Verification de l'email</th>
                            <th>Est Client</th>
                            <th>Creer</th>
                            <th>Mis a jour</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody class="is-active">
                        <UserDataTable></UserDataTable>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Addresses</h2>
                <table
                    class="table table-striped table-dark"
                    v-if="addresses && addresses.length > 0"
                >
                    <thead>
                        <tr class="table-primary">
                            <th>Address Number</th>
                            <th>Address 1</th>
                            <th>Address 2</th>
                            <th>Zip</th>
                            <th>City</th>
                            <th>Region</th>
                            <th>Country</th>
                            <th>Creer le</th>
                            <th>Mis a jour</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody class="is-active">
                        <AddressDataTable
                            v-for="(address, key) in addresses"
                            :address="address"
                            :key="key"
                        ></AddressDataTable>
                    </tbody>
                </table>
                <h2 v-else><strong>Pas d'addresses enregistrees</strong></h2>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex';
    import UserDataTable from './UserDataTable';
    import AddressDataTable from './AddressDataTable';
    import AddressForm from './AddressForm';

    export default {
        name: 'User',

        components: { UserDataTable, AddressDataTable, AddressForm },

        computed: {
            ...mapState(['contact', 'addresses']),
            ...mapGetters(['getContact']),
        },

        mounted() {
            this.getContact({ id: this.$route.params.id });
        },
    };
</script>

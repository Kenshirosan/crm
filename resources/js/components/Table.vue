<template>
    <table class="table table-striped table-dark">
        <thead>
            <tr class="table-primary">
                <th>Editer User</th>
                <th>First Name,Last Name</th>
                <th>Email</th>
                <th>Email Verifie</th>
                <th>Creer</th>
                <th>Mis a jour</th>
                <th>Effacer</th>
            </tr>
        </thead>
        <tbody class="is-active">
            <DataTable
                v-for="(contact, index) in contacts"
                :key="index"
                :index="index"
                :contact="contact"
            ></DataTable>
        </tbody>
    </table>
</template>

<script>
    import DataTable from './DataTable';

    export default {
        name: 'Table',

        components: { DataTable },

        props: ['contacts'],
    };
</script>

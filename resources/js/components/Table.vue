<template>
    <table class="table table-striped table-dark">
        <thead>
        <tr class="table-primary">
            <th>User Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Email Verifie</th>
            <th>Creer</th>
            <th>Mis a jour</th>
            <th>Editer</th>
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
    import DataTable from "./DataTable";

    export default {
        name: "Table",

        components: { DataTable },

        props: ['contacts'],
    }
</script>

<style>
    table {
        overflow: hidden;
    }
    tbody {
        overflow: hidden;
        transform: translateX(-200px);
        transform-origin: left;
        opacity: 0;
        transition: all 100ms ease-in-out 350ms;
    }

    tbody.is-active {
        opacity: 1;
        transform: rotate(0deg);
    }
</style>

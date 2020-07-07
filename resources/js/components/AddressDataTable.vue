<template>
    <tr>
        <td
            v-for="(value, key) of address"
            v-if="key !== 'country' &&  key !== 'state' && key !== 'pivot' && key !=='created_at' && key !==
            'updated_at'">
            <div>{{ value }}</div>
        </td>
        <td v-else-if="key === 'id'">
            <div>{{ value}}</div>
        </td>
        <td v-else-if="key === 'country'">
            <div>{{ value | json }}</div>
        </td>
        <td v-else-if="key === 'state'">
            <div>{{ value | json }}</div>
        </td>
        <td v-else-if="key === 'created_at'">
            <div>{{ value | moment }}</div>
        </td>
        <td v-else-if="key === 'updated_at'">
            <div>{{ value | moment }}</div>
        </td>

        <td>
            <button class="btn btn-xs">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-pen" fill="green"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.707 13.707a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391L10.086 2.5a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 0 1 1.414 0l.586.586a1 1 0 0 1 0 1.414L5 13l-3 1 1-3z"/>
                    <path fill-rule="evenodd" d="M9.854 2.56a.5.5 0 0 0-.708 0L5.854 5.855a.5.5 0 0 1-.708-.708L8.44 1.854a1.5 1.5 0 0 1 2.122 0l.293.292a.5.5 0 0 1-.707.708l-.293-.293z"/>
                    <path d="M13.293 1.207a1 1 0 0 1 1.414 0l.03.03a1 1 0 0 1 .03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
                </svg>
            </button>
        </td>
        <td>
            <button class="btn btn-xs">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-dash-circle-fill" fill="red"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4 7.5a.5.5 0 0 0 0 1h8a.5.5 0 0 0 0-1H4z"/>
                </svg>
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        name: "AddressDataTable",

        props: ['address'],

        mounted() {
            setTimeout(() => {
                this.$el.classList.add('is-active');
            }, 100);
        }
    }
</script>

<style scoped>
    td {
        border: none;
    }

    tr {
        opacity: 0;
        transform: translateX(-200px);
        transition: all 500ms ease-in;
    }

    tr.is-active {
        transform-origin: left;
        opacity: 1;
    }

    tr p {
        transform: skew(5deg);
    }

    tr.is-active:nth-child(even) {
        transform: skew(5deg);
    }

    tr.is-active:nth-child(odd) {
        transform: skew(-5deg);
    }

    tr.is-active:nth-child(even) div {
        transform: skew(-5deg);
    }

    tr.is-active:nth-child(odd) div {
        transform: skew(5deg);
    }
</style>

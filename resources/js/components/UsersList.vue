<template>
    <div class="columns is-multiline is-mobile">
        <div v-if="users.length > 0" v-for="user in users" class="column is-one-third">
            <ul>
                <li>
                    <router-link class="button is-link" :to="'/user/' + user">{{ user}}</router-link>
                </li>
                <li>
                    {{ user }}
                </li>
            </ul>
        </div>
        <div v-else>
            No registered users yet.
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: []
            }
        },

        methods: {
            getUsers() {
                axios.get('/users')
                    .then(res => this.users = res.data)
                    .catch(err => console.log( err ));
            }
        },

        mounted() {
            this.getUsers();
        }
    }
</script>

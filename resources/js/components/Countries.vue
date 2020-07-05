<template>
    <select id="country" name="country" required>
        <option value="" class="black-text reset" disabled>Pick your country</option>
        <option name="countries"
                v-for="country in countries"
                v-text="country.name"
                v-bind:value="country.id"
                class="black-text"
        ></option>
    </select>
</template>

<script>
    export default {
        data() {
            return {
                countries: [],
            }
        },

        mounted() {
            this.getCountries();
        },

        methods: {
            getCountries() {
                axios.get('/countries')
                    .then(res => this.countries = res.data)
                    .catch(err => console.log(err));
            }
        }
    }
</script>

<template>
    <div class="card">
        <header class="card-header">
            <button
                class="button card-header-title"
                :data-id="address.id"
                @click="editAddress">Click to Edit Address</button>
        </header>

        <div class="card-content">
            <h4>{{ user.name }} {{ user.last_name }}</h4>
            <ul class="content">
                <li name="address_1"
                    contenteditable="true"
                    @focusout="updated"
                    v-model="addressLines.address_1">{{ address.address_1 }}
                </li>
                <li name="address_2"
                    contenteditable="true"
                    @focusout="updated"
                    v-model="addressLines.address_2">{{ address.address_2 }}
                </li>
                <li name="country"
                    contenteditable="true"
                    @focusout="updated"
                    v-model="addressLines.country">{{ JSON.parse(address.country) }}
                </li>
                <li name="state"
                    contenteditable="true"
                    @focusout="updated"
                    v-model="addressLines.state">{{ address.state }}
                </li>
                <li name="city"
                    contenteditable="true"
                    @focusout="updated"
                    v-model="addressLines.city">{{ address.city }}
                </li>
                <li name="zipcode"
                    contenteditable="true"
                    @focusout="updated"
                    v-model="addressLines.zipcode">{{ address.zipcode }}
                </li>
            </ul>
        </div>
    </div>
    <!-- /.card -->
</template>

<script>
    export default {
        props: ['address', 'user', 'country'],

        data() {
            return {
                is_edit_mode: false,
                addressLines: {
                    id: '',
                }
            }
        },

        methods: {
            editAddress() {
                this.$emit('editing', this.address)
            },

            updated(e) {
                const name = e.target.getAttribute('name');
                this.addressLines[name] = e.target.innerHTML;

                this.$emit('updating', this.addressLines);
            }
        },

        mounted() {
            this.addressLines.id = this.$props.address.id
        }
    }
</script>


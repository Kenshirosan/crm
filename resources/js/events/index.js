import Vue from 'vue';

// Event bus
window.events = new Vue();

export default {
    methods: {
        editingContact(payload) {
            window.events.$emit('editing', payload);
        },

        flash(message, level = 'success', duration = 3000) {
            window.events.$emit('flash', { message, level, duration });
        },
    },
};

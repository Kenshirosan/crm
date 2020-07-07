import moment from "moment";

export default [
    {
        name: 'moment',
        execute: (timestamp) => {
            if (!timestamp) return '';
            return moment(timestamp).fromNow();
        }
    },
    {
        name: 'translate',
        execute: (string) => {
            return string === false ? 'Non' : 'Oui';
        }
    },
    {
        name: 'emailVerified',
        execute: (timestamp) => {
            if (!timestamp) return 'Utilisateur non verifie';

            return moment(timestamp).fromNow();
        }
    },
    {
        name: 'json',
        execute: (string) => {
            if (!string) return '';

            let json =  JSON.parse(string);

            return json.name
        }
    },
    {
        name: 'ucfirst',
        execute: (string) => {
            if (!string) return '';

            return string.charAt(0).toUpperCase + string.substring(1);
        }
    }
];

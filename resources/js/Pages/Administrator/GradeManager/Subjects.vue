<script>
import Administrator from '@/Layouts/Administrator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

import CRUD from '@/Components/CRUD.vue';

export default {
    
    props: {
        errors: Object,
    },

    data: function () {
        return {
            crud : {
                title: 'Subject Manager',
                model: 'Subject',
                files: '',
                data: null,
                rows: 10,
                table: [
                    { field: 'id', text: 'No.', type: 'text', value: '', validation: '', display: true, isForm: false, isSearch: true, colWidth: 'w-20', fieldWidth: 'w-full' },
                    { field: 'name', text: 'Subject', type: 'text', value: null, validation: 'required', display: true, isForm: true, isSearch: true, colWidth: 'w-auto', fieldWidth: 'w-full' },
                    { field: 'note', text: 'Note', type: 'text', value: null, validation: 'required', display: true, isForm: true, isSearch: true, colWidth: 'w-auto', fieldWidth: 'w-full' },
                ],
                orderBy: 'id',
                order: 'desc',
                with: '',
            },
        };
    },

    methods: {
    },

    computed: {
    },

    updated: function(){
    },

    created: function() {
    },

    components: { Administrator, Head, Link, CRUD }
}
</script>

<template>

    <Head title="Subjects" />

    <Administrator>

        <CRUD :crud="crud"></CRUD>

    </Administrator>

</template>
